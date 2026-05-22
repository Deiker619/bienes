<div>

    <div class="page-header flex-wrap">
        <h3 class="mb-0">
            Hola!, <b>{{ Auth::user()->name }}</b>
            <span class="pl-0 h12 pl-sm-2 text-muted d-inline-block">
                Esta sección permite retirar artificios del stock.
            </span>
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

                    @if ($cargado)

                        <form class="forms-sample row g-6" wire:submit.prevent="retiro">

                            {{-- DESTINOS --}}
                            <div style="margin-left: 0; justify-content: left"
                                class="form-group col-12 row">

                                <div class="form-check mr-3 form-check-flat form-check-primary">

                                    <label class="form-check-label"
                                        {{ $errors->has('destino') ? 'style=color:red' : '' }}>

                                        <input
                                            type="radio"
                                            class="form-check-input"
                                            wire:target="render,changeDestino"
                                            wire:loading.attr="disabled"
                                            wire:change="changeDestino($event.target.value)"
                                            value="jornada_retiro"
                                            name="optionsRadios">

                                        Jornada
                                        <i class="input-helper"></i>

                                    </label>
                                </div>

                                <div class="form-check mr-3 form-check-flat form-check-primary">

                                    <label class="form-check-label"
                                        {{ $errors->has('destino') ? 'style=color:red' : '' }}>

                                        <input
                                            type="radio"
                                            class="form-check-input"
                                            wire:target="render,changeDestino"
                                            wire:loading.attr="disabled"
                                            wire:change="changeDestino($event.target.value)"
                                            value="coordinacion_retiro"
                                            name="optionsRadios">

                                        Coordinación
                                        <i class="input-helper"></i>

                                    </label>

                                </div>

                                <div class="form-check mr-3 form-check-flat form-check-primary">

                                    <label class="form-check-label"
                                        {{ $errors->has('destino') ? 'style=color:red' : '' }}>

                                        <input
                                            type="radio"
                                            class="form-check-input"
                                            wire:target="render,changeDestino"
                                            wire:loading.attr="disabled"
                                            wire:change="changeDestino($event.target.value)"
                                            value="beneficiario_retiro"
                                            name="optionsRadios">

                                        Beneficiario
                                        <i class="input-helper"></i>

                                    </label>

                                </div>

                            </div>

                            {{-- COORDINACION --}}
                            @if ($destino == 'coordinacion_retiro')

                                <div class="form-group col-12">

                                    <label for="corrdinacion">
                                        Coordinación de destino
                                    </label>

                                    <select
                                        class="form-control"
                                        id="corrdinacion"
                                        wire:model="coordinacion_retiro">

                                        <option value="" selected>
                                            Seleccionar
                                        </option>

                                        @foreach ($coordinaciones as $coordinacion)

                                            <option value="{{ $coordinacion->id }}">
                                                {{ $coordinacion->name_coordinacion }}
                                            </option>

                                        @endforeach

                                    </select>

                                    <x-input-error
                                        for="coordinacion_retiro"
                                        style="color:red">
                                    </x-input-error>

                                </div>

                            @endif

                            {{-- BENEFICIARIO --}}
                            @if ($destino == 'beneficiario_retiro')

                                <div class="form-group col-12">

                                    <label>
                                        Nombre y apellido del beneficiario
                                    </label>

                                    <input
                                        type="text"
                                        wire:model.blur="formBeneficiario.beneficiario_nombre"
                                        class="form-control"
                                        placeholder="ej: Luis Pereira">

                                    <x-input-error
                                        for="formBeneficiario.beneficiario_nombre"
                                        style="color:red">
                                    </x-input-error>

                                </div>

                                <div class="form-group col-12">

                                    <label>
                                        Cédula de beneficiario
                                    </label>

                                    <input
                                        type="text"
                                        wire:model.blur="formBeneficiario.beneficiario_cedula"
                                        class="form-control"
                                        placeholder="Sin puntos ni letras">

                                    <x-input-error
                                        for="formBeneficiario.beneficiario_cedula"
                                        style="color:red">
                                    </x-input-error>

                                </div>

                            @endif

                            {{-- JORNADA --}}
                            @if ($destino == 'jornada_retiro')

                                <div class="form-group col-12">

                                    <label>
                                        Fecha de la jornada
                                    </label>

                                    <input
                                        type="date"
                                        wire:model.blur="formJornada.jornada_fecha"
                                        class="form-control">

                                    <x-input-error
                                        for="formJornada.jornada_fecha"
                                        style="color:red">
                                    </x-input-error>

                                </div>

                                <div class="form-group col-12">

                                    <label>
                                        Descripción de la jornada
                                    </label>

                                    <input
                                        type="text"
                                        wire:model.blur="formJornada.jornada_descripcion"
                                        placeholder="Breve descripción de la jornada"
                                        class="form-control">

                                    <x-input-error
                                        for="formJornada.jornada_descripcion"
                                        style="color:red">
                                    </x-input-error>

                                </div>

                            @endif

                            {{-- ARTIFICIOS --}}
                            <div class="col-12">

                                @foreach ($artificiosRetiro as $index => $registro)

                                    <div class="border rounded p-3 mb-3">

                                        {{-- SELECT --}}
                                        <div class="mb-3 form-group">

                                            <label for="artificioSelect{{ $index }}">
                                                Artificio a retirar
                                            </label>

                                            <select
                                                id="artificioSelect{{ $index }}"
                                                class="form-control"
                                                wire:model="artificiosRetiro.{{ $index }}.artificio_retiro"
                                                wire:change="artificiosDisponibles($event.target.value, {{ $index }})">

                                                <option value="" selected>
                                                    Seleccionar
                                                </option>

                                                @foreach ($artificios as $artificio)

                                                    <option value="{{ $artificio->id }}">
                                                        {{ $artificio->name }}
                                                    </option>

                                                @endforeach

                                            </select>

                                            <x-input-error
                                                for="artificiosRetiro.{{ $index }}.artificio_retiro"
                                                class="text-danger" />

                                        </div>

                                        {{-- LOADING --}}
                                        <div class="mb-3"
                                            wire:loading
                                            wire:target="artificiosDisponibles">

                                            <div class="spinner-border spinner-border-sm text-primary"
                                                role="status">
                                            </div>

                                        </div>

                                        {{-- STOCK --}}
                                        <div class="mb-3 form-group">

                                            <label class="form-label">
                                                Cantidad disponible en stock
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control"
                                                wire:model.blur="artificiosRetiro.{{ $index }}.cantidad"
                                                readonly
                                                disabled>

                                        </div>

                                        {{-- RETIRO --}}
                                        <div class="mb-3 form-group">

                                            <label
                                                for="retiroCantidad{{ $index }}"
                                                class="form-label">

                                                Cantidad a retirar

                                            </label>

                                            <input
                                                id="retiroCantidad{{ $index }}"
                                                type="text"
                                                class="form-control"
                                                wire:model.blur="artificiosRetiro.{{ $index }}.retiro_cantidad"
                                                placeholder="Ej: 20">

                                            <x-input-error
                                                for="artificiosRetiro.{{ $index }}.retiro_cantidad"
                                                class="text-danger" />

                                        </div>

                                        {{-- ELIMINAR --}}
                                        @if (count($artificiosRetiro) > 1)

                                            <button
                                                type="button"
                                                class="btn btn-danger btn-sm"
                                                wire:click="removeRegistro({{ $index }})">

                                                Eliminar

                                            </button>

                                        @endif

                                    </div>

                                @endforeach

                                {{-- AGREGAR --}}
                                <div class="text-center mt-3">

                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        wire:click="addRegistro">

                                        Agregar nuevo registro

                                    </button>

                                </div>

                            </div>

                            {{-- RESERVA --}}
                           <div class="form-group col-12">

    <div class="form-check d-flex align-items-center gap-1">

        <input
            type="checkbox"
            class="form-check-input m-0"
            id="reservarChk"
            wire:model.live="reservar"
            style="width:16px; height:16px;">

        <label
            class="form-check-label mb-0 ms-1"
            for="reservarChk"
            style="font-size:14px; cursor:pointer;">

            Reservar retiro (programar fecha)

        </label>

    </div>

    @if($reservar)

        <div class="mt-2" style="max-width: 320px;">

            <label style="font-size:14px;">
                Fecha de reserva
            </label>

            <div class="input-group input-group-sm">

                <input
                    type="date"
                    class="form-control"
                    wire:model.live="fecha_reserva">

                <button
                    type="button"
                    class="btn btn-outline-secondary"
                    wire:click="setFecha3Dias">

                    +3 días

                </button>

            </div>

            <x-input-error
                for="fecha_reserva"
                class="text-danger" />

        </div>

    @endif

