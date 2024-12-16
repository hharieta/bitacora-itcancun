<?php

namespace App\Livewire\Dashboard;

use App\Models\Requisition;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

#[Layout('layouts.app')]
class DashboardCharts extends Component
{
    public $isLoading = true;
    public $departmentData;
    public $statusData;
    public $timelineData;
    public $summaryData;
    public $departmentSearch = '';
 

    public function mount()
    {
        \Log::info('DashboardCharts montado');
        $this->loadData();
    }

    public function updatedDepartmentSearch()
    {
        $this->loadData();
    }

    public function loadData()
    {
        try {
            \Log::info('Cargando datos para gráficas');
            
            // Datos para la gráfica de departamentos
            $departmentQuery = DB::table('requisitions')
                ->join('articles', 'requisitions.article_id', '=', 'articles.id')
                ->select('articles.department', DB::raw('count(*) as total'))
                ->groupBy('articles.department')
                ->get();

            // Datos para la gráfica de estados
            $statusQuery = DB::table('requisitions')
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get();

            $this->departmentData = [
                'labels' => $departmentQuery->pluck('department'),
                'values' => $departmentQuery->pluck('total'),
            ];

            $this->statusData = [
                'labels' => $statusQuery->pluck('status'),
                'values' => $statusQuery->pluck('total'),
            ];

            // Datos para la línea de tiempo (últimos 6 meses)
            $sixMonthsAgo = Carbon::now()->subMonths(6);
            
            $timelineData = DB::table('requisitions')
                ->join('articles', 'requisitions.article_id', '=', 'articles.id')
                ->select(
                    'articles.department',
                    DB::raw('DATE_FORMAT(requisitions.entry_time, "%Y-%m") as month'),
                    DB::raw('COUNT(*) as total')
                )
                ->where('requisitions.entry_time', '>=', $sixMonthsAgo)
                ->groupBy('articles.department', 'month')
                ->orderBy('month')
                ->get();

            // Organizar datos para el gráfico
            $months = $timelineData->pluck('month')->unique()->values();
            $departments = $timelineData->pluck('department')->unique();

            $this->timelineData = [
                'labels' => $months,
                'datasets' => $departments->map(function($department) use ($timelineData, $months) {
                    $data = $months->map(function($month) use ($department, $timelineData) {
                        return $timelineData
                            ->where('department', $department)
                            ->where('month', $month)
                            ->first()->total ?? 0;
                    });

                    return [
                        'label' => $department,
                        'data' => $data,
                    ];
                })->values()
            ];

            \Log::info('Datos cargados:', [
                'departments' => $this->departmentData,
                'status' => $this->statusData,
                'timeline' => $this->timelineData
            ]);

            // Datos para las tarjetas informativas
            $this->summaryData = [
                'total_price' => DB::table('articles')->sum('price'),
                'total_departments' => DB::table('articles')
                    ->distinct('department')
                    ->count('department'),
                'active_articles' => DB::table('articles')
                    ->whereNotExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('requisitions')
                            ->whereColumn('articles.id', 'requisitions.article_id')
                            ->whereNull('requisitions.exit_time');
                    })
                    ->count(),
                'department_prices' => DB::table('articles')
                    ->select('department', DB::raw('SUM(price) as total_price'))
                    ->groupBy('department')
                    ->get()
            ];

            $query = DB::table('articles')
                ->select('department', DB::raw('SUM(price) as total_price'))
                ->groupBy('department');

            if ($this->departmentSearch) {
                $query->where('department', 'like', '%' . $this->departmentSearch . '%');
            }

            $this->summaryData['department_prices'] = $query->get();

            \Log::info('Datos del resumen:', ['summaryData' => $this->summaryData]);

        } catch (\Exception $e) {
            \Log::error('Error cargando datos: ' . $e->getMessage());
        } finally {
            $this->isLoading = false;
        }
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-charts');
    }
}