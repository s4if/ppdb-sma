<?php
/**
 * Part of CI PHPUnit Test
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/ci-phpunit-test
 */

class Pendaftar_test extends TestCase
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
            $this->request('GET', 'I1511001/beranda');
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
                'id_pendaftaran' => 'I1511001',
                'password' => 'qwerty'
            ]);
            $this->assertRedirect('I1511001/beranda');
        }
        
        public function test_logout(){
            $this->request('GET', 'login/do_logout');
            $this->assertRedirect('login/index');
        }
        
        public function test_ganti_password(){
            $this->request('POST', ['Login', 'do_login'],[
                'id_pendaftaran' => 'I1511001',
                'password' => 'qwerty'
            ]);
            $output = $this->request('GET', 'I1511001/password');
            $this->assertContains('<title>Password</title>', $output);
            $param = [
                'stored_password' => 'qwertyu',
                'new_password' => 'zaraki',
                'confirm_password' => 'qwerty'
            ];
            $this->request('POST', 'pendaftar/change_password/I1511001', $param);
            $this->assertRedirect('I1511001/password');
            $param['confirm_password'] = 'zaraki';
            $this->request('POST', 'pendaftar/change_password/I1511001', $param);
            $this->assertRedirect('I1511001/password');
            $param['stored_password'] = 'qwerty';
            $this->request('POST', 'pendaftar/change_password/I1511001', $param);
            $this->assertRedirect('I1511001/password');
        }
        
        public function test_beranda()
        {
            // Passwordnya sudah berubah
            $this->request('POST', ['Login', 'do_login'],[
                'id_pendaftaran' => 'I1511001',
                'password' => 'zaraki'
            ]);
            $output = $this->request('GET','I1511001/beranda');
            $this->assertContains('<title>Beranda</title>', $output);
            $output2 = $this->request('GET','I1511001/detail');
            $this->assertContains('<title>Edit Data Diri</title>', $output2);
            $output3 = $this->request('GET','I1511001/data/father');
            $this->assertContains('<title>Edit Data Ayah</title>', $output3);
            $output4 = $this->request('GET','I1511001/data/mother');
            $this->assertContains('<title>Edit Data Ibu</title>', $output4);
            $output5 = $this->request('GET','I1511001/data/guardian');
            $this->assertContains('<title>Edit Data Wali</title>', $output5);
            $output6 = $this->request('GET','I1511001/rekap');
            $this->assertContains('<title>Rekap Data</title>', $output6);
            $output7 = $this->request('GET','I1511001/surat');
            $this->assertContains('<title>Surat Pernyataan</title>', $output7);
            
        }
        
        public function test_register()
        {
            $this->request('GET', ['Login', 'index']);
            $param = [
                'password' => 'qwerty',
                'confirm-password' => 'salah',
                'name' => 'Samir Dzeko Saputra',
                'sex' => 'L',
                'cp' => '089483726156',
                'prev_school' => 'SMPN 1 Mungkid',
                'program' => 'Reguler',
                'captcha' => 'SALAH'
            ];
            // Gagal
            $this->request('POST', ['Login', 'do_register'], $param);
            $this->assertRedirect('login/index');
            
            // Note : Captcha tidak bisa diuji karena session tidak bisa konsisten
            
            //berhasil
            $param['confirm-password'] = 'qwerty';
            $this->request('POST', ['Login', 'do_register'], $param);
            $this->assertRedirect('login/register_berhasil');
        }
        
        public function test_isi_detail(){
            $this->request('POST', ['Login', 'do_login'],[
                'id_pendaftaran' => 'I1511001',
                'password' => 'zaraki'
            ]);
            $this->assertRedirect('I1511001/beranda');
            $data = [
                'birth_place' => 'Semarang', 
                'birth_date' => '19-2-2000', 
                'street' => 'Rambeanak II', 
                'RT' => 1,
                'RW' => 3, 
                'village' => 'Rambeanak', 
                'district' => 'Mungkid', 
                'city' => 'Kab. Magelang', 
                'province' => 'Jawa Tengah', 
                'postal_code' => 56551,
                'family_condition' => 'Yatim', 
                'nationality' => 'WNI', 
                'religion' => 'Islam', 
                'height' => 176, 
                'weight' => 57, 
                'stay_with' => 'Ortu',
                'hobbies' => ['makan', 'tidur', 'baca komik'],
                'achievements' => ['Juara 1 OSN Fisika SMP'],
                'physical_abnormalities' => ['Jentik kaki kiri diamputasi'],
                'hospital_sheets' => ['Pernah kecelakaan']
            ];
            $this->request('POST', 'pendaftar/do_edit_detail/I1511001', $data);
            $this->assertRedirect('I1511001/detail');
        }
        
        public function test_isi_Father(){
            $this->request('POST', ['Login', 'do_login'],[
                'id_pendaftaran' => 'I1511001',
                'password' => 'zaraki'
            ]);
            $this->assertRedirect('I1511001/beranda');
            $data = [
            'type' => 'father', 
            'name' => "Suraji", 
            'status' => 'Hidup', 
            'birth_place' => 'Blora', 
            'birth_date' => '12-12-1981',
            'street' => 'Rambeanak II', 
            'RT' => 1,
            'RW' => 3, 
            'village' => 'Rambeanak', 
            'district' => 'Mungkid', 
            'city' => 'Kab. Magelang', 
            'province' => 'Jawa Tengah', 
            'postal_code' => 56551,
            'contact' => '08965478865', 
            'relation' => 'Kandung', 
            'nationality' => 'WNI', 
            'religion' => 'ISLAM', 
            'education_level' => 'SMA', 
            'job' => 'Kuli Bangunan', 
            'position' => null, 
            'company' => null,
            'income' => '300000', 
            'burden_count' => 4
            ];
            $this->request('POST', 'pendaftar/do_edit_parent/I1511001/father', $data);
            $this->assertRedirect('I1511001/data/father');
        }
        
        public function test_isi_Mother(){
            $this->request('POST', ['Login', 'do_login'],[
                'id_pendaftaran' => 'I1511001',
                'password' => 'zaraki'
            ]);
            $this->assertRedirect('I1511001/beranda');
            $data = [
            'type' => 'mother', 
            'name' => "Suharsah", 
            'status' => 'Hidup', 
            'birth_place' => 'Blora', 
            'birth_date' => '12-11-1982',
            'street' => 'Rambeanak II', 
            'RT' => 1,
            'RW' => 3, 
            'village' => 'Rambeanak', 
            'district' => 'Mungkid', 
            'city' => 'Kab. Magelang', 
            'province' => 'Jawa Tengah', 
            'postal_code' => 56551,
            'contact' => '08965478865', 
            'relation' => 'Kandung', 
            'nationality' => 'WNI', 
            'religion' => 'ISLAM', 
            'education_level' => 'SMA', 
            'job' => 'Ibu Rumah Tangga', 
            'position' => null, 
            'company' => null,
            'income' => '0', 
            'burden_count' => 4
            ];
            $this->request('POST', 'pendaftar/do_edit_parent/I1511001/mother', $data);
            $this->assertRedirect('I1511001/data/mother');
        }
        
        public function test_isi_Guardian(){
            $this->request('POST', ['Login', 'do_login'],[
                'id_pendaftaran' => 'I1511001',
                'password' => 'zaraki'
            ]);
            $this->assertRedirect('I1511001/beranda');
            $data = [
            'type' => 'guardian', 
            'name' => "Rizaki Al Farisi", 
            'status' => 'Hidup', 
            'birth_place' => 'Blora', 
            'birth_date' => '15-11-1991',
            'street' => 'Sukarno No. 43', 
            'RT' => 1,
            'RW' => 3, 
            'village' => 'Kramat Utara', 
            'district' => 'Kramat', 
            'city' => 'Jakarta Utara', 
            'province' => 'DKI Jakarta', 
            'postal_code' => 56551,
            'contact' => '08965468864', 
            'relation' => 'Sepupu', 
            'nationality' => 'WNI', 
            'religion' => 'ISLAM', 
            'education_level' => 'S1', 
            'job' => 'Programmer', 
            'position' => 'Junior Programmer', 
            'company' => 'Google Indonesia',
            'income' => '7000000', 
            'burden_count' => 1
            ];
            $this->request('POST', 'pendaftar/do_edit_parent/I1511001/guardian', $data);
            $this->assertRedirect('I1511001/data/guardian');
        }
        
        public function test_isi_Pernyataan(){
            $this->request('POST', ['Login', 'do_login'],[
                'id_pendaftaran' => 'I1511001',
                'password' => 'zaraki'
            ]);
            $this->assertRedirect('I1511001/beranda');
            $data = [
                'raw_icost' => '-999',
                'other_icost' => '15000000',
                'raw_scost' => '-999',
                'other_scost' => '1300000',
                'main_parent' => 'father'
            ];
            $this->request('POST', 'pendaftar/isi_pernyataan/I1511001', $data);
            $this->assertRedirect('I1511001/surat');
        }
        
        public function test_finalisasi(){
            $this->request('POST', ['Login', 'do_login'],[
                'id_pendaftaran' => 'I1511001',
                'password' => 'zaraki'
            ]);
            $this->assertRedirect('I1511001/beranda');
            $this->request('GET', 'pendaftar/finalisasi/I1511001/true');
            $this->assertRedirect('I1511001/beranda');
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
