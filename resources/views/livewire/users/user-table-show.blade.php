<div>

    <div class="page-header flex-wrap">
        <h3 class="mb-0">Hola!, <b>{{ Auth::user()->name }}</b> <span class="pl-0 h6 pl-sm-2 text-muted d-inline-block">Esta sección permite gestionar los usuarios.</span>
        </h3>
        <div class="d-flex">

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

                                @foreach($usuarios as $index => $user)
                                <tr>
                                    <td class="py-1">
                                        {{$user->id}}
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>
                                       {{$user->email}}
                                    </td>
                                    <td>{{$user->created_at->format('d/m/Y') }}</td>
                                    
                                    <td>
                                        <!-- <div class="badge badge-inverse-success"> Editar </div>
                                        <div class="badge badge-inverse-danger"> Eliminar </div> -->
                                        <span class="dropdown dropleft d-block">
                                            <span id="dropdownMenuButton1" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <span><i class="mdi mdi-dots-vertical" style="cursor: pointer"></i></span>
                                            </span>
                                            <span class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <a class="dropdown-item" wire:click="edit({{$user->id}})" style="cursor: pointer">Editar</a>
                                                <a class="dropdown-item" wire:click="delete({{$user->id}})" style="cursor: pointer" >Eliminar</a>
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
  
</div>