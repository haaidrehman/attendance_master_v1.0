<?php
namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class LoginModel extends Model{
    
    public $db;

    public function __construct(){
       $this->db = Database::connect(); 

    }

	public function verifyEmail($username){

       $builder = $this->db->table('admin');
       $builder->select('username');
       $builder->where($username);
       $result = $builder->get();
       if($result->getResultArray() != null){
          return $result->getResultArray();
       }
       else{
       	 return 0;
       }

	}


	public function verifyPassword($uname, $pass){
       $builder = $this->db->table('admin');
       $builder->select('password');
       $builder->where(['username' => $uname]);
       $result = $builder->get();
       if($result->getResultArray() != null){
       	$row = $result->getResultArray();
	       	if(password_verify($pass, $row[0]['password'])){
	       		return 1;
	       	 }  
	        else{
	       	    return 0;
	       }
       }
       
	}


  public function check_record_n_allow($data){
     $return_val = ['result' => null];
     $builder = $this->db->table($data['table']);
     if($data['table'] == 'student'){
        $builder->select('id, fname, lname, email, password');
        $builder->where(['email' => $data['email']]);
     }
     else{
        $builder->select('id, fname, lname, password');
        $builder->where(['username' => $data['username']]);
     }
     
     $r = $builder->get();
     if($r->getResultArray() != null){
        $row = $r->getResultArray();
        if(password_verify($data['password'], $row[0]['password'])){
           $return_val['result'] = 'success';
           $return_val['user_id'] = $row[0]['id'];
           $return_val['user_fname'] = $row[0]['fname'];
           $return_val['user_lname'] = $row[0]['lname'];
        }
        else{
           $return_val['result'] = 'p_unmatched';
        }
     }
     else{
        // u_a means unavailable
        $return_val['result'] = 'u_a';
        
     }
     return $return_val;
  }

  public function check_staff_username($data){
   $return_val = ['result' => null];
   $builder = $this->db->table('teacher');
   $builder->select('id, fname, lname, email, password');
   $builder->where(['email' => $data['email']]);
   $r = $builder->get();
   if($r->getResultArray() != null){
      $row = $r->getResultArray();
      if(password_verify($data['password'], $row[0]['password'])){
         $return_val['result'] = 'success';
         $return_val['user_id'] = $row[0]['id'];
         $return_val['user_fname'] = $row[0]['fname'];
         $return_val['user_lname'] = $row[0]['lname'];
      }
      else{
         $return_val['result'] = 'p_unmatched';
      }
   }
  }

}

?>