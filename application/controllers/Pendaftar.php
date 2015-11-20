<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftar extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_registrant','reg');
        $this->load->model('Model_parent','parent');
    }
    
    public function index(){
        if($this->session->has_userdata('registrant')){
            $this->beranda();
        }else{
            $this->login();
        }
    }
    
    // ================= LOGIN & REGISTER ===========================
    public function login(){
        $builder = new Gregwar\Captcha\CaptchaBuilder();
        $builder->setDistortion(false);
        $builder->build();
        $this->session->set_userdata('captcha', $builder->getPhrase());
        $this->load->view('login/index', ['builder' => $builder]);
    }
    
    public function do_login(){
        $data = $this->input->post(null, true);
        $registrant = $this->reg->getData(null, $data['id_pendaftaran']);
        $res = 0;
        if(!is_null($registrant)){
            if(password_verify($data['password'], $registrant->getPassword())){
                $this->session->set_userdata('registrant', $registrant);
                $res = 1;
                redirect($data['id_pendaftaran'].'/beranda');
            } else {
                $res = -2;
                $this->session->set_flashdata("errors", [0 => "Maaf, Password yang anda masukkan salah, <br />"
                    . "Silahkan anda cek kembali"]);
                redirect('pendaftar/login');
            }
        } else {
            $res = -1;
            $this->session->set_flashdata("errors", [0 => "Maaf, pendaftar dengan ID :".$data['id']." tidak ditemukan, <br />"
                . "Silahkan anda cek kembali"]);
            redirect('pendaftar/login');
        }
    }
    
    public function register_berhasil(){
        $registrant = $this->session->flashdata('registrant');
        $this->session->sess_destroy();
        $this->load->view('login/berhasil', ['registrant' => $registrant]);
    }
    
    public function do_register(){
        $data = $this->input->post(null, true);
        $res = $this->real_do_register($data);
        if ($res['status'] == 1) {
            $this->session->set_flashdata('registrant', $res['registrant']);
            redirect('pendaftar/register_berhasil');
        } elseif($res['status'] == -1) {
            $this->session->set_flashdata("errors", [0 => "Maaf, Password dan konfirmasi password yang anda masukkan tidak sama<br />"
                . "Silahkan anda cek kembali"]);
            redirect('pendaftar/login');
        } elseif($res['status'] == -2) {
            $this->session->set_flashdata("errors", [0 => "Maaf, Captcha dari gambar yang anda masukkan salah<br />"
                . "Silahkan anda cek kembali"]);
            redirect('pendaftar/login');
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, terjadi Error yang tidak diketahui"]);
            redirect('pendaftar/login');
        }
    }
    
    private function real_do_register($data){
        $registrant = '';
        $res = 0;
        if($data['password'] == $data['confirm-password']){
            if($this->session->captcha == $data['captcha']){
                $res = ($this->reg->insertData($data))?1:0;
                $registrant = $this->reg->getRegistrant();
            }  else {
                $res = -2;
            }
        }else {
            $res = -1;
        }
        return ['registrant' => $registrant, 'status' => $res];
    }
    
    public function password($id){
        $this->blockUnloggedOne($id);
        $data = [
            'title' => 'Password',
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
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
            redirect($data['id'].'/password');
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

    // ================= END ===========================
    
    // ================= AFTER LOGIN ===========================
    public function beranda($id){
        $this->blockUnloggedOne($id);
        $data = [
            'title' => 'Beranda',
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
            'registrant' => $this->session->registrant,
            'img_link' => $this->getImgLink($id),
            'nav_pos' => 'beranda'
        ];
        $this->CustomView('registrant/profile', $data);
    }
    
    public function do_logout(){
        $this->session->sess_destroy();
        redirect('pendaftar/login');
    }
    
//    // TODO: Edit Detail, Ortu, Wali
//    // Profil -> konfirmasi + upload foto
//    // Data Diri, Data Orang Tua, DataWali -> hanya tambah data
//    // Rekap : rekapan data hasil 
//    public function profil($id){
//        $this->blockUnloggedOne($id);
//        $data = [
//            'title' => 'Edit Profil',
//            'username' => $this->session->registrant->getName(),
//            'id' => $this->session->registrant->getId(),
//            'registrant' => $this->session->registrant,
//            'img_link' => $this->getImgLink($id),
//            'nav_pos' => 'profile'
//        ];
//        $this->CustomView('registrant/profile', $data);
//    }
    
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
        $this->blockUnloggedOne($id);
        $imagine = new Imagine\Gd\Imagine();
        $image = $imagine->open('./data/foto/'.$id.'.png');
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
            redirect($id.'/home');
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, Terjadi Kesalahan"]);
            redirect($id.'/home');
        }
    }
    
    public function detail($id){
        $this->blockUnloggedOne($id);
        $reg_data = $this->reg->getRegistrantData($this->session->registrant);
        $data = [
            'title' => 'Edit Profil',
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
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
        $trans = '';
        $next = '';
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
            $next = 'recap';
            break;
        default :
            $trans = 'ayah';
            $next = 'data/mother';
            break;
        }
        $data = [
            'title' => 'Edit '.$trans,
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
            'trans' => $trans,
            'parent_data' => $parent_data,
            'nav_pos' => $type, 
            'next' => $next
        ];
        $this->CustomView('registrant/parent', $data);
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
        $fileType = explode('/', $_FILES['file']['type'])[1];
        $res = $this->reg->uploadFoto($fileUrl, $fileType, $id);
        if ($res) {
            $this->session->set_flashdata("notices", [0 => "Upload Foto Berhasil!"]);
            redirect($id.'/profil');
        } else {
            $this->session->set_flashdata("errors", [0 => "Upload Foto Gagal!"]);
            redirect($id.'/profil');
        }
    }
    
    public function rekap($id){
        $this->blockUnloggedOne($id);
        $data = [
            'title' => 'Rekap Data',
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
            'nav_pos' => 'recap',
            'data_registrant' => $this->session->registrant
        ];
        $this->CustomView('registrant/recap', $data);
    }
    // =========================================================
}