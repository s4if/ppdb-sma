<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Registrant_test extends TestCase
{
	public function test_index()
	{
		$output = $this->request('GET', ['Login', 'index']);
		$this->assertContains('<title>Registrasi PPDB SMAIT Ihsanul Fikri</title>', $output);
	}
        
        public function test_lihat()
	{
		$output = $this->request('GET', ['Pendaftar', 'lihat']);
		$this->assertContains('Data Pendaftar Ikhwan', $output);
                $output2 = $this->request('GET', 'lihat/P');
		$this->assertContains('Data Pendaftar Akhwat', $output2);
	}
        
        public function test_beranda_blocked()
        {
            $this->request('GET', '201511210001/beranda');
            $this->assertRedirect('login');
        }
        
        public function test_login_fail()
        {
            $this->request('POST', ['Login', 'do_login'],[
                'id_pendaftaran' => '00000000000',
                'password' => 'qwerty'
            ]);
            $this->assertRedirect('login/index');
        }
        
        public function test_login_ok()
        {
            $this->request('POST', ['Login', 'do_login'],[
                'id_pendaftaran' => '20141201001',
                'password' => 'qwerty'
            ]);
            $this->assertRedirect('20141201001/beranda');
        }
        
        public function test_logout(){
            $this->request('GET', 'login/do_logout');
            $this->assertRedirect('login/index');
        }
        
        public function test_ganti_password(){
            $this->request('POST', ['Login', 'do_login'],[
                'id_pendaftaran' => '20141201001',
                'password' => 'qwerty'
            ]);
            $output = $this->request('GET', '20141201001/password');
            $this->assertContains('<title>Password</title>', $output);
            $param = [
                'stored_password' => 'qwertyu',
                'new_password' => 'zaraki',
                'confirm_password' => 'qwerty'
            ];
            $this->request('POST', 'pendaftar/change_password/20141201001', $param);
            $this->assertRedirect('20141201001/password');
            $param['confirm_password'] = 'zaraki';
            $this->request('POST', 'pendaftar/change_password/20141201001', $param);
            $this->assertRedirect('20141201001/password');
            $param['stored_password'] = 'qwerty';
            $this->request('POST', 'pendaftar/change_password/20141201001', $param);
            $this->assertRedirect('20141201001/password');
        }
        
        public function test_beranda()
        {
            // Passwordnya sudah berubah
            $this->request('POST', ['Login', 'do_login'],[
                'id_pendaftaran' => '20141201001',
                'password' => 'zaraki'
            ]);
            $output = $this->request('GET','20141201001/beranda');
            $this->assertContains('<title>Beranda</title>', $output);
            $output2 = $this->request('GET','20141201001/detail');
            $this->assertContains('<title>Edit Data Diri</title>', $output2);
            $output3 = $this->request('GET','20141201001/data/father');
            $this->assertContains('<title>Edit Data Ayah</title>', $output3);
            $output4 = $this->request('GET','20141201001/data/mother');
            $this->assertContains('<title>Edit Data Ibu</title>', $output4);
            $output5 = $this->request('GET','20141201001/data/guardian');
            $this->assertContains('<title>Edit Data Wali</title>', $output5);
            $output6 = $this->request('GET','20141201001/rekap');
            $this->assertContains('<title>Rekap Data</title>', $output6);
            
        }
        
        public function test_register_gagal()
        {
            $this->request('GET', ['Login', 'index']);
            $param = [
                'password' => 'qwerty',
                'confirm-password' => 'salah',
                'name' => 'Andalus Setyorini',
                'sex' => 'P',
                'prev_school' => 'SMPN 1 Mungkid',
                'program' => 'Reguler',
                'captcha' => 'SALAH'
            ];
            $this->request('POST', ['Login', 'do_register'], $param);
            $this->assertRedirect('login/index');
            $param['confirm-password'] = 'qwerty';
            $this->request('POST', ['Login', 'do_register'], $param);
            $this->assertRedirect('login/index');
        }
        
        public function test_register_berhasil()
        {
            // TODO : Try to get session active?
        }

	public function test_method_404()
	{
		$this->request('GET', ['Welcome', 'method_not_exist']);
		$this->assertResponseCode(404);
	}

	public function test_APPPATH()
	{
		$actual = realpath(APPPATH);
		$expected = realpath(__DIR__ . '/../..');
		$this->assertEquals(
			$expected,
			$actual,
			'Your APPPATH seems to be wrong. Check your $application_folder in tests/Bootstrap.php'
		);
	}
}
