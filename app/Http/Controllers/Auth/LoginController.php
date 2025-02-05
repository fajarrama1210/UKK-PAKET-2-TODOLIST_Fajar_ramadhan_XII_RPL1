<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | Login Controller
    |----------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    // Menambahkan validasi pada login
    public function login(Request $request)
    {
        // Validasi input email dan password
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ], [
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Email yang Anda masukkan tidak valid.',
            'email.exists' => 'Email yang Anda masukkan tidak terdaftar.',
            'password.required' => 'Kolom password wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Proses login jika validasi berhasil
        if (Auth::attempt($request->only('email', 'password'))) {
            // Menyimpan pesan sukses di session flash
            Session::flash('success', 'Selamat datang, Anda berhasil login!');
            return $this->authenticated($request, Auth::user());
        }

        // Menampilkan pesan error jika email ada, namun password salah
        return redirect()->back()->withErrors(['email' => 'Email atau Password yang Anda masukkan salah.']);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated($request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'user') {
            return redirect()->route('user.dashboard');
        }

        return redirect('/');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
