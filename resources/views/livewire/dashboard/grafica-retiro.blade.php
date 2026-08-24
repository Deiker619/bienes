<div>
    <style>
        .grafica-vacio {
            position: absolute;
            inset: 0;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            background: rgba(255, 255, 255, 0.75);
            border-radius: 4px;
        }
    </style>
    <div id="flot-chart" class="row position-relative"
        x-data="{
            datos: @js($chart),
            grafico: null,
            pintar() {
                if (!this.$refs.canvas || typeof Chart === 'undefined') { return; }
                const previo = Chart.getChart(this.$refs.canvas);
                if (previo) { previo.destroy(); }
                if (this.grafico) { this.grafico.destroy(); this.grafico = null; }
                try {
                    const ctx = this.$refs.canvas.getContext('2d');
                    this.grafico = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: this.datos.labels,
                            datasets: [{
                                label: this.datos.titulo,
                                data: this.datos.data,
                                borderWidth: 1
                            }],
                        },
                        options: {
                            responsive: true,
                            animation: {
                                duration: 700,
                                easing: 'easeOutQuart'
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                } catch (e) { console.error('Error al pintar grafica:', e); }
            },
            destroy() {
                if (this.grafico) { this.grafico.destroy(); }
            }
        }"
        x-init="pintar()">
        <canvas id="grafica" class="" x-ref="canvas"></canvas>
        @if($chart['vacio'])
        <p class="grafica-vacio mb-0 text-muted">Este mes no hubo retiros de artificios</p>
        @endif
    </div>
</div>
