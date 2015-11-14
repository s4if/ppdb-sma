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
 * @Entity @Table(name="achievements") 
 * **/
class AchievementEntity {
    
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     */
    protected $id;
    
    /**
     * @ManyToOne(targetEntity="RegistrantDataEntity", inversedBy="achievements")
     * @JoinColumn(name="registrant_id", referencedColumnName="id")
     **/
    private $registrant;
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $achievement;
    
    public function getId() {
        return $this->id;
    }

    public function getRegistrant() {
        return $this->registrant;
    }

    public function getAchievement() {
        return $this->achievement;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setRegistrant(RegistrantDataEntityEntity $registrant) {
        $this->registrant = $registrant;
        return $this;
    }

    public function setAchievement($achievement) {
        $this->achievement = $achievement;
        return $this;
    }


}
