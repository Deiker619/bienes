<div>
    <div class="page-header flex-wrap">
        <h3 class="mb-0">Hola!, <b>{{ Auth::user()->name }}</b>
            <span class="pl-0 h6 pl-sm-2 text-muted d-inline-block">Historial de adiciones al stock.</span>
        </h3>
        <div class="d-flex align-items-center">
            <a href="{{ route('exportHistorialStock') }}" target="_blank" class="btn btn-sm bg-white btn-icon-text border ml-3 text-dark">
                <i class="mdi mdi-printer btn-icon-prepend"></i> Imprimir todo el historial
            </a>
            <a href="{{ route('stock_show') }}" class="btn btn-sm bg-white btn-icon-text border ml-2 text-dark">
                <i class="mdi mdi-arrow-left btn-icon-prepend"></i> Volver a Stock
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                        <div>
                            <h4 class="card-title mb-1">Historial de adiciones al stock</h4>
                            <div class="card-description">Total de artificios agregados: <label class="badge badge-info">{{ $totalAgregado }}</label></div>
                        </div>

                        <div class="d-flex flex-wrap align-items-center mt-2 mt-md-0" style="gap: 10px;">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control form-control-sm" placeholder="Buscar artificio..."
                                    wire:model.live.debounce.300ms="search">
                            </div>
                            <div class="form-group mb-0">
                                <input type="date" class="form-control form-control-sm" title="Filtrar por fecha"
                                    wire:model.live="filtroFecha">
                            </div>
                            @if(!empty($search) || !empty($filtroFecha))
                                <button type="button" class="btn btn-sm btn-light border" wire:click="resetFilters" title="Limpiar filtros">
                                    <i class="mdi mdi-filter-remove"></i> Limpiar
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre del artificio</th>
                                    <th>Cantidad agregada</th>
                                    <th>Fecha de adición</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($historial as $item)
                                    <tr>
                                        <td class="py-1">{{ $item->id }}</td>
                                        <td>{{ $item->artificio?->name ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge badge-info text-white ml-3 rounded">{{ $item->cantidad }}</span>
                                        </td>
                                        <td>{{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '—' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('exportHistorialStockItem', ['id' => $item->id]) }}"
                                                target="_blank"
                                                class="btn btn-sm bg-white btn-icon-text border text-dark"
                                                title="Imprimir solo este registro de entrega">
                                                <i class="mdi mdi-printer btn-icon-prepend"></i> Imprimir registro
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="mdi mdi-alert-circle-outline mr-1"></i> No se encontraron registros en el historial de stock.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        @if ($historial->hasPages())
                            <div class="mt-3">
                                {{ $historial->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
