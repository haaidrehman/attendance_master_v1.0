<?php 
namespace App\Controllers;
use App\Models\BaseModel;
use App\Models\LoginModel;
use Config\Services;

class Teacher extends BaseController{
   
    public $session;

    public function __construct(){
        helper(['form', 'date']);
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
        $data['staff_name'] = $this->session->get('staffName');
        $data['already_loggedIn'] = $this->session->getFlashdata('already_loggedIn');
        
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


    // Filter and display the attendance of previous dates. Also providing a button to take current date attendance.
    public function date_wise_filter($ad_id, $class, $subject, $year){
      //print_r($_SESSION);exit();
        $db = new BaseModel();

        $data = ['records' => $db->date_wise_filter($ad_id, $year)];
        $data['ad_id'] = $ad_id;
        $data['class_id'] = $class;
        $data['subject'] = $subject;
        $data['staff_name'] = $this->session->get('staffName');
        return view('teacher/attendance_date_wise', $data);
    }

    public function filter_select($ad_id, $class, $subject, $date){
        $db = new BaseModel();
        $data = ['records' => $db->date_wise_filter_select($ad_id, $date)];
        $data['class'] = $class;
        $data['subject'] = $subject;
        $data['date'] = $date;
        $data['staff_name'] = $this->session->get('staffName');
        return view('teacher/date_wise_filter_select', $data);
    }

    public function disp_attendance_chart($id){
       $id = filter_var($id, FILTER_VALIDATE_INT);
       $db = new BaseModel();
       $data['teacher_id'] = $this->session->get('staffId');
       $data['records'] = $db->list_students($id, date('Y-m-d', now('Asia/Kolkata')));
       $data['date'] = date('Y-m-d', now('Asia/Kolkata'));
      
       $subjects = ['1' => 'Hindi', '2' => 'English', '3' => 'Maths', '4' => 'Science', '5' => 'Social Studies'];
       if(! $data['records']){
         return redirect()->back()->with('no_std_record', 'No student record found', 2);
         exit();
       }
       foreach($data['records'] as $k => $v){
                
                $class = $v['class_id'];  
                foreach($subjects as $k1 => $v1){
                   if($v['subject_id'] == $k1){
                      $subject = $v1;
                      break;
                   }
                }
                
                break;
       }
       $data['class'] = $class;
       $data['subject'] = $subject;
       $data['staff_name'] = $this->session->get('staffName');
       
      //  echo '<pre>';
      //  print_r($data['subject']);
      //  exit();


       return view('teacher/attendance_chart', $data);
    }

    public function add_student_attendance($type, $attnd_cat_id, $class_id, $sub_id, $roll_no){
      if($this->request->getMethod() == 'post'){
         if($this->validate(['isPresent' => 'integer', 'attnd_cat_id' => 'integer', 'class_id' => 'integer', 'sub_id' => 'integer', 'roll_no' => 'integer'])){
            $db = new BaseModel();
            $data = ['isPresent' => $this->request->getPost('isPresent'), 'attnd_cat_id' => $this->request->getPost('attnd_cat_id'), 'class_id' => $this->request->getPost('class_id'), 'sub_id' => $this->request->getPost('sub_id'), 'roll_no' => $this->request->getPost('roll_no'), 'std_id' => $this->request->getPost('std_id'), 'staff_id' => $this->request->getPost('staff_id'), 'date' => date('Y-m-d', now('Asia/Kolkata'))];
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

    // This method is for Teacher Dashboard sidebar
    public function class_specific_attendance_cat(){
        $db = new BaseModel();
        $data['records'] = $db->base_attendance_category_list($this->session->get('staffId'));

        $links = '';
        
        $count = count($data['records']);
        foreach($data['records'] as $k => $v){
             $url = base_url().'/teacher/d/attendance_detail/'.$v['id'].'/'.$v['class_id'].'/date'.'/'.date('Y-m-d', now('Asia/Kolkata'));
             $links .= "<a class='dropdown-item' href='$url'>Class {$v['class_id']}</a>";
             if($count > 1){
                $links .= "<div class='dropdown-divider'></div>";
             }
             $count--;
        }
        return $links;
    }

    public function class_specific_students(){
      $db = new BaseModel();
      $data['records'] = $db->base_attendance_category_list($this->session->get('staffId'));
      $subjects = ['1' => 'Hindi', '2' => 'English', '3' => 'Maths', '4' => 'Science', '5' => 'Social Studies'];
      foreach($subjects as $k => $v){
         if($data['records'][0]['name'] == $v){
            $subject_id = $k;
         break;
         }
      }
      // echo $subject_id;
      // echo '<pre>';
      // print_r($data['records']);exit();
      $links = '';
      $count = count($data['records']);
        foreach($data['records'] as $k => $v){
             $url = base_url().'/teacher/d/attendance_detail/students/'.$v['id'].'/'.$v['class_id'].'/'.$subject_id;
             $links .= "<a class='dropdown-item' href='$url'>Class {$v['class_id']}</a>";
             if($count > 1){
                $links .= "<div class='dropdown-divider'></div>";
             }
             $count--;
        }
        return $links;

    }

    // Create links for sidebar navigation
    public function class_specific_attendance_statistics(){
      $db = new BaseModel();
      $data['records'] = $db->base_attendance_category_list($this->session->get('staffId'));
      $links = '';
      $count = count($data['records']);
        foreach($data['records'] as $k => $v){
             $url = base_url().'/teacher/d/attendance_detail/statistics/'.$v['id'].'/'.$v['class_id'];
             $links .= "<a class='dropdown-item' href='$url'>Class {$v['class_id']}</a>";
             if($count > 1){
                $links .= "<div class='dropdown-divider'></div>";
             }
             $count--;
        }
        return $links;

    }
    

    public function class_attendance_detail($ad_id, $class_id, $date){

        $ad_id = filter_var($ad_id, FILTER_VALIDATE_INT);
        $class_id = filter_var($class_id, FILTER_VALIDATE_INT);
        $data['staff_name'] = $this->session->get('staffName');

        $db = new BaseModel();
        $data['records'] = $db->date_wise_filter_select($ad_id, $date);
        $data['subject'] =  $db->get_subject($ad_id);
        $data['date'] = $date;
        $data['class'] = $class_id;
        $data['ad_id'] = $ad_id;
        $data['dynamic_date'] = true;
        $std_names = [];
    
        if($data['subject'] != false){
          foreach($data['subject'] as $k => $v){
            $data['subject'] = $v['name'];
          } 
        }
        

      return view('teacher/date_wise_filter_select', $data);  
    }


    public function class_attendance_detail_ajax_load($ad_id, $class_id, $date){
        $db = new BaseModel();
        $data['records'] = $db->date_wise_filter_select($ad_id, $date);

        if($data['records'] != false){
          $base_url_p = base_url().'/public/assets/images/icons/iconfinder_check_1814079.png';
          $base_url_a = base_url().'/public/assets/images/icons/iconfinder_cross_646197.png';
          $output = '';
            $i = 1;
            foreach($data['records'] as $k => $v){
               
               $output .= "<tr>
                                           <td>$i</td>
                                           <td>{$v['fname']} {$v['lname']}</td>
                                           <td>{$v['roll_no']}</td>
                                           ";
                                             if($v['present'] == 1){
                                              $output .= "<td> <img src='{$base_url_p}'></td>";
                                             } 
                                             else if($v['present'] == 0){
                                              $output .= "<td><img src='{$base_url_a}'></td>";
                                             }
                                             if($v['absent'] == 1){
                                              $output .= "<td><img src='{$base_url_p}'></td>";
                                             } 
                                             else if($v['absent'] == 0){
                                              $output .= "<td><img src='{$base_url_a}'></td>";
                                             }
                                           
                                             $output .= "<td></td>";
                                             $output .= "</tr>"; 
                                             $i++;  
            }
            echo $output;
        }
        else{
           echo 'no_record';
        }
    }


    // View student list
    public function view_student_list($ad_id, $class_id, $subject_id){
       $db = new BaseModel();
       $data['records'] = $db->get_all_students($ad_id, $class_id);
       $data['ad_id'] = $ad_id;
       $data['subject_id'] = $subject_id;
       $data['staff_name'] = $this->session->get('staffName');
       return view('teacher/class_overall_students', $data); 
    }

    // View a single student details
    public function view_student_details($ad_id, $std_id, $class_id, $subject_id){
  
      $db = new BaseModel();
      $data['records'] = $db->get_student_details($std_id);
      $data['class_id'] = $class_id;
      $data['ad_id'] = $ad_id;
      $data['subject_id'] = $subject_id;
      $data['staff_name'] = $this->session->get('staffName');
      return view('teacher/single_student_details', $data); 
    }

    // Fetch attendance detail of a specific student from a range of date
    public function view_attendance_from_range($ad_id, $std_id, $subject_id, $start_date, $end_date){
      $db = new BaseModel();
      $data['records'] = $db->fetch_attendance_from_range($ad_id, $std_id,  $subject_id, $start_date, $end_date);
      if($data['records'] != false){
        $output = "<div class='card custom-card-bg'><div class='mt-2 mb-3 pl-3 pt-2'><h4>Attendance Range - $start_date To $end_date</h4></div>";
        $output .= "<table class='table'>
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Roll Number</th>
                      <th>Attendance</th>
                      <th>Date</th>
                    </tr>";
        $i = 1;            
        foreach($data['records'] as $k => $v){
           $output .= "<tr>
                          <td>$i</td>
                          <td>{$v['fname']} {$v['lname']}</td>
                          <td>{$v['roll_no']}</td>";
                          if($v['present'] == 1){
                            $output .= "<td>Present</td>";
                          }
                          else if($v['absent'] == 1){
                            $output .= "<td>Absent</td>";
                          }
                          $output .= "<td>{$v['date']}</td>";
           $output .= "</tr>";
           $i++;
        }
        $output .= "</table></div>";
        return $output;
      }
      else{
         return 'no_record';
      }
    }
}


?>