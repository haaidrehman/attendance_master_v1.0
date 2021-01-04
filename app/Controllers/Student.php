<?php
namespace App\Controllers;

use Config\Services;
use App\Models\RegisterModel;
use App\Models\LoginModel;
use App\Models\BaseModel;

class Student extends BaseController{

    private $session;
    private $email;

    public function __construct(){

       $this->session = Services::session();	
       $this->email = Services::email();
       helper('form');
    }


    public function index(){
       
    } 


    public function login(){
       //echo strlen(password_hash('RakeshRoshan2989', PASSWORD_BCRYPT));
      $data = ['valid_err_email' => null, 'valid_err_pass' => null];
       if($this->request->getMethod() == 'post'){
        $validation_rules = ['email' => 'required|valid_email', 'password' => 'required|string'];
        
          if($this->validate($validation_rules)){
            $data['email'] = $this->request->getPost('email', FILTER_VALIDATE_EMAIL); 
            $data['password'] = $this->request->getPost('password', FILTER_SANITIZE_STRING); 

             $db = new LoginModel();
             $data['table'] = 'student';
             $result = $db->check_record_n_allow($data);

             if($result['result'] == 'success'){
               $this->session->set(['isStdLogin' => true, 'stdId' => $result['user_id'], 'stdName' => $result['user_fname'].' '.$result['user_lname']]);
               return redirect()->to(base_url().'/student/dashboard');
               exit();
             }
             else if($result['result'] == 'p_unmatched'){
               echo 'jkjkjk';exit();
               $data['valid_err_pass'] = 'Password not matched';
             }
            else if($result['result'] == 'u_a'){
              
               $data['valid_err_email'] = 'Email not registered';
             }
          }
          else{
             if($this->validator->hasError('email')){
               $data['valid_err_email'] = $this->validator->getError('email');
             }
             if($this->validator->hasError('password')){
               $data['valid_err_pass'] = $this->validator->getError('password');
             }
          } 
       }
       return view('student/login', $data);
      
    }

    public function register(){
      // $this->session->removeTempdata('OTP_SENT');
      $validate_msg['validator'] = $validate_msg['phone_exist'] = null;
       if($this->request->getMethod() == 'post'){
         $validation_rules = [
         	'fname' => 'required|string',
         	'lname' => 'required|string',
         	'age' => 'required|integer|greater_than[4]|less_than[35]',
         	'gender' => 'required',
         	'class' => 'required',
         	'phone' => 'required|string|min_length[10]',
         	'email' => 'required|valid_email',
         	'email_otp' => 'required|integer',
         	'password' => 'required|string',
         	'address' => 'required|string'
         ];

         if($this->validate($validation_rules)){
            $fname = $this->request->getPost('fname', FILTER_SANITIZE_STRING);
            $lname = $this->request->getPost('lname', FILTER_SANITIZE_STRING);
            $age = $this->request->getPost('age');
            $gender = $this->request->getPost('gender');
            $class = $this->request->getPost('class');
            $phone = $this->request->getPost('phone', FILTER_SANITIZE_STRING);
            $email = $this->request->getPost('email', FILTER_VALIDATE_EMAIL);
            //$email_otp = $this->request->getPost('email_otp', FILTER_VALIDATE_INT);
            $password = $this->request->getPost('password', FILTER_SANITIZE_STRING);
            $password = password_hash($password, PASSWORD_BCRYPT);
            $address = $this->request->getPost('address', FILTER_SANITIZE_STRING);
            $uniqid = substr(uniqid().time(), 0, 20);
            
            $user_data = ['fname' => $fname, 'lname' => $lname, 'age' => $age, 'gender' => $gender, 'class_id' => $class, 'phone' => $phone, 'email' => $email, 'password' => $password, 'uniqid' => $uniqid, 'address' => $address];

            $db = new RegisterModel();
            $r = $db->insert_data($user_data);

            if($r){
               $this->session->setTempdata('reg_success', TRUE, 5); 
               $this->session->remove('OTP_VERIFIED');
               $this->session->remove('OTP_AUTH');
               $this->session->remove('OTP_SENT');
               
               return redirect()->to(base_url('/registration/success'));
            }
            else{
               $validate_msg['phone_exist'] = 'Phone number already exist';
            }

         }
         else{
            $validate_msg['validator'] = $this->validator;
         }
       }

       return view('student/register', $validate_msg);
    }

    
    public function email_otp(){
    	// echo '<pre>';
     //  print_r(get_class_methods($this->email));
     //  exit();
       if($this->request->getMethod() == 'post'){
       	  if($this->request->getPost('email')){
             if($this->validate(['email' => 'required|valid_email'])){

             	     $recpt_email = $this->request->getPost('email', FILTER_VALIDATE_EMAIL);
                   $db = new RegisterModel();
                   $result = $db->email_exists(['email' => $recpt_email]);
                   if($result['status'] == 1){
                       $str = rand(11111, 99999);
                       $otp = substr(str_shuffle($str), 0, 4);
                       $html = "<table><tr><th>OTP</th></tr><tr><td>$otp</td></tr></table>";
                       $html .= "<p>The OTP will be expired after 5 minutes.</p>";
                          
                       $email_config['protocol'] = 'smtp';
                       $email_config['SMTPHost'] = '127.0.0.1';
                       $email_config['SMTPPort'] = '1025';
                       $email_config['SMTPCrypto'] = '';
                       $email_config['mailType'] = 'html';

                       $this->email->initialize($email_config);

                       $this->email->setFrom('haaidrehman086@gmail.com', 'Haaid Rehman');
                       $this->email->setTo($recpt_email);
                       $this->email->setSubject('OTP for Email verification');
                       $this->email->setMessage($html);
                       if($this->email->send()){
                                $this->session->setTempdata('OTP_AUTH', $otp, 300);
                                $this->session->setTempdata('OTP_SENT', 'An OTP has been sent to your email address', 300);
                                 echo json_encode(['otp_sent' => 1]);
                       }
                       else{
                          echo json_encode(['otp_sent' => 0]);
                       }
                   }
                   else{
                      echo json_encode(['email_exists' => 1]);
                   }


             }
             else{
               echo json_encode(['email_invalid' => true, 'error_msg' => 'Please enter a valid email']);
             }
       	  }
          else{
            echo json_encode(['email_invalid' => 'blank']);
          }
          
       } 
       
      
    }

