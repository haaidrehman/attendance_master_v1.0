<?php 
namespace App\Controllers;
use App\Models\BaseModel;
use App\Models\LoginModel;
use Config\Services;

class Teacher extends BaseController{
   
    public $session;

    public function __construct(){
        helper('form');
        $this->session = Services::session();
    }

    public function login(){
        // $services = \Config\Services::class;
        // $validation = $services::validation();
        // echo '<pre>';
        // print_r(get_class_methods($validation));
        // exit();
        $data = ['valid_username_err' => null, 'valid_password_err' => null];
        if($this->request->getMethod() == 'post'){
        //     $validation = Services::validation();
        //    $setRules = [
        //        'username' => ['label' => 'Username', 'rules' => 'required|string'],
        //        'password' => ['label' => 'Password', 'rules' => 'required|string']
        // ];
        //    $validation->setRules($setRules);
           if($this->validate([
            'username' => ['label' => 'Username', 'rules' => 'required|string'],
            'password' => ['label' => 'Password', 'rules' => 'required|string']
            ])){
             $data['username'] = $this->request->getPost('username', FILTER_SANITIZE_STRING);
             $data['password'] = $this->request->getPost('password', FILTER_SANITIZE_STRING);
          
             $data['table'] = 'Teacher';
             $db = new LoginModel();
             $result = $db->check_record_n_allow($data);
            
             if($result['result'] == 'success'){
                 
                $this->session->set(['staffId' => $result['user_id'], 'staffName' => $result['user_fname'].' '.$result['user_lname'], 'isStaffLoggedIn' => TRUE]);
                return redirect()->to(base_url().'/teacher/dashboard');
                exit();
              }
              else if($result['result'] == 'p_unmatched'){
                $data['valid_password_err'] = 'Password not matched';
              }
             else if($result['result'] == 'u_a'){
                $data['valid_username_err'] = 'Username not registered';
              }

           }
           else{
              if($this->validator->hasError('username')){
                $data['valid_username_err'] = $this->validator->getError('username');
              }
              if($this->validator->hasError('password')){
                $data['valid_password_err'] = $this->validator->getError('password');
              }
           }
            
        }
        return view('teacher/login', $data);
    }

    public function logout(){
        $this->session->remove(['staffId', 'staffName', 'isStaffLoggedIn']);
        return redirect()->to(base_url().'/teacher/login');
    }

    public function dashboard(){
        helper('date');
        $data = [];
        $db = new BaseModel();
        $data['staffId'] = $this->session->get('staffId');
        $data['records'] = $db->base_attendance_category_list($data['staffId']);
                        // echo '<pre>';
                        // print_r($data['records']);
                        // var_dump($data['records']);
                        // echo '</pre>';
                        // exit();
                       
        // $arr = [];                
        // foreach($data['records'] as $k => $v){
        //     foreach($v as $k1 => $v1){
        //        if($k1 == 'class_id'){
        //         $arr[$k]['class'] = $v1;
        //        }
        //        else if($k1 == 'subject_id'){
        //         $arr[$k]['subject'] = $v1;
        //        }
        //        else{
        //         $arr[$k][$k1] = $v1;
        //        }
        //     }
        // }
        if($data['records'] != false){
          foreach($data['records'] as $k => $v){
            foreach($v as $k1 => $v1){
               if($k1 == 'class_id'){
                $data['records'][$k]['class'] = $v1;
                unset($data['records'][$k][$k1]);
               }
               else if($k1 == 'subject_id'){
                $data['records'][$k]['subject'] = $v1;
                unset($data['records'][$k][$k1]);
               }
               else if($k1 == 'year'){
                  $key = $k1;
                  $val = $v1;
                  unset($data['records'][$k][$k1]);
                  $data['records'][$k]['year'] = $v1;
               }
            }
        }
        }
      // echo '<pre>';
      // print_r($data['records']);
      // echo '</pre>';
      // exit();

        $data['date'] = date('Y', now('Asia/Kolkata'));
        
        return view('teacher/dashboard', $data);
    }


    // Add a class for attendance
    public function add_attendance_class(){
       if($this->request->getMethod() == 'post'){
          if($this->validate([
            'year' => ['label' => 'Year', 'rules' => 'required|string'],
            'attendance_class' => ['label' => 'Class', 'rules' => 'required|string'],
            'subject' => ['label' => 'Subject', 'rules' => 'required|string'],
            'teacher_id' => ['label' => 'Teacher', 'rules' => 'required|string']
            ])){
              $data = ['class_id' => $this->request->getPost('attendance_class'), 'teacher_id' => $this->request->getPost('teacher_id'), 'subject_id' => $this->request->getPost('subject'), 'year' => $this->request->getPost('year')];
              $db = new BaseModel();
              $result = $db->add_class_attendance($data);
              if($result["success"]){
                $subjects = ['Hindi', 'English', 'Maths', 'Science', 'Social Studies'];
                foreach($subjects as $k => $v){
                   if($k+1 == $data['subject_id']){
                    $data['subject'] = $v;
                    break;
                   }
                }
                $response['class_response_card']['success'] = true;
                $response['class_response_card']['class'] = $data['class_id'];
                $response['class_response_card']['subject'] = $data['subject'];
                $response['class_response_card']['year'] = $data['year'];
                $response['class_response_card']['id'] = $result['id'];
              }
              else{
                $response['class_attnd_response'] = 'Class already exists for attendance';
              }
          }
          else{
              if($this->validator->hasError('year')){
                  $response['year_err'] = $this->validator->getError('year'); 
              }
              if($this->validator->hasError('attendance_class')){
                $response['attnd_class_err'] = $this->validator->getError('attendance_class'); 
              }
              if($this->validator->hasError('subject')){
                $response['subject_err'] = $this->validator->getError('subject'); 
              }
              if($this->validator->hasError('teacher_id')){
                $response['teacher_id_err'] = $this->validator->getError('teacher_id'); 
              }
          }
          echo json_encode($response);
       }
    }


    public function disp_attendance_chart($id){
       $id = filter_var($id, FILTER_VALIDATE_INT);
       $db = new BaseModel();
       $data['teacher_id'] = $this->session->get('staffId');
       $data['records'] = $db->list_students($id);

       return view('teacher/attendance_chart', $data);
    }

    public function add_student_attendance($type, $attnd_cat_id, $class_id, $sub_id, $roll_no){
      if($this->request->getMethod() == 'post'){
         if($this->validate(['isPresent' => 'integer', 'attnd_cat_id' => 'integer', 'class_id' => 'integer', 'sub_id' => 'integer', 'roll_no' => 'integer'])){
           helper('date');
            $db = new BaseModel();
            $data = ['isPresent' => $this->request->getPost('isPresent'), 'attnd_cat_id' => $this->request->getPost('attnd_cat_id'), 'class_id' => $this->request->getPost('class_id'), 'sub_id' => $this->request->getPost('sub_id'), 'roll_no' => $this->request->getPost('roll_no'), 'std_id' => $this->request->getPost('std_id'), 'staff_id' => $this->request->getPost('staff_id'), 'date' => date('Y-m-d'), now('Asia/Kolkata')];
            if($db->insertAttendance($data)){
               $response['result'] = $data;
            }
            else if(! $db->insertAttendance($data)){
              $response['result'] = 'attnd_alrdy_taken';
            }
         }
      }
      
      $response['token'] = csrf_hash();
      return $this->response->setJSON($response);
    }
}


?>