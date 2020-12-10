<?php
namespace App\Filters;

use Config\Services;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class TeacherLogged implements FilterInterface{

    public function before(RequestInterface $request, $argument = null){
        $session = Services::session();
        if($session->has('isStaffLoggedIn')){
            return redirect()->to(base_url().'/teacher/dashboard')->with('already_loggedIn', 'You are already logged in', 2);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $argument = null){

    }
}

?>