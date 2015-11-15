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
    
    // TODO: In Production always enable try and catch
    public function updateData($id, $data, $position){
//        try{
            $this->registrant = $this->doctrine->em->find('registrantEntity', $id);
            if(is_null($this->registrant)){
                return false;
            } else {
                return $this->doUpdateData($data, $position);
            }
//        } catch (Exception $e){
//            return false;
//        }
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
        $this->registrant = $this->doctrine->em->find('registrantEntity', $id);
        if(is_null($this->registrant)){
            return false;
        } else {
            // try kalau di production harus diaktifkan
//            try{
                return $this->doDelete($pos);
//            } catch (Exception $ex) {
//                return false;
//            }
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
        if (!empty($var)) : $this->$var->setType($var); endif;
        if (!empty($data['name'])) : $this->$var->setName($data['name']); endif;
        if (!empty($data['status'])) : $this->$var->setStatus($data['status']); endif;
        if (!empty($data['birth_place'])) : $this->$var->setBirthPlace($data['birth_place']); endif;
        if (!empty($data['birth_date'])) : $this->$var->setBirthDate(new DateTime($data['birth_date'])); endif;
        if (!empty($data['address'])) : $this->$var->setAddress($data['address']); endif;
        if (!empty($data['contact'])) : $this->$var->setContact($data['contact']); endif;
        if (!empty($data['relation'])) : $this->$var->setRelation($data['relation']); endif;
        if (!empty($data['nationality'])) : $this->$var->setNationality($data['nationality']); endif;
        if (!empty($data['religion'])) : $this->$var->setReligion($data['religion']); endif;
        if (!empty($data['education_level'])) : $this->$var->setEducationLevel($data['education_level']); endif;
        if (!empty($data['speciality'])) : $this->$var->setSpeciality($data['speciality']); endif;
        if (!empty($data['job'])) : $this->$var->setJob($data['job']); endif;
        if (!empty($data['position'])) : $this->$var->setPosition($data['position']); endif;
        if (!empty($data['company'])) : $this->$var->setCompany($data['company']); endif;
        if (!empty($data['company_address'])) : $this->$var->setCompanyAddress($data['company_address']); endif;
        if (!empty($data['income'])) : $this->$var->setIncome($data['income']); endif;
        if (!empty($data['burden_count'])) : $this->$var->setBurdenCount($data['burden_count']); endif;
        
    }
}
