<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $username;
    public $password;
    public $remember = false;
    public $errorMessage = '';

    public function login()
    {
        // Validasi input form
        $this->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|min:6',
        ]);

        // Proses login menggunakan Auth
        if (Auth::attempt(['username' => $this->username, 'password' => $this->password])) {
            // Jika login berhasil
            session()->flash('message', 'Login berhasil!');
            return redirect()->to('/transportasi');  // Arahkan ke halaman transportasi
        } else {
            // Jika login gagal
            session()->flash('error', 'Username atau password salah!');
            $this->errorMessage = 'Username atau password yang Anda masukkan salah.';
            // throw ValidationException::withMessages([
            //     'username' => 'Username yang Anda masukkan salah.',
            //     'password' => 'Password yang Anda masukkan salah.',
            // ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
