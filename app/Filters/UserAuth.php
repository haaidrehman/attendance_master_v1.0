<?php
namespace App\Filters;

use Config\Services;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


class UserAuth implements FilterInterface{
       
    public function before(RequestInterface $request, $arguments = null){
        $session = Services::session();
         if(! $session->getTempdata('reg_success')){
            return redirect()->to(base_url('/register'));
         }
         
         
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){

    }
}


?>