<div>
    <!-- Search -->
    <form class="nav-link form-inline mt-md-0 d-flex flex-nowrap justify-content-between">
        <div class="input-group mr-2 mb-2 mb-md-0 w-4">
            <input type="date" class="form-control" wire:model.blur="fecha_inicio">
        </div>
        <div class="input-group mb-2 mb-md-0">
            <input type="date" wire:model.blur="fecha_fin" class="form-control">
        </div>
        <div class="ml-2">
            <button type="button" wire:click="search" class="btn btn-primary btn-rounded btn-icon">
                <i wire:loading.attr="disabled" wire:target="search" wire:loading.class="d-none" class="mdi mdi-account-search-outline" style="color: #f2f2f2;"></i>
                <div class="d-flex justify-content-center" wire:loading="" wire:target="search">
                    <div wire:loading="" wire:target="search" class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                </div>
            </button>
        </div>
    </form>

    @if($open_modal)
        <div class="modal-backdrop fade show"></div>

        <div class="modal fade show" id="exampleModal" style="padding-right: 17px; display: block;" aria-modal="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Búsqueda de registros</h5>
                        <button type="button" class="close" wire:click="close_modal" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="list-group">
                                    @if ($retiros && $retiros->count())
                                        @foreach ($retiros as $retiro)
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">Retiro #{{ $retiro->id }}</h5>
                                                    <small class="text-muted">{{ $retiro->created_at->format('d/m/Y H:i') }}</small>
                                                </div>

                                                {{-- Lista de artificios en varias líneas --}}
                                                <p class="mb-1">
                                                    {!! $retiro->retiro_artificios->map(function ($ra) {
                                                        return $ra->artificio->name . ' - ' . $ra->cantidad;
                                                    })->implode('<br>') !!}
                                                </p>

                                                {{-- Destino --}}
                                                <p class="mb-1">
                                                    <strong>Entregado a:</strong>
                                                    {{ $retiro->coordinacion->name_coordinacion
                                                        ?? $retiro->beneficiario->nombre
                                                        ?? $retiro->jornada->descripcion }}
                                                </p>

                                                <small>
                                                    <button type="button"
                                                        class="btn btn-sm btn-outline-info btn-icon-text"
                                                        wire:click="exportOnly({{ $retiro->id }})">
                                                        Imprimir <i class="mdi mdi-printer btn-icon-append"></i>
                                                    </button>
                                                </small>
                                            </a>
                                        @endforeach
                                    @else
                                        <p class="text-center text-muted">No se encontraron registros.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="close_modal">Cerrar</button>

                        <button wire:click="export" type="button"
                            wire:loading.attr="disabled" wire:loading.class="d-none"
                            class="btn btn-primary btn-icon-text">
                            Imprimir todo <i class="mdi mdi-printer btn-icon-append"></i>
                        </button>

                        
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
