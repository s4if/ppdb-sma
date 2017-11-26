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
 * @Entity(repositoryClass="RaporRepo") @Table(name="rapor")
 */
class RaporEntity
{
    /**
     * @Id @GeneratedValue(strategy="AUTO") @Column(type="integer")
     *
     * @var int
     */
    protected $id;
    
    /**
     * @OneToOne(targetEntity="RegistrantEntity", mappedBy="rapor")
     */
    private $registrant;

    //=== Matematika
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_mtk_s1;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_mtk_s1;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_mtk_s2;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_mtk_s2;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_mtk_s3;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_mtk_s3;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_mtk_s4;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_mtk_s4;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_mtk_s5;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_mtk_s5;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_mtk_s6;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_mtk_s6;
    
    //=== IPA
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ipa_s1;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ipa_s1;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ipa_s2;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ipa_s2;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ipa_s3;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ipa_s3;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ipa_s4;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ipa_s4;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ipa_s5;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ipa_s5;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ipa_s6;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ipa_s6;
    
    //=== IPS
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ips_s1;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ips_s1;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ips_s2;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ips_s2;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ips_s3;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ips_s3;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ips_s4;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ips_s4;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ips_s5;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ips_s5;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ips_s6;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ips_s6;
    
    //=== B. Inggris
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ing_s1;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ing_s1;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ing_s2;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ing_s2;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ing_s3;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ing_s3;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ing_s4;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ing_s4;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ing_s5;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ing_s5;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ing_s6;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ing_s6;
    
    //=== B. Indo
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ind_s1;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ind_s1;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ind_s2;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ind_s2;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ind_s3;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ind_s3;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ind_s4;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ind_s4;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ind_s5;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ind_s5;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $nilai_ind_s6;
    
    /**
     * @Column(type="integer", nullable=TRUE)
     *
     * @var int
     */
    protected $kkm_ind_s6;
    
    public function getId() {
        return $this->id;
    }

    public function getRegistrant() {
        return $this->registrant;
    }

    public function setRegistrant($registrant) {
        $this->registrant = $registrant;
        return $this;
    }
    
    public function getAll(){
        $data = [];
        $mapel= ['mtk', 'ipa', 'ips', 'ind', 'ing'];
        foreach ($mapel as $mpl){
            for($i = 1; $i <=6; $i++){
                $kkm = 'kkm_'.$mpl.'_'.$i;
                $nilai = 'nilai_'.$mpl.'_'.$i;
                $data[$i][$mpl] = [
                    'kkm' => isset($this->$kkm)?$this->$kkm:null,
                    'nilai' => isset($this->$nilai)?$this->$nilai:null,
                ];
            }
        }
        return $data;
    }
    
    public function get($mapel, $tipe, $semester){
        try{
            $strv = $tipe.'_'.$mapel.'_'.$semester;
            $nilai = isset($this->$strv)?$this->$strv:null;
            return $nilai;
        } catch (Exception $e){
            return null;
        }
    }
    
    // ada yang aneh terjadi saat di tes dengan mapel "error" tapi aku ga tau kenapa...
    public function edit($mapel, $tipe, $semester, $nilai){
        try{
            $strv = $tipe.'_'.$mapel.'_'.$semester;
            $this->$strv = $nilai;
            return $this;
        } catch (Exception $e){
            return null;
        }
    }
    
    public function delete($mapel, $tipe, $semester){
        return $this->edit($mapel, $tipe, $semester, NULL);
    }
}
