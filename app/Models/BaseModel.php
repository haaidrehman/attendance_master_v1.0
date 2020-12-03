<?php
namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class BaseModel extends Model{

	public $db;

	public function __construct(){
		$this->db = Database::connect();
	}


	public function get_new_registrations($get_class_id){
	    $row = null;	
       $builder = $this->db->table('new_registration');
       $builder->select('fname, lname, age, gender, class_id, phone, email, address, uniqid');
       $builder->where(['class_id' => $get_class_id, 'status' => 0]);
       $r = $builder->get();
       if($r->getResultArray() != null){
          $row = $r->getResultArray(); 
       }
       return $row;
   }
   
   public function class_based_registrations(){
      $row = null;
      $builder = $this->db->table('class');
      $builder->select('class, class.id, status');
      $builder->join('new_registration', 'class.id = new_registration.class_id', 'left');
      $builder->orderBy('id', 'ASC');
      $r = $builder->get();
      if($r->getResultArray() != null){
         $row = $r->getResultArray(); 
      }
      return $row;
   }
   

   public function get_class($get_class_id = ''){
      $row = null;
      if(!empty($get_class_id)){
         $builder = $this->db->table('class');
         $builder->select('fname, lname, age, gender, class, roll_no, reg_id, added_on, student.id, class_id ');
         $builder->join('student', 'class.id = student.class_id');
         $builder->where(['class_id' => $get_class_id]);
         $builder->orderBy('roll_no', 'ASC');
         $r = $builder->get();
         if($r->getResultArray() != null){
            $row = $r->getResultArray();
            if($row[0]['roll_no'] == 'null'){
               $row[0]['roll_no'] = 'null';
            }
         }
         return $row;
         exit();
      }
      $builder = $this->db->table('class');
      $builder->select('id, class');
      $r = $builder->get();
      $row = $r->getResultArray();
      return $row;
   }


	public function add_to_student($uniqid){
       $builder = $this->db->table('new_registration');
       $builder->where(['uniqid' => $uniqid]); 
       $r = $builder->update(['status' => 1]);
       
       if($r){
          $builder->select('fname, lname, age, gender, class_id, phone, email, address, password, uniqid');
          $builder->where(['status' => 1, 'uniqid' => $uniqid]);
          $res = $builder->get();
          $row = $res->getResultArray();
          $row = $row[0];
          $row['reg_id'] = $row['uniqid'];
          array_splice($row, 9, 1);
          $builder = $this->db->table('student');
          return $builder->insert($row);
       }
   }
   
   public function add_student_roll_no($class_id, $std_id, $roll_no){
      $row = null;
      $builder = $this->db->table('student');
      $builder->where(['id' => $std_id, 'class_id' => $class_id, 'roll_no' => 'null']);
      $r = $builder->update(['roll_no' => $roll_no]);
      if($r){
         $row = 1;  
      }
      return $row;
   }

   public function add_class_attendance($data){
      $builder = $this->db->table('attendance_detail');
      $builder->select('id');
      $builder->where($data);
      if($builder->get()->getRowArray() != null){
         return false;
      } 
      else{
         if($builder->insert($data) == true){
            $result['success'] = true;
         }
         
         $result['id'] = $this->select_class_attendance_id($data, $builder);
         return $result;
      }
   }
   

   public function select_class_attendance_id($data, $builder){
      $builder->select('id');
      $builder->where($data);
      return $builder->get()->getRow()->id;
   }
   
   public function base_attendance_category_list($id){
      $builder = $this->db->table('attendance_detail');
      $builder->select('attendance_detail.id, attendance_detail.class_id, attendance_detail.teacher_id, subjects.name, attendance_detail.year');
      $builder->join('subjects', 'attendance_detail.subject_id = subjects.id');
      $builder->where(['teacher_id' => $id]);
     //$builder->orderBy('id', 'DESC');
      $r = $builder->get();
      if($r->getResultArray() != null){
         return $r->getResultArray();
      }
      else{
         return false;
      }
   }


   // Get the list all of the all the students from attendance_detail table 
   public function list_students($id){
      $builder = $this->db->table('attendance_detail');
      $builder->select('id, class_id, subject_id, year');
      $builder->where(['attendance_detail.id' => $id]);
      $r = $builder->get();
      $row = $r->getResultArray();
      $row = $row[0];
      return $this->filter_students($row, $builder);
   }

   public function filter_students($row, $builder){
      $builder->select('attendance_detail.id, attendance_detail.class_id, attendance_detail.subject_id, attendance_detail.year, student.fname,student.lname, student.roll_no, student.id as student_id');
      $builder->join('student', 'attendance_detail.class_id = student.class_id');
      $builder->where(['attendance_detail.id' => $row['id'], 'attendance_detail.class_id' => $row['class_id'], 'attendance_detail.subject_id' => $row['subject_id'], 'attendance_detail.year' => $row['year'], 'student.roll_no !=' => 'null']);
      $builder->orderBy('student.roll_no', 'ASC');
      $r = $builder->get();
      if($r->getResultArray() != null){
         return $r->getResultArray();
      }
      else{
         return false;
      }
   }


   public function insertAttendance($data){
      $builder = $this->db->table('attendance_tbl');
      if(! $this->ifAttendanceExist($data['attnd_cat_id'], $data['std_id'], $data['date'], $builder)){
         return $this->ifAttendanceExist($data['attnd_cat_id'], $data['std_id'], $data['date'], $builder);
         exit();
      }
         $p = 0;
         $a = 1;
         if($data['isPresent'] == 1){
            $p = 1;
            $a = 0;
         }
      $r = $builder->insert(['ad_id' => $data['attnd_cat_id'], 'class_id' => $data['class_id'], 'subject_id' => $data['sub_id'], 'std_id' => $data['std_id'], 'teacher_id' => $data['staff_id'], 'present' => $p, 'absent' => $a, 'date' => $data['date']]);
      if($r){
         return true;
      }
      else{
         return false;
      } 
   }

   public function ifAttendanceExist($ad_id, $std_id, $date, $b){
      $b->select('id');
      $b->where(['ad_id' => $ad_id, 'std_id' => $std_id, 'date' => $date]);
      $r = $b->get();
      if($r->getResultArray() != null){
         return false;
      }
      else{
         return true;
      }
   }
}

?>