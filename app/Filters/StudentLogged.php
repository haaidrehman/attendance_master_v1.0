<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class StudentLogged implements FilterInterface{

    public function before(RequestInterface $request, $arguments = null){
        $session = Services::session();
        if(! $session->get('isStdLogin')){
            return redirect()->to(base_url().'/student/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){

    }
}

?>