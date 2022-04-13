<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Helper;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\GetTransactionRequest;
use App\Http\Requests\PatchTransactionRequest;
use StructTransaction;
use DB;
use Validation;


class TransactionController extends Controller
{
    function __construct()
    {
        $this->created = 201;
        $this->success = 200;
        $this->failed = 500;
        $this->notfound = 404;
    }

    function index(GetTransactionRequest $request): object
    {

        try {
            $start = $request->get('start') ?? 0;
            $limit = $request->get('limit') ?? 25;
            $listTransaction = Transaction::raw(function ($collection) {
                return $collection->aggregate(
                    [
                        [
                            '$match' =>
                                [
                                    'deleted_at' => [
                                        '$exists' => false
                                    ]
                                ]
                        ],
                        [
                            '$lookup' => [
                                'from' => "connote",
                                'as' => "connote",
                                'foreignField' => '"connote_id"',
                                'localField' => '"connote_id"'
                            ]
                        ],
                    ]);
            })->take($limit)->skip($start);
            return response()->json($listTransaction);
        } catch (\Exception $e) {

        }

    }


    function store(StoreTransactionRequest $request) : object
    {
        $transaction = null;
        $status = 'success';
        $message = 'Transaction ';
        try {
            $session = DB::getMongoClient()->startSession();
            $session->startTransaction();
            $format = StructTransaction::format($request, method: 'CREATE');
            $transaction = Transaction::create($format);
            $message .= 'Created';
            $session->commitTransaction();
        } catch (\Exception $e) {
            $status = 'Failed';
            $message .= $status;
            $session->abortTransaction();
        }
        $response = Helper::responseApp(status: $status, message: $message, data: $transaction);
        return response()->json($response, $this->created);
    }

    function detail($id) : object
    {
        $detailTransaction = Transaction::raw(function ($collection) {
            return $collection->aggregate(
                [[
                    '$lookup' => [
                        'from' => "connote",
                        'as' => "connote",
                        'foreignField' => '"connote_id"',
                        'localField' => '"connote_id"'
                    ]
                ],
                ]);
        })->where('transaction_id', $id)->where('deleted_at', null);
        return response()->json($detailTransaction);
    }

    function delete($id) : object
    {
        try {
            $status = 'success';
            $message = 'Transaction ';
            $session = DB::getMongoClient()->startSession();
            $session->startTransaction();
            $checkTransaction = self::checkTransaction($id);
            if (!$checkTransaction) {
                $message .= "Not Found";
                $response = Helper::responseApp(status: 'failed', message: $message);
                return response()->json($response, $this->notfound);
            }
            $message .= 'Deleted';
            Transaction::where('transaction_id', $id)->delete();
            $session->commitTransaction();
        } catch (\Exception $e) {
            $status = 'Failed';
            $message .= $status;
            $session->abortTransaction();

        }
        $response = Helper::responseApp(status: $status, message: $message);
        return response()->json($response, $this->success);

    }

    function checkTransaction($id) : bool {
        $checkTransaction = Transaction::where('transaction_id', $id)->where('deleted_at', 'exists', false)->first();
        if (!$checkTransaction) {
            return false;

        }
        return true;
    }

    function update(StoreTransactionRequest $request, $id) : object
    {
        try {
            $session = DB::getMongoClient()->startSession();
            $session->startTransaction();
            $status = 'success';
            $message = 'Transaction ';
            $checkTransaction = self::checkTransaction($id);
            if (!$checkTransaction) {
                $message .= "Not Found";
                $response = Helper::responseApp(status: 'failed', message: $message);
                return response()->json($response, $this->notfound);
            }
            $message .= 'Updated';
            $format = StructTransaction::format($request, method: 'UPDATE');
            Transaction::where('transaction_id', $id)->update($format, ['upsert' => true]);
            $session->commitTransaction();
        } catch (\Exception $e) {
            $status = 'Failed';
            $message .= $status;
            $session->abortTransaction();

        }
        $response = Helper::responseApp(status: $status, message: $message);
        return response()->json($response, $this->success);

    }

    function patch(PatchTransactionRequest $request, $id) : object
    {
        try {
            $session = DB::getMongoClient()->startSession();
            $session->startTransaction();
            $status = 'success';
            $message = 'Transaction ';
            $checkTransaction = self::checkTransaction($id);
            if (!$checkTransaction) {
                $message .= "Not Found";
                $response = Helper::responseApp(status: 'failed', message: $message);
                return response()->json($response, $this->notfound);
            }
            $message .= 'Updated';
            $validation = Validation::valid();
            $field = [];
            foreach ($validation as $key => $value) {
                if($request->get($key)){
                    $field[$key] = $request->get($key);
                }
            }
            Transaction::where('transaction_id', $id)->update($field, ['upsert' => true]);
            $session->commitTransaction();
        } catch (\Exception $e) {
            $status = 'Failed';
            $message .= $status;
            $session->abortTransaction();

        }
        $response = Helper::responseApp(status: $status, message: $message);
        return response()->json($response, $this->success);
    }


}
