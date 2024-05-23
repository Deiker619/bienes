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
                                    <th>Cantidad</th>
                                    <th>Agregado</th>
                                    <th>Porcentaje</th>
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

                                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $total[$index]??0 ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                                                <a class="dropdown-item" wire:click="delete({{$stock->id}})" style="cursor: pointer" >Eliminar</a>
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
    <!-- <div class="row">

        <div class="col-xl-12 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        <span class="d-flex justify-content-between">
                            <span>Actividad</span>
                            <span class="dropdown dropleft d-block">
                                <span id="dropdownMenuButton1" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <span><i class="mdi mdi-dots-horizontal"></i></span>
                                </span>
                                <span class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <a class="dropdown-item" href="#">Contact</a>
                                    <a class="dropdown-item" href="#">Helpdesk</a>
                                    <a class="dropdown-item" href="#">Chat with us</a>
                                </span>
                            </span>
                        </span>
                    </h4>
                    <ul class="gradient-bullet-list border-bottom">
                        <li>
                            <h6 class="mb-0"> It's awesome when we find a new solution </h6>
                            <p class="text-muted">2h ago</p>
                        </li>
                        <li>
                            <h6 class="mb-0">Report has been updated</h6>
                            <p class="text-muted">
                                <span>2h ago</span>
                                <span class="d-inline-block">
                                    <span class="d-flex d-inline-block">
                                        <img class="ml-1" src="assets/images/faces/face1.jpg" alt="">
                                        <img class="ml-1" src="assets/images/faces/face10.jpg" alt="">
                                        <img class="ml-1" src="assets/images/faces/face14.jpg" alt="">
                                    </span>
                                </span>
                            </p>
                        </li>
                        <li>
                            <h6 class="mb-0"> Analytics dashboard has been created#Slack </h6>
                            <p class="text-muted">2h ago</p>
                        </li>
                        <li>
                            <h6 class="mb-0"> It's awesome when we find a new solution </h6>
                            <p class="text-muted">2h ago</p>
                        </li>
                    </ul>
                    <a class="text-black mt-3 mb-0 d-block h6" href="#">View all <i class="mdi mdi-chevron-right"></i></a>
                </div>
            </div>
        </div>
        
    </div> -->

    @if($open_edit)
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
                            <h4 class="card-title">Editar stock</h4>

                            <form class="forms-sample">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Cantidad</label>
                                        <input type="text" class="form-control" wire:model="cantidad_artificio" id="exampleInputUsername1" placeholder="Ej: muletas">
                                        <x-input-error for="cantidad_artificio" style="color:red"></x-input-error>
                                    </div>
                                </div>







                            </form>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('open_edit', false);">Close</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="update" wire:loading.attr="disabled" wire:loading.class="d-none">Guardar cambios</button>
                    <button class="btn btn-primary" type="button" disabled wire:loading wire:target="update">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>