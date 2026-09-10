<?php

namespace App\Http\Controllers\Order\Wizard;

use App\Http\Controllers\Controller;
use App\Models\Template;
use App\Models\TemplateType;
use App\Services\Order\OrderSessionService;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function __construct(
        private OrderSessionService $orderSession
    ) {}

    public function index(Request $request)
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

        return view('order.wizard.template', compact(
            'templates',
            'categories',
            'selectedCategory',
            'selectedTemplateId'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'template_id' => 'required|exists:templates,id',
        ]);

        $this->orderSession->setTemplate($validated['template_id']);

        return redirect()->route('order.domain');
    }
}