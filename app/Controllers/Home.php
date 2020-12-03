<?php 

namespace App\Controllers;

class Home extends BaseController
{
	public function __construct(){
		helper('form');
	}

	public function index(){
		return view('home_page');
	}

	//--------------------------------------------------------------------
    
    public function admin(){
    	echo view('login');
    }

    public function admin_login(){
    	echo view('admin/login');
    }
}
