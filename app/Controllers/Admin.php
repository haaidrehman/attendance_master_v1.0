<?php 
namespace App\Controllers;

use Config\Services;
use App\Models\LoginModel;
use App\Models\BaseModel;
use App\Models\RegisterModel;
use CodeIgniter\I18n\Time;
use CodeIgniter\HTTP\RequestInterface;
class Admin extends BaseController{

   private $session;
   private $email;

	public function __construct(){
      $this->session = Services::session();
      $this->email = Services::email();
		helper(['form', 'date']);
	}
	public function index(){
       
      //  if(!$this->session->has('isAdminLogin')){
      //     return redirect()->to(base_url('/admin'));
      //     exit();
      //  }

       
       echo view('admin/home');
       
	}

	public function admin_login(){
        if($this->session->has('isAdminLogin')){
           $this->session->setTempdata('error', 'You are already logged in', 3);	
           return redirect()->to(base_url('/home'));
           exit();
        }
 

        $data['errors'] = null; 
       // admin_001 => 'admin'
     
	   $model = new LoginModel();

	   if($this->request->getMethod() == 'post'){
          if($this->request->getPost('submit')){
             $validateRules = [
             	'username' => 'required',
             	'password' => 'required'
             ];
             if($this->validate($validateRules)){
                $username = $this->request->getPost('username', FILTER_SANITIZE_STRING);
                $password = $this->request->getPost('password');
                
                
                $admin_data = ['username' => $username];

                $vUname = $model->verifyEmail($admin_data);

                if($vUname != 0){
                    
                    $vPass = $model->verifyPassword($username, $password);

                    if($vPass){
                    	echo "password matched";
                       $vUname = $vUname[0]['username'];
                       $set_admin_login = ['username' => $vUname, 'isAdminLogin' => TRUE];
                	   $this->session->set($set_admin_login);

                	   return redirect()->to(base_url('/home'));
                       exit();
                    }
                    else{
                    	$this->session->setTempdata('pass_error', 'Please enter the valid password', 4);
                    	return redirect()->to(base_url('/admin'));
                    	exit();
                    }    
                }
                else{
                	$this->session->setTempdata('uname_error', 'Username not registered', 4);
                	return redirect()->to(base_url('/admin'));
                }
             }
             else{
                $data['errors'] = $this->validator;
             }
          }
	   }
	   
       echo view('admin/login', $data);
	}


    public function logout(){
        if($this->session->has('isAdminLogin')){
            $this->session->remove(['username', 'isAdminLogin']);
            return redirect()->to(base_url('/admin'));
        }
    }


	public function student_classes(){
      echo view('admin/classes');
	}

	public function teacher_detail(){

      $db = new RegisterModel();
      $data['records'] = $db->get_all_staff();
      if($data['records'] != false){
         $class_list = [];
         for($i = 1; $i <= 12; $i++){
            $class_list[$i] = "Class $i";
         }
         foreach($data['records'] as $k => $v){
            $data['split_names'][$k] = ['fname' => $data['records'][$k]['fname'], 'lname' => $data['records'][$k]['lname']]; 
            $temp = $data['records'][$k]['fname'].' '.$data['records'][$k]['lname'];
            array_splice($data['records'][$k], 1, 2, $temp);
            if($data['records'][$k]['name'] == ''){
               $data['records'][$k]['name'] = 'N/A';
            }
            if($data['records'][$k]['class'] == '0'){
               $data['records'][$k]['class'] = 'N/A';
            }
            foreach($class_list as $k1 => $v1){
               if($data['records'][$k]['class'] == $k1){
                  $data['records'][$k]['class'] = $v1;
               break;
               }
            }
         
         }
      }

		echo view('admin/teachers', $data);
   }
   

