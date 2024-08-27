<div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-7">
                    <h5>Detalles</h5>
                    <p class="text-muted"> Graficas mensuales <a class="text-muted font-weight-medium pl-2" href="{{route('retiro_ver')}}"><u>Ver Detalles</u></a>
                    </p>
                </div>
                
                {{-- <div class="col-sm-5 text-md-right">
                    <button type="button" class="btn btn-icon-text mb-3 mb-sm-0 btn-inverse-primary font-weight-normal">
                        <i class="mdi mdi-email btn-icon-prepend"></i>Descargar Reporte </button>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card mb-3 mb-sm-0">
                        <div class="card-body py-3 px-4">
                            <p class="m-0 survey-head">Retiros <span><label class="badge badge-info">Hoy</label></span></p>
                            <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                                <div>
                                    <h3 class="m-0 survey-value">{{count($actual)}}</h3>
                         
                                </div>
                                <div id="earningChart" class="flot-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card mb-3 mb-sm-0">
                        <div class="card-body py-3 px-4">
                            <p class="m-0 survey-head">Retiros <span><label class="badge badge-info">Ayer</label></span></p>
                            <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                                <div>
                                    <h3 class="m-0 survey-value">{{count($ayer)}}</h3>
                             <!--        <p class="text-danger m-0">-310 avg. sales</p> -->
                                </div>
                                <div id="productChart" class="flot-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body py-3 px-4">
                            <p class="m-0 survey-head">Retiros <span><label class="badge badge-info">Antes de ayer</label></span></p>
                            <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                                <div>
                                    <h3 class="m-0 survey-value">{{count($antesAyer)}}</h3>
                                 <!--    <p class="text-success m-0">-310 avg. sales</p> -->
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
                    <p class="text-muted mb-0"> Algunas funciones para los usuarios de rol <b>Analist</b> no estaran disponibles, ya que solo pueden ser ejecutadas por el <b>administrador</b>                    </p>
                </div>
                <div class="col-sm-4">
                    <p class="mb-0 text-muted">Total artificios disponibles</p>
                    <h5 class="d-inline-block survey-value mb-0"> {{$total_artificio}} </h5>
                    
                </div>
            </div>
        </div>
    </div>
</div>