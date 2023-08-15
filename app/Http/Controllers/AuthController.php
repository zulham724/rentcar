<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\UserDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Session;

class AuthController extends Controller
{
  //
  public function getUserAccount(Request $request)
  {
    $user = $request->user();
    return response()->json($user);
  }

  /**
   * Handle a login request to the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Laravel\Passport\ClientRepository  $clients
   * @return \Illuminate\Http\Response
   */
  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->route('login')
      ->withErrors($validator)
        ->withInput();
    }

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      Session::flash('success_msg','Login Berhasil');
      // Authentication passed, redirect to dashboard or wherever you want
      return redirect('/');
    }

    Session::flash('error_msg', 'Email atau Password salah');
    return redirect()->route('login')
    ->withInput();
  }

  public function register(Request $request)
  {
    // dd($request->all());
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6',
      'home_address' => 'required',
      'phone_number' => 'required',
      'sim_number' => 'required',
    ]);

    $user = new User;
    $user->fill($request->all());
    $user->role_id = 2;
    $user->password = bcrypt($request->password);
    $user->save();
    $profile = new UserDetail();
    if ($request->has('detail')) {
      $profile->fill($request->detail);
    }
    $user->detail()->save($profile);
    Session::flash('success_msg','Pendaftaran berhasil');

    return redirect('/auth/login-basic');
  }

  public function logout(){
    Auth::logout();
    return redirect('/auth/login-basic');
  }
}
