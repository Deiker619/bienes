<div>
    <div class="container-fluid">
        <div class="grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Reportes de Retiros Consolidados</h4>
                    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                        <div class="flex-grow-1 mr-2" style="max-width: 400px; min-width: 250px;">
                            <input type="text" class="form-control" placeholder="Buscar por nombre, cédula o tipo de ente..." wire:model.live.debounce.300ms="search">
                        </div>
                    </div>
                    <div class="overflow-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tipo de Ente</th>
                                    <th>ID Ente</th>
                                    <th>Nombre / Descripción</th>
                                    <th>Cédula</th>
                                    <th>Fecha de Último Retiro</th>
                                    <th class="text-center">Documentos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($results as $result)
                                    @php
                                        $badgeClass = 'badge-info';
                                        $typeName = 'Beneficiario';
                                        if ($result->type === 'coordinacion') {
                                            $badgeClass = 'badge-primary';
                                            $typeName = 'Coordinación';
                                        } elseif ($result->type === 'jornada') {
                                            $badgeClass = 'badge-warning';
                                            $typeName = 'Jornada';
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            <label class="badge {{ $badgeClass }}">{{ $typeName }}</label>
                                        </td>
                                        <td>{{ $result->entity_id }}</td>
                                        <td>{{ $result->name }}</td>
                                        <td>{{ $result->cedula ?? '—' }}</td>
                                        <td>
                                            {{ $result->ultimo_retiro ? \Carbon\Carbon::parse($result->ultimo_retiro)->format('d/m/Y H:i') : '—' }}
                                        </td>
                                        <td class="text-center">
                                            <button type="button" 
                                                    wire:click="exportarExcel('{{ $result->type }}', {{ $result->entity_id }}, '{{ addslashes($result->name) }}')" 
                                                    class="btn btn-success font-weight-bold shadow-sm d-inline-flex align-items-center"
                                                    style="background-color: #28a745; border-color: #28a745; color: white; padding: 6px 12px; font-size: 13px; cursor: pointer;">
                                                <i class="mdi mdi-file-excel mr-1"></i> Excel
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No se encontraron resultados</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{-- Paginación --}}
                        <div class="mt-3">
                            {{ $results->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
