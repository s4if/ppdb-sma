<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Welcome_test extends TestCase
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
