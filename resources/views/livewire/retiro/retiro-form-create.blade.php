<div>
    <div class="page-header flex-wrap">
        <h3 class="mb-0">Hola!, <b>{{ Auth::user()->name }}</b> <span class="pl-0 h12 pl-sm-2 text-muted d-inline-block">Esta sección permite retirar artificios del stock.</span>
        </h3>

    </div>

    <!-- INDICADORES -->
    <div class="row mb-4">
        <div class="col-sm-4">
            <div class="card mb-3 mb-sm-0">
                <div class="card-body py-3 px-4">
                    <p class="m-0 survey-head">Total artificios</p>
                    <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                        <div>
                            <h3 class="m-0 survey-value">5,300</h3>
                            <p class="text-success m-0">-310 avg. sales</p>
                        </div>
                        <div id="earningChart" class="flot-chart" style="padding: 0px;"><canvas class="flot-base" width="59" height="51" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 59.9844px; height: 51px;"></canvas><canvas class="flot-overlay" width="59" height="51" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 59.9844px; height: 51px;"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card mb-3 mb-sm-0 ">
                <div class="card-body py-3 px-4">
                    <p class="m-0 survey-head">Tipos artificios</p>
                    <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                        <div>
                            <h3 class="m-0 survey-value">9,100</h3>
                            <p class="text-danger m-0">-310 avg. sales</p>
                        </div>
                        <div id="productChart" class="flot-chart" style="padding: 0px;"><canvas class="flot-base" width="59" height="51" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 59.9844px; height: 51px;"></canvas><canvas class="flot-overlay" width="59" height="51" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 59.9844px; height: 51px;"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body py-3 px-4">
                    <p class="m-0 survey-head">Total retiros</p>
                    <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                        <div>
                            <h3 class="m-0 survey-value">4,354</h3>
                            <p class="text-success m-0">-310 avg. sales</p>
                        </div>
                        <div id="orderChart" class="flot-chart" style="padding: 0px;"><canvas class="flot-base" width="59" height="51" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 59.9844px; height: 51px;"></canvas><canvas class="flot-overlay" width="59" height="51" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 59.9844px; height: 51px;"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Formulario de retiro -->
        <div class="col-md-8 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Formulario de retiro</h4>
                    <!-- <p class="card-description">Basic form layout</p> -->
                    <form class="forms-sample row g-6" wire:submit.prevent="submit">
                        <div class="form-group col-12">
                            <label for="exampleInputUsername1">Coordinación de destino</label>
                            <select class="form-control" id="exampleSelectGender" wire:model="coordinacion_retiro">
                                <option value="" selected>Seleccionar</option>
                                @foreach($coordinaciones as $coordinacion)
                                <option value="{{$coordinacion->id}}">{{$coordinacion->name_coordinacion}}</option>
                                @endforeach
                                
                            </select>
                            <x-input-error for="id" style="color:red"></x-input-error>

                        </div>
                        <div class="form-group col-12">
                            <label for="exampleInputEmail1">Artificio a retirar</label>
                            <select class="form-control" wire:change="artificiosDisponibles($event.target.value)" id="exampleSelectGender" wire:model="id">
                                <option value="" selected>Seleccionar</option>
                                @foreach($artificios as $artificio)
                                    <option value="{{$artificio->id}}" >{{$artificio->name}}</option>
                                @endforeach

                            </select>
                
                            <x-input-error for="id" style="color:red"></x-input-error>
                        </div>
                        <div class="form-group col-12">
                            <label for="exampleInputConfirmPassword1">Cantidad disponible en stock </label>
                            <input type="text" wire:model.blur="cantidad" readonly class="form-control" id="exampleInputConfirmPassword1">
                        </div>
                        <div class="form-group col-12">
                            <label for="exampleInputPassword1">Cantidad a retirar</label>
                            <input type="text" class="form-control" wire:model="retiro_cantidad" id="exampleInputPassword1" placeholder="Ej: 20">
                        </div>
                        

                      

                        <div class="col-12">

                            <button  class="btn btn-primary mr-2" wire:click.prevent="retiro"> ¡Hacer retiro! </button>
                            <button class="btn btn-light">Cancel</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

        <!-- COORDINACIONES -->
        <div class="col-xl-4 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="card-title font-weight-medium"> Coordinaciones estadales </div>
                    <p class="text-muted"> Lorem ipsum dolor sitadipiscing elit, sed amet do eiusmod tempor we find a new solution </p>
                    <div class="d-flex flex-wrap border-bottom py-2 border-top justify-content-between">

                        <div class="pt-2">
                            <h5 class="mb-0">Coordinacion de Miranda</h5>
                            <p class="mb-0 text-muted">Miranda </p>
                            <h5 class="mb-0">$600/mo</h5>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap border-bottom py-2 justify-content-between">

                        <div class="pt-2">
                            <h5 class="mb-0">Coordinacion de Aragua</h5>
                            <p class="mb-0 text-muted">Aragua</p>
                            <h5 class="mb-0">$900/mo</h5>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap border-bottom py-2 justify-content-between">

                        <div class="pt-2">
                            <h5 class="mb-0">Coordinacion de Anzoategui</h5>
                            <p class="mb-0 text-muted">Anzoategui</p>
                            <h5 class="mb-0">$900/mo</h5>
                        </div>
                    </div>
                    <a class="text-black mt-3 d-block font-weight-medium h6" href="#">View all <i class="mdi mdi-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>