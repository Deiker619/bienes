<div class="row">
    <!-- Cards de colores  -->
    <div class="col-xl-12 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
        <div class="card bg-warning">
            <div class="card-body px-3 py-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="color-card">
                        <p class="mb-0 color-card-head">Tipos de artificios</p>
                        <h2 class="text-white"> {{ number_format($tipos_artificio, 0, '', '.') }}<span
                                class="h5"></span>
                        </h2>
                    </div>
                    <i class="card-icon-indicator mdi mdi-basket bg-inverse-icon-warning"></i>
                </div>
                <a href="{{route('artificios')}}">
                    <h6 class="text-white">Ver artificios</h6>
                </a>
            </div>
        </div>
    </div>
    <!-- Cards de colores  -->
    <div class="col-xl-12 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
        <div class="card bg-danger">
            <div class="card-body px-3 py-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="color-card">
                        <p class="mb-0 color-card-head">Artificios totales</p>
                        <h2 class="text-white"> {{ number_format($total_artificio, 0, '', '.') }}<span
                                class="h5">00</span>
                        </h2>
                    </div>
                    <i class="card-icon-indicator mdi mdi-cube-outline bg-inverse-icon-danger"></i>
                </div>
                <a href="{{route('stock_show')}}">
                    <h6 class="text-white">Ver stock</h6>
                </a>
            </div>
        </div>
    </div>
    <!-- Cards de colores  -->
    <div class="col-xl-12 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3 pb-lg-0 pb-xl-3">
        <div class="card bg-primary">
            <div class="card-body px-3 py-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="color-card">
                        <p class="mb-0 color-card-head">Retiros totales</p>
                        <h2 class="text-white"> {{ number_format($total_retiros, 0, '', '.') }}<span
                                class="h5"></span>
                        </h2>
                    </div>
                    <i class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary"></i>
                </div>
                <a href="{{route('retiro_ver')}}">
                    <h6 class="text-white">Ver retiros</h6>
                </a>
            </div>
        </div>
    </div>
    <!-- Cards de colores  -->
    <div class="col-xl-12 col-md-6 stretch-card pb-sm-3 pb-lg-0">
        <div class="card bg-success">
            <div class="card-body px-3 py-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="color-card">
                        <p class="mb-0 color-card-head">Coordinaciones</p>
                        <h2 class="text-white">{{ number_format($total_coordinaciones, 0, '', '.') }}</h2>
                    </div>
                    <i class="card-icon-indicator mdi mdi-account-circle bg-inverse-icon-success"></i>
                </div>
                <a href="{{route('coordinacion')}}">
                    <h6 class="text-white">Ver Coordinaciones</h6>
                </a>
            </div>
        </div>
    </div>
</div>