    public function verify_otp(){

       if($this->request->getMethod() == 'post'){
          if($this->request->getPost('otp_verify')){
             if($this->validate(['otp_verify' => 'required'])){
              $otp = $this->request->getPost('otp_verify', FILTER_VALIDATE_INT);
                if($this->session->getTempdata('OTP_AUTH')){
                    if($this->session->getTempdata('OTP_AUTH') == $otp){
                      
                       $this->session->setTempdata('OTP_VERIFIED', TRUE, 300);
                       echo json_encode(['OTP_VERIFIED' => 1]);
                       $this->session->remove('OTP_SENT');
                    }
                    else{
                     echo json_encode(['OTP_STATUS' => 'invalid']);
                    }
                }  
             }
             else{
                echo json_encode(['OTP_STATUS' => 'invalid']);
             }
          }
          else{
             echo json_encode(['OTP_STATUS' => 'blank']);
          }
       }
    }


   public function reg_success(){

   //   if($this->session->getTempdata('reg_success')){
   //      return view('student/registration_success');
   //      exit();
   //   }
   //   return redirect()->to(base_url('/register'));
     
     return view('student/registration_success');
   }


   public function student_account(){
      $db = new RegisterModel();
      $std_detail = $db->getStudentDetails($this->session->get('stdId'));
      
      if($this->request->getMethod() == 'post'){
         
         $validation_rules = ['fname' => ['label' => 'First Name', 'rules' => 'required|string'], 'lname' => ['label' => 'Last Name', 'rules' => 'required|string'], 'age' => ['label' => 'Age', 'rules' => 'required|integer'], 'phone' => ['label' => 'Phone', 'rules' => 'required|string'], 'email' => ['label' => 'Email', 'rules' => 'required|valid_email'], 'address' => ['label' => 'Address', 'rules' => 'required|string']];
         if($this->validate($validation_rules)){
            $data['fname'] = $this->request->getPost('fname');
            $data['lname'] = $this->request->getPost('lname');
            $data['age'] = $this->request->getPost('age');
            $data['phone'] = $this->request->getPost('phone');
            $data['email'] = $this->request->getPost('email');
            $data['address'] = $this->request->getPost('address');
            if($db->update_std_details($data, $this->session->get('stdId'))){
               $this->session->setFlashdata('profile_updated', 'Your profile details updated successfully');
               return redirect()->to(base_url().'/student/dashboard');
               exit();
            }
         }
      }
      
      $data['records'] = $std_detail;
      $data['std_name'] = $this->session->get('stdName');
      $data['stdId'] = $this->session->get('stdId');
      return view('student/dashboard', $data);
   }
 
