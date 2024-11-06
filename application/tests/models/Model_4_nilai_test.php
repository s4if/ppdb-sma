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
    
    public function setUp(): void
    {
        $this->resetInstance();
        $this->CI->load->model('model_rapor', 'rapor');
        $this->CI->load->model('model_registrant', 'reg');
        $this->obj = $this->CI->rapor;
    }
    
    public function test_nilai_entities(){
        $nilai = new RaporEntity();
        $nameset = ['mtk', 'ipa', 'ips', 'ind', 'ing'];
        // input
        foreach ($nameset as $name){
            // rapor disable
            //$this->assertInstanceOf(RaporEntity::class, $nilai->edit($name, 'kkm', 1, 80));
            $this->assertInstanceOf(RaporEntity::class, $nilai->edit($name, 'nilai', 1, 85));
        }
        
        //input error
//        $this->assertNull($nilai->edit('error', 'kkm', 1, 80));
//        $this->assertNull($nilai->edit('ipa', 'error', 1, 80));
//        $this->assertNull($nilai->edit('ipa', 'kkm', 7, 80));
        
        //delete
        $nilai->edit('ipa', 'nilai', 2, 80);
        $this->assertInstanceOf(RaporEntity::class, $nilai->delete('ipa', 'nilai', '2'));
        
        // get Nilai
        foreach ($nameset as $name){
            //$this->assertEquals($nilai->get($name, 'kkm', 1), 80);
            $this->assertEquals($nilai->get($name, 'nilai', 1), 85);
        }
        
        //get Error 
        //$this->assertEquals($nilai->get('error', 'kkm', 1), null);
        $this->assertEquals($nilai->get('ipa', 'kkm', 3), null);
        
        //getAll
        $data = $nilai->getAll();
        $this->assertEquals($data[1]['ipa']['nilai'], 85);
    }
    
    public function test_crud_rapor(){
        $this->setUp();
        $arr_reg =  $this->CI->reg->getData('P');
        $reg = end($arr_reg);
        $data = [
            'kkm_ipa_1' => 80,
            'kkm_ipa_2' => 80,
            'kkm_ipa_3' => 80,
            'kkm_ipa_4' => 80,
            'kkm_ipa_5' => 80,
            'kkm_ipa_6' => 80,
            'kkm_ips_1' => 80,
            'kkm_ips_2' => 80,
            'kkm_ips_3' => 80,
            'kkm_ips_4' => 80,
            'kkm_ips_5' => 80,
            'kkm_ips_6' => 80,
            'kkm_ing_1' => 80,
            'kkm_ing_2' => 80,
            'kkm_ing_3' => 80,
            'kkm_ing_4' => 80,
            'kkm_ing_5' => 80,
            'kkm_ing_6' => 80,
            'kkm_ind_1' => 80,
            'kkm_ind_2' => 80,
            'kkm_ind_3' => 80,
            'kkm_ind_4' => 80,
            'kkm_ind_5' => 80,
            'kkm_ind_6' => 80,
            'kkm_mtk_1' => 80,
            'kkm_mtk_2' => 80,
            'kkm_mtk_3' => 80,
            'kkm_mtk_4' => 80,
            'kkm_mtk_5' => 80,
            'kkm_mtk_6' => 80,
            'nilai_ipa_1' => 85,
            'nilai_ipa_2' => 85,
            'nilai_ipa_3' => 85,
            'nilai_ipa_4' => 85,
            'nilai_ipa_5' => 85,
            'nilai_ipa_6' => 85,
            'nilai_ips_1' => 85,
            'nilai_ips_2' => 85,
            'nilai_ips_3' => 85,
            'nilai_ips_4' => 85,
            'nilai_ips_5' => 85,
            'nilai_ips_6' => 85,
            'nilai_ing_1' => 85,
            'nilai_ing_2' => 85,
            'nilai_ing_3' => 85,
            'nilai_ing_4' => 85,
            'nilai_ing_5' => 85,
            'nilai_ing_6' => 85,
            'nilai_ind_1' => 85,
            'nilai_ind_2' => 85,
            'nilai_ind_3' => 85,
            'nilai_ind_4' => 85,
            'nilai_ind_5' => 85,
            'nilai_ind_6' => 85,
            'nilai_mtk_1' => 85,
            'nilai_mtk_2' => 85,
            'nilai_mtk_3' => 85,
            'nilai_mtk_4' => 85,
            'nilai_mtk_5' => 85,
            'nilai_mtk_6' => 85,
        ];
        $this->assertTrue($this->obj->updateData($data, $reg));
        
        //edit
        $arr_reg =  $this->CI->reg->getData('P');
        $reg = end($arr_reg);
        $data['nilai_mtk_3'] = 88;
        $this->assertTrue($this->obj->updateData($data, $reg));
        
        //delete
        $arr_reg =  $this->CI->reg->getData('P');
        $reg = end($arr_reg);
        $this->assertTrue($this->obj->deleteData($reg));
        $this->assertFalse($this->obj->deleteData($reg)); // sudah dihapus, jadi error
        
        // Inser u/ test selanjutnya
        $arr_reg =  $this->CI->reg->getData('P');
        $reg = end($arr_reg);
        $data['nilai_mtk_3'] = 85;
        $this->obj->updateData($data, $reg);
        
        $this->setUp();
        $arr_reg =  $this->CI->reg->getData('P');
        $reg = end($arr_reg);
        $nameset = ['mtk', 'ipa', 'ips', 'ind', 'ing'];
        for($i = 1; $i <=4;$i++){
            foreach ($nameset as $name){
                //$this->assertEquals($reg->getRapor()->get($name, 'kkm', $i), 80, $name.$i);
                $this->assertEquals($reg->getRapor()->get($name, 'nilai', $i), 85, $name.$i);
            }
        }
    }
}
