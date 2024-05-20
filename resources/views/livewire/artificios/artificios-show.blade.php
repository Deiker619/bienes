<div>
    <div class="page-header flex-wrap">
        <h3 class="mb-0">Hola!, <b>{{ Auth::user()->name }}</b> <span class="pl-0 h6 pl-sm-2 text-muted d-inline-block">Esta sección permite gestionar los artificios.</span>
        </h3>
        <div class="d-flex">

            <button type="button" class="btn btn-sm bg-white btn-icon-text border ml-3">
                <i class="mdi mdi-printer btn-icon-prepend"></i> Imprimir artificios
            </button>
            @livewire('artificios.artificios-create')
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Artificios registrados</h4>
                    <div class="table-responsive">
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del artificio</th>
                                    <th>Agregado</th>
                                    <th>Modificado</th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($artificios as $artificio)
                                <tr>
                                    <td class="py-1">
                                    {{$artificio->id}}
                                    </td>
                                    <td> {{$artificio->name}}</td>
                                    <td>
                                        {{$artificio->created_at}}
                                    </td>
                                    <td>{{$artificio->updated_at}}</td>

                                    <td>
                                        <!-- <div class="badge badge-inverse-success"> Editar </div>
                                        <div class="badge badge-inverse-danger"> Eliminar </div> -->
                                        <span class="dropdown dropleft d-block">
                                            <span id="dropdownMenuButton1" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <span><i class="mdi mdi-dots-vertical" style="cursor: pointer"></i></span>
                                            </span>
                                            <span class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <a class="dropdown-item" wire:click="" style="cursor: pointer">Editar</a>
                                                <a class="dropdown-item" href="#">Eliminar</a>
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