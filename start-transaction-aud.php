<?php
// Disable HTTP caching
header("Expires: Thu, 19 Nov 1969 08:52:00 GMT"); // Past date
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false); // HTTP/1.1 (IE-specific)
header("Pragma: no-cache"); // HTTP/1.0

//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$uri = $_SERVER['REQUEST_URI'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new CreateTransaction();

    $jsonResponse = $controller->handleRequest();

    echo $jsonResponse;
} else {
    http_response_code(405);
    return json_encode(['error' => 'Unsupported HTTP Method']);
}


class CreateTransaction
{
    public function handleRequest()
    {
        $rawData = file_get_contents("php://input");

        $postData = json_decode($rawData, true);
		
        if ($postData === null) {
            http_response_code(400);
            return json_encode(['error' => 'Invalid JSON data']);
        }

        $responseData = $this->processData($postData);

        header('Content-Type: application/json');
    

        return json_encode($responseData);
    }

    private function processData($data)
    {
        $path = '../../p2p-merchant-key-aud.json';

        if ($data['env'] === 'local') {
            $externalApiUrl = 'http://localhost:3333/api/admin/transactions/start-transaction';
            $path = '../p2p-merchant-key-aud.json';
            $fileData = json_decode(file_get_contents($path), true);
            $apiKey = $fileData['adm-api-key-local'];
        } elseif ($data['env'] === 'stage') {
            $fileData = json_decode(file_get_contents($path), true);
            $externalApiUrl = 'https://api.stage.insideex.cc/api/admin/transactions/start-transaction';
            $apiKey = $fileData['adm-api-key-stage'];
        } else {
            $fileData = json_decode(file_get_contents($path), true);
            $externalApiUrl = 'https://api2.backendinside.cc/api/admin/transactions/start-transaction';
            $apiKey = $fileData['adm-api-key-prod'];
        }

        $headers = [
            'Content-Type: application/json',
            'adm-api-key: ' . $apiKey,
        ];

        $requestData = [
            'data' => [
                'transaction_id' => $data['transaction_id'],
                'fields' => [
					'utr' => $data['utr'],
					'tax_id' => $data['tax_id']
				]
            ]
        ];

        $ch = curl_init($externalApiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return ['error' => 'Error connecting to external API'];
        }

        curl_close($ch);

        return json_decode($response, true);
    }
}
