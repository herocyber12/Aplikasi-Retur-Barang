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
    
    public function regis(Request $request)
    {
      $validator = Validator::make($request->all(),[
        'username' => 'required',
        'email' => 'required|email',
        'password' => 'required|password',
        'role' => 'required|exist:roles,id'
        ]);
        
        if($validator->fails()){
          return redirect()->back()->withError($validator)->withInput();
        }
        
        $insert = User::create([
          'username' => $request->username;
          'email' => $request->email;
          'password' => $request->password;
          'id_role' => $request->role;
          ]);
          
      if($insert){
        return redirect()->back()->with('success','Berhasil Membuat Akun')
      }
      
      return redirect()->back->with('error','Gagal membuat akun');
    }
    
    public function showUser()
    {
      $user = User::with('role')->get();
      $role = Role::all();
      return view('datauser',compact('user','role'));
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

