<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | Register Controller
    |----------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'string', 'max:12'],
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], $this->messages());
    }

    protected function messages()
{
    return [
        'name.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah terdaftar.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal terdiri dari 8 karakter.',
        'phone.required' => 'Nomor HP wajib diisi.',
        'photo.required' => 'Foto profil wajib diunggah.',
        'photo.image' => 'File yang diunggah harus berupa gambar.',
        'photo.mimes' => 'Foto harus memiliki ekstensi jpg, jpeg, atau png.',
        'phone.max' => 'Nomor HP maksimal terdiri dari 12 karakter.',
        'photo.max' => 'Ukuran foto maksimal 2MB.',
    ];
}


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $photoPath = null;
        if (isset($data['photo']) && $data['photo']->isValid()) {
            $photoPath = $data['photo']->store('photos', 'public');
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'photo' => $photoPath,
        ]);
    }
    protected function registered(Request $request, $user)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }

}
