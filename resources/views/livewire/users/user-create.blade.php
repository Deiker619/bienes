<div>
    <button type="button" class="btn btn-sm bg-success btn-icon-text text-white border ml-3"  wire:click="$set('open_edit', true)">
        <i class="mdi mdi-database-plus btn-icon-prepend"></i>
        Agregar nuevo usuario
    </button>


    @if($open_edit)
    <!-- Modal -->
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show" id="exampleModal" style="padding-right: 17px; display: block;" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar al stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" wire:click="$set('open_edit', false);" >×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Agregar al stock</h4>
                            <p class="card-description">Basic form layout</p>
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="exampleSelectGender">Ingresa el nombre de usuario</label>
                                    
                                    <x-input-error for="id" style="color:red"></x-input-error>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="text" class="form-control" wire:model="cantidad" placeholder="cantidad de artificio de este tipo">
                                    <x-input-error for="cantidad" style="color:red"></x-input-error>
                                </div>





                            </form>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('open_edit', false);">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="store" wire:loading.attr="disabled" wire:loading.class="d-none">Save changes</button>
                    <button class="btn btn-primary" type="button" disabled wire:loading wire:target="store" >
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
