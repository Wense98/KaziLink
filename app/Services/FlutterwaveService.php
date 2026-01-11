<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FlutterwaveService
{
    protected $publicKey;
    protected $secretKey;
    protected $encryptionKey;
    protected $baseUrl = 'https://api.flutterwave.com/v3';

    public function __construct()
    {
        $this->publicKey = config('services.flutterwave.public_key');
        $this->secretKey = config('services.flutterwave.secret_key');
        $this->encryptionKey = config('services.flutterwave.encryption_key');
    }

    /**
     * Initiate a Standard Payment
     * 
     * @param float $amount
     * @param string $currency
     * @param string $email
     * @param string $txRef
     * @param string $redirectUrl
     * @param array $meta
     * @return array|null [status, message, link]
     */
    public function initiatePayment($amount, $currency, $email, $txRef, $redirectUrl, $meta = [])
    {
        try {
            $payload = [
                'tx_ref' => $txRef,
                'amount' => $amount,
                'currency' => $currency,
                'redirect_url' => $redirectUrl,
                'payment_options' => 'card,mobilemoneytanzania,ussd',
                'customer' => [
                    'email' => $email,
                    'name' => $meta['consumer_name'] ?? 'KaziLink User',
                ],
                'customizations' => [
                    'title' => 'KaziLink Payments',
                    'description' => 'Payment for service',
                    'logo' => asset('images/logo.png'), 
                ],
                'meta' => $meta
            ];

            $response = Http::withToken($this->secretKey)->post($this->baseUrl . '/payments', $payload);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Flutterwave Payment Error: ' . $response->body());
            return null;

        } catch (\Exception $e) {
            Log::error('Flutterwave Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Verify Transaction
     * 
     * @param string $transactionId
     * @return array|null
     */
    public function verifyTransaction($transactionId)
    {
        try {
            $response = Http::withToken($this->secretKey)->get($this->baseUrl . '/transactions/' . $transactionId . '/verify');

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('Flutterwave Verify Error: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('Flutterwave Verify Exception: ' . $e->getMessage());
            return null;
        }
    }
}
