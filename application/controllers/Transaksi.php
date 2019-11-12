<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'third_party/PhpSpreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Transaksi extends CI_Controller {

    public function __construct(){
        parent::__construct();
        // if($this->session->userdata('auth') != TRUE){
        //     $url=base_url()."Administrator";
        //     redirect($url);
        // }
        $this->load->helper(array('form', 'url'));
        $this->load->model('PenjualanModel');
        $this->load->model('BarangModel');
        require_once APPPATH.'third_party/PhpSpreadsheet/vendor/phpoffice/phpspreadsheet/src/Bootstrap.php';
    }
    
    public function index(){
        $data = array();
        $data['dataTransaksi'] = $this->PenjualanModel->getAll();
        $data['Content'] = $this->load->view('admin/transaksi', $data, TRUE);
        $this->load->view('shop/template', $data);
    }

    public function bayar($kode){
        $this->PenjualanModel->update($kode, array( 'Status' => 'Sudah Bayar'));
        redirect(base_url().'transaksi');
    }

    public function kirim($kode){
        $this->PenjualanModel->update($kode, array( 'Status' => 'Sedang Dikirim'));
        redirect(base_url().'transaksi');
    }

    // READ FILE DARI PRIVATE
    private function returnFile( $filename ) 
    {
        // Check if file exists, if it is not here return false:
        if ( !file_exists( $filename )) return false;
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        // Suggest better filename for browser to use when saving file:
        header('Content-Disposition: attachment; filename='.basename($filename));
        header('Content-Transfer-Encoding: binary');
        // Caching headers:
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        // This should be set:
        header('Content-Length: ' . filesize($filename));
        // Clean output buffer without sending it, alternatively you can do ob_end_clean(); to also turn off buffering.
        ob_clean();
        // And flush buffers, don't know actually why but php manual seems recommending it:
        flush();
        // Read file and output it's contents:
        readfile( $filename );
        // You need to exit after that or at least make sure that anything other is not echoed out:
        exit;
    }

    public function import(){
        $this->load->library('excel');
        if(isset($_FILES["excel"]["name"])){
            $path = $_FILES["excel"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach($object->getWorksheetIterator() as $worksheet){
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for($row=2; $row<=$highestRow; $row++){
                    $id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $harga = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $stock = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $file_gambar = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $keterangan = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $berat = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

                    $data[] = array(
                        'kode'            => $id,
                        'nama'          => $nama,
                        'harga'         => $harga,
                        'stock'         => $stock,
                        'file_gambar'   => $file_gambar,
                        'keterangan'    => $keterangan,
                        'berat'         => $berat
                    );
                }
            }
            $this->BarangModel->insert_batch($data);
            redirect(base_url("Transaksi"));
        } 
    }

    function export(){
        $this->load->library("excel");
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $table_columns = array("Kode Barang", "Nama", "Harga", "Stock", "Nama File Gambar", "Keterangan","berat");
        $column = 0;
        $dataBarang = $this->BarangModel->getAll();
        foreach($table_columns as $field){
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        $excel_row = 2;
        if($dataBarang){
            foreach($dataBarang as $row)
            {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->kode);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->nama);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->harga);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->stock);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->file_gambar);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->keterangan);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->berat);
                $excel_row++;
            }
        }
        $current_date  = date('Y-m-d',strtotime('+5 hours'));
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$current_date.'- Data Barang.xls"');
        $object_writer->save('php://output');
    }

    public function downloadBarang(){
        $date = date('Y-m-d');
        $all = $this->BarangModel->getAllArray();
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setCellValue('A1', 'Kode Barang');
        $sheet->setCellValue('B1', 'Nama Barang');
        $sheet->setCellValue('C1', 'Harga Barang');
        $sheet->setCellValue('D1', 'Stock Barang');
        $sheet->setCellValue('E1', 'Alamat File Gambar');
        $sheet->setCellValue('F1', 'Keterangan');
        $sheet->setCellValue('G1', 'Berat');
        
        $i = 2;
        
        foreach($all as $value){
            $value['kode'] = isset($value['kode']) ? $value['kode'] : '';
            $value['nama'] = isset($value['nama']) ? $value['nama'] : '';
            $value['harga'] = isset($value['harga']) ? $value['harga'] : '';
            $value['stock'] = isset($value['stock']) ? $value['stock'] : '';
            $value['file_gambar'] = isset($value['file_gambar']) ? $value['file_gambar'] : '';
            $value['keterangan'] = isset($value['keterangan']) ? $value['keterangan'] : '';
            $value['berat'] = isset($value['berat']) ? $value['berat'] : '';

            $sheet->setCellValue('A'.$i, $value['kode']);
            $sheet->setCellValue('B'.$i, $value['nama']);
            $sheet->setCellValue('C'.$i, $value['harga']);
            $sheet->setCellValue('D'.$i, $value['stock']);
            $sheet->setCellValue('E'.$i, $value['file_gambar']);
            $sheet->setCellValue('F'.$i, $value['keterangan']);
            $sheet->setCellValue('G'.$i, $value['berat']);
            $i++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('dokumen/LaporanBarang'.$date.'.xlsx');
        
        $full = 'dokumen/LaporanBarang'.$date.'.xlsx';
        
        $this->returnFile( $full );
    }

}