<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_rapor
 *
 * @author s4if
 */
class Model_rapor extends CI_Model
{
    protected $rapor;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function updateData($data, RegistrantEntity $reg){ // satu saja-kah
        try {
            $this->rapor = $reg->getRapor();
            if(is_null($this->rapor)){
                $this->rapor = new RaporEntity();
            }
            $this->rapor->setRegistrant($reg);
            $this->setData($data);
            $reg->setRapor($this->rapor);
            $this->doctrine->em->persist($this->rapor);
            $this->doctrine->em->persist($reg);
            $this->doctrine->em->flush();
            return true;
        } catch (Doctrine\DBAL\Exception\ConstraintViolationException $ex){
            return false;
        }
    }
    
    public function deleteData(RegistrantEntity $reg){
        $this->rapor = $reg->getRapor();
        if(is_null($this->rapor)){
            return false;
        } else {
            $reg->deleteRapor();
            $this->doctrine->em->persist($reg);
            $this->doctrine->em->remove($this->rapor);
            $this->doctrine->em->flush();
            return true;
        }
    }
    
    // ???
    protected function setData($data){
        $nameset = ['mtk', 'ipa', 'ips', 'ind', 'ing'];
        for($i = 1;$i <= 4;$i++){
            foreach ($nameset as $name){
                $this->rapor->edit($name, 'kkm', $i, $data['kkm_'.$name.'_'.$i]);
                $this->rapor->edit($name, 'nilai', $i, $data['nilai_'.$name.'_'.$i]);
            }
        }
    }
}
