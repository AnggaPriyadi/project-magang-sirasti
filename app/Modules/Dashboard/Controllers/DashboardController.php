<?php namespace App\Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
// use App\Modules\Dashboard\Models\DashboardModel;

class DashboardController extends BaseController
{
    public function index(): string
    {
        return view('dashboard/index');
    }
}