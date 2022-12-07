<?php

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
 * Description of Model_user
 *
 * @author s4if
 */
use \PhpOffice\PhpSpreadsheet\Spreadsheet\IOFactory;

class Model_registrant extends CI_Model {
    
    protected $registrant;
    protected $registrantData;
    protected $counter;
    protected $paymentData;
    protected $excel;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function create(){
        return new RegistrantEntity();
    }
    
    public function getData($gender = NULL, $id = null, $onlyShowCompleted = false){
        if(is_null($id)){
            $regRepo = $this->doctrine->em->getRepository('RegistrantEntity');
            return $regRepo->getData($gender, $onlyShowCompleted);
        } else {
            $registrant = $this->doctrine->em->find('RegistrantEntity', $id);
            $this->registrant = $registrant;
            return $registrant;
        }
    }
    
    public function getUnpaidData(){
        $oriData = $this->getArrayData();
        $resData = [];
        foreach ($oriData as $data){
            if($data['status'] == "Belum Membayar Biaya Pendaftaran"){
                $resData[] = $data;
            }
        }
        return $resData;
    }
    
    public function getIncompleteData(){
        $oriData = $this->getArrayData();
        $resData = [];
        foreach ($oriData as $data){
            if(!($data['status'] == "Belum Membayar Biaya Pendaftaran")&& !$data['completed']){
                $resData[] = $data;
            }
        }
        return $resData;
    }

    public function getDataByUsername($username) {
        return $this->doctrine->em->getRepository('RegistrantEntity')->getDataByUsername($username);
    }
    
    public function getArrayData($gender = NULL, $vars = [], $completed = false){
        $data = $this->getData($gender, null, $completed);
        if (empty($vars)){
            $vars = ['id','regId', 'kode', 'username', 'name','gender','previousSchool','nisn', 'cp', 'program', 'rapor', 'finalized'];
        }
        $arrData = [];
        foreach ($data as $registrant){
            $id = $registrant->getId();
            $arrData [$id] = $registrant->getArray($vars);
            $reg_status = $this->stringStatus($registrant);
            $arrData [$id] ['status'] = $reg_status['status'];
            $arrData [$id] ['completed'] = $reg_status['completed'];
            $arrData [$id] ['object'] = $registrant;
        }
        return $arrData;
    }
    
    public function getCount($filter = []){
        $regRepo = $this->doctrine->em->getRepository('RegistrantEntity');
        if (empty($filter)){
            return $regRepo->getCount();
        } else {
            return $regRepo->getCountByFilter($filter);
        }
    }
//    
//    public function getDataByFilter($filter = []){
//        $regRepo = $this->doctrine->em->getRepository('RegistrantEntity');
//        return $regRepo->getDataByFilter($filter);
//    }
    
    // TODO: In Production always enable try and catch
    public function insertData($data){
        try {
            //$this->duplicateCheck($data);
            $this->registrant = new RegistrantEntity();
            $data['reg_time'] = new DateTime('now');
            $this->setRegistrantData($data);
            $this->registrant->setDeleted(false);
            $this->registrant->setGelombang('gelombang 1');
            $this->doctrine->em->persist($this->registrant);
            $this->doctrine->em->flush();
            return true;
        } catch (Doctrine\DBAL\Exception\NotNullConstraintViolationException $ex){
            return false;
        } catch (Doctrine\DBAL\Exception\UniqueConstraintViolationException $ex){
            return false;
        }
    }
    
    // Xperimental
    public function getRegistrant(RegistrantEntity $reg = null) {
        if(is_null($reg)){
            return $this->registrant;
        } else {
            $registrant = $this->doctrine->em->find('RegistrantEntity', $reg->getId());
            return $registrant;
        }
    }
    // ===========
    
    // generate Id berdasarkan counter
    public function genKode($id, $gender, $flush = true){
        $counter = $this->doctrine->em->find('CounterEntity', 1);
        $registrant = $this->doctrine->em->find('RegistrantEntity', $id);
        $kode = "";
        if (is_null($registrant->getKode()) && $gender == $registrant->getGender()){
            if($gender == 'P'){
                $counter->addFemaleCount(); // gelombang 2 tambah 300
                $kode = sprintf("%03d", 500 + $counter->getFemaleCount()); //nilai asli 500
                $registrant->setKode($kode);
            } else {
                $counter->addMaleCount(); // gelombang 2 tambah 300
                $kode = sprintf("%03d", $counter->getMaleCount()); //nilai asli 0
                $registrant->setKode($kode);
            }
            $registrant->setRegId(); // dibuat auto bikin regID
            $this->doctrine->em->persist($counter);
            $this->doctrine->em->persist($registrant);
            if ($flush) {
                $this->doctrine->em->flush();
            }
            return ['status' => true, 'kode' => $kode];
        } else {
            $kode = $registrant->getKode();
            return ['status' => true, 'kode' => $kode];
        }
    }
    
    public function updateData($data){
        $this->registrant = $this->doctrine->em->find('RegistrantEntity', $data['id']);
        if(is_null($this->registrant)){
            return false;
        } else {
            $this->setRegistrantData($data);
            $this->registrant->setDeleted(false);
            $this->doctrine->em->persist($this->registrant);
            $this->doctrine->em->flush();
            return true;
        }
    }
    
