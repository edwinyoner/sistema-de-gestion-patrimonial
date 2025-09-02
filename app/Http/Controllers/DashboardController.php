<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Office;
use App\Models\Inventory;
use App\Models\Worker;
use App\Models\JobPosition;




class DashboardController extends Controller
{
    public function index()
    {
        $totalAssets = JobPosition::count();
        $totalOffices = Office::count();
        $damagedAssets = Worker::count();
        $totalInventories = JobPosition::count();

        $officeNames = Office::pluck('name')->toArray();
        $assetsPerOffice = 145;
        foreach ($officeNames as $officeName) {
            $office = Office::where('name', $officeName)->first();
           
        }

        return view('dashboard-main', compact(
            'totalAssets',
            'totalOffices',
            'damagedAssets',
            'totalInventories',
            'officeNames',
            'assetsPerOffice'
        ));
    }
}