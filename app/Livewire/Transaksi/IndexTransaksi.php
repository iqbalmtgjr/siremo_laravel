<?php

namespace App\Livewire\Transaksi;

use App\Models\User;
use Livewire\Component;
use App\Models\Hargasewa;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

class IndexTransaksi extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $transaksii, $transaksi_ktp, $lihat_ktp, $users, $kendaraans, $total, $paginate = 10;

    public $search;

    #[Validate('required', as: 'Kendaraan')]
    public $kendaraan_id;

    #[Validate('required', as: 'Pengguna')]
    public $pengguna_id;

    #[Validate('required', as: 'Lama Sewa')]
    public $lama_sewa;

    #[Validate(['ktp.*' => 'image|max:1024'], as: 'Upload KTP')]
    public $ktp;

    #[Validate('required', as: 'Pembayaran')]
    public $pembayaran;

    public $status;
    public $total_harga;

    #[On('reseted', 'deleted')]
    public function render()
    {
        $transaksi_skrng = Transaksi::where('mitra_id', auth()->user()->mitra_id)
            ->where('status', 'proses')->get();
        $this->kendaraans = Kendaraan::where('mitra_id', auth()->user()->mitra_id)->whereNotIn('id', $transaksi_skrng->pluck('kendaraan_id'))->get();
        $this->total = Transaksi::where('status', 'proses')->get()->count();
        $this->users = User::where('role', '<>', 'super_admin')
            ->where('mitra_id', auth()->user()->mitra_id)
            ->get();

        return view(
            'livewire.transaksi.index-transaksi',
            [
                'transaksis'  => $this->search === null ?
                    Transaksi::where('status', 'proses')
                    ->where('mitra_id', auth()->user()->mitra_id)
                    ->orderBy('id', 'DESC')
                    ->paginate($this->paginate) :
                    Transaksi::whereHas('user', function ($query) {
                        $query->where('nama', 'LIKE', '%' . $this->search . '%');
                    })->orderBy('id', 'DESC')->paginate($this->paginate),
                'kendaraans' => $this->kendaraans,
                'total' => $this->total,
                'users' => $this->users
            ]
        );
    }

    public function store()
    {
        $this->validate();

        $harga_sewaa = Kendaraan::find($this->kendaraan_id)?->harga_sewa;
        $total_hargaa = $this->lama_sewa * $harga_sewaa;
        if ($this->ktp !== null) {
            $filename = $this->ktp->hashName();
            $this->ktp->storeAs('pengguna/ktp/', $filename, 'public');
            Transaksi::create([
                'kendaraan_id' => $this->kendaraan_id,
                'mitra_id' => auth()->user()->mitra_id,
                'user_id' => $this->pengguna_id,
                'lama_sewa' => $this->lama_sewa,
                'total_harga' => $total_hargaa,
                'pembayaran' => $this->pembayaran,
                'status' => 'proses',
                'ktp' => $filename
            ]);
        } else {
            Transaksi::create([
                'kendaraan_id' => $this->kendaraan_id,
                'mitra_id' => auth()->user()->mitra_id,
                'user_id' => $this->pengguna_id,
                'lama_sewa' => $this->lama_sewa,
                'total_harga' => $total_hargaa,
                'pembayaran' => $this->pembayaran,
                'status' => 'proses',
            ]);
        }

        toastr()->success('Transaksi berhasil ditambahkan');
        $this->reset();
        return redirect('/transaksi');
        // $this->dispatch('created');
    }

    public function viewktp($id)
    {
        $this->transaksi_ktp = User::find($id);
        // dd($this->transaksi_ktp);
        $this->lihat_ktp = $this->transaksi_ktp->ktp;
    }

    public function edit($id)
    {
        $this->transaksii = Transaksi::find($id);

        $this->kendaraan_id = $this->transaksii->kendaraan_id;
        $this->pengguna_id = $this->transaksii->user_id;
        $this->lama_sewa = $this->transaksii->lama_sewa;
        $this->pembayaran = $this->transaksii->pembayaran;
        $this->status = $this->transaksii->status;
    }

    public function update()
    {
        $this->validate();

        $harga_sewaa = Kendaraan::find($this->kendaraan_id)?->harga_sewa;
        $total_hargaa = $this->lama_sewa * $harga_sewaa;
        if ($this->ktp != null) {
            $filename = $this->ktp->hashName();
            $this->ktp->storeAs('pengguna/ktp/', $filename, 'public');
            Transaksi::where('id', $this->transaksii->id)->update([
                'kendaraan_id' => $this->kendaraan_id,
                'user_id' => $this->pengguna_id,
                'lama_sewa' => $this->lama_sewa,
                'pembayaran' => $this->pembayaran,
                'status' => $this->status,
                'total_harga' => $total_hargaa,
                'ktp' => $filename
            ]);
        } else {
            Transaksi::where('id', $this->transaksii->id)->update([
                'kendaraan_id' => $this->kendaraan_id,
                'user_id' => $this->pengguna_id,
                'lama_sewa' => $this->lama_sewa,
                'pembayaran' => $this->pembayaran,
                'status' => $this->status,
                'total_harga' => $total_hargaa
            ]);
        }

        toastr()->success('Transaksi berhasil diperbarui');
        return redirect('/transaksi');
        // $this->dispatch('edited');
    }

    public function selesai($id)
    {
        Transaksi::find($id)->update([
            'status' => 'selesai'
        ]);
        toastr()->success('Kendaraan selesai disewa');
        return redirect('/transaksi');
    }

    public function delete($id)
    {
        $kendaraan = Transaksi::find($id);
        $kendaraan->delete();
        toastr()->success('Transaksi berhasil di hapus');
        return redirect('/transaksi');
        // $this->dispatch('deleted');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetInput()
    {
        $this->reset();
        $this->dispatch('reseted');
    }
}