    public function deleteData($data){
        $this->registrant = $this->doctrine->em->find( 'RegistrantEntity', $data['id']);
        if(is_null($this->registrant)){
            return false;
        } elseif ($this->registrant->getDeleted()) {
            return false;
        } else {
            $this->registrant->setDeleted(true);
            $this->doctrine->em->persist($this->registrant);
            $this->doctrine->em->flush();
            return true;
        }
    }
    
    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    protected function setRegistrantData($data){
        if (!empty($data['reg_id'])) : $this->registrant->setRegId($data['reg_id']); endif;
        if (!empty($data['password'])) : $this->registrant->setPassword(password_hash($data['password'], PASSWORD_BCRYPT)); endif;
        if (!empty($data['username'])) : $this->registrant->setUsername($data['username']); endif;
        if (!empty($data['name'])) : $this->registrant->setName(strtoupper($data['name'])); endif;
        if (!empty($data['gender'])) : $this->registrant->setGender($data['gender']); endif;
        if (!empty($data['prev_school'])) : $this->registrant->setPreviousSchool(strtoupper($data['prev_school'])); endif;
        if (!empty($data['nisn'])) : $this->registrant->setNisn($data['nisn']); endif;
        if (!empty($data['cp'])) : $this->registrant->setCp($data['cp']); endif;
        if (!empty($data['program'])) : $this->registrant->setProgram($data['program']); endif;
        if (!empty($data['reg_time'])) : $this->registrant->setRegistrationTime($data['reg_time']); endif;
        if (!empty($data['initial_cost'])) : $this->registrant->setInitialCost($data['initial_cost']); endif;
        if (!empty($data['finalized'])) : $this->registrant->setFinalized($data['finalized']); endif;
        if (!empty($data['qurban'])) : $this->registrant->setQurban($data['qurban']); endif;
        if (!empty($data['rel_to_regular'])) : $this->registrant->setRelToRegular($data['rel_to_regular']); endif;
        if (!empty($data['rel_to_ips'])) : $this->registrant->setRelToIPS($data['rel_to_ips']); endif;
        if (!empty($data['subscription_cost'])) : $this->registrant->setSubscriptionCost($data['subscription_cost']); endif;
        if (!empty($data['land_donation'])) : $this->registrant->setLandDonation($data['land_donation']); endif;
        if (!empty($data['main_parent'])) : $this->registrant->setMainParent($data['main_parent']); endif;
        if (!empty($data['deleted'])) : $this->registrant->setDeleted($data['deleted']); endif;
        //if (!empty($data['gelombang'])) : $this->registrant->setGelombang($data['gelombang']); endif;
    }
    
    
    //==========================================================================
    
    public function getRegistrantData(RegistrantEntity $reg){
        $data = $reg->getRegistrantData();
        if(is_null($data)){
            $data = new RegistrantDataEntity();
        }
        return $data;
    }
    
    public function updateDetail($id, $data){
        $this->registrant = $this->doctrine->em->find( 'RegistrantEntity', $id);
        if(is_null($this->registrant)){
                return false;
            } else {
                if(is_null($this->registrant->getRegistrantData())){
                    $this->registrantData = new RegistrantDataEntity();
                } else {
                    $this->registrantData = $this->registrant->getRegistrantData();
                }
            $this->setRegistrantDetail($data);
            $this->genKode($this->registrant->getId(), $this->registrant->getGender(), false);
            $this->registrantData->setRegistrant($this->registrant);
            $this->doctrine->em->persist($this->registrantData);
            $this->registrant->setRegistrantData($this->registrantData);
            $this->doctrine->em->persist($this->registrant);
            $this->doctrine->em->flush();
            $this->setRegistrantExtraData($data);
            $this->doctrine->em->persist($this->registrantData);
            $this->doctrine->em->flush();
            return true;
        }
    }
    
    public function deleteDetail($id){
        $this->registrant = $this->doctrine->em->find( 'RegistrantEntity', $id);
        if(is_null($this->registrant)){
            return false;
        } else {
            if(is_null($this->registrant->getRegistrantData())){
                return true;
            } else {
                $this->registrantData = $this->registrant->getRegistrantData();
                $this->registrant->setRegistrantData(null);
                $this->doctrine->em->persist($this->registrant);
                $this->doctrine->em->remove($this->registrantData);
                $this->doctrine->em->flush();
                return true;
            }
        }
    }
    
    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    //id, registrant, birthplace, birthdate, street, RT, RW, village, district, city, province, postalCode, familyCondition, nationality, religion, height, weight, stayWith
    protected function setRegistrantDetail($data){
        if (!empty($data['registrant'])) : $this->registrantData->setRegistrant($data['registrant']); endif; //bentuk objek jadi
        if (!empty($data['nik'])) : $this->registrantData->setNik($data['nik']); endif;
        if (!empty($data['nkk'])) : $this->registrantData->setNkk($data['nkk']); endif;
        if (!empty($data['nak'])) : $this->registrantData->setNak($data['nak']); endif;
        if (!empty($data['blood_type'])) : $this->registrantData->setBloodType($data['blood_type']); endif;
        if (!empty($data['birth_place'])) : $this->registrantData->setBirthPlace($data['birth_place']); endif;
        if (!empty($data['birth_date'])) : $this->registrantData->setBirthDate(new DateTime($data['birth_date'])); endif;
        if (!empty($data['child_order'])) : $this->registrantData->setChildOrder($data['child_order']); endif;
        if (!empty($data['siblings_count'])) : $this->registrantData->setSiblingsCount($data['siblings_count']); endif;
        if (!empty($data['street'])) : $this->registrantData->setStreet($data['street']); endif;
        if (!empty($data['RT'])) : $this->registrantData->setRT($data['RT']); endif;
        if (!empty($data['RW'])) : $this->registrantData->setRW($data['RW']); endif;
        if (!empty($data['village'])) : $this->registrantData->setVillage($data['village']); endif;
        if (!empty($data['district'])) : $this->registrantData->setDistrict($data['district']); endif;
        if (!empty($data['city'])) : $this->registrantData->setCity($data['city']); endif;
        if (!empty($data['province'])) : $this->registrantData->setProvince($data['province']); endif;        
        if (!empty($data['postal_code'])) : $this->registrantData->setPostalCode($data['postal_code']); endif;
        if (!empty($data['family_condition'])) : $this->registrantData->setFamilyCondition($data['family_condition']); endif;
        if (!empty($data['nationality'])) : $this->registrantData->setNationality($data['nationality']); endif;
        if (!empty($data['religion'])) : $this->registrantData->setReligion($data['religion']); endif;
        if (!empty($data['height'])) : $this->registrantData->setHeight($data['height']); endif;
        if (!empty($data['weight'])) : $this->registrantData->setWeight($data['weight']); endif;
        if (!empty($data['stay_with'])) : $this->registrantData->setStayWith($data['stay_with']); endif;
    }
    
