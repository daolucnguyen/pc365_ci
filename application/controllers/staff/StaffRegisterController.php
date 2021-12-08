<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StaffRegisterController extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('staff/StaffModel');
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('func');
        // $this->load->helper('funcStaff');
    }
    public function staff_register()
    {
        $check = checkSession();
        if ($check == 0) {

            $data['session'] = $check;
            $data['title'] = 'Đăng ký nhân viên';
            $data['style'] = 'nv_out';
            $data['js'] = 'nv_out';
            $data['content'] = 'home/staff_register';
            $this->load->view('home/main', $data);
        } else {
            return redirect('/');
        }
    }

    public function detail_company($id_com)
    {
        $header[]         = 'Authorization:';
        $status = 'true';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/detail_company.php?id_com=' . $id_com;
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $response = json_decode($resp);
        return $response;
    }
    public function staff_register_checkid()
    {
        $id_com = $this->input->post('id_company');
        $response = $this->detail_company($id_com);
        $result = [];
        if ($response->error == null) {
            $result = [
                'result' => true,
            ];
        } else {
            $result = [
                'result' => false,
                'message' => $response->error->message,
            ];
        }
        echo json_encode($result);
    }
    public function staff_register_checkemail()
    {
        $email = $this->input->post('email');
        $query = $this->StaffModel->checkemail($email);
        if ($query > 0) {
            $status['status'] = 'false';
            echo json_encode($status);
        } else {
            $status['status'] = 'success';
            echo json_encode($status);
        }
    }
    public function show_nest_by_id_dep()
    {
        $dep_id = $this->input->post('dep_id');
        $com_id = $this->input->post('com_id');
        $result = [];
        if ($com_id == 0 || $dep_id == 0) {
            $result = [
                'result' => false,
            ];
        } else {
            $header[]         = 'Authorization:';
            $status = 'true';
            $curl     = curl_init();
            $url = 'https://chamcong.24hpay.vn/api_web_cham_cong/list_nest_dk.php?id_nest=' . $dep_id . '&cp=' . $com_id;
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
            ));
            $resp = curl_exec($curl);
            $response = json_decode($resp);
            if ($response->error != null) {
                $result = [
                    'result' => false,
                ];
            } else {
                $result = [
                    'result' => true,
                    'list_nest' => $response->data->items,
                ];
            }
        }
        echo json_encode($result);
    }

    public function show_group_by_id_nest()
    {
        $nest_id = $this->input->post('nest_id');
        $com_id = $this->input->post('com_id');
        $result = [];
        if ($com_id == 0 || $nest_id == 0) {
            $result = [
                'result' => false,
            ];
        } else {
            $header[]         = 'Authorization:';
            $status = 'true';
            $curl     = curl_init();
            $url = 'https://chamcong.24hpay.vn/api_web_cham_cong/list_nhom_dk.php?id_nhom=' . $nest_id . '&cp=' . $com_id;
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
            ));
            $resp = curl_exec($curl);
            $response = json_decode($resp);
            if ($response->error != null) {
                $result = [
                    'result' => false,
                ];
            } else {
                $result = [
                    'result' => true,
                    'list_nest' => $response->data->items,
                ];
            }
        }
        echo json_encode($result);
    }
    public function insert()
    {
        $com_id = $this->input->post('id');
        $email = $this->input->post('email');
        $pass = $this->input->post('pass');
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');
        $gender = $this->input->post('gender');
        $brith = $this->input->post('brith');
        $marriage = $this->input->post('marriage');
        $education = $this->input->post('education');
        $experience = $this->input->post('experience');
        $date_join = $this->input->post('date_join');
        $dep_id = $this->input->post('department');
        $position_id = $this->input->post('position');
        $group = $this->input->post('group');
        $nest = $this->input->post('nest');
        $result = [];
        if ($com_id == '' || $email == '' || $pass == '' || $name == '' || $phone == '' || $address == '' || $dep_id == '' || $position_id == '') {
            $result = [
                'result' => 1,
            ];
        } else {
            $curl = curl_init();
            $data = array(
                'email' => $email,
                'ep_name' => $name,
                'ep_phone' => $phone,
                'password' => $pass,
                'ep_address' => $address,
                'dep_id' => $dep_id,
                'com_id' => $com_id,
                'role' => 3,
                'position_id' => $position_id,
                'gioi_tinh' => $gender,
                'user_birthday' => $brith,
                'hoc_van' => $education,
                'start_time' => $date_join,
                'hon_nhan' => $marriage,
                'n_kinh_nghiem' => $experience,
            );
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'https://chamcong.24hpay.vn/api_web_cham_cong/add_employee.php',
                    CURLOPT_POST => 1,
                    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL 
                    CURLOPT_POSTFIELDS => $data
                )
            );
            $resp_curl = curl_exec($curl);
            $response = json_decode($resp_curl);
            if ($response->error != null) {
                $result = [
                    'result' => 2,
                    'message' => $response->error->message,
                ];
            } else {
                $responsive_otp = send_otp($email, 1);
                // $session_email = [
                //     'email' => $com_email,
                //     'type' => 2,
                //     'id' => $responsive->data->id
                // ];
                // $this->session->set_userdata('email', $session_email);
                $result = [
                    'result' => 3,
                    'message' => 'Đăng ký tài khoản thành công'
                ];
            }
        }
        echo json_encode($result);
    }

    public function retypeMail()
    {
        $email = $this->input->post('email');
        if ($email == '') {
            $result = [
                'status' => false,
            ];
        } else {
            $responsive_otp = send_otp($email, 1);
            $result = [
                'status' => true,
            ];
        }
        echo json_encode($result);
    }

    public function staff_register_checkotp()
    {
        $email = $this->input->post('email');
        $otp1 = $this->input->post('otp1');
        $otp2 = $this->input->post('otp2');
        $otp3 = $this->input->post('otp3');
        $otp4 = $this->input->post('otp4');
        $otp5 = $this->input->post('otp5');
        $otp6 = $this->input->post('otp6');
        $otp = "{$otp1}{$otp2}{$otp3}{$otp4}{$otp5}{$otp6}";
        if ($email != '' && $otp != '') {
            $curl     = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'https://chamcong.24hpay.vn/service/verify_otp.php',
                    CURLOPT_POST => 1,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_POSTFIELDS => array(
                        'email'        => $email,
                        'type_user'    => 1,
                        'otp_code'     => $otp,
                    )
                )
            );
            $resp_curl = curl_exec($curl);
            $response_otp = json_decode($resp_curl);
            if ($response_otp->error == null) {
                $data = [
                    'result' => 2,
                ];
            } else {
                $data = [
                    'result' => 1,
                ];
            }
        } else {
            $data = [
                'result' => 3,
            ];
        }
        echo json_encode($data);
    }

    public function staff_regis_step4()
    {
        $email = $this->input->post('email');
        $img = $this->input->post('img');
        // if ($upload == true) {
        $status = array('result' => true);
        // } else {
        //     $status = array('status' => false);
        // }
        echo json_encode($status);
    }

    public function getListDepartment()
    {
        $id_company = $this->input->post('id_company');
        $id_com_small = 0;
        $response = $this->detail_company($id_company);
        $list_depatment = $response->data->list_department;
        $data = [];
        foreach ($list_depatment as $value) {
            $data[] = [
                'id' => $value->dep_id,
                'name_department' => $value->dep_name,
            ];
        }
        echo json_encode($data);
    }

    public function getListPosition()
    {
        $list_depatment = $this->StaffModel->getListPosition();
        $data = [];
        foreach ($list_depatment as $value) {
            $data[] = [
                'id' => $value['id_position'],
                'name_position' => $value['name_position'],
            ];
        }
        echo json_encode($data);
    }
}
