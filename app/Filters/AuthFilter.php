<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\UserModel;

class AuthFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $key = getenv('JWT_SECRET');
        helper('cookie');
       $session = session();
       
      
       if (!$session->get('user_logged_in')) 
       {
       
    
          $user_token=get_cookie('user_token');
      
          if (empty($user_token)) {
              return redirect()->to('login');
          }else{
              $decoded = JWT::decode($user_token, new Key($key, 'HS256'));
              $dataToken=json_decode(json_encode($decoded),true);
              $checkByToken=$this->loginProcessByToken($dataToken);
              if (!$checkByToken){
                return redirect()->to('login');
              }
           }
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
    public function loginProcessByToken($param)
    {
       // dd('aaa');
       $result=false;
       $key = getenv('JWT_SECRET');
       //   $key = getenv('JWT_SECRET');
       helper('cookie');
     // dd($param);
       $user_name=$param['user_login_name'];
       $user_password=$param['user_login_password'];
      // dd($user_name,$user_password);
        $model = new UserModel();
        $where=array();
        $where['user_login_username']= $user_name;
        $where['user_login_password']= $user_password;
        //$where['user_login_password']= $user_password;
     
        $data=$model->limit(1)->where($where)->findAll();
        $session = session();
        $session->destroy();
       // dd($user_name,$user_password,$data);
         if (count($data)>=1){
          //  dd($data);
          //  $pass = $data[0]['user_login_password'];
            // $verify_password = password_verify($user_password, $pass);
            // if ($verify_password) {
                 
            //     $remember=1;
                $ses_data = [
                    'user_id' => $data[0]['user_id'],
                    'user_name' => $data[0]['user_name'],
                    'user_email' => $data[0]['user_email'],
                   
                    'user_login_username' => $data[0]['user_login_username'],
                    'user_login_password' => $data[0]['user_login_password'],
                 //   'user_image_path' => $data[0]['user_image_path'],
                   
                    'user_logged_in' => true,//$remember,
                ];
                
                $session->set($ses_data);
               
                  
            //     $token = JWT::encode($ses_data, $key, 'HS256');
            //    // delete_cookie('user_token');  
                 
         
            //   return redirect()->to('/dashboard');
         
            // }else {
            //     echo 'Invalid user name or password';
            // }
            //return 'found logged in';
            $result=true;
          
         }
        //  else {
        //     return 'Cannot found user ';
        //  }
        return $result;
      
        
    }
}
