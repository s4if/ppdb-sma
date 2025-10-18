<?php

namespace App\Controllers;

use App\Models\RegistrantModel;
use App\Models\ParentModel;
use App\Models\AdminModel;
use App\Models\RaporModel;
use App\Libraries\PdfGenerator;

/**
 * @context7 /codeigniter/controller
 * @description Handles all admin-related operations
 * @example 
 * // Access admin dashboard
 * $admin = new Admin();
 * $admin->beranda();
 */
class Admin extends BaseController
{
    protected $registrantModel;
    protected $parentModel;
    protected $adminModel;
    protected $raporModel;

    /**
     * @context7 /codeigniter/controller/method
     * @description Initialize models
     */
    public function __construct()
    {
        $this->registrantModel = new RegistrantModel();
        $this->parentModel = new ParentModel();
        $this->adminModel = new AdminModel();
        $this->raporModel = new RaporModel();
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Default controller method
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function index(){
        return $this->beranda();
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display admin dashboard
     * @return string View
     */
    public function beranda(){
        $this->blockNonAdmin();
        $registrant_data = $this->registrantModel->getArrayData();
        $data = [
            'title' => 'Beranda',
            'username' => session()->get('admin')->getUsername(),
            'admin' => session()->get('admin'),
            'nav_pos' => 'homeAdmin',
            'data_registrant' => $registrant_data,
            'female_count' => $this->registrantModel->getCount(['gender' => 'P']),
            'male_count' => $this->registrantModel->getCount(['gender' => 'L'])
        ];
        return $this->renderView('admin/dashboard', $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description AJAX handler for incomplete/unpaid data
     * @param string $unpaid Filter type
     * @return JSON Response
     */
    public function uncomplete_ajax($unpaid = 'paid'){
        $this->blockNonAdmin();
        $data = [];
        
        if($unpaid == 'paid'){
            $registrant_data = $this->registrantModel->getIncompleteData();
        } else {
            $registrant_data = $this->registrantModel->getUnpaidData();
        }
        
        foreach ($registrant_data as $registrant){
            if(!$registrant['completed']) {
                $row = [];
                $row[] = $registrant['id'];
                $row[] = $registrant['name'];
                $row[] = ($registrant['gender'] == 'L') ? 'Ikhwan' : 'Akhwat';
                $row[] = $registrant['cp'];
                $row[] = $registrant['status'];
                $row[] = $registrant['previousSchool'];
                $data[] = $row;
            }
        }
        
        return $this->response->setJSON(['data' => $data]);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display password change form
     * @return string View
     */
    public function password(){
        $this->blockNonAdmin();
        $data = [
            'title' => 'Password',
            'username' => session()->get('admin')->getUsername(),
            'admin' => session()->get('admin'),
            'registrant' => session()->get('registrant'),
            'nav_pos' => 'homeAdmin'
        ];
        return $this->renderView('admin/password', $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Process password change
     * @param string $username Admin username
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function change_password($username){
        $this->blockNonAdmin();
        $admin = $this->adminModel->getData($username);
        $data = $this->request->getPost();
        
        if($data['new_password'] == $data['confirm_password']){
            if(password_verify($data['stored_password'], $admin->getPassword())){
                $this->do_change_password(['password' => $data['new_password'], 'username' => $username]);
            } else {
                session()->setFlashdata("errors", ["Maaf, Password lama anda salah <br />"
                    . "Silahkan di periksa kembali."]);
                return redirect()->to('admin/password');
            }
        } else {
            session()->setFlashdata("errors", ["Maaf, Password baru dan konfirmasi password tidak sama, <br />"
                . "Silahkan di periksa kembali."]);
            return redirect()->to('admin/password');
        }        
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Update password in database
     * @param array $data Password data
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    private function do_change_password($data){
        $this->blockNonAdmin();
        $updateData = [
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT)
        ];
        
        $res = $this->adminModel->save($updateData);
        if($res){
            session()->set('admin', $this->adminModel->getData($data['username']));
            session()->setFlashdata("notices", ["Passsword sudah berhasil diubah."]);
            return redirect()->to('admin/password');
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
            return redirect()->to('admin/password');
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display registrants list
     * @param string|null $gender Gender filter
     * @return string View
     */
    public function lihat($gender = null){
        $this->blockNonAdmin();
        $jk = '';
        if(!is_null($gender)){
            $jk = ($gender == 'L')?'Ikhwan':'Akhwat';
        }
        
        return $this->renderView('admin/registrants_list', [
            'title' => 'Lihat Pendaftar '.$jk,
            'username' => session()->get('admin')->getUsername(),
            'admin' => session()->get('admin'),
            'nav_pos' => 'registrantAdmin',
            'gender' => $gender,
        ]);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description AJAX handler for registrants list
     * @param string|null $gender Gender filter
     * @return JSON Response
     */
    public function lihat_ajax($gender = null){
        $this->blockNonAdmin();
        $registrant_data = (is_null($gender))?$this->registrantModel->getArrayData():$this->registrantModel->getArrayData($gender);
        $data = [];
        
        foreach ($registrant_data as $registrant){
            $row = [];
            $row[] = $registrant['id'];
            $row[] = $registrant['username'];
            $row[] = $registrant['kode'];
            $row[] = $registrant['name'];
            $row[] = ($registrant['gender'] == 'L') ? 'Ikhwan' : 'Akhwat';
            $row[] = $registrant['previousSchool'];
            $row[] = ucfirst($registrant['program']);
            $row[] = ucfirst($registrant['selectionPath']);
            
            $father = $registrant['object']->getFather();
            if(is_null($father)){$father = new \App\Entities\ParentEntity();}
            $mother = $registrant['object']->getMother();
            if(is_null($mother)){$mother = new \App\Entities\ParentEntity();}
            
            $row[] = 'Rp.'.number_format($father->getIncome(), 0, ',', '.').',-';
            $row[] = 'Rp.'.number_format($mother->getIncome(), 0, ',', '.').',-';
            $row[] = $registrant['cp'];
            $row[] = $registrant['status'];
            $row[] = view('admin/fragment/data_registrant', ['registrant' => $registrant]);
            $data[] = $row;
        }
        
        return $this->response->setJSON(['data' => $data]);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display grades page
     * @param string|null $gender Gender filter
     * @return string View
     */
    public function nilai($gender = null){
        $this->blockNonAdmin();
        return $this->renderView('admin/nilai_registrant', [
            'title' => 'Lihat Pendaftar ',
            'username' => session()->get('admin')->getUsername(),
            'admin' => session()->get('admin'),
            'nav_pos' => 'nilaiAdmin',
            'gender' => $gender,
        ]);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description AJAX handler for grades data
     * @param string|null $gender Gender filter
     * @return JSON Response
     */
    public function nilai_ajax($gender = null){
        $this->blockNonAdmin();
        $registrant_data = (is_null($gender))?$this->registrantModel->getArrayData():$this->registrantModel->getArrayData($gender);
        $data = [];
        $no = 1;
        $nameset = [
            'ind', 
            'ing',
            'mtk', 
            'ipa', 
            'ips', 
        ];
        
        foreach ($registrant_data as $registrant){
            $row = [];
            $row[] = $no;
            $no++;
            $row[] = $registrant['kode'];
            $row[] = $registrant['name'];
            $row[] = ($registrant['gender'] == 'L') ? 'Ikhwan' : 'Akhwat';
            $row[] = $registrant['previousSchool'];
            $row[] = $registrant['program'];
            $row[] = '<a class="btn btn-sm btn-warning" href="'. base_url().'admin/lihat_rapor/'.$registrant['id'].'">Edit</a>';
            
            $rapor = $registrant['rapor'];
            for($i = 1; $i <= 4;$i++){
                foreach ($nameset as $name){
                    if(is_null($rapor)){
                        $rapor = new \App\Entities\RaporEntity();
                    }
                    $row[] = $rapor->get($name, 'kkm', $i);
                    $row[] = $rapor->get($name, 'nilai', $i);
                }
            }
            $data[] = $row;
        }
        
        return $this->response->setJSON(['data' => $data]);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Update rapor data
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function edit_rapor($id){
        $this->blockNonAdmin();
        $data = $this->request->getPost();
        $registrant = $this->registrantModel->find($id);
        $res = false;
        
        if(!is_null($registrant)){
            $res = $this->raporModel->updateData($data, $registrant);
        } else {
            $res = false;
        }
        
        if($res){
            session()->setFlashdata("notices", ["Data Sudah berhasil disimpan"]);
            return redirect()->to('/admin/nilai');
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan, silahkan diulangi lagi..."]);
            return redirect()->to('/admin/nilai');
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display rapor edit form
     * @param int $id Registrant ID
     * @return string View
     */
    public function lihat_rapor($id){
        $this->blockNonAdmin();
        $reg = $this->registrantModel->find($id);
        $reg_rapor = $reg->getRapor();
        
        if(is_null($reg_rapor)){
            $reg_rapor = $this->raporModel->create();
        }
        
        $nameset = [
            'ind' => 'Bahasa Indonesia', 
            'ing' => 'Bahasa Inggris',
            'mtk' => 'Matematika', 
            'ipa' => 'IPA', 
            'ips' => 'IPS', 
        ];
        
        $data = [
            'title' => 'Formulir Rapor',
            'reg' => $reg,
            'username' => session()->get('admin')->getUsername(),
            'admin' => session()->get('admin'),
            'nav_pos' => 'registrantRapor',
            'id' => $id,
            'nameset' => $nameset,
            'rapor' => $reg_rapor,
        ];
        return $this->renderView('admin/edit_nilai_registrant', $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display registrant profile
     * @param int $id Registrant ID
     * @return string View
     */
    public function registrant($id){
        $this->blockNonAdmin();
        $reg_data = $this->registrantModel->find($id);
        
        $data = [
            'title' => 'Profil Pendaftar',
            'username' => session()->get('admin')->getUsername(),
            'id' => $id,
            'admin' => session()->get('admin'),
            'registrant_data' => $reg_data,
            'registrant_edit' => view('admin/edit_detail_registrant',[
                'id' => $id,
                'registrant_detail' => $this->registrantModel->getRegistrantData($reg_data),
                'arr_parent' => $this->parentModel->getData($id, ['father', 'mother', 'guardian']),
                'parents' => ['father', 'mother', 'guardian']
            ]),
            'img_link' => $this->getImgLink($id),
            'status' => $this->registrantModel->cek_status($reg_data),
            'nav_pos' => 'registrantAdmin'
        ];
        return $this->renderView('admin/profile_registrant', $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Get image link
     * @param int $id Registrant ID
     * @return string Image URL
     */
    private function getImgLink($id){
        $filePath = WRITEPATH . 'uploads/foto/' . $id . '.png';
        
        if (!file_exists($filePath)) {
            return base_url().'assets/images/default.png';
        } else {
            $datetime = new \DateTime('now');
            return base_url().'admin/getFoto/'.$id.'/'.hash('md2', $datetime->format('Y-m-d H:i:s'));
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Update registrant password
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function do_password_registrant($id){
        $this->blockNonAdmin();
        $data = $this->request->getPost();
        $data['id'] = $id;
        
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        
        $res = $this->registrantModel->save($data);
        if($res){
            session()->setFlashdata("notices", ["Data Sudah berhasil disimpan"]);
            return redirect()->to('admin/registrant/'.$id);
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
            return redirect()->to('admin/registrant/'.$id);
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Update registrant profile
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function do_edit_profil($id){
        $this->blockNonAdmin();
        $data = $this->request->getPost();
        $data['id'] = $id;
        $res = $this->registrantModel->save($data);
        
        if($res){
            session()->setFlashdata("notices", ["Data Sudah berhasil disimpan"]);
            return redirect()->to('admin/registrant/'.$id);
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
            return redirect()->to('admin/registrant/'.$id);
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Update registrant details
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function do_edit_detail($id){
        $this->blockNonAdmin();
        $data = $this->request->getPost();
        $res = $this->registrantModel->updateDetail($id, $data);
        
        if($res){
            session()->setFlashdata("notices", ["Data Sudah berhasil disimpan"]);
            return redirect()->to('admin/registrant/'.$id);
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
            return redirect()->to('admin/registrant/'.$id);
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Update parent data
     * @param int $id Registrant ID
     * @param string $type Parent type
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function do_edit_parent($id, $type){
        $this->blockNonAdmin();
        $data = $this->request->getPost();
        $res = $this->parentModel->updateData($id, $data, $type);
        
        if($res){
            session()->setFlashdata("notices", ["Data Sudah berhasil disimpan"]);
            return redirect()->to('admin/registrant/'.$id);
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
            return redirect()->to('admin/registrant/'.$id);
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Update letter data
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function do_edit_letter($id){
        $this->blockNonAdmin();
        $data = $this->request->getPost();
        $data['initial_cost'] = ($data['raw_icost'] == '-999')?$data['other_icost']:$data['raw_icost'];
        $data['subscription_cost'] = ($data['raw_scost'] == '-999')?$data['other_scost']:$data['raw_scost'];
        $data['land_donation'] = ($data['raw_lcost'] == '-999')?$data['other_lcost']:$data['raw_lcost'];
        $data['id'] = $id;
        
        $qurban = "-";
        for ($i=1; $i <= 3; $i++) { 
            if (array_key_exists('q'.$i, $data)) {
                $qurban = $qurban.$data['q'.$i].'-';
            }
        }
        $data['qurban'] = $qurban;
        
        $res = $this->registrantModel->save($data);
        if($res){
            session()->setFlashdata("notices", ["Data Sudah berhasil disimpan"]);
            return redirect()->to('admin/registrant/'.$id);
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
            return redirect()->to('admin/registrant/'.$id);
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Upload photo
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function upload_foto($id) {
        $this->blockNonAdmin();
        $file = $this->request->getFile('file');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $id . '.png';
            $file->move(WRITEPATH . 'uploads/foto/', $newName);
            
            session()->setFlashdata("notices", ["Upload Foto Berhasil!"]);
        } else {
            session()->setFlashdata("errors", ["Upload Foto Gagal!"]);
        }
        
        return redirect()->to('admin/registrant/'.$id);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Delete registrant
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function hapus_registrant($id){
        $this->blockNonAdmin();
        $res = $this->registrantModel->delete($id);
        
        if($res){
            session()->setFlashdata("notices", ["Data Sudah berhasil dihapus"]);
            return redirect()->to('admin/lihat');
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
            return redirect()->to('admin/lihat');
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Handle payment-related requests
     * @param int|null $id Payment ID
     * @return mixed
     */
    public function pembayaran($id = null){
        if(is_null($id)){
            return $this->lihat_pembayaran();
        } else {
            return $this->lihat_kwitansi($id);
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display payment list
     * @return string View
     */
    private function lihat_pembayaran(){
        $this->blockNonAdmin();
        $data = $this->adminModel->getReceipt();
        
        return $this->renderView('admin/data_pembayaran', [
            'title' => 'Lihat Resi Pembayaran',
            'username' => session()->get('admin')->getUsername(),
            'admin' => session()->get('admin'),
            'nav_pos' => 'paymentAdmin',
            'data_pembayaran' => $data
        ]);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display payment verification
     * @param int $id Payment ID
     * @return string View
     */
    private function lihat_kwitansi($id){
        $this->blockNonAdmin();
        $resi = $this->adminModel->getReceipt($id);
        $id_registrant = $resi->getRegistrant()->getId();
        
        $data = [
            'title' => 'Konfirmasi Pembayaran',
            'username' => session()->get('admin')->getUsername(),
            'admin' => session()->get('admin'),
            'resi' => $resi,
            'img_receipt' => $this->getImgReceipt($id_registrant),
            'nav_pos' => 'paymentAdmin'
        ];
        return $this->renderView('admin/verifikasi_pembayaran', $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Handle achievement-related requests
     * @param int|null $id Registrant ID
     * @return mixed
     */
    public function prestasi($id = null){
        if(is_null($id)){
            return $this->lihat_prestasi();
        } else {
            return $this->lihat_dokumen($id);
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display achievement list
     * @return string View
     */
    private function lihat_prestasi(){
        $this->blockNonAdmin();
        $data = $this->registrantModel->getSpecialParticipants();
        
        return $this->renderView('admin/data_prestasi', [
            'title' => 'Lihat Peserta Jalur Prestasi dan Tahfidz',
            'username' => session()->get('admin')->getUsername(),
            'admin' => session()->get('admin'),
            'nav_pos' => 'achievementAdmin',
            'data_peserta' => $data
        ]);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display achievement documents
     * @param int $id Registrant ID
     * @return string View
     */
    public function lihat_dokumen($id){
        $this->blockNonAdmin();
        $registrant = $this->registrantModel->find($id);
        
        $data = [
            'title' => 'Dokumen dan Sertifikat',
            'username' => session()->get('admin')->getUsername(),
            'admin' => session()->get('admin'),
            'id' => $registrant->getId(),
            'reg' => $registrant,
            'nav_pos' => 'achievementAdmin'
        ];
        return $this->renderView('admin/dokumen_prestasi', $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Upload certificate
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function upload_cert($id){
        $this->blockNonAdmin();
        $data = $this->request->getPost();
        $file = $this->request->getFile('file');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $data['name'] . '_' . time();
            $file->move(WRITEPATH . 'uploads/sertifikat/', $fileName . '.png');
            $res = $this->registrantModel->addCertificate($id, $data, $fileName);
            
            if($res){
                session()->setFlashdata("notices", ["Data Sudah berhasil disimpan"]);
            } else {
                session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
            }
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
        }
        
        return redirect()->to('admin/prestasi/'.$id);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Delete certificate
     * @param int $reg_id Registrant ID
     * @param int $id Certificate ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function hapus_sertifikat($reg_id,$id){
        $this->blockNonAdmin();
        $res = $this->registrantModel->deleteCertificate($id);
        
        if($res){
            session()->setFlashdata("notices", ["Data Sudah berhasil dihapus"]);
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
        }
        
        return redirect()->to('admin/prestasi/'.$reg_id);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Print certificates
     * @param int $id Registrant ID
     */
    public function print_sertifikat($id){
        $this->blockNonAdmin();
        $registrant = $this->registrantModel->find($id);
        
        $pdfGenerator = new PdfGenerator();
        $data_sertifikat = view('admin/print/dokumen_rekap', ['reg' => $registrant]);
        $pdfGenerator->addPage($data_sertifikat);
        $pdfGenerator->generate('Dokumen Prestasi '.$registrant->getRegId().'.pdf', 'Dokumen Prestasi '.$registrant->getRegId().'.pdf', true);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Get receipt image
     * @param int $id Registrant ID
     * @return string|null Image URL
     */
    private function getImgReceipt($id){
        $filePath = WRITEPATH . 'uploads/receipt/' . $id . '.png';
        
        if (!file_exists($filePath)) {
            return null;
        } else {
            $datetime = new \DateTime('now');
            return base_url().'admin/getReceipt/'.$id.'/'.hash('md2', $datetime->format('Y-m-d H:i:s'));
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Verify payment
     * @param int $id Payment ID
     * @param string $isValid Verification status
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function verifikasi($id, $isValid){
        $this->blockNonAdmin();
        $verified = ($isValid == 'valid')?'valid':'tidak valid';
        $verification_date = new \DateTime('now');
        
        $res = $this->adminModel->updatePayment([
            'id' => $id, 
            'verified' => $verified, 
            'verification_date' => $verification_date->format('d-m-Y') 
        ]);
        
        if($res){
            session()->setFlashdata("notices", ["Data Sudah berhasil disimpan"]);
            return redirect()->to('admin/pembayaran/'.$id);
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
            return redirect()->to('admin/pembayaran/'.$id);
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Export registrant data
     * @param string $gender Gender filter
     * @param string $programme Programme filter
     */
    public function export_data($gender = 'L', $programme = 'tahfidz')
    {
        $this->blockNonAdmin();
        $strGender = ('L' == strtoupper($gender))?'Ikhwan':'Akhwat';
        $date = new \DateTime('now');
        $this->registrantModel->export('Backup Data PPDB '.  ucfirst(strtolower($strGender)).' '. ucwords(strtolower($programme)).' '.$date->format('d-m-Y'),
            $gender, ucfirst($programme));
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Export rapor data
     * @param string $gender Gender filter
     * @param string $programme Programme filter
     */
    public function export_rapor($gender = 'L', $programme = 'tahfidz')
    {
        $this->blockNonAdmin();
        $strGender = ('L' == strtoupper($gender))?'Ikhwan':'Akhwat';
        $date = new \DateTime('now');
        $strProgramme = ucfirst($programme);
        $this->registrantModel->exportRapor('Backup Rapor PPDB '.  ucfirst(strtolower($strGender)).' '. ucwords(strtolower($programme)).' '.$date->format('d-m-Y'),
            $gender, $strProgramme);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Export incomplete data
     */
    public function export_data_uncomplete()
    {
        $this->blockNonAdmin();
        $date = new \DateTime('now');
        $this->registrantModel->export_Uncomplete('Data Belum Lengkap '.$date->format('d-m-Y'));
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Export unpaid data
     */
    public function export_data_unpaid()
    {
        $this->blockNonAdmin();
        $date = new \DateTime('now');
        $this->registrantModel->export_Uncomplete('Data Belum Membayar '.$date->format('d-m-Y'), false, true);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Print incomplete/unpaid cards
     * @param string $unpaid Filter type
     */
    public function print_kartu_incomplete($unpaid = "false"){
        $registrant_data = [];
        
        if ($unpaid == "true"){
            $registrant_data = $this->registrantModel->getUnpaidData();
        } else {
            $registrant_data = $this->registrantModel->getIncompleteData();
        }
        
        $pdfGenerator = new PdfGenerator();
        
        foreach ($registrant_data as $registrant){
            $reg_data = view('registrant/print', ['registrant' => $registrant['object']]);
            $pdfGenerator->addPage($reg_data);
        }
        
        $suffix = ($unpaid == "true")?"belum membayar":"belum lengkap";
        $pdfGenerator->generate('Kartu pendaftar yang '.$suffix.'.pdf', 'Kartu pendaftar yang '.$suffix.'.pdf', true);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Test statement letter generation
     */
    public function tes_surat()
    {
        $this->blockNonAdmin();
        echo $this->getSurat([
            'infaq_pendidikan' => 5000000,
            'spp_bulanan' => 1700000,
            'wakaf_tanah' => 1000000
        ]);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Generate statement letter content
     * @param array $biaya_variabel Variable costs
     * @param bool $laman_isi Form mode
     * @return string HTML content
     */
    protected function getSurat($biaya_variabel = [], $laman_isi = false)
    {
        $converter = new \League\CommonMark\GithubFlavoredMarkdownConverter();
        $html = "";
        $biaya_tetap = config('App')->biayaTetap ?? [];
        $biaya = [];
        
        if ($laman_isi) {
            $lines = file(APPPATH.'Views/markdown/surat_pernyataan.md');
            array_pop($lines);
            $md = join("",$lines);
            $default = [
                'infaq_pendidikan',
                'spp_bulanan',
                'wakaf_tanah'
            ];
            $biaya = $biaya_tetap;
            foreach ($default as $key){
                $md = str_replace(':'.$key.':', '**[[Sesuai Pilihan]]**', $md);
            }
        } else {
            $md = file_get_contents(APPPATH.'Views/markdown/surat_pernyataan.md');
            $biaya = array_merge($biaya_tetap, $biaya_variabel);
            $total = array_sum($biaya);
            $biaya['total'] = $total;
        }
        
        $html = $converter->convert($md);
        foreach ($biaya as $key => $value) {
            $html = str_replace(':'.$key.':', 'Rp.'.number_format($value, 0, ',', '.').',-', $html);
        }
        return $html;
    }
}