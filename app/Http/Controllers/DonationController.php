<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Donation;
// Init composer autoloader.
require '../vendor/autoload.php';

use RemoteMerge\Esewa\Client;
use RemoteMerge\Esewa\Config;

class DonationController extends Controller
{
    public function index() {
        return view('frontend.donation');
    }

    public function esewaPay(Request $request){
        $pid = uniqid();
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $amount = $request->amount;

        Donation::insert([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'amount' => $amount,
            'product_id' => $pid,
            'esewa_status' => 'unverified',
            'created_at' => Carbon::now(),
        ]);

        // Set success and failure callback URLs.
        $successUrl = url('/success');
        $failureUrl = url('/failure');

        // Config for development.
        $config = new Config($successUrl, $failureUrl);

        // Initialize eSewa client.
        $esewa = new Client($config);

        $esewa->process($pid, $amount, 0, 0, 0);
    }

    public function esewaPaySuccess() {
        $pid = $_GET['oid'];
        $refId = $_GET['refId'];
        $amount = $_GET['amt'];

        $donation = Donation::where('product_id', $pid)->first();
        
        $update_status = Donation::find($donation->id)->update([
            'esewa_status' => 'verified',
            'updated_at' => Carbon::now(),
        ]);

        // Check if the update was successful and the email hasn't been sent yet
        if ($update_status && $donation->email_sent != 1) {
            // Sending donation email
            donationEmail($donation->id);

            // Marking the email as sent to avoid duplicate sends
            $donation->update(['email_sent' => 1]);
        }

        if($update_status){
            $msg='Successful';
            $msg1 = 'Donation successful!! Thank you for your donation.';

            return view('frontend.thankyou',compact('msg', 'msg1'));
        }
    }

    public function esewaPayFailure() {
        $pid = $_GET['pid'];
        $donation = Donation::where('product_id', $pid)->first();
        
        $update_status = Donation::find($donation->id)->update([
            'esewa_status' => 'failed',
            'updated_at' => Carbon::now(),
        ]);
        if($update_status){
            $msg='Failed';
            $msg1 = 'There was some error when you were trying to make the donation.';
            return view('frontend.thankyou',compact('msg', 'msg1'));
        }
    }

    public function list(Request $request) {
        $search = $request->input('search');
        
        $donations = Donation::where('esewa_status','verified')->latest();

        if ($search) {
            $donations->where(function($donations) use ($search) {
                $donations->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        $donations = $donations->paginate(10);
        
        return view('admin.donations.list',[
            'donations' => $donations,
        ]);
    }

    
}
