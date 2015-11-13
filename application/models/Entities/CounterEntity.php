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
 * @Entity(repositoryClass="CounterRepo") @Table(name="counter")
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
    protected $registrantCount;
    
    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function getRegistrantCount() {
        return $this->registrantCount;
    }

    // Juga set ID
    public function setDate(DateTime $date) {
        $this->date = $date;
        $id = (int) $date->format('Ymd');
        $this->id = $id;
        return $this;
    }

    //NOTE: setiap ada pendaftar ditambah 1!
    public function addCount() {
        if(is_null($this->getRegistrantCount()) || $this->registrantCount < 1){
            $this->registrantCount = 1;
        } else {
            $this->registrantCount = $this->registrantCount+1;
        }
        return $this;
    }
    
    public function removeCount() {
        if(is_null($this->getRegistrantCount()) || $this->registrantCount < 0){
            $this->registrantCount = 0;
        } else {
            $this->registrantCount = $this->registrantCount-1;
        }
        return $this;
    }
}
