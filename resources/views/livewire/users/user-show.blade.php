<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="page-header">
        <h3 class="page-title">{{ __('Gestión de usuarios') }}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> usuarios </li>
            </ol>
        </nav>
    </div>
   @livewire('users.user-table-show')
</x-app-layout>