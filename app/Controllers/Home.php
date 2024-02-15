<?php

namespace App\Controllers;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('home');
    }

    public function register(): string
    {
        return view('register');
    }
    public function registerProcess()
    {
       // dd('aaa');
        $model = new UserModel();
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
           // echo json_encode(array("status" => TRUE,"title"=>'Register',"msg"=>"Create Data Success","type"=>"create"));
        
    }
    public function login(): string
    {
        return view('login');
    }
    public function loginProcess()
    {
       // dd('aaa');
       $user_name=$this->request->getVar('txt_login_username');
       $user_password=$this->request->getVar('txt_login_password');
      // dd($user_name,$user_password);
        $model = new UserModel();
        $where=array();
        $where['user_login_username']= $user_name;
        //$where['user_login_password']= $user_password;
     
        $data=$model->limit(1)->where($where)->findAll();
       // dd($user_name,$user_password,$data);
         if (count($data)>=1){
          //  dd($data);
            $pass = $data[0]['user_login_password'];
            $verify_password = password_verify($user_password, $pass);
          //  dd($verify_password);
            if ($verify_password) {
                $session = session();
                $remember=1;
                $ses_data = [
                    'user_id' => $data[0]['user_id'],
                    'user_name' => $data[0]['user_name'],
                   
                   
                    'user_image_url' => $data[0]['user_image_path'],
                   
                    'user_logged_in' => $remember,
                ];
                $session->set($ses_data);
                
              //  $this->addLog($ses_data['account_id'], "store/manager/ManagerAuthen", "Login", "success");
             //   return redirect()->to(base_url('store/manager/order'));
             //echo "Success";
           //  $session->setFlashdata('msg', 'Welcome');
            // return redirect()->to(base_url('driver/login'));
              //  return redirect()->to(base_url('driver/dashboard'));
                //return redirect()->to(base_url('driver/ordersend'));
                echo 'Welcome '.$user_name;
            }else {
                echo 'Invalid user name or password';
            }
          
         }else {
            echo 'Cannot found user ';
         }
        // $data = [
        //     'user_name' => $this->request->getVar('txt_login_username'),
        //     'user_email' => $this->request->getVar('txt_login_username'),
        //     'user_login_username' => $this->request->getVar('txt_login_username'),
        //     'user_login_password' => password_hash($this->request->getVar('txt_login_password'), PASSWORD_DEFAULT),
        //     'user_access_type' => 1,
        //     'user_is_active' => 2,
          
        // ];
        //     $data['create_date']=date('Y-m-d H:i:s');
        //     $model->insert($data);
          //  echo json_encode(array("status" => TRUE,"title"=>'Register',"msg"=>"Create Data Success","type"=>"create"));
        
    }
}

