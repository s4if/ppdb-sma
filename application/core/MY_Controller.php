<?php

defined('BASEPATH') or exit('No direct script access allowed');
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
 * Description of MY_Controller.
 *
 * @author s4if
 */
class MY_Controller extends CI_Controller
{
    /*
     * CDN itu untuk memilih menggunakan CDN ato tidak...
     */
    const CDN = false;
    protected $data;

    public function __construct()
    {
        parent::__construct();
        setlocale(LC_ALL, 'id_ID');
        $this->data['cdn'] = FALSE;
        $this->data['nama_sekolah'] = $this->config->item('nama_sekolah');
        $this->data['nama_gelombang'] = $this->config->item('nama_gelombang');
        $this->data['indeks_gelombang'] = $this->config->item('indeks_gelombang');
        $tahun_pasangan = $this->config->item('tahun_masuk')+1;
        $this->data['tahun_ajaran'] = $this->config->item('tahun_masuk').'/'.$tahun_pasangan;
        $this->data['tahun_masuk'] = $this->config->item('tahun_masuk');
    }

    protected function simpleView($view_name, $inp_data = [])
    {
        $data = array_merge($this->data, $inp_data);
        $this->load->view($view_name, $data);
    }

    protected function CustomView($view_name, $inp_data = [])
    {
        $data = array_merge($this->data, $inp_data);
        $fragment['header'] = $this->load->view('core/header', $data, true);
        $fragment['navbar'] = $this->load->view('core/navbar', $data, true);
        $fragment['alert'] = $this->load->view('core/alert', $data, true);
        $fragment['content'] = $this->load->view($view_name, $data, true);
        $fragment['footer'] = $this->load->view('core/footer', $data, true);
        $this->load->view('core/skeleton', $fragment);
    }

    //nilai true jika hanya bisa diakses setelah login
    protected function blockLoggedOne()
    {
        if ($this->session->has_userdata('registrant')) {
            $this->session->set_flashdata('errors', [0 => "Akses dihentikan, <br \>"
                .'Tidak boleh mengakses halaman login jika sesi belum berakhir', ]);
            redirect('pendaftar/home', 'refresh');
        }
    }

    protected function blockUnloggedOne($id, $adminBypass = false)
    {
        if ($this->session->has_userdata('admin') && $adminBypass) {
            // Do Nothing
        } else {
            if (!$this->session->has_userdata('registrant')) {
                $this->session->set_flashdata('errors', [0 => 'Akses dihentikan, Harap login Dulu!']);
                redirect('login', 'refresh');
            } elseif (!($this->session->registrant->getId() == $id)) {
                $this->session->set_flashdata('errors', [0 => 'Akses dihentikan, Anda tidak boleh melihat halaman Orang Lain!']);
                redirect($this->session->registrant->getId().'/beranda', 'refresh');
            } else {
                // Do Nothing
            }
        }
    }

    protected function blockNonAdmin($root = false)
    {
        if (!$this->session->has_userdata('admin')) {
            $this->session->set_flashdata('errors', [0 => 'Akses dihentikan, Harap login Dulu!']);
            redirect('login/admin', 'refresh');
        } elseif (($this->session->admin->getRoot() == $root || !$root)) {
            // Do Nothing
        } else {
            $this->session->set_flashdata('errors', [0 => 'Akses dihentikan, Anda tidak boleh melihat halaman Ini!']);
            redirect('admin', 'refresh');
        }
    }
    
    protected function blockNonPayers($registrant){
        if(is_null($registrant->getPaymentData())){
            $this->session->set_flashdata('errors', [0 => 'Akses dihentikan, Harap Harap Membayar Dulu!']);
            redirect($registrant->getId().'/beranda', 'refresh');
        }
    }

    protected function pdfOption()
    {
        $options = [
            'page-size' => 'A4',
            'dpi' => 96,
            'image-quality' => 100,
            'margin-top' => '10mm',
            'margin-right' => '20mm',
            'margin-bottom' => '10mm',
            'margin-left' => '20mm',
            'header-spacing' => 15,
            'footer-spacing' => 5,
            'disable-smart-shrinking',
            'no-outline',
            'enable-local-file-access',
            'commandOptions' => [
                'enableXvfb' => true,//ini hanya kalau perlu
            ],
        ];

        return $options;
    }

    protected function getSurat($biaya_variabel = [], $laman_isi = false)
    {
        $converter = new \League\CommonMark\GithubFlavoredMarkdownConverter();
        $html = "";
        $biaya_tetap = $this->config->item('biaya_tetap');
        $biaya = [];
        if ($laman_isi) {
            $lines = file(APPPATH.'views/markdown/surat_pernyataan.md');
            array_pop($lines);
            $md = join("",$lines);
            $default = [
                'infaq_pendidikan',
                'spp_bulanan',
                'wakaf_tanah'
            ];
            $biaya = $biaya_tetap;
            foreach ($default as $key){
                $md = str_replace(':'.$key.':', '**[[Sesuai Pilihan]]**', $md);
            }
        } else {
            $md = file_get_contents(APPPATH.'views/markdown/surat_pernyataan.md');
            $biaya = array_merge($biaya_tetap, $biaya_variabel);
            $total = array_sum($biaya);
            $biaya['total'] = $total;
        }
        $html = $converter->convert($md);
        foreach ($biaya as $key => $value) {
            $html = str_replace(':'.$key.':', 'Rp.'.number_format($value, 0, ',', '.').',-', $html);
        }
        return $html;
    }
}
