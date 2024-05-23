<div>
    <div class="row mb-4">
        <div class="col-sm-4">
            <div class="card mb-3 mb-sm-0">
                <div class="card-body py-3 px-4">
                    <p class="m-0 survey-head">Total artificios</p>
                    <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                        <div>
                            <h3 class="m-0 survey-value">{{$total_artificio}}</h3>
                            <p class="text-success m-0">-310 avg. sales</p>
                        </div>
                        <div id="earningChart" class="flot-chart" style="padding: 0px;"><canvas class="flot-base" width="59" height="51" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 59.9844px; height: 51px;"></canvas><canvas class="flot-overlay" width="59" height="51" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 59.9844px; height: 51px;"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card mb-3 mb-sm-0 ">
                <div class="card-body py-3 px-4">
                    <p class="m-0 survey-head">Tipos artificios</p>
                    <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                        <div>
                            <h3 class="m-0 survey-value">{{$tipos_artificio}}</h3>
                            <p class="text-danger m-0">-310 avg. sales</p>
                        </div>
                        <div id="productChart" class="flot-chart" style="padding: 0px;"><canvas class="flot-base" width="59" height="51" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 59.9844px; height: 51px;"></canvas><canvas class="flot-overlay" width="59" height="51" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 59.9844px; height: 51px;"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body py-3 px-4">
                    <p class="m-0 survey-head">Total retiros</p>
                    <div class="d-flex justify-content-between align-items-end flot-bar-wrapper">
                        <div>
                            <h3 class="m-0 survey-value">{{$total_retiros}}</h3>
                            <p class="text-success m-0">-310 avg. sales</p>
                        </div>
                        <div id="orderChart" class="flot-chart" style="padding: 0px;"><canvas class="flot-base" width="59" height="51" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 59.9844px; height: 51px;"></canvas><canvas class="flot-overlay" width="59" height="51" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 59.9844px; height: 51px;"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>