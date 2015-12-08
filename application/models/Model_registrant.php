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
class Model_registrant extends CI_Model {
    
    protected $registrant;
    protected $registrantData;
    protected $counter;
    protected $paymentData;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getData($sex = NULL, $id = null, $onlyShowCompleted = false){
        if(is_null($id)){
            $regRepo = $this->doctrine->em->getRepository('RegistrantEntity');
            return $regRepo->getData($sex, $onlyShowCompleted);
        } else {
            $registrant = $this->doctrine->em->find('RegistrantEntity', $id);
            $this->registrant = $registrant;
            return $registrant;
        }
    }
    
    public function getArrayData($sex = NULL, $vars = []){
        $data = $this->getData($sex);
        if (empty($vars)){
            $vars = ['id', 'name','sex','previousSchool','nisn','program', 'finalized'];
        }
        $arrData = [];
        foreach ($data as $registrant){
            $arrData [$registrant->getId()] = $registrant->getArray($vars);
            //if($status){
                $arrData [$registrant->getId()] ['status'] = $this->stringStatus($registrant);
            //}
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
    
    // TODO: In Production always enable try and catch
    public function insertData($data){
        try {
            $this->registrant = new RegistrantEntity();
            $data['reg_time'] = new DateTime('now');
            $data['id'] = $this->genId($data['reg_time'], $data['sex']);
            $this->setRegistrantData($data);
            $this->registrant->setDeleted(false);
            $this->doctrine->em->persist($this->registrant);
            $this->doctrine->em->flush();
            return true;
        } catch (Doctrine\DBAL\Exception\NotNullConstraintViolationException $ex){
            return false;
        }
    }
    
    // Xperimental
    public function getRegistrant() {
        return $this->registrant;
    }
    // ===========
    
    // generate Id berdasarkan counter
    protected function genId(DateTime $date, $sex){
        $this->counter = $this->doctrine->em->find('CounterEntity', (int) $date->format('Ymd'));
        $regCount = $this->doctrine->em->getRepository('RegistrantEntity')->getCount();
        $strCount = (string)str_pad(($regCount+1), 3, '0', STR_PAD_LEFT);
        $strSex = ($sex == 'L')?'I':'A';
        $strDate = (string)$date->format('ym');
        if (is_null($this->counter)){
            $this->counter = new CounterEntity();
            $this->counter->setDate($date);
            $this->counter->addCount();
            $this->doctrine->em->persist($this->counter);
            return $strSex.$strDate.$strCount;
        } else {
            $this->counter->addCount();
            return $strSex.$strDate.$strCount;
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
    
    public function purgeData($data){
        $this->registrant = $this->doctrine->em->find( 'RegistrantEntity', $data['id']);
        if(is_null($this->registrant)){
            return false;
        } else {
            $date = $this->registrant->getRegistrationTime();
            $this->counter = $this->doctrine->em->find('CounterEntity', (int) $date->format('Ymd'));
            $this->counter->removeCount();
            $this->doctrine->em->persist($this->counter);
            $this->doctrine->em->remove($this->registrant);
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
        if (!empty($data['id'])) : $this->registrant->setId($data['id']); endif;
        if (!empty($data['password'])) : $this->registrant->setPassword(password_hash($data['password'], PASSWORD_BCRYPT)); endif;
        if (!empty($data['name'])) : $this->registrant->setName($data['name']); endif;
        if (!empty($data['sex'])) : $this->registrant->setSex($data['sex']); endif;
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
    
    protected function setRegistrantExtraData($data){
        if (!empty($data['achievements'])) : $this->setAchievement($data['achievements']); endif;
        if (!empty($data['hobbies'])) : $this->setHobby($data['hobbies']); endif;
        if (!empty($data['hospital_sheets'])) : $this->setHospitalSheet($data['hospital_sheets']); endif;
        if (!empty($data['physical_abnormalities'])) : $this->setPhysicalAbnormality($data['physical_abnormalities']); endif;
    }
    
    // TODO: Apakah perlu untuk dibuat cara menghapusnya?
    protected function setAchievement($achievements){
        $arr_ach = $this->registrantData->getAchievements();
        foreach ($arr_ach as $achievement){
            $this->registrantData->removeAchievement($achievement);
            $this->doctrine->em->remove($achievement);
        }
        foreach ($achievements as $achievement){
            $obj = new AchievementEntity();
            $obj->setAchievement($achievement);
            $obj->setRegistrant($this->registrantData);
            $this->doctrine->em->persist($obj);
            $this->registrantData->addAchievement($obj);
        }
    }
    
    protected function setHobby($hobbies){
        $arr_hobbies = $this->registrantData->getHobbies();
        foreach ($arr_hobbies as $hobby) {
            $this->registrantData->removeHobby($hobby);
            $this->doctrine->em->remove($hobby);
        }
        foreach ($hobbies as $hobby){
            $obj = new HobbyEntity();
            $obj->setHobby($hobby);
            $obj->setRegistrant($this->registrantData);
            $this->doctrine->em->persist($obj);
            $this->registrantData->addHobby($obj);
        }
    }
    
    protected function setHospitalSheet($hospitalSheets){
        $arr_hs = $this->registrantData->getHospitalSheets();
        foreach($arr_hs as $hs){
            $this->registrantData->removeHospitalSheet($hs);
            $this->doctrine->em->remove($hs);
        }
        foreach ($hospitalSheets as $hospitalSheet){
            $obj = new HospitalSheetEntity();
            $obj->setHospitalSheet($hospitalSheet);
            $obj->setRegistrant($this->registrantData);
            $this->doctrine->em->persist($obj);
            $this->registrantData->addHospitalSheet($obj);
        }
    }
    
    protected function setPhysicalAbnormality($physicalAbnormalities){
        $arr_pa = $this->registrantData->getPhysicalAbnormalities();
        foreach ($arr_pa as $pa) {
            $this->registrantData->removePhysicalAbnormality($pa);
            $this->doctrine->em->remove($pa);
        }
        foreach ($physicalAbnormalities as $physicalAbnormality){
            $obj = new PhysicalAbnormalityEntity();
            $obj->setPhysicalAbnormality($physicalAbnormality);
            $obj->setRegistrant($this->registrantData);
            $this->doctrine->em->persist($obj);
            $this->registrantData->addPhysicalAbnormality($obj);
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
            $box = new Imagine\Image\Box(600, 800);
            $image->resize($box);
            $image->save(FCPATH.'data/receipt/'.$id.'.png');
            $this->receipt_data($id, $data);
            return true;
        } catch (Imagine\Exception\RuntimeException $e){
            return false;
        }
    }
    
    protected function receipt_data($id, $data){
        $this->registrant = $this->doctrine->em->find('RegistrantEntity', $id);
        $this->paymentData = new PaymentEntity();
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
            $all_stats++;
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
        $arr_result['completed'] = ($all_stats >=5)?true:false;
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
            if($status['foto'] < 1): $str = $str.'foto, '; endif;
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
}