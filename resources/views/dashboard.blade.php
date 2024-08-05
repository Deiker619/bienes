<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="page-header flex-wrap">
        <h3 class="mb-0"> Hi, {{ Auth::user()->name }} bienvenido! <span
                class="pl-0 h6 pl-sm-2 text-muted d-inline-block">Your web analytics dashboard template.</span>
        </h3>
        <div class="d-flex">


            <button type="button" class="btn btn-sm ml-3 btn-success"> Nuevo usuario </button>
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
        <div class="col-xl-9 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-7">
                            <h5>Business Survey</h5>
                            <p class="text-muted"> Graficas mensuales <a class="text-muted font-weight-medium pl-2"
                                    href="#"><u>See Details</u></a>
                            </p>
                        </div>
                        <div class="col-sm-5 text-md-right">
                            <button type="button"
                                class="btn btn-icon-text mb-3 mb-sm-0 btn-inverse-primary font-weight-normal">
                                <i class="mdi mdi-email btn-icon-prepend"></i>Descargar Reporte </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card mb-3 mb-sm-0">
                                <div class="card-body py-3 px-4">
                                    <p class="m-0 survey-head">Today Earnings</p>
                                    <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                                        <div>
                                            <h3 class="m-0 survey-value">$5,300</h3>
                                            <p class="text-success m-0">-310 avg. sales</p>
                                        </div>
                                        <div id="earningChart" class="flot-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card mb-3 mb-sm-0">
                                <div class="card-body py-3 px-4">
                                    <p class="m-0 survey-head">Product Sold</p>
                                    <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                                        <div>
                                            <h3 class="m-0 survey-value">$9,100</h3>
                                            <p class="text-danger m-0">-310 avg. sales</p>
                                        </div>
                                        <div id="productChart" class="flot-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body py-3 px-4">
                                    <p class="m-0 survey-head">Today Orders</p>
                                    <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                                        <div>
                                            <h3 class="m-0 survey-value">$4,354</h3>
                                            <p class="text-success m-0">-310 avg. sales</p>
                                        </div>
                                        <div id="orderChart" class="flot-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-sm-12">
                            <div class="flot-chart-wrapper">
                                @livewire('dashboard.grafica-retiro')
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <p class="text-muted mb-0"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore. <b>Learn More</b>
                            </p>
                        </div>
                        <div class="col-sm-4">
                            <p class="mb-0 text-muted">Sales Revenue</p>
                            <h5 class="d-inline-block survey-value mb-0"> $2,45,500 </h5>
                            <p class="d-inline-block text-danger mb-0"> last 8 months </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END RESUMEN -->


</x-app-layout>
