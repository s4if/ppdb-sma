<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * @context7 /codeigniter/controller
 * @description Base controller with common functionality for all controllers
 * @example
 * class MyController extends BaseController
 * {
 *     public function index() {
 *         return view('welcome_message');
 *     }
 * }
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * @context7 /codeigniter/controller/property
     * @description Holds data to be passed to views
     * @var array
     */
    protected $data = [];

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['html', 'form', 'url'];

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        
        // Set common data
        $this->data['nama_sekolah'] = config('App')->schoolName ?? 'SMAIT Ihsanul Fikri';
        $this->data['nama_gelombang'] = config('App')->waveName ?? 'Gelombang 1';
        $this->data['indeks_gelombang'] = config('App')->waveIndex ?? 1;
        $tahun_pasangan = (config('App')->entryYear ?? 2024) + 1;
        $this->data['tahun_ajaran'] = (config('App')->entryYear ?? 2024) . '/' . $tahun_pasangan;
        $this->data['tahun_masuk'] = config('App')->entryYear ?? 2024;
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Load view with common template structure
     * @param string $view View file name
     * @param array $data Data to pass to view
     * @return string Rendered view
     */
    protected function renderView($view, $data = [])
    {
        $data = array_merge($this->data, $data);
        
        return view('templates/header', $data) .
               view('templates/navbar', $data) .
               view('templates/alert', $data) .
               view($view, $data) .
               view('templates/footer', $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Load simple view without template structure
     * @param string $view View file name
     * @param array $data Data to pass to view
     * @return string Rendered view
     */
    protected function simpleView($view, $data = [])
    {
        $data = array_merge($this->data, $data);
        return view($view, $data);
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Block access if user is already logged in
     */
    protected function blockLoggedOne()
    {
        if (session()->has('registrant')) {
            session()->setFlashdata('errors', ['Akses dihentikan, Tidak boleh mengakses halaman login jika sesi belum berakhir']);
            return redirect()->to('pendaftar/home');
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Block access if user is not logged in
     * @param int $id Registrant ID to check
     * @param bool $adminBypass Allow admin access
     */
    protected function blockUnloggedOne($id, $adminBypass = false)
    {
        if (session()->has('admin') && $adminBypass) {
            return;
        }
        
        if (!session()->has('registrant')) {
            session()->setFlashdata('errors', ['Akses dihentikan, Harap login Dulu!']);
            return redirect()->to('login');
        } elseif (session()->get('registrant')->getId() != $id) {
            session()->setFlashdata('errors', ['Akses dihentikan, Anda tidak boleh melihat halaman Orang Lain!']);
            return redirect()->to(session()->get('registrant')->getId() . '/beranda');
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Block access if user is not admin
     * @param bool $root Require root admin access
     */
    protected function blockNonAdmin($root = false)
    {
        if (!session()->has('admin')) {
            session()->setFlashdata('errors', ['Akses dihentikan, Harap login Dulu!']);
            return redirect()->to('login/admin');
        } elseif (session()->get('admin')->getRoot() == $root || !$root) {
            return;
        } else {
            session()->setFlashdata('errors', ['Akses dihentikan, Anda tidak boleh melihat halaman Ini!']);
            return redirect()->to('admin');
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Block access if user hasn't paid
     * @param object $registrant Registrant object
     */
    protected function blockNonPayers($registrant)
    {
        if (is_null($registrant->getPaymentData())) {
            session()->setFlashdata('errors', ['Akses dihentikan, Harap Membayar Dulu!']);
            return redirect()->to($registrant->getId().'/beranda');
        }
    }

    /**
     * @context7 /codeigniter/controller/method
     * @description Get PDF options for mPDF
     * @return array PDF options
     */
    protected function pdfOption()
    {
        return [
            'mode' => 'utf-8',
            'format' => 'A4',
            'orientation' => 'P',
            'margin_top' => 10,
            'margin_right' => 20,
            'margin_bottom' => 10,
            'margin_left' => 20,
            'dpi' => 96,
            'image-quality' => 100,
        ];
    }
}
