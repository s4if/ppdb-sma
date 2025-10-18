<?php

namespace App\Controllers;

use App\Models\RegistrantModel;
use App\Models\ParentModel;
use App\Models\AdminModel;

/**
 * @context7 /codeigniter/controller
 * @description Handles authentication for both registrants and admins
 * @example 
 * // Login a registrant
 * $auth = new Auth();
 * $auth->do_login();
 */
class Auth extends BaseController
{
    protected $registrantModel;
    protected $parentModel;
    protected $adminModel;

    /**
     * @context7 /codeigniter/controller/method
     * @description Initialize models
     */
    public function __construct()
    {
        $this->registrantModel = new RegistrantModel();
        $this->parentModel = new ParentModel();
        $this->adminModel = new AdminModel();
    }

    // ================= LOGIN & REGISTER ===========================

    /**
     * @context7 /codeigniter/controller/method
     * @description Display login page
     * @return string View
     */
    public function index(){
        $reg_obj = $this->registrantModel->first();
        $phraseBuilder = new \Gregwar\Captcha\PhraseBuilder(5, "0123456789");
        $builder = new \Gregwar\Captcha\CaptchaBuilder(null, $phraseBuilder);
        $builder->setDistortion(false);
        $builder->build();
        session()->set('captcha', $builder->getPhrase());
        
        $registrant = [];
        if(!empty(session()->getFlashdata('data'))){
            $registrant = session()->getFlashdata('data');
        }
        
        return $this->renderView('auth/login', [
            'title' => 'Login Pendaftaran',
            'builder' => $builder,
            'registrant' => $registrant,
            'data' => $reg_obj,
        ]);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display special registration path page
     * @return string View
     */
    public function prestasi(){
        $reg_obj = $this->registrantModel->first();
        $builder = new \Gregwar\Captcha\CaptchaBuilder();
        $builder->setDistortion(false);
        $builder->build();
        session()->set('captcha', $builder->getPhrase());
        
        $registrant = [];
        if(!empty(session()->getFlashdata('data'))){
            $registrant = session()->getFlashdata('data');
        }
        
        return $this->renderView('auth/login', [
            'title' => 'Login Jalur Prestasi',
            'is_prestasi' => true,
            'registrant' => $registrant,
            'data' => $reg_obj,
        ]);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Check username availability
     * @return JSON Response
     */
    public function uname_avaible(){
        $data = $this->request->getPost();
        $result = $this->registrantModel->getDataByUsername($data['username']);
        
        if($result != null){
            // username is already exist 
            echo '<div style="color: red;">Username <b>'.$data['username'].'</b> sudah ada yang memakai! </div>';
        } else {
            // username is available to use.
            echo '<div style="color: green;">Username <b>'.$data['username'].'</b> tersedia! </div>';
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Process registrant login
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function do_login(){
        $data = $this->request->getPost();
        $registrant = $this->registrantModel->getDataByUsername($data['username']);
        
        if(!is_null($registrant)){
            if(password_verify($data['password'], $registrant->getPassword())){
                session()->set('registrant', $registrant);
                return redirect()->to($registrant->getId().'/beranda');
            } else {
                session()->setFlashdata("errors", ["Maaf, Password yang anda masukkan salah, <br />"
                    . "Silahkan anda cek kembali password anda atau hubungi <strong>Ustadzah Imel: 0821-3781-2078</strong>"
                    . " atau <strong>Ustadzah Nifah: 0831-0474-2023</strong> untuk mereset password"]);
                return redirect()->to('login/index');
            }
        } else {
            session()->setFlashdata("errors", ["Maaf, pendaftar dengan Username :".$data['username']." tidak ditemukan, <br />"
                . "Silahkan anda cek kembali"]);
            return redirect()->to('login/index');
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display registration success page
     * @return string View
     */
    public function register_berhasil(){
        $registrant = session()->get('registrant');
        if(!empty($registrant)){
            return $this->renderView('auth/login', [
                'title' => 'Registrasi Berhasil',
                'is_success' => true,
                'registrant' => $registrant
            ]);
        } else {
            session()->setFlashdata("errors", ["Maaf, Anda tidak boleh melihat halaman ini lagi!"]);
            return redirect()->to('login/index');
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Process registration
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function do_register(){
        $data = $this->request->getPost();
        $data['cp'] = $data['cp_prefix'].$data['cp_suffix'];
        $res = $this->real_do_register($data);
        
        if ($res['status'] == 1) {
            session()->set('registrant', $res['registrant']);
            return redirect()->to('login/register_berhasil');
        } elseif($res['status'] == -1) {
            session()->setFlashdata('data', $data);
            session()->setFlashdata("errors", ["Maaf, Password dan konfirmasi password yang anda masukkan tidak sama<br />"
                . "Silahkan anda cek kembali"]);
            return redirect()->to('login/index');
        } elseif($res['status'] == -2) {
            session()->setFlashdata('data', $data);
            session()->setFlashdata("errors", ["Maaf, Captcha dari gambar yang anda masukkan salah<br />"
                . "Silahkan anda cek kembali"]);
            return redirect()->to('login/index');
        } else {
            session()->setFlashdata('data', $data);
            session()->setFlashdata("errors", ["Maaf, terjadi Error yang tidak diketahui"]);
            return redirect()->to('login/index');
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Process registration data
     * @param array $data Registration data
     * @return array Result
     */
    private function real_do_register($data){
        $registrant = '';
        $res = 0;
        
        if($data['password'] == $data['confirm-password']){
            if(session()->get('captcha') == $data['captcha'] || PHP_SAPI == 'cli' || !isset($_SERVER['HTTP_USER_AGENT'])){
                $res = ($this->registrantModel->insertData($data))?1:0;
                $registrant = $this->registrantModel->getRegistrant();
            } else {
                $res = -2;
            }
        } else {
            $res = -1;
        }
        
        return ['registrant' => $registrant, 'status' => $res];
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Process logout
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function do_logout(){
        session()->destroy();
        return redirect()->to('login/index');
    }

    // ================= END ===========================

    // ================= Admin Login ===========================

    /**
     * @context7 /codeigniter/controller/method
     * @description Display admin login page
     * @return string View
     */
    public function admin(){
        return $this->renderView('auth/login', [
            'title' => 'Login Admin',
            'is_admin' => true
        ]);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Process admin login
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function do_login_admin(){
        $data = $this->request->getPost();
        $admin = $this->adminModel->getData($data['username']);
        
        if(!is_null($admin)){
            if(password_verify($data['password'], $admin->getPassword())){
                session()->set('admin', $admin);
                return redirect()->to('admin/beranda');
            } else {
                session()->setFlashdata("errors", ["Maaf, Password yang anda masukkan salah, <br />"
                    . "Silahkan anda cek kembali"]);
                return redirect()->to('login/admin');
            }
        } else {
            session()->setFlashdata("errors", ["Maaf, Admin dengan Username : ".$data['username']." tidak ditemukan, <br />"
                . "Silahkan anda cek kembali"]);
            return redirect()->to('login/admin');
        }
    }

    // ================= END ===========================

    /**
     * @context7 /codeigniter/controller/method
     * @description Test method for debugging
     */
    public function test(){
        $data = explode(";", "2019;;");
        print_r($data);
        $data = explode(";", "2019;2020;");
        print_r($data);
        $data = explode(";", "2019;2020;2021");
        print_r($data);
        $data = explode(";", ";2020;");
        print_r($data);
        $data = explode(";", ";2020;2021");
        print_r($data);
        $data = explode(";", "2019;;2021");
        print_r($data);
        $data = explode(";", ";;2021");
        print_r($data);
    }
}