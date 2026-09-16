<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $packages = Package::query()
            ->when(
                $request->search,
                fn ($query, $search) => $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:packages,slug'],
            'short_description' => ['nullable', 'string'],
            'price_monthly' => ['required', 'numeric', 'min:0'],
            'price_annually' => ['required', 'numeric', 'min:0'],
            'is_popular' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = $validated['slug']
            ?: Str::slug($validated['name']);

        $validated['is_popular'] = $request->boolean('is_popular');
        $validated['is_active'] = $request->boolean('is_active');

        Package::create($validated);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Package berhasil ditambahkan.');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:packages,slug,' . $package->id,
            ],
            'short_description' => ['nullable', 'string'],
            'price_monthly' => ['required', 'numeric', 'min:0'],
            'price_annually' => ['required', 'numeric', 'min:0'],
            'is_popular' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['slug'] = $validated['slug']
            ?: Str::slug($validated['name']);

        $validated['is_popular'] = $request->boolean('is_popular');
        $validated['is_active'] = $request->boolean('is_active');

        $package->update($validated);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Package berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        if ($package->orders()->exists()) {
            return back()->with(
                'error',
                'Package tidak dapat dihapus karena sudah digunakan pada order.'
            );
        }

        $package->delete();

        return back()->with(
            'success',
            'Package berhasil dihapus.'
        );
    }
}