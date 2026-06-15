<x-app-layout>
    
    <div class="page-header">
        <h3 class="page-title">{{ __('Reportes Consolidados') }}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Reportes </li>
            </ol>
        </nav>
    </div>
    
    <div class="page-header flex-wrap">
        <h3 class="mb-0">Hola!, <b>{{ Auth::user()->name }}</b> <span class="pl-0 h12 pl-sm-2 text-muted d-inline-block">Esta sección muestra los reportes consolidados de personas y coordinaciones que han realizado retiros en la institucion.</span>
        </h3>
    </div>

    @livewire('reportes.reportes-table-show-component')
</x-app-layout>
