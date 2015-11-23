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
 * Description of Admin
 *
 * @author s4if
 */
class Admin extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_registrant','reg');
        $this->load->model('Model_parent','parent');
        $this->load->model('Model_admin','admin');
    }
    
    public function index(){
        $this->beranda();
    }
    
    public function beranda(){
        $this->blockNonAdmin();
        $data = [
            'title' => 'Beranda',
            'username' => $this->session->admin->getUsername(),
            'admin' => $this->session->admin,
            'nav_pos' => 'homeAdmin'
        ];
        $this->CustomView('admin/home', $data);
    }
    
    public function password(){
        $this->blockNonAdmin();
        $data = [
            'title' => 'Password',
            'username' => $this->session->admin->getUsername(),
            'admin' => $this->session->admin,
            'registrant' => $this->session->registrant,
            'nav_pos' => 'homeAdmin'
        ];
        $this->CustomView('admin/password', $data);
    }
    
    public function change_password($username){
        $this->blockNonAdmin();
        $admin = $this->admin->getData($username);
        $data = $this->input->post(null, true);
        if($data['new_password'] == $data['confirm_password']){
            if(password_verify($data['stored_password'], $admin->getPassword())){
                $this->do_change_password(['password' => $data['new_password'], 'username' => $username]);
            } else {
                $this->session->set_flashdata("errors", [0 => "Maaf, Password lama anda salah <br />"
                    . "Silahkan di periksa kembali."]);
                redirect('admin/password');
            }
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, Password baru dan konfirmasi password tidak sama, <br />"
                . "Silahkan di periksa kembali."]);
            redirect('admin/password');
        }        
    }
    
    private function do_change_password($data){
        $res = $this->admin->updateData($data);
        if($res){
            $this->session->set_userdata('admin', $this->admin->getData($this->session->admin->getUsername()));
            $this->session->set_flashdata("notices", [0 => "Passsword sudah berhasil diubah."]);
            redirect('admin/password');
        } else {
            $this->session->set_flashdata("errors", [0 => "Maaf, Terjadi Kesalahan"]);
            redirect('admin/password');
        }
    }
}
