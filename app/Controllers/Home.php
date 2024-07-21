<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class Home extends BaseController
{
    protected $product;
    protected $transaction;
    protected $transaction_detail;

    function __construct()
    {
        helper('form');
        helper('number');
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
        $this->product = new ProductModel();
        $this->product = new ProductModel();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();

    }

    public function index(): string
    {
        $product = $this->product->findAll();
        $data['product'] = $product;

        return view('v_home', $data);
    }

    public function faq()
    {
        return view('v_faq');
    }

    public function profile()
    {
        $username = session()->get('username');

        $data['username'] = $username;

        $buy = $this->transaction->where('username', $username)->findAll();
        $data['buy'] = $buy;

        $product = [];

        if (!empty($buy)) {
            foreach ($buy as $item) {
                $detail = $this->transaction_detail->select('transaction_detail.*, product.nama, product.harga, product.foto')->join('product', 'transaction_detail.product_id=product.id')->where('transaction_id', $item['id'])->findAll();

                if (!empty($detail)) {
                    $product[$item['id']] = $detail;
                }
            }
        }

        $data['product'] = $product;

        return view('v_profile', $data);
    }

    public function contact()
    {
        return view('v_contact');
    }

    public function transaksi()
    {
        $username = session()->get('username');

        $data['username'] = $username;

        $buy = $this->transaction->where('username', $username)->findAll();
        $data['buy'] = $buy;

        $product = [];

        if (!empty($buy)) {
            foreach ($buy as $item) {
                $detail = $this->transaction_detail->select('transaction_detail.*, product.nama, product.harga, product.foto')->join('product', 'transaction_detail.product_id=product.id')->where('transaction_id', $item['id'])->findAll();

                if (!empty($detail)) {
                    $product[$item['id']] = $detail;
                }
            }
        }

        $data['product'] = $product;

        return view('v_transaksi', $data);
    }
    public function changeStatus()
    {
        // Get the request object
        $request = \Config\Services::request();
        
        // Check if the request is an AJAX request
        if ($request->isAJAX()) {
            // Get the POST data
            $data = $request->getJSON(true);
            
            // Validate the input data
            if (!isset($data['id']) || !isset($data['status']) || !in_array($data['status'], ['0', '1'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid input.'
                ]);
            }

            // Load the model
            $transaction = new TransactionModel();
            
            // Update the status in the database
            $result = $transaction->update($data['id'], ['status' => $data['status']]);
            
            if ($result) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Status updated successfully.'
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Failed to update status.'
                ]);
            }
        } else {
            return $this->response->setStatusCode(403);
        }
    }
}
