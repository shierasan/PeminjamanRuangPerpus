<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Redirect based on role
            if ($user->role === 'admin') {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil!',
                    'redirect' => route('admin.dashboard')
                ]);
            } elseif ($user->role === 'display') {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil!',
                    'redirect' => route('display.index')
                ]);
            } elseif ($user->role === 'user') {
                return response()->json([
                    'success' => true,
                    'message' => 'Login berhasil!',
                    'redirect' => route('user.dashboard')
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah.'
        ], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validate input
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Create user with 'user' role by default
            $user = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'role' => 'user', // Automatically set role to 'user'
            ]);

            // Redirect to login page (not auto-login)
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Registrasi berhasil! Silakan login dengan akun Anda.',
                    'redirect' => route('login')
                ]);
            }

            return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}
