<?php

namespace App\Livewire\Kendaraan;

use App\Models\User;
use App\Models\Mitra;
use Livewire\Component;
use App\Models\Hargasewa;
use App\Models\Kendaraan;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Illuminate\Container\Attributes\Auth;

class IndexKendaraan extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $users, $kendaraan, $total, $paginate = 10;

    public $search;

    #[Rule('required', as: 'Merk')]
    public $merk;

    #[Rule('required', as: 'Tipe')]
    public $tipe;

    #[Rule('required', as: 'Pemilik')]
    public $pemilik;

    public $status;

    #[Rule('required', as: 'Plat Kendaraan')]
    public $harga_sewa;

    #[Rule('required', as: 'Plat Kendaraan')]
    public $plat;

    #[Rule('required', as: 'Alamat Kendaraan')]
    public $alamat;

    #[Rule(['foto.*' => 'image|max:1024'], as: 'Foto Kendaraan')]
    public $foto;

    public $foto_edit;

    #[On('updateModal')]
    public function render()
    {
        $this->total = Kendaraan::where('mitra_id', auth()->user()->mitra_id)->get()->count();
        $this->users = User::where('role', '<>', 'super_admin')
            ->where('mitra_id', auth()->user()->mitra_id)
            ->get();

        return view(
            'livewire.kendaraan.index-kendaraan',
            [
                'kendaraans'  => $this->search === null ?
                    Kendaraan::where('mitra_id', auth()->user()->mitra_id)->paginate($this->paginate) :
                    Kendaraan::where(function ($query) {
                        $query->where('mitra_id', auth()->user()->mitra_id)
                            ->Orwhere('merk', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('plat', 'LIKE', '%' . $this->search . '%')
                            ->orWhereHas('user', function ($query) {
                                $query->where('nama', 'LIKE', '%' . $this->search . '%');
                            });
                    })->paginate($this->paginate),
                'users' => $this->users,
                'total' => $this->total,
                'mitra' => Mitra::find(auth()->user()->mitra_id)->nama
            ]
        );
    }

    public function store()
    {
        $this->validate();

        $mitraid = User::find($this->pemilik)->mitra_id;
        // dd($mitraid);
        if ($mitraid != auth()->user()->mitra_id) {
            toastr()->error('Pemilik Kendaraan sudah terdaftar di mitra lain');
            return redirect('/kendaraan');
        }

        $ken = Kendaraan::create([
            'user_id' => $this->pemilik,
            'mitra_id' => $mitraid,
            'plat' => $this->plat,
            'merk' => $this->merk,
            'tipe' => $this->tipe,
            'alamat' => $this->alamat,
            'harga_sewa' => $this->harga_sewa,
            'status' => 'Tersedia',
        ]);

        if ($this->foto != null) {
            $filename = $this->foto->hashName();
            $this->foto->storeAs('kendaraan/foto/', $filename, 'public');
            $ken->update(['foto' => $filename]);
        }

        // Hargasewa::create([
        //     'kendaraan_id' => $ken->id,
        // ]);

        toastr()->success('Kendaraan berhasil ditambahkan');
        return redirect('/kendaraan');
        // $this->reset();
        // $this->dispatch('created');
    }

    public function edit($id)
    {
        $this->kendaraan = Kendaraan::find($id);
        // dd($this->kendaraan);

        $this->pemilik = $this->kendaraan->user_id;
        $this->plat = $this->kendaraan->plat;
        $this->merk = $this->kendaraan->merk;
        $this->tipe = $this->kendaraan->tipe;
        $this->alamat = $this->kendaraan->alamat;
        $this->status = $this->kendaraan->status;
        $this->harga_sewa = $this->kendaraan->harga_sewa;
        if ($this->kendaraan->foto != null) {
            $this->foto_edit = $this->kendaraan->foto;
        }
    }

    public function update()
    {
        $this->validate();
        $this->kendaraan->update([
            'user_id' => $this->pemilik,
            'plat' => $this->plat,
            'merk' => $this->merk,
            'tipe' => $this->tipe,
            'alamat' => $this->alamat,
            'status' => $this->status,
            'harga_sewa' => $this->harga_sewa,
        ]);

        if ($this->foto != null) {
            if ($this->kendaraan->foto != null) {
                @unlink(public_path('storage/kendaraan/foto/' . $this->kendaraan->foto));
            }
            $filename = $this->foto->hashName();
            $this->foto->storeAs('kendaraan/foto/', $filename, 'public');
            $this->kendaraan->update([
                'foto' => $filename
            ]);
        }

        toastr()->success('Kendaraan berhasil diperbarui');
        return redirect('/kendaraan');
        // $this->dispatch('edited');
    }

    public function delete($id)
    {
        $kendaraan = Kendaraan::find($id);
        if ($kendaraan->foto != null) {
            @unlink(public_path('storage/kendaran/foto/' . $kendaraan->foto));
        }
        $kendaraan->delete();
        toastr()->success('Kendaraan berhasil di hapus');
        // $this->dispatch('deleted');
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
