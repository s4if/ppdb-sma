<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftar extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Model_registrant','reg');
        $this->load->model('Model_parent','parent');
    }
    
    // ================= AFTER LOGIN ===========================
    
    public function beranda($id){
        $this->blockUnloggedOne($id);
        $username = $this->session->registrant->getUsername();
        $registrant = $this->reg->getDataByUsername($username);
        $this->session->registrant = $registrant;
        $data = [
            'title' => 'Beranda',
            'username' => $username,
            'id' => $this->session->registrant->getId(),
            'registrant' => $registrant,
            'img_link' => $this->getImgLink($id)[0],
            'foto_uploaded' => $this->getImgLink($id)[1],
            'img_receipt' => $this->getImgReceipt($id),
            'status' => $this->reg->cek_status($this->session->registrant),
            'nav_pos' => 'home'
        ];
        $this->CustomView('registrant/dashboard', $data);
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
    
    public function generate_kodeunik($id, $gender){
        $this->blockUnloggedOne($id);
        $res = $this->reg->genKode($id, $gender);
        if($res['status']){
            echo json_encode([
                'status' => true,
                'kode' => $res['kode'],
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'kode' => $res['kode'],
            ]);
        }
    }
    
    private function getImgLink($id){
        $this->load->helper('file');
        $img_link = [];
        $file = read_file('./data/foto/'.$id.'.png');
        $datetime = new DateTime('now');
        if($file == false){
            $img_link[0] = base_url().'assets/images/default.png';
        }  else {
            $img_link[0] = base_url().'pendaftar/getFoto/'.$id.'/'.hash('md2', $datetime->format('Y-m-d H:i:s'));
        }
        $img_link[1] = $file;
        return $img_link;
    }
    
    public function getFoto($id, $hash){
        $this->blockUnloggedOne($id, true);
        $imagine = new Imagine\Gd\Imagine();
        $image = $imagine->open('./data/foto/'.$id.'.png');
        $this->session->set_userdata('random_hash', $hash);
        $image->show('png');
    }
    
    public function ajax_edit_profil($id){
        $this->blockUnloggedOne($id);
        $data = $this->input->post(null, true);
        $data['id'] = $id;
        $res = $this->reg->updateData($data);
        if($res){
            $this->session->set_userdata('registrant', $this->reg->getRegistrant());
            echo json_encode([
                'status' => true,
                'profile' => $data,
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'profile' => $data,
            ]);
        }
    }
    
    public function formulir($id){
        $this->blockUnloggedOne($id);
        $reg_data = $this->reg->getRegistrantData($this->session->registrant);
        $parent_form = $this->parents($id, 'father').' '.$this->parents($id, 'mother');
        $data = [
            'title' => 'Formulir',
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
            'registrant' => $this->session->registrant,
            'reg_data' => $reg_data,
            'parent_form' => $parent_form,
            'nav_pos' => 'formulir'
        ];
        $this->CustomView('registrant/forms', $data);
    }
    
    private function parents($id, $type){
        $key_arr = [
            'father' => 'ayah',
            'mother' => 'ibu',
            'guardian' => 'wali'
        ];
        $parent_data = (empty($this->parent->getData($id, [$type])[$type]))? $parent_data = $this->parent->create(): $this->parent->getData($id, [$type])[$type];
        $string = $this->load->view("registrant/parent",[
            'parent_data' => $parent_data,
            'key' => $key_arr[$type],
            'type' => $type
        ],true);
        return $string;
    }
    
    public function ajax_edit_all($id){
        $this->blockUnloggedOne($id);
        $data = $this->input->post(null, true);
        $res = $this->do_edit_all($id, $data);
        if($res['success']){
            $this->session->set_userdata('registrant', $this->reg->getRegistrant());
            echo json_encode([
                'status' => true,
                'detail' => $data,
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'detail' => $data,
                'inputerror' => $res['errorred'],
            ]);
        }
    }
    
    private function do_edit_all($id, $data){
        $types = ['father', 'mother'];
        $val['registrant'] = $this->reg->ajaxValidation($data);
        $res = [];
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
            $val[$type] = $this->parent->ajaxValidation($parent_data, $type);
            if($val[$type]['valid']){
                $res[$type] = $this->parent->updateData($id, $parent_data, $type);
            }
        }
        if($val['registrant']['valid']){
            $res['registrant'] = $this->reg->updateDetail($id, $data);
        }
        $final_result = true;
        foreach ($res as $result){
            $final_result = $final_result && $result;
        }
        $errored = array_merge($val['registrant']['errored'], $val['father']['errored'], $val['mother']['errored']);
        return ['success'=>$final_result,'errorred'=>$errored];
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
            $this->session->set_flashdata("notices", [0 => "Upload Kwitansi Berhasil!"]);
            redirect($id.'/beranda');
        } else {
            $this->session->set_flashdata("errors", [0 => "Upload Kiwtansi Gagal!"]);
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
            'img_link' => $this->getImgLink($id)[0],
            'registrant' => $this->session->registrant,
        ];
        $this->CustomView('registrant/recap', $data);
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
            'img_link' => $this->getImgLink($id)[0],
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
    
    public function surat($id){
        $this->blockUnloggedOne($id);
        $data = [
            'title' => 'Surat Pernyataan',
            'username' => $this->session->registrant->getName(),
            'id' => $this->session->registrant->getId(),
            'registrant' => $this->session->registrant,
            'nav_pos' => 'letter'
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
    
    public function lihat($gender = 'L'){
        //$registrant_data = $this->reg->getArrayData($gender, null);
        $this->load->view('registrant/list', [
            'gender' => $gender, 
            //'data_registrant' => $registrant_data
        ]);
    }
    
    public function lihat_ajax($gender = 'L'){
        $registrant_data = $this->reg->getArrayData($gender, null);
        $data = [];
        foreach ($registrant_data as $registrant){
            $row = [];
            $row[] = $registrant['id'];
            $row[] = $registrant['name'];
            $row[] = $registrant['nisn'];
            $row[] = ($registrant['gender'] == 'L') ? 'Ikhwan' : 'Akhwat';
            $row[] = $registrant['previousSchool'];
            $row[] = ucfirst($registrant['program']);
            $row[] = $registrant['status'];
            $data [] = $row;
        }
        echo json_encode(['data' => $data]);
    }
}