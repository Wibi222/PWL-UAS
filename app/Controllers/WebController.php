<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class WebController extends Controller
{
    public function callMonthlyApi()
    {
        // Include the function file
        include_once(APPPATH . 'ThirdParty/fungsi.php');

        // Define the parameters for the API request
        $params = [
            'type' => 'transaction',  // bisa diubah ke 'earning' atau 'user' sesuai kebutuhan
            'tahun' => '2024',
            'bulan' => '07'
        ];

        // Call the API using the curl function
        $response = curl('monthly', http_build_query($params));

        // Pass the response to the view
        return view('api_response', ['response' => $response]);
    }
}
?>