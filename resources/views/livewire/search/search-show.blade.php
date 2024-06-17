<div>
    <!-- Search -->

    <form class="nav-link form-inline mt-2 mt-md-0 d-flex p-2  justify-content-between">
        <div class="input-group mr-2">
            <input type="date" class="form-control" wire:model.blur='fecha_inicio' placeholder="Search" />
            <div class="input-group-append">
                <span class="input-group-text">
                    <!-- <i class="mdi mdi-magnify"></i> -->
                </span>
            </div>
        </div>
        <div class="input-group">
            <input type="date" wire:model.blur='fecha_fin' class="form-control" placeholder="Search" />
            <div class="input-group-append">
                <span class="input-group-text">
                    <!-- <i class="mdi mdi-magnify"></i> -->
                </span>
            </div>
        </div>
        <div class="input-group ml-2">

            <button type="button" wire:click='search' class="btn btn-primary btn-rounded btn-icon">
                <i class="mdi mdi-account-search-outline" style="color: #f2f2f2;"></i>
            </button>
        </div>
    </form>
    <!-- Button trigger modal -->

    @if($open_modal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show" id="exampleModal" style="padding-right: 17px; display: block;" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar al stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" wire:click="$set('open_modal', false);">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="list-group" id="list-tab" role="tablist">
                                    @if ($retiros->count() > 0)
                                        @foreach ($retiros as $retiro)
                                        <tr>
                                            <td>{{ $retiro->id }}</td>
                                            <td>{{ $retiro->artificio_id }}</td>
                                            <td>{{ $retiro->cantidad_retirada }}</td>
                                            <td>{{ $retiro->lugar_destino }}</td>
                                            <td>{{ $retiro->created_at }}</td>
                                        </tr>
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

                    <button type="button" class="btn btn-secondary"
                        wire:click="$set('open_modal', false);">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="" wire:loading.attr="disabled"
                        wire:loading.class="d-none">¡Guardar!</button>
                    <button class="btn btn-primary" type="button" disabled wire:loading wire:target="">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>

                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal -->

</div>