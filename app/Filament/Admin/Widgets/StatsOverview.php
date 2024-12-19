<?php

namespace App\Filament\Admin\Widgets;

use Carbon\Carbon;
use App\Models\Absensi;
use App\Models\Karyawan;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{

    protected static ?string $pollingInterval = '10s';

}
