<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($isLoading)
            <div class="text-center">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900 dark:border-white"></div>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Cargando datos...</p>
            </div>
        @else
            <!-- Tarjetas Informativas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Tarjeta de Valor Total -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-500 bg-opacity-10">
                            <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Valor Total de Artículos</h3>
                            <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                ${{ number_format($summaryData['total_price'], 2) }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Departamentos -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-500 bg-opacity-10">
                            <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Total Departamentos</h3>
                            <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $summaryData['total_departments'] }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta de Artículos Activos -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-500 bg-opacity-10">
                            <svg class="h-8 w-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <div class="ml-5">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Artículos Activos</h3>
                            <p class="mt-1 text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $summaryData['active_articles'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Desglose por Departamento -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Valor por Departamento</h3>
                    <div class="relative w-64">
                        <input 
                            type="text" 
                            wire:model.live="departmentSearch" 
                            placeholder="Buscar departamento..."
                            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm text-sm"
                        >
                        @if($departmentSearch)
                            <button 
                                wire:click="$set('departmentSearch', '')" 
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @if($departmentSearch)
                        {{-- Mostrar todos los resultados de la búsqueda --}}
                        @foreach($summaryData['department_prices'] as $dept)
                            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ $dept->department }}</h4>
                                <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    ${{ number_format($dept->total_price, 2) }}
                                </p>
                            </div>
                        @endforeach
                    @else
                        {{-- Mostrar solo los primeros 4 cuando no hay búsqueda --}}
                        @foreach($summaryData['department_prices']->take(4) as $dept)
                            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <h4 class="text-sm font-medium text-gray-600 dark:text-gray-300">{{ $dept->department }}</h4>
                                <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    ${{ number_format($dept->total_price, 2) }}
                                </p>
                            </div>
                        @endforeach
                    @endif
                </div>

                @if(!$departmentSearch && $summaryData['department_prices']->count() > 4)
                    <div class="mt-4 text-center text-sm text-gray-600 dark:text-gray-400">
                        Mostrando 4 de {{ $summaryData['department_prices']->count() }} departamentos. 
                        Use la búsqueda para ver más.
                    </div>
                @endif
            </div>

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