    public function ajaxValidation($data){
        $input_error = [];
        $valid = true;
        $arr_required = [
            'nik','nkk','nak','birth_place', 'birth_date', 'street', 'village', 'district', 
            'city', 'province', 'postal_code', 'family_condition', 'nationality', 'religion', 
            'height', 'weight', 'stay_with', 'child_order'
        ];
        foreach ($arr_required as $required){
            if(array_key_exists($required, $data)){
                if(empty($data[$required])){
                    $input_error [] = $required;
                    $valid = false;
                }
            } else {
                $input_error [] = $required;
                $valid = false;
            }
        }
        return ['valid' => $valid, 'errored' => $input_error];
    }
    
    protected function setRegistrantExtraData($data){
        if (!empty($data['achievements'])) : $this->setAchievement($data['achievements']); endif;
        if (!empty($data['hobbies'])) : $this->setHobby($data['hobbies']); endif;
        if (!empty($data['hospital_sheets'])) : $this->setHospitalSheet($data['hospital_sheets']); endif;
        if (!empty($data['physical_abnormalities'])) : $this->setPhysicalAbnormality($data['physical_abnormalities']); endif;
    }
    
    // TODO: Apakah perlu untuk dibuat cara menghapusnya?
    protected function setAchievement($achievements){
        $this->registrantData->removeAchievement();
        foreach ($achievements as $achievement){
            $this->registrantData->addAchievement($achievement);
        }
    }
    
    protected function setHobby($hobbies){
        $this->registrantData->removeHobby();
        foreach ($hobbies as $hobby){
            $this->registrantData->addHobby($hobby);
        }
    }
    
    protected function setHospitalSheet($hospitalSheets){
        $this->registrantData->removeHospitalSheet();
        foreach ($hospitalSheets as $hospitalSheet){
            $this->registrantData->addHospitalSheet($hospitalSheet);
        }
    }
    
    protected function setPhysicalAbnormality($physicalAbnormalities){
        $this->registrantData->removePhysicalAbnormality();
        foreach ($physicalAbnormalities as $physicalAbnormality){
            $this->registrantData->addPhysicalAbnormality($physicalAbnormality);
        }
    }
    
    public function uploadFoto($file_url, $id){
        try {
            $imagine = new Imagine\Gd\Imagine();
            $image = $imagine->open($file_url);
            $box = new Imagine\Image\Box(300, 400);
            $image->resize($box);
            $image->save(FCPATH.'data/foto/'.$id.'.png');
            return true;
        } catch (Imagine\Exception\RuntimeException $e){
            return false;
        }
    }
    
    public function uploadReceipt($file_url, $id, $data){
        try {
            $imagine = new Imagine\Gd\Imagine();
            $image = $imagine->open($file_url);
            $image->save(FCPATH.'data/receipt/'.$id.'.png');
            $this->receipt_data($id, $data);
            return true;
        } catch (Imagine\Exception\RuntimeException $e){
            return false;
        }
    }
    
    public function receipt_data($id, $data){
        $this->registrant = $this->doctrine->em->find('RegistrantEntity', $id);
        $this->paymentData = $this->registrant->getPaymentData();
        if(is_null($this->paymentData)){
            $this->paymentData = new PaymentEntity();
        }
        $this->registrant->setVerified(NULL);
        $this->paymentData->setVerified(NULL);
        $this->paymentData->setAmount($data['amount']);
        $this->paymentData->setPaymentDate(new DateTime($data['payment_date']));
        $this->paymentData->setRegistrant($this->registrant);
        $this->doctrine->em->persist($this->paymentData);
        $this->registrant->setPaymentData($this->paymentData);
        $this->doctrine->em->persist($this->registrant);
        $this->doctrine->em->flush();
    }
    
    // belum di-test
    // 0 -> Belum 1-> Sudah 2->Finalisasi
    public function cek_status(RegistrantEntity $registrant){
        //$id = $registrant->getId();
        $arr_result = [];
        $all_stats = 0;
        if(is_null($registrant->getRegistrantData())){
            $arr_result ['data'] = 0;
        } else {
            $arr_result ['data'] = 1;
            $all_stats++;
        }
        if(is_null($registrant->getFather())){
            $arr_result ['father'] = 0;
        } else {
            $arr_result ['father'] = 1;
            $all_stats++;
        }
        if(is_null($registrant->getMother())){
            $arr_result ['mother'] = 0;
        } else {
            $arr_result ['mother'] = 1;
            $all_stats++;
        }
        if(is_null($registrant->getGuardian())){
            $arr_result ['guardian'] = 0;
        } else {
            $arr_result ['guardian'] = 1;
        }
        //$this->load->helper('file');
//        $file = read_file('./data/foto/'.$id.'.png');
//        if(!$file){
//            $arr_result ['foto'] = 0;
//        } else {
//            $arr_result ['foto'] = 1;
//            $all_stats++;
//        }
        if(!$registrant->getFinalized()){
            $arr_result ['finalized'] = 0;
        } else {
            $arr_result ['finalized'] = 1;
            $all_stats++;
        }
        if(is_null($registrant->getMainParent())){
            $arr_result ['letter'] = 0;
        } else {
            $arr_result ['letter'] = 1;
            $all_stats++;
        }
        if(!empty($registrant->getPaymentData())){
            $arr_result ['payment'] = $this->cek_receipt($registrant);
        } else {
            $arr_result ['payment'] = 0;
        }
        $arr_result['completed'] = ($all_stats >=5)?true:false;
        return $arr_result;
    }
    