</div>

                            {{-- OBSERVACION --}}
                            <div class="form-group col-12">

                                <label>
                                    Observación
                                </label>

                                <textarea
                                    class="form-control"
                                    required
                                    wire:model.blur="observacion"
                                    placeholder="Ej: descripción del retiro">
                                </textarea>

                            </div>

                            {{-- ENTREGA --}}
                            <div class="col-12 row">

                                <div class="form-group col-6">

                                    <label>
                                        ¿Quién entrega?
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model.defer="formEntrega.nombre_entrega"
                                        placeholder="Ej: Pablo López">

                                </div>

                                <div class="form-group col-6">

                                    <label>
                                        Cédula
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model.defer="formEntrega.cedula_entrega"
                                        placeholder="Ej: 46541254">

                                </div>

                            </div>

                            {{-- TERCERO --}}
                            <div style="margin-left: 0; justify-content: left"
                                class="form-group col-12">

                                <div class="form-check">

                                    <label class="form-check-label">

                                        <input
                                            type="checkbox"
                                            class="form-control"
                                            wire:click="changeRecibeTercero"
                                            wire:loading.attr="disabled">

                                        Recibe un tercero
                                        <i class="input-helper"></i>

                                    </label>

                                </div>

                            </div>

                            @if ($recibe_tercero)

                                <div class="form-group col-12">

                                    <label>
                                        Nombre del tercero que recibe
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model.blur="nombre_tercero">

                                </div>

                                <div class="form-group col-12">

                                    <label>
                                        Cédula del tercero que recibe
                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        wire:model.defer="cedula_tercero">

                                </div>

                            @endif

                            {{-- BOTONES --}}
                            <div class="col-12">

                                <button
                                    class="btn btn-primary mr-2"
                                    type="submit"
                                    wire:loading.attr="disabled"
                                    wire:loading.class="d-none">

                                    ¡Hacer retiro!

                                </button>

                                <button
                                    class="btn btn-primary"
                                    type="button"
                                    disabled
                                    wire:loading
                                    wire:target="retiro">

                                    <span
                                        class="spinner-border spinner-border-sm"
                                        role="status"
                                        aria-hidden="true">
                                    </span>

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
        <div class="col-md-4 col-sm-6">
            @livewire('retiro.retiro-historial')
        </div>

    </div>
</div>
