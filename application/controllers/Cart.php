<?php

class Cart extends CI_Controller{
    function add_to_cart(){ //fungsi Add To Cart
        $data = array(
            'id' => $this->input->post('produk_id'), 
            'name' => $this->input->post('produk_nama'), 
            'price' => $this->input->post('produk_harga'), 
            'qty' => $this->input->post('quantity'), 
        );
        $this->cart->insert($data);

        $this->load->view('templates/header');
		$this->load->view('add_to_chart', $data);
		$this->load->view('templates/footer');
    }

    function show_cart(){ //Fungsi untuk menampilkan Cart
        $output = '';
        $no = 0;
        foreach ($this->cart->contents() as $items) {
            $no++;
            $output .='
                <tr>
                    <td>'.$items['name'].'</td>
                    <td>'.number_format($items['price']).'</td>
                    <td>
                        <div class="form-label-group">
                        <input type="text" class="form-control text-center" value="'.$items['qty'].'">
                        </div>
                    </td>
                    <td>'.number_format($items['subtotal']).'</td>
                    <td><button type="button" id="'.$items['rowid'].'" class="delete_cart btn btn-danger btn-xs">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                    </button></td>
                </tr>
            ';
        }
        $output .= '
            <tr>
                <th colspan="3">Total</th>
                <th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
            </tr>
        ';
        return $output;
    }

    function load_cart(){ //load data cart
        echo $this->show_cart();
    }

    function delete_cart(){ //fungsi untuk menghapus item cart
        $data = array(
            'rowid' => $this->input->post('row_id'), 
            'qty' => 0, 
        );
        $this->cart->update($data);
        echo $this->show_cart();
    }

    function destroy_cart(){
        $this->cart->destroy();
    }

    function updateItemQty(){
        $update = 0;
        
        // Get cart item info
        $rowid = $this->input->get('rowid');
        $qty = $this->input->get('qty');
        
        // Update item in the cart
        if(!empty($rowid) && !empty($qty)){
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty
            );
            $update = $this->cart->update($data);
        }
        
        // Return response
        echo $update?'ok':'err';
    }

    public function chekout(){
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
    }
}

?>