    private function stringStatus(RegistrantEntity $registrant){
        $status  = $this->cek_status($registrant);
        if($status['completed']) {
            $str = "";
            if(!$registrant->getFinalized()){
                $str = 'Data telah lengkap, kurang finalisasi';
            }elseif (is_null($registrant->getVerified())) {
                $str = 'Pendaftaran selesai, menunggu verifikasi pembayaran';
            }elseif($registrant->getVerified()=='tidak valid'){
                $str = 'Bukti Pendaftaran Tidak Valid';
            }elseif($registrant->getFinalized() && ($registrant->getVerified()=='valid')){
                $str = 'Pendaftaran telah selesai';
            }
            return ['status' => $str, 'completed' => $status['completed']];
        } elseif ($status['payment']==0) {
            $str = "Belum Membayar Biaya Pendaftaran";
            return ['status' => $str, 'completed' => $status['completed']];
        }else {
            $str = 'Data yang kurang : '; // String Status
            if($status['data'] < 1): $str = $str.'data diri, '; endif;
            if($status['father'] < 1): $str = $str.'data ayah, '; endif;
            if($status['mother'] < 1): $str = $str.'data ibu, '; endif;
            if($status['letter'] < 1): $str = $str.'surat pernyataan, '; endif;
            if($status['finalized'] < 1): $str = $str.'Finalisasi, '; endif;
//            if($status['foto'] < 1): $str = $str.'Foto, '; endif;
            return ['status' => $str, 'completed' => $status['completed']];
        }
    }
    
    private function cek_receipt($registrant){
        if(!empty($registrant->getPaymentData())){
            $payment = $registrant->getPaymentData();
            if($payment->getVerified() == null){
                return 1;
            } elseif ($payment->getVerified() == 'valid') {
                return 2;
            } else {
                return -1;
            }
        }
    }
    
    public function export($file_name, $gender, $programme, $test = false){
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        ini_set('max_execution_time', 60);
        ini_set('memory_limit', '256M');
                
        $this->excel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $this->mbatik($this->getDataByJurusan($programme, $gender), 'Data');
        
        $this->excel->removeSheetByIndex(0);
        if($test){
            return TRUE;
        } else {
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$file_name.'.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xls($this->excel);
            $objWriter->save('php://output');
            exit;
        }
    }
    
    private function getDataByJurusan($program, $gender){
        $regRepo = $this->doctrine->em->getRepository('RegistrantEntity');
        return $regRepo->getDataByJurusan($program, $gender);
    }
    
