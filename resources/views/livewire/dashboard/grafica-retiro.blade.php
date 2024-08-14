<div>
    <div id="flot-chart" class="row h-50">
        <canvas id="grafica" class="h-2"></canvas>
        
    </div>

    <x-slot name="js">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            console.log(@json($data));
            var retirosData = @json($data['retiros']);

            // Prepara las etiquetas y los datos para Chart.js
            var labels = retirosData.map(data => data.month);//Forma 1 de mapear

            var data = retirosData.map(function(dato) { //Forma 2 de mapear
                return dato.total_retirada; 
            });

            
            const ctx = document.getElementById('grafica').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cantidad de artificios retirados',
                        data: data,
                        borderWidth: 1
                    }],
                    
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </x-slot>
</div>
