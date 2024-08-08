<div>
    <!-- Search -->

    <form class="nav-link form-inline mt-md-0 d-flex flex-nowrap justify-content-between">
        <div class="input-group mr-2 mb-2 mb-md-0 w-4">
            <input type="date" class="form-control" wire:model.blur="fecha_inicio" placeholder="Search">
            <div class="input-group-append">
                <span class="input-group-text">
                    <!-- <i class="mdi mdi-magnify"></i> -->
                </span>
            </div>
        </div>
        <div class="input-group mb-2 mb-md-0">
            <input type="date" wire:model.blur="fecha_fin" class="form-control " placeholder="Search">
            <div class="input-group-append">
                <span class="input-group-text">
                    <!-- <i class="mdi mdi-magnify"></i> -->
                </span>
            </div>
        </div>
        <div class="input-group ml-2">
            <button type="button" wire:click="search" class="btn btn-primary btn-rounded btn-icon">
                <i wire:loading.attr="disabled" wire:target="search" wire:loading.class="d-none" class="mdi mdi-account-search-outline" style="color: #f2f2f2;"></i>
                <div class="d-flex justify-content-center" wire:loading="" wire:target="search">
                    <div wire:loading="" wire:target="search" class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                </div>
            </button>
        </div>
    </form>
    <!-- Button trigger modal -->



    @if($open_modal)
    <div class="modal-backdrop fade show"></div>



    <div class="modal fade show" id="exampleModal" style="padding-right: 17px; display: block;" aria-modal="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Busqueda de registros</h5>
                    <button type="button" class="close" wire:click="close_modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="list-group">
                                    @if ($retiros->count() > 0)
                                    @foreach ($retiros as $retiro)
                                    <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Retiro de ID: # {{$retiro->id}}</h5>
                                            <small class="text-warning">{{ $retiro->cantidad_retirada }}
                                                {{$retiro->artificio->name}} </small>
                                        </div>
                                        <p class="mb-1">El dia {{ $retiro->created_at }} se retiró {{
                                            $retiro->cantidad_retirada }} {{$retiro->artificio->name}} con destino a {{
                                            $retiro->coordinacion->name_coordinacion ?? $retiro->beneficiario->nombre ?? $retiro->jornada->descripcion }}</p>
                                            <small>
                                                <button type="button" class="btn btn-sm btn-outline-info btn-icon-text" wire:click="exportOnly({{$retiro->id}})"> Imprimir <i class="mdi mdi-printer btn-icon-append"></i></button>
                                            </small>
                                    </a>
                                    @endforeach
                                    @endif

                                </div>

                                {{-- <div class="col-8">
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                                            aria-labelledby="list-home-list">...</div>
                                        <div class="tab-pane fade" id="list-profile" role="tabpanel"
                                            aria-labelledby="list-profile-list">...</div>
                                        <div class="tab-pane fade" id="list-messages" role="tabpanel"
                                            aria-labelledby="list-messages-list">...</div>
                                        <div class="tab-pane fade" id="list-settings" role="tabpanel"
                                            aria-labelledby="list-settings-list">...</div>
                                    </div>
                                </div> --}}
                            </div>



                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" wire:click="close_modal">Close</button>

                    <button wire:click="export" type="button" wire:loading.attr="disabled" wire:loading.class="d-none" class="btn btn-primary btn-icon-text"> Imprimir todo <i class="mdi mdi-printer btn-icon-append"></i>
                    </button>
                    <button wire:loading wire:target="export" type="button" class="btn btn-primary btn-icon-text"> Imprimir todo
                        <div class="spinner-border spinner-border-sm text-white" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>


                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal -->

</div>