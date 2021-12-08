<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StaffLoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('staff/StaffModel');
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->library('session');
        // check login_company
        $this->load->helper('func');
        // $this->load->helper('funcStaff');
    }
    public function staff_login()
    {
        $email = $this->input->post('email');
        $pass = $this->input->post('pass');
        if ($email != '' && $pass != '') {
            $curl     = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'https://chamcong.24hpay.vn/service/login_employee.php',
                    CURLOPT_POST => 1,
                    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                    CURLOPT_POSTFIELDS => array(
                        'email' => $email,
                        'pass'     => $pass,
                        'os' 	=> 2,
    				    'from' 	=> 'pc365'
                    )
                )
            );
            $resp = curl_exec($curl);
            $response = json_decode($resp);
            if ($response->error == null) {
                if ($response->data->user_info->ep_authentic > 0) {
                    $token = $response->data->access_token;
                    $id = $response->data->user_info->ep_id;
                    $email = $response->data->user_info->ep_email;
                    $name = $response->data->user_info->ep_name;
                    $avatar = $response->data->user_info->ep_image;
                    $com_id = $response->data->user_info->com_id;
                    $com_name = $response->data->user_info->com_name;
                    $dep_name = $response->data->user_info->dep_name;
                    $ep_phone = $response->data->user_info->ep_phone;
                    $session_staff = [
                        'token'     => $token,
                        'id'        => $id,
                        'email'     => $email,
                        'name'      => $name,
                        'avatar'    => 'https://chamcong.24hpay.vn/upload/employee/' . $avatar,
                        'com_id'    => $com_id,
                        'com_name'  => $com_name,
                        'type'      => 3,
                        'dep_name'  => $dep_name,
                        'ep_phone'  => $ep_phone,
                    ];
                    $this->session->set_userdata('staff', $session_staff);
                    $status = [
                        'status' => 1,
                    ];
                }else{
                    $send_otp = send_otp($email, 1);
                    $status = [
                        'status' => 2,
                    ];
                }
            } else if ($response->error->code == 200) {
                $status = [
                    'status' => 3,
                ];
            }
        } else {
            $status = [
                'status' => 4,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        }
        echo json_encode($status);
    }

    public function xac_thuc_nv()
    {
        $check = checkSession();
        $email = $this->input->get('email');
        if ($check == 0 && $email != '') {
            $this->_data['session'] = $check;
            $this->_data['title'] = 'Xác thực nhân viên';
            $this->_data['style'] = 'nv_out';
            $this->_data['js'] = 'nv_out';
            $this->_data['email'] = $email;
            $this->_data['content'] = 'home/xac_thuc_nv';
            $this->load->view('home/main', $this->_data);
        } else {
            return redirect('/');
        }
    }

    public function gui_lai_otp()
    {
        $email = $this->input->post('email');
        if ($email == '') {
            $status = [
                'result' => false,
            ];
        } else {
            $send_otp = send_otp($email, 1);
            $status = [
                'result' => true,
            ];
        }
        echo json_encode($status);
    }

    public function gui_lai_otp_item1()
    {
        $OTP = rand(100000, 999999);
        $email = $this->input->post('email');
        $query = $this->StaffModel->getpass($email, $OTP);
        if ($query == '') {
            $status['status'] = 'false';
            echo json_encode($status);
        } else {
            $this->db->set('otp', $OTP);
            $this->db->where('email', $email);
            $this->db->update('staff');
            $status['status'] = 'true';
            echo json_encode($status);
        }
    }

    public function staff_getpass()
    {
        $check = checkSession();
        if ($check == 0) {
            $this->_data['session'] = $check;
            $this->_data['title'] = 'Quên mật khẩu nhân viên';
            $this->_data['style'] = 'nv_out';
            $this->_data['js'] = 'nv_out';
            $this->_data['content'] = 'home/staff_getpass';
            $this->load->view('home/main', $this->_data);
        } else {
            return redirect('/');
        }
    }
    public function staff_getpass1()
    {
        $email = $this->input->post('email');
        if ($email == '') {
            $status = [
                'result' => false,
            ];
        }else{
            $send_otp = send_otp($email, 1);
            if ($send_otp->error == null) {
                $status = [
                    'result' => true,
                ];
            }else{
                $status = [
                    'result' => false,
                ];
            }
            // var_dump($send_otp);
        }
        echo json_encode($status);
    }
    public function staff_getpass3()
    {
        $pass = $this->input->post('pass');
        $email = $this->input->post('email');
        $otp1 = $this->input->post('otp1');
        $otp2 = $this->input->post('otp2');
        $otp3 = $this->input->post('otp3');
        $otp4 = $this->input->post('otp4');
        $otp5 = $this->input->post('otp5');
        $otp6 = $this->input->post('otp6');
        $otp = "{$otp1}{$otp2}{$otp3}{$otp4}{$otp5}{$otp6}";
        $result = [];
        if ($email == '' || $pass == '' || $otp == '') {
            $result = [
                'result' => false,
            ];
        } else {
            $curl     = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'https://chamcong.24hpay.vn/service/forget_pass_employee.php',
                    CURLOPT_POST => 1,
                    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL 
                    CURLOPT_POSTFIELDS => array(
                        'email'             => $email,
                        'otp_code'          => $otp,
                        'new_pass'          => $pass,
                    )
                )
            );
            $resp_curl = curl_exec($curl);
            $response_otp = json_decode($resp_curl);
            if ($response_otp->error != null) {
                $result = [
                    'result' => false,
                    'message' => $response_otp->error->message,
                ];
            } else {
                $result = [
                    'result' => true,
                ];
            }
        }
        echo json_encode($result);
    }
}
