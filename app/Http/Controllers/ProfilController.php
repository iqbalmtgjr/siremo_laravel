<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kritiksaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $user = User::find($id);
        return view('profil.index', compact('user'));
    }


    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'nama' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'email' => 'required|unique:users,email,' . $id,
            'no_hp' => 'required',
        ]);
        $user = User::find($id);
        $user->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);
        toastr()->success('Profil berhasil diperbarui');
        return redirect()->back();
    }

    public function updatePassword(Request $request, string $id)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        if (password_verify($request->current_password, auth()->user()->password)) {
            // password benar
            $user = User::find($id);
            $user->update([
                'password' => bcrypt($request->password),
            ]);
            toastr()->success('Password berhasil diperbarui');
            return redirect()->back();
        } else {
            // password salah
            return redirect()->back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
        }
    }

    public function storeKritikSaran(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'saran' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Kritik dan saran anda belum diisi');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Kritiksaran::create([
            'user_id' => auth()->user()->id,
            'saran' => $request->saran,
        ]);

        toastr()->success('Kritik dan Saran Berhasil Dikirim.');
        return redirect()->back();
    }
}
