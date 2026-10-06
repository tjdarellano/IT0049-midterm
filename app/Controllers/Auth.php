<?php
namespace App\Controllers;
use App\Models\UserModel;
class Auth extends BaseController
{
 public function login(){return view('auth/login');}
 public function attempt(){ $user=(new UserModel())->where('username',$this->request->getPost('username'))->first(); if($user && password_verify((string)$this->request->getPost('password'),$user['password'])){session()->regenerate(); session()->set(['user_id'=>$user['id'],'user_name'=>$user['full_name']]); return redirect()->to('/dashboard');} return redirect()->back()->withInput()->with('error','Invalid username or password.'); }
 public function logout(){session()->destroy(); return redirect()->to('/login');}
}
