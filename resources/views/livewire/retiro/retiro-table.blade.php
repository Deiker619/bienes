<div>
    <div class="page-header flex-wrap">
        <h3 class="mb-0">Hola!, <b>{{ Auth::user()->name }}</b> <span class="pl-0 h6 pl-sm-2 text-muted d-inline-block">Esta sección permite gestionar el stock.</span>
        </h3>
        <div class="d-flex">


            @livewire('stock.strock-create')
            <button type="button" class="btn btn-sm bg-white btn-icon-text border ml-3">
                <i class="mdi mdi-printer btn-icon-prepend"></i> Imprimir stock
            </button>
            @livewire('artificios.artificios-create')
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Stock de artificios </h4>
                    <div class="card-description"></label class="d-flex justify-content-center align-items-center"> Total de artificios: <label class="badge badge-info">{{$suma}}</label> </div>
                    <div class="table-responsive">
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del artificio</th>
                                    <th>Cantidad retirada</th>
                                    <th>Coordinación</th>
                                    <th>Fecha de retiro</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($stocks as $index => $stock)
                                <tr>
                                    <td class="py-1">
                                        {{$stock->id}}
                                    </td>
                                    <td>{{$stock->artificio->name}}</td>
                                    <td>
                                        <span class="badge badge-info text-white ml-3 rounded">{{$stock->cantidad_artificio}}</span>
                                    </td>
                                    <td>{{$stock->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="progress">

                                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $total[$index] ?? 0 ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- <div class="badge badge-inverse-success"> Editar </div>
                                        <div class="badge badge-inverse-danger"> Eliminar </div> -->
                                        <span class="dropdown dropleft d-block">
                                            <span id="dropdownMenuButton1" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                <span><i class="mdi mdi-dots-vertical" style="cursor: pointer"></i></span>
                                            </span>
                                            <span class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <a class="dropdown-item" wire:click="edit({{$stock->id}})" style="cursor: pointer">Editar</a>
                                                <a class="dropdown-item" wire:click="delete({{$stock->id}})" style="cursor: pointer">Eliminar</a>
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