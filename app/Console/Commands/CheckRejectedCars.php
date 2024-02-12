<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\carsModel; // ปรับเปลี่ยนตามชื่อ namespace ของโมเดลของคุณ

class CheckRejectedCars extends Command
{
    protected $signature = 'cars:checkrejected';
    protected $description = 'Check rejected cars and update status to deleted if rejected for more than 3 days';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $cars = carsModel::where('status', 'rejected')
                   ->where('rejectdate', '<=', now()->subDays(3))
                   ->get();

        foreach ($cars as $car) {
            $car->status = 'deleted';
            $car->save();
        }

        $this->info('Rejected cars checked and updated.');
    }
}

