<?php

namespace App\Livewire\Kritik;

use Livewire\Component;
use App\Models\Kritiksaran;
use Livewire\WithPagination;

class IndexKritik extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

    public function render()
    {
        if ($this->search) {
            $kritiksaran = Kritiksaran::whereHas('user', function ($query) {
                $query->where('nama', 'LIKE', '%' . $this->search . '%');
            })->paginate(10);
        } else {
            $kritiksaran = Kritiksaran::paginate(10);
        }
        $total = Kritiksaran::all()->count();
        return view(
            'livewire.kritik.index-kritik',
            [
                'kritiks' => $kritiksaran,
                'total' => $total
            ]
        );
    }
}
