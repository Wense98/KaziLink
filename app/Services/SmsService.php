<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{
    protected $apiKey;
    protected $secretKey;
    protected $sourceName;

    public function __construct()
    {
        $this->apiKey = config('services.beem.api_key');
        $this->secretKey = config('services.beem.secret_key');
        $this->sourceName = config('services.beem.source_name', 'KaziLink');
    }

    /**
     * Send SMS using Beem Africa API
     */
    public function sendSms($phoneNumber, $message)
    {
        // Normalize phone number (E.164 format without + for Beem)
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        if (strpos($phoneNumber, '0') === 0) {
            $phoneNumber = '255' . substr($phoneNumber, 1);
        }

        if (!$this->apiKey || !$this->secretKey) {
            Log::warning("SmsService: API keys missing. Simulating SMS to $phoneNumber: $message");
            return true;
        }

        try {
            $response = Http::withBasicAuth($this->apiKey, $this->secretKey)
                ->post('https://api.beem.africa/v1/send', [
                    'source_addr' => $this->sourceName,
                    'schedule_time' => '',
                    'encoding' => '0',
                    'message' => $message,
                    'recipients' => [
                        [
                            'recipient_id' => '1',
                            'dest_addr' => $phoneNumber,
                        ],
                    ],
                ]);

            if ($response->successful()) {
                return true;
            }

            Log::error("Beem SMS Error: " . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error("Beem SMS Exception: " . $e->getMessage());
            return false;
        }
    }
}
