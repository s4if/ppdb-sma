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
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getData($sex = NULL, $id = -999){
        if($id == -999){
            $regRepo = $this->doctrine->em->getRepository('RegistrantEntity');
            return $regRepo->getData($sex);
        } else {
            $registrant = $this->doctrine->em->find('RegistrantEntity', $id);
            return $registrant;
        }
    }
    
    public function insertData($data){
        try {
            $this->registrant = new RegistrantEntity();
            $data['reg_time'] = new DateTime('now');
            $data['id'] = $this->genId($data['reg_time']);
            $this->setRegistrantData($data);
            $this->doctrine->em->persist($this->registrant);
            $this->doctrine->em->flush();
            return true;
        } catch (Exception $ex){
            return false;
        }
    }
    
    // Xperimental
    public function getRegistrant() {
        return $this->registrant;
    }
    // ===========
    
    // generate Id berdasarkan counter
    protected function genId(DateTime $date){
        $this->counter = $this->doctrine->em->find('CounterEntity', (int) $date->format('Ymd'));
        if (is_null($this->counter)){
            $this->counter = new CounterEntity();
            $this->counter->setDate($date);
            $this->counter->addCount();
            $this->doctrine->em->persist($this->counter);
            //$this->doctrine->em->flush();
            $strDate = (string)$this->counter->getDate()->format('Ymd');
            $regCount = (string)str_pad($this->counter->getRegistrantCount(), 3, '0', STR_PAD_LEFT);
            return $strDate.$regCount;
        } else {
            $strDate = (string)$this->counter->getDate()->format('Ymd');
            $this->counter->addCount();
            $regCount = (string)str_pad($this->counter->getRegistrantCount(), 3, '0', STR_PAD_LEFT);
            return $strDate.$regCount;
        }
    }
    
    public function updateData($data){
        $this->registrant = $this->doctrine->em->find('registrantEntity', $data['id']);
        if(is_null($this->registrant)){
            return false;
        } else {
            $this->setRegistrantData($data);
            $this->doctrine->em->persist($this->registrant);
            $this->doctrine->em->flush();
            return true;
        }
    }
    
    public function deleteData($data){
        $this->registrant = $this->doctrine->em->find('registrantEntity', $data['id']);
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
    
    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    protected function setRegistrantData($data){
        if (!empty($data['id'])) : $this->registrant->setId($data['id']); endif;
        if (!empty($data['password'])) : $this->registrant->setPassword(password_hash($data['password'], PASSWORD_BCRYPT)); endif;
        if (!empty($data['name'])) : $this->registrant->setName($data['name']); endif;
        if (!empty($data['sex'])) : $this->registrant->setSex($data['sex']); endif;
        if (!empty($data['prev_school'])) : $this->registrant->setPreviousSchool($data['prev_school']); endif;
        if (!empty($data['nisn'])) : $this->registrant->setNisn($data['nisn']); endif;
        if (!empty($data['program'])) : $this->registrant->setProgram($data['program']); endif;
        if (!empty($data['reg_time'])) : $this->registrant->setRegistrationTime($data['reg_time']); endif;
    }
    
    
    //==========================================================================
    
    public function updateDetail($id, $data){
        $this->registrant = $this->doctrine->em->find('registrantEntity', $id);
        if(is_null($this->registrant)){
                return false;
            } else {
                if(is_null($this->registrant->getRegistrantData())){
                    $this->registrantData = new RegistrantDataEntity(); 
                } else {
                    $this->registrantData = $this->registrant->getRegistrantData();
                }
                $this->setRegistrantDetail($data);
                $this->doctrine->em->persist($this->registrantData);
                $this->doctrine->em->flush();
                $this->registrant->setRegistrantData($this->registrantData);
                $this->doctrine->em->persist($this->registrant);
                $this->doctrine->em->flush();
                return true;
        }
    }
    
    public function deleteDetail($id){
        $this->registrant = $this->doctrine->em->find('registrantEntity', $id);
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
    
    //TODO: Buat hobby, achievement dll...
    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    //id, registrant, birthplace, birthdate, address, familyCondition, nationality, religion, height, weight, stayWith
    protected function setRegistrantDetail($data){
        //$this->registrantData = new RegistrantDataEntity();
        if (!empty($data['id'])) : $this->registrantData->setId($data['id']); endif;
        if (!empty($data['registrant'])) : $this->registrantData->setRegistrant($data['registrant']); endif; //bentuk objek jadi
        if (!empty($data['birth_place'])) : $this->registrantData->setBirthPlace($data['birth_place']); endif;
        if (!empty($data['birth_date'])) : $this->registrantData->setBirthDate($data['birth_date']); endif;
        if (!empty($data['address'])) : $this->registrantData->setAddress($data['address']); endif;
        if (!empty($data['family_condition'])) : $this->registrantData->setFamilyCondition($data['family_condition']); endif;
        if (!empty($data['nationality'])) : $this->registrantData->setNationality($data['nationality']); endif;
        if (!empty($data['religion'])) : $this->registrantData->setReligion($data['religion']); endif;
        if (!empty($data['height'])) : $this->registrantData->setHeight($data['height']); endif;
        if (!empty($data['weight'])) : $this->registrantData->setWeight($data['weight']); endif;
        if (!empty($data['stay_with'])) : $this->registrantData->setStayWith($data['stay_with']); endif;
    }
}