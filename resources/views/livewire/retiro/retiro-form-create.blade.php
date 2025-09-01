<div>
    <div wire:init="$set('cargado', true)"></div>
    {{-- Mostrar Cargando mientras aún no se establece --}}
    <div wire:loading wire:target="$set">
        Cargando...
    </div>
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
                    @if($cargado)
                    <form class="forms-sample row g-6" wire:submit.prevent="retiro">
                        {{-- Lista de input's radio --}}

                        <div style="margin-left: 0; justify-content: left" class=" form-group col-12 row">
                            <div class="form-check mr-3 form-check-flat form-check-primary">

                                <label class="form-check-label" {{ $errors->has('destino') ? 'style=color:red' : '' }}>
                                    <input type="radio" class="form-check-input " @checked(false)
                                        wire:target="render,changeDestino" wire:loading.attr="disabled"
                                        wire:change="changeDestino($event.target.value)" value="jornada_retiro"
                                        name="optionsRadios"> Jornada <i class="input-helper"></i>
                                </label>
                            </div>
                            <div class="form-check mr-3 form-check-flat form-check-primary">
                                <label class="form-check-label" {{ $errors->has('destino') ? 'style=color:red' : '' }}>
                                    <input type="radio" class="form-check-input" @checked(false)
                                        wire:target="render,changeDestino" wire:loading.attr="disabled"
                                        wire:change="changeDestino($event.target.value)" value="coordinacion_retiro"
                                        name="optionsRadios"> Coordinación <i class="input-helper"></i>
                                </label>

                            </div>
                            <div class="form-check mr-3 form-check-flat form-check-primary">
                                <label class="form-check-label" {{ $errors->has('destino') ? 'style=color:red' : '' }}>
                                    <input type="radio" class="form-check-input" @checked(false)
                                        wire:target="render,changeDestino" wire:loading.attr="disabled"
                                        wire:change="changeDestino($event.target.value)" value="beneficiario_retiro"
                                        name="optionsRadios"> Beneficiario <i class="input-helper"></i>

                                </label>


                            </div>


                        </div>





                        @if ($destino == 'coordinacion_retiro')

                        <div class="form-group col-12">
                            <label for="corrdinacion">Coordinación de destino</label>
                            <select class="form-control" id="corrdinacion" wire:model="coordinacion_retiro">
                                <option value="" selected>Seleccionar</option>
                                @foreach ($coordinaciones as $coordinacion)
                                <option value="{{ $coordinacion->id }}">{{ $coordinacion->name_coordinacion }}
                                </option>
                                @endforeach

                            </select>
                            <x-input-error for="coordinacion_retiro" style="color:red"></x-input-error>

                        </div>
                        @endif

                        @if ($destino == 'beneficiario_retiro')
                        <div class="form-group col-12 " wire:target="artificiosDisponibles" wire:loading.attr="disabled"
                            wire:loading.class="d-none">
                            <label disabled>Nombre y apellido del beneficiario </label>
                            <input type="text" wire:model.blur="beneficiario_nombre" class="form-control"
                                placeholder="ej: Luis Pereira">
                            <x-input-error for="beneficiario_nombre" style="color:red"></x-input-error>
                        </div>
                        <div class="form-group col-12 " wire:target="artificiosDisponibles" wire:loading.attr="disabled"
                            wire:loading.class="d-none">
                            <label disabled>Cédula de beneficiario </label>
                            <input type="text" wire:model.blur="beneficiario_cedula" class="form-control"
                                placeholder="Sin puntos ni letas">
                            <x-input-error for="beneficiario_cedula" style="color:red"></x-input-error>
                        </div>
                        @endif
                        @if ($destino == 'jornada_retiro')
                        <div class="form-group col-12 " wire:target="artificiosDisponibles" wire:loading.attr="disabled"
                            wire:loading.class="d-none">
                            <label disabled> Fecha de la jornada </label>
                            <input type="date" wire:model.blur="jornada_fecha" class="form-control">
                            <x-input-error for="jornada_fecha" style="color:red"></x-input-error>
                        </div>
                        <div class="form-group col-12 " wire:target="artificiosDisponibles" wire:loading.attr="disabled"
                            wire:loading.class="d-none">
                            <label disabled>Descripción de la jornada </label>
                            <input type="text" wire:model.blur="jornada_descripcion"
                                placeholder="Breve descripción de la jornada" class="form-control">
                            <x-input-error for="jornada_descripcion" style="color:red"></x-input-error>
                        </div>
                        @endif
                        @if ($destino == 'ente_retiro')
                        <div class="form-group col-12 " wire:target="artificiosDisponibles" wire:loading.attr="disabled"
                            wire:loading.class="d-none">
                            <label disabled>Descripción de la entrega </label>
                            <input type="text" wire:model.blur="" placeholder="Breve descripción de la entrega"
                                class="form-control">
                        </div>
                        @endif




                        <div class="col-12">
                            @foreach ($artificiosRetiro as $index => $registro)
                            <div class="border rounded p-3 mb-3">
                                <!-- Selector de artificio -->
                                <div class="mb-3 form-group">
                                    <label for="artificioSelect{{ $index }}">Artificio a retirar</label>
                                    <select id="artificioSelect{{ $index }}" class="form-control"
                                        wire:model="artificiosRetiro.{{ $index }}.artificio_retiro"
                                        wire:change="artificiosDisponibles($event.target.value, {{ $index }})">
                                        <option value="" selected>Seleccionar</option>
                                        @foreach ($artificios as $artificio)
                                        <option value="{{ $artificio->id }}">{{ $artificio->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="artificiosRetiro.{{ $index }}.artificio_retiro"
                                        class="text-danger" />
                                </div>

                                <!-- Spinner -->
                                <div class="mb-3" wire:loading wire:target="artificiosDisponibles">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        
                                    </div>
                                </div>

                                <!-- Stock disponible -->
                                <div class="mb-3 form-group">
                                    <label class="form-label">Cantidad disponible en stock</label>
                                    <input type="text" class="form-control"
                                        wire:model.blur="artificiosRetiro.{{ $index }}.cantidad" readonly disabled>
                                </div>

                                <!-- Cantidad a retirar -->
                                <div class="mb-3 form-group">
                                    <label for="retiroCantidad{{ $index }}" class="form-label">Cantidad a
                                        retirar</label>
                                    <input id="retiroCantidad{{ $index }}" type="text" class="form-control"
                                        wire:model.blur="artificiosRetiro.{{ $index }}.retiro_cantidad"
                                        placeholder="Ej: 20">
                                    <x-input-error for="artificiosRetiro.{{ $index }}.retiro_cantidad"
                                        class="text-danger" />
                                </div>

                                <!-- Botón eliminar -->
                                <button type="button" class="btn btn-danger btn-sm"
                                    wire:click="removeRegistro({{ $index }})">
                                    Eliminar
                                </button>
                            </div>
                            @endforeach

                            <!-- Botón agregar -->
                            <div class="text-center mt-3">
                                <button type="button" class="btn btn-secondary" wire:click="addRegistro">
                                    Agregar nuevo registro
                                </button>
                            </div>
                        </div>


                        {{-- <div class="d-flex justify-content-center align-items-center m-20 w-100" style="h">
                            <button type="button" class="btn btn-secondary">Agregar más artificios</button>
                        </div> --}}







                        <div class="form-group col-12">
                            <label for="exampleInputPassword1">Observación</label>
                            <textarea class="form-control" id="exampleInputPassword1" wire:model.blur='observacion'
                                placeholder="Ej: descripción del retiro"></textarea>
                            <x-input-error for="retiro_cantidad" style="color:red"></x-input-error>
                        </div>
                        <div style="margin-left: 0; justify-content: left" class=" form-group col-12 ">
                            <div class="form-check">
                                <label class="form-check-label" {{ $errors->has('destino') ? 'style=color:red' : '' }}>
                                    <input type="checkbox" class="form-control" wire:click='changeRecibeTercero()'
                                        wire:loading.attr="disabled" name="optionsRadios" value="1">
                                    Recibe un tercero <i class="input-helper"></i>
                                </label>
                            </div>
                        </div>
                        @if ($recibe_tercero)
                        <div class="form-group col-12">
                            <label for="nombre_tercero" {{ $errors->has('nombre_tercero') ? 'style=color:red' : ''
                                }}>Nombre del tercero que recibe</label>
                            <input type="text" class="form-control" wire:model.blur="nombre_tercero"
                                name="nombre_tercero">
                        </div>
                        <div class="form-group col-12">
                            <label for="cedula_tercero">Cédula del tercero que recibe</label>
                            <input type="text" class="form-control" wire:model.defer="cedula_tercero"
                                name="cedula_tercero">
                        </div>
                        @endif




                        <div class="col-12">

                            <button class="btn btn-primary mr-2" wire:click.prevent="retiro"
                                wire:loading.attr="disabled" wire:loading.class="d-none"> ¡Hacer retiro! </button>
                            <button class="btn btn-primary" type="button" disabled wire:loading wire:target="retiro">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>

                        </div>

                    </form>

                    @else
                    <div class="d-flex justify-content-center align-items-center h-100 w-100">
                        Cargando...
                    </div>


                    @endif

                </div>
            </div>
        </div>

        <!-- RETIROS -->
        <div class="col-md-4 border col-sm-6 grid-margin stretch-card">
            @livewire('retiro.retiro-historial')
        </div>
    </div>
</div>