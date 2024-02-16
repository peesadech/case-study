<?php

namespace App\Controllers;
use App\Models\UserModel;
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Services;


class Home extends BaseController
{
    public function index(): string
    {
    //   $key = getenv('JWT_SECRET');
    //   $session = session();
    //   $user_token=$session->get('user_token');
    //   if (empty($user_token)) {
    

    //   $iat = time(); // current timestamp value
    //   $exp = $iat + (3600*24*365);
    //   $user['email']='test@gmail.com';
    //   $payload = array(
    //       "iss" => "Issuer of the JWT",
    //       "aud" => "Audience that the JWT",
    //       "sub" => "Subject of the JWT",
    //       "time"=> date("Y-m-d H:i:s"),
    //       "iat" => $iat, //Time the JWT issued at
    //       "exp" => $exp, // Expiration time of token
    //       "email" => $user['email'],
    //   );
        
    //   $token = JWT::encode($payload, $key, 'HS256');
    //   $newdata = [
    //     'user_token'  => $token,
    //  ];
    
    // $session->set($newdata);
    // echo 'session created';
    //   }else {

    //   $decoded = JWT::decode($user_token, new Key($key, 'HS256'));
    //   dd($user_token,$decoded);
    //   }
    $data=array();
    $session = session();
    $data['authData']['user_logged_in']=false;
    $data['authData']['user_email']='';
   // $loginData['email']=$session->get('email');
    if (!empty($session->get('user_logged_in'))) 
    {
      $data['authData']['user_logged_in']=$session->get('user_logged_in');
      $data['authData']['user_email']=$session->get('email');
      $data['authData']['user_name']=$session->get('user_name');
      return $this->dashboard();
    }else{
  //  dd($data);
        return view('home_index',$data);
    }
    }

    public function dashboard(): string
    {
        //    helper('cookie');    
        // $user_token=get_cookie('user_token');

        //   dd($user_token);
      $data=array();
      $session = session();
      $data['authData']['user_logged_in']=false;
      $data['authData']['user_email']='';
     // $loginData['email']=$session->get('email');
   //  dd($session->get('user_logged_in'));
      if (!empty($session->get('user_logged_in'))) 
      {
        $data['authData']['user_logged_in']=$session->get('user_logged_in');
        $data['authData']['user_email']=$session->get('email');
        $data['authData']['user_name']=$session->get('user_name');
      }
        return view('dashboard',$data);
    }
    public function register()
    {
      $data=array();
      $session = session();
      $data['authData']['user_logged_in']=false;
      $data['authData']['user_email']='';
     // $loginData['email']=$session->get('email');
    // dd($session->get('user_logged_in'));
     if (($session->get('user_logged_in'))) 
      {
        $data['authData']['user_logged_in']=$session->get('user_logged_in');
        $data['authData']['user_email']=$session->get('email');
        $data['authData']['user_name']=$session->get('user_name');
       // return view('dashboard',$data);
       return redirect()->to('dashboard');
       //return $this->dashboard();
      
      }else{
       
        return view('register');
      }
       
    }
    public function registerProcess()
    {
       // dd('aaa');
        $user_email=$this->request->getVar('txt_login_username');
        $model = new UserModel();
        $where=array();
        $where['user_email']= $user_email;
     
        $data=$model->limit(1)->where($where)->findAll();
         if (count($data)>=1){
          $session=session();
          $session->setFlashdata("error_message", "This email(".$user_email.") is already in use. Please choose another one. ");
          $session->setFlashdata("input_email",$user_email);
          return redirect()->to('register');
         }else {

            $data = [
                'user_name' => $this->request->getVar('txt_login_username'),
                'user_email' => $this->request->getVar('txt_login_username'),
                'user_login_username' => $this->request->getVar('txt_login_username'),
                'user_login_password' => password_hash($this->request->getVar('txt_login_password'), PASSWORD_DEFAULT),
                'user_access_type' => 1,
                'user_is_active' => 2,
                ];
              $data['create_date']=date('Y-m-d H:i:s');
              $model->insert($data);
              return view('register_success');
          }

            //$session->setFlashdata("message", "This message is for end users #1");
           // echo json_encode(array("status" => TRUE,"title"=>'Register',"msg"=>"Create Data Success","type"=>"create"));
        
    }
    public function logout()
    {
      $session=session();
      $session->destroy();
      helper('cookie');
      delete_cookie('user_token');  
      set_cookie('user_token', '', time() - 3600);
      $user_token=get_cookie('user_token');
     // dd($user_token);
      //  return view('login');
      //return $this->index();
      return redirect()->to('/login')->deleteCookie('user_token');
     //  return redirect()->to('/');
    }
    public function login(): string
    {
      $data=array();
      $session = session();
      $data['authData']['user_logged_in']=false;
      $data['authData']['user_email']='';
     // $loginData['email']=$session->get('email');
 //    dd($session->get('user_logged_in'));
     if (!empty($session->get('user_logged_in'))) 
      {
        $data['authData']['user_logged_in']=$session->get('user_logged_in');
        $data['authData']['user_email']=$session->get('email');
        $data['authData']['user_name']=$session->get('user_name');
      //  return view('dashboard',$data);
       //return $this->dashboard();
       return view('login_success');
      }else{
        return view('login');
      }
    }
    public function loginProcess()
    {
       $key = getenv('JWT_SECRET');
       $user_name=$this->request->getVar('txt_login_username');
       $user_password=$this->request->getVar('txt_login_password');
        $model = new UserModel();
        $where=array();
        $where['user_login_username']= $user_name;
     
        $data=$model->limit(1)->where($where)->findAll();
         if (count($data)>=1){
            $pass = $data[0]['user_login_password'];
            $verify_password = password_verify($user_password, $pass);
            if ($verify_password) {
                $session = session();
                $remember=1;
                $ses_data = [
                    'user_id' => $data[0]['user_id'],
                    'user_name' => $data[0]['user_name'],
                    'user_email' => $data[0]['user_email'],
                   
                    'user_login_name' => $data[0]['user_login_username'],
                    'user_login_password' => $data[0]['user_login_password'],
                    'user_image_path' => $data[0]['user_image_path'],
                   
                    'user_logged_in' => true,//$remember,
                ];
                $session->set($ses_data);
               
                  
                $token = JWT::encode($ses_data, $key, 'HS256');
                helper('cookie');
                $token_cookie_expire=60*60*24*30*3;
                set_cookie('user_token', $token,$token_cookie_expire);  
         
                return redirect()->to('/dashboard')->withCookies();
         
            }else {
              $session=session();
              $session->setFlashdata("error_message", "Invalid email or password");
              $session->setFlashdata("input_email",$user_name);
              return redirect()->to('login');
              // echo 'Invalid user name or password';
            }
          
         }else {
          $session=session();
          $session->setFlashdata("error_message", "Cannot found user");
          $session->setFlashdata("input_email",$user_name);
          return redirect()->to('login');
           // echo 'Cannot found user ';
         }
      
        
    }

    
}

