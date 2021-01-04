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
      // $builder = $this->db->table('class');
      // $builder->select('class, class.id, status');
      // $builder->join('new_registration', 'class.id = new_registration.class_id', 'left');
      // $builder->orderBy('id', 'ASC');
      //  $r = $builder->get();

      $query = $this->db->query("SELECT DISTINCT(class.id), class.class, new_registration.status FROM class LEFT JOIN new_registration ON class.id = new_registration.class_id ORDER BY id ASC");
      if($query->getResultArray() != null){
         $row = $query->getResultArray(); 
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
         $builder->orderBy('student.roll_no', 'ASC');
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
     $builder->orderBy('attendance_detail.class_id', 'ASC');
      $r = $builder->get();
      if($r->getResultArray() != null){
         return $r->getResultArray();
      }
      else{
         return false;
      }
   }


   public function date_wise_filter($ad_id, $year){
       $builder = $this->db->table('attendance_detail');
       $builder->select('attendance_tbl.date');
       $builder->join('attendance_tbl', 'attendance_detail.id = attendance_tbl.ad_id');
       $builder->where(['attendance_detail.id' => $ad_id, 'attendance_detail.year' => $year]);
       $r = $builder->get();
       return $r->getRowArray();
   }

   public function date_wise_filter_select($ad_id, $date){
       $builder = $this->db->table('attendance_detail');
       $builder->select('student.fname, student.lname, student.roll_no, attendance_tbl.present, attendance_tbl.absent');
       $builder->join('attendance_tbl', 'attendance_detail.id = attendance_tbl.ad_id');
       $builder->join('student', 'attendance_tbl.std_id = student.id');
       $builder->where(['attendance_tbl.ad_id' => $ad_id, 'attendance_tbl.date' => $date]);
       $r = $builder->get();
       if($r->getResultArray() != null){
          return $r->getResultArray();
       }
       else{
        return false;
       }
   }


   // SELECT attendance_detail.id, student.id as student_id, student.roll_no, attendance_detail.year, attendance_tbl.present, attendance_tbl.absent FROM attendance_detail JOIN student JOIN attendance_tbl ON attendance_detail.class_id = student.class_id AND student.id = attendance_tbl.std_id WHERE attendance_detail.class_id = 4 AND attendance_detail.year = '2020' AND attendance_detail.subject_id = '5';



   // Get the list all of the all the students from attendance_detail table 
   public function list_students($id, $date){
      $builder = $this->db->table('attendance_detail');
      $builder->select('id, class_id, subject_id, year');
      $builder->where(['attendance_detail.id' => $id]);
      $r = $builder->get();
      $row = $r->getResultArray();
      $row = $row[0];
      return $this->filter_students($row, $builder, $date);
   }


   public function ifDateExist($date){
       $builder = $this->db->table('attendance_tbl');
       $builder->select('id');
       $builder->where(['date' => $date]);
       $r = $builder->get();
       if($r->getResultArray() != null){
          return true;
       }
       else{

        return false;
       }

   }



   public function filter_students($row, $builder, $date){
      $builder->select('attendance_detail.id, attendance_detail.class_id, attendance_detail.subject_id, attendance_detail.year, student.fname,student.lname, student.roll_no, student.id as student_id, attendance_tbl.present, attendance_tbl.absent, attendance_tbl.date');
      $builder->join('student', 'attendance_detail.class_id = student.class_id');
      if(! $this->ifDateExist($date)){
         $builder->join('attendance_tbl', 'attendance_detail.id != attendance_tbl.ad_id', 'left');
         $builder->where(['attendance_detail.id' => $row['id'], 'attendance_detail.class_id' => $row['class_id'], 'attendance_detail.subject_id' => $row['subject_id'], 'attendance_detail.year' => $row['year'], 'student.roll_no !=' => 'null']);
           $builder->orderBy('student.roll_no', 'ASC');
      }
      else{
         $builder->join('attendance_tbl', 'student.id = attendance_tbl.std_id AND attendance_tbl.subject_id = attendance_detail.subject_id', 'left');
         $builder->where(['attendance_detail.id' => $row['id'], 'attendance_detail.class_id' => $row['class_id'], 'attendance_detail.subject_id' => $row['subject_id'], 'attendance_detail.year' => $row['year'], 'student.roll_no !=' => 'null']);
         $builder->orderBy('student.roll_no', 'ASC');
      }
      
      
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
      $r = $builder->insert(['ad_id' => $data['attnd_cat_id'], 'class_id' => $data['class_id'], 'subject_id' => $data['sub_id'], 'std_id' => $data['std_id'], 'roll_no' => $data['roll_no'], 'teacher_id' => $data['staff_id'], 'present' => $p, 'absent' => $a, 'date' => $data['date']]);
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


   public function get_total_attendance($ad_id, $class_id){
      $builder = $this->db->table('attendance_tbl');
      $builder->select('student.fname, student.lname, student.roll_no, attendance_tbl.present, attendance_tbl.absent, attendance_tbl.date');
      $builder->join('student', 'attendance_tbl.class_id = student.class_id AND attendance_tbl.std_id = student.id');
      $builder->where(['ad_id' => $ad_id, 'attendance_tbl.class_id' => $class_id]);
      $builder->orderBy('roll_no');
      $r = $builder->get();
      if($r->getResultArray() != null){
         return $r->getResultArray();
      }
      else{
         return false;
      }
   }

   public function get_subject($ad_id){
      $builder = $this->db->table('attendance_tbl');
      $builder->select('subjects.name');
      $builder->join('subjects', 'attendance_tbl.subject_id = subjects.id');
      $builder->where(['ad_id' => $ad_id]);
      $builder->limit('1');
      $r = $builder->get();
      if($r->getResultArray() != null){
         return $r->getResultArray();
      }
      else{
         return false;
      }

   }

   public function get_all_students($ad_id, $class_id){
      $builder = $this->db->table('attendance_detail');
      $builder->select('student.id, student.class_id, student.fname, student.lname, student.roll_no');
      $builder->join('student', 'attendance_detail.class_id = student.class_id');
      $builder->where(['attendance_detail.id' => $ad_id]);
      $builder->orderBy('student.roll_no', 'ASC');
      $r = $builder->get();
      if($r->getResultArray()){
         return $r->getResultArray();
      }
      else{
         return false;
      }
   }

   public function get_student_details($id){
      $builder = $this->db->table('student');
      $builder->select('student.id, student.fname, student.lname, student.roll_no, student.age, student.gender, student.phone, student.email, student.address');
      $builder->where(['id' => $id]);
      $r = $builder->get();
      if($r->getResultArray()){
         return $r->getResultArray();
      }
      else{
         return false;
      }
   }

    // Fetch attendance detail of a specific student from a range of date
   public function fetch_attendance_from_range($ad_id, $std_id, $subject_id, $start_date, $end_date){
      $builder = $this->db->table('attendance_tbl');
      $builder->select('student.fname, student.lname, student.roll_no, attendance_tbl.present, attendance_tbl.absent, attendance_tbl.date');
      $builder->join('student', 'attendance_tbl.std_id = student.id');
      $builder->where(['attendance_tbl.ad_id' => $ad_id, 'attendance_tbl.std_id' => $std_id, 'attendance_tbl.subject_id' => $subject_id, 'date >=' => $start_date, 'date <=' => $end_date]);
      $builder->orderBy('attendance_tbl.date', 'ASC');
      $r = $builder->get();
      if($r->getResultArray()){
         return $r->getResultArray();
      }
      else{
         return false;
      }
   }

   public function student_attendance_data($std_id, $subject_id, $month, $year){
      // $date = date('Y-m-d');
      // str_replace();

      $r = $this->db->query("SELECT `present`, `absent`, DAY(date) as 'day', MONTH(date) as 'month' FROM attendance_tbl WHERE std_id = $std_id AND subject_id = $subject_id AND MONTH(date) = $month AND YEAR(date) = $year ORDER BY DAY(date) ASC");
      // $builder = $this->db->table('attendance_tbl');
      // $builder->select('date');
      // $builder->distinct('YEAR(date), MONTH(date) as Months');
      // $builder->where(['std_id' => $std_id, 'subject_id' => $subject_id]);
      // $r = $builder->get();
      if($r->getResultArray() != null){
         return $r->getResultArray();
      }
      else{
         return false;
      }
      // return $month;
      
   }


   public function attendance_notification($id){

      // Select first date and last date of a year
      $r = $this->db->query("SELECT MIN(date) as first_date, MAX(date) as last_date FROM attendance_tbl");
      $result = $r->getResultArray();
      $fisrt_date = $result[0]['first_date'];
      $last_date = $result[0]['last_date'];
      $fisrt_date = strtotime($fisrt_date);
      $last_date = strtotime($last_date);
      
      $diff = $last_date - $fisrt_date;

      $days = ($diff / (24 * 60 * 60));


      // Count total attendance of a student for presen = 1
      $c = $this->db->query("SELECT COUNT(present) as attendance_count FROM attendance_tbl WHERE std_id = $id AND present = 1");
      $attendance_count = $c->getResultArray();


      // Count total months
      $c = $this->db->query("SELECT COUNT(DISTINCT(MONTH(date))) as months_count FROM attendance_tbl");
      $months_count = $c->getResultArray();

      $row = [];
      $row['total_days'] = $days;
      $row['attendance_count'] = $attendance_count[0]['attendance_count'];
      $row['months_count'] = $months_count[0]['months_count'];

      return $row;
   }


   public function attendance_statistics($id){
      $row = [];
      $r = $this->db->query("SELECT MIN(date) as first_date, MAX(date) as last_date,  MIN(MONTH(date)) as starting_month, MAX(MONTH(date)) as ending_month FROM attendance_tbl");
      if($r->getResultArray() != null){
         $row[0] = $r->getResultArray();
      }
      $r = $this->db->query("SELECT DISTINCT(MONTH(date)) as months FROM attendance_tbl ORDER BY(MONTH(date)) ASC");
      if($r->getResultArray() != null){
         $row[1] = $r->getResultArray();
      }
      $r = $this->db->query("SELECT MONTH(date) as month_num, COUNT(DAY(date)) as attendance_count FROM attendance_tbl WHERE std_id = $id AND present = 1 GROUP BY(MONTH(date)) ORDER BY(id) ASC");
      if($r->getResultArray() != null){

         // $row[2][0] = ['attendance_count' => '0'];
         //  $row[2][1] = $r->getResultArray();

         //$row[2][0] = ['attendance_count' => '0'];
         foreach($r->getResultArray() as $k => $v){
            $row[2][$k] = $v; 
         }
         return $row;
      }
      else{
         return null;
         exit();
      }

      return $row;
   }

}

?>