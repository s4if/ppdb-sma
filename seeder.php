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

(PHP_SAPI !== 'cli' || isset($_SERVER['HTTP_USER_AGENT'])) && die('cli only');

error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';


define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
define('BASEPATH', __DIR__ . '/vendor/codeigniter/framework/system/');
define('APPPATH', __DIR__ . '/application/');

require APPPATH . 'libraries/Doctrine.php';
$doctrine = new Doctrine();
$em = $doctrine->em;

// Registrant Seeder
$reg = new RegistrantEntity();
$reg->setId('20141201001');
$reg->setName('Ardiyan Hananto');
$reg->setSex('L');
$reg->setNisn(2010249129310);
$reg->setPassword(password_hash('qwerty', PASSWORD_BCRYPT));
$reg->setPreviousSchool('SMP IT Ihsanul FIkri Mungkid');
$reg->setProgram('Reguler');
$reg->setRegistrationTime(new DateTime('now'));
$em->persist($reg);
$em->flush();
// =======================================
// Registrant Data Seeder
$rData = new RegistrantDataEntity();
$rData->setAddress('Magelang');
$rData->setBirthDate(new Datetime('12-3-1999'));
$rData->setBirthPlace('Jombang');
$rData->setFamilyCondition('Lengkap');
$rData->setHeight(179);
$rData->setNationality("WNI");
$rData->setRegistrant($reg);
$rData->setReligion('Islam');
$rData->setStayWith('Ortu');
$rData->setWeight(66);
$em->persist($rData);
$em->flush();
// =======================================
// Registrant Father Seeder
$pData = new ParentEntity();
$pData->setName("Sukirjo");
$pData->setStatus('masih hidup');
$pData->setRelation('kandung');
$pData->setReligion('Islam');
$pData->setType('father');
$pData->setBirthDate(new DateTime('19-2-1983'));
$pData->setBirthPlace('Magelang');
$pData->setAddress('Mertoyudan, Magelang');
$pData->setEducationLevel('SMP');
$pData->setContact('+628572737172717');
$pData->setNationality('WNI');
$pData->setJob('Tukang Kayu');
$pData->setIncome('900000');
$pData->setBurdenCount('3');
$em->persist($pData);
$reg->setFather($pData);
$em->persist($reg);
$em->flush();
// =======================================
// Registrant Mother Seeder
$pData = new ParentEntity();
$pData->setName("Suharsimi");
$pData->setStatus('almarhum');
$pData->setRelation('kandung');
$pData->setReligion('Islam');
$pData->setType('mother');
$pData->setNationality('WNI');
$pData->setBirthDate(new DateTime('17-3-1985'));
$pData->setBirthPlace('Magelang');
$pData->setAddress('Mertoyudan, Magelang');
$pData->setEducationLevel('S1');
$pData->setBurdenCount('3');
$em->persist($pData);
$reg->setMother($pData);
$em->persist($reg);
$em->flush();
// =======================================
// Registrant GUardian Seeder
$pData = new ParentEntity();
$pData->setName("Rizki Djamaludin");
$pData->setStatus('masih hidup');
$pData->setRelation('sepupu');
$pData->setReligion('Islam');
$pData->setType('guardian');
$pData->setNationality('WNI');
$pData->setBirthDate(new DateTime('19-2-1993'));
$pData->setBirthPlace('Magelang');
$pData->setAddress('Mertoyudan, Magelang');
$pData->setEducationLevel('S1');
$pData->setContact('+628572737172231');
$pData->setJob('Desainer Grafis');
$pData->setCompany('Freelancer Alliance');
$pData->setPosition('Head Designer');
$pData->setCompanyAddress('Jakarta');
$pData->setIncome('9000000');
$pData->setBurdenCount('1');
$em->persist($pData);
$reg->setGuardian($pData);
$em->persist($reg);
$em->flush();