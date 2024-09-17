<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

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
        'password' => 'required',
        'role' => 'required'
        ]);
        
        if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $insert = User::create([
          'username' => $request->username,
          'email' => $request->email,
          'password' => Hash::make($request->password),
          'id_role' => $request->role,
          ]);
          
      if($insert){
        return redirect()->back()->with('success','Berhasil Membuat Akun');
      }
      
      return redirect()->back->with('error','Gagal membuat akun');
    }
    
    public function showUser()
    {
      $user = User::with('roles')->get();
      $role = Role::all();
      return view('datauser',compact('user','role'));
    }
    
    public function updatesr(Request $request, $id)
    {
        $id = Crypt::decrypt($id);

        $validator = Validator::make($request->all(), [
            'username_edit' => 'required',
            'email_edit' => 'required|email',
            'role_edit' => 'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $insert = User::where('id', $id)->update([
            'username' => $request->username_edit,
            'email' => $request->email_edit,
            'password' => empty($request->password_edit) ? $request->nawdbuywai : Hash::make($request->password_edit),
            'id_role' => $request->role_edit,
        ]);

        if ($insert) {
            return redirect()->back()->with('success', 'Berhasil Ubah Akun');
        }

        return redirect()->back()->with('error', 'Gagal Ubah akun');
    }

    
    public function hapus($id)
    {
      $delete = User::where('id',$id)->delete();
      
      if(!$delete){
        return redirect()->back->with('error','Gagal Hapus Data');
      }
      return redirect()->back()->with('success','Berhasil Hapus Data');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}

