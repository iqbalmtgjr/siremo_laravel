<?php

namespace App\Livewire\Riwayat;

use App\Models\User;
use Livewire\Component;
use App\Models\Kendaraan;
use App\Models\Transaksi;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;

class IndexRiwayat extends Component
{
    use WithPagination;

    public $paginate = 10;
    public $search;
    public $total;

    public $riwayat;

    #[Validate('required')]
    public $pembayaran;

    public $tgl_awal;

    // #[Validate('required', as: 'Tanggal Akhir')]
    public $tgl_akhir;


    #[On('filtered')]
    public function render()
    {
        // dd($this->tgl_awal, $this->tgl_akhir);
        if (empty($this->tgl_awal) || empty($this->tgl_akhir)) {
            $transaksi = Transaksi::where('status', 'selesai')
                ->where('mitra_id', auth()->user()->mitra_id)
                ->orderBy('id', 'DESC')
                ->paginate($this->paginate);

            $total = Transaksi::where('status', 'selesai')->where('mitra_id', auth()->user()->mitra_id)->get()->count();
            // dd($total);
        } elseif ($this->tgl_awal == $this->tgl_akhir) {
            // dd('ahai');
            $transaksi = Transaksi::where('status', 'selesai')
                ->where('mitra_id', auth()->user()->mitra_id)
                ->whereDate('created_at', $this->tgl_awal)
                ->orderBy('id', 'DESC')
                ->paginate($this->paginate);

            $total = Transaksi::where('status', 'selesai')
                ->where('mitra_id', auth()->user()->mitra_id)
                ->whereDate('created_at', $this->tgl_awal)
                ->get()->count();
        } else {
            $transaksi = Transaksi::where('status', 'selesai')
                ->where('mitra_id', auth()->user()->mitra_id)
                ->whereDate('created_at', '>=', $this->tgl_awal)
                ->whereDate('created_at', '<=', $this->tgl_akhir)
                ->orderBy('id', 'DESC')
                ->paginate($this->paginate);

            $total = Transaksi::where('status', 'selesai')
                ->where('mitra_id', auth()->user()->mitra_id)
                ->whereDate('created_at', '>=', $this->tgl_awal)
                ->whereDate('created_at', '<=', $this->tgl_akhir)
                ->get()->count();
        }

        // dd($total);

        return view(
            'livewire.riwayat.index-riwayat',
            [
                'transaksis'  => $transaksi,
                'total' => $total,
            ]
        );
    }

    public function filter()
    {
        $this->validate([
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date|after_or_equal:tgl_awal',
        ], [
            'tgl_awal.required' => 'Tanggal awal harus diisi',
            'tgl_akhir.required' => 'Tanggal akhir harus diisi',
            'tgl_akhir.after_or_equal' => 'Tanggal akhir harus lebih atau sama dengan tanggal awal',
        ]);

        $this->dispatch('filtered');
    }

    public function edit($id)
    {
        $this->riwayat = Transaksi::find($id);

        $this->pembayaran = $this->riwayat->pembayaran;
    }

    public function update()
    {
        $this->validate();
        $this->riwayat->update([
            'pembayaran' => $this->pembayaran
        ]);

        toastr()->success('Status pembayaran berhasil diperbarui');
        return redirect('/riwayat');
    }
}
