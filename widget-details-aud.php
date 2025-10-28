<?php
// Disable HTTP caching
header("Expires: Thu, 19 Nov 1969 08:52:00 GMT"); // Past date
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false); // HTTP/1.1 (IE-specific)
header("Pragma: no-cache"); // HTTP/1.0

//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$uri = $_SERVER['REQUEST_URI'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$controller = new WidgetDetails();
	$jsonResponse = $controller->handleRequest();

    echo $jsonResponse;
} else {
    http_response_code(405);
    return json_encode(['error' => 'Unsupported HTTP Method']);
}


class WidgetDetails
{
    public function handleRequest()
    {
		$rawData = file_get_contents("php://input");
		$postData = json_decode($rawData, true);
		
		if ($postData === null) {
			http_response_code(400);
			return json_encode(['error' => 'Invalid JSON data']);
		}
		
		if (preg_match('/^U2F[A-Za-z0-9+\/ ]+=$/', $postData['transaction_id'])) {  

			$responseData = $this->processData($postData);
			header('Content-Type: application/json');
			
		}else{
			
			$responseData['status'] = 'EXPIRED';
			$responseData['user_id'] = 0;
			$responseData['amount'] = 0;
			$responseData['pocket_address'] = '';
			$responseData['card'] = '';
			$responseData['redirect_url'] = '#';
			$responseData['send_id'] = '';
			$responseData['alias'] = '';
			
		}
		
		
        return json_encode($responseData);
    }

    private function processData($data)
    {
        $path = '../../p2p-merchant-key-aud.json';

        if ($data['env'] === 'local') {
            $externalApiUrl = 'http://localhost:3333/api/admin/transactions/widget/details';
            $path = '../p2p-merchant-key-aud.json';
            $fileData = json_decode(file_get_contents($path), true);
            $apiKey = $fileData['adm-api-key-local'];
        } elseif ($data['env'] === 'stage') {
            $fileData = json_decode(file_get_contents($path), true);
            $externalApiUrl = 'https://api.stage.insideex.cc/api/admin/transactions/widget/details';
            $apiKey = $fileData['adm-api-key-stage'];
        } else {
            $fileData = json_decode(file_get_contents($path), true);
            $externalApiUrl = 'https://api2.backendinside.cc/api/admin/transactions/widget/details';
            $apiKey = $fileData['adm-api-key-prod'];
        }

        $headers = [
            'Content-Type: application/json',
            'adm-api-key: ' . $apiKey,
        ];

        $transactionId = $data['transaction_id'];
        $transactionId = str_replace(' ', '+', $transactionId);

        $requestData = [
            'transaction_id' => $transactionId
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

		$response = json_decode($response, true);
		//return $response;
	
		
	
		$response_trim['order_id'] = $response['order_id'];
		$response_trim['currency'] = $response['currency'];
		$response_trim['iban'] = $response['iban'];
		//$response_trim['id'] = $response['id'];
		$response_trim['status'] = $response['status'];
        $response_trim['transactionId'] = $response['currency'] != 'AUD' ? $response['order_id'] : $response['id'];
		$response_trim['transaction_id'] = $response['hashed_id'];
		$response_trim['redirect_url'] = $response['redirect_url'];
		$response_trim['amount'] = $response['amount'];
		$response_trim['pocket_address'] = $response['pocket_address'];
		$response_trim['card'] = $response['card'];
		$response_trim['operator_bank'] = $response['operator_bank'];
		$response_trim['operator_bank_title'] = $response['operator_bank_title'];
		$response_trim['customer_id'] = $response['customer_id'];
		$response_trim['user_id'] = $response['user_id'];
		$response_trim['alias'] = $response['iban'];
		$response_trim['send_id'] = $response['send_id'];
		$response_trim['operator_bank_title'] = $response['operator_bank_title'];
		$response_trim['expires_at'] = $response['expires_at'];
		$response_trim['first_name'] = $response['first_name'];
		$response_trim['last_name'] = $response['last_name'];
		$response_trim['service'] = (int)$response['service'];
		$response_trim['additional_data'] = $response['additional_data'];
		$response_trim['merchantBank'] = $response['merchantBank'];
		$response_trim['priority_bank'] = $response['priority_bank'];
		$response_trim['tax_id'] = $response['client_data']['tax_id'];
		
        return $response_trim;
        //return json_decode($response, true);
    }
}
