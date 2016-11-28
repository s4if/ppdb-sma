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
use PHPExcel\IOFactory;

class Model_registrant extends CI_Model {
    
    protected $registrant;
    protected $registrantData;
    protected $counter;
    protected $paymentData;
    protected $excel;
    
    public function __construct() {
        parent::__construct();
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
    
    public function getDataByUsername($username) {
        return $this->doctrine->em->getRepository('RegistrantEntity')->getDataByUsername($username);
    }
    
    public function getArrayData($gender = NULL, $vars = [], $completed = false){
        $data = $this->getData($gender, null, $completed);
        if (empty($vars)){
            $vars = ['id','regId', 'username', 'name','gender','previousSchool','nisn', 'cp', 'program', 'finalized'];
        }
        $arrData = [];
        foreach ($data as $registrant){
            $arrData [$registrant->getId()] = $registrant->getArray($vars);
            $arrData [$registrant->getId()] ['status'] = $this->stringStatus($registrant);
            $arrData [$registrant->getId()] ['completed'] = ($arrData [$registrant->getId()] ['status'] == 'Pendaftaran telah selesai');
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
    
    public function getDataByFilter($filter = []){
        $regRepo = $this->doctrine->em->getRepository('RegistrantEntity');
        return $regRepo->getDataByFilter($filter);
    }
    
    // TODO: In Production always enable try and catch
    public function insertData($data){
        try {
            //$this->duplicateCheck($data);
            $this->registrant = new RegistrantEntity();
            $data['reg_time'] = new DateTime('now');
            //$data['id'] = $this->genId($data['reg_time'], $data['gender']);
            $this->setRegistrantData($data);
            $this->registrant->setDeleted(false);
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
    public function getRegistrant() {
        return $this->registrant;
    }
    // ===========
    
    // generate Id berdasarkan counter
    public function genKode($id, $gender){
        $counter = $this->doctrine->em->find('CounterEntity', 1);
        $registrant = $this->doctrine->em->find('RegistrantEntity', $id);
        $kode = "";
        if (is_null($registrant->getKode()) && $gender == $registrant->getGender()){
            if($gender == 'P'){
                $counter->addFemaleCount();
                $kode = sprintf("%03d", 500 + $counter->getFemaleCount());
                $registrant->setKode($kode);
            } else {
                $counter->addMaleCount();
                $kode = sprintf("%03d", $counter->getMaleCount());
                $registrant->setKode($kode);
            }
            $this->doctrine->em->persist($counter);
            $this->doctrine->em->persist($registrant);
            $this->doctrine->em->flush();
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
        if (!empty($data['name'])) : $this->registrant->setName($data['name']); endif;
        if (!empty($data['gender'])) : $this->registrant->setGender($data['gender']); endif;
        if (!empty($data['prev_school'])) : $this->registrant->setPreviousSchool($data['prev_school']); endif;
        if (!empty($data['nisn'])) : $this->registrant->setNisn($data['nisn']); endif;
        if (!empty($data['cp'])) : $this->registrant->setCp($data['cp']); endif;
        if (!empty($data['program'])) : $this->registrant->setProgram($data['program']); endif;
        if (!empty($data['reg_time'])) : $this->registrant->setRegistrationTime($data['reg_time']); endif;
        if (!empty($data['initial_cost'])) : $this->registrant->setInitialCost($data['initial_cost']); endif;
        if (!empty($data['finalized'])) : $this->registrant->setFinalized($data['finalized']); endif;
        if (!empty($data['subscription_cost'])) : $this->registrant->setSubscriptionCost($data['subscription_cost']); endif;
        if (!empty($data['main_parent'])) : $this->registrant->setMainParent($data['main_parent']); endif;
        if (!empty($data['deleted'])) : $this->registrant->setDeleted($data['deleted']); endif;
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
        if (!empty($data['birth_place'])) : $this->registrantData->setBirthPlace($data['birth_place']); endif;
        if (!empty($data['birth_date'])) : $this->registrantData->setBirthDate(new DateTime($data['birth_date'])); endif;
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
            'birth_place', 'birth_date', 'street', 'RT', 'RW', 'village', 'district', 
            'city', 'province', 'postal_code', 'family_condition', 'nationality', 'religion', 
            'height', 'weight', 'stay_with'
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
    
    protected function receipt_data($id, $data){
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
        $id = $registrant->getId();
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
        $this->load->helper('file');
        $file = read_file('./data/foto/'.$id.'.png');
        if(!$file){
            $arr_result ['foto'] = 0;
        } else {
            $arr_result ['foto'] = 1;
            //$all_stats++;
        }
        if(is_null($registrant->getMainParent())){
            $arr_result ['letter'] = 0;
        } else {
            $arr_result ['letter'] = 1;
            $all_stats++;
        }
        $file2 = read_file('./data/receipt/'.$id.'.png');
        if($file2){
            $arr_result ['payment'] = $this->cek_receipt($registrant);
        } else {
            $arr_result ['payment'] = 0;
        }
        $arr_result['completed'] = ($all_stats >=4)?true:false;
        return $arr_result;
    }
    
    public function stringStatus(RegistrantEntity $registrant){
        $status  = $this->cek_status($registrant);
        if($registrant->getFinalized()){
            return 'Pendaftaran telah selesai';
        } elseif($status['completed']) {
            return 'Data telah lengkap, kurang finalisasi';
        } else {
            $str = 'Data yang kurang : '; // String Status
            if($status['data'] < 1): $str = $str.'data diri, '; endif;
            //if($status['foto'] < 1): $str = $str.'foto, '; endif;
            if($status['father'] < 1): $str = $str.'data ayah, '; endif;
            if($status['mother'] < 1): $str = $str.'data ibu, '; endif;
            if($status['letter'] < 1): $str = $str.'surat pernyataan, '; endif;
            return $str;
        }
    }
    
    protected function cek_receipt($registrant){
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
    
    public function export($file_name, $gender, $programme = false){
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        ini_set('max_execution_time', 60);
        ini_set('memory_limit', '256M');
        
        $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
        $cacheSettings = array( 'memoryCacheSize ' => '256MB');
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

        
        $this->excel = new PHPExcel();
        $this->mbatik($this->njikukData($gender, $programme), 'Data');
        
        $this->excel->removeSheetByIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$file_name.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = new PHPExcel_Writer_Excel5($this->excel);
        $objWriter->save('php://output');
        exit;
    }
    
    private function njikukData($gender, $tahfidz){
        $regRepo = $this->doctrine->em->getRepository('RegistrantEntity');
        return $regRepo->getDataByJurusan($gender, $tahfidz); //tahfidz = boolean
    }
    
    private function mbatik($data, $title){
        $worksheet = new PHPExcel_Worksheet();
        $worksheet->setTitle($title);
        
        // Siswa Start
        $worksheet->mergeCells('A3:R3');
        $worksheet->setCellValue('A3', 'Data Siswa');
        $worksheet->getColumnDimension('A')->setAutoSize(true);
        $worksheet->SetCellValue('A4', 'No. Pendaftaran');
        $worksheet->getColumnDimension('B')->setAutoSize(true);
        $worksheet->SetCellValue('B4', 'NISN');
        $worksheet->getColumnDimension('C')->setAutoSize(true);
        $worksheet->SetCellValue('C4', 'Nama');
        $worksheet->getColumnDimension('D')->setAutoSize(true);
        $worksheet->SetCellValue('D4', 'Ikhwan/Akhwat');
        $worksheet->getColumnDimension('E')->setAutoSize(true);
        $worksheet->SetCellValue('E4', 'Sekolah Asal');
        $worksheet->getColumnDimension('F')->setAutoSize(true);
        $worksheet->SetCellValue('F4', 'Program');
        $worksheet->getColumnDimension('G')->setAutoSize(true);
        $worksheet->SetCellValue('G4', 'TTL');
        $worksheet->getColumnDimension('H')->setAutoSize(true);
        $worksheet->SetCellValue('H4', 'Alamat');
        $worksheet->getColumnDimension('I')->setAutoSize(true);
        $worksheet->SetCellValue('I4', 'Keluarga');
        $worksheet->getColumnDimension('J')->setAutoSize(true);
        $worksheet->SetCellValue('J4', 'Kewarganegaraan');
        $worksheet->getColumnDimension('K')->setAutoSize(true);
        $worksheet->SetCellValue('K4', 'Agama');
        $worksheet->getColumnDimension('L')->setAutoSize(true);
        $worksheet->SetCellValue('L4', 'Tinggi');
        $worksheet->getColumnDimension('M')->setAutoSize(true);
        $worksheet->SetCellValue('M4', 'Berat');
        $worksheet->getColumnDimension('N')->setAutoSize(true);
        $worksheet->SetCellValue('N4', 'Riwayat Penyakit');
        $worksheet->getColumnDimension('O')->setAutoSize(true);
        $worksheet->SetCellValue('O4', 'Kelainan Jasmani');
        $worksheet->getColumnDimension('P')->setAutoSize(true);
        $worksheet->SetCellValue('P4', 'Tinggal Bersama');
        $worksheet->getColumnDimension('Q')->setAutoSize(true);
        $worksheet->SetCellValue('Q4', 'Hobi');
        $worksheet->getColumnDimension('R')->setAutoSize(true);
        $worksheet->SetCellValue('R4', 'Prestasi');
        // End Siswa
        
        // Start Ayah
        $worksheet->mergeCells('S3:AF3');
        $worksheet->setCellValue('S3', 'Data Ayah');
        $worksheet->getColumnDimension('S')->setAutoSize(true);
        $worksheet->SetCellValue('S4', 'Nama');
        $worksheet->getColumnDimension('T')->setAutoSize(true);
        $worksheet->SetCellValue('T4', 'Status');
        $worksheet->getColumnDimension('U')->setAutoSize(true);
        $worksheet->SetCellValue('U4', 'TTL');
        $worksheet->getColumnDimension('V')->setAutoSize(true);
        $worksheet->SetCellValue('V4', 'Alamat');
        $worksheet->getColumnDimension('W')->setAutoSize(true);
        $worksheet->SetCellValue('W4', 'No. Telp');
        $worksheet->getColumnDimension('X')->setAutoSize(true);
        $worksheet->SetCellValue('X4', 'Hubungan dengan pendaftar');
        $worksheet->getColumnDimension('Y')->setAutoSize(true);
        $worksheet->SetCellValue('Y4', 'Kewarganegaraan');
        $worksheet->getColumnDimension('Z')->setAutoSize(true);
        $worksheet->SetCellValue('Z4', 'Agama');
        $worksheet->getColumnDimension('AA')->setAutoSize(true);
        $worksheet->SetCellValue('AA4', 'Tingkat Pendidikan');
        $worksheet->getColumnDimension('AB')->setAutoSize(true);
        $worksheet->SetCellValue('AB4', 'Pekerjaan');
        $worksheet->getColumnDimension('AC')->setAutoSize(true);
        $worksheet->SetCellValue('AC4', 'Jabatan');
        $worksheet->getColumnDimension('AD')->setAutoSize(true);
        $worksheet->SetCellValue('AD4', 'Instansi');
        $worksheet->getColumnDimension('AE')->setAutoSize(true);
        $worksheet->SetCellValue('AE4', 'Penghasilan');
        $worksheet->getColumnDimension('AF')->setAutoSize(true);
        $worksheet->SetCellValue('AF4', 'Jumlah Tanggungan');
        // End Ayah
        
        // Start Ibu
        $worksheet->mergeCells('AG3:AT3');
        $worksheet->setCellValue('AG3', 'Data Ibu');
        $worksheet->getColumnDimension('AG')->setAutoSize(true);
        $worksheet->SetCellValue('AG4', 'Nama');
        $worksheet->getColumnDimension('AH')->setAutoSize(true);
        $worksheet->SetCellValue('AH4', 'Status');
        $worksheet->getColumnDimension('AI')->setAutoSize(true);
        $worksheet->SetCellValue('AI4', 'TTL');
        $worksheet->getColumnDimension('AJ')->setAutoSize(true);
        $worksheet->SetCellValue('AJ4', 'Alamat');
        $worksheet->getColumnDimension('AK')->setAutoSize(true);
        $worksheet->SetCellValue('AK4', 'No. Telp');
        $worksheet->getColumnDimension('AL')->setAutoSize(true);
        $worksheet->SetCellValue('AL4', 'Hubungan dengan pendaftar');
        $worksheet->getColumnDimension('AM')->setAutoSize(true);
        $worksheet->SetCellValue('AM4', 'Kewarganegaraan');
        $worksheet->getColumnDimension('AN')->setAutoSize(true);
        $worksheet->SetCellValue('AN4', 'Agama');
        $worksheet->getColumnDimension('AO')->setAutoSize(true);
        $worksheet->SetCellValue('AO4', 'Tingkat Pendidikan');
        $worksheet->getColumnDimension('AP')->setAutoSize(true);
        $worksheet->SetCellValue('AP4', 'Pekerjaan');
        $worksheet->getColumnDimension('AQ')->setAutoSize(true);
        $worksheet->SetCellValue('AQ4', 'Jabatan');
        $worksheet->getColumnDimension('AR')->setAutoSize(true);
        $worksheet->SetCellValue('AR4', 'Instansi');
        $worksheet->getColumnDimension('AS')->setAutoSize(true);
        $worksheet->SetCellValue('AS4', 'Penghasilan');
        $worksheet->getColumnDimension('AT')->setAutoSize(true);
        $worksheet->SetCellValue('AT4', 'Jumlah Tanggungan');
        // End Ibu
        
        // Start Wali
        $worksheet->mergeCells('AU3:BH3');
        $worksheet->setCellValue('AU3', 'Data Wali');
        $worksheet->getColumnDimension('AU')->setAutoSize(true);
        $worksheet->SetCellValue('AU4', 'Nama');
        $worksheet->getColumnDimension('AV')->setAutoSize(true);
        $worksheet->SetCellValue('AV4', 'Status');
        $worksheet->getColumnDimension('AW')->setAutoSize(true);
        $worksheet->SetCellValue('AW4', 'TTL');
        $worksheet->getColumnDimension('AX')->setAutoSize(true);
        $worksheet->SetCellValue('AX4', 'Alamat');
        $worksheet->getColumnDimension('AY')->setAutoSize(true);
        $worksheet->SetCellValue('AY4', 'No. Telp');
        $worksheet->getColumnDimension('AZ')->setAutoSize(true);
        $worksheet->SetCellValue('AZ4', 'Hubungan dengan pendaftar');
        $worksheet->getColumnDimension('BA')->setAutoSize(true);
        $worksheet->SetCellValue('BA4', 'Kewarganegaraan');
        $worksheet->getColumnDimension('BB')->setAutoSize(true);
        $worksheet->SetCellValue('BB4', 'Agama');
        $worksheet->getColumnDimension('BC')->setAutoSize(true);
        $worksheet->SetCellValue('BC4', 'Tingkat Pendidikan');
        $worksheet->getColumnDimension('BD')->setAutoSize(true);
        $worksheet->SetCellValue('BD4', 'Pekerjaan');
        $worksheet->getColumnDimension('BE')->setAutoSize(true);
        $worksheet->SetCellValue('BE4', 'Jabatan');
        $worksheet->getColumnDimension('BF')->setAutoSize(true);
        $worksheet->SetCellValue('BF4', 'Instansi');
        $worksheet->getColumnDimension('BG')->setAutoSize(true);
        $worksheet->SetCellValue('BG4', 'Penghasilan');
        $worksheet->getColumnDimension('BH')->setAutoSize(true);
        $worksheet->SetCellValue('BH4', 'Jumlah Tanggungan');
        // End Wali
        
        // Start Pembayaran
        $worksheet->mergeCells('BI3:BJ3');
        $worksheet->setCellValue('BI3', 'Data Pembayaran');
        $worksheet->getColumnDimension('BI')->setAutoSize(true);
        $worksheet->SetCellValue('BI4', 'Infaq Pendidikan');
        $worksheet->getColumnDimension('BJ')->setAutoSize(true);
        $worksheet->SetCellValue('BJ4', 'SPP');
        // End Pembayaran
        
        // Start Mbatik Isi
        $row = 5;
        foreach ($data as $registrant) {
            //$registrant = new RegistrantEntity();
            $rData = $registrant->getRegistrantData();
            // Registrant Data
            $worksheet->SetCellValue('A'.$row, $registrant->getId());
            $worksheet->SetCellValue('B'.$row, $registrant->getNisn());
            $worksheet->SetCellValue('C'.$row, $registrant->getName());
            $worksheet->SetCellValue('D'.$row, ($registrant->getGender() == 'L') ? 'Ikhwan' : 'Akhwat');
            $worksheet->SetCellValue('E'.$row, $registrant->getPreviousSchool());
            $worksheet->SetCellValue('F'.$row, $registrant->getProgram());
            if(!empty($rData)){
                $worksheet->SetCellValue('G'.$row, ucfirst($rData->getBirthPlace()).', '.tgl_indo($rData->getBirthDate()->format('Y m d')));
                $worksheet->SetCellValue('H'.$row, $rData->getAddress());
                $worksheet->SetCellValue('I'.$row, ucwords($rData->getFamilyCondition()));
                $worksheet->SetCellValue('J'.$row, strtoupper($rData->getNationality()));
                $worksheet->SetCellValue('K'.$row, ucfirst($rData->getReligion()));
                $worksheet->SetCellValue('L'.$row, $rData->getHeight());
                $worksheet->SetCellValue('M'.$row, $rData->getWeight());
                $str_hp = '';   
                foreach ($rData->getHospitalSheets() as $hp) {
                    $str_hp = $str_hp.$hp->getHospitalSheet().', ';
                }
                $worksheet->SetCellValue('N'.$row, $str_hp);
                $str_pa = '';
                foreach ($rData->getPhysicalAbnormalities() as $pa) {
                    $str_pa = $str_pa.$pa->getPhysicalAbnormality().', ';
                }
                $worksheet->SetCellValue('O'.$row, $str_pa);
                $worksheet->SetCellValue('P'.$row, ucwords($rData->getStayWith()));
                $str_hb = '';
                foreach ($rData->getHobbies() as $hb) {
                    $str_hb = $str_hb.$hb->getHobby().', ';
                }
                $worksheet->SetCellValue('Q'.$row, $str_hb);
                $str_ac = '';
                foreach ($rData->getAchievements() as $ac) {
                    $str_ac = $str_ac.$ac->getAchievement().', ';
                }
                $worksheet->SetCellValue('R'.$row, $str_ac);
            }
            
            // Registrant Payment
            $worksheet->SetCellValue('BI'.$row, $registrant->getInitialCost());
            $worksheet->SetCellValue('BJ'.$row, $registrant->getSubscriptionCost());
            
            // Registrant Father
            $fData = $registrant->getFather();
            if(!empty($fData)){
                $worksheet->SetCellValue('S'.$row, $fData->getName());
                $worksheet->SetCellValue('T'.$row, $fData->getStatus());
                $worksheet->SetCellValue('U'.$row, ucfirst($fData->getBirthPlace()).', '.tgl_indo($fData->getBirthDate()->format('Y m d')));
                $worksheet->SetCellValue('V'.$row, $fData->getAddress());
                $worksheet->SetCellValue('W'.$row, $fData->getContact());
                $worksheet->SetCellValue('X'.$row, ucwords($fData->getRelation()));
                $worksheet->SetCellValue('Y'.$row, strtoupper($fData->getNationality()));
                $worksheet->SetCellValue('Z'.$row, ucwords($fData->getReligion()));
                $worksheet->SetCellValue('AA'.$row, $fData->getEducationLevel());
                $worksheet->SetCellValue('AB'.$row, $fData->getJob());
                $worksheet->SetCellValue('AC'.$row, $fData->getPosition());
                $worksheet->SetCellValue('AD'.$row, $fData->getCompany());
                $worksheet->SetCellValue('AE'.$row, number_format($fData->getIncome(), 0, ',', '.'));
                $worksheet->SetCellValue('AF'.$row, $fData->getBurdenCount());
            }
            
            // Registrant Mother
            $mData = $registrant->getMother();
            if(!empty($mData)){
                $worksheet->SetCellValue('AG'.$row, $mData->getName());
                $worksheet->SetCellValue('AH'.$row, $mData->getStatus());
                $worksheet->SetCellValue('AI'.$row, ucfirst($mData->getBirthPlace()).', '.tgl_indo($mData->getBirthDate()->format('Y m d')));
                $worksheet->SetCellValue('AJ'.$row, $mData->getAddress());
                $worksheet->SetCellValue('AK'.$row, $mData->getContact());
                $worksheet->SetCellValue('AL'.$row, ucwords($mData->getRelation()));
                $worksheet->SetCellValue('AM'.$row, strtoupper($mData->getNationality()));
                $worksheet->SetCellValue('AN'.$row, ucwords($mData->getReligion()));
                $worksheet->SetCellValue('AO'.$row, $mData->getEducationLevel());
                $worksheet->SetCellValue('AP'.$row, $mData->getJob());
                $worksheet->SetCellValue('AQ'.$row, $mData->getPosition());
                $worksheet->SetCellValue('AR'.$row, $mData->getCompany());
                $worksheet->SetCellValue('AS'.$row, number_format($mData->getIncome(), 0, ',', '.'));
                $worksheet->SetCellValue('AT'.$row, $mData->getBurdenCount());
            }
            
            // Registrant Mother
            $gData = $registrant->getGuardian();
            if(!empty($gData)){
                $worksheet->SetCellValue('AU'.$row, $gData->getName());
                $worksheet->SetCellValue('AV'.$row, $gData->getStatus());
                $worksheet->SetCellValue('AW'.$row, ucfirst($gData->getBirthPlace()).', '.tgl_indo($gData->getBirthDate()->format('Y m d')));
                $worksheet->SetCellValue('AX'.$row, $gData->getAddress());
                $worksheet->SetCellValue('AY'.$row, $gData->getContact());
                $worksheet->SetCellValue('AZ'.$row, ucwords($gData->getRelation()));
                $worksheet->SetCellValue('BA'.$row, strtoupper($gData->getNationality()));
                $worksheet->SetCellValue('BB'.$row, ucwords($gData->getReligion()));
                $worksheet->SetCellValue('BC'.$row, $gData->getEducationLevel());
                $worksheet->SetCellValue('BD'.$row, $gData->getJob());
                $worksheet->SetCellValue('BE'.$row, $gData->getPosition());
                $worksheet->SetCellValue('BF'.$row, $gData->getCompany());
                $worksheet->SetCellValue('BG'.$row, number_format($gData->getIncome(), 0, ',', '.'));
                $worksheet->SetCellValue('BH'.$row, $gData->getBurdenCount());
            }
            
            // Iteration of Rows
            $row++;
        }
        // End Mbatik Isi
        
        $this->excel->addSheet($worksheet);
    }
    
    public function export_Uncomplete($file_name){
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        ini_set('max_execution_time', 60);
        ini_set('memory_limit', '256M');
        
        $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
        $cacheSettings = array( 'memoryCacheSize ' => '256MB');
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

        
        $this->excel = new PHPExcel();
        $registrant_data = $this->getArrayData();
        $worksheet = new PHPExcel_Worksheet();
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
                $row[] = $registrant['id'];
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
        
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$file_name.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = new PHPExcel_Writer_Excel5($this->excel);
        $objWriter->save('php://output');
        exit;
    }
}