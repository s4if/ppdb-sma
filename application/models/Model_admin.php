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
 * Description of Model_admin
 *
 * @author s4if
 */
class Model_admin extends CI_Model {
    
    protected $admin;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getData($id = -999){
        if($id == -999){
            $regRepo = $this->doctrine->em->getRepository('AdminEntity');
            return $regRepo->getData();
        } else {
            $admin = $this->doctrine->em->find('AdminEntity', $id);
            return $admin;
        }
    }
    
    // TODO: In Production always enable try and catch
    public function insertData($data){
        try {
            $this->admin = new AdminEntity();
            $this->setData($data);
            $this->doctrine->em->persist($this->admin);
            $this->doctrine->em->flush();
            return true;
        } catch (Exception $ex){
            return false;
        }
    }
    
    public function updateData($data){
        $this->admin = $this->doctrine->em->find('AdminEntity', $data['username']);
        if(is_null($this->admin)){
            return false;
        } else {
            $this->setData($data);
            $this->doctrine->em->persist($this->admin);
            $this->doctrine->em->flush();
            return true;
        }
    }
    
    public function deleteData($data){
        $this->admin = $this->doctrine->em->find('AdminEntity', $data['username']);
        if(is_null($this->admin)){
            return false;
        } else {
            $this->doctrine->em->remove($this->admin);
            $this->doctrine->em->flush();
            return true;
        }
    }
    
    //jika ada error yang berkaitan dengan set data, lihat urutan pemberian data pada fungsi
    protected function setData($data){
        if (!is_null($data['username'])) : $this->admin->setUsername($data['username']); endif;
        if (!is_null($data['password'])) : $this->admin->setPassword(password_hash($data['password'], PASSWORD_BCRYPT)); endif;
        if (!is_null($data['root'])) : $this->admin->setRoot($data['root']); endif;
    }
}
