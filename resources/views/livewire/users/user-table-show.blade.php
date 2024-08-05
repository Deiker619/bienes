<div>

    <div class="page-header flex-wrap">
        <h3 class="mb-0">Hola!, <b>{{ Auth::user()->name }}</b> <span
                class="pl-0 h6 pl-sm-2 text-muted d-inline-block">Esta sección permite gestionar los usuarios.</span>
        </h3>
        <div class="d-flex">
            @can('Artificios.store')
                @livewire('users.user-create')
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Usuarios </h4>

                    <div class="table-responsive">
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del usuario</th>
                                    <th>Email</th>
                                    <th>Agregado</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($usuarios as $index => $user)
                                    <tr>
                                        <td class="py-1">
                                            {{ $user->id }}
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>{{ $user->created_at->format('d/m/Y') }}</td>

                                        <td>
                                            <!-- <div class="badge badge-inverse-success"> Editar </div>
                                        <div class="badge badge-inverse-danger"> Eliminar </div> -->
                                            <span class="dropdown dropleft d-block">
                                                <span id="dropdownMenuButton1" data-toggle="dropdown" role="button"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <span><i class="mdi mdi-dots-vertical"
                                                            style="cursor: pointer"></i></span>
                                                </span>
                                                <span class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <a class="dropdown-item" wire:click="edit({{ $user->id }})"
                                                        style="cursor: pointer">Editar</a>
                                                    <a class="dropdown-item" wire:click="editRoles({{ $user->id }})"
                                                        style="cursor: pointer">Asignar roles</a>
                                                    <a class="dropdown-item" wire:click="destroy({{ $user->id }})"
                                                        style="cursor: pointer">Eliminar</a>
                                                </span>
                                            </span>

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
                                <h4 class="card-title">Editar Usuario</h4>

                                <form class="forms-sample">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Nombre</label>
                                            <input type="text" class="form-control" wire:model="name"
                                                id="exampleInputUsername1" placeholder="Ej: muletas">
                                            <x-input-error for="cantidad_artificio" style="color:red"></x-input-error>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Email</label>
                                            <input type="text" class="form-control" wire:model="email"
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
    @if ($open_roles)
        <div class="modal-backdrop fade show"></div>
        <div class="modal fade show" id="exampleModal" style="padding-right: 17px; display: block;" aria-modal="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rol actual: <b> {{ $rol->name?? " " }}</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" wire:click="$set('open_roles', false);">×</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="card">
                            <div class="card-body">


                                <form class="forms-sample">
                                    <div class="form-group">

                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="radio" wire:model="r" class="form-check-input" name="ExampleRadio1" id="ExampleRadio1" value="1" checked=""> Administrador <i class="input-helper"></i></label>
                                          </div>
                                        <div class="form-check form-check-primary">
                                            <label class="form-check-label">
                                              <input type="radio" wire:model="r" class="form-check-input" name="ExampleRadio1" id="ExampleRadio1" value="2"> Analista <i class="input-helper"></i></label>
                                          </div>
                                        

                                    </div>





                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            wire:click="$set('open_roles', false);">Close</button>
                        <button type="button" class="btn btn-primary" wire:click.prevent="updateRoles"
                            wire:loading.attr="disabled" wire:loading.class="d-none">Guardar cambios</button>
                        <button class="btn btn-primary" type="button" disabled wire:loading wire:target="updateRoles">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
