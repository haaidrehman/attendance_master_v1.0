<?php
namespace App\Filters;

use Config\Services;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class TeacherAuth implements FilterInterface{

    public function before(RequestInterface $request, $arguments = null){
        $session = Services::session();
        if(! $session->has('isStaffLoggedIn')){
            return redirect()->to(base_url().'/teacher/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
        
    }
}



?>