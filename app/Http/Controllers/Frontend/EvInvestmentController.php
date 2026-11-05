<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\EvInvestment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class EvInvestmentController extends Controller
{
    public function index()
    {
        return theme_view('pages.ev_invest');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Identity — kept deliberately short so the form still takes about a minute.
            'name'        => ['required', 'string', 'max:255'],
            'email'       => ['required', 'email', 'max:255'],
            'phone'       => ['required', 'string', 'max:30', 'regex:/^[0-9+()\s-]{9,20}$/'],
            'country'     => ['required', 'string', 'max:100'],
            'national_id' => ['required', 'string', 'max:50'],

            // Investment intent.
            'bikes_count'     => ['required', 'integer', 'min:1', 'max:50'],
            'payment_method'  => ['required', 'string', 'max:100'],
            'referral_source' => ['required', 'string', 'max:100'],

            // Optional KYC — only collected if the investor chooses to share it.
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'county'        => ['nullable', 'string', 'max:100'],
            'occupation'    => ['nullable', 'string', 'max:150'],
            'kra_pin'       => ['nullable', 'string', 'max:50'],
            'notes'         => ['nullable', 'string', 'max:1000'],

            // Kenya Data Protection Act 2019 — explicit consent to process the data.
            'consent' => ['accepted'],
        ], [
            'consent.accepted' => 'Please confirm you consent to us processing your details so we can assess your application.',
        ]);

        // Pledged capital is derived from the configured bike price, never trusted from the request.
        $bikePrice = (int) config('rxcourier.ev_investment.bike_price', 195000);
        $bikes     = (int) $validated['bikes_count'];

        EvInvestment::create([
            'name'             => $validated['name'],
            'email'            => $validated['email'],
            'phone'            => $this->normalisePhone($validated['phone']),
            'country'          => $validated['country'],
            'national_id'      => $validated['national_id'],
            'date_of_birth'    => $validated['date_of_birth'] ?? null,
            'county'           => $validated['county'] ?? null,
            'occupation'       => $validated['occupation'] ?? null,
            'kra_pin'          => $validated['kra_pin'] ?? null,
            'referral_source'  => $validated['referral_source'],
            'bikes_count'      => $bikes,
            'total_investment' => $bikes * $bikePrice,
            'payment_method'   => $validated['payment_method'],
            'notes'            => $validated['notes'] ?? null,
            'consent'          => true,
            'consent_at'       => now(),
            'status'           => 1,
            'stage'            => 1,
        ]);

        Toastr::success('Electric Bike Investment registration submitted successfully! Our Green Fleet team will contact you shortly.', 'Success');
        return redirect()->back();
    }

    /**
     * Store M-Pesa numbers in a consistent format (digits and a leading + only).
     */
    private function normalisePhone(string $phone): string
    {
        return preg_replace('/[^0-9+]/', '', $phone);
    }
}
