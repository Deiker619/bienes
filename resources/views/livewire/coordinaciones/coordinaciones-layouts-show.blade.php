<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de coordinaciones') }}
        </h2>
    </x-slot>

    <div class="page-header">
        <h3 class="page-title">{{ __('Gestión de coordinaciones') }}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('retiro_stock')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Gestión de coordinaciones </li>
            </ol>
        </nav>
    </div>

    @livewire('coordinaciones.coordinaciones-show')
</x-app-layout>