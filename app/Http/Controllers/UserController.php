<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $searchKeyword = $request->get('search_keyword');
        $users = User::whereNotIn('email', ['admin@gmail.com', 'user@gmail.com'])
            ->when($searchKeyword, function ($query, $searchKeyword) {
                return $query->where('name', 'like', '%' . $searchKeyword . '%')
                    ->orWhere('email', 'like', '%' . $searchKeyword . '%');
            })
            ->paginate(10);

        return view('admin.user.list', compact('users'));
    }

    public function create()
    {
        return view('admin.user.add');
    }

    public function store(StoreUserRequest $request)
    {

        $request->validated();

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }

        // Menyimpan data user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('asdasdasd'),
            'phone' => $request->phone,
            'role' => $request->role ?? 'user',
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.user.list')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.user.update', compact('user'));
    }

    public function show(User $user)
    {
        return view('admin.user.detail', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $request->validated();

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }
            $photoPath = $request->file('photo')->store('photos', 'public');
        } else {
            $photoPath = $user->photo;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'photo' => $photoPath,
        ]);

        return redirect()->route('admin.user.list')->with('success', 'Data berhasil diperbarui.');
    }


    public function destroy(User $user)
    {
        if ($user->photo) {
            Storage::delete('public/' . $user->photo);
        }

        $user->delete();

        return redirect()->route('admin.user.list')->with('success', 'Data berhasil dihapus');
    }
}
