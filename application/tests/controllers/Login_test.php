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
 * Description of Login_test
 *
 * @author s4if
 */
class Login_test extends TestCase
{
    public function test_index()
    {
        $output = $this->request('GET', ['Login', 'index']);
        $this->assertContains('<title>Registrasi PPDB SMAIT Ihsanul Fikri</title>', $output);
        $output2 = $this->request('GET', ['Login', 'admin']);
        $this->assertContains('<title>Admin PPDB SMA</title>', $output2);
    }
   
    public function test_login_fail()
    {
        $this->request('POST', ['Login', 'do_login'],[
            'username' => '00000000000',
            'password' => 'qwerty'
        ]);
        $this->assertRedirect('login/index');
    }
        
    public function test_login_ok()
    {
        $this->request('POST', ['Login', 'do_login'],[
            'username' => 'hanan',
            'password' => 'qwerty'
        ]);
        $this->assertRedirect('1/beranda');
    }

    //public function test_logout(){
        //$this->request('GET', 'login/do_logout');
        //$this->assertRedirect('login/index');
    //}
    
    public function test_login_admin_fail()
    {
        $this->request('POST', ['Login', 'do_login_admin'],[
            'username' => 'admimin',
            'password' => 'qwerty'
        ]);
        $this->assertRedirect('login/admin');
        $this->request('POST', ['Login', 'do_login_admin'],[
            'username' => 'admin',
            'password' => 'qwertyio'
        ]);
        $this->assertRedirect('login/admin');
    }

    public function test_login_admin_ok()
    {
        $this->request('POST', ['Login', 'do_login_admin'],[
            'username' => 'admin',
            'password' => 'qwerty'
        ]);
        $this->assertRedirect('admin/beranda');
    }
        
}