   // Teacher Registration
	public function teacher_add(){
      helper('hash_password');

      $data['errors'] = $data['colm_data_exist'] = null;
      if($this->request->getMethod() == 'post'){
         $teacher_data['password'] = $this->request->getPost('password', FILTER_SANITIZE_STRING);
         $teacher_data['password'] = hash_password($teacher_data['password']);
         $validateRules = ['fname' => 'required|string', 'lname' => 'required|string', 'gender' => 'required', 'phone' => 'required|string', 'email' => 'required|valid_email', 'username' => 'required|string', 'password' => 'required|string', 'address' => 'required|string'];
        
         if($this->validate($validateRules)){
            $teacher_data['fname'] = $this->request->getPost('fname', FILTER_SANITIZE_STRING);
            $teacher_data['lname'] = $this->request->getPost('lname', FILTER_SANITIZE_STRING);
            $teacher_data['gender'] = $this->request->getPost('gender', FILTER_SANITIZE_STRING);
            $teacher_data['phone'] = $this->request->getPost('phone', FILTER_SANITIZE_STRING);
            $teacher_data['email'] = $this->request->getPost('email', FILTER_VALIDATE_EMAIL);
            $teacher_data['username'] = $this->request->getPost('username', FILTER_SANITIZE_STRING);
            
            $teacher_data['address'] = $this->request->getPost('address', FILTER_SANITIZE_STRING);
            $teacher_data['token'] = md5(str_shuffle('abcdefghijklmmnopqrstuvwxyz'.uniqid().time()));
            $db = new RegisterModel();
            $table = 'teacher';
            $check_data = ['phone' => $teacher_data['phone'], 'email' =>  $teacher_data['email'], 'username' => $teacher_data['username']];

            if($teacher_data['password'] !== 0){
               
               $fetchedData = $db->email_exists($check_data, $table);
               if($fetchedData['status']){
                  if($db->insert_data($teacher_data, $table)){
                     // Implement OTP verification
                     $link = base_url().'/register/activate/'.$teacher_data['token'];
                     $html = "<div class='link-area' style='max-width: 400px; background: #d7e8f9; margin:0 auto; padding: 25px 28px 10px 28px; text-align:center; font-family: sans-serif; border-radius: 15px; box-shadow: -4px 5px 23px -6px; margin-top: 20px; color: #6c757d;'>
                 <h4 style='padding-bottom: 10px;'>Hi {$teacher_data['fname']} {$teacher_data['lname']} </h4> <p>Thanks your account created successfully. Please click the below link to activate your account</p> <p><a href='{$link}' target='_blank' style='color: #03a9f3;'>Activate Now</a></p>
                 </div>";
                     $subject = 'Account activation link';
                     $emailConfig = [
                        'protocol' => 'smtp',
                        'SMTPHost' => '127.0.0.1',
                        'SMTPPort' => '1025',
                        'SMTPCrypto' => '',
                        'mailType' => 'html'
                     ];
                     $this->email->initialize($emailConfig);
                     $this->email->setFrom('haaidrehman086@gmail.com', 'Haaid Rehman');
                     $this->email->setTo($teacher_data['email']);
                     $this->email->setSubject($subject);
                     $this->email->setMessage($html);
                     if($this->email->send()){
                        $this->session->setTempdata('staff_reg_success', 'Registration successfull', 2);
                        $activation_date = date('Y-m-d h:i:s', now('Asia/Kolkata'));
                        $db->emailinkActivationDate($teacher_data['token'], $activation_date);
                        return redirect()->to(current_url());
                        exit();
                     }
                     else{
                        $this->session->setTempdata('staff_error', 'Registration successfull. Sorry unable to send activation link. Contact Admin.', 2);
                     }
                  }
               }
               else{
                  $row = [];
                  if($teacher_data['phone'] == $fetchedData['row'][0]['phone']){
                    $row['phone_err'] = 'Phone number already registered'; 
                  }
                  if($teacher_data['email'] == $fetchedData['row'][0]['email']){
                     $row['email_err'] = 'Email already registered'; 
                  }
                  if($teacher_data['username'] == $fetchedData['row'][0]['username']){
                     $row['username_err'] = 'Username already registered'; 
                  }
                  $data['colm_data_exist'] = $row;
               }
            }
            else if($teacher_data['password'] === 0){
               $data['errors']['password'] = 'Password must be b/w 6 to 12 characters which contain at least One Numeric digit, One Uppercase and One Lowercase letter.';
            }
         }
         else{
            foreach($validateRules as $k => $v){
               
               if($this->validator->hasError($k)){
                  if($k == 'fname'){
                     $data['errors'][$k] =  $this->validator->getError($k);
                     $data['errors'][$k] = str_replace('fname', 'first name', $data['errors'][$k]);
                  }
                  else if($k == 'lname'){
                     $data['errors'][$k] = $this->validator->getError($k);
                     $data['errors'][$k] = str_replace('lname', 'last name', $data['errors'][$k]);
                  }
                  else{
                     $data['errors'][$k] = $this->validator->getError($k);
                  }
               }
            }
            if(!$teacher_data['password']){
               $data['errors']['password'] = 'Password must be b/w 6 to 12 characters which contain at least One Numeric digit, One Uppercase and One Lowercase letter.';
            }
         }
      }
      
		echo view('admin/teacher_add', $data);
	}


