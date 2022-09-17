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
		$this->assertStringContainsString('<title>Registrasi PPDB SMAIT Ihsanul Fikri</title>', $output);
	}
        
        public function test_lihat()
	{
		$output = $this->request('GET', ['Pendaftar', 'lihat']);
		$this->assertStringContainsString('Data Pendaftar Ikhwan', $output);
                $output2 = $this->request('GET', 'lihat/P');
		$this->assertStringContainsString('Data Pendaftar Akhwat', $output2);
	}
        
        public function test_beranda_blocked()
        {
            $this->request('GET', '1/beranda');
            $this->assertRedirect('login');
        }
        
        public function test_ganti_password(){
            $this->request('POST', ['Login', 'do_login'],[
                'username' => 'hanan',
                'password' => 'qwerty'
            ]);
            $output = $this->request('GET', '1/password');
            $this->assertStringContainsString('<title>Password</title>', $output);
            $param = [
                'stored_password' => 'qwertyu',
                'new_password' => 'zaraki',
                'confirm_password' => 'qwerty'
            ];
            $this->request('POST', 'pendaftar/change_password/1', $param);
            $this->assertRedirect('1/password');
            $param['confirm_password'] = 'zaraki';
            $this->request('POST', 'pendaftar/change_password/1', $param);
            $this->assertRedirect('1/password');
            $param['stored_password'] = 'qwerty';
            $this->request('POST', 'pendaftar/change_password/1', $param);
            $this->assertRedirect('1/password');
        }
        
        public function test_lihat_halaman()
        {
            // Passwordnya sudah berubah
            $this->request('POST', ['Login', 'do_login'],[
                'username' => 'hanan',
                'password' => 'zaraki'
            ]);
            $output = $this->request('GET','1/beranda');
            $this->assertStringContainsString('<title>Beranda</title>', $output);
            $output2 = $this->request('GET','1/password');
            $this->assertStringContainsString('<title>Password</title>', $output2);
            $output5 = $this->request('GET','1/formulir');
            $this->assertStringContainsString('<title>Formulir</title>', $output5);
            $this->assertStringContainsString('<td id="reg-gender"> Ikhwan </td>', $output5);
            $this->assertStringContainsString('<strong class="red">Data Ayah</strong>', $output5);
            $this->assertStringContainsString('<strong class="red">Data Ibu</strong>', $output5);
            $output6 = $this->request('GET','1/rekap');
            $this->assertStringContainsString('<title>Rekap Data</title>', $output6);
            $output7 = $this->request('GET','1/surat');
            $this->assertStringContainsString('<title>Surat Pernyataan</title>', $output7);
            
        }
        
        public function test_register()
        {
            $this->request('GET', ['Login', 'index']);
            $param = [
                'password' => 'qwerty',
                'username' => 'dzeko',
                'confirm-password' => 'salah',
                'name' => 'Samir Dzeko Saputra',
                'gender' => 'L',
                'cp_prefix'=> '+62',
                'cp_suffix' => '89483726156',
                'prev_school' => 'SMPN 1 Mungkid',
                'program' => 'IPA Reguler',
                'captcha' => 'SALAH'
            ];
            // Gagal
            $this->request('POST', ['Login', 'do_register'], $param);
            $this->assertRedirect('login/index');
            
            // Note : Captcha tidak bisa diuji karena session tidak bisa konsisten
            
            // Berhasil
            $param['confirm-password'] = 'qwerty';
            $this->request('POST', ['Login', 'do_register'], $param);
            $this->assertRedirect('login/register_berhasil');
            $this->request('POST', ['Login', 'do_register'], $param);
            $this->assertRedirect('login/index');
            
        }
        
        public function test_isi_detail(){
            $this->request('POST', ['Login', 'do_login'],[
                'username' => 'hanan',
                'password' => 'zaraki'
            ]);
            $this->assertRedirect('1/beranda');
            $data = [
                'nik' => '3304939390029302',
                'nkk' => '3302300204930302',
                'nak' => '3304939393999281',
                'blood_type' => 'AB', 
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
                'child_order' => 3,
                'siblings_count' => 3,
                'stay_with' => 'Ortu',
                'hobbies' => ['makan', 'tidur', 'baca komik'],
                'achievements' => ['Juara 1 OSN Fisika SMP'],
                'physical_abnormalities' => ['Jentik kaki kiri diamputasi'],
                'hospital_sheets' => ['Pernah kecelakaan'],
                //father
                'father_name' => "Suraji", 
                'father_status' => 'Hidup', 
                'father_birth_place' => 'Blora', 
                'father_birth_date' => '1981',
                'father_street' => 'Rambeanak II', 
                'father_RT' => 1,
                'father_RW' => 3, 
                'father_village' => 'Rambeanak', 
                'father_district' => 'Mungkid', 
                'father_city' => 'Kab. Magelang', 
                'father_province' => 'Jawa Tengah', 
                'father_postal_code' => 56551,
                'father_contact' => '08965478865', 
                'father_relation' => 'Kandung', 
                'father_nationality' => 'WNI', 
                'father_religion' => 'ISLAM', 
                'father_education_level' => 'SMA', 
                'father_job' => 'Kuli Bangunan', 
                'father_position' => null, 
                'father_company' => null,
                'father_income' => '300000', 
                'father_burden_count' => 4,
                //mother
                'mother_name' => "Suharsah", 
                'mother_status' => 'Hidup', 
                'mother_birth_place' => 'Blora', 
                'mother_birth_date' => '1982',
                'mother_street' => 'Rambeanak II', 
                'mother_RT' => 1,
                'mother_RW' => 3, 
                'mother_village' => 'Rambeanak', 
                'mother_district' => 'Mungkid', 
                'mother_city' => 'Kab. Magelang', 
                'mother_province' => 'Jawa Tengah', 
                'mother_postal_code' => 56551,
                'mother_contact' => '08965478865', 
                'mother_relation' => 'Kandung', 
                'mother_nationality' => 'WNI', 
                'mother_religion' => 'ISLAM', 
                'mother_education_level' => 'SMA', 
                'mother_job' => 'Ibu Rumah Tangga', 
                'mother_position' => null, 
                'mother_company' => null,
                'mother_income' => 1, 
                'mother_burden_count' => 4,                
            ];
            $output = $this->ajaxRequest('POST', 'pendaftar/ajax_edit_all/1', $data);
            $this->assertStringContainsString('"status":true', $output);
            $this->setUp();
            $data['village'] = null;
            $output2 = $this->ajaxRequest('POST', 'pendaftar/ajax_edit_all/1', $data);
            $this->assertStringContainsString('"status":false', $output2);
            $data['village'] = 'Rambeanak';
            $data['mother_village'] = null;
            $output3 = $this->ajaxRequest('POST', 'pendaftar/ajax_edit_all/1', $data);
            $this->assertStringContainsString('"status":false', $output3);
            $data['mother_village'] = 'Rambeanak';
            $data['father_village'] = null;
            $output4 = $this->ajaxRequest('POST', 'pendaftar/ajax_edit_all/1', $data);
            $this->assertStringContainsString('"status":false', $output4);
            $data['father_village'] = 'Rambeanaak';
            $output5 = $this->ajaxRequest('POST', 'pendaftar/ajax_edit_all/1', $data);
            $this->assertStringContainsString('"status":true', $output5);
        }
        
        public function test_generate_kode(){
            $this->request('POST', ['Login', 'do_login'],[
                'username' => 'hanan',
                'password' => 'zaraki'
            ]);
            $this->assertRedirect('1/beranda');
            $output = $this->ajaxRequest('POST', 'pendaftar/generate_kodeunik/1/L');
            $this->assertStringContainsString('"status":true', $output);
            $this->assertStringContainsString('"kode":"001"', $output);
        }
        
