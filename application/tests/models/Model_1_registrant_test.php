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
            'username' => 'fatimah',
            'nisn' => '0943292385234',
            'gender' => 'P',
            'prev_school' => 'SMPIT Ihsanul Fikri Kt Magelang',
            'cp' => '084738172839',
            'program' => 'IPA Tahfidz'
        ];
        // test insert registrant
        $this->assertTrue($this->obj->insertData($data));
        $this->setUp();
        $this->assertFalse($this->obj->insertData($data));
        $this->setUp();
        $data['username'] = 'fatim';
        $this->assertTrue($this->obj->insertData($data));
        $data['username'] = 'fatim2';
        $this->obj->insertData($data);
        
        //test edit registrant
        $this->setUp();
        $data['id'] = '0000';
        $this->assertFalse($this->obj->updateData($data));
        $arr_reg =  $this->obj->getData('P');
        $data['id'] = end($arr_reg)->getId();
        $data['prev_school'] = 'SMPIT Ihsanul Fikri Kota Magelang';
        $this->assertTrue($this->obj->updateData($data));
        
        // test delete registrant
        $this->setUp();
        $this->assertTrue($this->obj->deleteData($data));
        $this->assertFalse($this->obj->deleteData($data));
        
    }
    
    public function test_finalization_registrant(){
        // FInalisasi
        $this->setUp();
        $arr_reg =  $this->obj->getData('P');
        $data['id'] = end($arr_reg)->getId();
        $data['initial_cost'] = '11000000';
        $data['subscription_cost'] = '1250000';
        $data['main_parent'] = 'father';
        $data['landDonation'] = '1000000';
        $data['relegate_to_ips'] = 'true';
        $data['relegate_to_regular'] = 'true';
        $data['qurban'] = '2019;2020';
        $data['finalized'] = 'true';
        $this->setUp();
        $this->assertTrue($this->obj->updateData($data));
    }
    
    public function test_upload_receipt(){
        // FInalisasi
        $this->setUp();
        $arr_reg =  $this->obj->getData('P');
        $id = end($arr_reg)->getId();
        $data['payment_date'] = '19-2-2017';
        $data['amount'] = '200000';
        $this->setUp();
        $this->assertNull($this->obj->receipt_data($id,$data));
        $this->setUp();
        $id = $arr_reg[0]->getId();
        $this->assertNull($this->obj->receipt_data($id,$data));
    }
    
    public function test_get_kode_registrant(){
        // FInalisasi
        $this->setUp();
        $arr_reg =  $this->obj->getData('P');
        $id = end($arr_reg)->getId();
        $gender = end($arr_reg)->getGender();
        $this->setUp();
        $this->assertTrue($this->obj->genKode($id, $gender)['status']);
    }
