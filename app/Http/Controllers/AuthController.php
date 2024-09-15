<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {   
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if(Auth::user()->id_role === 1||Auth::user()->id_role === 3)
            {
                return redirect()->route('returpembelian.index');
            } else if (Auth::user()->id_role === 2)
            {
                return redirect()->route('retur.index');
            } else {
                return redirect()->route('login')->with('error', 'Akun yang anda masukan tidak terdaftar');
            }
        }
        return redirect()->route('login')->with('error', 'Email Atau Password Anda Salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

