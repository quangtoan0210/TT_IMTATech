<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        return view('client.layouts.login');
    }
    public function login(Request $request)
    {
        $categories = Category::all(); 
    
        $credentials = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
    
        // Kiểm tra thông tin đăng nhập
        $user = User::where('email', $request->email)->first();
    
        if ($user && !$user->is_locked && Auth::attempt($credentials)) {
            Session::where('user_id', Auth::id())->delete();
            session()->put('user_id', Auth::id());
            return redirect()->intended('/');
        }
    
        return redirect()->back()
            ->withErrors(['email' => $user && $user->is_locked ? 'Tài khoản của bạn đã bị khóa' : 'Thông tin người dùng không đúng'])
            ->with('categories', $categories);
    }
    
    public function showFormRegister()
    {
        return view('client.layouts.register');
    }
    public function register(Request $request)
    {
        $categories = Category::all(); // Khai báo biến categories
    
        $checkExist = User::where('email', $request->email)->exists();
        if ($checkExist) {
            return redirect()->back()
                ->withErrors(['email' => 'Email đã tồn tại trên hệ thống vui lòng kiểm tra lại'])
                ->with('categories', $categories); // Truyền biến categories với lỗi
        } else {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8',
            ]);
    
            $user = User::query()->create($data);
            Auth::login($user);
            return redirect()->intended('/')->with('categories', $categories); // Truyền biến categories với redirect
        }
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('formLogin');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
        
            $user = Socialite::driver('google')->user();
         
            $finduser = User::where('google_id', $user->id)->first();
         
            if($finduser){
         
                Auth::login($finduser);
        
                return redirect()->intended('dashboard');
         
            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'google_id'=> $user->id,
                        'password' => encrypt('123456dummy')
                    ]);
         
                Auth::login($newUser);
        
                return redirect()->intended('dashboard');
            }
        
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
