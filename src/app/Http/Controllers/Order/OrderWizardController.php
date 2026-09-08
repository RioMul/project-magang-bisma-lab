<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
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

        $query = Template::with(['type', 'images'])
            ->where('is_active', true);

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

        return view('order.wizard.template', compact(
            'templates',
            'categories',
            'selectedCategory'
        ));
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
            $cleanName = preg_replace(
                '/[^a-zA-Z0-9-]/',
                '',
                strtolower($searchQuery)
            );

            $extensions = [
                [
                    'ext' => '.com',
                    'price' => 150000,
                    'popular' => true,
                ],
                [
                    'ext' => '.id',
                    'price' => 225000,
                    'popular' => false,
                ],
                [
                    'ext' => '.net',
                    'price' => 140000,
                    'popular' => false,
                ],
            ];

            foreach ($extensions as $extension) {
                $domainResults[] = [
                    'domain' => $cleanName . $extension['ext'],
                    'price' => $extension['price'],
                    'ext' => $extension['ext'],
                    'popular' => $extension['popular'],
                ];
            }
        }

        return view('order.wizard.domain', compact(
            'selectedTemplate',
            'searchQuery',
            'domainResults'
        ));
    }

    public function storeDomain(Request $request)
    {
        if (!$this->orderSession->hasTemplate()) {
            return redirect()
                ->route('order.domain')
                ->with('error', 'Silakan pilih template terlebih dahulu.');
        }

        $validated = $request->validate([
            'selected_domain' => 'required|string',
            'domain_price' => 'required|numeric',
        ]);

        $this->orderSession->setDomain(
            $validated['selected_domain'],
            $validated['domain_price']
        );

        return redirect()->route('order.package');
    }

    public function selectPackage()
    {
        $packages = Package::with('features')
            ->where('is_active', true)
            ->get();

        $selectedTemplate = $this->orderSession->getTemplateId()
            ? Template::with('images')->find($this->orderSession->getTemplateId())
            : null;

        $selectedPackageId = $this->orderSession->getPackageId();
        $selectedDomain = $this->orderSession->getDomain();

        return view('order.wizard.package', compact(
            'packages',
            'selectedTemplate',
            'selectedPackageId',
            'selectedDomain'
        ));
    }

    public function storePackage(Request $request)
    {
        if (
            !$this->orderSession->hasTemplate() ||
            !$this->orderSession->hasDomain()
        ) {
            return redirect()
                ->route('order.package')
                ->with('error', 'Data sebelumnya belum lengkap.');
        }

        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
        ]);

        $this->orderSession->setPackage($validated['package_id']);

        return redirect()->route('order.checkout');
    }
}