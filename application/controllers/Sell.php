<?php

class Sell extends CI_Controller{
    public function insert(){
        foreach ($this->cart->contents() as $items) : {
            $this->m_sell->insert([
                'items' => $items['qty'],
                'code_good' => $items['id'],
                'total_price' => $items['subtotal']
            ]);
        }
        
        endforeach;

        $this->load->view('templates/header');
        $this->load->view('sell');
        $this->load->view('templates/footer');
    }
        
}

?>


