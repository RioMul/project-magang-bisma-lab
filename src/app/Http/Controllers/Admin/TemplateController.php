<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use App\Models\TemplateType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
            ->when(
                $request->category,
                fn ($query, $category) => $query
                    ->whereHas(
                        'type',
                        fn ($q) => $q->where('name', $category)
                    )
            )
            ->latest()
            ->paginate(9)
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
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:templates,slug',
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

        Template::create($validated);

        return redirect()
            ->route('admin.templates.index')
            ->with('success', 'Template berhasil ditambahkan.');
    }

    public function edit(Template $template)
    {
        $types = TemplateType::orderBy('name')->get();

        $templateData = $this->getTemplateData($template);

        return view(
            'admin.templates.edit',
            compact('template', 'types', 'templateData')
        );
    }

    public function update(Request $request, Template $template)
    {
        $validated = $request->validate([
            'template_type_id' => [
                'required',
                'exists:template_types,id',
            ],
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:templates,slug,' . $template->id,
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'demo_url' => [
                'nullable',
                'url',
                'max:255',
            ],
            'difficulty' => [
                'nullable',
                'string',
                'max:50',
            ],
            'is_featured' => [
                'nullable',
                'boolean',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],

            'header' => ['nullable', 'array'],
            'header.site_name' => [
                'nullable',
                'string',
                'max:255',
            ],
            'header.logo_text' => [
                'nullable',
                'string',
                'max:255',
            ],
            'header.badge' => [
                'nullable',
                'string',
                'max:255',
            ],
            'header.button_text' => [
                'nullable',
                'string',
                'max:255',
            ],
            'header.menu' => [
                'nullable',
                'array',
            ],
            'header.menu.*' => [
                'nullable',
                'string',
                'max:100',
            ],

            'body' => ['nullable', 'array'],
            'body.hero_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'body.hero_highlight' => [
                'nullable',
                'string',
                'max:255',
            ],
            'body.hero_description' => [
                'nullable',
                'string',
            ],
            'body.hero_image' => [
                'nullable',
                'string',
                'max:255',
            ],
            'body.button_text' => [
                'nullable',
                'string',
                'max:255',
            ],
            'body.promo_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'body.promo_description' => [
                'nullable',
                'string',
            ],
            'body.categories' => [
                'nullable',
                'array',
            ],
            'body.categories.*' => [
                'nullable',
                'string',
                'max:100',
            ],
            'body.products' => [
                'nullable',
                'array',
            ],
            'body.products.*.name' => [
                'required',
                'string',
                'max:255',
            ],
            'body.products.*.price' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'body.products.*.old_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'body.products.*.rating' => [
                'nullable',
                'numeric',
                'min:0',
                'max:5',
            ],
            'body.products.*.sold' => [
                'nullable',
                'integer',
                'min:0',
            ],
            'body.products.*.image' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sidebar' => ['nullable', 'array'],
            'sidebar.phone' => [
                'nullable',
                'string',
                'max:50',
            ],
            'sidebar.address' => [
                'nullable',
                'string',
                'max:255',
            ],
            'sidebar.whatsapp' => [
                'nullable',
                'string',
                'max:30',
            ],
            'sidebar.whatsapp_message' => [
                'nullable',
                'string',
                'max:500',
            ],
            'sidebar.social_instagram' => [
                'nullable',
                'string',
                'max:100',
            ],

            'footer' => ['nullable', 'array'],
            'footer.description' => [
                'nullable',
                'string',
            ],
            'footer.links' => [
                'nullable',
                'array',
            ],
            'footer.links.*' => [
                'nullable',
                'string',
                'max:255',
            ],
            'footer.copyright' => [
                'nullable',
                'string',
                'max:255',
            ],

            'seo' => ['nullable', 'array'],
            'seo.title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'seo.description' => [
                'nullable',
                'string',
            ],
            'seo.keywords' => [
                'nullable',
                'string',
            ],
            'seo.og_image' => [
                'nullable',
                'string',
                'max:255',
            ],

            'style' => ['nullable', 'array'],
            'style.primary' => [
                'nullable',
                'regex:/^#[0-9A-Fa-f]{6}$/',
            ],
            'style.secondary' => [
                'nullable',
                'regex:/^#[0-9A-Fa-f]{6}$/',
            ],
            'style.background' => [
                'nullable',
                'regex:/^#[0-9A-Fa-f]{6}$/',
            ],
            'style.text' => [
                'nullable',
                'regex:/^#[0-9A-Fa-f]{6}$/',
            ],
        ]);

        $oldSlug = $template->slug;

        $newSlug = $validated['slug']
            ?: Str::slug($validated['name']);

        $oldPath = resource_path(
            'templates/' . $oldSlug . '.json'
        );

        $newPath = resource_path(
            'templates/' . $newSlug . '.json'
        );

        if (
            $oldSlug !== $newSlug &&
            File::exists($newPath)
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'slug' => 'File JSON dengan slug tersebut sudah ada.',
                ]);
        }

        $templateData = [];

        if (File::exists($oldPath)) {
            $content = File::get($oldPath);

            $decoded = json_decode($content, true);

            if (is_array($decoded)) {
                $templateData = $decoded;
            }
        }

        if (empty($templateData)) {
            return back()
                ->withInput()
                ->withErrors([
                    'template' => 'File JSON template tidak ditemukan atau tidak valid.',
                ]);
        }

        $templateData['name'] = $validated['name'];

        if ($request->has('header')) {
            $templateData['header'] = $validated['header'];
        }

        if ($request->has('body')) {
            $templateData['body'] = $this->normalizeBody(
                $validated['body']
            );
        }

        if ($request->has('sidebar')) {
            $templateData['sidebar'] = $validated['sidebar'];
        }

        if ($request->has('footer')) {
            $templateData['footer'] = $validated['footer'];
        }

        if ($request->has('seo')) {
            $templateData['seo'] = $validated['seo'];
        }

        if ($request->has('style')) {
            $templateData['style'] = $validated['style'];
        }

        $json = json_encode(
            $templateData,
            JSON_PRETTY_PRINT |
            JSON_UNESCAPED_UNICODE |
            JSON_UNESCAPED_SLASHES
        );

        if ($json === false) {
            return back()
                ->withInput()
                ->withErrors([
                    'template' => 'Data template gagal diproses menjadi JSON.',
                ]);
        }

        if ($oldSlug !== $newSlug) {
            File::move($oldPath, $newPath);
            File::put($newPath, $json);
        } else {
            File::put($oldPath, $json);
        }

        $validated['slug'] = $newSlug;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $template->update($validated);

        return redirect()
            ->route('admin.templates.edit', $template)
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

    private function getTemplateData(Template $template): array
    {
        $path = resource_path(
            'templates/' . $template->slug . '.json'
        );

        if (!File::exists($path)) {
            return [];
        }

        $content = File::get($path);

        if (!$content) {
            return [];
        }

        $data = json_decode($content, true);

        return is_array($data) ? $data : [];
    }

    private function normalizeBody(array $body): array
    {
        if (!isset($body['products']) || !is_array($body['products'])) {
            return $body;
        }

        foreach ($body['products'] as $index => $product) {
            $body['products'][$index]['price'] =
                isset($product['price'])
                    ? (int) $product['price']
                    : 0;

            $body['products'][$index]['old_price'] =
                isset($product['old_price'])
                    ? (int) $product['old_price']
                    : 0;

            $body['products'][$index]['rating'] =
                isset($product['rating'])
                    ? (float) $product['rating']
                    : 0;

            $body['products'][$index]['sold'] =
                isset($product['sold'])
                    ? (int) $product['sold']
                    : 0;
        }

        return $body;
    }
}