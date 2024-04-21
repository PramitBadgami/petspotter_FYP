<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Pet;
use App\Models\Verification;
use App\Models\Donation;
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

        $totalDonations = Donation::sum('amount');

        // Last 30 days sale
        $lastThirtyDayStartDate = Carbon::now()->subDays(30)->format('Y-m-d');

        $revenueLastThirtyDays = Order::where('status', '!=', 'cancelled')
                            ->whereDate('created_at', '>=', $lastThirtyDayStartDate)
                            ->whereDate('created_at', '<=', $currentDate)
                            ->sum('grand_total');
        
        // Graph One
        // Bar graph for number of user registered in each month
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

        
        // Line graph of sales from previous week to current week
        // Total sales this week
        $startOfThisWeek = Carbon::now()->startOfWeek()->format('Y-m-d');
        $endOfThisWeek = Carbon::now()->endOfWeek()->format('Y-m-d');
        $salesThisWeek = Order::where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $startOfThisWeek)
            ->whereDate('created_at', '<=', $endOfThisWeek)
            ->sum('grand_total');

        // Total sales previous week
        $startOfPreviousWeek = Carbon::now()->subWeek()->startOfWeek()->format('Y-m-d');
        $endOfPreviousWeek = Carbon::now()->subWeek()->endOfWeek()->format('Y-m-d');
        $salesPreviousWeek = Order::where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $startOfPreviousWeek)
            ->whereDate('created_at', '<=', $endOfPreviousWeek)
            ->sum('grand_total');

        // Labels and data for the line graph
        $labels2 = ['Previous Week', 'This Week'];
        $data = [$salesPreviousWeek, $salesThisWeek];


        // Horizontal bar graph for User status
        // Count of users for each status
        $statusCounts = User::select('status', DB::raw('count(*) as count'))
        ->groupBy('status')
        ->pluck('count', 'status')
        ->toArray();

        // Data and labels for the pie chart
        $labels3 = array_keys($statusCounts);
        $data3 = array_values($statusCounts);

        $colors3 = ['#36A2EB', '#8BC34A', '#FFCE56', '#FF6384'];

        // Horizontal bar graph for user status
        $userCountsByProvince = Verification::select('province', DB::raw('count(*) as user_count'))
            ->groupBy('province')
            ->get();

        $labels4 = $userCountsByProvince->pluck('province')->toArray();
        $data4 = $userCountsByProvince->pluck('user_count')->toArray();

        // Doughnut chart for pet adoption status
        $petStatusCounts = Pet::select('adoption_status', DB::raw('count(*) as count'))
            ->groupBy('adoption_status')
            ->get();

        $labels5 = $petStatusCounts->pluck('adoption_status')->toArray();
        $data5 = $petStatusCounts->pluck('count')->toArray();

        $colors5 = ['#FF6384', '#36A2EB', '#8BC34A'];

        return view('admin.dashboard',compact('totalOrders', 'datasets', 'data', 'labels', 'labels2','salesPreviousWeek', 'salesThisWeek', 'revenueLastThirtyDays', 'lastMonthName', 'totalVerifications',
        'totalProducts', 'totalUsers', 'totalPets', 'totalAdoptedPets', 'totalRevenue', 'revenueThisMonth', 'revenueLastMonth', 'colors5',
        'labels3', 'data3', 'colors3', 'totalDonations', 'userCountsByProvince', 'labels4', 'data4', 'petStatusCounts', 'data5', 'labels5'));

    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    // public function profile() {
    //     return view('frontend.account.profile');
    // }
}





