<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * @context7 /codeigniter/filter
 * @description Filter to ensure only authenticated admins can access admin routes
 */
class AdminAuthFilter implements FilterInterface
{
    /**
     * @context7 /codeigniter/filter/method
     * @description Check if user is authenticated as admin before allowing access
     * @param RequestInterface $request
     * @param mixed $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('admin')) {
            session()->setFlashdata('errors', ['Akses dihentikan, Harap login Dulu!']);
            return redirect()->to('login/admin');
        }
        
        // Check if root access is required
        if (!empty($arguments) && in_array('root', $arguments)) {
            if (session()->get('admin')->getRoot() != true) {
                session()->setFlashdata('errors', ['Akses dihentikan, Anda tidak boleh melihat halaman Ini!']);
                return redirect()->to('admin');
            }
        }
    }

    /**
     * @context7 /codeigniter/filter/method
     * @description Nothing to do after controller
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param mixed $arguments
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}