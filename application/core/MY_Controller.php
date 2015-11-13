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
 * Description of MY_Controller
 *
 * @author s4if
 */
class MY_Controller extends CI_Controller {
    
    /* 
     * CDN itu untuk memilih menggunakan CDN ato tidak...
     */
    const CDN = false;

    function __construct(){
        parent::__construct();
    }
    
    protected function CustomView($view_name, $data = []){
        // set pakai cdn atau tidak
        $data['cdn'] = self::CDN;
        
        $fragment['header'] = $this->load->view("core/header", $data, TRUE);
        $fragment['navbar'] = '';//$this->load->view("core/navbar", $data, true);
        $fragment['alert'] = $this->load->view("core/alert",'',true);
        $fragment['content'] = $this->load->view($view_name, $data, true);
        $fragment['footer'] = $this->load->view("core/footer", $data, true);
        $this->load->view('core/skeleton', $fragment);
    }
    
    //nilai true jika hanya bisa diakses setelah login
    protected function blockLoggedOne(){
        if($this->session->has_userdata('login_data')){
            $this->session->set_flashdata("errors",[0 => "Akses dihentikan, <br \>"
                . "Tidak boleh mengakses halaman login jika sesi belum berakhir"]);
            redirect('admin/home', 'refresh');
        }
    }
    
    protected function blockUnloggedOne($user = FALSE, $accessibleForAll = false){
        if(!$this->session->has_userdata('login_data')){
            $this->session->set_flashdata("errors",[0 => "Akses dihentikan, Harap login Dulu!"]);
            redirect('login', 'refresh');
        }  elseif(!$accessibleForAll) {
            $this->blockAdmin($user);
        }
    }
    
    protected function blockAdmin($user){
        if($user && $this->session->position == 'user'){
            //do nothing
        } elseif ($user && !($this->session->position == 'user')) {
            $this->session->set_flashdata("errors",[0 => "Maaf, anda tidak berhak melihat halaman personal Siswa!"]);
            redirect('admin/home', 'refresh');
        } elseif (!$user && $this->session->position == 'user') {
            $this->session->set_flashdata("errors",[0 => "Maaf, anda tidak berhak melihat halaman Admin!"]);
            redirect('user/home', 'refresh');
        } elseif (!$user && !($this->session->position == 'user')) {
            //do nothing
        }
    }
}
