<div>
    <div class="page-header flex-wrap">
        <h3 class="mb-0">Hola!, <b>{{ Auth::user()->name }}</b> <span
                class="pl-0 h12 pl-sm-2 text-muted d-inline-block">Esta sección permite retirar artificios del
                stock.</span>
        </h3>


        @livewire('retiro.pdf.retiros-export')
    </div>

    <!-- INDICADORES -->
    @livewire('retiro.indicadores-show')

    <div class="row">

        <!-- Formulario de retiro -->
        <div class="col-md-8 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Formulario de retiro</h4>
                    <!-- <p class="card-description">Basic form layout</p> -->
                    <form class="forms-sample row g-6" wire:submit.prevent="submit">
                        <div style="margin-left: 0; justify-content: left" class="d-flex form-group col-12">
                            <div class="form-check mr-3 form-check-flat form-check-primary">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optionsRadios"> Jornada <i
                                        class="input-helper"></i>
                                </label>
                            </div>
                            <div class="form-check mr-3 form-check-flat form-check-primary">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optionsRadios"> Coordinación <i
                                        class="input-helper"></i>
                                </label>
                            </div>
                            <div class="form-check mr-3 form-check-flat form-check-primary">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optionsRadios"> Persona con
                                    discapacidad <i class="input-helper"></i>
                                </label>
                            </div>
                            <div class="form-check mr-3 form-check-flat form-check-primary">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="optionsRadios"> Ente<i
                                        class="input-helper"></i>
                                </label>
                            </div>
                        </div>


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

                        {{-- <div class="form-group col-12 " wire:target="artificiosDisponibles"
                            wire:loading.attr="disabled" wire:loading.class="d-none">
                            <label disabled>Nombre del beneficiario </label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-12 " wire:target="artificiosDisponibles" wire:loading.attr="disabled"
                            wire:loading.class="d-none">
                            <label disabled>Cedula del beneficiario </label>
                            <input type="text" class="form-control">
                        </div> --}}
                        <div class="form-group col-12">
                            <label for="exampleInputEmail1">Artificio a retirar</label>

                            <select class="form-control" wire:model="artificio_retiro"
                                wire:change="artificiosDisponibles($event.target.value)" id="exampleSelectGender">
                                <option value="" selected>Seleccionar</option>
                                @foreach($artificios as $artificio)
                                <option value="{{$artificio->id}}">{{$artificio->name}}</option>
                                @endforeach

                            </select>




                            <x-input-error for="id" style="color:red"></x-input-error>
                        </div>
                        <div class="form-group col-12" wire:loading wire:target="artificiosDisponibles">
                            <div class="spinner-border  spinner-border-sm text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="form-group col-12 " wire:target="artificiosDisponibles" wire:loading.attr="disabled"
                            wire:loading.class="d-none">
                            <label disabled>Cantidad disponible en stock </label>
                            <input type="text" disabled wire:model.blur="cantidad" readonly class="form-control">
                        </div>
                        <div class="form-group col-12">
                            <label for="exampleInputPassword1">Cantidad a retirar</label>
                            <input type="text" class="form-control" wire:model="retiro_cantidad"
                                id="exampleInputPassword1" placeholder="Ej: 20">
                        </div>




                        <div class="col-12">

                            <button class="btn btn-primary mr-2" wire:click.prevent="retiro"
                                wire:loading.attr="disabled" wire:loading.class="d-none"> ¡Hacer retiro! </button>
                            <button class="btn btn-primary" type="button" disabled wire:loading wire:target="retiro">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>

                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- RETIROS -->
        <div class="col-md-4 col-sm-6 grid-margin stretch-card">
            @livewire('retiro.retiro-historial')
        </div>
    </div>
</div>