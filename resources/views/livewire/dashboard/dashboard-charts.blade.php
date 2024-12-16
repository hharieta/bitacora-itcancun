<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($isLoading)
            <div class="text-center">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900 dark:border-white"></div>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Cargando datos...</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Gráfica de Barras -->
                <div class="bg-white dark:bg-gray-800 h-96 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        Requisiciones por Departamento
                    </h3>
                    <div id="debug-department" class="text-sm text-gray-500 mb-2"></div>
                    <canvas id="departmentChart" class="h-56"></canvas>
                </div>

                <!-- Gráfica de Dona -->
                <div class="bg-white dark:bg-gray-800 h-96 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        Estados de Requisiciones
                    </h3>
                    <div id="debug-status" class="text-sm text-gray-500 mb-2"></div>
                    <canvas id="statusChart" class="h-56 w-full"></canvas>
                </div>
            </div>
            <!-- Nueva gráfica de línea de tiempo -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mt-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                        Historial de Requisiciones por Departamento
                    </h3>
                    <div class="h-[400px]">
                        <canvas id="timelineChart"></canvas>
                    </div>
                </div>
        @endif
    </div>

    @push('scripts')
    <script>
        let charts = [];

        function initializeCharts() {
            // Destruir gráficas existentes si las hay
            charts.forEach(chart => chart.destroy());
            charts = [];

            const departmentData = @json($departmentData);
            const statusData = @json($statusData);
            const timelineData = @json($timelineData);

            function generateColors(index, total) {
                const hue = (index * (360 / total)) % 360;
                return {
                    background: `hsla(${hue}, 70%, 60%, 0.6)`,
                    border: `hsla(${hue}, 70%, 50%, 1)`
                };
            }

            try {
                // Gráfica de Departamentos
                const departmentChart = new Chart(document.getElementById('departmentChart'), {
                    type: 'bar',
                    data: {
                        labels: departmentData.labels,
                        datasets: [{
                            label: 'Requisiciones por Departamento',
                            data: departmentData.values,
                            backgroundColor: departmentData.values.map((_, index) => 
                                generateColors(index, departmentData.values.length).background
                            ),
                            borderColor: departmentData.values.map((_, index) => 
                                generateColors(index, departmentData.values.length).border
                            ),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
                charts.push(departmentChart);

                // Gráfica de Estados
                const statusChart = new Chart(document.getElementById('statusChart'), {
                    type: 'doughnut',
                    data: {
                        labels: statusData.labels,
                        datasets: [{
                            data: statusData.values,
                            backgroundColor: departmentData.labels.map((_, index) => 
                                generateColors(index, departmentData.labels.length).background
                            ),
                            borderColor: departmentData.labels.map((_, index) => 
                                generateColors(index, departmentData.labels.length).border
                            ),
                            borderWidth: 1
                        }]
                    },
                    options: { 
                        responsive: true, 
                        maintainAspectRatio: true, 
                        plugins: { 
                            legend: { position: 'right' } 
                        } 
                    }
                });
                charts.push(statusChart);

                // Gráfica de línea de tiempo
                const timelineChart = new Chart(document.getElementById('timelineChart'), {
                    type: 'line',
                    data: {
                        labels: timelineData.labels,
                        datasets: timelineData.datasets.map((dataset, index) => ({
                            label: dataset.label,
                            data: dataset.data,
                            borderColor: generateColors(index, timelineData.datasets.length).border,
                            backgroundColor: generateColors(index, timelineData.datasets.length).background,
                            tension: 0.4,
                            fill: false,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }))
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: {
                            intersect: false,
                            mode: 'index'
                        },
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                position: 'nearest'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Número de Requisiciones'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Mes'
                                }
                            }
                        }
                    }
                });
                charts.push(timelineChart);

            } catch (error) {
                console.error('Error al cargar las gráficas:', error);
                showErrorModal('Ha ocurrido un error al cargar las gráficas: ' + error.message);
            }
        }

        // Inicializar gráficas cuando el componente se carga
        document.addEventListener('livewire:initialized', initializeCharts);

        // Reinicializar gráficas cuando se navega de vuelta al dashboard
        document.addEventListener('wire:navigate.end', () => {
            if (document.getElementById('departmentChart')) {
                initializeCharts();
            }
        });

        // Limpiar gráficas cuando se navega fuera del dashboard
        document.addEventListener('wire:navigate.start', () => {
            charts.forEach(chart => chart.destroy());
            charts = [];
        });

    </script>
    @endpush
</div>