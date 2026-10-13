<?php
// namespace App\Services;

// use Exception;

// class Messenger360Service
// {
//     protected string $url;
//     protected string $token;

//     public function __construct()
//     {
//         $this->url   = env('MESSENGER360_URL');
//         $this->token = env('MESSENGER360_API_KEY');

//         //  dd($this->token);
//     }

//     /**
//      * Send Normal WhatsApp Message
//      */
//     public function send(
//         string $phone,
//         string $text,
//         ?string $mediaUrl = null,
//         ?string $delay = null
//     ): array {

//         // if (!config('services.whatsapp.enabled')) {
//         //     return [
//         //         'success' => false,
//         //         'message' => 'WhatsApp service disabled',
//         //     ];
//         // }

//         $postFields = [
//             'phonenumber' => $phone,
//             'text'        => $text,
//         ];

//         if ($mediaUrl) {
//             $postFields['url'] = $mediaUrl;
//         }

//         if ($delay) {
//             $postFields['delay'] = $delay;
//         }

//         $ch = curl_init();

//         curl_setopt_array($ch, [
//             CURLOPT_URL            => $this->url,
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_POST           => true,
//             CURLOPT_POSTFIELDS     => $postFields,
//             CURLOPT_HTTPHEADER     => [
//                 'Authorization: Bearer ' . $this->token,
//                 'Accept: application/json',
//             ],
//             CURLOPT_TIMEOUT        => 30,
//         ]);

//         $response = curl_exec($ch);

//         if (curl_errno($ch)) {
//             throw new Exception(curl_error($ch));
//         }

//         $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

//         curl_close($ch);

//         return [
//             'http_code' => $httpCode,
//             'response'  => json_decode($response, true) ?? $response,
//         ];
//     }

//     /**
//      * Send Interactive Buttons
//      */
//     public function sendButtons($phone, $text, $buttons)
//     {
//         $payload = [
//             "phonenumber" => $phone,
//             "type"        => "interactive",
//             "interactive" => json_encode([
//                 "type"   => "button",
//                 "body"   => [
//                     "text" => $text,
//                 ],
//                 "action" => [
//                     "buttons" => array_map(function ($btn) {
//                         return [
//                             "type"  => "reply",
//                             "reply" => [
//                                 "id"    => $btn['id'],
//                                 "title" => $btn['text'],
//                             ],
//                         ];
//                     }, $buttons),
//                 ],
//             ]),
//         ];

//         $ch = curl_init();

//         curl_setopt_array($ch, [
//             CURLOPT_URL            => $this->url,
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_POST           => true,
//             CURLOPT_POSTFIELDS     => $payload,
//             CURLOPT_HTTPHEADER     => [
//                 'Authorization: Bearer ' . $this->token,
//                 'Accept: application/json',
//             ],
//         ]);

//         $response = curl_exec($ch);

//         if (curl_errno($ch)) {
//             throw new Exception(curl_error($ch));
//         }

//         $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

//         curl_close($ch);

//         return [
//             'http_code' => $httpCode,
//             'response'  => json_decode($response, true) ?? $response,
//         ];
//     }

namespace App\Services;

use App\Models\WhatsAppUnsubscribe;
use Exception;
use Illuminate\Support\Facades\Log;

class Messenger360Service
{
    protected string $url;
    protected string $token;

    public function __construct()
    {
        $this->url   = env('MESSENGER360_URL');
        $this->token = env('MESSENGER360_API_KEY');

        if (empty($this->url) || empty($this->token)) {
            Log::warning('Messenger360 credentials not set in .env file.');
        }
    }

    /**
     * Send Normal WhatsApp Message with Unsubscribe Link
     */
    public function send(
        string $phone,
        string $text,
        ?string $mediaUrl = null,
        ?string $delay = null
    ): array {

        // Check if number is unsubscribed
        if ($this->isUnsubscribed($phone)) {
            return [
                'success' => false,
                'message' => 'Number has unsubscribed from WhatsApp messages',
            ];
        }

        // API Unsubscribe Link
        $unsubscribeLink = url('/api/whatsapp/unsubscribe?phone=' . urlencode($phone));

        $fullText  = trim($text) . "\n\n";
        $fullText .= "To stop receiving messages, click here: " . $unsubscribeLink;

        $postFields = [
            'phonenumber' => $phone,
            'text'        => $fullText,
        ];

        if ($mediaUrl) {
            $postFields['url'] = $mediaUrl;
        }

        if ($delay) {
            $postFields['delay'] = $delay;
        }

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL            => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $postFields,
            CURLOPT_HTTPHEADER     => [
                'Authorization: Bearer ' . $this->token,
                'Accept: application/json',
            ],
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            Log::error("Messenger360 CURL Error: " . $error);
            throw new Exception($error);
        }

        curl_close($ch);

        $decodedResponse = json_decode($response, true);

        return [
            'success'   => $httpCode === 200,
            'http_code' => $httpCode,
            'response'  => $decodedResponse ?? $response,
        ];
    }

    /**
     * Send Interactive Buttons Message with Unsubscribe Link
     */
    public function sendButtons(string $phone, string $text, array $buttons): array
    {
        if ($this->isUnsubscribed($phone)) {
            return [
                'success' => false,
                'message' => 'Number has unsubscribed',
            ];
        }

        $unsubscribeLink = url('/api/whatsapp/unsubscribe?phone=' . urlencode($phone));

        $fullText = trim($text) . "\n\nTo unsubscribe: " . $unsubscribeLink;

        $payload = [
            "phonenumber" => $phone,
            "type"        => "interactive",
            "interactive" => json_encode([
                "type"   => "button",
                "body"   => ["text" => $fullText],
                "action" => [
                    "buttons" => array_map(function ($btn) {
                        return [
                            "type"  => "reply",
                            "reply" => [
                                "id"    => $btn['id'] ?? uniqid(),
                                "title" => substr($btn['text'] ?? $btn, 0, 20),
                            ],
                        ];
                    }, $buttons),
                ],
            ]),
        ];

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL            => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => [
                'Authorization: Bearer ' . $this->token,
                'Accept: application/json',
            ],
            CURLOPT_TIMEOUT        => 30,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            Log::error("Messenger360 Buttons Error: " . $error);
            throw new Exception($error);
        }

        curl_close($ch);

        return [
            'success'   => $httpCode === 200,
            'http_code' => $httpCode,
            'response'  => json_decode($response, true) ?? $response,
        ];
    }

    /**
     * Check if phone number has unsubscribed
     */
    private function isUnsubscribed(string $phone): bool
    {
        return WhatsAppUnsubscribe::where('phone', $phone)
            ->where('is_active', true)
            ->exists();
    }

}