    private function mbatik($data, $title){ // TODO: Tambah Golongan Darah
        $worksheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet();
        $worksheet->setTitle($title);
        
        $this->excel->addSheet($worksheet);
        
        // Siswa Start
        $worksheet->mergeCells('A3:X3');
        $worksheet->setCellValue('A3', 'Data Siswa');
        $worksheet->getColumnDimension('A')->setAutoSize(true);
        $worksheet->SetCellValue('A4', 'No. Pendaftaran');
        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->SetCellValue('B4', 'Kode Pembayaran');
        $worksheet->getColumnDimension('C')->setAutoSize(true);
        $worksheet->SetCellValue('C4', 'NISN');
        $worksheet->getColumnDimension('D')->setAutoSize(true);
        $worksheet->SetCellValue('D4', 'Nama');
        $worksheet->getColumnDimension('E')->setAutoSize(true);
        $worksheet->SetCellValue('E4', 'Ikhwan/Akhwat');
        $worksheet->getColumnDimension('F')->setAutoSize(true);
        $worksheet->SetCellValue('F4', 'Sekolah Asal');
        $worksheet->getColumnDimension('G')->setAutoSize(true);
        $worksheet->SetCellValue('G4', 'Program');
        $worksheet->getColumnDimension('H')->setAutoSize(true);
        $worksheet->SetCellValue('H4', 'TTL');
        $worksheet->getColumnDimension('I')->setAutoSize(true);
        $worksheet->SetCellValue('I4', 'Alamat');
        $worksheet->getColumnDimension('J')->setAutoSize(true);
        $worksheet->SetCellValue('J4', 'Golongan Darah');
        $worksheet->getColumnDimension('K')->setAutoSize(true);
        $worksheet->SetCellValue('K4', 'Nomor Induk Kependudukan (NIK)');
        $worksheet->getColumnDimension('L')->setAutoSize(true);
        $worksheet->SetCellValue('L4', 'Nomor Kartu Keluarga (KK)');
        $worksheet->getColumnDimension('M')->setAutoSize(true);
        $worksheet->SetCellValue('M4', 'Nomor Akte Kelahiran');
        $worksheet->getColumnDimension('N')->setAutoSize(true);
        $worksheet->SetCellValue('N4', 'Keluarga');
        $worksheet->getColumnDimension('O')->setAutoSize(true);
        $worksheet->SetCellValue('O4', 'Saudara');
        $worksheet->getColumnDimension('P')->setAutoSize(true);
        $worksheet->SetCellValue('P4', 'Kewarganegaraan');
        $worksheet->getColumnDimension('Q')->setAutoSize(true);
        $worksheet->SetCellValue('Q4', 'Agama');
        $worksheet->getColumnDimension('R')->setAutoSize(true);
        $worksheet->SetCellValue('R4', 'Tinggi');
        $worksheet->getColumnDimension('S')->setAutoSize(true);
        $worksheet->SetCellValue('S4', 'Berat');
        $worksheet->getColumnDimension('T')->setAutoSize(true);
        $worksheet->SetCellValue('T4', 'Riwayat Penyakit');
        $worksheet->getColumnDimension('U')->setAutoSize(true);
        $worksheet->SetCellValue('U4', 'Kelainan Jasmani');
        $worksheet->getColumnDimension('V')->setAutoSize(true);
        $worksheet->SetCellValue('V4', 'Tinggal Bersama');
        $worksheet->getColumnDimension('W')->setAutoSize(true);
        $worksheet->SetCellValue('W4', 'Hobi');
        $worksheet->getColumnDimension('X')->setAutoSize(true);
        $worksheet->SetCellValue('X4', 'Prestasi');
        // End Siswa
        
        // Start Ayah
        $worksheet->mergeCells('Y3:AL3');
        $worksheet->setCellValue('X3', 'Data Ayah');
        $worksheet->getColumnDimension('Y')->setAutoSize(true);
        $worksheet->SetCellValue('Y4', 'Nama');
        $worksheet->getColumnDimension('Z')->setAutoSize(true);
        $worksheet->SetCellValue('Z4', 'Status');
        $worksheet->getColumnDimension('AA')->setAutoSize(true);
        $worksheet->SetCellValue('AA4', 'TTL');
        $worksheet->getColumnDimension('AB')->setAutoSize(true);
        $worksheet->SetCellValue('AB4', 'Alamat');
        $worksheet->getColumnDimension('AC')->setAutoSize(true);
        $worksheet->SetCellValue('AC4', 'No. Telp');
        $worksheet->getColumnDimension('AD')->setAutoSize(true);
        $worksheet->SetCellValue('AD4', 'Hubungan dengan pendaftar');
        $worksheet->getColumnDimension('AE')->setAutoSize(true);
        $worksheet->SetCellValue('AE4', 'Kewarganegaraan');
        $worksheet->getColumnDimension('AF')->setAutoSize(true);
        $worksheet->SetCellValue('AF4', 'Agama');
        $worksheet->getColumnDimension('AG')->setAutoSize(true);
        $worksheet->SetCellValue('AG4', 'Tingkat Pendidikan');
        $worksheet->getColumnDimension('AH')->setAutoSize(true);
        $worksheet->SetCellValue('AH4', 'Pekerjaan');
        $worksheet->getColumnDimension('AI')->setAutoSize(true);
        $worksheet->SetCellValue('AI4', 'Jabatan');
        $worksheet->getColumnDimension('AJ')->setAutoSize(true);
        $worksheet->SetCellValue('AJ4', 'Instansi');
        $worksheet->getColumnDimension('AK')->setAutoSize(true);
        $worksheet->SetCellValue('AK4', 'Penghasilan');
        $worksheet->getColumnDimension('AL')->setAutoSize(true);
        $worksheet->SetCellValue('AL4', 'Jumlah Tanggungan');
        // End Ayah
        
        // Start Ibu
        $worksheet->mergeCells('AM3:AZ3');
        $worksheet->setCellValue('AM3', 'Data Ibu');
        $worksheet->getColumnDimension('AM')->setAutoSize(true);
        $worksheet->SetCellValue('AM4', 'Nama');
        $worksheet->getColumnDimension('AN')->setAutoSize(true);
        $worksheet->SetCellValue('AN4', 'Status');
        $worksheet->getColumnDimension('AO')->setAutoSize(true);
        $worksheet->SetCellValue('AO4', 'TTL');
        $worksheet->getColumnDimension('AP')->setAutoSize(true);
        $worksheet->SetCellValue('AP4', 'Alamat');
        $worksheet->getColumnDimension('AQ')->setAutoSize(true);
        $worksheet->SetCellValue('AQ4', 'No. Telp');
        $worksheet->getColumnDimension('AR')->setAutoSize(true);
        $worksheet->SetCellValue('AR4', 'Hubungan dengan pendaftar');
        $worksheet->getColumnDimension('AS')->setAutoSize(true);
        $worksheet->SetCellValue('AS4', 'Kewarganegaraan');
        $worksheet->getColumnDimension('AT')->setAutoSize(true);
        $worksheet->SetCellValue('AT4', 'Agama');
        $worksheet->getColumnDimension('AU')->setAutoSize(true);
        $worksheet->SetCellValue('AU4', 'Tingkat Pendidikan');
        $worksheet->getColumnDimension('AV')->setAutoSize(true);
        $worksheet->SetCellValue('AV4', 'Pekerjaan');
        $worksheet->getColumnDimension('AW')->setAutoSize(true);
        $worksheet->SetCellValue('AW4', 'Jabatan');
        $worksheet->getColumnDimension('AX')->setAutoSize(true);
        $worksheet->SetCellValue('AX4', 'Instansi');
        $worksheet->getColumnDimension('AY')->setAutoSize(true);
        $worksheet->SetCellValue('AY4', 'Penghasilan');
        $worksheet->getColumnDimension('AZ')->setAutoSize(true);
        $worksheet->SetCellValue('AZ4', 'Jumlah Tanggungan');
        // End Ibu
        
        // Start Wali
        $worksheet->mergeCells('BA3:BN3');
        $worksheet->setCellValue('BA3', 'Data Wali');
        $worksheet->getColumnDimension('BA')->setAutoSize(true);
        $worksheet->SetCellValue('BA4', 'Nama');
        $worksheet->getColumnDimension('BB')->setAutoSize(true);
        $worksheet->SetCellValue('BB4', 'Status');
        $worksheet->getColumnDimension('BC')->setAutoSize(true);
        $worksheet->SetCellValue('BC4', 'TTL');
        $worksheet->getColumnDimension('BD')->setAutoSize(true);
        $worksheet->SetCellValue('BD4', 'Alamat');
        $worksheet->getColumnDimension('BE')->setAutoSize(true);
        $worksheet->SetCellValue('BE4', 'No. Telp');
        $worksheet->getColumnDimension('BF')->setAutoSize(true);
        $worksheet->SetCellValue('BF4', 'Hubungan dengan pendaftar');
        $worksheet->getColumnDimension('BG')->setAutoSize(true);
        $worksheet->SetCellValue('BG4', 'Kewarganegaraan');
        $worksheet->getColumnDimension('BH')->setAutoSize(true);
        $worksheet->SetCellValue('BH4', 'Agama');
        $worksheet->getColumnDimension('BI')->setAutoSize(true);
        $worksheet->SetCellValue('BI4', 'Tingkat Pendidikan');
        $worksheet->getColumnDimension('BJ')->setAutoSize(true);
        $worksheet->SetCellValue('BJ4', 'Pekerjaan');
        $worksheet->getColumnDimension('BK')->setAutoSize(true);
        $worksheet->SetCellValue('BK4', 'Jabatan');
        $worksheet->getColumnDimension('BL')->setAutoSize(true);
        $worksheet->SetCellValue('BL4', 'Instansi');
        $worksheet->getColumnDimension('BM')->setAutoSize(true);
        $worksheet->SetCellValue('BM4', 'Penghasilan');
        $worksheet->getColumnDimension('BN')->setAutoSize(true);
        $worksheet->SetCellValue('BN4', 'Jumlah Tanggungan');
        // End Wali
        
        // Start Pembayaran
        $worksheet->mergeCells('BO3:BR3');
        $worksheet->setCellValue('BO3', 'Data Pembayaran');
        $worksheet->getColumnDimension('BO')->setAutoSize(true);
        $worksheet->SetCellValue('BO4', 'Infaq Pendidikan');
        $worksheet->getColumnDimension('BP')->setAutoSize(true);
        $worksheet->SetCellValue('BP4', 'Iuran Dana Pendidikan (IDP) bulanan');
        $worksheet->getColumnDimension('BQ')->setAutoSize(true);
        $worksheet->SetCellValue('BQ4', 'Wakaf Tanah');
        $worksheet->getColumnDimension('BR')->setAutoSize(true);
        $worksheet->SetCellValue('BR4', 'Keikutsertaan Qurban');
        // End Pembayaran
        
        // Start Mbatik Isi
        $row = 5;
        foreach ($data as $registrant) {
            //$registrant = new RegistrantEntity();
            $rData = $registrant->getRegistrantData();
            // Registrant Data
            $worksheet->SetCellValue('A'.$row, $registrant->getRegId());
            $worksheet->SetCellValue('B'.$row, $registrant->getKode());
            $worksheet->SetCellValue('C'.$row, "'".$registrant->getNisn());
            $worksheet->SetCellValue('D'.$row, $registrant->getName());
            $worksheet->SetCellValue('E'.$row, ($registrant->getGender() == 'L') ? 'Ikhwan' : 'Akhwat');
            $worksheet->SetCellValue('F'.$row, $registrant->getPreviousSchool());
            $worksheet->SetCellValue('G'.$row, $registrant->getProgram());
            if(!empty($rData)){
                $worksheet->SetCellValue('H'.$row, ucfirst($rData->getBirthPlace()).', '.tgl_indo($rData->getBirthDate()->format('Y m d')));
                $worksheet->SetCellValue('I'.$row, $rData->getAddress());
                $worksheet->SetCellValue('J'.$row, $rData->getBloodType());
                $worksheet->SetCellValue('K'.$row, "'".$rData->getNik());
                $worksheet->SetCellValue('L'.$row, "'".$rData->getNkk());
                $worksheet->SetCellValue('M'.$row, "'".$rData->getNak());
                $worksheet->SetCellValue('N'.$row, ucwords($rData->getFamilyCondition()));// SAMPAI SINI
                $str_sibling = "";
                if (!empty($rData->getChildOrder())){
                    $str_sibling = "Anak ke ".$rData->getChildOrder().
                            " dari ".($rData->getSiblingsCount())." bersaudara";
                }
                $worksheet->SetCellValue('O'.$row, ucwords($str_sibling));//edit
                $worksheet->SetCellValue('P'.$row, strtoupper($rData->getNationality()));
                $worksheet->SetCellValue('Q'.$row, ucfirst($rData->getReligion()));
                $worksheet->SetCellValue('R'.$row, $rData->getHeight());
                $worksheet->SetCellValue('S'.$row, $rData->getWeight());
                $worksheet->SetCellValue('T'.$row, $rData->getHospitalSheets(false));
                $worksheet->SetCellValue('U'.$row, $rData->getPhysicalAbnormalities(false));
                $worksheet->SetCellValue('V'.$row, ucwords($rData->getStayWith()));
                $worksheet->SetCellValue('W'.$row, $rData->getHobbies(false));
                $worksheet->SetCellValue('X'.$row, $rData->getAchievements(false));
            }
            
            // Registrant Payment
            $worksheet->SetCellValue('BO'.$row, $registrant->getInitialCost());
            $worksheet->SetCellValue('BP'.$row, $registrant->getSubscriptionCost());
            $worksheet->SetCellValue('BQ'.$row, $registrant->getLandDonation());
            $worksheet->SetCellValue('BR'.$row, $registrant->getQurban());
            
            // Registrant Father
            $fData = $registrant->getFather();
            if(!empty($fData)){
                $worksheet->SetCellValue('Y'.$row, $fData->getName());
                $worksheet->SetCellValue('Z'.$row, $fData->getStatus());
                $worksheet->SetCellValue('AA'.$row, ucfirst($fData->getBirthPlace()).', '.$fData->getBirthDate());
                $worksheet->SetCellValue('AB'.$row, $fData->getAddress());
                $worksheet->SetCellValue('AC'.$row, "'".$fData->getContact());
                $worksheet->SetCellValue('AD'.$row, ucwords($fData->getRelation()));
                $worksheet->SetCellValue('AE'.$row, strtoupper($fData->getNationality()));
                $worksheet->SetCellValue('AF'.$row, ucwords($fData->getReligion()));
                $worksheet->SetCellValue('AG'.$row, $fData->getEducationLevel());
                $worksheet->SetCellValue('AH'.$row, $fData->getJob());
                $worksheet->SetCellValue('AI'.$row, $fData->getPosition());
                $worksheet->SetCellValue('AJ'.$row, $fData->getCompany());
                $worksheet->SetCellValue('AK'.$row, $fData->getIncome());//number_format($fData->getIncome(), 0, ',', '.'));
                $worksheet->SetCellValue('AL'.$row, $fData->getBurdenCount());
            }
            
            // Registrant Mother
            $mData = $registrant->getMother();
            if(!empty($mData)){
                $worksheet->SetCellValue('AM'.$row, $mData->getName());
                $worksheet->SetCellValue('AN'.$row, $mData->getStatus());
                $worksheet->SetCellValue('AO'.$row, ucfirst($mData->getBirthPlace()).', '.$mData->getBirthDate());
                $worksheet->SetCellValue('AP'.$row, $mData->getAddress());
                $worksheet->SetCellValue('AQ'.$row, "'".$mData->getContact());
                $worksheet->SetCellValue('AR'.$row, ucwords($mData->getRelation()));
                $worksheet->SetCellValue('AS'.$row, strtoupper($mData->getNationality()));
                $worksheet->SetCellValue('AT'.$row, ucwords($mData->getReligion()));
                $worksheet->SetCellValue('AU'.$row, $mData->getEducationLevel());
                $worksheet->SetCellValue('AV'.$row, $mData->getJob());
                $worksheet->SetCellValue('AW'.$row, $mData->getPosition());
                $worksheet->SetCellValue('AX'.$row, $mData->getCompany());
                $worksheet->SetCellValue('AY'.$row, $mData->getIncome());//number_format($mData->getIncome(), 0, ',', '.'));
                $worksheet->SetCellValue('AZ'.$row, $mData->getBurdenCount());
            }
            
            // Registrant Guardian
            $gData = $registrant->getGuardian();
            if(!empty($gData)){
                $worksheet->SetCellValue('BA'.$row, $gData->getName());
                $worksheet->SetCellValue('BB'.$row, $gData->getStatus());
                $worksheet->SetCellValue('BC'.$row, ucfirst($gData->getBirthPlace()).', '.$gData->getBirthDate());
                $worksheet->SetCellValue('BD'.$row, $gData->getAddress());
                $worksheet->SetCellValue('BE'.$row, "'".$gData->getContact());
                $worksheet->SetCellValue('BF'.$row, ucwords($gData->getRelation()));
                $worksheet->SetCellValue('BG'.$row, strtoupper($gData->getNationality()));
                $worksheet->SetCellValue('BH'.$row, ucwords($gData->getReligion()));
                $worksheet->SetCellValue('BI'.$row, $gData->getEducationLevel());
                $worksheet->SetCellValue('BJ'.$row, $gData->getJob());
                $worksheet->SetCellValue('BK'.$row, $gData->getPosition());
                $worksheet->SetCellValue('BL'.$row, $gData->getCompany());
                $worksheet->SetCellValue('BM'.$row, $gData->getIncome());//number_format($gData->getIncome(), 0, ',', '.'));
                $worksheet->SetCellValue('BN'.$row, $gData->getBurdenCount());
            }
            
            // Iteration of Rows
            $row++;
        }
        // End Mbatik Isi
    }
    
