<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Retiro del stock') }}
        </h2>
    </x-slot>

    <div class="page-header">
        <h3 class="page-title">{{ __('Retiro del stock') }}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('retiro_stock')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Retiro del stock </li>
            </ol>
        </nav>
    </div>

    @livewire('retiro.retiro-form-create')
</x-app-layout>