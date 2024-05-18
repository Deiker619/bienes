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
                <div class="modal-body">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Agregar nuevo artificio</h4>
                            
                            <form class="forms-sample">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Nombre del artificio</label>
                                        <input type="text" class="form-control" wire:model="name" id="exampleInputUsername1" placeholder="Ej: muletas">
                                    </div>
                                    <x-input-error for="id" style="color:red"></x-input-error>
                                </div>







                            </form>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('open_modal', false);">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="store">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>