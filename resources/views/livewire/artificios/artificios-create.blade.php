<div>
    <button type="button" class="btn btn-sm bg-warning btn-icon-text  border ml-3" wire:click="$set('open_modal', true)">
        <i class="mdi mdi-shape-plus btn-icon-prepend"></i>
        Agregar nuevo artificio
    </button>

    @if($open_modal)
    <!-- Modal -->
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
                <form class="forms-sample" wire:submit="store">
                    <div class="modal-body">

                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Agregar nuevo artificio</h4>

                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Nombre del artificio</label>
                                            <input type="text" class="form-control" wire:model.blur="name" id="exampleInputUsername1" placeholder="Ej: muletas">
                                        </div>
                                        <x-input-error for="name" style="color:red"></x-input-error>
                                    </div>







                                
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" wire:click="$set('open_modal', false);">Close</button>
                        <button type="submit" class="btn btn-primary"  wire:loading.attr="disabled" wire:loading.class="d-none">¡Guardar!</button>
                        <button class="btn btn-primary" type="button" disabled wire:loading wire:target="store">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
