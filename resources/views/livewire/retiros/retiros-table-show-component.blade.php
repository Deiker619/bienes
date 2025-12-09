<div>
    <div class="container-fluid">
        <div class="grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Retiros del stock</h4>
                    <div class="overflow-auto">
                        <div class="form-group">
                            <input type="text" wire:model.live="search" class="form-control" placeholder="Buscar" style="width: 200px">
                            
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID Retiro</th>
                                    <th>Artificios / Cantidad</th>
                                    <th>Persona / Coordinación / Jornada</th>
                                    <th>Tipo de ente</th>
                                    <th>Observación</th>
                                    <th>Fecha de retiro</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($retiros as $retiro)
                                    @php
                                        $name = $retiro->coordinacion?->name_coordinacion
                                            ? 'Coordinación'
                                            : ($retiro->beneficiario?->nombre
                                                ? 'Beneficiario'
                                                : ($retiro->jornada?->descripcion
                                                    ? 'Jornada'
                                                    : ($retiro->ente?->descripcion
                                                        ? 'Ente'
                                                        : null)));

                                    @endphp

                                    <tr>
                                        <td>{{ $retiro->id }}</td>
                                        <td>
                                            {!! $retiro->retiro_artificios->map(function ($ra) {
                                                    return $ra->artificio->name . ' - ' . $ra->cantidad;
                                                })->implode('<br>') !!}
                                        </td>

                                        <td>
                                            {{ $retiro->coordinacion?->name_coordinacion ??
                                                ($retiro->beneficiario?->nombre ?? ($retiro->jornada?->descripcion ?? $retiro->ente?->descripcion)) }}
                                        </td>
                                        <td>
                                            <label class="badge badge-info">{{ $name }}</label>
                                        </td>
                                        <td>{{ $retiro->observacion ?? '—' }}</td>
                                        <td>{{ $retiro->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <span class="dropdown dropleft d-block">
                                                <span id="dropdownMenuButton{{ $retiro->id }}" data-toggle="dropdown"
                                                    role="button" aria-haspopup="true" aria-expanded="false">
                                                    <span><i class="mdi mdi-dots-vertical"
                                                            style="cursor: pointer"></i></span>
                                                </span>
                                                <span class="dropdown-menu"
                                                    aria-labelledby="dropdownMenuButton{{ $retiro->id }}">
                                                    <a class="dropdown-item"
                                                        wire:click='exportRetiroWithNote({{ $retiro->id }})'
                                                        style="cursor: pointer">Exportar con nota de entrega</a>
                                                    <a class="dropdown-item"
                                                        wire:click="deleteRetiro({{ $retiro->id }})"
                                                        style="cursor: pointer">Eliminar</a>
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No se encontraron resultados</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Paginación --}}
                        <div class="mt-3">
                            {{ $retiros->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
