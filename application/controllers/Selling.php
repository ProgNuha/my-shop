<?php

class Selling extends CI_Controller{
    public function insert(){ //fungsi Add To Cart
        // echo "insert";
        // $data = array(
        //     'total' => $this->input->post('total')
        // );
        $total = $this->cart->total();

        $this->m_selling->insert([
            'total' => $total,
            'status' => 'Belum bayar'
        ]);

        $this->load->view('templates/header');
		$this->load->view('selling', $total);
		$this->load->view('templates/footer');
    }

    public function cek_status(){
        $this->load->view('templates/header');
		$this->load->view('selling');
		$this->load->view('templates/footer');
    }

    public function show(){
        $data['status'] = $this->m_selling->show_data()->result();

		$this->load->view('templates/header');
		$this->load->view('set_status', $data);
		$this->load->view('templates/footer');
    }

    public function setStatus(){
        $code = $this->input->post('code');
        $status = $this->input->post('status');
        $this->m_selling->setStatus($code, $status);

        redirect('selling/show');
    }

    public function receipt(){
        $data["pembeli"]= array(
            "nama"=>$this->input->post("nama"),
            "nohp"=>$this->input->post("nohp"),
            "alamat"=>$this->input->post("alamat"),
            "kota"=>$this->input->post("kota"),
            "kodepos"=>$this->input->post("kodepos"),
            "total"=>$this->cart->total()
        );

        $idkota = $this->input->post('kotatujuan');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=501&destination=".$idkota."&weight=1700&courier=jne",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 04d3d4e1a96b3bfb8f34b4e1011960fe"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
            echo "cURL Error #:" . $err;
            } else {
            // echo $response;
            $responseobject = json_decode($response);
                $data['ongkir'] = $responseobject->rajaongkir->results[0]->costs[0]->cost[0]->value;
                
                $data1['content'] = $this->load->view('v_receipt',$data,true);
                $this->load->view('v_template',$data1);
            }

		// $this->load->view('templates/header');
		// $this->load->view('set_status', $data);
		// $this->load->view('templates/footer');
    }
}