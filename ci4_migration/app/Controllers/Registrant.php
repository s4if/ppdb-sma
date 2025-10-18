<?php

namespace App\Controllers;

use App\Models\RegistrantModel;
use App\Models\ParentModel;
use App\Models\RaporModel;
use App\Entities\RegistrantEntity;
use App\Libraries\PdfGenerator;

/**
 * @context7 /codeigniter/controller
 * @description Handles all registrant-related operations
 * @example 
 * // Access registrant dashboard
 * $registrant = new Registrant();
 * $registrant->dashboard($id);
 */
class Registrant extends BaseController
{
    protected $registrantModel;
    protected $parentModel;
    protected $raporModel;

    /**
     * @context7 /codeigniter/controller/method
     * @description Initialize models
     */
    public function __construct()
    {
        $this->registrantModel = new RegistrantModel();
        $this->parentModel = new ParentModel();
        $this->raporModel = new RaporModel();
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display registrant dashboard
     * @param int $id Registrant ID
     * @return string View
     */
    public function dashboard($id)
    {
        $this->blockUnloggedOne($id);
        
        $username = session()->get('registrant')->getUsername();
        $registrant = $this->registrantModel->getDataByUsername($username);
        session()->set('registrant', $registrant);
        
        $data = [
            'title' => 'Beranda',
            'username' => $username,
            'id' => session()->get('registrant')->getId(),
            'registrant' => $registrant,
            'img_receipt' => $this->getImgReceipt($id),
            'status' => $this->registrantModel->cek_status(session()->get('registrant')),
            'nav_pos' => 'home'
        ];
        
        return $this->renderView('registrant/dashboard', $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display password change form
     * @param int $id Registrant ID
     * @return string View
     */
    public function password($id)
    {
        $this->blockUnloggedOne($id);
        $data = [
            'title' => 'Password',
            'username' => session()->get('registrant')->getName(),
            'id' => session()->get('registrant')->getId(),
            'registrant' => session()->get('registrant'),
            'nav_pos' => 'home'
        ];
        return $this->renderView('registrant/password', $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Process password change
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function change_password($id)
    {
        $this->blockUnloggedOne($id);
        $registrant = $this->registrantModel->find($id);
        $data = $this->request->getPost();
        
        if($data['new_password'] == $data['confirm_password']){
            if(password_verify($data['stored_password'], $registrant->getPassword())){
                $this->do_change_password(['password' => $data['new_password'], 'id' => $id]);
            } else {
                session()->setFlashdata("errors", ["Maaf, Password lama anda salah <br />"
                    . "Silahkan di periksa kembali."]);
                return redirect()->to($id.'/password');
            }
        } else {
            session()->setFlashdata("errors", ["Maaf, Password baru dan konfirmasi password tidak sama, <br />"
                . "Silahkan di periksa kembali."]);
            return redirect()->to($id.'/password');
        }        
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Update password in database
     * @param array $data Password data
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    private function do_change_password($data)
    {
        $updateData = [
            'id' => $data['id'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT)
        ];
        
        $res = $this->registrantModel->save($updateData);
        if($res){
            session()->set('registrant', $this->registrantModel->find($data['id']));
            session()->setFlashdata("notices", ["Passsword sudah berhasil diubah."]);
            return redirect()->to($data['id'].'/password');
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
            return redirect()->to($data['id'].'/password');
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Generate unique registration code
     * @param int $id Registrant ID
     * @param string $gender Gender (L/P)
     * @return JSON Response
     */
    public function generate_kodeunik($id, $gender)
    {
        $this->blockUnloggedOne($id);
        $res = $this->registrantModel->genKode($id, $gender);
        if($res['status']){
            return $this->response->setJSON([
                'status' => true,
                'kode' => $res['kode'],
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'kode' => $res['kode'],
            ]);
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Get image link
     * @param int $id Registrant ID
     * @return array Image data
     */
    private function getImgLink($id)
    {
        $img_link = [];
        $filePath = WRITEPATH . 'uploads/foto/' . $id . '.png';
        
        if (!file_exists($filePath)) {
            $img_link[0] = base_url().'assets/images/default.png';
        } else {
            $datetime = new \DateTime('now');
            $img_link[0] = base_url().'registrant/getFoto/'.$id.'/'.hash('md2', $datetime->format('Y-m-d H:i:s'));
        }
        
        $img_link[1] = file_exists($filePath) ? file_get_contents($filePath) : false;
        return $img_link;
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display registrant photo
     * @param int $id Registrant ID
     * @param string $hash Security hash
     */
    public function getFoto($id, $hash)
    {
        $this->blockUnloggedOne($id, true);
        $filePath = WRITEPATH . 'uploads/foto/' . $id . '.png';
        
        if (!file_exists($filePath)) {
            return redirect()->to(base_url().'assets/images/default.png');
        }
        
        $image = service('image')
            ->withFile($filePath)
            ->getResource();
            
        $this->response->setContentType('image/png');
        session()->set('random_hash', $hash);
        echo readfile($filePath);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description AJAX handler for profile editing
     * @param int $id Registrant ID
     * @return JSON Response
     */
    public function ajax_edit_profil($id)
    {
        $this->blockUnloggedOne($id);
        $data = $this->request->getPost();
        $data['id'] = $id;
        $res = $this->registrantModel->save($data);
        
        if($res){
            session()->set('registrant', $this->registrantModel->find($id));
            return $this->response->setJSON([
                'status' => true,
                'profile' => $data,
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'profile' => $data,
            ]);
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display registration form
     * @param int $id Registrant ID
     * @return string View
     */
    public function formulir($id)
    {
        $this->blockUnloggedOne($id);
        $this->blockNonPayers(session()->get('registrant'));
        $reg_data = $this->registrantModel->getRegistrantData(session()->get('registrant'));
        $parent_form = $this->parents($id, 'father').' '.$this->parents($id, 'mother');
        
        $data = [
            'title' => 'Formulir',
            'username' => session()->get('registrant')->getName(),
            'id' => session()->get('registrant')->getId(),
            'registrant' => session()->get('registrant'),
            'reg_data' => $reg_data,
            'parent_form' => $parent_form,
            'nav_pos' => 'formulir',
            'img_link' => $this->getImgLink($id)[0],
        ];
        return $this->renderView('registrant/form', $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display guardian form
     * @param int $id Registrant ID
     * @return string View
     */
    public function guardian($id)
    {
        $this->blockUnloggedOne($id);
        $this->blockNonPayers(session()->get('registrant'));
        $reg_data = $this->registrantModel->getRegistrantData(session()->get('registrant'));
        
        $data = [
            'title' => 'Wali',
            'username' => session()->get('registrant')->getName(),
            'id' => session()->get('registrant')->getId(),
            'registrant' => session()->get('registrant'),
            'reg_data' => $reg_data,
            'parent' => $this->parents($id, 'guardian'),
            'nav_pos' => 'wali',
        ];
        return $this->renderView('registrant/guardian', $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Get parent form HTML
     * @param int $id Registrant ID
     * @param string $type Parent type (father/mother/guardian)
     * @return string HTML
     */
    private function parents($id, $type)
    {
        $key_arr = [
            'father' => 'ayah',
            'mother' => 'ibu',
            'guardian' => 'wali'
        ];
        
        $new_data = false;
        $parent_data = $this->parentModel->getData($id, [$type]);
        
        if (empty($parent_data[$type])) {
            $parent_data[$type] = $this->parentModel->create(); 
            $new_data = true;
        }
        
        return view("registrant/parent",[
            'parent_data' => $parent_data[$type],
            'key' => $key_arr[$type],
            'type' => $type,
            'new_data' => $new_data
        ]);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description AJAX handler for editing all form data
     * @param int $id Registrant ID
     * @return JSON Response
     */
    public function ajax_edit_all($id)
    {
        $this->blockUnloggedOne($id);
        $data = $this->request->getPost();
        $res = $this->do_edit_all($id, $data);
        
        if($res['success'] ==  1){
            session()->set('registrant', $this->registrantModel->find($id));
            return $this->response->setJSON([
                'status' => true,
                'detail' => $data,
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'detail' => $data,
                'inputerror' => $res['errorred'],
            ]);
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Process guardian form
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function do_edit_guardian($id)
    {
        $this->blockUnloggedOne($id);
        $data = $this->request->getPost();
        $types = ['guardian'];
        $res = false;
        
        foreach($types as $type){
            $parent_data = [
                'type' => $type,
                'name' => $data[$type.'_name'],
                'status' => $data[$type.'_status'], 
                'birth_place' => $data[$type.'_birth_place'],
                'birth_date'=> $data[$type.'_birth_date'],
                'street' => $data[$type.'_street'],
                'RT' => $data[$type.'_RT'],
                'RW' => $data[$type.'_RW'],
                'village' => $data[$type.'_village'],
                'district' => $data[$type.'_district'],
                'city' => $data[$type.'_city'],
                'province' => $data[$type.'_province'],
                'postal_code' => $data[$type.'_postal_code'],
                'contact' => $data[$type.'_contact'],
                'relation' => $data[$type.'_relation'],
                'nationality' => $data[$type.'_nationality'],
                'religion' => $data[$type.'_religion'],
                'education_level' => $data[$type.'_education_level'],
                'job' => $data[$type.'_job'],
                'position' => $data[$type.'_position'],
                'company' => $data[$type.'_company'],
                'income' => $data[$type.'_income'],
                'burden_count' => $data[$type.'_burden_count']
            ];
            
            $val[$type] = $this->parentModel->ajaxValidation($parent_data, $type);
            if($val[$type]['valid']){
               $res = $this->parentModel->updateData($id, $parent_data, $type);
            } else {
                $res = false;
            }
            
            if($res){
                session()->setFlashdata("notices", ["Data Sudah berhasil disimpan"]);
                return redirect()->to($id.'/rapor');
            } else {
                session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan, silahkan diulangi lagi..."]);
                return redirect()->to($id.'/wali');
            }
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Process all form data
     * @param int $id Registrant ID
     * @param array $data Form data
     * @return array Result
     */
    private function do_edit_all($id, $data)
    {
        $types = ['father', 'mother'];
        $val['registrant'] = $this->registrantModel->ajaxValidation($data);
        $agg_res = true;
        
        foreach($types as $type){
            $parent_data = [
                'type' => $type,
                'name' => $data[$type.'_name'],
                'status' => $data[$type.'_status'], 
                'birth_place' => $data[$type.'_birth_place'],
                'birth_date'=> $data[$type.'_birth_date'],
                'street' => $data[$type.'_street'],
                'RT' => $data[$type.'_RT'],
                'RW' => $data[$type.'_RW'],
                'village' => $data[$type.'_village'],
                'district' => $data[$type.'_district'],
                'city' => $data[$type.'_city'],
                'province' => $data[$type.'_province'],
                'postal_code' => $data[$type.'_postal_code'],
                'contact' => $data[$type.'_contact'],
                'relation' => $data[$type.'_relation'],
                'nationality' => $data[$type.'_nationality'],
                'religion' => $data[$type.'_religion'],
                'education_level' => $data[$type.'_education_level'],
                'job' => $data[$type.'_job'],
                'position' => $data[$type.'_position'],
                'company' => $data[$type.'_company'],
                'income' => $data[$type.'_income'],
                'burden_count' => $data[$type.'_burden_count']
            ];
            
            $val[$type] = $this->parentModel->ajaxValidation($parent_data, $type);
            if($val[$type]['valid']){
               $res[$type] = $this->parentModel->updateData($id, $parent_data, $type);
            } else {
                $agg_res = false;
            }
        }
        
        if($val['registrant']['valid']){
            $res['registrant'] = $this->registrantModel->updateDetail($id, $data);
        } else {
            $res['registrant'] = false;
        }
        
        $final_result = $res['registrant'] && $agg_res;
        $errored = array_merge($val['registrant']['errored'], $val['father']['errored'], $val['mother']['errored']);
        return ['success'=>$final_result,'errorred'=>$errored];
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display rapor form
     * @param int $id Registrant ID
     * @return string View
     */
    public function isi_rapor($id)
    {
        $this->blockUnloggedOne($id);
        $this->blockNonPayers(session()->get('registrant'));
        $reg = $this->registrantModel->find(session()->get('registrant')->getId());
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
            'username' => session()->get('registrant')->getName(),
            'id' => session()->get('registrant')->getId(),
            'registrant' => session()->get('registrant'),
            'nameset' => $nameset,
            'rapor' => $reg_rapor,
            'nav_pos' => 'rapor',
        ];
        return $this->renderView('registrant/rapor', $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Process rapor form
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function edit_rapor($id)
    {
        $this->blockUnloggedOne($id);
        $data = $this->request->getPost();
        $registrant = $this->registrantModel->find($id);
        $res = false;
        
        if(!is_null($registrant)){
            $res = $this->raporModel->updateData($data, $registrant);
        } else {
            $res = false;
        }
        
        if($res){
            session()->set('registrant', $registrant);
            session()->setFlashdata("notices", ["Data Sudah berhasil disimpan"]);
            return redirect()->to($id.'/surat');
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan, silahkan diulangi lagi..."]);
            return redirect()->to($id.'/rapor');
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Finalize registration
     * @param int $id Registrant ID
     * @param string $finalized Finalized status
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function finalisasi($id, $finalized)
    {
        $this->blockUnloggedOne($id);
        $data['id'] = $id;
        $data['finalized'] = ($finalized == 'true');
        $res = $this->registrantModel->save($data);
        
        if($res){
            session()->set('registrant', $this->registrantModel->find($id));
            session()->setFlashdata("notices", ["Data Sudah berhasil disimpan"]);
            return redirect()->to($id.'/beranda');
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
            return redirect()->to($id.'/beranda');
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Upload photo
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function upload_foto($id) 
    {
        $this->blockUnloggedOne($id);
        $file = $this->request->getFile('file');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $id . '.png';
            $file->move(WRITEPATH . 'uploads/foto/', $newName);
            
            session()->setFlashdata("notices", ["Upload Foto Berhasil!"]);
        } else {
            session()->setFlashdata("errors", ["Upload Foto Gagal!"]);
        }
        
        return redirect()->to($id.'/formulir');
    }
    
    /**
     * @context7 /codeigniter/controller/method
     * @description Upload receipt
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function upload_receipt($id) 
    {
        $this->blockUnloggedOne($id);
        $data = $this->request->getPost();
        $file = $this->request->getFile('file');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $id . '.png';
            $file->move(WRITEPATH . 'uploads/receipt/', $newName);
            $res = $this->registrantModel->uploadReceipt($data, $id);
            
            if($res) {
                session()->setFlashdata("notices", ["Upload Kwitansi Berhasil!"]);
            } else {
                session()->setFlashdata("errors", ["Upload Kwitansi Gagal!"]);
            }
        } else {
            session()->setFlashdata("errors", ["Upload Kwitansi Gagal!"]);
        }
        
        return redirect()->to($id.'/beranda');
    }
    
    /**
     * @context7 /codeigniter/controller/method
     * @description Get receipt image
     * @param int $id Registrant ID
     * @return string|null Image URL
     */
    private function getImgReceipt($id)
    {
        $filePath = WRITEPATH . 'uploads/receipt/' . $id . '.png';
        
        if (!file_exists($filePath)) {
            return null;
        } else {
            $datetime = new \DateTime('now');
            return base_url().'registrant/getReceipt/'.$id.'/'.hash('md2', $datetime->format('Y-m-d H:i:s'));
        }
    }
    
    /**
     * @context7 /codeigniter/controller/method
     * @description Display receipt image
     * @param int $id Registrant ID
     * @param string $hash Security hash
     */
    public function getReceipt($id, $hash)
    {
        $this->blockUnloggedOne($id, true);
        $filePath = WRITEPATH . 'uploads/receipt/' . $id . '.png';
        
        if (!file_exists($filePath)) {
            return redirect()->to(base_url().'assets/images/default.png');
        }
        
        $this->response->setContentType('image/png');
        session()->set('random_hash_2', $hash);
        echo readfile($filePath);
    }
    
    /**
     * @context7 /codeigniter/controller/method
     * @description Display recap data
     * @param int $id Registrant ID
     * @return string View
     */
    public function rekap($id)
    {
        $this->blockUnloggedOne($id);
        $this->blockNonPayers(session()->get('registrant'));
        $registrant = $this->registrantModel->find($id);
        session()->set('registrant', $registrant);
        
        $data = [
            'title' => 'Rekap Data',
            'username' => session()->get('registrant')->getName(),
            'id' => session()->get('registrant')->getId(),
            'nav_pos' => 'recap',
            'img_link' => $this->getImgLink($id)[0],
            'registrant' => session()->get('registrant'),
            'tabel_surat' => $this->getSurat([
                'infaq_pendidikan' => $registrant->getInitialCost(),
                'spp_bulanan' => $registrant->getSubscriptionCost(),
                'wakaf_tanah' => $registrant->getLandDonation(),
            ]),
        ];
        return $this->renderView('registrant/recap', $data);
    }
    
    /**
     * @context7 /codeigniter/controller/method
     * @description Print registration data as PDF
     * @param int $id Registrant ID
     * @param string $action Action (download/view)
     */
    public function print_data_pendaftaran($id, $action = 'download')
    {
        $this->blockUnloggedOne($id, true);
        $registrant = $this->registrantModel->find($id);
        session()->set('registrant', $registrant);
        
        $pdfGenerator = new PdfGenerator();
        
        // Add registration card
        $kartu = view('registrant/print', [
            'registrant' => $registrant,
            'tahun_masuk' => $this->data['tahun_masuk']
        ]);
        $pdfGenerator->addPage($kartu);
        
        // Add registration data
        $data = [
            'title' => 'Print Surat Pernyataan',
            'username' => $registrant->getName(),
            'id' => $registrant->getId(),
            'nav_pos' => 'recap',
            'img_link' => $this->getImgLink($id)[0],
            'registrant' => $registrant,
            'tahun_masuk' => $this->data['tahun_masuk'],
        ];
        $reg_data = view('registrant/print/registrant_data', $data);
        $pdfGenerator->addPage($reg_data);
        
        // Add statement letter if completed
        if($registrant->getCompleted()){
            $data['tabel_surat'] = $this->getSurat([
                'infaq_pendidikan' => $registrant->getInitialCost(),
                'spp_bulanan' => $registrant->getSubscriptionCost(),
                'wakaf_tanah' => $registrant->getLandDonation(),
            ]);
            $reg_letter = view('registrant/print/statement_letter', $data);
            $pdfGenerator->addPage($reg_letter);
        }
        
        $download = ($action == 'download');
        $pdfGenerator->generate('Data Pendaftaran '.$id.'.pdf', 'Data Pendaftaran '.$id.'.pdf', $download);
    }
    
    /**
     * @context7 /codeigniter/controller/method
     * @description Display statement letter form
     * @param int $id Registrant ID
     * @return string View
     */
    public function surat($id)
    {
        $this->blockUnloggedOne($id);
        $this->blockNonPayers(session()->get('registrant'));
        
        $data = [
            'title' => 'Surat Pernyataan',
            'username' => session()->get('registrant')->getName(),
            'id' => session()->get('registrant')->getId(),
            'tabel_surat' => $this->getSurat([], true),
            'biaya_pilihan_minimal' => config('App')->biayaPilihanMinimal ?? 0,
            'tahun_masuk' => config('App')->tahunMasuk ?? date('Y'),
            'registrant' => session()->get('registrant'),
            'nav_pos' => 'letter'
        ];
        return $this->renderView('registrant/letter', $data);
    }
    
    /**
     * @context7 /codeigniter/controller/method
     * @description Display certificate upload form
     * @param int $id Registrant ID
     * @return string View
     */
    public function sertifikat($id)
    {
        $this->blockUnloggedOne($id);
        $this->blockNonPayers(session()->get('registrant'));
        
        $data = [
            'title' => 'Upload Sertifikat',
            'username' => session()->get('registrant')->getName(),
            'id' => session()->get('registrant')->getId(),
            'registrant' => $this->registrantModel->find(session()->get('registrant')->getId()),
            'nav_pos' => 'certificate'
        ];
        return $this->renderView('registrant/certificate_upload', $data);
    }
    
    /**
     * @context7 /codeigniter/controller/method
     * @description Process statement letter form
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function isi_pernyataan($id)
    {
        $this->blockUnloggedOne($id);
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
            session()->set('registrant', $this->registrantModel->find($id));
            session()->setFlashdata("notices", ["Data Sudah berhasil disimpan"]);
            return redirect()->to($id.'/rekap');
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
            return redirect()->to($id.'/surat');
        }
    }
    
    /**
     * @context7 /codeigniter/controller/method
     * @description Upload certificate
     * @param int $id Registrant ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function upload_cert($id)
    {
        $this->blockUnloggedOne($id);
        $data = $this->request->getPost();
        $file = $this->request->getFile('file');
        
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $data['name'] . '_' . time();
            $file->move(WRITEPATH . 'uploads/sertifikat/', $fileName . '.png');
            $res = $this->registrantModel->addCertificate($id, $data, $fileName);
            
            if($res){
                session()->set('registrant', $this->registrantModel->find($id));
                session()->setFlashdata("notices", ["Data Sudah berhasil disimpan"]);
            } else {
                session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
            }
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
        }
        
        return redirect()->to($id.'/sertifikat');
    }
    
    /**
     * @context7 /codeigniter/controller/method
     * @description Display certificate image
     * @param int $id Registrant ID
     * @param string $fileName File name
     */
    public function img_sertifikat($id, $fileName)
    {
        $this->blockUnloggedOne($id, true);
        $filePath = WRITEPATH . 'uploads/sertifikat/' . $fileName . '.png';
        
        if (!file_exists($filePath)) {
            return redirect()->to(base_url().'assets/images/default.png');
        }
        
        $this->response->setContentType('image/png');
        echo readfile($filePath);
    }
    
    /**
     * @context7 /codeigniter/controller/method
     * @description Delete certificate
     * @param int $id Certificate ID
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function hapus_sertifikat($id)
    {
        $this->blockUnloggedOne(session()->get('registrant')->getId());
        $res = $this->registrantModel->deleteCertificate($id);
        
        if($res){
            session()->setFlashdata("notices", ["Data Sudah berhasil dihapus"]);
        } else {
            session()->setFlashdata("errors", ["Maaf, Terjadi Kesalahan"]);
        }
        
        return redirect()->to(session()->get('registrant')->getId().'/sertifikat');
    }
    
    /**
     * @context7 /codeigniter/controller/method
     * @description Print registration card
     */
    public function print_kartu()
    {
        $registrant = session()->get('registrant');
        $this->blockUnloggedOne($registrant->getId(), true);
        
        if(!empty($registrant)){
            $pdfGenerator = new PdfGenerator();
            $reg_data = view('registrant/print', ['registrant' => $registrant]);
            $pdfGenerator->addPage($reg_data);
            $pdfGenerator->generate('Kartu Pendaftaran '.$registrant->getId().'.pdf', 'Kartu Pendaftaran '.$registrant->getId().'.pdf', true);
        } else {
            session()->setFlashdata("errors", ["Maaf, Anda tidak boleh melihat halaman ini lagi!"]);
            return redirect()->to('login/index');
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Display public registrant list
     * @param string $gender Gender filter
     * @return string View
     */
    public function lihat($gender = 'L')
    {
        $this->simpleView('registrant/list', [
            'gender' => $gender, 
        ]);
    }
    
    /**
     * @context7 /codeigniter/controller/method
     * @description AJAX handler for registrant list
     * @param string $gender Gender filter
     * @param bool $completed Completion filter
     * @return JSON Response
     */
    public function lihat_ajax($gender = 'L', $completed = false)
    {
        $registrant_data = $this->registrantModel->getArrayData($gender);
        $data = [];
        $id = 1;
        
        foreach ($registrant_data as $registrant){
            $row = [];
            $row[] = $id;
            $id++;
            $row[] = $registrant['regId'];
            $row[] = $registrant['name'];
            $row[] = ($registrant['gender'] == 'L') ? 'Ikhwan' : 'Akhwat';
            $row[] = $registrant['previousSchool'];
            $row[] = ucfirst($registrant['program']);
            $data[] = $row;
        }
        
        return $this->response->setJSON(['data' => $data]);
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