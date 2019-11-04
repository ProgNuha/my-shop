<?php

class Sell extends CI_Controller{
    public function template($load_data)
	{
		$data['content'] = $this->load->view('templates/header');
		$data['content'] = $this->load->view('templates/footer');

		$data['content'] = $this->load->view('templates/template',$data);
		return $this->load->view('templates/template',$load_data);
    }
    
    public function insert(){
        foreach ($this->cart->contents() as $items) : {
            $this->m_sell->insert([
                'items' => $items['qty'],
                'code_good' => $items['id'],
                'total_price' => $items['subtotal']
            ]);
        }
        
        endforeach;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 04d3d4e1a96b3bfb8f34b4e1011960fe"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {                
            $responseobject = json_decode($response); //agar agar json menjadi objek php menggunakan json decode
            $data['kota'] = $responseobject->rajaongkir->results;
        }

        // $data1['content'] = $this->load->view('v_checkout',$data,true);
        // $this->load->view('v_template',$data1);


        $data_view['content'] = $this->load->view('sell', $data, true);
		$data_view1['content_'] = $this->template($data_view);
        $this->load->view('sell',$data_view1);
        
        // $this->load->view('templates/header');
        // $this->load->view('sell',$data);
        // $this->load->view('templates/footer');
    }
        
}

?>


