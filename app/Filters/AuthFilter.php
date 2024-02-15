<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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
        //   $key = getenv('JWT_SECRET');
        helper('cookie');
    //   $session = session();
    //   $user_token=$session->get('user_token');
    //   dd($user_token);
    $user_token=get_cookie('user_token');
   // dd($user_token);
      if (empty($user_token)) {
    //       $iat = time(); // current timestamp value
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
    //   set_cookie('user_token', $token, 14400);  
     // return redirect()->to('/login');
      }else{
        $decoded = JWT::decode($user_token, new Key($key, 'HS256'));
        $dataToken=json_decode(json_encode($decoded),true);
        $ses_data = [
         //   'admin_id' => 1,
          //  'admin_name' => "Super Admin",
            'user_email' => $dataToken['user_email'],
            'user_name' => $dataToken['user_name'],
            'user_login_password' => $dataToken['user_login_password'],
            'user_level_id' => -1,
           // 'user_image_url' => 'app-assets/images/avatars/admin.png',
         
            'user_logged_in' => true,
        ];
      
      //  dd($decoded,$dataT);
        $session = session();
        $session->set($ses_data);
       // $session->set_userdata('used_data',$dataT);
       // $session->set($decoded);
      //  return redirect()->to(route_to('home'))->withCookies();
        //dd($user_token,$decoded);
      }
       // $header = $request->getHeader("Authorization");
       // $token = null;
  
        // extract the token from the header
        // if(!empty($header)) {
        //     if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
        //         $token = $matches[1];
        //     }
        // }
  
        // // check if token is null or empty
        // if(is_null($token) || empty($token)) {
        //     $response = service('response');
        //     $response->setBody('Access denied');
        //     $response->setStatusCode(401);
        //     return $response;
        // }
  
        // try {
        //     // $decoded = JWT::decode($token, $key, array("HS256"));
        //     $decoded = JWT::decode($token, new Key($key, 'HS256'));
        // } catch (Exception $ex) {
        //     $response = service('response');
        //     $response->setBody('Access denied');
        //     $response->setStatusCode(401);
        //     return $response;
        // }
        //
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
}
