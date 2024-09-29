<?php

namespace App\Livewire\Pengguna;

use App\Models\User;
use App\Models\Mitra;
use Livewire\Component;
use App\Models\Kendaraan;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class IndexPengguna extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $mitra, $mitra_id, $user, $user_mitra, $user_id, $total, $paginate = 10;

    public $search;

    #[Validate('required', as: 'Nama')]
    public $nama;

    #[Validate('required', as: 'Username')]
    public $username;

    #[Validate('required', as: 'Email')]
    public $email;

    #[Validate('required', as: 'No HP')]
    public $no_hp;

    #[Validate('required', as: 'Role')]
    public $role;

    #[Validate('required', as: 'Password')]
    public $password;

    #[Validate('required', as: 'Konfirmasi Password')]
    public $password_confirmation;

    public function render()
    {
        $this->mitra = Mitra::where('valid', 1)->get();
        $this->total = User::where('role', '<>', 'super_admin')->count();
        return view(
            'livewire.pengguna.index-pengguna',
            [
                'users'  => $this->search === null ?
                    User::where('role', '<>', 'super_admin')->paginate($this->paginate) :
                    User::where(function ($query) {
                        $query->where('role', '<>', 'super_admin')
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
        $this->validate();
        User::create([
            'nama' => $this->nama,
            'username' => $this->username,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        // $this->dispatch('created');
        toastr()->success('Pengguna berhasil ditambahkan');
        return redirect('/pengguna');
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

    public function updateMitra()
    {
        // dd($this->mitra_id);
        $this->user->update([
            'mitra_id' => $this->mitra_id,
        ]);

        toastr()->success('Mitra berhasil diperbarui');
        return redirect('/pengguna');
        // $this->dispatch('mitraed');
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
            ],

        )->validate();

        $this->user->update([
            'nama' => $this->nama,
            'username' => $this->username,
            'email' => $this->email,
            'no_hp' => $this->no_hp,
            'role' => $this->role
        ]);

        toastr()->success('Pengguna berhasil diperbarui');
        return redirect('/pengguna');
        // $this->dispatch('edited');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        toastr()->success('Pengguna berhasil di hapus');
    }

    public function resetInput()
    {
        $this->reset();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
