<div>
    <div class="card">
        <div class="card-body">
            <div class="card-title font-weight-medium"> Historial de retiros </div>

            @if ($retiros->count())
                @foreach ($retiros as $retiro)
                    <div class="d-flex flex-wrap border-bottom py-2 border-top justify-content-between w-100">
                        <div class="pt-2 w-100">
                            @php
                                // Determinar tipo de destino
                                $name = null;
                                if ($retiro->coordinacion?->name_coordinacion) {
                                    $name = 'Coordinación';
                                } elseif ($retiro->beneficiario?->nombre) {
                                    $name = 'Beneficiario';
                                } elseif ($retiro->jornada?->descripcion) {
                                    $name = 'Jornada';
                                } elseif ($retiro->ente?->descripcion) {
                                    $name = 'Ente';
                                }
                            @endphp

                            <h5 class="mb-0">
                                Retiro #{{ $retiro->id }}
                                @if($name)
                                    <label class="badge badge-info">{{ $name }}</label>
                                @endif
                            </h5>

                            <p class="mb-0 text-muted">
                                Entregado a:
                                <span class="text-danger">
                                    {{ $retiro->coordinacion->name_coordinacion
                                        ?? ($retiro->beneficiario->nombre
                                        ?? ($retiro->jornada->descripcion
                                        ?? $retiro->ente->descripcion)) }}
                                </span>
                            </p>

                            {{-- Listado de artificios asociados al retiro --}}
                            @foreach ($retiro->retiro_artificios as $ra)
                                <h5 class="mb-0 text-success">
                                    {{ $ra->cantidad }} {{ $ra->artificio->name }}
                                    <small class="text-warning">{{ $ra->created_at->format('d/m/Y H:i') }}</small>
                                </h5>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="d-flex flex-wrap border-bottom py-2 border-top justify-content-between">
                    <div class="pt-2">
                        <h5 class="mb-0">No se encontraron resultados</h5>
                    </div>
                </div>
            @endif

            <a class="text-black mt-3 d-block font-weight-medium h6" href="{{ route('retiro_ver') }}">
                Ver todos <i class="mdi mdi-chevron-right"></i>
            </a>
        </div>
    </div>
</div>
