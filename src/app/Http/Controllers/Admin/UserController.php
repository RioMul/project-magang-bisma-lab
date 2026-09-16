<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $baseQuery = User::query()
            ->where('is_admin', false);

        $totalUsers = (clone $baseQuery)->count();

        $activeUsers = (clone $baseQuery)
            ->whereHas('orders', function ($query) {
                $query->where('status', 'paid');
            })
            ->count();

        $pendingUsers = (clone $baseQuery)
            ->whereHas('orders', function ($query) {
                $query->where('status', 'pending');
            })
            ->count();

        $expiredUsers = (clone $baseQuery)
            ->whereHas('orders', function ($query) {
                $query->where('status', 'expired');
            })
            ->count();

        $newUsers = (clone $baseQuery)
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->count();

        $payingUsers = $activeUsers;

        $users = User::query()
            ->where('is_admin', false)
            ->with([
                'orders' => function ($query) {
                    $query->latest();
                },
                'orders.package',
                'orders.website',
                'orders.payment',
            ])
            ->withCount('orders')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');

                $query->where(function ($query) use ($search) {
                    $query
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhereHas('orders', function ($query) use ($search) {
                            $query->where('domain_name', 'like', "%{$search}%");
                        });
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $status = $request->input('status');

                if ($status === 'new') {
                    $query->whereDoesntHave('orders');
                    return;
                }

                $query->whereHas('orders', function ($query) use ($status) {
                    $query->where('status', $status);
                });
            })
            ->when($request->filled('plan'), function ($query) use ($request) {
                $query->whereHas('orders.package', function ($query) use ($request) {
                    $query->where('id', $request->input('plan'));
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $packages = \App\Models\Package::query()
            ->orderBy('name')
            ->get();

        return view('admin.users.index', compact(
            'users',
            'packages',
            'totalUsers',
            'activeUsers',
            'pendingUsers',
            'expiredUsers',
            'newUsers',
            'payingUsers'
        ));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => false,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        abort_if($user->is_admin, 404);

        $user->load([
            'orders.template',
            'orders.package',
            'orders.payment',
            'orders.website',
        ]);

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if($user->is_admin, 404);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        abort_if($user->is_admin, 404);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make(
                $validated['password']
            );
        }

        $user->save();

        return redirect()
            ->route('admin.users.show', $user)
            ->with('success', 'Data user berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        abort_if($user->is_admin, 404);

        if ($user->orders()->exists()) {
            return redirect()
                ->route('admin.users.show', $user)
                ->with(
                    'error',
                    'User tidak dapat dihapus karena masih memiliki riwayat pesanan.'
                );
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}