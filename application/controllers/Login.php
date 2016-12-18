<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * The MIT License
 *
 * Copyright 2015 s4if.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Description of Login
 *
 * @author s4if
 */
class Login extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_registrant','reg');
        $this->load->model('Model_parent','parent');
        $this->load->model('Model_admin','adm');
    }
    
    // ================= LOGIN & REGISTER ===========================
    public function index(){
        $builder = new Gregwar\Captcha\CaptchaBuilder();
        $builder->setDistortion(false);
        $builder->build();
        $this->session->set_userdata('captcha', $builder->getPhrase());
        $registrant = [];
        if(empty($this->session->flashdata('data')) === false){
            $registrant = $this->session->flashdata('data');
        }
        $this->load->view('login/index', ['builder' => $builder, 'registrant' => $registrant]);
    }
    
    public function uname_avaible(){
        $data = $this->input->post(null, true);
        $result = $this->reg->getDataByUsername($data['username']);
        if($result != null){
            // username is already exist 
            echo '<div style="color: red;">Username <b>'.$data['username'].'</b> sudah ada yang memakai! </div>';
        }
        else{
            // username is avaialable to use.
            echo '<div style="color: green;">Username <b>'.$data['username'].'</b> tersedia! </div>';
        }
    }


    public function do_login(){
        $data = $this->input->post(null, true);
        $registrant = $this->reg->getDataByUsername($data['username']);
        $res = 0;
        if(!is_null($registrant)){
            if(password_verify($data['password'], $registrant->getPassword())){
                $this->session->set_userdata('registrant', $registrant);
                $res = 1;
                redirect($registrant->getId().'/beranda');
            } else {
                $res = -2;
                $this->session->set_flashdata("errors", [0 => "Maaf, Password yang anda masukkan salah, <br />"
                    . "Silahkan anda cek kembali atau hubungi <strong>Ust.Hanif 085743020585</strong> untuk mereset"
                    . "password."]);
                redirect('login/index');
            }
        } else {
            $res = -1;
            $this->session->set_flashdata("errors", [0 => "Maaf, pendaftar dengan Username :".$data['username']." tidak ditemukan, <br />"
                . "Silahkan anda cek kembali"]);
            redirect('login/index');
        }
    }
    
    public function register_berhasil(){
        $registrant = $this->session->registrant;
        if(!empty($registrant)){
            $this->load->view('login/berhasil', ['registrant' => $registrant]);
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, Anda tidak boleh melihat halaman ini lagi!"]);
            redirect('login/index');
        }
    }
    
    public function do_register(){
        $data = $this->input->post(null, true);
        $data['cp'] = $data['cp_prefix'].$data['cp_suffix'];
        $res = $this->real_do_register($data);
        if ($res['status'] == 1) {
            $this->session->set_userdata('registrant', $res['registrant']);
            redirect('login/register_berhasil');
        } elseif($res['status'] == -1) {
            $this->session->set_flashdata('data', $data);
            $this->session->set_flashdata("errors", [0 => "Maaf, Password dan konfirmasi password yang anda masukkan tidak sama<br />"
                . "Silahkan anda cek kembali"]);
            redirect('login/index');
        } elseif($res['status'] == -2) {
            $this->session->set_flashdata('data', $data);
            $this->session->set_flashdata("errors", [0 => "Maaf, Captcha dari gambar yang anda masukkan salah<br />"
                . "Silahkan anda cek kembali"]);
            redirect('login/index');
        } else {
            $this->session->set_flashdata('data', $data);
            $this->session->set_flashdata("errors", [0 => "Maaf, terjadi Error yang tidak diketahui"]);
            redirect('login/index');
        }
    }
    
    private function real_do_register($data){
        $registrant = '';
        $res = 0;
        if($data['password'] == $data['confirm-password']){
            if($this->session->captcha == $data['captcha'] || PHP_SAPI == 'cli' || !isset($_SERVER['HTTP_USER_AGENT'])){
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
    
    public function do_logout(){
        $this->session->sess_destroy();
        redirect('login/index');
    }
    
    // ================= END ===========================
    
    // ================= Admin Login ===========================
    
    public function admin(){
        $this->load->view('login/admin');
    }

    public function do_login_admin(){
        $data = $this->input->post(null, true);
        $admin = $this->adm->getData($data['username']);
        $res = 0;
        if(!is_null($admin)){
            if(password_verify($data['password'], $admin->getPassword())){
                $this->session->set_userdata('admin', $admin);
                $res = 1;
                redirect('admin/beranda');
            } else {
                $res = -2;
                $this->session->set_flashdata("errors", [0 => "Maaf, Password yang anda masukkan salah, <br />"
                    . "Silahkan anda cek kembali"]);
                redirect('login/admin');
            }
        } else {
            $res = -1;
            $this->session->set_flashdata("errors", [0 => "Maaf, Admin dengan Username : ".$data['username']." tidak ditemukan, <br />"
                . "Silahkan anda cek kembali"]);
            redirect('login/admin');
        }
    }
    
    // ================= END ===========================
}
