<?php

namespace app\Controller;

use app\Model\TransactionModel;

class TransactionController {
    private $db;
    private $requestMethod;
    private $model;
    private $referenceID;
    private $merchantID;

    public function __construct($db, $requestMethod, $referenceID, $merchantID)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;
        $this->referenceID = $referenceID;
        $this->merchantID = $merchantID;

        $this->model = new TransactionModel($db);
    }

    public function routes()
    {
        header('Content-Type: application/json');
        switch ($this->requestMethod) {
            case 'GET':
                if (!empty($this->referenceID) && !empty($this->merchantID)) {
                    $this->getTransaction($this->referenceID, $this->merchantID);
                } else {
                    $this->routeNotFound();
                };
                break;
            case 'POST':
                if (empty($this->referenceID) && empty($this->merchantID)) {
                    $this->createTransaction();
                } else {
                    $this->routeNotFound();
                };
                break;
            default:
                $this->routeNotFound();
                break;
        }
    }

    private function createTransaction()
    {
        $request = json_decode(file_get_contents('php://input'), true);
        $request['status'] = 'Pending';

        if (
            isset($request['invoice_id']) &&
            isset($request['item_name']) &&
            isset($request['amount']) &&
            isset($request['payment_type']) &&
            isset($request['customer_name']) &&
            isset($request['merchant_id'])
        ){
            $merchant = $this->model->getMerchant($request['merchant_id']);
            if (!$merchant) {
                return $this->responseError(404, 'merchant not found');
            }

            if ($request['payment_type'] == 'virtual_account') {
                $number_va = rand();
            } else {
                $number_va = null;
            }
            $request['number_va'] = $number_va;

            $id = $this->model->createTransaction($request);
            if (!$id) {
                return $this->responseError(500, 'failed create transaction');
            } else{
                $res = array(
                    "success" => "true",
                    "code" => 200,
                    "data" => [
                        "id" => $id,
                        "no_va" => $request['number_va'],
                        'status' => $request['status']
                    ],
                );
        
                http_response_code(200);
                echo json_encode($res);
            }
        } else {
            return $this->responseError(400, 'Bad request : invoice_id, item_name, amount, payment_type, customer_name, merchant_id is required');
        }
    }

    private function getTransaction($referenceID, $merchantID)
    {
        $result = $this->model->getTransaction($referenceID, $merchantID);
        if (!$result) {
            return $this->responseError(404, 'transaction not found');
        }

        $res = array(
            "success" => "true",
            "code" => 200,
            "data" => $result,
        );

        http_response_code(200);
        echo json_encode($res);
    }

    private function responseError($code, $msg) {
        $res = array(
            "success" => "false",
            "code" => $code,
            "message" => $msg,
        );

        http_response_code($code,);
        echo json_encode($res);
    }

    private function routeNotFound()
    {
        $res = array(
            "success" => "false",
            "code" => 404,
            "message" => 'route not found',
        );

        http_response_code(404);
        echo json_encode($res);
    }
}
