<div>
    <div id="flot-chart" class="row"
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
    </div>
</div>
