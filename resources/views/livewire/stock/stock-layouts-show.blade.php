<div>
    <div class="page-header flex-wrap">
        <h3 class="mb-0">Hola!, <b>{{ Auth::user()->name }}</b> <span
                class="pl-0 h6 pl-sm-2 text-muted d-inline-block">Esta sección permite gestionar el stock.</span>
        </h3>
        <div class="d-flex">


            @can('Stock.store')
                @livewire('stock.strock-create')
            @endcan
            @livewire('stock.pdf.export')
            @can('Artificios.store')
                @livewire('artificios.artificios-create')
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Stock de artificios </h4>
                    <div class="card-description"></label class="d-flex justify-content-center align-items-center"> Total
                        de artificios: <label class="badge badge-info">{{ $suma }}</label> </div>
                    <div class="table-responsive">
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del artificio</th>
                                    <th>Cantidad</th>
                                    <th>Agregado</th>
                                    <th>Porcentaje</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($stocks as $index => $stock)
                                    <tr>
                                        <td class="py-1">
                                            {{ $stock->id }}
                                        </td>
                                        <td>{{ $stock->artificio->name }}</td>
                                        <td>
                                            <span
                                                class="badge badge-info text-white ml-3 rounded">{{ $stock->cantidad_artificio }}</span>
                                        </td>
                                        <td>{{ $stock->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="progress">

                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: <?php echo $total[$index] ?? 0; ?>%" aria-valuenow="25"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- <div class="badge badge-inverse-success"> Editar </div>
                                        <div class="badge badge-inverse-danger"> Eliminar </div> -->
                                            @can('Stock.destroy')
                                                <span class="dropdown dropleft d-block">
                                                    <span id="dropdownMenuButton1" data-toggle="dropdown" role="button"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <span><i class="mdi mdi-dots-vertical"
                                                                style="cursor: pointer"></i></span>
                                                    </span>
                                                    <span class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <a class="dropdown-item" wire:click="edit({{ $stock->id }})"
                                                            style="cursor: pointer">Editar</a>
                                                        <a class="dropdown-item" wire:click="delete({{ $stock->id }})"
                                                            style="cursor: pointer">Eliminar</a>
                                                    </span>
                                                </span>
                                            @endcan

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>


    </div>


    @if ($open_edit)
        <div class="modal-backdrop fade show"></div>
        <div class="modal fade show" id="exampleModal" style="padding-right: 17px; display: block;" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" wire:click="$set('open_edit', false);">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Editar stock</h4>

                                <form class="forms-sample">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Cantidad</label>
                                            <input type="text" class="form-control" wire:model="cantidad_artificio"
                                                id="exampleInputUsername1" placeholder="Ej: muletas">
                                            <x-input-error for="cantidad_artificio" style="color:red"></x-input-error>
                                        </div>
                                    </div>







                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            wire:click="$set('open_edit', false);">Close</button>
                        <button type="button" class="btn btn-primary" wire:click.prevent="update"
                            wire:loading.attr="disabled" wire:loading.class="d-none">Guardar cambios</button>
                        <button class="btn btn-primary" type="button" disabled wire:loading wire:target="update">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
