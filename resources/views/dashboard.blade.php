<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="page-header flex-wrap">
        <h3 class="mb-0"> Hi, {{ Auth::user()->name }} bienvenido! <span class="pl-0 h6 pl-sm-2 text-muted d-inline-block">Resumen dashboard del sistema de bienes.</span>
        </h3>
        <div class="d-flex">

            @can('user.store')
            <a href="{{route('usuario')}}">

                <button type="button" class="btn btn-sm ml-3 btn-success"> Nuevo usuario </button>
            </a>
            @endcan
            <a href="{{route('retiro_stock')}}">
                <button type="button" class="btn btn-sm ml-3 btn-primary"> Nuevo retiro </button>
            </a>
        </div>
    </div>
    <!-- RESUMEN -->
    <div class="row">
        <div class="col-xl-3 col-lg-12 stretch-card grid-margin">
            @livewire('dashboard.cards')
        </div>
        <!-- Card-grafica -->
        <div class="col-xl-9 stretch-card grid-margin">
            @livewire('dashboard.card-grafica')
        </div>
    </div>
    <!-- END RESUMEN -->


</x-app-layout>