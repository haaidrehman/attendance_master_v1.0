<?php 
namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class RegisterModel extends Model{
   
   public $db;

   public function __construct(){
   	 $this->db = Database::connect();
   }
   
   public function get_all_staff(){
      $row = false;
      $builder = $this->db->table('teacher');
      $builder->select('teacher.id, fname, lname, gender, added_on, email, phone, status, class, subjects.name');
      $builder->join('subjects', 'teacher.subject_id = subjects.id', 'left');
      $builder->orderBy('teacher.id', 'ASC');
      $r = $builder->get();
      if($r->getResultArray() != null){
         $row = $r->getResultArray();
      }
      return $row;
   }


   public function email_exists($data, $table = ''){
      $default_table = 'new_registration'; 
      $col = 'email';
      $con = '';
      $email = $data['email'];

      function orwhereCon($con = null, $builder = null){
            if($con != null && $builder != null){
               foreach($con as $k => $v){
                  $builder->orWhere([$k => $v]);
               }
            }
         }
         
      if(!empty($table)){
         $default_table = $table;
         $col = 'phone, email, username';
         $con = ['phone' => $data['phone'], 'username' => $data['username']];
  
      }
      
      $builder = $this->db->table($default_table);
      $builder->select($col);
      $builder->where(['email' => $email]);
      
      orwhereCon($con, $builder);
      
      $result = $builder->get();
      if($result->getResultArray() != null){
         $row = [];
         $row['row'] = $result->getResultArray();
         $row['status'] = 0;
         return $row;
      }
      else{
      	$row['status'] = 1;
         return $row;
      }
   }

   public function isEmailExist($data){
      $builder = $this->db->table($data['table']);
      $builder->select('fname, lname, token');
      $builder->where(['email' => $data['email'], 'status' => 'inactive']);
      $r = $builder->get();
      if($r->getRow() != null){
         return $r->getRow();
      }
      else{
         return false;
      }
   }

   
   public function insert_data($data, $table = ''){
       $default_table = 'new_registration';
       if(!empty($table)){
         $default_table = $table;

            $builder = $this->db->table($default_table);
         $r = $builder->insert($data);
         return $r;
       }
       else{
         $builder = $this->db->table($default_table);
         $builder->select('id');
         $builder->where(['phone' => $data['phone']]);
         $r = $builder->get();
         if($r->getRow() != null){
            return false;
         }
         else{
            $r = $builder->insert($data);
            return $r;
         }
       }
   	 
   }

   public function checkToken($uniqid){
      $builder = $this->db->table('teacher');
      $builder->select('status, token, activation_date');
      $builder->where(['token' => $uniqid]);
      $r = $builder->get();
      if($r->getRow() != null){
         return $r->getRow();
      }
      else{
         return false;
      }
   }

   public function activateStatus($uniqid){
      $status = false;
      $builder = $this->db->table('teacher');
      $builder->where(['token' =>$uniqid, 'status' => 'inactive']);
      $r = $builder->update(['status' => 'active']);
      if($r){
         $status = true;
      }
      return $status;
   }


   public function emailinkActivationDate($uniqid, $date){
      $builder = $this->db->table('teacher');
      $builder->where(['token' => $uniqid]);
      $builder->update(['activation_date' => $date]);
   }

   public function checkStatus($id){
      $builder = $this->db->table('teacher');
      $builder->select('status');
      $builder->where(['id' => $id]);
      $r = $builder->get();
      if($r->getRow() != null){
         return $r->getRow();
      }
      else{
         return false;
      }
   }

   public function updateStaffRecord($id, $data){
      $builder = $this->db->table('teacher');
      $builder->where(['id' => $id, 'status' => 'active']);
      $r = $builder->update(['fname' => $data['fname'], 'lname' => $data['lname'], 'email' => $data['email'], 'phone' => $data['phone'], 'class' => $data['class']]);
      if($r){
         return $this->addSubject($this->db, $data['subject'], $id);
      }
      else{
         return false;
      }
   }

   public function addSubject($db, $subject, $id){
      $builder = $db->table('teacher');
      $subjectList = ['1' => 'Hindi', '2' => 'English', '3' => 'Maths', '4' => 'Science', '5' => 'Social Studies'];
      foreach($subjectList as $k => $v){
         if($subject == $v){
            $builder->where(['id' => $id]);
            $r = $builder->update(['subject_id' => $k]);
            if($r){
               return true;
            }
            else{
               return false;
            }
         }
      }
   }


   public function getStudentDetails($id){
      $data = false;
      $builder = $this->db->table('student');
      $builder->select('fname, lname, age, class_id, roll_no, phone, email, address, profile_pic, reg_id');
      $builder->where(['id' => $id]);
      $r = $builder->get();
      if($r->getResultArray() != null){
         $data = $r->getResultArray();
      }

      return $data;
   }


   public function update_std_details($data, $id){

      $builder = $this->db->table('student');
      $builder->where(['id' => $id]);
      $r = $builder->update(['fname' => $data['fname'], 'lname'  => $data['lname'], 'age' => $data['age'], 'phone' => $data['phone'], 'email' => $data['email'], 'address' => $data['address']]);
      if($r){
         return true;
      }
      else{
         return false;
      }
   }


   public function uploadStudentPic($file, $id){
      $builder = $this->db->table('student');
      $builder->where(['id' => $id]);
      $r = $builder->update(['profile_pic' => $file]);
      if($r){
         return true;
      }
      else{
         return false;
      }
   }

}

?>