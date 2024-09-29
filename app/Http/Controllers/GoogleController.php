<?php

namespace App\Http\Controllers;

use App\Mail\NotifDaftar;
use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Mail;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $userGoogle = Socialite::driver('google')->stateless()->user();
            // dd($userGoogle);
            $finduser = User::where('google_id', $userGoogle->id)->first();

            if ($finduser) {
                Auth::login($finduser);

                // toastr()->success('Selamat Datang di Sahabat ASN.', 'Sukses');
                return redirect()->intended('dashboard');
            } else {
                $make_password = Str::random(8);
                $generate_username = substr($userGoogle->getName(), 0, 5) . rand(1, 999);
                $user = User::updateOrCreate(['email' => $userGoogle->email], [
                    'role' => 'user',
                    'nama' => $userGoogle->getName(),
                    'username' => $generate_username,
                    'google_id' => $userGoogle->getId(),
                    'avatar' => $userGoogle->getAvatar(),
                    'password' => Hash::make($make_password)
                ]);


                // Mail::to($user->email)->send(new NotifDaftar($user, $make_password));
                Auth::login($user);

                toastr()->success('Selamat Datang di SIREMO.');
                return redirect()->intended('home');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