   public function std_file_upload(){
      if($this->request->getMethod() == 'post'){
         $file = $this->request->getFile('profile_pic'); 
         if($this->validate(['profile_pic' => ['label' => 'Profile Picture', 'rules' => 'uploaded[profile_pic]|is_image[profile_pic]|is_image[profile_pic]|max_size[profile_pic, 1024]']])){
            
          
                
               $filename = $file->getRandomName();
               $file->move(WRITEPATH.'/uploads/students', $filename) ;  
               if($file->hasMoved()){
                 $db = new RegisterModel();
                  $id = $this->session->get('stdId');
                  if($db->uploadStudentPic($filename, $id)){
                     return redirect()->back()->with('profile_uploaded', 'Profile picture uploaded');
                     exit();
                  }   
               }
                       
         }
         else{
            $arr = [];
            if(! in_array($file->getMimeType(), ['image/png','image/jpg', 'image/jpeg']) && ! in_array($file->getExtension(), ['png', 'jpeg', 'jpg'])){
               $arr['index_1'] = 'Only PNG, JPG and JPEG image format are allowed';
               $this->session->setTempdata('validation_error', $arr, 5);
            }
            $arr['index_2'] = $this->validator->getError('profile_pic');
            $this->session->setTempdata('validation_error', $arr, 5);
            return redirect()->back();
         }
         
      }
   }


   public function student_attendance_base($id){

      $data['stdId'] = $this->session->get('stdId'); 
      $data['subjects'] = ['1' => 'Hindi', '2' => 'English', '3' => 'Maths', '4' => 'Science', '5' => 'Social Studies'];

      return view('student/base_attendance_detail', $data);
   }


   public function student_attendance_detail($std_id, $subject_id, $month, $year){
      $db = new BaseModel(); 

      $row = $db->student_attendance_data($std_id, $subject_id, $month, $year);
      
      if($row == false){
         return "<div style='max-width: 500px;' class='mt-2 text-center mx-auto'><div class='alret alert-danger pl-3 py-3'>Attendance not found<div></div>";
      }
      else{

         $output = "<table class='table'>";
         $output .= "<tr>
                       <th>#</th>
                       <th>Attendance</th>
                       <th>Day</th>
                       <th>Month</th>
                     </tr>";
         foreach($row as $k => $v){
            $i = $k+1;
            $output .= "<tr>
                           <td>$i</td>";
                        if($v['present'] == '1'){
                           $output .= "<td style='color: green'>Present</td>";
                        }
                        else{
                           $output .= "<td style='color: red'>Absent</td>";
                        }
                        $output .= "<td>{$v['day']}</td>
                                    <td>{$v['month']}</td>
                        </tr>"; 
         }
         $output .= "</table>";

         return $output;

      }

   }


   public function student_notification($std_id){
      $data = ['attendance_shortage' => false];
      $data['stdId'] = $this->session->get('stdId'); 
      $db = new BaseModel(); 
      $result = $db->attendance_notification($std_id);
     
      // Attendance is less than 75% during 6 months of attendance period than send a warning notification to the student
      if($result['months_count'] >= 6){
         $attendance_percentage = ($result['attendance_count'] / $result['total_days']) * 100;
         if($attendance_percentage < 75){
            $data['attendance_shortage'] = true;
         }
         $data['attendance_percentage'] = number_format(floor($attendance_percentage * 100) / 100, 2, '.','');
      }

      
     return view('student/attendance_notification', $data);

   }