   public function resendActivationLink($email){
      
      if(preg_match('/^[a-zA-Z]+(_|\.)?[a-zA-Z0-9]*@[a-z]+\.(com)$/', $email)){
         $db = new RegisterModel();
         $data = ['email' => $email, 'table' => 'teacher'];
         $row = $db->isEmailExist($data);
         if($row != false){

            $token = $row->token;
            $link = base_url().'/register/activate/'.$token;
            $date = date('Y-m-d h:i:s', now('Asia/Kolkata'));
            $emailConfig = [
               'protocol' => 'smtp',
               'SMTPHost' => '127.0.0.1',
               'SMTPPort' => '1025',
               'SMTPCrypto' => '',
               'mailType' => 'html'
            ];
            
            $this->email->initialize($emailConfig);
             // Implement OTP verification
             $link = base_url().'/register/activate/'.$token;
             $html = "<div class='link-area' style='max-width: 400px; background: #d7e8f9; margin:0 auto; padding: 25px 28px 10px 28px; text-align:center; font-family: sans-serif; border-radius: 15px; box-shadow: -4px 5px 23px -6px; margin-top: 20px; color: #6c757d;'>
         <h4 style='padding-bottom: 10px;'>Hi {$row->fname} {$row->lname} </h4> <p>Thanks your account created successfully. Please click the below link to activate your account</p> <p><a href='{$link}' target='_blank' style='color: #03a9f3;'>Activate Now</a></p>
         </div>";
             $subject = 'Account activation link';
             $this->email->setFrom('haaidrehman086@gmail.com', 'Haaid Rehman');
             $this->email->setTo($email);
             $this->email->setSubject($subject);
             $this->email->setMessage($html);
             if($this->email->send()){
               $db->emailinkActivationDate($token, $date);
               $this->session->setTempdata('resend_link', 'A new activation link has been sent to '.$email, '2');
               return redirect()->back();
             }
         } 
      }
   } 



   // Verify token to activate teacher status
   public function verifyToken($token){
      $data['success_msg'] = $data['err_msg'] = null; 
      $db = new RegisterModel();
      $result = $db->checkToken($token);
      if($result != false){
         if($this->verifyExpiryTime($result->activation_date)){
            if($result->status == 'inactive'){
               if($this->accActivate($token)){
                  $data['success_msg'] = 'Account activated successfully.';
               }
            }
            else{
               $data['success_msg'] = 'Your account is already activated.';
            }
         }
         else{
            $data['err_msg'] = 'Sorry! activation link was expired. Please contact the Admin.';
         }
        
      }
      else{
         $data['err_msg'] = 'Sorry! we are unable to find your account';
      }
       return view('admin/verify_token', $data);
   }  

   // Check the link expiry time while counting the diff b/w the activation time and current time
   public function verifyExpiryTime($regTime){

      $currentTime = date('Y-m-d h:i:s', now('Asia/Kolkata'));
      
      $timeDiff = strtotime($currentTime) - strtotime($regTime);
      if($timeDiff < 3600){
         return true;
      }
      else{
         return false;
      }
  }

  // If expiry time is less than 1 hour then activate account staus
   public function accActivate($getToken){
      $db = new RegisterModel();
      return $db->activateStatus($getToken);
     
   }