//        public function test_isi_Guardian(){
//            $this->request('POST', ['Login', 'do_login'],[
//                'username' => 'hanan',
//                'password' => 'zaraki'
//            ]);
//            $this->assertRedirect('1/beranda');
//            $data = [
//            'type' => 'guardian', 
//            'name' => "Rizaki Al Farisi", 
//            'status' => 'Hidup', 
//            'birth_place' => 'Blora', 
//            'birth_date' => '15-11-1991',
//            'street' => 'Sukarno No. 43', 
//            'RT' => 1,
//            'RW' => 3, 
//            'village' => 'Kramat Utara', 
//            'district' => 'Kramat', 
//            'city' => 'Jakarta Utara', 
//            'province' => 'DKI Jakarta', 
//            'postal_code' => 56551,
//            'contact' => '08965468864', 
//            'relation' => 'Sepupu', 
//            'nationality' => 'WNI', 
//            'religion' => 'ISLAM', 
//            'education_level' => 'S1', 
//            'job' => 'Programmer', 
//            'position' => 'Junior Programmer', 
//            'company' => 'Google Indonesia',
//            'income' => '7000000', 
//            'burden_count' => 1
//            ];
//            $output = $this->ajaxRequest('POST', 'pendaftar/ajax_edit_parent/1/guardian', $data);
//            $this->assertStringContainsString('"status":true', $output);
//        }
        
        public function test_isi_rapor(){
            $this->request('POST', ['Login', 'do_login'],[
                'username' => 'hanan',
                'password' => 'zaraki'
            ]);
            $this->assertRedirect('1/beranda');
            $data = [
                'kkm_ipa_1' => 80,
                'kkm_ipa_2' => 80,
                'kkm_ipa_3' => 80,
                'kkm_ipa_4' => 80,
                'kkm_ips_1' => 80,
                'kkm_ips_2' => 80,
                'kkm_ips_3' => 80,
                'kkm_ips_4' => 80,
                'kkm_ing_1' => 80,
                'kkm_ing_2' => 80,
                'kkm_ing_3' => 80,
                'kkm_ing_4' => 80,
                'kkm_ind_1' => 80,
                'kkm_ind_2' => 80,
                'kkm_ind_3' => 80,
                'kkm_ind_4' => 80,
                'kkm_mtk_1' => 80,
                'kkm_mtk_2' => 80,
                'kkm_mtk_3' => 80,
                'kkm_mtk_4' => 80,
                'nilai_ipa_1' => 85,
                'nilai_ipa_2' => 85,
                'nilai_ipa_3' => 85,
                'nilai_ipa_4' => 85,
                'nilai_ips_1' => 85,
                'nilai_ips_2' => 85,
                'nilai_ips_3' => 85,
                'nilai_ips_4' => 85,
                'nilai_ing_1' => 85,
                'nilai_ing_2' => 85,
                'nilai_ing_3' => 85,
                'nilai_ing_4' => 85,
                'nilai_ind_1' => 85,
                'nilai_ind_2' => 85,
                'nilai_ind_3' => 85,
                'nilai_ind_4' => 85,
                'nilai_mtk_1' => 85,
                'nilai_mtk_2' => 85,
                'nilai_mtk_3' => 85,
                'nilai_mtk_4' => 85,
            ];
            $this->request('POST', 'pendaftar/edit_rapor/1', $data);
            $this->assertRedirect('1/surat');
        }
        
        public function test_isi_Pernyataan(){
            $this->request('POST', ['Login', 'do_login'],[
                'username' => 'hanan',
                'password' => 'zaraki'
            ]);
            $this->assertRedirect('1/beranda');
            $data = [
                'rel_to_regular' => 'true',
                'rel_to_ips' => 'true',
                'raw_icost' => -999,
                'other_icost' => 15000000,
                'raw_scost' => -999,
                'other_scost' => 1300000,
                'raw_lcost' => -999,
                'other_lcost' => 10000000,
                'qurban'=> '2022-2023',
                'main_parent' => 'father'
            ];
            $this->request('POST', 'pendaftar/isi_pernyataan/1', $data);
            $this->assertRedirect('1/rekap');
        }
        
        public function test_finalisasi(){
            $this->request('POST', ['Login', 'do_login'],[
                'username' => 'hanan',
                'password' => 'zaraki'
            ]);
            $this->assertRedirect('1/beranda');
            $this->request('GET', 'pendaftar/finalisasi/1/true');
            $this->assertRedirect('1/beranda');
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
