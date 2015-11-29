<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftar extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_registrant','reg');
        $this->load->model('Model_parent','parent');
    }
    
    public function index(){
        $this->beranda();
    }
    
    // ================= AFTER LOGIN ===========================
    
    public function beranda($id){
        $this->blockUnloggedOne($id);
        $data = [
            'title' => 'Beranda',
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
            'registrant' => $this->session->registrant,
            'img_link' => $this->getImgLink($id),
            'img_receipt' => $this->getImgReceipt($id),
            'status' => $this->reg->cek_status($id),
            'nav_pos' => 'home'
        ];
        $this->CustomView('registrant/profile', $data);
    }
    
    public function password($id){
        $this->blockUnloggedOne($id);
        $data = [
            'title' => 'Password',
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
            'registrant' => $this->session->registrant,
            'nav_pos' => 'home'
        ];
        $this->CustomView('registrant/password', $data);
    }
    
    public function change_password($id){
        $this->blockUnloggedOne($id);
        $registrant = $this->reg->getData(null, $id);
        $data = $this->input->post(null, true);
        if($data['new_password'] == $data['confirm_password']){
            if(password_verify($data['stored_password'], $registrant->getPassword())){
                $this->do_change_password(['password' => $data['new_password'], 'id' => $id]);
            } else {
                $this->session->set_flashdata("errors", [0 => "Maaf, Password lama anda salah <br />"
                    . "Silahkan di periksa kembali."]);
                redirect($id.'/password');
            }
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, Password baru dan konfirmasi password tidak sama, <br />"
                . "Silahkan di periksa kembali."]);
            redirect($id.'/password');
        }        
    }
    
    private function do_change_password($data){
        $res = $this->reg->updateData($data);
        if($res){
            $this->session->set_userdata('registrant', $this->reg->getRegistrant());
            $this->session->set_flashdata("notices", [0 => "Passsword sudah berhasil diubah."]);
            redirect($data['id'].'/password');
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, Terjadi Kesalahan"]);
            redirect($data['id'].'/password');
        }
    }
    
    private function getImgLink($id){
        $this->load->helper('file');
        $img_link = '';
        $file = read_file('./data/foto/'.$id.'.png');
        $datetime = new DateTime('now');
        if($file == false){
            $img_link = base_url().'assets/images/default.png';
        }  else {
            $img_link = base_url().'pendaftar/getFoto/'.$id.'/'.hash('md2', $datetime->format('Y-m-d H:i:s'));
        }
        return $img_link;
    }
    
    public function getFoto($id, $hash){
        $this->blockUnloggedOne($id, true);
        $imagine = new Imagine\Gd\Imagine();
        $image = $imagine->open('./data/foto/'.$id.'.png');
        $this->session->set_userdata('random_hash', $hash);
        $image->show('png');
    }
    
    public function do_edit_profil($id){
        $this->blockUnloggedOne($id);
        $data = $this->input->post(null, true);
        $data['id'] = $id;
        $res = $this->reg->updateData($data);
        if($res){
            $this->session->set_userdata('registrant', $this->reg->getRegistrant());
            $this->session->set_flashdata("notices", [0 => "Data Sudah berhasil disimpan"]);
            redirect($id.'/beranda');
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, Terjadi Kesalahan"]);
            redirect($id.'/beranda');
        }
    }
    
    public function detail($id){
        $this->blockUnloggedOne($id);
        $reg_data = $this->reg->getRegistrantData($this->session->registrant);
        $data = [
            'title' => 'Edit Data Diri',
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
            'registrant' => $this->session->registrant,
            'reg_data' => $reg_data,
            'nav_pos' => 'detail'
        ];
        $this->CustomView('registrant/detail', $data);
    }
    
    public function do_edit_detail($id){
        $this->blockUnloggedOne($id);
        $data = $this->input->post(null, true);
        $res = $this->reg->updateDetail($id, $data);
        if($res){
            $this->session->set_userdata('registrant', $this->reg->getRegistrant());
            $this->session->set_flashdata("notices", [0 => "Data Sudah berhasil disimpan"]);
            redirect($id.'/detail');
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, Terjadi Kesalahan"]);
            redirect($id.'/detail');
        }
    }
    
    public function data($id, $type){
        $this->blockUnloggedOne($id);
        $parent_data = (empty($this->parent->getData($id, [$type])[$type]))? $parent_data = $this->parent->create(): $this->parent->getData($id, [$type])[$type];
        $tn = $this->typeTrans($type);
        $data = [
            'title' => 'Edit Data '.$tn['trans'],
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
            'registrant' => $this->session->registrant,
            'trans' => $tn['trans'],
            'parent_data' => $parent_data,
            'nav_pos' => $type, 
            'next' => $tn['next']
        ];
        $this->CustomView('registrant/parent', $data);
    }
    
    private  function typeTrans($type){
        $trans = $next = '';
        switch ($type){
        case 'father' :
            $trans = 'Ayah';
            $next = 'data/mother';
            break;
        case 'mother' :
            $trans = 'Ibu';
            $next = 'data/guardian';
            break;
        case 'guardian' :
            $trans = 'Wali';
            $next = 'rekap';
            break;
        default :
            $trans = 'ayah';
            $next = 'data/mother';
            break;
        }
        return ['trans' => $trans, 'next' => $next];
    }
    
    public function finalisasi($id, $finalized){
        $this->blockUnloggedOne($id);
        $data['id'] = $id;
        $data['finalized'] = ($finalized == 'true');
        $res = $this->reg->updateData($data);
        if($res){
            $this->session->set_userdata('registrant', $this->reg->getRegistrant());
            $this->session->set_flashdata("notices", [0 => "Data Sudah berhasil disimpan"]);
            redirect($id.'/beranda');
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, Terjadi Kesalahan"]);
            redirect($id.'/beranda');
        }
    }

    public function do_edit_parent($id, $type){
        $this->blockUnloggedOne($id);
        $data = $this->input->post(null, true);
        $res = $this->parent->updateData($id, $data, $type);
        if($res){
            $this->session->set_flashdata("notices", [0 => "Data Sudah berhasil disimpan"]);
            redirect($id.'/data/'.$type);
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, Terjadi Kesalahan"]);
            redirect($id.'/data/'.$type);
        }
    }
    
    public function upload_foto($id) {
        $this->blockUnloggedOne($id);
        $fileUrl = $_FILES['file']["tmp_name"];
        $res = $this->reg->uploadFoto($fileUrl, $id);
        if ($res) {
            $this->session->set_flashdata("notices", [0 => "Upload Foto Berhasil!"]);
            redirect($id.'/beranda');
        } else {
            $this->session->set_flashdata("errors", [0 => "Upload Foto Gagal!"]);
            redirect($id.'/beranda');
        }
    }
    
    public function upload_receipt($id) {
        $this->blockUnloggedOne($id);
        $data = $this->input->post(null, true);
        $fileUrl = $_FILES['file']["tmp_name"];
        $res = $this->reg->uploadReceipt($fileUrl, $id, $data);
        if ($res) {
            $this->session->set_flashdata("notices", [0 => "Upload Foto Berhasil!"]);
            redirect($id.'/beranda');
        } else {
            $this->session->set_flashdata("errors", [0 => "Upload Foto Gagal!"]);
            redirect($id.'/beranda');
        }
    }
    
    private function getImgReceipt($id){
        $this->load->helper('file');
        $img_link = '';
        $file = read_file('./data/receipt/'.$id.'.png');
        $datetime = new DateTime('now');
        if($file == false){
            $img_link = null;
        }  else {
            $img_link = base_url().'pendaftar/getReceipt/'.$id.'/'.hash('md2', $datetime->format('Y-m-d H:i:s'));
        }
        return $img_link;
    }
    
    public function getReceipt($id, $hash){
        $this->blockUnloggedOne($id, true);
        $imagine = new Imagine\Gd\Imagine();
        $image = $imagine->open('./data/receipt/'.$id.'.png');
        $this->session->set_userdata('random_hash_2', $hash);
        $image->show('png');
    }
    
    public function rekap($id){
        $this->blockUnloggedOne($id);
        $registrant = $this->reg->getData(null, $id);
        $this->session->set_userdata('registrant', $registrant);
        $data = [
            'title' => 'Rekap Data',
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
            'nav_pos' => 'recap',
            'img_link' => $this->getImgLink($id),
            'registrant' => $this->session->registrant,
        ];
        $this->CustomView('registrant/recap', $data);
    }
    
    public function print_letter($id){
        $this->blockUnloggedOne($id);
        $registrant = $this->reg->getData(null, $id);
        $this->session->set_userdata('registrant', $registrant);
        $data = [
            'title' => 'Print Surat Pernyataan',
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
            'nav_pos' => 'recap',
            'img_link' => $this->getImgLink($id),
            'registrant' => $this->session->registrant,
        ];
        $this->load->view('registrant/print/statement_letter', $data);
    }
    
    public function print_data($id){
        $this->blockUnloggedOne($id);
        $registrant = $this->reg->getData(null, $id);
        $this->session->set_userdata('registrant', $registrant);
        $data = [
            'title' => 'Print Surat Pernyataan',
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
            'nav_pos' => 'recap',
            'img_link' => $this->getImgLink($id),
            'registrant' => $this->session->registrant,
        ];
        $this->load->view('registrant/print/registrant_data', $data);
    }
    
    public function print_data_pendaftaran($id, $action = 'download'){
        $this->blockUnloggedOne($id);
        $registrant = $this->reg->getData(null, $id);
        $this->session->set_userdata('registrant', $registrant);
        $data = [
            'title' => 'Print Surat Pernyataan',
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
            'nav_pos' => 'recap',
            'img_link' => $this->getImgLink($id),
            'registrant' => $this->session->registrant,
        ];
        $pdf = new mikehaertl\wkhtmlto\Pdf();
        $pdf->setOptions($this->pdfOption());
        $reg_data = $this->load->view('registrant/print/registrant_data', $data, TRUE);
        $pdf->addPage($reg_data);
        if(($registrant->getCompleted())){
            $reg_letter = $this->load->view('registrant/print/statement_letter', $data, TRUE);
            $pdf->addPage($reg_letter);
        }
        if ($action == 'download'){
            $res = $pdf->send('Data Pendaftaran '.$id.' .pdf');
        } else {
            $res = $pdf->send();
        }
        if (!$res) { echo $pdf->getError(); }
    }
    
    private  function pdfOption(){
        $options = [
            'page-size' => 'A4',
            'dpi' => 96,
            'image-quality' => 100,
            'margin-top' => '10mm',
            'margin-right' => '20mm',
            'margin-bottom' => '10mm',
            'margin-left' => '20mm',
            'header-spacing' => 15,
            'footer-spacing' => 5,
            'disable-smart-shrinking',
            'no-outline'
        ];
        return $options;
    }
    
    public function surat($id){
        $this->blockUnloggedOne($id);
        $data = [
            'title' => 'Surat Pernyataan',
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
            'registrant' => $this->session->registrant,
            'nav_pos' => 'home'
        ];
        $this->CustomView('registrant/letter', $data);
    }
    
    public function isi_pernyataan($id){
        $this->blockUnloggedOne($id);
        $data = $this->input->post(null, true);
        $data['initial_cost'] = ($data['raw_icost'] == '-999')?$data['other_icost']:$data['raw_icost'];
        $data['subscription_cost'] = ($data['raw_scost'] == '-999')?$data['other_scost']:$data['raw_scost'];
//        var_dump($data);
        $data['id'] = $id;
        $res = $this->reg->updateData($data);
        if($res){
            $this->session->set_userdata('registrant', $this->reg->getRegistrant());
            $this->session->set_flashdata("notices", [0 => "Data Sudah berhasil disimpan"]);
            redirect($id.'/surat');
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, Terjadi Kesalahan"]);
            redirect($id.'/surat');
        }
    }
    
    // =========================================================
    
    // ================= Lihat Pendaftar ===========================
    
    public function lihat($sex = 'L'){
        $registrant_data = $this->reg->getData($sex);
        $this->load->view('registrant/list', ['sex' => $sex, 'data_registrant' => $registrant_data]);
    }
}