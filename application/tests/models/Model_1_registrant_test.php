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
 * Description of Model_registrant_test
 *
 * @author s4if
 */
class Model_1_registrant_test extends TestCase {
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('model_registrant', 'reg');
        $this->obj = $this->CI->reg;
    }

    public function test_crud_data_registrant(){
        $this->setUp();
        $data = [
            'password' => 'qwerty',
            'name' => 'Fatimah',
            'sex' => 'P',
            'prev_school' => 'SMPIT Ihsanul Fikri Kt Magelang',
            'nisn' => '09082083013',
            'program' => 'Reguler',
        ];
        // test insert registrant
        $this->assertTrue($this->obj->insertData($data));
        
        //test edit registrant
        $this->setUp();
        $data['id'] = '0000';
        $this->assertFalse($this->obj->updateData($data));
        $data['id'] = $this->obj->getData('P')[0]->getId();
        $data['prev_school'] = 'SMPIT Ihsanul Fikri Kota Magelang';
        $this->assertTrue($this->obj->updateData($data));
        
        // test delete registrant
        $this->setUp();
        $this->assertTrue($this->obj->deleteData($data));
        $this->assertFalse($this->obj->deleteData($data));
        
        // Use Data
        unset($data['id']);
        $this->obj->insertData($data);
    }
    
    public function test_get_data_registrant()
    {
        $registrant = $this->obj->getData('P')[0];
        $registrants = $this->obj->getData();
        $registrants_2 = $this->obj->getData('P');
        $attributes = ['id','password','name','sex','previousSchool','nisn','program','registrationTime','registrantData', 'father', 'mother', 'guardian'];
        foreach ($attributes as $attributeName){
            $this->assertObjectHasAttribute($attributeName, $registrant);
        }
        foreach ($attributes as $attributeName){
            $this->assertObjectHasAttribute($attributeName, $registrants[0]);
        }
        foreach ($attributes as $attributeName){
            $this->assertObjectHasAttribute($attributeName, $registrants_2[0]);
        }
        $this->assertEquals( [], $this->obj->getData('XY'));
        $this->assertNull($this->obj->getData(null,'0000'));
    }
    
    public function test_crud_data_registrant_detail(){
        
        //$registrant = $this->obj->getData(null, '20141201001');
        $id = $this->obj->getData('P')[0]->getId();
        
        // test delete registrant
        $this->setUp();
        $this->assertFalse($this->obj->deleteDetail('00000000000'));
        
        // test insert registrant
        $this->setUp();
        $data = [
            'birth_place' => 'Semarang', 
            'birth_date' => new DateTime('19-2-2000'), 
            'address' => 'Magelang City', 
            'family_condition' => 'Yatim', 
            'nationality' => 'WNI', 
            'religion' => 'Islam', 
            'height' => 176, 
            'weight' => 57, 
            'stay_with' => 'Ortu',
            'hobbies' => ['makan', 'tidur', 'baca komik'],
            'achievements' => ['Juara 1 OSN Fisika SMP'],
            'physical_abnormalities' => ['Jentik kaki kiri diamputasi'],
            'hospital_sheets' => ['Pernah kecelakaan']
        ];
        $this->assertTrue($this->obj->updateDetail($id, $data));
        $this->assertFalse($this->obj->updateDetail('00000000000',$data));
        
        //test edit registrant
        $this->setUp();
        $data['height'] = 200;
        $this->assertTrue($this->obj->updateDetail($id,$data));
        
    }
    
    public function test_get_data_registrant_detail()
    {
        $this->setUp();
        $registrant = $this->obj->getData('P')[0];
        $registrantData = $registrant->getRegistrantData();
        // TODO: Hobby, achievement, HospitalSheet, PhysicalAbnormality
        $attributes = ['id', 'registrant', 'birthPlace', 'birthDate', 'address', 'familyCondition', 'nationality', 'religion', 'height', 'weight', 'stayWith'];
        foreach ($attributes as $attributeName){
            $this->assertObjectHasAttribute($attributeName, $registrantData);
        }
        
        // Test Semua Array Collection di Data... 
        $this->setUp();
        $rData = $registrant->getRegistrantData();
        $achievement = $rData->getAchievements()[0];
        $this->assertObjectHasAttribute('achievement', $achievement);
        $hobby = $rData->getHobbies()[0];
        $this->assertObjectHasAttribute('hobby', $hobby);
        $hs = $rData->getHospitalSheets()[0];
        $this->assertObjectHasAttribute('hospitalSheet', $hs);
        $pa = $rData->getPhysicalAbnormalities()[0];
        $this->assertObjectHasAttribute('physicalAbnormality', $pa);
    }
    
    public function test_delete_custom_data(){
        $this->setUp();
        $id = $this->obj->getData('P')[0]->getId();
        $this->assertTrue($this->obj->deleteData(['id' => $id]));
    }
}