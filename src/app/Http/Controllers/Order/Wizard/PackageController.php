<?php

namespace App\Http\Controllers\Order\Wizard;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Template;
use App\Services\Order\OrderSessionService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct(
        private OrderSessionService $orderSession
    ) {}

    public function index()
    {
        $packages = Package::with('features')->where('is_active', true)->get();

        $selectedTemplate = $this->orderSession->getTemplateId()
            ? Template::with('images')->find($this->orderSession->getTemplateId())
            : null;

        $selectedPackageId = $this->orderSession->getPackageId();
        $selectedDomain = $this->orderSession->getDomain();
        $selectedDomainPrice = $this->orderSession->getDomainPrice();

        return view('order.wizard.package', compact(
            'packages',
            'selectedTemplate',
            'selectedPackageId',
            'selectedDomain',
            'selectedDomainPrice'
        ));
    }

    public function store(Request $request)
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