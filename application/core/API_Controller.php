<?php defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require_once APPPATH . '/libraries/REST_Controller.php';
require_once APPPATH . '/libraries/JWT.php';
require_once APPPATH . '/libraries/BeforeValidException.php';
require_once APPPATH . '/libraries/ExpiredException.php';
require_once APPPATH . '/libraries/SignatureInvalidException.php';
use \Firebase\JWT\JWT;

class API_Controller extends REST_Controller
{
	private $user_credential;
    public function auth()
    {
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        //JWT Auth middleware
        $headers = $this->input->get_request_header('Authorization');
        $kunci = $this->config->item('thekey'); //secret key for encode and decode
        $token= "token";
       	if (!empty($headers)) {
        	if (preg_match('/Bearer\s(\S+)/', $headers , $matches)) {
            $token = $matches[1];
        	}
    	}
        try {
           $decoded = JWT::decode($token, $kunci, array('HS256'));
           $this->user_data = $decoded;
        } catch (Exception $e) {
            $invalid = ['status' => $e->getMessage()]; //Respon if credential invalid
            $this->response($invalid, 401);//401
        }
    }
    // method untuk melihat token pada user
    public function generate($var=NULL){
        $this->load->model('login_model');
        $date = new DateTime();
        $username = $this->post('username',TRUE); //ini adalah kolom username pada database yang saya berinama username.
        $pass = $this->post('password',TRUE); //ini adalah kolom password pada database yang saya berinama password.
        $dataadmin = $this->login_model->is_valid($username);
        if (!$this->post('username',TRUE)) {
             $cek=$this->login_model->get_username($this->input->get_request_header('Auth'));
             if ($cek) {
                $dataadmin=$cek;
                $pass = true;
             }
         }
        if ($dataadmin) {
            if ( $pass === true || password_verify($pass,$dataadmin->password)) {

                // if ($var) {

                $payload2['id'] = $dataadmin->id;
                $payload2["username"] = $dataadmin->username;
                $payload2['iat'] = $date->getTimestamp(); //waktu di buat
                $payload2['exp'] = $date->getTimestamp() + (3600*24*14); //satu jam
                $output['refresh_token'] = JWT::encode($payload2,$this->secretkey);
                $insert=[
                    'user_id'=>$dataadmin->id,
                    'refresh_token' => $output['refresh_token'],
                ];
                // }else{

                $payload['id'] = $dataadmin->id;
                $payload["username"] = $dataadmin->username;
                $payload['iat'] = $date->getTimestamp(); //waktu di buat
                // $payload['exp'] = $date->getTimestamp() + (5); //satu jam
                $payload['exp'] = $date->getTimestamp() + (3600*5); //satu jam
                $output['token'] = JWT::encode($payload,$this->secretkey);

                $insert=[
                    'user_id'=>$dataadmin->id,
                    'token' => $output['token'],
                ];   
                // }
                $cek=$this->db->get_where('auth_token',['user_id'=> $dataadmin->id])->num_rows();
                if ($cek) {
                    $this->db
                    ->where('user_id',$dataadmin->id)
                    ->update('auth_token', $insert);
                }else{
                    $this->db->insert('auth_token', $insert);
                }
                if ($var) {
                    return $output['token'];

                }else{
                    return $output;
                }
            } else {
                $this->viewtokenfail($username);
            }
        } else {
            $this->viewtokenfail($username);
        }
    }
}