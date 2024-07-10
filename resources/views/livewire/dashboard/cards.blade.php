<div class="row">
    <!-- Cards de colores  -->
    <div class="col-xl-12 col-md-6 stretch-card grid-margin grid-margin-sm-0 pb-sm-3">
        <div class="card bg-warning">
            <div class="card-body px-3 py-4">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="color-card">
                        <p class="mb-0 color-card-head">Tipos de artificios</p>
                        <h2 class="text-white"> {{$tipos_artificio}}<span class="h5"></span>
                        </h2>
                    </div>
                    <i class="card-icon-indicator mdi mdi-basket bg-inverse-icon-warning"></i>
                </div>
                <h6 class="text-white">18.33% Since last month</h6>
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
                        <h2 class="text-white"> {{ number_format($total_artificio, 0, '', '.') }}<span class="h5">00</span>
                        </h2>
                    </div>
                    <i class="card-icon-indicator mdi mdi-cube-outline bg-inverse-icon-danger"></i>
                </div>
                <h6 class="text-white">13.21% Since last month</h6>
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
                        <h2 class="text-white"> {{ number_format($total_retiros, 0, '', '.') }}<span class="h5"></span>
                        </h2>
                    </div>
                    <i class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary"></i>
                </div>
                <h6 class="text-white">67.98% Since last month</h6>
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
                        <h2 class="text-white">2368</h2>
                    </div>
                    <i class="card-icon-indicator mdi mdi-account-circle bg-inverse-icon-success"></i>
                </div>
                <h6 class="text-white">20.32% Since last month</h6>
            </div>
        </div>
    </div>
</div>