<?php

/*
 * The MIT License
 *
 * Copyright 2016 s4if.
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
 * Description of Admin_test
 *
 * @author s4if
 */
class Admin_test extends TestCase{
    public function test_index()
    {
        $output = $this->request('GET', ['Login', 'admin']);
        $this->assertContains('<title>Registrasi PPDB SMAIT Ihsanul Fikri</title>', $output);
    }
    
    public function test_lihat_halaman()
    {
        $this->request('POST', ['Login', 'do_login_admin'],[
            'username' => 'admin',
            'password' => 'qwerty'
        ]);
        $output = $this->request('GET','admin/beranda');
        $this->assertContains('<title>Beranda</title>', $output);
        $output = $this->request('GET','admin/lihat');
        $this->assertContains('<title>Lihat Pendaftar </title>', $output);
        $output = $this->request('GET','admin/lihat/L');
        $this->assertContains('<title>Lihat Pendaftar Ikhwan</title>', $output);
        $output = $this->request('GET','admin/lihat/P');
        $this->assertContains('<title>Lihat Pendaftar Akhwat</title>', $output);
        $output = $this->request('GET','admin/pembayaran');
        $this->assertContains('<title>Lihat Resi Pembayaran</title>', $output);
//        $output = $this->request('GET','admin/registrant/I1511001');
//        $this->assertContains('<title>Profil Pendaftar</title>', $output);
        $output = $this->request('GET','admin/password');
        $this->assertContains('<title>Password</title>', $output);
    }
    
    public function test_lihat_ajax()
    {
        $this->request('POST', ['Login', 'do_login_admin'],[
            'username' => 'admin',
            'password' => 'qwerty'
        ]);
        $output = $this->ajaxRequest('POST', ['admin', 'beranda_ajax']);
        $this->assertContains('"data":', $output);
        $output = $this->ajaxRequest('POST', ['admin', 'lihat_ajax']);
        $this->assertContains('"data":', $output);
    }
}
