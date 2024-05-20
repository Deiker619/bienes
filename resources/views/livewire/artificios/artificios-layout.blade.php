<x-app-layout>
    <div class="page-header">
        <h3 class="page-title">{{ __('Artificios') }}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Artificios </li>
            </ol>
        </nav>
    </div>
    
    @livewire('artificios.artificios-show')
</x-app-layout>