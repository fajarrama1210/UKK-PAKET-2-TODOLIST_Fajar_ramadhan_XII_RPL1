<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    /**
     * Menampilkan profil user yang sedang login.
     *
     * @return View
     */
    public function index(): View
    {
        $user = auth()->user();
        return view('user.profile.list', compact('user'));
    }
    public function edit(User $user)
    {
        $user = auth()->user();
        return view('user.profile.update', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user(); // Ambil pengguna yang sedang login

        // Validasi password jika ada password baru yang diisi
        if ($request->filled('new_password')) {
            // Verifikasi password lama hanya jika password baru diisi
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama tidak cocok.']);
            }

            // Update password baru
            $user->password = bcrypt($request->new_password);
        }

        // Update data lainnya
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'photo' => $this->handlePhotoUpdate($request, $user),
        ]);

        return redirect()->route('user.profile.list')->with('success', 'Data berhasil diperbarui.');
    }

    // Menangani foto pengguna
    private function handlePhotoUpdate(Request $request, User $user)
    {
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }
            return $request->file('photo')->store('photos', 'public');
        }

        return $user->photo; // Jika tidak ada foto baru, kembalikan foto lama
    }

}