//    
    public function test_get_data_registrant()
    {
        $registrant = $this->obj->getData('P')[0];
        $registrants = $this->obj->getData();
        $registrants_2 = $this->obj->getData('P');
        $attributes = ['id', 'regId', 'name', 'gender', 'previousSchool', 'nisn', 'program', 'deleted', 'registrationTime', 'registrantData',
                'father', 'mother', 'guardian', 'paymentData', 'initialCost', 'relToIPS', 'relToRegular',
                'subscriptionCost', 'landDonation', 'qurban' ];
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
        $this->assertNotEquals([], $this->obj->getUnpaidData());
        $this->assertNotEquals([], $this->obj->getIncompleteData());
        $this->assertNull($this->obj->getData(null,'0000'));
    }
    
    public function test_crud_data_registrant_detail(){
        
        //$registrant = $this->obj->getData(null, '20141201001');
        $arr_reg =  $this->obj->getData('P');
        $id = end($arr_reg)->getId();
        
        // test delete registrant
        $this->setUp();
        $this->assertFalse($this->obj->deleteDetail('00000000000'));
        
        // test insert registrant
        $this->setUp();
        $data = [
            'nik' => '3304939390029302',
            'nkk' => '3302300204930302',
            'nak' => '3304939393999281',
            'birth_place' => 'Semarang', 
            'birth_date' => '19-2-2000', 
            'street' => 'Rambeanak II', 
            'RT' => 1,
            'RW' => 3, 
            'village' => 'Rambeanak', 
            'district' => 'Mungkid', 
            'city' => 'Kab. Magelang', 
            'province' => 'Jawa Tengah', 
            'postal_code' => 56551,
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
        $arr_reg =  $this->obj->getData('P');
        $registrant = end($arr_reg);
        $registrantData = $registrant->getRegistrantData();
        $attributes = ['id', 'registrant','nik','nkk','nak', 'birthPlace', 'birthDate', 'street', 
            'RT', 'RW', 'village', 'district', 'city', 'province', 'postalCode', 
            'familyCondition', 'nationality', 'religion', 'height', 'weight', 'childOrder', 'siblingsCount',
            'stayWith', 'physicalAbnormalities', 'hospitalSheets', 'hobbies', 'achievements'];
        foreach ($attributes as $attributeName){
            $this->assertObjectHasAttribute($attributeName, $registrantData);
        }
        $this->assertArrayNotHasKey('status', $registrantData->getAchievements());
        $this->assertStringNotMatchesFormat('Error', $registrantData->getAchievements(false));
        $this->assertArrayNotHasKey('status', $registrantData->getHospitalSheets());
        $this->assertStringNotMatchesFormat('Error', $registrantData->getHospitalSheets(false));
        $this->assertArrayNotHasKey('status', $registrantData->getPhysicalAbnormalities());
        $this->assertStringNotMatchesFormat('Error', $registrantData->getPhysicalAbnormalities(false));
        $this->assertArrayNotHasKey('status', $registrantData->getHobbies());
        $this->assertStringNotMatchesFormat('Error', $registrantData->getHobbies(false));
        // address
        $this->assertStringNotMatchesFormat('Error', $registrantData->getAddress());        
    }
    
    public function test_upload()
    {
        $arr_reg =  $this->obj->getData('P');
        $id = end($arr_reg)->getId();
        $data = [
            'payment_date' => '11-12-2015',
            'transfer_destination' => 'SMAIT Ihsanul Fikri BNI Syariah',
            'amount' => 250003
        ];
        // Setup
        $this->setUp();
        $this->assertFalse($this->obj->uploadFoto(APPPATH.'tests/assets/failed.txt', $id));
        $this->assertTrue($this->obj->uploadFoto(APPPATH.'tests/assets/foto.png', $id));
        $this->assertFalse($this->obj->uploadReceipt(APPPATH.'tests/assets/failed.txt', $id, $data));
        $this->assertTrue($this->obj->uploadReceipt(APPPATH.'tests/assets/receipt.jpg', $id, $data));
    }
    
    
    public function test_export(){
        $this->setUp();
        $this->assertTrue($this->obj->export('Coba', 'P', false, true));
        $this->assertTrue($this->obj->export('Coba', 'L', false, true));
        $this->assertTrue($this->obj->export('Coba', 'P', true, true));
        $this->assertTrue($this->obj->export('Coba', 'L', true, true));
    }
    
    public function test_export_uncomplete(){
        $this->setUp();
        $this->assertTrue($this->obj->export_Uncomplete('Coba', true));
        $this->assertTrue($this->obj->export_Uncomplete('Coba', true, false));
    }
    
    public function test_certificate(){
        $arr_reg =  $this->obj->getData('P');
        $id = end($arr_reg)->getId();
        $this->setUp();
        $data = [
            'scheme' => 'Prestasi',
            'rank' => 3,
            'subject' => 'IPA',
            'organizer' => 'Disdikpora Provinsi',
            'start_date' => '2018-12-13',
            'end_date' => '2018-12-14',
            'level' => 'Provinsi',
            'place' => 'Semarang',
            'file_type' => 'Sertifikat'
        ];
        $this->assertFalse($this->obj->addCertificate(-99, $data, FCPATH.'assets/test/gambar1.png'));
        $this->assertTrue($this->obj->addCertificate($id, $data, FCPATH.'assets/test/gambar1.png'));
        $arr_reg2 =  $this->obj->getData('P');
        $reg = end($arr_reg2);
        $cert = $reg->getCertificates()->first();
        $cert_id = $cert->getId();
        $this->assertTrue($this->obj->deleteCertificate($cert_id));
        $this->assertFalse($this->obj->deleteCertificate($cert_id));
        $this->assertNull($this->obj->getCertificate($cert_id));
        $this->obj->addCertificate($id, $data, FCPATH.'assets/test/gambar1.png');
    }
    
}