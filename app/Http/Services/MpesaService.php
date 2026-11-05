<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
use App\Enums\Status;

class MpesaService
{
    protected function getBaseUrl()
    {
        $isSandbox = globalSettings('mpesa_sandbox_mode') == Status::ACTIVE;
        return $isSandbox
            ? 'https://sandbox.safaricom.co.ke'
            : 'https://api.safaricom.co.ke';
    }

    public function generateToken()
    {
        $consumerKey = globalSettings('mpesa_consumer_key');
        $consumerSecret = globalSettings('mpesa_consumer_secret');

        if (empty($consumerKey) || empty($consumerSecret)) {
            return null;
        }

        $url = $this->getBaseUrl() . '/oauth/v1/generate?grant_type=client_credentials';

        try {
            $response = Http::withBasicAuth($consumerKey, $consumerSecret)->get($url);
            if ($response->successful()) {
                return $response->json()['access_token'] ?? null;
            }
        } catch (\Exception $e) {
            \Log::error('M-Pesa Token Error: ' . $e->getMessage());
        }

        return null;
    }

    public function stkPush($phone, $amount, $accountReference = 'BodaBora', $transactionDesc = 'Parcel Payment')
    {
        $token = $this->generateToken();
        if (!$token) {
            return ['success' => false, 'message' => 'Failed to generate M-Pesa access token. Check credentials.'];
        }

        $shortcode = globalSettings('mpesa_shortcode');
        $passkey = globalSettings('mpesa_passkey');

        if (empty($shortcode) || empty($passkey)) {
            return ['success' => false, 'message' => 'M-Pesa shortcode or passkey is missing.'];
        }

        $timestamp = date('YmdHis');
        $password = base64_encode($shortcode . $passkey . $timestamp);

        $url = $this->getBaseUrl() . '/mpesa/stkpush/v1/processrequest';

        // Format phone number to 254XXXXXXXXX
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (substr($phone, 0, 1) === '0') {
            $phone = '254' . substr($phone, 1);
        }

        $callbackUrl = route('mpesa.callback');

        $payload = [
            'BusinessShortCode' => $shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => (int)$amount,
            'PartyA' => $phone,
            'PartyB' => $shortcode,
            'PhoneNumber' => $phone,
            'CallBackURL' => $callbackUrl,
            'AccountReference' => $accountReference,
            'TransactionDesc' => $transactionDesc,
        ];

        try {
            $response = Http::withToken($token)->post($url, $payload);
            if ($response->successful()) {
                return ['success' => true, 'data' => $response->json()];
            } else {
                return ['success' => false, 'message' => $response->body()];
            }
        } catch (\Exception $e) {
            \Log::error('M-Pesa STK Push Error: ' . $e->getMessage());
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
