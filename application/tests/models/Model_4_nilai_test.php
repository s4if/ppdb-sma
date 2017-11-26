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
class Model_4_nilai_test extends TestCase{
    
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('model_admin', 'admin');
        $this->CI->load->model('model_registrant', 'reg');
        $this->obj = $this->CI->admin;
    }
    
    public function test_nilai_entities(){
        $nilai = new RaporEntity();
        $nameset = ['mtk', 'ipa', 'ips', 'ind', 'ing'];
        // input
        foreach ($nameset as $name){
            $this->assertInstanceOf(RaporEntity::class, $nilai->edit($name, 'kkm', 1, 80));
            $this->assertInstanceOf(RaporEntity::class, $nilai->edit($name, 'nilai', 1, 85));
        }
        
        //input error
//        $this->assertNull($nilai->edit('error', 'kkm', 1, 80));
//        $this->assertNull($nilai->edit('ipa', 'error', 1, 80));
//        $this->assertNull($nilai->edit('ipa', 'kkm', 7, 80));
        
        //delete
        $nilai->edit('ipa', 'kkm', 2, 80);
        $this->assertInstanceOf(RaporEntity::class, $nilai->delete('ipa', 'kkm', '2'));
        
        // get Nilai
        foreach ($nameset as $name){
            $this->assertEquals($nilai->get($name, 'kkm', 1), 80);
            $this->assertEquals($nilai->get($name, 'nilai', 1), 85);
        }
        
        //get Error 
        $this->assertEquals($nilai->get('error', 'kkm', 1), null);
        $this->assertEquals($nilai->get('ipa', 'kkm', 3), null);
        
        //getAll
        $data = $nilai->getAll();
        $this->assertEquals($data[1]['ipa']['kkm'], 80);
    }
}
