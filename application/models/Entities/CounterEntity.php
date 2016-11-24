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
 * @Entity() @Table(name="counter")
*/
class CounterEntity {
    /**
     * @Id @GeneratedValue(strategy="NONE") @Column(type="bigint")
     */
    protected $id;
    /**
     * @Column(type="date")
     * @var DateTime
     */
    protected $date;
    /**
     * @Column(type="integer")
     * @var integer
     */
    protected $maleCount;
    /**
     * @Column(type="integer")
     * @var integer
     */
    protected $femaleCount;
    
    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getMaleCount() {
        return $this->maleCount;
    }
    
    public function getFemaleCount() {
        return $this->femaleCount;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }
        
    // Juga set ID
    public function setDate(DateTime $date) {
        $this->date = $date;
        return $this;
    }

    //NOTE: setiap ada pendaftar ditambah 1!
    public function addMaleCount() {
        if(is_null($this->getMaleCount())){
            $this->maleCount = 1;
        } else {
            $this->maleCount = $this->maleCount+1;
        }
        return $this;
    }
    
    public function removeMaleCount() {
        if(is_null($this->getMaleCount())){
            $this->maleCount = 0;
        } else {
            $this->maleCount = $this->maleCount-1;
        }
        return $this;
    }
    
    //NOTE: setiap ada pendaftar ditambah 1!
    public function addFemaleCount() {
        if(is_null($this->getFemaleCount())){
            $this->femaleCount = 1;
        } else {
            $this->femaleCount = $this->femaleCount+1;
        }
        return $this;
    }
    
    public function removeFemaleCount() {
        if(is_null($this->getFemaleCount())){
            $this->femaleCount = 0;
        } else {
            $this->femaleCount = $this->femaleCount-1;
        }
        return $this;
    }
    
    public function setMaleCount($maleCount) {
        $this->maleCount = $maleCount;
        return $this;
    }

    public function setFemaleCount($femaleCount) {
        $this->femaleCount = $femaleCount;
        return $this;
    }

}
