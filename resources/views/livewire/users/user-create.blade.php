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
                            <h4 class="card-title">Crear nuevo usuario</h4>
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="exampleSelectGender">Nombre de usuario</label>
                                    <input type="text" class="form-control" wire:model.blur="name" placeholder="Nombre del usuario">
                                    <x-input-error for="name" style="color:red"></x-input-error>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" wire:model.blur="email" placeholder="email del usuario">
                                    <x-input-error for="email" style="color:red"></x-input-error>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Contraseña</label>
                                    <input type="password" class="form-control" wire:model.blur="password" placeholder="ingrese la contraseña de 8 caracteres o superior">
                                    <x-input-error for="password" style="color:red"></x-input-error>
                                </div>
                                <h4 class="card-title">Asignar rol</h4>
                                @foreach($roles as $rol )
                                <div class="form-check form-check-primary">
                                    <label class="form-check-label">
                                      <input type="radio" wire:model.blur="rol" value="{{$rol->id}}" class="form-check-input" name="ExampleRadio1" id="ExampleRadio1" checked=""> {{$rol->name}} <i class="input-helper"></i></label>
                                  </div>
                                  @endforeach
                                  <x-input-error for="rol" style="color:red"></x-input-error>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('open_edit', false);">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="store" wire:loading.attr="disabled" wire:loading.class="d-none">Registrar</button>
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
