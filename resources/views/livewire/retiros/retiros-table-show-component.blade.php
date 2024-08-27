<div>
    
    <div class="row">
        <div class="col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Retiros del stock</h4>
                    <div class="table-responsive">
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Artificio</th>
                                    <th>Cantidad retirada</th>
                                    <th>Persona/Coordinacion/jornada entregada</th>
                                    <th>Tipo de ente</th>
                                    <th>Fecha de retiro del stock</th>
                                    <th></th>

                                </tr>
                            </thead>
                            <tbody>



                                @foreach($retiros as $retiro)
                                <tr>
                                    <td class="py-1">
                                        {{$retiro->id}}
                                    </td>
                                    <td> {{$retiro->artificio->name}}</td>
                                    <td>{{$retiro->cantidad_retirada}}</td>
                                    @switch(true)
                                    @case($retiro->coordinacion->name_coordinacion ?? false)
                                    @php
                                    $name = "Coordinación";
                                    @endphp
                                    @break

                                    @case($retiro->beneficiario->nombre ?? false)
                                    @php
                                    $name = "Beneficiario";
                                    @endphp
                                    @break

                                    @case($retiro->jornada->descripcion ?? false)
                                    @php
                                    $name = "jornada";
                                    @endphp
                                    @break
                                    @endswitch
                                    <td>
                                        {{$retiro->coordinacion->name_coordinacion ?? $retiro->beneficiario->nombre ??
                                        $retiro->jornada->descripcion }}
                                    </td>
                                    <td>
                                        <label class="badge badge-info">{{$name}}</label>
                                    </td>

                                    <td>
                                        {{$retiro->created_at}}
                                    </td>

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
                                                <a class="dropdown-item" wire:click=""
                                                    style="cursor: pointer">Editar</a>
                                                <a class="dropdown-item" wire:click=""
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
</div>