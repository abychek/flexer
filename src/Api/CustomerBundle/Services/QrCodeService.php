<?php

namespace Api\CustomerBundle\Services;


class QrCodeService
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function qrcode($data)
    {
        $data = json_encode(['content' => json_encode($data)]);
        $ch = curl_init('http://127.0.0.1:3000/qrcode');
        curl_setopt_array($ch, [
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            ],
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $data,
            CURLOPT_RETURNTRANSFER => true
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true)['code'];
    }
}