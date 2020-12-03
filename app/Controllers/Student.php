<?php
namespace App\Controllers;

use Config\Services;
use App\Models\RegisterModel;
use App\Models\LoginModel;

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
      $data = ['valid_err_email' => null, 'valid_err_pass' => null];
       if($this->request->getMethod() == 'post'){
        $validation_rules = ['email' => 'required|valid_email', 'password' => 'required|string'];
        
          if($this->validate($validation_rules)){
            $data['email'] = $this->request->getPost('email', FILTER_VALIDATE_INT); 
            $data['password'] = $this->request->getPost('password', FILTER_SANITIZE_STRING); 

             $db = new LoginModel();
             $data['table'] = 'student';
             $result = $db->check_record_n_allow($data);
             if($result['result'] == 'success'){
               $this->session->set(['isStdLogin' => true, 'stdId' => $result['user_id'], 'stdName' => $result['user_fname'].' '.$result['user_lname']]);
               return redirect()->to(base_url().'/student/account');
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
      echo '<pre>';
      print_r($_SESSION);
      echo '</pre>';
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
      return view('student/account');
   }


}


?>