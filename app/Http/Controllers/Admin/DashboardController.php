<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalBrands = Brand::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $totalCompletedOrders = Order::where('status_message', 'completed')->count();
        $totalPendingOrders = Order::where('status_message', 'pending')->count();
        $totalTasks = Task::count();
        $totalPendingTasks = Task::where('status', 'pending')->count();
        $totalCompletedTasks = Task::where('status', 'completed')->count();
        $totalInprogressTasks = Task::where('status', 'in progress')->count();
        $totalUrgentTasks = Task::where('status', 'urgent')->count();

        $totalAllUsers = User::count();
        $totalUsers = User::where('role_as', '0')->count();
        $totalAdmin = User::where('role_as', '1')->count();

        $todayDate = Carbon::now()->format('d - m - Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');





        return view('admin.dashboard', compact(
            'totalAllUsers',
            'totalUsers',
            'totalAdmin',
            'totalOrders',
            'totalProducts',
            'totalPendingOrders',
            'totalCompletedOrders',
            'totalTasks',
            'totalPendingTasks',
            'totalCompletedTasks',
            'totalInprogressTasks',
            'totalUrgentTasks',
            'totalBrands',
            'totalCategories'
        ));
    }
}