    public function exportRapor($file_name, $gender, $programme, $test = false){
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        ini_set('max_execution_time', 60);
        ini_set('memory_limit', '256M');
        
        $this->excel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $this->mbatikRapor($this->getDataByJurusan($programme, $gender), 'Data');
        
        $this->excel->removeSheetByIndex(0);
        if($test){
            return TRUE;
        } else {
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$file_name.'.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xls($this->excel);
            $objWriter->save('php://output');
            exit;
        }
    }
    
    private function mbatikRapor($data, $title){
        $worksheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet();
        $worksheet->setTitle($title);
        
        $this->excel->addSheet($worksheet);


        $worksheet->mergeCells('A3:A4');
        $worksheet->setCellValue('A3', 'No.');
        $worksheet->mergeCells('B3:B4');
        $worksheet->setCellValue('B3', 'Kode Unik');
        $worksheet->mergeCells('C3:C4');
        $worksheet->setCellValue('C3', 'Nama');
        $worksheet->mergeCells('D3:D4');
        $worksheet->setCellValue('D3', 'I/A');
        $worksheet->mergeCells('E3:E4');
        $worksheet->setCellValue('E3', 'Sekolah Asal');
        $worksheet->mergeCells('F3:F4');
        $worksheet->setCellValue('F3', 'Jurusan');
        
        $pointer = 6;
        for ($i = 1; $i <= 4; $i++){
            $worksheet->mergeCellsByColumnAndRow($pointer, 3, $pointer+1, 3);
            $worksheet->setCellValueByColumnAndRow($pointer, 3, "B. Indo S".$i);
            $worksheet->setCellValueByColumnAndRow($pointer, 4, "KKM");
            $worksheet->setCellValueByColumnAndRow($pointer+1, 4, "Nilai");
            $pointer=$pointer+2;
            $worksheet->mergeCellsByColumnAndRow($pointer, 3, $pointer+1, 3);
            $worksheet->setCellValueByColumnAndRow($pointer, 3, "B. Inggris S".$i);
            $worksheet->setCellValueByColumnAndRow($pointer, 4, "KKM");
            $worksheet->setCellValueByColumnAndRow($pointer+1, 4, "Nilai");
            $pointer=$pointer+2;
            $worksheet->mergeCellsByColumnAndRow($pointer, 3, $pointer+1, 3);
            $worksheet->setCellValueByColumnAndRow($pointer, 3, "Matematika".$i);
            $worksheet->setCellValueByColumnAndRow($pointer, 4, "KKM");
            $worksheet->setCellValueByColumnAndRow($pointer+1, 4, "Nilai");
            $pointer=$pointer+2;
            $worksheet->mergeCellsByColumnAndRow($pointer, 3, $pointer+1, 3);
            $worksheet->setCellValueByColumnAndRow($pointer, 3, "IPA S".$i);
            $worksheet->setCellValueByColumnAndRow($pointer, 4, "KKM");
            $worksheet->setCellValueByColumnAndRow($pointer+1, 4, "Nilai");
            $pointer=$pointer+2;
            $worksheet->mergeCellsByColumnAndRow($pointer, 3, $pointer+1, 3);
            $worksheet->setCellValueByColumnAndRow($pointer, 3, "IPS S".$i);
            $worksheet->setCellValueByColumnAndRow($pointer, 4, "KKM");
            $worksheet->setCellValueByColumnAndRow($pointer+1, 4, "Nilai");
            $pointer=$pointer+2;
        }
        
        // Start Mbatik Isi
        $nameset = [
            'ind', 
            'ing',
            'mtk', 
            'ipa', 
            'ips', 
        ];
        $row = 5;
        $no = 1;
        foreach ($data as $registrant) {
            $pointer = 6;
            $worksheet->SetCellValue('A'.$row, $no);
            $worksheet->SetCellValue('B'.$row, $registrant->getRegId());
            $worksheet->SetCellValue('C'.$row, $registrant->getName());
            $worksheet->SetCellValue('D'.$row, ($registrant->getGender() == 'L') ? 'Ikhwan' : 'Akhwat');
            $worksheet->SetCellValue('E'.$row, $registrant->getPreviousSchool());
            $worksheet->SetCellValue('F'.$row, $registrant->getProgram());
            $rapor = $registrant->getRapor();
            for($i = 1; $i <= 4;$i++){
                foreach ($nameset as $name){
                    if(is_null($rapor)){
                        $rapor = new RaporEntity();
                    }
                    $worksheet->setCellValueByColumnAndRow($pointer, $row, $rapor->get($name, 'kkm', $i));
                    $worksheet->setCellValueByColumnAndRow($pointer+1, $row, $rapor->get($name, 'nilai', $i));
                    $pointer=$pointer+2;
                }
            }
            $row++;
        }
    }
    
