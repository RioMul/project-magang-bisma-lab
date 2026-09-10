<?php

namespace App\Http\Controllers\Order\Wizard;

use App\Http\Controllers\Controller;
use App\Models\DomainExtension;
use App\Models\DomainPrice;
use App\Models\Template;
use App\Services\Order\OrderSessionService;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function __construct(
        private OrderSessionService $orderSession
    ) {}

    public function index(Request $request)
    {
        $selectedTemplate = $this->orderSession->getTemplateId()
            ? Template::with('images')->find($this->orderSession->getTemplateId())
            : null;

        $searchQuery = $request->query('q');
        $domainResults = [];

        if (!empty($searchQuery)) {
            $cleanName = preg_replace('/[^a-zA-Z0-9-]/', '', strtolower($searchQuery));
            $extensions = DomainExtension::where('is_active', true)->get();

            foreach ($extensions as $extension) {
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

        return view('order.wizard.domain', compact(
            'selectedTemplate',
            'searchQuery',
            'domainResults',
            'selectedDomain',
            'selectedDomainPrice'
        ));
    }

    public function store(Request $request)
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
}