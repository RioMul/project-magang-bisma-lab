<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->where('is_admin', false)
            ->withCount('orders')
            ->when(
                $request->search,
                function ($query, $search) {
                    $query->where(function ($query) use ($search) {
                        $query
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
                }
            )
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        abort_if($user->is_admin, 404);

        $user->load([
            'orders.template',
            'orders.package',
            'orders.payment',
        ]);

        return view('admin.users.show', compact('user'));
    }
}