   public function attendance_statistics(){
      $data['stdId'] = $this->session->get('stdId'); 
      
      $db = new BaseModel();
      $result = $db->attendance_statistics($data['stdId']);
      
      if($this->request->getMethod() == 'post'){
         $count1 = count($result[1]);
         $count2 = count($result[2]);
         $temp['month_arr'] = [];
         $month_name = [1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'];
            foreach($result[1] as $k => $v){
               foreach($month_name as $m => $n){
                  if($v['months'] == $m){
                     array_push($temp['month_arr'], [$m => $n]);
                  }
               }
            }
            $temp['attendance_count_arr'] = [];
            foreach($temp['month_arr'] as $month_ar_key => $month_ar_val){
               foreach($month_ar_val as $month_ar_key1 => $month_ar_val1){
                  $temp['attendance_count_arr'][$month_ar_key1] = [];
               }
            }
   
            
            $temp_arr = [];
            
            foreach($temp['attendance_count_arr'] as $attendance_count_arr_key => $attendance_count_arr_val){
               foreach($result[2] as $result_key => $result_val){
                  if($attendance_count_arr_key == $result_val['month_num']){
                  $temp['attendance_count_arr'][$attendance_count_arr_key] = ['attendance_count' => $result_val['attendance_count']];
                  array_push($temp_arr, $result_val['month_num']); 
                  }
               }
            }
   
            $i = 0;
            foreach($temp['attendance_count_arr'] as $attendance_count_arr_key => $attendance_count_arr_val){
               //echo count($temp_arr);
               if($i <= count($temp_arr) - 1){
                  if($temp_arr[$i] != $attendance_count_arr_key){
                     if(count($attendance_count_arr_val) == 0){
                        $temp['attendance_count_arr'][$attendance_count_arr_key] = ['attendance_count' => '0'];
                        // echo $i.' : '.$temp_arr[$i].' : '.$attendance_count_arr_key.'<br>';
                     }
                   
                  }
                  else{
                     //echo $i.' : '.$temp_arr[$i].' : '.$attendance_count_arr_key.'<br>';
                  }
               }
               else{
                  
                  if(count($attendance_count_arr_val) == 0){
                     $temp['attendance_count_arr'][$attendance_count_arr_key] = ['attendance_count' => '0'];
                  }
               }
               $i++;
               
            }
   
   
            return $this->response->setJSON($temp);
         exit();
      }

      $count1 = count($result[1]);
      $count2 = count($result[2]);
      $temp['month_arr'] = [];
      $month_name = [1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'];
         foreach($result[1] as $k => $v){
            foreach($month_name as $m => $n){
               if($v['months'] == $m){
                  array_push($temp['month_arr'], [$m => $n]);
               }
            }
         }
         $temp['attendance_count_arr'] = [];
         foreach($temp['month_arr'] as $month_ar_key => $month_ar_val){
            foreach($month_ar_val as $month_ar_key1 => $month_ar_val1){
               $temp['attendance_count_arr'][$month_ar_key1] = [];
            }
         }

         
         $temp_arr = [];
         
         foreach($temp['attendance_count_arr'] as $attendance_count_arr_key => $attendance_count_arr_val){
            foreach($result[2] as $result_key => $result_val){
               if($attendance_count_arr_key == $result_val['month_num']){
               $temp['attendance_count_arr'][$attendance_count_arr_key] = ['attendance_count' => $result_val['attendance_count']];
               array_push($temp_arr, $result_val['month_num']); 
               }
            }
         }

         $i = 0;
         foreach($temp['attendance_count_arr'] as $attendance_count_arr_key => $attendance_count_arr_val){
            //echo count($temp_arr);
            if($i <= count($temp_arr) - 1){
               if($temp_arr[$i] != $attendance_count_arr_key){
                  if(count($attendance_count_arr_val) == 0){
                     $temp['attendance_count_arr'][$attendance_count_arr_key] = ['attendance_count' => '0'];
                     // echo $i.' : '.$temp_arr[$i].' : '.$attendance_count_arr_key.'<br>';
                  }
                
               }
               else{
                  //echo $i.' : '.$temp_arr[$i].' : '.$attendance_count_arr_key.'<br>';
               }
            }
            else{
               
               if(count($attendance_count_arr_val) == 0){
                  $temp['attendance_count_arr'][$attendance_count_arr_key] = ['attendance_count' => '0'];
               }
            }
            $i++;
            
         }




         // Important point to note :- array_push(array, array/value) 
         // array_push() function push a new array or a new element or value inside the parent array by creating a new index
         // array_push() does not override old existing element
         // echo '<pre>';
         // print_r($temp);
         // echo '=====================================================<br>';
         // print_r($result[2]);
         // print_r($temp_arr);
         // echo '</pre>';
         // // echo $count1;
         // // echo $count2;

         // exit();

      return view('student/statistics', $data);
   }


   
 
}


?>