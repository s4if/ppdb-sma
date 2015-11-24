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
 * Description of Model_3_admin_test
 *
 * @author s4if
 */
class Model_3_admin_test extends TestCase{
    
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('model_admin', 'admin');
        $this->CI->load->model('model_registrant', 'reg');
        $this->obj = $this->CI->admin;
    }
    
    public function test_crud_data_admin()
    {
        $data = [
            'password' => 'qwerty',
            'username' => 'testing',
            'root' => false
        ];
        // Insert Data
        $this->assertTrue($this->obj->insertData($data));
        $this->assertFalse($this->obj->insertData($data));
        
        // Update Data
        $data['root'] = true;
        $this->setUp();
        $this->assertTrue($this->obj->updateData($data));
        $data['username'] = 'gagal';
        $this->assertFalse($this->obj->updateData($data));
        $data['username'] = 'testing';
        
        // Remove Data
        $this->setUp();
        $this->assertTrue($this->obj->deleteData($data));
        $this->assertFalse($this->obj->deleteData($data));
        
        // Insert for another funct
        $this->obj->insertData($data);
    }
    
    public function test_get_data_parent()
    {
        $this->setUp();
        $data = [
            'password' => 'qwerty',
            'username' => 'testing',
            'root' => false
        ];
        $admin = $this->obj->getData($data['username']);
        $attributes = ['username', 'password', 'root'];
        foreach ($attributes as $attributeName){
            $this->assertObjectHasAttribute($attributeName, $admin);
        }
        $admins = $this->obj->getData()[0];
        foreach ($attributes as $attributeName){
            $this->assertObjectHasAttribute($attributeName, $admins);
        }
    }
    
    public function test_delete_custom_data(){
        $data = [
            'password' => 'qwerty',
            'username' => 'testing',
            'root' => false
        ];
        $this->setUp();
        $this->assertTrue($this->obj->deleteData($data));
    }
    
    public function test_delete_custom_registrant_data(){
        $this->setUp();
        $id = $this->CI->reg->getData('P')[0]->getId();
        $this->assertTrue($this->CI->reg->deleteData(['id' => $id]));
    }
    
}
