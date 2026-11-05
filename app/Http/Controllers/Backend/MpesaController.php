<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Services\MpesaService;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class MpesaController extends Controller
{
    protected $mpesaService;

    public function __construct(MpesaService $mpesaService)
    {
        $this->mpesaService = $mpesaService;
    }

    public function index()
    {
        return view('backend.payout.mpesa');
    }

    public function initiateStk(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'amount' => 'required|numeric|min:1',
        ]);

        $result = $this->mpesaService->stkPush($request->phone, $request->amount, 'BodaBora', 'Courier Payment');

        if ($result['success']) {
            Toastr::success('M-Pesa STK Push sent successfully to ' . $request->phone, 'Success');
        } else {
            Toastr::error('M-Pesa STK Push failed: ' . ($result['message'] ?? 'Unknown error'), 'Error');
        }

        return redirect()->back();
    }

    public function callback(Request $request)
    {
        $data = $request->all();
        \Log::info('M-Pesa Callback Received:', $data);

        // Process callback data here (store transaction / update parcel payment status)

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Success']);
    }
}
