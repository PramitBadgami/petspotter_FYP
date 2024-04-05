<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        $users = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', date('Y'))
        ->where('role', 1)
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        $labels = [];
        $data = [];
        $colors = ['#FF6384','#36A2EB','#FFCE56','#8BC34A','#FF5722','#009688','#795548','#9C27B0','#FF9800','#CDDC39','#607D88'];
        
        
        // for ($i=1; $i <= 12; $i++) {
        //     $month = date('F',mktime(0,0,0,$i,1));
        //     $count = 0;
        // }

         // foreach ($users as $user) {
        //     $count = 0; // Initialize count for each month
        //     foreach (range(1, 12) as $i) { // Iterate over all 12 months
        //         if ($user->month == $i) {
        //             $count = $user->count;
        //             break;
        //         }
        //     }

        // for ($i = 1; $i <= 12; $i++) {
        //     $month = date('F', mktime(0, 0, 0, $i, 1)); // Get month name
        //     $count = 0; // Initialize count for the month
    
        //     // Check if data exists for the current month
        //     foreach ($users as $user) {
        //         if ($user->month == $i) {
        //             $count = $user->count; // Update count if data exists for the month
        //             break;
        //         }
        //     }

        for ($i = 1; $i <= 12; $i++) {
            $monthName = date('F', mktime(0, 0, 0, $i, 1)); // Get month name
            array_push($labels, $monthName); // Add month name to labels array
            $data[$i] = 0; // Initialize count for the month to 0
        }
    
        // Populate data array with counts for each month
        foreach ($users as $user) {
            $data[$user->month] = $user->count;
        }

       
            
        //     $month = date('F', mktime(0, 0, 0, $user->month, 1));
        //     array_push($labels,$month);
        //     array_push($data,$count);
        // }

        $datasets  = [
            [
                'label' => 'Users',
                'backgroundColor' => $colors,
                'data' => array_values($data)
            ]
            ];

        return view('admin.dashboard', compact('datasets', 'labels'));

        //$admin = Auth::guard('admin')->user();

        //echo 'Welcome ' . $admin->name . ' <a href="' . route('admin.logout') . '">Logout</a>';
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    // public function profile() {
    //     return view('frontend.account.profile');
    // }
}
