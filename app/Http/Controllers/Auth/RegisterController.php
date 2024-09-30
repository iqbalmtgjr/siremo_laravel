<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Mitra;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama_mitra' => ['required', 'string', 'max:255'],
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'no_hp' => ['required', 'string', 'max:13'],
            'alamat_mitra' => ['required', 'string', 'max:255'],
            'logo_mitra' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // $filename = $data['logo_mitra']->hashName();
        $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $data['logo_mitra']->getClientOriginalName());
        $data['logo_mitra']->storeAs('mitra/logo/', $filename, 'public');
        $mitra = Mitra::create([
            'nama' => $data['nama_mitra'],
            'alamat' => $data['alamat_mitra'],
            'logo' => $filename,
            'status' => 'buka',
            'valid' => 0
        ]);

        return User::create([
            'mitra_id' => $mitra->id,
            'nama' => $data['nama'],
            'email' => $data['email'],
            'username' => $data['username'],
            'no_hp' => $data['no_hp'],
            'role' => 'admin_mitra',
            'password' => Hash::make($data['password']),
        ]);
    }
}
