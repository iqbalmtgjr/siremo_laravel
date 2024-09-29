<div>
    <div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="app-content-header">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="mb-0">Masukan Kritik dan Saran</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="app-content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <div class="d-flex justify-content-between align-items-center px-3 pt-3 m-2">
                                            <div class="input-group w-auto">
                                                <span class="input-group-text" id="basic-addon1"><i
                                                        class="bi bi-search"></i></span>
                                                <input type="text" wire:model.live.debounce.1000ms="search"
                                                    class="form-control" placeholder="Cari..." aria-label="Cari"
                                                    aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered m-2">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>pengguna</th>
                                                            <th>Kritik dan Saran</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($total > 0)
                                                            @foreach ($kritiks as $index => $kritik)
                                                                <tr wire:key="{{ $kritik->id }}" class="align-middle">
                                                                    <td>{{ $kritiks->firstItem() + $loop->index }}.
                                                                    </td>
                                                                    <td>{{ isset($kritik->user) ? $kritik->user->nama : '' }}
                                                                    </td>
                                                                    <td>{{ $kritik->saran }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td colspan="3" class="text-center">
                                                                    Tidak ada data ditemukan
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            {{ $kritiks->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