   public function teacher_manage(){
      // echo '<pre>';
      // print_r($this->request->getPost());
      // $staff_id = $this->request->getPost('staff_id');
      // echo  $staff_id;     
      // exit();
      if($this->request->getMethod() == 'post'){
         $validateRules = ['fname' => 'required|string', 'lname' => 'required|string', 'email' => 'required|valid_email', 'phone' => 'required|integer|min_length[10]', 'class' => 'required|string', 'subject' => 'required|string'];
         if($this->validate($validateRules)){

            $greet = 'Mr.';
            if($this->request->getPost('gender') == 'Female'){
               $greet = 'Mrs.';
            }
            $staff_id = $this->request->getPost('staff_id');
            
            $class_arr = [];
            for($k = 0; $k <= 1; $k++){
            for($i = 1; $i <= 12; $i++){
               if($k == 0){
                  $class_arr[$k][$i] = "Class $i";
               }
               else{
                  $class_arr[$k][$i] = "class $i";
               }
            }
         }
         $loop_exit = 0;
         foreach($class_arr as $k => $v){
            if($loop_exit == 1){
            break;
            }
            foreach($v as $k1 => $v1){
               if($this->request->getPost('class') == $v1){
                   $class = $k1;
                   $loop_exit = 1;
                   break;
               }
            }
          }

            if($loop_exit == 1){
               $db = new RegisterModel();
               $result = $db->checkStatus($staff_id);
               echo '<pre>';
               print_r($result);
               if($result != false){
                  if($result->status == 'active'){
                     $passRecords = [];
                     $passRecords['fname'] = $this->request->getPost('fname');
                     $passRecords['lname'] = $this->request->getPost('lname');
                     $passRecords['email'] = $this->request->getPost('email');
                     $passRecords['phone'] = $this->request->getPost('phone');
                     $passRecords['class'] = $class;
                     // echo $passRecords['class'];exit();
                     $passRecords['subject'] = $this->request->getPost('subject');
                     if($this->updateStaff($db, $staff_id, $passRecords)){
                        $this->session->setTempdata('staff_record_update', 'Record for '.$greet.' '.$passRecords['fname'].' '.$passRecords['lname'].' updated sucessfully', 2);
                     }
                     else{
                        echo 'Something went wrong';
                     }
                  }
                  else{
                     $this->session->setTempdata('staff_record_update_err', 'Unable to update record. Status of '.$greet.' '.$this->request->getPost('fname').' '.$this->request->getPost('lname').' is currently inactive', 2);
                  }
               } 
            }
            else{
               $this->session->setTempdata('staff_record_update_err', 'Please assign class first to '.$greet.' '.$this->request->getPost('fname').' '.$this->request->getPost('lname'), 2);
            }
         }
         else{
            print_r($this->validator->listErrors());
         }
      }
      return redirect()->to(base_url().'/teachers');
   }
   
   public function updateStaff($dbInstance, $getStaffId, $getPassedRecords){
      return $dbInstance->updateStaffRecord($getStaffId, $getPassedRecords);
   }

   public function sendActivationLink(){
      
   }


   public function class_categories(){

      $db = new BaseModel();
      $row = $db->class_based_registrations();
      // echo '<pre>';
      // print_r($row);
      // echo '</pre>';
      // exit(); 
      if($row != null){
      //   $new_row = []; 
        $i = 0;
        foreach($row as $v){
            $row[$i]['id'] = $v['id'];  
            $row[$i]['class'] = $v['class'];
            if($v['status'] == '0'){
               $row[$i]['status'] = $v['status'];
               $row[$i]['new_reg'] = 'YES';
            }
            else{
               $row[$i]['new_reg'] = 'NO';
               unset($row[$i]['status']);
            }
            $i++;
        }
         
      }
      // echo '<pre>';
      // print_r($row);
      // echo '</pre>';
      // exit();
      $data['records'] = $row;

      return view('admin/class_categories', $data);
   }

   public function class_list($class = ''){
      $data['class_id'] = null;
      $db = new BaseModel();
      if(!empty($class)){
         $class = filter_var($class, FILTER_SANITIZE_STRING);
         $data['class_id'] = $class;
      }
      $data['records'] = $db->get_class($class);
      return view('admin/class_list', $data);
   }

   public function class_time_tbl(){

      return view('admin/time_tbl.php');
   }

	public function student_add($class, $uniqid = ''){
      //$data['updated_records'] = null;
      $data['std_class'] = $class;
    $db = new BaseModel();

    if(!empty($uniqid)){
       $uniqid = filter_var($uniqid, FILTER_SANITIZE_STRING);
       $res = $db->add_to_student($uniqid);
       if($res){
          $this->session->setTempdata('student_added', 'A new student added successfully', 2);
          return redirect()->to(base_url('/registrations/class/'.$class));
          exit();
       }
    }

      $data['records'] = $db->get_new_registrations($class);

		echo view('admin/student_add', $data);
   }
   

   public function update_rollno($class, $std_id, $roll_no){

       if(filter_var($class, FILTER_VALIDATE_INT) < 1 || filter_var($std_id, FILTER_VALIDATE_INT) < 1 || filter_var($roll_no, FILTER_VALIDATE_INT) < 1){
          return redirect()->to(base_url('/class/detail'));
          exit();
       }     

       $class = filter_var($class, FILTER_VALIDATE_INT);
       $std_id = filter_var($std_id, FILTER_VALIDATE_INT);
       $roll_no = filter_var($roll_no, FILTER_VALIDATE_INT);

       $db = new baseModel();
       $roll_updated = $db->add_student_roll_no($class, $std_id, $roll_no);
       if($roll_updated){
          return redirect()->to(base_url('/class/detail/'.$class));
       }
   }
}

?>