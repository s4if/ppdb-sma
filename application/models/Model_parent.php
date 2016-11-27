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
 * Description of Model_parent
 *
 * @author s4if
 */
class Model_parent extends CI_Model{
    
    protected $registrant;
    protected $father;
    protected $mother;
    protected $guardian; // wali
    
    public function __construct() {
        parent::__construct();
    }
    
    // $position = ['father', 'mother', 'guardian]
    public function getData($id, $position = ['father']){
        $this->registrant = $this->doctrine->em->find('RegistrantEntity', $id);
        $arr_return = [];
        foreach ($position as $pos){
            $funct = 'get'.ucfirst(strtolower($pos));
            $arr_return [$pos] = $this->registrant->$funct();
        }
        return $arr_return;
    }
    
    // Buat Data Jika Tidak ada
    public function create(){
        return new ParentEntity();
    }
    
    // TODO: In Production always enable try and catch
    public function updateData($id, $data, $position){
        try{
            $this->registrant = $this->doctrine->em->find('RegistrantEntity', $id);
            if(is_null($this->registrant)){
                return false;
            } else {
                return $this->doUpdateData($data, $position);
            }
        } catch (Doctrine\DBAL\Exception\ConstraintViolationException $e){
            return false;
        }
    }
    
    
    private function doUpdateData($data, $pos){
        // pilih variable
        $var = strtolower($pos);
        $gfunct = 'get'.ucfirst(strtolower($pos));
        $sfunct = 'set'.ucfirst(strtolower($pos));
        $this->$var = $this->registrant->$gfunct();
        if(empty($this->$var)){
            $this->$var = new ParentEntity();
        }
        $this->setData($data, $var);
        $this->doctrine->em->persist($this->$var);
        $this->registrant->$sfunct($this->$var);
        $this->doctrine->em->persist($this->registrant);
        $this->doctrine->em->flush();
        return true;
    }
    
    public function deleteData($id, $pos){
        $this->registrant = $this->doctrine->em->find('RegistrantEntity', $id);
        if(is_null($this->registrant)){
            return false;
        } else {
//             try kalau di production harus diaktifkan
            try{
                return $this->doDelete($pos);
            } catch (Doctrine\DBAL\Exception\DriverException $ex) {
                return false;
            }
        }
    }
    
    private function doDelete($pos){
        $res = false;
        $gfunct = 'get'.ucfirst(strtolower($pos));
        $sfunct = 'set'.ucfirst(strtolower($pos));
        $var = strtolower($pos);
        $this->$var = $this->registrant->$gfunct();
        if(is_null($this->$var)){
            $res =  true;
        } else {
            $this->registrant->$sfunct(null);
            $this->doctrine->em->persist($this->registrant);
            $this->doctrine->em->remove($this->$var);
            $this->doctrine->em->flush();
            $res = true;
        }
        return $res;
    }
    
    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    // ['id', 'type', 'name', 'status', 'birthPlace', 'birthDate', 'address', 'contact', 'relation',
    // 'nationality', 'religion', 'educationLevel', 'speciality', 'job', 'position', 'company',
    // 'companyAddress', 'income', 'burdenCount']
    protected function setData($data, $var){
        if (!is_null($var)) : $this->$var->setType($var); endif;
        if (!is_null($data['name'])) : $this->$var->setName($data['name']); endif;
        if (!is_null($data['status'])) : $this->$var->setStatus($data['status']); endif;
        if (!is_null($data['birth_place'])) : $this->$var->setBirthPlace($data['birth_place']); endif;
        if (!is_null($data['birth_date'])) : $this->$var->setBirthDate(new DateTime($data['birth_date'])); endif;
        if (!empty($data['street'])) : $this->$var->setStreet($data['street']); endif;
        if (!empty($data['RT'])) : $this->$var->setRT($data['RT']); endif;
        if (!empty($data['RW'])) : $this->$var->setRW($data['RW']); endif;
        if (!empty($data['village'])) : $this->$var->setVillage($data['village']); endif;
        if (!empty($data['district'])) : $this->$var->setDistrict($data['district']); endif;
        if (!empty($data['city'])) : $this->$var->setCity($data['city']); endif;
        if (!empty($data['province'])) : $this->$var->setProvince($data['province']); endif;        
        if (!empty($data['postal_code'])) : $this->$var->setPostalCode($data['postal_code']); endif;
        if (!is_null($data['contact'])) : $this->$var->setContact($data['contact']); endif;
        if (!is_null($data['relation'])) : $this->$var->setRelation($data['relation']); endif;
        if (!is_null($data['nationality'])) : $this->$var->setNationality($data['nationality']); endif;
        if (!is_null($data['religion'])) : $this->$var->setReligion($data['religion']); endif;
        if (!is_null($data['education_level'])) : $this->$var->setEducationLevel($data['education_level']); endif;
        if (!is_null($data['job'])) : $this->$var->setJob($data['job']); endif;
        if (!is_null($data['position'])) : $this->$var->setPosition($data['position']); endif;
        if (!is_null($data['company'])) : $this->$var->setCompany($data['company']); endif;
        if (!is_null($data['income'])) : $this->$var->setIncome($data['income']); endif;
        if (!is_null($data['burden_count'])) : $this->$var->setBurdenCount($data['burden_count']); endif;
        
    }
    
    public function ajaxValidation($data, $type){
        $input_error = [];
        $valid = true;
        $arr_required =  ['name', 'status', 'birth_place', 'birth_date', 'street', 'RT', 'RW', 'village', 'district', 
            'city', 'province', 'postal_code', 'contact', 'relation',
            'nationality', 'religion', 'education_level', 'job'];
        if($type == 'father'){
            $arr_required[] = 'burden_count';
            $arr_required[] = 'income';
        }
        foreach ($arr_required as $required){
            if(array_key_exists($required, $data)){
                if(empty($data[$required])){
                    $input_error [] = $type.'_'.$required;
                    $valid = false;
                }
            } else {
                $input_error [] = $type.'_'.$required;
                $valid = false;
            }
        }
        return ['valid' => $valid, 'errored' => $input_error];
    }
}
