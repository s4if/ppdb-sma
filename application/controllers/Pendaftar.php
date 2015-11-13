<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftar extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $this->CustomView('registrant/index', ['title' => 'Dummy']);
    }
    
    public function login(){
        $builder = new Gregwar\Captcha\CaptchaBuilder();
        $builder->setDistortion(false);
        $builder->build();
        $this->session->set_userdata('captcha', $builder->getPhrase());
        $this->load->view('login/index', ['builder' => $builder]);
    }
    
    public function detail(){
        
    }
    
    public function do_register(){
        $data = $this->input->post(null, true);
        $this->load->model('Model_registrant','reg');
        $res = 0;
        $id = '';
        if($data['password'] == $data['confirm-password']){
            $res = ($this->reg->insertData($data))?1:0;
            $id = $this->reg->getRegistrant()->getId();
        }else {
            $res = -1;
        }
        if ($res == 1) {
            $this->session->set_flashdata("notices", [0 => "Registrasi berhasil<br />"
                . "Id anda = ".$id."<br />"
                . "Silahkan Login dengan ID dan password yang tersedia"]);
            redirect('pendaftar/login');
        } elseif($res == -1) {
            $this->session->set_flashdata("errors", [0 => "Maaf, Password dan konfirmasi password yang anda masukkan tidak sama<br />"
                . "Silahkan anda cek kembali"]);
            redirect('pendaftar/login');
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, terjadi Error yang tidak diketahui"]);
            redirect('pendaftar/login');
        }
    }
}