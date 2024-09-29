<?php

namespace App\Livewire\Hargasewa;

use App\Models\User;
use Livewire\Component;
use App\Models\Hargasewa;
use App\Models\Kendaraan;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class IndexHargaSewa extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $kendaraans, $total, $paginate = 10;

    public $search;
    public $kendaraan;

    #[Rule('required', as: 'Kendaraan')]
    public $kendaraan_id;

    #[Rule('required', as: 'Harga Sewa')]
    public $harga_sewa;

    #[On('updateModal')]
    public function render()
    {
        $this->total = Hargasewa::all()->count();
        $this->kendaraans = Kendaraan::where('mitra_id', auth()->user()->mitra_id)
            ->where('status', 'Tersedia')
            ->get();

        return view(
            'livewire.hargasewa.index-harga-sewa',
            [
                'hargasewis'  => $this->search === null ?
                    Hargasewa::paginate($this->paginate) :
                    Hargasewa::where(function ($query) {
                        $query->where('merk', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('tipe', 'LIKE', '%' . $this->search . '%');
                    })->paginate($this->paginate),
                'kendaraans' => $this->kendaraans,
                'total' => $this->total
            ]
        );
    }

    public function store()
    {
        $this->validate();
        Hargasewa::create([
            'kendaraan_id' => $this->kendaraan_id,
            'harga' => $this->harga_sewa,
        ]);

        toastr()->success('Harga Sewa berhasil ditambahkan');
        return redirect('/hargasewa');
        // $this->reset();
        // $this->dispatch('created');
    }

    public function edit($id)
    {
        $this->kendaraan = Hargasewa::find($id);
        // dd($this->kendaraan->harga);
        $this->kendaraan_id = $this->kendaraan->kendaraan_id;
        $this->harga_sewa = Hargasewa::find($id)->harga;
    }

    public function update()
    {
        $this->validate();
        $this->kendaraan->update([
            'kendaraan_id' => $this->kendaraan_id,
            'harga' => $this->harga_sewa,
        ]);

        toastr()->success('Harga sewa berhasil diperbarui');
        return redirect('/hargasewa');
        // $this->dispatch('edited');
    }

    public function delete($id)
    {
        $kendaraan = Hargasewa::find($id);
        $kendaraan->delete();
        toastr()->success('Harga sewa berhasil di hapus');
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
