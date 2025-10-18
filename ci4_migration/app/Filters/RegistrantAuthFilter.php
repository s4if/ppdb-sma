<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * @context7 /codeigniter/filter
 * @description Filter to ensure only authenticated registrants can access registrant routes
 */
class RegistrantAuthFilter implements FilterInterface
{
    /**
     * @context7 /codeigniter/filter/method
     * @description Check if user is authenticated as registrant before allowing access
     * @param RequestInterface $request
     * @param mixed $arguments
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('registrant')) {
            session()->setFlashdata('errors', ['Akses dihentikan, Harap login Dulu!']);
            return redirect()->to('login');
        }
        
        // Get the registrant ID from the route parameters
        $registrantId = $request->uri->getSegment(1);
        
        // Check if the logged-in user is trying to access their own data
        if (session()->get('registrant')->getId() != $registrantId) {
            // Check if admin bypass is allowed
            if (session()->has('admin') && !empty($arguments) && in_array('admin-bypass', $arguments)) {
                return; // Allow admin access
            }
            
            session()->setFlashdata('errors', ['Akses dihentikan, Anda tidak boleh melihat halaman Orang Lain!']);
            return redirect()->to(session()->get('registrant')->getId() . '/beranda');
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