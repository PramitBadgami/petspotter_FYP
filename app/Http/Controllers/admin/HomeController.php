<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Pet;
use App\Models\Verification;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){

        $totalOrders = Order::where('status', '!=', 'cancelled')->count();
        $totalProducts = Product::count();
        $totalPets = Pet::count();
        $totalAdoptedPets = Pet::where('adoption_status', '=', 'adopted')->count();
        $totalUsers = User::where('role', 1)->count();
        $totalVerifications = Verification::count();

        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('grand_total');

        // This month revenue
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentDate = Carbon::now()->format('Y-m-d');

        $revenueThisMonth = Order::where('status', '!=', 'cancelled')
                            ->whereDate('created_at', '>=', $startOfMonth)
                            ->whereDate('created_at', '<=', $currentDate)
                            ->sum('grand_total');

        // Last month revenue
        $lastMonthStartDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEndDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $lastMonthName = Carbon::now()->subMonth()->startOfMonth()->format('M');

        $revenueLastMonth = Order::where('status', '!=', 'cancelled')
                            ->whereDate('created_at', '>=', $lastMonthStartDate)
                            ->whereDate('created_at', '<=', $lastMonthEndDate)
                            ->sum('grand_total');

        // Last 30 days sale
        $lastThirtyDayStartDate = Carbon::now()->subDays(30)->format('Y-m-d');

        $revenueLastThirtyDays = Order::where('status', '!=', 'cancelled')
                            ->whereDate('created_at', '>=', $lastThirtyDayStartDate)
                            ->whereDate('created_at', '<=', $currentDate)
                            ->sum('grand_total');
        
        // Graph One
        $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', date('Y'))
        ->where('role', 1)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $labels = [];
        $data = [];
        $colors = ['#FF6384','#36A2EB','#FFCE56','#8BC34A','#FF5722','#009688','#795548','#9C27B0','#FF9800','#CDDC39','#607D88'];

        for ($i = 1; $i <= 12; $i++) {
            $monthName = date('F', mktime(0, 0, 0, $i, 1)); // Get month name
            array_push($labels, $monthName); // Add month name to labels array
            $data[$i] = 0; // Initialize count for the month to 0
        }
    
        // Populate data array with counts for each month
        foreach ($users as $user) {
            $data[$user->month] = $user->count;
        }

        $datasets  = [
            [
                'label' => 'Users',
                'backgroundColor' => $colors,
                'data' => array_values($data)
            ]
            ];

        return view('admin.dashboard',compact('totalOrders', 'datasets', 'labels', 'revenueLastThirtyDays', 'lastMonthName', 'totalVerifications',
        'totalProducts', 'totalUsers', 'totalPets', 'totalAdoptedPets', 'totalRevenue', 'revenueThisMonth', 'revenueLastMonth'));

    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    // public function profile() {
    //     return view('frontend.account.profile');
    // }
}
