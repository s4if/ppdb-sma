<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftar extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_registrant','reg');
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
    
    // ================= END ===========================
    
    // ================= AFTER LOGIN ===========================
    public function beranda($id){
        $this->blockUnloggedOne($id);
        $this->CustomView('registrant/index', ['title' => 'Home']);
    }
    
    public function do_logout(){
        $this->session->sess_destroy();
        redirect('pendaftar/login');
    }
    
    // TODO: Edit Detail, Ortu, Wali
    
    // =========================================================
}