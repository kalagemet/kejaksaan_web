<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class IsAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
    	if (session()->islogin)
	    {
	        return redirect()->to(base_url('/cms'))->with('message', "Selamat Datang ".session()->name);
	    }
        // Do something here
    }
    
    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}