    public function export_Uncomplete($file_name, $test = false, $unpaid = false){
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        ini_set('max_execution_time', 60);
        ini_set('memory_limit', '256M');
        
        $this->excel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $registrant_data = null;
        if ($unpaid){
            $registrant_data = $this->getUnpaidData();
        } else {
            $registrant_data = $this->getIncompleteData();
        }
        $worksheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet();
        $worksheet->setTitle('Data');
        $worksheet->setCellValue('A1', 'Nomor Pendaftaran');
        $worksheet->getColumnDimension('A')->setAutoSize(true);
        $worksheet->setCellValue('B1', 'Nama');
        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->setCellValue('C1', 'I/A');
        $worksheet->getColumnDimension('C')->setAutoSize(true);
        $worksheet->setCellValue('D1', 'Asal Sekolah');
        $worksheet->getColumnDimension('D')->setAutoSize(true);
        $worksheet->setCellValue('E1', 'Contact');
        $worksheet->getColumnDimension('E')->setAutoSize(true);
        $worksheet->setCellValue('F1', 'Status Kekurangan');
        $worksheet->getColumnDimension('F')->setAutoSize(true);
        $row_iterate = 2;
        foreach ($registrant_data as $registrant){
            if(!$registrant['completed']) {
                $row = [];
                $row[] = $registrant['regId'];
                $row[] = strtoupper($registrant['name']);
                $row[] = ($registrant['gender'] == 'L') ? 'Ikhwan' : 'Akhwat';
                $row[] = strtoupper($registrant['previousSchool']);
                $row[] = $registrant['cp'];
                $row[] = $registrant['status'];
                $worksheet->fromArray($row, '', 'A'.$row_iterate);
                $row_iterate++;
            }
        }
        $this->excel->removeSheetByIndex(0);
        $this->excel->addSheet($worksheet);
        
        if ($test){
            return true;
        }  else {
             header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$file_name.'.xls"');
            header('Cache-Control: max-age=0');
            $objWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xls($this->excel);
            $objWriter->save('php://output');
            exit;
        }
    }
    
    public function addCertificate($id, $data, $fileUrl){
        $this->registrant = $this->doctrine->em->find('RegistrantEntity', $id);
        if(is_null($this->registrant)){
            return false;
        } else {
            $cert = new CertificateEntity();
            $cert->setScheme($data['scheme']);
            $cert->setSubject(strtoupper($data['subject']));
            $cert->setOrganizer($data['organizer']);
            if (!is_null($data['rank'])){
                $cert->setRank($data['rank']);
            }
            $startDate = DateTime::createFromFormat('Y-m-d', $data['start_date']);
            $cert->setStartDate($startDate);
            $endDate = DateTime::createFromFormat('Y-m-d', $data['end_date']);
            $cert->setEndDate($endDate);
            $cert->setLevel($data['level']);
            $cert->setPlace($data['place']);
            $cert->setFileType($data['file_type']);
            $dt = new DateTime('now');
            $fileName = substr($data['level'], 0,1).$this->registrant->getId()
                    . strtoupper($data['subject']).'-'.hash('crc32', $dt->format('Y-m-d H:i:s'));
            if ($this->uploadCertificate($fileUrl, $fileName)) {
                $cert->setFileName($fileName);
                $cert->setRegistrant($this->registrant);
                $this->doctrine->em->persist($cert);
                $this->registrant->addCertificates($cert);
                $this->doctrine->em->persist($this->registrant);
                $this->doctrine->em->flush();
                return true;
            } else {
                return false;
            }
        }
    }
    
    public function uploadCertificate($fileUrl, $fileName){
        try {
            $imagine = new Imagine\Gd\Imagine();
            $image = $imagine->open($fileUrl);
            $image->save(FCPATH.'data/sertifikat/'.$fileName.'.png');
            return true;
        } catch (Imagine\Exception\RuntimeException $e){
            return false;
        }
    }
    
    public function deleteCertificate($id){
        $cert = $this->doctrine->em->find('CertificateEntity', $id);
        if(is_null($cert)){
            return false;
        } else {
            $this->doctrine->em->remove($cert);
            $this->doctrine->em->flush();
            return true;
        }
    }
    
    public function getSpecialParticipants(){
        $data = $this->getData();
        
        $res = [];
        foreach ($data as $item) {
            if(!$item->isCertificatesEmpty()){
                $res[] = $item;
            }
        }
        return $res;
    }
    
    public function getCertificate($id){
        return $this->doctrine->em->find('CertificateEntity', $id);
    }
}