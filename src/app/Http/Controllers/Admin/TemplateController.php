<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use App\Models\TemplateType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TemplateController extends Controller
{
    public function index(Request $request)
    {
        $templates = Template::with('type')
            ->when(
                $request->search,
                fn ($query, $search) => $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.templates.index', compact('templates'));
    }

    public function create()
    {
        $types = TemplateType::orderBy('name')->get();

        return view('admin.templates.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'template_type_id' => ['required', 'exists:template_types,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:templates,slug'],
            'description' => ['nullable', 'string'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'difficulty' => ['nullable', 'string', 'max:50'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = $validated['slug']
            ?: Str::slug($validated['name']);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        Template::create($validated);

        return redirect()
            ->route('admin.templates.index')
            ->with('success', 'Template berhasil ditambahkan.');
    }

    public function edit(Template $template)
    {
        $types = TemplateType::orderBy('name')->get();

        return view(
            'admin.templates.edit',
            compact('template', 'types')
        );
    }

    public function update(Request $request, Template $template)
    {
        $validated = $request->validate([
            'template_type_id' => ['required', 'exists:template_types,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:templates,slug,' . $template->id,
            ],
            'description' => ['nullable', 'string'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'difficulty' => ['nullable', 'string', 'max:50'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = $validated['slug']
            ?: Str::slug($validated['name']);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $template->update($validated);

        return redirect()
            ->route('admin.templates.index')
            ->with('success', 'Template berhasil diperbarui.');
    }

    public function destroy(Template $template)
    {
        if ($template->orders()->exists()) {
            return back()->with(
                'error',
                'Template tidak dapat dihapus karena sudah digunakan pada order.'
            );
        }

        $template->delete();

        return back()->with(
            'success',
            'Template berhasil dihapus.'
        );
    }
}