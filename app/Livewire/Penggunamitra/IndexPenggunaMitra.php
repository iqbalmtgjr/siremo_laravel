<?php

namespace App\Livewire\Penggunamitra;

use App\Models\User;
use App\Models\Mitra;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class IndexPenggunaMitra extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $mitra, $mitra_id, $user, $user_mitra, $user_id, $total, $paginate = 10;

    public $search, $nama, $username, $email, $no_hp, $role, $ktp, $lihat_ktp, $password, $password_confirmation, $user_ktp;

    public function render()
    {
        $this->mitra = Mitra::all();
        $this->total = User::where('role', '<>', 'super_admin')
            ->where('mitra_id', auth()->user()->mitra_id)
            ->count();
        return view(
            'livewire.penggunamitra.index-pengguna-mitra',
            [
                'users'  => $this->search === null ?
                    User::where('mitra_id', auth()->user()->mitra_id)
                    ->paginate($this->paginate) :
                    User::where(function ($query) {
                        $query->where('role', '<>', 'super_admin')
                            ->where('mitra_id', auth()->user()->mitra_id)
                            ->where(function ($query) {
                                $query->where('nama', 'LIKE', '%' . $this->search . '%')
                                    ->orWhere('email', 'LIKE', '%' . $this->search . '%');
                            });
                    })->paginate($this->paginate),
                'total' => $this->total,
                'mitra' => $this->mitra
            ]
        );
    }

    public function store()
    {
        $validated = Validator::make(
            ['nama' => $this->nama, 'username' => $this->username, 'email' => $this->email, 'no_hp' => $this->no_hp, 'role' => $this->role],
            [
                'nama' => ['required', 'min:3'],
                'no_hp' => ['required', 'max:13'],
                'username' => ['required', 'min:3', Rule::unique('users', 'username')->ignore($this->user)],
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user)],
                'role' => ['required'],
                'ktp' => ['image|max:1024'],
            ],
        )->validate();

        $pengg = User::create([
            'mitra_id' => auth()->user()->mitra_id,
            'nama' => $this->nama,
            'username' => $this->username,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        if ($this->ktp != null) {
            $filename = $this->ktp->hashName();
            $this->ktp->storeAs('pengguna/ktp/', $filename, 'public');
            $pengg->update(['ktp' => $filename]);
        }

        // $this->dispatch('created');
        toastr()->success('Pengguna berhasil ditambahkan');
        return redirect('/penggunamitra');
        // $this->reset();
    }

    public function edit($id)
    {
        $this->user = User::find($id);

        $this->nama = $this->user->nama;
        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->no_hp = $this->user->no_hp;
        $this->role = $this->user->role;
    }

    public function mitrakita($id)
    {
        $this->user = User::find($id);
        // dd($this->user);

        if ($this->user->mitra_id == null) {
            $this->mitra_id = 0;
        } else {
            $this->mitra_id = $this->user->mitra_id;
        }
    }

    public function viewktp($id)
    {
        $this->user_ktp = User::find($id);
        // dd($this->transaksi_ktp);
        $this->lihat_ktp = $this->user_ktp->ktp;
    }

    public function updateMitra()
    {
        // dd($this->mitra_id);
        $this->user->update([
            'mitra_id' => $this->mitra_id,
        ]);

        toastr()->success('Mitra berhasil diperbarui');
        return redirect('/penggunamitra');
    }

    public function update()
    {
        // dd($this->no_hp);
        $validated = Validator::make(
            // Data to validate...
            ['nama' => $this->nama, 'username' => $this->username, 'email' => $this->email, 'no_hp' => $this->no_hp, 'role' => $this->role],

            // Validation rules to apply...
            [
                'nama' => ['required', 'min:3'],
                'no_hp' => ['required', 'max:13'],
                'username' => ['required', 'min:3', Rule::unique('users', 'username')->ignore($this->user)],
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user)],
                'role' => ['required'],
                'ktp' => ['image|max:1024'],
            ],

        )->validate();

        $this->user->update([
            'nama' => $this->nama,
            'username' => $this->username,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
            'role' => $this->role
        ]);

        if ($this->ktp != null) {
            $filename = $this->ktp->hashName();
            $this->ktp->storeAs('pengguna/ktp/', $filename, 'public');
            $this->user->update(['ktp' => $filename]);
        }

        toastr()->success('Pengguna berhasil diperbarui');
        return redirect('/penggunamitra');
        // $this->dispatch('edited');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        toastr()->success('Pengguna berhasil di hapus');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetInput()
    {
        $this->reset();
    }
}
