<div>
    <div id="flot-chart" class="row" style="position: relative; height: 320px; width: 100%;">
        <canvas id="grafica"></canvas>
    </div>

    <x-slot name="js">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            (function() {
                var retirosData = @json($data['retiros']);

                var labels = retirosData.map(function(item) {
                    return item.month;
                });

                var data = retirosData.map(function(item) {
                    return item.total_retirada;
                });

                function renderChart() {
                    var canvas = document.getElementById('grafica');
                    if (!canvas) return;

                    var ctx = canvas.getContext('2d');
                    if (window.myDashboardChart) {
                        window.myDashboardChart.destroy();
                    }

                    window.myDashboardChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Cantidad de artificios retirados',
                                data: data,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                                borderRadius: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0
                                    }
                                }
                            }
                        }
                    });
                }

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', renderChart);
                } else {
                    renderChart();
                }
            })();
        </script>
    </x-slot>
</div>
