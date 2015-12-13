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
 * Description of Model_2_parent_test
 *
 * @author s4if
 */
class Model_2_parent_test extends TestCase{
    
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('model_registrant', 'reg');
        $this->CI->load->model('model_parent', 'parent');
        $this->obj = $this->CI->parent;
    }
    
    public function test_crud_data_parent(){
        $this->setUp();
        $this->CI->load->model('model_registrant', 'reg');
        $arr_reg =  $this->CI->reg->getData('P');
        $id = end($arr_reg)->getId();
        
        // test insert ayah
        $this->setUp();
        $data = [
            'type' => 'father', 
            'name' => "Arikunto", 
            'status' => 'Hidup',  //Cerai, Hidup, Almarhum
            'birth_place' => 'Blora', 
            'birth_date' => '12-12-1981', 
            //'address' => 'Dsn Karang Wuri, Semar Kab. Semarang', 
            'street' => 'Rambeanak II', 
            'RT' => 1,
            'RW' => 3, 
            'village' => 'Rambeanak', 
            'district' => 'Mungkid', 
            'city' => 'Kab. Magelang', 
            'province' => 'Jawa Tengah', 
            'postal_code' => 56551,
            'contact' => '08965478865', 
            'relation' => 'Kandung', //Kandung, Tiri, Angkat (ayah & ibu pake radio, tapi wali pake input teks)
            'nationality' => 'WNI', 
            'religion' => 'ISLAM', 
            'education_level' => 'SMA', 
            'job' => 'Kuli Bangunan', 
            'position' => null, 
            'company' => null,
            'income' => '300000', 
            'burden_count' => 4
            ];
        $this->assertTrue($this->obj->updateData($id, $data, $data['type']));
        
        // test insert ibu
        $data['type'] = 'mother';
        $data['name'] = 'Suharsimi';
        $data['status'] = 'Almarhum';
        $data['birth_date'] = '11-11-1983';
        $data['job'] = null;
        $data['income'] = 0;
        $this->assertTrue($this->obj->updateData($id, $data, $data['type']));
        
        // test insert Wali
        $data['type'] = 'guardian';
        $data['name'] = 'Danny Sutanto';
        $data['status'] = 'Hidup';
        $data['birth_date'] = '11-11-1990';
        $data['job'] = 'Linux Kernel Developer';
        $data['position'] = 'Kernel Driver Developer';
        $data['company'] = 'Alvanz Drone Instrument ltd.';
        $data['income'] = '30000000';
        $data['burden_count'] = 1;
        $data['education_level'] = 'S1';
        $data['speciality'] = 'Informatics Engineering';
        $this->assertTrue($this->obj->updateData($id, $data, $data['type']));
        
        //test edit registrant
        $this->setUp();
        $data['address'] = 'Magelang City';
        $data['relation'] = 'Sepupu';
        $this->assertTrue($this->obj->updateData($id, $data, $data['type']));
        
    }
    
    public function test_get_data_parent()
    {
        $this->setUp();
        $arr_reg =  $this->CI->reg->getData('P');
        $id = end($arr_reg)->getId();
        $parentData = $this->obj->getData($id, ['father', 'mother', 'guardian']);
        $attributes = ['id', 'type', 'name', 'status', 'birthPlace', 'birthDate', 'street', 'RT', 'RW', 'village', 
            'district', 'city', 'province', 'postalCode',  'contact', 'relation', 
            'nationality', 'religion', 'educationLevel', 'job', 'position', 'company', 'income', 'burdenCount'];
        foreach ($parentData as $parent) {
            foreach ($attributes as $attributeName){
                $this->assertObjectHasAttribute($attributeName, $parent);
            }
        }
    }
    
}
