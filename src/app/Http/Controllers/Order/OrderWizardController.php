<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\DomainExtension;
use App\Models\DomainPrice;
use App\Models\Package;
use App\Models\Template;
use App\Models\TemplateType;
use App\Services\Order\OrderSessionService;
use Illuminate\Http\Request;

class OrderWizardController extends Controller
{
    public function __construct(
        private OrderSessionService $orderSession
    ) {
    }

    public function template(Request $request)
    {
        $selectedCategory = $request->query('category', 'All');
        $search = $request->query('search');

        $query = Template::with(['type', 'images'])->where('is_active', true);

        if ($selectedCategory !== 'All' && !empty($selectedCategory)) {
            $query->whereHas('type', function ($q) use ($selectedCategory) {
                $q->where('name', $selectedCategory);
            });
        }

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $templates = $query->get();
        $categories = TemplateType::pluck('name')->toArray();
        $selectedTemplateId = $this->orderSession->getTemplateId();

        return view('order.wizard.template', compact('templates', 'categories', 'selectedCategory', 'selectedTemplateId'));
    }

    public function storeTemplate(Request $request)
    {
        $validated = $request->validate([
            'template_id' => 'required|exists:templates,id',
        ]);

        $this->orderSession->setTemplate($validated['template_id']);

        return redirect()->route('order.domain');
    }

    public function searchDomain(Request $request)
    {
        $selectedTemplate = $this->orderSession->getTemplateId()
            ? Template::with('images')->find($this->orderSession->getTemplateId())
            : null;

        $searchQuery = $request->query('q');
        $domainResults = [];

        if (!empty($searchQuery)) {
            $cleanName = preg_replace('/[^a-zA-Z0-9-]/', '', strtolower($searchQuery));

            // Menarik ekstensi domain secara dinamis dari database
            $extensions = DomainExtension::where('is_active', true)->get();

            foreach ($extensions as $extension) {
                // Mengambil harga tahunan (billing_period = 1)
                $priceData = DomainPrice::where('domain_extension_id', $extension->id)
                    ->where('billing_period', 1)
                    ->first();

                if ($priceData) {
                    $domainResults[] = [
                        'domain' => $cleanName . $extension->extension,
                        'price' => $priceData->price,
                        'ext' => $extension->extension,
                        'popular' => $extension->extension === '.com',
                    ];
                }
            }
        }

        $selectedDomain = $this->orderSession->getDomain();
        $selectedDomainPrice = $this->orderSession->getDomainPrice();

        return view('order.wizard.domain', compact('selectedTemplate', 'searchQuery', 'domainResults', 'selectedDomain', 'selectedDomainPrice'));
    }

    public function storeDomain(Request $request)
    {
        if (!$this->orderSession->hasTemplate()) {
            return redirect()->route('order.template')->with('error', 'Silakan pilih template terlebih dahulu.');
        }

        $validated = $request->validate([
            'selected_domain' => 'required|string|max:255',
            'domain_price' => 'required|numeric|min:0',
        ]);

        $this->orderSession->setDomain($validated['selected_domain'], $validated['domain_price']);

        return redirect()->route('order.package');
    }

    public function selectPackage()
    {
        $packages = Package::with('features')->where('is_active', true)->get();

        $selectedTemplate = $this->orderSession->getTemplateId()
            ? Template::with('images')->find($this->orderSession->getTemplateId())
            : null;

        $selectedPackageId = $this->orderSession->getPackageId();
        $selectedDomain = $this->orderSession->getDomain();
        $selectedDomainPrice = $this->orderSession->getDomainPrice();

        return view('order.wizard.package', compact('packages', 'selectedTemplate', 'selectedPackageId', 'selectedDomain', 'selectedDomainPrice'));
    }

    public function storePackage(Request $request)
    {
        if (!$this->orderSession->hasTemplate()) {
            return redirect()->route('order.template')->with('error', 'Silakan pilih template terlebih dahulu.');
        }

        if (!$this->orderSession->hasDomain()) {
            return redirect()->route('order.domain')->with('error', 'Silakan pilih domain terlebih dahulu.');
        }

        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
        ]);

        $this->orderSession->setPackage($validated['package_id']);

        return redirect()->route('order.checkout');
    }
}