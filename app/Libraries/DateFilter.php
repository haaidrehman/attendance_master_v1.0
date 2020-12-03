<?php

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class DateFilter implements FilterInterface{
    
    public function before(RequestInterface $request){
        echo date('Y-m-d h:i:s');
    }

    public function after(RequestInterface $request, ResponseInterface $response){
        
    }
}

?>