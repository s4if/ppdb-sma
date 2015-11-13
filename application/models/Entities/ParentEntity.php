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
 * @Entity @Table(name="parents")
*/
class ParentEntity {
    
    /**
     * @Id @GeneratedValue(strategy="AUTO") @Column(type="integer")
     * @var int
     */
    protected $id;
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $type;
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $name;
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $status; //hidup, cerai, almarhum
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $birthPlace;
    
    /**
     * @Column(type="date", nullable=FALSE)
     * @var Date
     */
    protected $birthDate;
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $address;
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $contactAddress;
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $relation; // hubungan dengan pendaftar (kandung, angkat, tiri)
    
    /**
     * @Column(type="string", length=4, nullable=FALSE)
     * @var string
     */
    protected $nationality;
    
    /**
     * @Column(type="string", length=10, nullable=FALSE)
     * @var string
     */
    protected $religion;
    
    /**
     * @Column(type="string", length=10, nullable=FALSE)
     * @var string
     */
    protected $educationLevel; // tingkat pendidikan, sd, smp .. s3
    
    /**
     * @Column(type="string", nullable=TRUE)
     * @var string
     */
    protected $spciality; // jurusan kuliah/sma
    
    /**
     * @Column(type="string", nullable=FALSE)
     * @var string
     */
    protected $job;
    
    /**
     * @Column(type="string", nullable=TRUE)
     * @var string
     */
    protected $position;
    
    /**
     * @Column(type="string", nullable=TRUE)
     * @var string
     */
    protected $company;
    
    /**
     * @Column(type="string", nullable=TRUE)
     * @var string
     */
    protected $companyAddress;
    
    /**
     * @Column(type="integer", nullable=FALSE)
     * @var string
     */
    protected $income;
    
    /**
     * @Column(type="integer", nullable=FALSE)
     * @var string
     */
    protected $burdenCount;
    
}
