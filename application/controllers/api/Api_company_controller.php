<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/jwt/JWT.php';

use \Firebase\JWT\JWT;

class Api_company_controller extends CI_Controller
{

    protected $secretKey = 'Chamcong365@';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Api_company_model');
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->helper('api_result');
        $this->load->library('upload');
    }


    function detailEmploye($token, $employee_id)
    {
        $secretKey = $this->secretKey;
        $time = time();
        $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
        if ($decodeToken->exp < $time) {
            return 'Token đã hết hạn';
        } else {
            // $token = $decodeToken->token;
            $ep_id = $decodeToken->data->id;
            if ($employee_id != 0) {
                $ep_id = $employee_id;
            }
            $com_id = $decodeToken->data->id;
            $access_token     = $token;
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[ep_id]=' . $ep_id . '&id_com=' . $com_id,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
            ));
            $resp = curl_exec($curl);
            return json_decode($resp);
            curl_close($curl);
        }
    }

    public function companyLogin()
    {
        $email    = $this->input->post('email');
        $password = $this->input->post('pass');

        if ($email == "" || $password == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            // $data = [
            //     'email'    => $email,
            //     'password' => md5($password),
            // ];
            $curl     = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'https://chamcong.24hpay.vn/service/login_company.php',
                    CURLOPT_POST => 1,
                    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                    CURLOPT_POSTFIELDS => array(
                        'email' => $email,
                        'pass'     => $password
                    )
                )
            );
            $resp = curl_exec($curl);
            $responsive = json_decode($resp);
            if ($responsive->error != null) {
                if ($responsive->error->code == 200) {
                    set_error(404, $responsive->error->message);
                }
            } else {
                $company_arr = [
                    'id'   =>  (int)$responsive->data->user_info->com_id,
                    'name' => $responsive->data->user_info->com_name,
                    'email' => $responsive->data->user_info->com_email,
                    'phone' => $responsive->data->user_info->com_phone,
                    'com_address' => $responsive->data->user_info->com_address,
                    'avatar' => $responsive->data->user_info->com_logo,
                    'role' => $responsive->data->user_info->com_role_id,
                    'com_path' => $responsive->data->user_info->com_path,
                    'admin' => 'quản trị chính',
                ];
                $secretKey              = $this->secretKey;
                $arrToken               = array();
                $arrToken['id']         =  (int)$responsive->data->user_info->com_id;
                $arrToken['name']       =  $responsive->data->user_info->com_name;
                $arrToken['email']      =  $responsive->data->user_info->com_email;
                $arrToken['type']       = 1;
                $arrToken['exp']    = time() + 86400 * 7;
                $arrToken['token']      = $responsive->data->access_token;
                $token = JWT::encode($arrToken, $secretKey);
                $data  = [
                    'token' => $token,
                    'info' => $company_arr,
                    'type' => $responsive->data->user_info->com_role_id,
                ];
                success('Đăng nhập thành công', $data);
            }
        }
    }
    public function companyRegister()
    {
        $secretKey = $this->secretKey;

        $OTP       = rand(100000, 999999);
        $email     = $this->input->post('email');
        $pass      = $this->input->post('pass');
        $com_name  = $this->input->post('com_name');
        $alias     = url_title(convert_accented_characters($com_name));
        $telephone = $this->input->post('phone');
        $address   = $this->input->post('address');
        // $city      = $this->input->post('city');
        // $district  = $this->input->post('district');
        if ($email == "" || $pass == "" || $com_name == "" || $telephone == "" || $address == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $curl     = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'https://chamcong.24hpay.vn/service/register_company.php',
                    CURLOPT_POST => 1,
                    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                    CURLOPT_POSTFIELDS => array(
                        'email'             => $email,
                        'company_name'      => $com_name,
                        'company_phone'     => $telephone,
                        'company_address'   => $address,
                        'password'          => $pass,
                    )
                )
            );
            $resp = curl_exec($curl);
            $responsive = json_decode($resp);
            if ($responsive->error != null) {
                set_error(404, $responsive->error->message);
            } else {
                success('Mã xác thực đã được gửi. Vui lòng  kiểm tra lại email', []);
            }
        }
    }
    public function checkCompanyRegisterOtp()
    {
        $secretKey = $this->secretKey;
        $token     = $this->input->post('token');
        $otp       = $this->input->post('otp');

        if ($token == "" || $otp == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $time        = time();
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $com_id = $decodeToken->data->id;

                $checked = $this->Api_company_model->checkOTP($com_id, $otp);
                if ($checked == 0) {
                    set_error(404, 'Sai OTP');
                } else {
                    $data = [
                        'com_id' => $com_id,
                    ];
                    // var_dump($data);
                    // die();
                    $insert = $this->Api_company_model->createConfig($data);
                    $this->Api_company_model->verifyRegister($com_id);

                    $infoCompany = $this->Api_company_model->infoCompany($com_id);
                    $secretKey              = $this->secretKey;
                    $arrToken               = array();
                    foreach ($infoCompany as $key => $value) {
                        $avatar_name = '';
                        if ($value->com_avatar == "") {
                            $avatar_name = base_url() . "/images_staff/avatar_default.png";
                        } else {
                            $avatar_name = $value->com_avatar;
                        }
                        $company_arr = [
                            'id'   => (int)$com_id,
                            'name' => $value->com_name,
                            'email' => $value->com_email,
                            'phone' => $value->com_phone,
                            'com_city' => $value->com_city,
                            'com_district' => $value->com_district,
                            'com_address' => $value->com_address,
                            'avatar' => $avatar_name,
                            'role' => $value->type_sign_up,
                            'admin' => 'quản trị chính',
                        ];
                    }
                    foreach ($infoCompany as $company) {
                        $com_id         = $company->com_id;
                        $com_name       = $company->com_name;
                        $com_email      = $company->com_email;
                        $type           = $company->type_sign_up;
                        $created_at     = $company->created_at;
                    }
                    $arrToken['id']         = (int)$com_id;
                    $arrToken['name']       = $com_name;
                    $arrToken['email']      = $com_email;
                    $arrToken['type']       = $type;
                    $arrToken['created_at'] = $created_at;
                    $arrToken['exp']    = time() + 86400 * 7;

                    $token = JWT::encode($arrToken, $secretKey);
                    $data  = [
                        'token' => $token,
                        'info' => $company_arr,
                        'type' => $type,
                    ];
                    success('Đăng kí công ty thành công', $data);
                }
            }
        }
    }
    public function resendOTP()
    {
        $secretKey = $this->secretKey;
        $token     = $this->input->post('token');
        $title     = $this->input->post('title');
        $OTP       = rand(100000, 999999);

        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $time        = time();
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $com_id   = $decodeToken->data->id;
                $com_name = $decodeToken->name;
                $email    = $decodeToken->email;

                $body  = file_get_contents('email_template/email.html');
                $body  = str_replace('%name%', $com_name, $body);
                $body  = str_replace('%otp%', $OTP, $body);
                $title = "Xác thực tài khoản công ty";
                $this->Api_company_model->SendMailAmazon($title, $com_name, $email, $body);
                $data = [
                    'com_otp' => $OTP,
                ];
                $condition = [
                    'com_id' => $com_id,
                ];
                $this->Api_company_model->updateCompany($data, $condition);
                success('Gữi mã xác thực OTP thành công', []);
            }
        }
    }
    public function createSchedule()
    {
        $token          = $this->input->post('token');
        $name           = $this->input->post('name');
        $place          = $this->input->post('place');
        $lat_long       = $this->input->post('lat_long');
        $staff_id       = $this->input->post('staff_id');
        $date_start     = $this->input->post('date_start');
        $date_end       = $this->input->post('date_end');
        $note           = $this->input->post('note');
        $secretKey      = $this->secretKey;
        $time           = time();

        if ($token == "" || $name == "" || $staff_id == "" || $date_start == "" || $date_end == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {

            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $com_id = $decodeToken->data->id;
                //Tạo lịch trình
                $date_start = strtotime($date_start);
                $date_end = strtotime($date_end);
                $schedule = [
                    'com_id'     => $com_id,
                    'com_small_id' => 0,
                    'name'       => $name,
                    'date_start' => $date_start,
                    'date_end'   => $date_end,
                    'note'       => $note,
                ];
                $schedule_id = $this->Api_company_model->createSchedule($schedule);
                //Tạo địa điểm lịch trình
                $place = explode(';', $place);
                $lat_long = explode(';', $lat_long);
                $arr_sch = [];
                $arr_id = [];
                for ($i = 0; $i < count($place); $i++) {
                    $ex = explode(',', $lat_long[$i]);
                    // for ($j = 0; $j < count($ex); $j++){
                    $sch_placell = [
                        'schedule_id'       => $schedule_id,
                        'place'             => $place[$i],
                        'lat'               => $ex[0],
                        'long'               => $ex[1],
                        // 'staff_id'          => $value,
                    ];
                    $arr_id[] = $this->Api_company_model->createSchedulePlaceLatLong($sch_placell);
                    // }
                }
                // var_dump($arr_id);
                // die();
                $staff = explode(',', $staff_id);
                foreach ($staff as $value) {
                    for ($i = 0; $i < count($arr_id); $i++) {
                        $schedule_place = [
                            'schedule_id'       => $schedule_id,
                            'id_lat_long'       => $arr_id[$i],
                            'staff_id'          => $value,
                        ];
                        $this->Api_company_model->createSchedulePlace($schedule_place);
                    }
                }
                //Thêm nhân viên vào lịch trình
                foreach ($staff as $value) {
                    $schedule_staff = [
                        'schedule_id' => $schedule_id,
                        'staff_id'    => $value,
                        'status'      => 4,
                    ];
                    $this->Api_company_model->createScheduleStaff($schedule_staff);

                    $noti = 'đã thêm bạn vào 1 lịch trình mới';
                    $data_notify = [
                        'company' => $com_id,
                        'notify_to_staff' => $value,
                        'note' => $noti,
                        'date' => time(),
                        'status' => 2,
                        'job_schedule' => $schedule_id,
                        'type' => 2,
                        'image_notify' => 5,
                    ];
                    $add_notify = $this->Api_company_model->create_notify($data_notify);
                }
                success('Thêm lịch trình thành công', []);
            }
        }
    }

    public function updateSchedule()
    {
        $token          = $this->input->post('token');
        $id_schedule    = $this->input->post('id_schedule');
        $name           = $this->input->post('name');
        $place          = $this->input->post('place');
        $lat_long       = $this->input->post('lat_long');
        $staff_id       = $this->input->post('staff_id');
        $date_start     = $this->input->post('date_start');
        $date_end       = $this->input->post('date_end');
        $note           = $this->input->post('note');
        $secretKey      = $this->secretKey;
        $time           = time();

        if ($token == "" || $id_schedule == "" || $name == "" || $staff_id == "" || $date_start == "" || $date_end == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {

                $com_id = $decodeToken->data->id;
                //Tạo lịch trình
                $date_start = strtotime($date_start);
                $date_end = strtotime($date_end);
                $id = [
                    'id' => $id_schedule,
                ];
                $schedule = [
                    'name'       => $name,
                    'date_start' => $date_start,
                    'date_end'   => $date_end,
                    'note'       => $note,
                ];
                $update_schedule = $this->Api_company_model->updateSchedule($schedule, $id);
                $schedule_id = [
                    'schedule_id' => $id_schedule,
                ];
                $delete_schedulePlace = $this->Api_company_model->deleteScheduleStaff($schedule_id);
                $c = $this->Api_company_model->deleteSchedulelatlong($schedule_id);
                $place = explode(';', $place);
                $lat_long = explode(';', $lat_long);
                $arr_sch = [];
                $staff = explode(',', $staff_id);

                $arr_id = [];
                for ($i = 0; $i < count($place); $i++) {
                    $ex = explode(',', $lat_long[$i]);
                    // die();
                    $sch_placell = [
                        'schedule_id'       => $id_schedule,
                        'place'             => $place[$i],
                        'lat'               => $ex[0],
                        'long'               => $ex[1],
                    ];
                    $arr_id[] = $this->Api_company_model->createSchedulePlaceLatLong($sch_placell);
                    // }
                }
                foreach ($staff as $value) {
                    for ($i = 0; $i < count($arr_id); $i++) {
                        $schedule_place = [
                            'schedule_id'       => $id_schedule,
                            'id_lat_long'       => $arr_id[$i],
                            'staff_id'          => $value,
                        ];
                        $this->Api_company_model->createSchedulePlace($schedule_place);
                    }
                }
                $delete_scheduleStaff = $this->Api_company_model->deleteScheduleplace($schedule_id);
                //Thêm nhân viên vào lịch trình
                foreach ($staff as $value) {
                    $schedule_staff = [
                        'schedule_id' => $id_schedule,
                        'staff_id'    => $value,
                        'status'      => 4,
                    ];
                    $this->Api_company_model->createScheduleStaff($schedule_staff);
                }
                success('Cập nhật lịch trình thành công', []);
            }
        }
    }
    public function getSmallCompanyList()
    {
        $token     = $this->input->post('token');
        $secretKey = $this->secretKey;
        $time      = time();

        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                // if ($decodeToken->type != 1) {
                //     set_error(404, 'Bạn không có quyền truy cập');
                // } else {
                $id            = $decodeToken->data->id;
                $access_token = $decodeToken->token;
                $header[]         = 'Authorization: ' . $access_token . '';
                $status = 'true';
                $curl     = curl_init();
                $url = 'https://chamcong.24hpay.vn/service/list_child_of_company.php';
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                    CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                    CURLOPT_HTTPHEADER => $header,
                ));
                $resp = curl_exec($curl);
                $arr_com_small = json_decode($resp);
                $company_arr  = [];
                foreach ($arr_com_small->data->items as $key => $value) {
                    $avatar_name = '';
                    if ($value->com_logo == "") {
                        $avatar_name = base_url() . "/images_staff/avatar_default.png";
                    } else {
                        $avatar_name = $value->com_logo;
                    }
                    $company_arr[] = [
                        'id' => $value->com_id,
                        'name' => $value->com_name,
                        'phones' => $value->com_phone,
                        'avatar' => $avatar_name,
                    ];
                }
                success('Danh sách công ty con', $company_arr);
            }
        }
    }
    public function getDepartmentByCompanyId()
    {
        $id_com        = $this->input->post('id_com');
        $token        = $this->input->post('token');
        $secretKey    = $this->secretKey;
        $time         = time();
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id            = $decodeToken->data->id;
                $access_token = $decodeToken->token;
                $header[]         = 'Authorization: ' . $access_token . '';
                $status = 'true';
                $curl     = curl_init();
                if ($id_com == '') {
                    $url = 'https://chamcong.24hpay.vn/service/list_department.php';
                } else {
                    $url = 'https://chamcong.24hpay.vn/service/list_department.php?id_com=' . $id_com;
                }
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                    CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                    CURLOPT_HTTPHEADER => $header,
                ));
                $resp = curl_exec($curl);
                $arr_department = json_decode($resp);
                $department_arr  = [];
                foreach ($arr_department->data->items as $key => $value) {
                    $department_arr[]  = [
                        'id'   => (int) $value->dep_id,
                        'name' => $value->dep_name,
                    ];
                }
                $position_list = $this->Api_company_model->getPositionByCompanyId($id, $id_com);
                $arr_position = [];
                foreach ($position_list as $position) {
                    array_push($arr_position, [
                        'id'   => (int) $position->id_position,
                        'name' => $position->name_position,
                    ]);
                }
                $data_arr = [
                    'position' => $arr_position,
                    'department' => $department_arr,
                ];
                success('Danh sách phòng ban và chức vụ', $data_arr);
            }
        }
    }
    public function getPosition()
    {
    }
    public function createDepartment()
    {
        $token            = $this->input->post('token');
        $name             = $this->input->post('name');
        $id_company_small = $this->input->post('id_company_small');
        $secretKey        = $this->secretKey;
        $time             = time();
        if ($token == "" || $name == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $n = "";
                $id = "";
                $id = $decodeToken->data->id;
                if ($id_company_small == 0 || $id_company_small == "") {
                    $id = $id;
                } else {
                    $id = $id_company_small;
                }
                $check_department =  $this->Api_company_model->checkDepartment($id, $n, $name);
                if (count($check_department) > 0) {
                    set_error(404, 'Tên phòng ban đã tồn tại');
                } else {
                    $department = [
                        'id_company'       => $id,
                        'id_company_small' => 0,
                        'name_department'  => $name,
                    ];
                    $this->Api_company_model->createDepartment($department);
                    success('Thêm phòng ban thành công', []);
                }
            }
        }
    }

    public function createStaff()
    {
        $token                  = $this->input->post('token');
        $name_staff             = $this->input->post('name_staff');
        $email                  = $this->input->post('email');
        $pass                   = $this->input->post('pass');
        $telephone              = $this->input->post('telephone');
        $power                  = $this->input->post('power');
        $department             = $this->input->post('department');
        $position               = $this->input->post('position');
        $com_id               = $this->input->post('com_id');
        $alias                  = url_title(convert_accented_characters($name_staff));
        $secretKey              = $this->secretKey;
        $time                   = time();
        if ($token == "" || $name_staff == "" || $email == "" || $pass == "" || $telephone == "" || $com_id == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);

            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $access_token = $decodeToken->token;
                $header[]         = 'Authorization: ' . $access_token . '';
                $curl     = curl_init();
                curl_setopt_array(
                    $curl,
                    array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => 'https://chamcong.24hpay.vn/service/add_employee.php',
                        CURLOPT_POST => 1,
                        CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                        CURLOPT_HTTPHEADER => $header,
                        CURLOPT_POSTFIELDS => array(
                            'email'             => $email,
                            'password'      => $pass,
                            'ep_name'     => $name_staff,
                            'ep_phone'     => $telephone,
                            'role'     => 4,
                            'com_id'     => $com_id,
                        )
                    )
                );
                $resp = curl_exec($curl);
                $responsive = json_decode($resp);
                if ($responsive->error == null) {
                    success('Thêm nhân viên thành công', []);
                } else {
                    set_error(404, $responsive->error->message);
                }
                die();
            }
        }
    }

    public function updateStaff()
    {
        $token                  = $this->input->post('token');
        $id_staff               = $this->input->post('id_staff');
        $name_staff             = $this->input->post('name_staff');
        // $pass                   = $this->input->post('pass');
        $telephone              = $this->input->post('telephone');
        $department             = $this->input->post('department');
        // $power                  = $this->input->post('power');
        $position               = $this->input->post('position');
        $address                = $this->input->post('address');
        $birthday               = $this->input->post('birthday');
        $alias                  = url_title(convert_accented_characters($name_staff));
        $secretKey              = $this->secretKey;
        $time                   = time();
        if ($id_staff == "" || $token == "" || $name_staff == "" || $telephone == "" || $department == "" || $position == "" || $address == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id         = $decodeToken->data->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $access_token = $decodeToken->token;
                $header[]         = 'Authorization: ' . $access_token . '';
                $curl     = curl_init();
                curl_setopt_array(
                    $curl,
                    array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => 'https://chamcong.24hpay.vn/service/company_update_employee_info.php',
                        CURLOPT_POST => 1,
                        CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                        CURLOPT_HTTPHEADER => $header,
                        CURLOPT_POSTFIELDS => array(
                            'id_ep'             => $id_staff,
                            'ep_name'           => $name_staff,
                            'ep_phone'          => $telephone,
                            'ep_address'        => $address,
                            'dep_id'            => $department,
                            'position_id'       => $position,
                            'ep_birth_day'      => $birthday,
                        )
                    )
                );
                $resp = curl_exec($curl);
                $responsive = json_decode($resp);
                if ($responsive->error == null) {
                    success('Cập nhật thông tin nhân viên thành công', []);
                } else {
                    set_error(404, 'Cập nhật thông tin thất bại');
                }
            }
        }
    }
    public function searchJob()
    {
        $token                  = $this->input->post('token');
        $name_job                   = $this->input->post('name_job');
        $job_com_id             = $this->input->post('job_com_id');
        $department             = $this->input->post('department');
        $status                 = $this->input->post('status');
        $secretKey              = $this->secretKey;
        $date_start             = $this->input->post('date_start');
        $date_end               = $this->input->post('date_end');
        $time                   = time();

        if ($token == "") {
            set_error(404, "chuỗi token rỗng");
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                if ($decodeToken->data->role == 1) {
                    $type = 1;
                    $id = $decodeToken->data->id;
                    if ($date_end == '') {
                        $date_end = strtotime($date_start);
                    } else {
                        $date_end = strtotime($date_end);
                    }

                    if ($job_com_id != 0 && $job_com_id != '') {
                        $id = $job_com_id;
                    }
                    $date_start = strtotime($date_start);
                    $list = $this->Api_company_model->searchJob($id, $department, $status, $date_start, $date_end, $name_job);
                    // var_dump($list);
                    // die();
                    $data = [];
                    $dahuy = [];
                    $dalam = [];
                    $danglam = [];
                    $dukien = [];
                    foreach ($list as $value) {
                        $list_par = $this->Api_company_model->getListJobPar($value["job_id"]);
                        $avatar_name = '';
                        $arr_par = [];
                        if ($value['status'] == 1) {
                            foreach ($list_par as $valuePar) {
                                $arr_par[] = [
                                    'staff_id' => $valuePar->staff_id,
                                ];
                            }
                            $list_content = $this->Api_company_model->list_content($value["job_id"]);
                            $dahuy[] = [
                                'job_id' => $value['job_id'],
                                'job_com_id' => $value['job_com_id'],
                                'job_name' => $value['job_name'],
                                'job_city' => $value['job_city'],
                                'job_district' => $value['job_district'],
                                'job_address' => $value['job_address'],
                                'department' => $value['department'],
                                'job_day_start' =>  date('d-m-Y', $value['job_day_start']),
                                'job_day_end' => date('d-m-Y', $value['job_day_end']),
                                'status' => $value['status'],
                                'participants' => $arr_par,
                                'list_content' => $list_content,
                            ];
                        }
                        if ($value['status'] == 2) {
                            foreach ($list_par as $valuePar) {
                                if ($valuePar->avatar == "") {
                                    $avatar_name = base_url() . "/images_staff/avatar_default.png";
                                } else {
                                    $avatar_name = $valuePar->avatar;
                                }
                                $arr_par[] = [
                                    'staff_id' => $valuePar->staff_id,
                                    'avatar' => $avatar_name,
                                ];
                            }
                            $list_content = $this->Api_company_model->list_content($value["job_id"]);
                            $dalam[] = [
                                'job_id' => $value['job_id'],
                                'job_com_id' => $value['job_com_id'],
                                'job_name' => $value['job_name'],
                                'job_city' => $value['job_city'],
                                'job_district' => $value['job_district'],
                                'job_address' => $value['job_address'],
                                'department' => $value['department'],
                                'job_day_start' =>  date('d-m-Y', $value['job_day_start']),
                                'job_day_end' => date('d-m-Y', $value['job_day_end']),
                                'status' => $value['status'],
                                'participants' => $arr_par,
                                'list_content' => $list_content,
                            ];
                        }
                        if ($value['status'] == 3) {
                            foreach ($list_par as $valuePar) {
                                if ($valuePar->avatar == "") {
                                    $avatar_name = base_url() . "/images_staff/avatar_default.png";
                                } else {
                                    $avatar_name = $valuePar->avatar;
                                }
                                $arr_par[] = [
                                    'staff_id' => $valuePar->staff_id,
                                    'avatar' => $avatar_name,
                                ];
                            }
                            $list_content = $this->Api_company_model->list_content($value["job_id"]);
                            $danglam[] = [
                                'job_id' => $value['job_id'],
                                'job_com_id' => $value['job_com_id'],
                                'job_name' => $value['job_name'],
                                'job_city' => $value['job_city'],
                                'job_district' => $value['job_district'],
                                'job_address' => $value['job_address'],
                                'department' => $value['department'],
                                'job_day_start' =>  date('d-m-Y', $value['job_day_start']),
                                'job_day_end' => date('d-m-Y', $value['job_day_end']),
                                'status' => $value['status'],
                                'participants' => $arr_par,
                                'list_content' => $list_content,
                            ];
                        }
                        if ($value['status'] == 4) {
                            foreach ($list_par as $valuePar) {
                                if ($valuePar->avatar == "") {
                                    $avatar_name = base_url() . "/images_staff/avatar_default.png";
                                } else {
                                    $avatar_name = $valuePar->avatar;
                                }
                                $arr_par[] = [
                                    'staff_id' => $valuePar->staff_id,
                                    'avatar' => $avatar_name,
                                ];
                            }
                            $list_content = $this->Api_company_model->list_content($value["job_id"]);
                            $dukien[] = [
                                'job_id' => $value['job_id'],
                                'job_com_id' => $value['job_com_id'],
                                'job_name' => $value['job_name'],
                                'job_city' => $value['job_city'],
                                'job_district' => $value['job_district'],
                                'job_address' => $value['job_address'],
                                'department' => $value['department'],
                                'job_day_start' =>  date('d-m-Y', $value['job_day_start']),
                                'job_day_end' => date('d-m-Y', $value['job_day_end']),
                                'status' => $value['status'],
                                'participants' => $arr_par,
                                'list_content' => $list_content,
                            ];
                        }
                    }
                    $data = [
                        'dahuy' => $dahuy,
                        'dalam' => $dalam,
                        'danglam' => $danglam,
                        'dukien' => $dukien,
                    ];
                    success('Tìm kiếm công việc', $data);
                }
            }
        }
    }

    public function create_job()
    { // xem lại
        $token              = $this->input->post('token');
        $name_job           = $this->input->post('name_job');
        // $job_department_id  = $this->input->post('job_department_id');
        $date_start         = $this->input->post('date_start');
        $date_end           = $this->input->post('date_end');
        $time_in            = $this->input->post('time_in');
        $time_out           = $this->input->post('time_out');
        // $job_day            = $this->input->post('job_day');
        $staff_id           = $this->input->post('staff_id');
        $job_address        = $this->input->post('job_address');
        $job_city           = $this->input->post('job_city');
        $job_district       = $this->input->post('job_district');
        // $notify             = $this->input->post('notify');
        $job_content       = $this->input->post('job_content');
        $note               = $this->input->post('note');
        $id_com             = $this->input->post('id_com');

        $time_notify               = $this->input->post('time_notify');
        $repeat_notify             = $this->input->post('repeat_notify');
        $status_notify             = $this->input->post('status_notify');
        $number_day_notify         = $this->input->post('number_day_notify');
        // $option_notify	           = $this->input->post('option_notify');

        $secretKey          = $this->secretKey;
        $time               = time();

        $arr_notifi = [
            'HHC đã giao cho bạn 1 công việc mới'
        ];
        $decodeToken = JWT::decode($token, $secretKey, ['HS256']);

        if ($token == '' || $name_job == '' || $staff_id == '' || $job_address == '') {
            set_error(404, "Vui lòng nhập đủ các trường");
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id         = 0;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                if ($id_com == 0 || $id_com == '') {
                    $id         = $decodeToken->data->id;
                    // $job_type = $decodeToken->type;
                } else {
                    $id = $id_com;
                    // $job_type = 2;
                }


                $option_notify = 0;
                if ($number_day_notify != '' && $status_notify != '') {
                    $option_notify = 1;
                }
                if ($time_notify == "") {
                    $time_notify = 0;
                }
                if ($repeat_notify == "") {
                    $repeat_notify = 0;
                }
                if ($status_notify == "") {
                    $status_notify = 0;
                }
                if ($number_day_notify == "") {
                    $number_day_notify = 0;
                }

                if ($time_in != '') {
                    $time_in = strtotime($time_in);
                } else {
                    $n =  strtotime('00:00' . $date_start);
                    $time_in = $n;
                }


                if ($time_out != '') {
                    $time_out = strtotime($time_out);
                } else {
                    $a =  strtotime('00:00' . $date_end);
                    $b = $a + 86400;
                    $time_out = $b;
                }

                if ($date_start != '') {
                    $date_start = strtotime($date_start);
                } else {
                    $date_start = 0;
                }

                if ($date_end != '') {
                    $date_end = strtotime($date_end);
                } else {
                    $date_end = 0;
                }

                // $time_out = strtotime($time_out);
                $data_job = [
                    'job_com_id' => $id,
                    'job_staff_admin_id' => $id,
                    'job_name' => $name_job,
                    // 'job_day' => $job_day,
                    'job_day_start' => $date_start,
                    'job_day_end' => $date_end,
                    'job_time_in' => $time_in,
                    'job_time_out' => $time_out,
                    'job_address' => $job_address,
                    'job_city' => $job_city,
                    // 'job_type' => $job_type,
                    'job_district' => $job_district,
                    // 'job_notice_type' => $notify,
                    'note' => $note,
                    // 'job_content' => $job_content,
                    'time_notify' => $time_notify,
                    'repeat_notify' => $repeat_notify,
                    'number_day_notify' => $number_day_notify,
                    'status_notify' => $status_notify,
                    'option_notify' => $option_notify,
                ];
                $job_id = $this->Api_company_model->create_job($data_job);

                $staff_id = explode(',', $staff_id);
                $status = 4;
                if ($time >= $time_in && $time <= $time_out) {
                    $status = 3;
                }
                if ($time >= $date_start && $time <= $date_end) {
                    $status = 3;
                }
                $name = $decodeToken->data->name;
                for ($i = 0; $i < count($staff_id); $i++) {
                    $data_jobPar = [
                        'job_id' => $job_id,
                        'staff_id' => $staff_id[$i],
                        'status' => $status,
                    ];
                    $add_jobPra = $this->Api_company_model->createJobPar($data_jobPar);
                    $noti = $name . ' đã giao cho bạn 1 công việc mới';
                    $data_notify = [
                        'company' => $id,
                        'notify_to_staff' => $staff_id[$i],
                        'note' => $noti,
                        'date' => time(),
                        'status' => 2,
                        'job_schedule' => $job_id,
                        'type' => 1,
                        'image_notify' => 4,
                    ];
                    $add_notify = $this->Api_company_model->create_notify($data_notify);
                }
                if ($job_content != '') {
                    $job_content = explode('||', $job_content);
                    $arr_con = [];
                    for ($j = 0; $j < count($job_content); $j++) {
                        $data_jobcontent = [
                            'job_id' => $job_id,
                            'content' => $job_content[$j],
                        ];
                        $arr_con[] = $this->Api_company_model->createJobContentStaff($data_jobcontent);
                    }

                    for ($j = 0; $j < count($arr_con); $j++) {
                        for ($i = 0; $i < count($staff_id); $i++) {
                            $data_jobcontent = [
                                'job_id' => $job_id,
                                'content_staff_id' => $arr_con[$j],
                                'staff_id' => $staff_id[$i],
                                'status' => 2,
                            ];
                            $add_jobContent = $this->Api_company_model->createJobContent($data_jobcontent);
                        }
                    }
                }
                success('Tạo công việc thành công', []);
            }
        }
    }

    public function update_job()
    { // xem lại
        $token              = $this->input->post('token');
        $id_job             = $this->input->post('id_job');
        $name_job           = $this->input->post('name_job');
        $job_department_id  = $this->input->post('job_department_id');
        $date_start         = $this->input->post('date_start');
        $date_end           = $this->input->post('date_end');
        $time_in            = $this->input->post('time_in');
        $time_out           = $this->input->post('time_out');
        $staff_id           = $this->input->post('staff_id');
        $job_address        = $this->input->post('job_address');
        $job_city           = $this->input->post('job_city');
        $job_district       = $this->input->post('job_district');
        $job_content        = $this->input->post('job_content');
        $note               = $this->input->post('note');
        $id_com             = $this->input->post('id_com');


        $time_notify               = $this->input->post('time_notify');
        $repeat_notify             = $this->input->post('repeat_notify');
        $status_notify             = $this->input->post('status_notify');
        $number_day_notify         = $this->input->post('number_day_notify');

        $secretKey          = $this->secretKey;
        $time               = time();
        if ($token == '' || $name_job == '' || $id_job == '' || $staff_id == '' || $job_address == '' || $job_city == '' || $job_district == '') {
            set_error(404, "Vui lòng nhập đủ các trường");
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id         = $decodeToken->data->id;

                $id_small = "";
                $id = "";
                $job_type = 0;
                $arr_delete = [];
                $arr_update = [];
                $id_small = 0;
                $id = $decodeToken->data->id;
                if ($id_com != 0 || $id_com != "") {
                    $id = $id_com;
                }
                $arr_delete = [
                    'job_id' => $id_job,
                ];
                $arr_update = [
                    'job_id' => $id_job,
                ];
                // }

                $option_notify = 0;
                if ($number_day_notify != '' && $status_notify != '') {
                    $option_notify = 1;
                }
                if ($time_notify == "") {
                    $time_notify = 0;
                }
                if ($repeat_notify == "") {
                    $repeat_notify = 0;
                }
                if ($status_notify == "") {
                    $status_notify = 0;
                }
                if ($number_day_notify == "") {
                    $number_day_notify = 0;
                }

                if ($date_start != '') {
                    $date_start = strtotime($date_start);
                } else {
                    $date_start = 0;
                }

                if ($date_end != '') {
                    $date_end = strtotime($date_end);
                } else {
                    $date_end = 0;
                }

                if ($time_in != '') {
                    $time_in = strtotime($time_in);
                } else {
                    $time_in = 0;
                }

                if ($time_out != '') {
                    $time_out = strtotime($time_out);
                } else {
                    $time_out = 0;
                }
                $data_job = [
                    'job_com_id' => $id,
                    'job_department_id' => $job_department_id,
                    'job_staff_admin_id' => $decodeToken->data->id,
                    'job_name' => $name_job,
                    'job_day_start' => $date_start,
                    'job_day_end' => $date_end,
                    'job_address' => $job_address,
                    'job_city' => $job_city,
                    // 'job_type' => $job_type,
                    'job_district' => $job_district,
                    'note' => $note,
                    'job_time_in' => $time_in,
                    'job_time_out' => $time_out,
                    'time_notify' => $time_notify,
                    'repeat_notify' => $repeat_notify,
                    'number_day_notify' => $number_day_notify,
                    'status_notify' => $status_notify,
                    'option_notify' => $option_notify,
                ];
                $job_id = $this->Api_company_model->updatejob($data_job, $arr_update);

                $staff_id = explode(',', $staff_id);
                $deleteJobPar = $this->Api_company_model->deleteJobPar($arr_delete);
                $deleteJobContent = $this->Api_company_model->deleteJobContent($arr_delete);
                $deleteJobContentStaff = $this->Api_company_model->deleteJobContentStaff($arr_delete);
                for ($i = 0; $i < count($staff_id); $i++) {
                    $data_jobPar = [
                        'job_id' => $id_job,
                        'staff_id' => $staff_id[$i],
                        // 'status' => 4,
                    ];

                    $add_jobPra = $this->Api_company_model->createJobPar($data_jobPar);
                }

                if ($job_content != '') {
                    $job_content = explode('||', $job_content);
                    $arr_con = [];
                    for ($j = 0; $j < count($job_content); $j++) {
                        $data_jobcontent = [
                            'job_id' => $id_job,
                            'content' => $job_content[$j],
                        ];
                        $arr_con[] = $this->Api_company_model->createJobContentStaff($data_jobcontent);
                    }

                    for ($j = 0; $j < count($arr_con); $j++) {
                        for ($i = 0; $i < count($staff_id); $i++) {
                            $data_jobcontent = [
                                'job_id' => $id_job,
                                'content_staff_id' => $arr_con[$j],
                                'staff_id' => $staff_id[$i],
                                'status' => 2,
                            ];
                            $add_jobContent = $this->Api_company_model->createJobContent($data_jobcontent);
                        }
                    }
                }
                success('Cập nhật công việc thành công', []);
            }
        }
    }

    public function create_small_company()
    {
        $token                  = $this->input->post('token');
        $secretKey              = $this->secretKey;
        $name                   = $this->input->post('name');
        $email                  = $this->input->post('email');
        $phone                  = $this->input->post('phone');
        $address                = $this->input->post('address');
        $time                   = time();
        if ($token == "" || $name == "" || $email == "" || $phone == "" || $address == "") {
            set_error(404, "Vui lòng nhập đủ các trường");
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id         = $decodeToken->data->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $access_token = $decodeToken->token;
                $logo = $_FILES['logo'];
                var_dump($logo);
                die();
                $header[]         = 'Authorization: ' . $access_token . '';
                $curl     = curl_init();
                curl_setopt_array(
                    $curl,
                    array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => 'https://chamcong.24hpay.vn/service/add_child_company.php',
                        CURLOPT_POST => 1,
                        CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                        CURLOPT_HTTPHEADER => $header,
                        CURLOPT_POSTFIELDS => array(
                            'email'                 => $email,
                            'company_name'           => $name,
                            'company_phone'          => $phone,
                            'company_address'        => $address,
                            'logo'                  => $logo,
                        )
                    )
                );
                $resp = curl_exec($curl);
                $responsive = json_decode($resp);

                if ($responsive->error == null) {
                    success('Thêm công ty thành công', []);
                } else {
                    set_error(404, $responsive->error->message);
                }
            }
        }
    }



    public function update_small_company()
    {
        $token                  = $this->input->post('token');
        $secretKey              = $this->secretKey;
        $id_small_com           = $this->input->post('id_small_com');
        $name                   = $this->input->post('name');
        $phone                  = $this->input->post('phone');
        $address                = $this->input->post('address');
        $time                   = time();
        if ($token == "" || $id_small_com == "" || $name == "" || $phone == "" || $address == "") {
            set_error(404, "Vui lòng nhập đủ các trường");
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id         = $decodeToken->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $email_md5 = md5(rand());
                $path_upload = '';
                $path = "img_com_small/";
                $day = date("d");
                $month = date("m");
                $year = date("Y");
                if (!file_exists($path . $year)) {
                    mkdir($path . $year,  0755, TRUE);
                }
                if (!file_exists($path . $year . "/" . $month)) {
                    mkdir($path . $year . "/" . $month,  0755, TRUE);
                }
                if (!file_exists($path . $year . "/" . $month . "/" . $day)) {
                    mkdir($path . $year . "/" . $month . "/" . $day,  0755, TRUE);
                }
                $dir = $path . $year . "/" . $month . "/" . $day . "/";
                $link_file = "";
                $data_avatar = $this->Api_company_model->detailSmallCompany($id_small_com);
                $name_avatar = $data_avatar[0]->logo_company;
                // die();
                if (isset($_FILES['avatar'])) {
                    if ($_FILES['avatar']["name"] != "") {
                        if ($name_avatar != "") {
                            unlink($name_avatar);
                        }
                        $temp = explode(".", $_FILES["avatar"]["name"]);
                        $newfilename = round(microtime(true)) . $email_md5 . '.' . end($temp);
                        move_uploaded_file($_FILES["avatar"]["tmp_name"], $dir . "/" . $newfilename);
                        $link_file = $dir . round(microtime(true)) . $email_md5 . '.' . end($temp);
                    }
                } else {
                    $link_file = $name_avatar;
                }
                $arr_id = [
                    'com_id' => $id_small_com,
                ];
                $data['com_name'] = $name;
                $data['com_phone'] = $phone;
                $data['com_address'] = $address;
                $data['com_avatar'] = $link_file;
                $data['updated_at'] = $time;
                $data['created_at'] = $time;
                $data['updated_at'] = $time;

                $small_company = $this->Api_company_model->update_small_company($data, $arr_id);
                success('Cập nhật công ty con thành công', []);
            }
        }
    }

    public function info_company()
    {
        $token                  = $this->input->post('token');
        $secretKey              = $this->secretKey;
        $time                   = time();
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'token đã hết hạn');
            } else {
                // if ($decodeToken->type == 1) {
                $id         = $decodeToken->id;
                $detail_company = $this->Api_company_model->infoCompany($id);
                $arr = [];
                $avatar_name = '';
                if ($detail_company[0]->com_avatar == "") {
                    $avatar_name = base_url() . "/images_staff/avatar_default.png";
                } else {
                    $avatar_name = $detail_company[0]->com_avatar;
                }
                foreach ($detail_company as $value) {
                    $arr['com_id']      = $id;
                    $arr['com_name']    = $value->com_name;
                    $arr['com_email']   = $value->com_email;
                    $arr['com_phone']   = $value->com_phone;
                    $arr['com_address'] = $value->com_address;
                    $arr['com_avatar']  = $avatar_name;
                }
                success('Thông tin công', $arr);
            }
        }
    }
    public function update_company()
    {
        $token                  = $this->input->post('token');
        $com_name               = $this->input->post('com_name');
        $com_phone              = $this->input->post('com_phone');
        $com_address            = $this->input->post('com_address');
        // $avatar                 = $this->input->post('avatar');
        $secretKey              = $this->secretKey;
        $time                   = time();
        if ($token == "" || $com_name == "" || $com_phone == "" || $com_address == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'token đã hết hạn');
            } else {
                $curl     = curl_init();
                $access_token = $decodeToken->token;
                $header[]         = 'Authorization: ' . $access_token . '';
                curl_setopt_array(
                    $curl,
                    array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => 'https://chamcong.24hpay.vn/service/update_user_info_company.php',
                        CURLOPT_POST => 1,
                        CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                        CURLOPT_HTTPHEADER => $header,
                        CURLOPT_POSTFIELDS => array(
                            'company_name' => $com_name,
                            'company_phone'     => $com_phone,
                            'company_address'     => $com_address,
                        )
                    )
                );
                $resp = curl_exec($curl);
                $responsive = json_decode($resp);
                if ($responsive->error == null) {
                    success('Cập nhật công ty thành công', []);
                } else {
                    set_error(404, 'Cập nhật thông tin thất bại');
                }
            }
        }
    }

    public function updateDepartment()
    {
        $token            = $this->input->post('token');
        $id_department    = $this->input->post('id_department');
        $name             = $this->input->post('name');
        $id_company_small = $this->input->post('id_company_small');
        $secretKey        = $this->secretKey;
        $time             = time();
        if ($token == "" || $id_department == "" || $name == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $n = "";
                $id = "";
                $id = $decodeToken->id;
                if ($id_company_small == 0 || $id_company_small == "") {
                    $id = $id;
                } else {
                    $id = $id_company_small;
                }
                $check_department =  $this->Api_company_model->checkDepartment($id, $n, $name);
                if (count($check_department) > 0) {
                    set_error(404, 'Tên phòng ban đã tồn tại');
                } else {
                    $arr_id = [
                        'id_department' => $id_department,
                    ];
                    $department = [
                        'id_company'       => $id,
                        // 'id_company_small' => $id_company_small,
                        'name_department'  => $name,
                    ];
                    $this->Api_company_model->updateDepartment($department, $arr_id);
                    success('Cập nhật phòng ban thành công', []);
                }
            }
        }
    }

    public function companyChangePass()
    {
        $pass           = $this->input->post('pass');
        $passnew        = $this->input->post('passnew');
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();

        if ($token == "" || $pass == "" || $passnew == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {

                $curl     = curl_init();
                $access_token = $decodeToken->token;
                $header[]         = 'Authorization: ' . $access_token . '';
                curl_setopt_array(
                    $curl,
                    array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => 'https://chamcong.24hpay.vn/service/change_pass_company.php',
                        CURLOPT_POST => 1,
                        CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                        CURLOPT_HTTPHEADER => $header,
                        CURLOPT_POSTFIELDS => array(
                            'old_pass'      => $pass,
                            'new_pass'      => $passnew,
                        )
                    )
                );
                $resp = curl_exec($curl);
                $responsive = json_decode($resp);

                if ($responsive->error == null) {
                    success('Đổi mật khẩu thành công', []);
                } else {
                    set_error(404, $responsive->error->message);
                }
            }
        }
    }

    public function addCalendar()
    {
        $name_date          = $this->input->post('name_date');
        $json_date          = $this->input->post('json_date');
        // $choose             = $this->input->post('choose');
        // $shift              = $this->input->post('shift');
        $id_com              = $this->input->post('id_com');
        $token              = $this->input->post('token');
        $secretKey          = $this->secretKey;
        $time               = time();

        if ($token == "" || $json_date == "" || $name_date == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {

                $id = $decodeToken->id;
                $id_small = 0;
                if ($id_com != '') {
                    $id = $id_com;
                }
                $a = '{
                    "month":"1",
                    "day":[
                        {
                            "date" : "27-7-2021",
                            "shift_id" : "1,2,3"
                        },
                        {
                            "date" : "28-7-2021",
                            "shift_id" : "2,3"
                        }
                    ]
                }';
                $arr = json_decode($json_date);
                $month = $arr->month;
                $mydate = strtotime("01-" . $month);

                $day = $arr->day;
                $choose = 0;
                $shift = 0;
                $data_month = [
                    'id_company'    => $id,
                    'month' => $mydate,
                    'name_calendar' => $name_date,
                    'choose_calendar' => $choose,
                    'id_shift' => $shift,
                ];
                $id_month = $this->Api_company_model->addCalendar($data_month);

                $data_staff = [
                    'calendar_id' => $id_month,
                ];
                $id_calendar_staff = $this->Api_company_model->addCalendarStaff($data_staff);

                foreach ($day as $value) {
                    $date = strtotime($value->date);
                    $shift_id = $value->shift_id;
                    $data = [
                        'id_company'    => $id,
                        'id_company_small'    => $id_small,
                        'calendar_parent' => $id_month,
                        'date' => $date,
                        'id_shift' => $shift_id,
                    ];
                    $id_calendar = $this->Api_company_model->addCalendar($data);
                }
                success('Tạo lịch làm việc thành công', []);
            }
        }
    }

    public function updateCalendar()
    {
        $id_calendar        = $this->input->post('id_calendar');
        $name_date          = $this->input->post('name_date');
        $json_date          = $this->input->post('json_date');
        $choose             = $this->input->post('choose');
        $shift              = $this->input->post('shift');
        $id_com              = $this->input->post('id_com');
        $token              = $this->input->post('token');
        $secretKey          = $this->secretKey;
        $time               = time();

        if ($token == "" || $json_date == "" || $id_calendar == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {

                $id = $decodeToken->id;
                $id_small = 0;
                if ($id_com != '') {
                    $id = $id_com;
                }
                $a = '
                {
                    "month":"1",
                    "day":[
                        {
                            "date" : "27-7-2021",
                            "shift_id" : "1,2,3"
                        },
                        {
                            "date" : "28-7-2021",
                            "shift_id" : "2,3"
                        }
                    ]
                }';
                $arr = json_decode($json_date);
                $month = $arr->month;
                $mydate = strtotime("01-" . $month);
                $choose             = 0;
                $shift              = 0;
                $data_month = [
                    'id_company'    => $id,
                    'month' => $mydate,
                    'name_calendar' => $name_date,
                    'choose_calendar' => $choose,
                    'id_shift' => $shift,
                ];
                $id = [
                    'id' => $id_calendar,
                ];
                $update_calendar = $this->Api_company_model->updateCalendar($data_month, $id);
                $day = $arr->day;
                foreach ($day as $value) {
                    $date = strtotime($value->date);
                    $shift_id = $value->shift_id;
                    $arr_id = [
                        'calendar_parent'    => $id_calendar,
                        'date'               => $date,
                    ];
                    $data = [
                        'id_shift'          => $shift_id,
                    ];
                    $update_calendar = $this->Api_company_model->updateCalendar($data, $arr_id);
                    // var_dump($update_calendar);
                }
                success('Cập nhật làm việc thành công', []);
                // }else{
                //     set_error(404, 'Cập nhật làm việc thất bại');
                // }
            }
        }
    }

    public function addStaffToCalendar()
    {
        $id_calendar_new        = $this->input->post('id_calendar_new');
        $id_calendar_old        = $this->input->post('id_calendar_old');
        $staff_id           = $this->input->post('staff_id');
        $token                  = $this->input->post('token');
        $secretKey              = $this->secretKey;
        $time                   = time();

        if ($token == "" || $id_calendar_new == "" || $staff_id == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $detailCalendarstaff_old = $this->Api_company_model->detailCalendarStaff($id_calendar_old);
                $detailCalendarstaff_new = $this->Api_company_model->detailCalendarStaff($id_calendar_new);
                $check = explode(',', $detailCalendarstaff_new['staff_id']);
                $dem = 0;
                foreach ($check as $value) {
                    if ($value == $staff_id) {
                        $dem++;
                    }
                }
                if ($dem > 0) {
                    $result = [
                        'result' => false,
                        'message' => 'Nhân viên đã có trong lịch làm việc',
                    ];
                } else {
                    $arr_staff = explode(',', $detailCalendarstaff_old['staff_id']);
                    for ($i = 0; $i < count($arr_staff); $i++) {
                        if ($arr_staff[$i] == $staff_id) {
                            $arr = array_splice($arr_staff, $i, 1);
                        }
                    }

                    $arr_idCalenderStaff = [
                        'calendar_id' => $id_calendar_old,
                    ];

                    $arr_dataCalenderStaff_old = [
                        'staff_id' => implode(',', $arr_staff),
                    ];
                    $updateCalendarStaff_old = $this->Api_company_model->addStaffToCalendar($arr_dataCalenderStaff_old, $arr_idCalenderStaff);

                    $detailCalendarstaff_new = $this->Api_company_model->detailCalendarStaff($id_calendar_new);

                    if ($detailCalendarstaff_new['staff_id'] != '') {
                        $staff_id_new = $detailCalendarstaff_new['staff_id'] . ',' . $staff_id;
                    } else {
                        $staff_id_new = $staff_id;
                    }

                    $arr_dataCalenderStaff_new = [
                        'staff_id' => $staff_id_new,
                    ];
                    $arr_idCalenderStaff_new = [
                        'calendar_id' => $id_calendar_new,
                    ];
                    $updateCalendarStaff_old = $this->Api_company_model->addStaffToCalendar($arr_dataCalenderStaff_new, $arr_idCalenderStaff_new);
                    $result = [
                        'result' => true,
                        'message' => 'Cập nhật thành công',
                    ];
                    success('Thêm nhân viên vào lịch làm việc thành công', []);
                }
            }
        }
    }
    public function checkMailForgetPass()
    {
        $email               = $this->input->post('email');
        if ($email == "") {
            set_error(404, 'vui lòng nhập đủ các trường');
        } else {
            $mail_check = $this->Api_company_model->checkMail($email);
            if ($mail_check == 0) {
                set_error(404, 'email không chính xác');
            } else {
                // die();
                $com_name = $this->Api_company_model->ComEmail($email);
                $OTP        = rand(100000, 999999);
                $name_com = $com_name[0]['com_name'];
                $data = [
                    'com_otp' => $OTP,
                ];
                $condition = [
                    'com_email' => $email,
                ];
                $this->Api_company_model->updateOTP($data, $condition);
                // Gửi mail otp
                // die();
                $body  = file_get_contents('email_template/email.html');
                $body  = str_replace('%name%', $name_com, $body);
                $body  = str_replace('%otp%', $OTP, $body);
                $title = "Xác thực quên mật khẩu";
                $this->Api_company_model->SendMailAmazon($title, $name_com, $email, $body);
                //Tạo token
                $secretKey           = "Punclock365.timviec365.api";
                $arrToken            = array();
                $arrToken['id']      = $com_name[0]['com_id'];;
                $arrToken['exp'] = time() + 86400;
                $tokenOTP            = JWT::encode($arrToken, $secretKey);
                $data                = [
                    'token' => $tokenOTP,
                ];
                success('Gửi OTP thành công  ', $data);
            }
        }
    }

    public function checkOtpforgotPass()
    {
        $otp       = $this->input->post('otp');
        $token     = $this->input->post('token');
        $secretKey = $this->secretKey;
        $time      = time();

        if ($token == "" || $otp == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $staff_id = $decodeToken->id;
                $checked  = $this->Api_company_model->checkOTP($staff_id, $otp);
                if ($checked == 0) {
                    set_error(404, 'Sai OTP');
                } else {
                    success('Mã OTP đúng', []);
                }
            }
        }
    }

    public function forgotPass()
    {
        $pass      = $this->input->post('pass');
        $token     = $this->input->post('token');
        $secretKey = $this->secretKey;
        $time      = time();

        if ($token == "" || $pass == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $com_id = $decodeToken->id;
                $data     = [
                    'com_password' => md5($pass),
                ];
                $condition = [
                    'com_id' => $com_id,
                ];
                $this->Api_company_model->companyChangePass($data, $condition);
                success('Đối mật khẩu thành công', []);
            }
        }
    }
    public function contact()
    {
        $name           = $this->input->post('name');
        $email          = $this->input->post('email');
        $content        = $this->input->post('content');
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();

        if ($token == "" || $name == "" || $email == "" || $content == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $data = [
                    'contact_name'      => $name,
                    'contact_email'     => $email,
                    'contact_content'   => $content,
                ];
                $this->Api_company_model->contact($data);
                success('Liên hệ thành công', []);
            }
        }
    }

    public function listStaff()
    {
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();

        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = 0;
                $id_small = 0;
                $id = $decodeToken->id;
                $data = $this->Api_company_model->listStaff($id, $id_small, 0, "");
                $avatar_name = '';
                $dem_acctive = 0;
                $dem_noActive = 0;
                $arr_noActive = [];
                $arr_active = [];
                foreach ($data as $value) {
                    if ($value['avatar'] == null) {
                        $avatar_name = base_url() . "/images_staff/avatar_default.png";
                    } else {
                        $avatar_name = $value['avatar'];
                    }

                    $name_department = $this->Api_company_model->listDepartmentById($value['department']);

                    if ($value['active'] == 1) {
                        $arr_active[] = [
                            'staff_id'          => $value['staff_id'],
                            'name_staff'        => $value['name_staff'],
                            'telephone'         => $value['telephone'],
                            'name_department'   => $name_department['name_department'],
                            'avatar'            => $avatar_name,
                        ];
                        $dem_acctive++;
                    } else {
                        $arr_noActive[] = [
                            'staff_id'          => $value['staff_id'],
                            'name_staff'        => $value['name_staff'],
                            'telephone'         => $value['telephone'],
                            'name_department'   => $name_department['name_department'],
                            'avatar'            => $avatar_name,
                        ];
                        $dem_noActive++;
                    }
                }
                // count($arr_active);
                $arr = [
                    'active' => $arr_active,
                    'total_active' => $dem_acctive,
                    'noActive' => $arr_noActive,
                    'total_noActive' => $dem_noActive,
                ];
                success('Danh sách nhân viên của công ty', $arr);
            }
        }
    }

    public function browseStaff()
    {
        $str_id_staff   = $this->input->post('str_id_staff');
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $str_id_staff == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $ex = explode(',', $str_id_staff);
                foreach ($ex as $value) {
                    $id = [
                        'staff_id' => $value,
                    ];
                    $data = [
                        'active' => 1,
                    ];
                    $this->Api_company_model->updateBrowseStaff($data, $id);
                }
                success('Duyệt nhân viên thành công', []);
            }
        }
    }

    public function deleteStaff()
    {
        $str_id_staff   = $this->input->post('str_id_staff');
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $str_id_staff == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $ex = explode(',', $str_id_staff);
                $data = [
                    'email' => "",
                ];
                foreach ($ex as $value) {
                    $id = [
                        'staff_id' => $value,
                    ];
                    $a = $this->Api_company_model->updateStaff($data, $id);
                }
                success('Xóa nhân viên thành công ', []);
            }
        }
    }

    public function detailStaff()
    {
        $id_staff       = $this->input->post('id_staff');
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();

        if ($token == "" || $id_staff == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = $decodeToken->id;
                $data = $this->Api_company_model->detailStaff($id_staff);
                $arr = [];
                foreach ($data as $value) {
                    if ($value->avatar == null) {
                        $avatar_name = base_url() . "/images_staff/avatar_default.png";
                    } else {
                        $avatar_name = $value->avatar;
                    }
                    $id_com = 0;
                    $type_com = 0;
                    $com_id = 0;
                    $com_name = '';
                    $id_com = $value->company_id;
                    $data_com = $this->Api_company_model->infoCompany($id_com);
                    foreach ($data_com as $valueCom) {
                        $com_id = $valueCom->com_id;
                        $com_name = $valueCom->com_name;
                    }
                    $arr['staff_id']        = $value->staff_id;
                    $arr['name_staff']      = $value->name_staff;
                    $arr['email']           = $value->email;
                    $arr['telephone']       = $value->telephone;
                    $arr['avatar']          = $avatar_name;
                    $arr['com_id']          = $com_id;
                    $arr['com_name']        = $com_name;
                    // $arr['type_com']        = $type_com;
                    $arr['name_department'] = $value->name_department;
                    $arr['name_position']   = $value->name_position;
                }
                success('Chi tiết nhân viên của công ty', $arr);
            }
        }
    }

    public function updateRole()
    {
        $id_staff       = $this->input->post('id_staff');
        $id_power       = $this->input->post('id_power');
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();

        if ($token == "" || $id_staff == "" || $id_power == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = $decodeToken->id;
                $arr_id = [
                    'staff_id' => $id_staff,
                ];
                $data = [
                    'power' => $id_power,
                ];

                $this->Api_company_model->updateRole($data, $arr_id);

                success('Cập nhật phân quyền thành công', []);
            }
        }
    }

    public function detailSmallCompany()
    {
        $id_small_com   = $this->input->post('id_small_com');
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();

        if ($token == "" || $id_small_com == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $data = $this->Api_company_model->detailSmallCompany($id_small_com);
                $arr = [];
                foreach ($data as $value) {
                    $avatar_name = '';
                    if ($value->com_avatar == "") {
                        $avatar_name = base_url() . "/images_staff/avatar_default.png";
                    } else {
                        $avatar_name = $value->com_avatar;
                    }

                    $arr['com_id']          = $value->com_id;
                    $arr['com_parent']      = $value->com_parent;
                    $arr['com_name']        = $value->com_name;
                    $arr['com_email']       = $value->com_email;
                    $arr['com_phone']       = $value->com_phone;
                    $arr['com_address']     = $value->com_address;
                    $arr['com_avatar']    = $avatar_name;
                }
                success('Chi tiết công ty con', $arr);
            }
        }
    }

    //1: đã hủy
    //2: đã làm
    //3: đang làm
    //còn lại: chưa làm

    public function listScheduleStaff()
    {

        // tháng

        // $a = date("Y-m-01");
        // $b = date("Y-m-t");

        // //tuần
        // $monday = strtotime("last monday");
        // $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;

        // $sunday = strtotime(date("Y-m-d", $monday) . " +6 days");

        // $this_week_start = strtotime(date("Y-m-d", $monday));
        // $this_week_end = strtotime(date("Y-m-d", $sunday));

        // echo "Current week range from $this_week_start to $this_week_end ";

        $token           = $this->input->post('token');
        $id_com          = $this->input->post('id_com');
        $status1          = $this->input->post('status');
        $staff_id        = $this->input->post('staff_id');
        $date_start      = $this->input->post('date_start');
        $date_end        = $this->input->post('date_end');
        $id_department        = $this->input->post('id_department');
        $secretKey       = $this->secretKey;
        $time            = time();

        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = 0;
                $id_small = 0;
                $data_arr = [];
                $status = 0;
                $avatar = null;
                $name_staff = "";
                $name_department = "";
                $date_start = strtotime($date_start);
                if ($date_end == "") {
                    $date_end = $date_start;
                } else {
                    $date_end = strtotime($date_end);
                }
                $id = $decodeToken->data->id;
                if ($id_com != '' && $id_com != 0) {
                    $id = $id_com;
                }
                $data = $this->Api_company_model->listSchedule($id, $id_small, $status1, $staff_id, $date_start, $date_end, $id_department);
                $arr_data = [];
                $arr_staff = [];
                foreach ($data as $value) {
                    $data_2 = $this->Api_company_model->listScheduleStaff($value->id);
                    $staff_id = '';
                    $arr_status = [];
                    foreach ($data_2 as $value2) {
                        // $staff_id = $value2->staff_id;
                        if ($value2->status == 0) {
                            $status = '';
                        } else {
                            $status = $value2->status;
                        }

                        $arr_status = [
                            'schedule_staff' => $value2->id,
                            'status' => $status,
                        ];
                    }
                    $detail_ep = $this->detailEmploye($token, $value->staff_id);
                    $avatar_name = 'https://chamcong.24hpay.vn/upload/employee/' . $detail_ep->data->items[0]->ep_image;
                    if ($detail_ep->data->items[0]->ep_image == null) {
                        $avatar_name = base_url() . "/images_staff/avatar_default.png";
                    }
                    $arr_staff[] = [
                        'staff_id' => $value->staff_id,
                        'id_schedule' => $value->id,
                        'name' => $value->name,
                        'status' => $arr_status,
                        'note' => $value->note,
                        'date_start' => $value->date_start,
                        'date_end' => $value->date_end,
                        'avatar' => $avatar_name,
                        'name_staff' => $detail_ep->data->items[0]->ep_name,
                        'id_department' => $detail_ep->data->items[0]->dep_id,
                        'name_department' => $detail_ep->data->items[0]->dep_name,
                    ];
                }
                // $list_Schedule = $this->Api_company_model->schedule($id, $id_small);
                $list_Schedules = $this->Api_company_model->listSchedules($id, $id_small, $status1, $staff_id, $date_start, $date_end, $id_department);
                // var_dump($list_Schedules);
                // die();
                $arr_staff2 = [];
                $arr_sch = [];
                foreach ($data as $values) {
                    $data_2 = $this->Api_company_model->listScheduleStaff($values->id);
                    $status = '';
                    $arr_status = '';
                    $arr_staff2 = '';
                    if (count($data_2) == 0) {
                        $arr_status = '';
                        $arr_staff2 = [];
                    } else {
                        $arr_status = [];
                        foreach ($data_2 as $valueStaff) {
                            if ($valueStaff->status == 0) {
                                $status = '';
                            } else {
                                $status = $valueStaff->status;
                            }
                            $arr_status = [
                                'schedule_staff_id' => $valueStaff->id,
                                'status' => $status,
                            ];
                            $detail_ep = $this->detailEmploye($token, $valueStaff->staff_id);
                            $avatar_name = 'https://chamcong.24hpay.vn/upload/employee/' . $detail_ep->data->items[0]->ep_image;
                            if ($detail_ep->data->items[0]->ep_image == null) {
                                $avatar_name = base_url() . "/images_staff/avatar_default.png";
                            }
                            $arr_staff2[] = [
                                'staff_id' => $valueStaff->staff_id,
                                'avatar' => $avatar_name,
                            ];
                        }
                    }
                    $arr_sch[] = [
                        'schedule_id' => $values->id,
                        'name' => $values->name,
                        'note' => $values->note,
                        'date_start' => $values->date_start,
                        'date_end' => $values->date_end,
                        'status' => $values->status,
                        'staff' => $arr_staff2,
                    ];
                }

                $arr_list = [
                    'nhanvien' => $arr_staff,
                    'nhom' => $arr_sch,
                ];
                success('Danh sách lịch trình của nhân viên', $arr_list);
            }
        }
    }
    public function detailScheduleStaff()
    {
        $token          = $this->input->post('token');
        $id_staff       = $this->input->post('id_staff');
        $id_schedule       = $this->input->post('id_schedule');
        $secretKey      = $this->secretKey;
        $time           = time();

        if ($token == "" || $id_staff == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            // var_dump($decodeToken);
            // die();
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = $decodeToken->data->id;
                $data = $this->Api_company_model->detailScheduleStaff($id_schedule, $id_staff);
                // var_dump($data);
                // die();
                $data_arr = [];
                foreach ($data as $value) {
                    $data_staff = $this->Api_company_model->detailStaff($id_staff);
                    // var_dump($data_staff);
                    // die();
                    if ($value->status == 1) {
                        $a = 'Đã hủy';
                    } else if ($value->status == 2) {
                        $a = 'Đã làm';
                    } else if ($value->status == 3) {
                        $a = 'Đang làm';
                    } else {
                        $a = 'Dự kiến';
                    }
                    $avatar_name = '';
                    if ($data_staff[0]->avatar == null) {
                        $avatar_name = base_url() . "/images_staff/avatar_default.png";
                    } else {
                        $avatar_name = $data_staff[0]->avatar;
                    }
                    $a = '';
                    $participants = $this->Api_company_model->participantsSchedule($value->schedule_id, $a);
                    $arr_pra = [];
                    foreach ($participants as $value_pra) {
                        $data_pra = $this->Api_company_model->detailStaff($value_pra->staff_id);
                        foreach ($data_pra as $value1) {
                            $avatar_name = '';
                            if ($value1->avatar == null) {
                                $avatar_name = base_url() . "/images_staff/avatar_default.png";
                            } else {
                                $avatar_name = $value1->avatar;
                            }
                            $arr_pra[] = [
                                'avatar' => $avatar_name,
                            ];
                        }
                    }
                    $data_place = $this->Api_company_model->detailSchedulePlace($id_schedule, $id_staff);
                    $arr_place = [];
                    foreach ($data_place as $key => $valuep) {
                        $listLatLong = $this->Api_company_model->detailScheduleLatLong($valuep->id_lat_long);
                        foreach ($listLatLong as $valuell) {
                            $arr_place[] = [
                                'id_place' => $valuep->id,
                                'place' => $valuell->place,
                                'lat' => $valuell->lat,
                                'long' => $valuell->long,
                                'status' => $valuep->status,
                            ];
                        }
                    }
                    $ab[] = $value->lat_long;
                    $data_arr['id']   = $value->id;
                    $data_arr['name']   = $value->name;
                    $data_arr['status']   = $a;
                    $data_arr['note']   = $value->note;
                    $data_arr['schedule_id']   = $value->schedule_id;
                    $data_arr['staff_id']   = $value->staff_id;
                    $data_arr['avatar']   = $avatar_name;
                    $data_arr['name_staff']   = $data_staff[0]->name_staff;
                    $data_arr['name_department']   = $data_staff[0]->name_department;
                    $data_arr['participants']   = $arr_pra;
                    $data_arr['data_sch']   = $arr_place;
                }
                success('Chi tiết lịch trình của nhân viên', $data_arr);
            }
        }
    }

    public function createShift()
    {
        $name_shift     = $this->input->post('name_shift');
        $time_in        = $this->input->post('time_in');
        $time_out       = $this->input->post('time_out');
        $id_com         = $this->input->post('id_com');
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $name_shift == "" || $time_in == "" || $time_out == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = 0;
                $id_small = 0;
                $id = $decodeToken->id;
                if ($id_com != 0 && $id_com != "") {
                    $id =  $id_com;
                }
                $id_shift = 0;
                $check = $this->Api_company_model->checkShift($id, $name_shift, $id_shift);
                if (count($check) == 0) {
                    $data = [
                        'id_com' => $id,
                        'id_com_small' => $id_small,
                        'name_shift' => $name_shift,
                        'time_in' => strtotime($time_in),
                        'time_out' => strtotime($time_out),
                        'created_at' => $time,
                        'updated_at' => $time,
                    ];
                    $this->Api_company_model->createShift($data);
                    success('Tạo ca làm việc thành công', []);
                } else {
                    set_error(404, 'Tên ca làm việc đã tồn tại');
                }
            }
        }
    }
    public function updateShift()
    {
        $id_shift       = $this->input->post('id_shift');
        $name_shift     = $this->input->post('name_shift');
        $time_in        = $this->input->post('time_in');
        $time_out       = $this->input->post('time_out');
        $id_com         = $this->input->post('id_com');
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();

        if ($token == "" || $name_shift == "" || $id_shift == "" || $time_in == "" || $time_out == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = $decodeToken->id;
                $id_small = 0;
                if ($id_com != 0 && $id_com != "") {
                    $id =  $id_com;
                }
                $check = $this->Api_company_model->checkShift($id, $name_shift, $id_shift);
                if (count($check) == 0) {
                    $id_updates = [
                        'id_shift' => $id_shift,
                    ];
                    $data = [
                        'id_com' => $id,
                        'id_com_small' => $id_small,
                        'name_shift' => $name_shift,
                        'time_in' => strtotime($time_in),
                        'time_out' => strtotime($time_out),
                        'updated_at' => $time,
                    ];
                    $this->Api_company_model->updateShift($data, $id_updates);
                    success('Cập nhật ca làm việc thành công', []);
                } else {
                    set_error(404, 'Tên ca làm việc đã tồn tại');
                }
            }
        }
    }
    public function deleteShift()
    {
        $id_shift       = $this->input->post('id_shift');
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();

        if ($token == "" || $id_shift == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = [
                    'id_shift' => $id_shift,
                ];

                $data = [
                    'index_shift' => 0
                ];

                $this->Api_company_model->updateShift($data, $id);
                success('Xóa ca làm việc thành công', []);
            }
        }
    }
    public function listShift()
    {
        $token          = $this->input->post('token');
        $id_com          = $this->input->post('id_com');
        $secretKey      = $this->secretKey;
        $time           = time();
        $date = date('H:i:s', $time);
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = 0;
                $id_small = 0;
                $id = $decodeToken->id;
                if ($id_com != 0 || $id_com != '') {
                    $id = $id_com;
                }
                $list_arr = $this->Api_company_model->listShift($id, $id_small);
                $arr = [];
                foreach ($list_arr as $value) {
                    $arr[] = [
                        "id_shift" => $value->id_shift,
                        "id_com" => $value->id_com,
                        "id_com_small" => $value->id_com_small,
                        "name_shift" => $value->name_shift,
                        "time_in" => $value->time_in,
                        "time_out" => $value->time_out,
                    ];
                }
                success('Danh sách ca làm việc', $arr);
            }
        }
    }
    public function listMonthCalendar()
    {
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();
        $id_com         = $this->input->post('id_com');
        $month          = $this->input->post('month');
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = 0;
                $id_small = 0;
                $id = $decodeToken->id;
                if ($id_com != 0) {
                    $id = $id_com;
                }
                $a = [];
                $arr = [];
                $mydate_begin_date = strtotime("01-" . $month);
                $data = $this->Api_company_model->listMonthCalendar($id, $id_small, $mydate_begin_date);
                foreach ($data as $value) {
                    $total_staff = 0;
                    $arr_calender = $this->Api_company_model->listMonthCalendarStaff($value->id);
                    foreach ($arr_calender as $value1) {
                        if ($value1->staff_id == '') {
                            $total_staff = 0;
                        } else {
                            $staff = explode(',', $value1->staff_id);
                            $total_staff = count($staff);
                        }
                    }
                    $listDayCalendar = $this->Api_company_model->listDayCalendar($value->id);
                    $arr[] = [
                        'id_calendar' => $value->id,
                        'month' => $value->month,
                        'name_calendar' => $value->name_calendar,
                        'total_staff' => $total_staff,
                        'listDayCalendar' => $listDayCalendar,
                        // 'id_shift' =>  $value->id_shift,
                    ];
                }
                success('Danh sách lịch làm việc theo tháng', $arr);
            }
        }
    }
    public function listMonthStaff()
    {
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();
        $id_calendar    = $this->input->post('id_calendar');
        $id_com         = $this->input->post('id_com');
        if ($token == "" || $id_calendar == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $arr = [];
                $id = 0;
                if ($decodeToken->data->role == 1) {
                    $id = $decodeToken->id;
                    if ($id_com == 0 || $id_com == '') {
                        $id_small = 0;
                    } else {
                        $id_small = $id_com;
                    }
                } else {
                    $id = $decodeToken->id_parent;
                    $id_small = $decodeToken->id;
                }

                $data = $this->Api_company_model->listMonthStaff($id_calendar);
                foreach ($data as $value) {
                    $info = explode(',', $value->staff_id);
                    $arr = [];
                    if (count($info) > 1) {
                        foreach ($info as $value_id) {
                            $info_staff = $this->Api_company_model->StaffById($value_id);
                            $department = $this->Api_company_model->listDepartmentById($info_staff['department']);
                            $avatar_name = '';
                            if ($info_staff['avatar'] == "") {
                                $avatar_name = base_url() . "/images_staff/avatar_default.png";
                            } else {
                                $avatar_name = $info_staff['avatar'];
                            }
                            $arr[] = [
                                'id' => $info_staff['staff_id'],
                                'name' => $info_staff['name_staff'],
                                'avatar' => $avatar_name,
                                'phone' => $info_staff['telephone'],
                                'department' => $department['name_department'],
                            ];
                        }
                    } else {
                        $arr = [];
                    }
                }
                success('Danh sách nhân viên có lịch làm việc theo tháng', $arr);
            }
        }
    }
    public function searchStaff()
    {
        $name_staff     = $this->input->post('name_staff');
        $id_department  = $this->input->post('id_department');
        $id_position    = $this->input->post('id_position');
        $status         = $this->input->post('status');
        $id_small_com   = $this->input->post('id_small_com');
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = 0;
                $id_small = 0;
                $id = $decodeToken->id;
                if ($id_small_com != 0 || $id_small_com != '') {
                    $id = $id_small_com;
                }
                $list_arr = $this->Api_company_model->searchStaff(0, $id, $id_small, $name_staff, $id_department, $status, $id_position);
                $data = [];
                foreach ($list_arr as $key => $value) {
                    $avatar_name = '';
                    if ($value->avatar == "") {
                        $avatar_name = base_url() . "/images_staff/avatar_default.png";
                    } else {
                        $avatar_name = $value->avatar;
                    }
                    $data[] = [
                        'staff_id' => $value->staff_id,
                        'name_staff' => $value->name_staff,
                        'telephone' => $value->telephone,
                        'avatar' => $avatar_name,
                        'position' => $value->name_position,
                        'id_department' => $value->name_department,
                        'id_small_company' => $value->id_small_company,
                        'role' => $value->name,
                    ];
                }
                success('Danh sách nhân viên', $data);
            }
        }
    }
    public function createConfig()
    {
        //1: Nhận diện khuôn mặt
        //2: Wift công ty
        //3: vị trí
        $id_com         = $this->input->post('id_com');
        $method         = $this->input->post('method');
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $method == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = 0;
                $id_small = 0;
                $id = $decodeToken->id;
                if ($id_com != 0 && $id_com != '') {
                    $id = $id_com;
                }
                // $delete = $this->Api_company_model->deleteConfig($id,0);
                $data = [
                    'com_id' => $id,
                    'method' => $method,
                ];
                $id = [
                    'com_id' => $id,
                ];
                $insert = $this->Api_company_model->updateConfig($data, $id);
                success('Cấu hình thành công', []);
            }
        }
    }
    public function detailConfig()
    {
        //1: Nhận diện khuôn mặt
        //2: Wift công ty
        //3: vị trí
        // $id_config      = $this->input->post('id_config');
        $id_com_small        = $this->input->post('id_com');
        $token          = $this->input->post('token');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = 0;
                // $id_com_small = 0;
                $id_small = 0;
                // if ($decodeToken->type == 1) {
                $id = $decodeToken->id;
                if ($id_com_small != 0 && $id_com_small != '') {
                    $id = $id_com_small;
                }
                $list = $this->Api_company_model->detailConfig($id, $id_small);
                $list_wifi = [];
                if ($list['id_wifi'] != '') {
                    $wifi = explode(',', $list['id_wifi']);
                    foreach ($wifi as $value) {
                        $list_wifi[] = $this->Api_company_model->detailwifi($value);
                    }
                }
                $list_lat_long = [];
                if ($list['id_lat_long'] != '') {
                    $lat_long = explode(',', $list['id_lat_long']);
                    foreach ($lat_long as $valuell) {
                        $list_lat_long[] = $this->Api_company_model->detaillatlong($valuell);
                    }
                }
                $method = [];
                if ($list['method'] != '') {
                    $method = explode(',', $list['method']);
                }
                $arr['id_config'] = $list['id'];
                $arr['id_com'] = $list['com_id'];
                $arr['id_com_small'] = $list['id_com_small'];
                $arr['wifi'] = $list_wifi;
                $arr['lat_long'] = $list_lat_long;
                $arr['method'] = $method;
                // }
                success('Chi tiết cấu hình', $arr);
            }
        }
    }
    public function deleteCompanySmall()
    {
        $token          = $this->input->post('token');
        $id_small       = $this->input->post('id_small');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $id_small == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                // $id = 0;
                // $id_small = 0;
                if ($decodeToken->data->role == 1) {
                    $arr = [
                        'com_id' => $id_small
                    ];
                    $arr_avatar = $this->Api_company_model->detailSmallCompany($id_small);
                    $link_avatar = '';
                    foreach ($arr_avatar as $value) {
                        $link_avatar = $value->logo_company;
                    }
                    if (is_writable($link_avatar)) {
                        unlink($link_avatar);
                    }
                    $this->Api_company_model->deleteCompanySmall($arr);
                    success('Xóa công ty thành công', []);
                } else {
                    set_error(404, 'Không có quyền xóa công ty');
                }
            }
        }
    }
    public function getListJob()
    {
        $token          = $this->input->post('token');
        $id_small       = $this->input->post('id_small');
        $today          = $this->input->post('today');
        $secretKey      = $this->secretKey;
        $id_department  = $this->input->post('id_department');
        $status         = $this->input->post('status');
        $time           = time();
        if ($token == "" || $today == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $today = strtotime($today);

                if ($decodeToken->data->role == 1) {
                    if ($id_small != "" && $id_small != 0) {
                        $id = $id_small;
                        $job_type = 2;
                    } else {
                        $id = $decodeToken->data->id;
                        $job_type = 1;
                    }
                } else {
                    // $id = $decodeToken->id_parent;
                    $id = $decodeToken->data->id;
                    $job_type = 2;
                    $id_small = 0;
                }
                $list = $this->Api_company_model->getListJob($id, $id_small, $today, $job_type, $id_department, $status);
                $arr = [];
                foreach ($list as $value) {
                    $list_par = $this->Api_company_model->getListJobPar($value->job_id);
                    $status = 0;
                    $avatar_name = '';
                    $arr_par = [];
                    foreach ($list_par as $valuePar) {
                        $arr_par[] = [
                            'staff_id' => $valuePar->staff_id,
                        ];
                    }
                    $job_day_start  = date('d-m-Y', $value->job_day_start);
                    $job_day_end    = date('d-m-Y', $value->job_day_end);
                    $job_time_in    = date('H:i:s', $value->job_time_in);
                    $job_time_out   = date('H:i:s', $value->job_time_out);
                    $arr[] = [
                        'job_id' => $value->job_id,
                        'job_name' => $value->job_name,
                        'status'   => $value->status,
                        'job_day_start' => $job_day_start,
                        'job_day_end' => $job_day_end,
                        'job_time_in' => $job_time_in,
                        'job_time_out' => $job_time_out,
                        'job_address' => $value->job_address,
                        'job_city' => $value->job_city,
                        'job_district' => $value->job_district,
                        'participants' => $arr_par,
                    ];
                }
                success('Danh sách công việc theo ngày', $arr);
            }
        }
    }

    public function getDetailJob()
    {
        // $a = '123||4456';
        // $b = explode('||',$a);
        // var_dump($b);
        // die();
        $token          = $this->input->post('token');
        $id_job       = $this->input->post('id_job');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $id_job == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $list = $this->Api_company_model->getDetailJob($id_job);
                $arr_data = [];
                foreach ($list as $value) {

                    $list_par = $this->Api_company_model->getListJobPar($value->job_id);
                    $list_content = $this->Api_company_model->list_content($value->job_id);
                    $list_content_staff = $this->Api_company_model->list_content_staff($value->job_id);
                    $status = 0;
                    $avatar_name = '';
                    $arr_par = [];
                    foreach ($list_par as $valuePar) {
                        $arr_par[] = [
                            'id_staff' => $valuePar->staff_id,
                        ];
                    }
                    $arr_con = [];
                    foreach ($list_content as $valueContent) {
                        $dem = 0;
                        $check = 0;
                        $status_job = 0;
                        foreach ($list_content_staff as $valueCs) {
                            if ($valueCs['content_staff_id'] == $valueContent->id) {
                                if ($valueCs['status'] == 1) {
                                    $check++;
                                }
                                $dem++;
                            }
                        }
                        if ($dem == $check) {
                            $status_job = 1;
                        } else {
                            $status_job = 2;
                        }

                        $arr_con[] = [
                            'id_content' => $valueContent->id,
                            'job_id' => $valueContent->job_id,
                            'content' => $valueContent->content,
                            'status' => $status_job
                        ];
                    }

                    $note = '';
                    if ($value->note == null) {
                        $note = '';
                    } else {
                        $note =  $value->note;
                    }
                    $city = $this->Api_company_model->getCityById($value->job_city);
                    $district = $this->Api_company_model->getDistrictById($value->job_district);
                    $arr_city = [
                        'cit_id' => $value->job_city,
                        'cit_name' => $city['cit_name'],
                    ];
                    $arr_district = [
                        'district_id' => $value->job_district,
                        'district_name' => $district['cit_name'],
                    ];
                    $number = '';
                    if ($value->number_day_notify == 0) {
                        $number = '';
                    } else {
                        $number = $value->number_day_notify;
                    }

                    $status_notify = '';
                    if ($value->status_notify == 0) {
                        $status_notify = '';
                    } else {
                        $status_notify = $value->status_notify;
                    }

                    $arr_data['job_id'] = $value->job_id;
                    $arr_data['job_name'] = $value->job_name;
                    $arr_data['job_day_start'] = $value->job_day_start;
                    $arr_data['job_day_end'] = $value->job_day_end;
                    $arr_data['job_time_in'] = $value->job_time_in;
                    $arr_data['job_time_out'] = $value->job_time_out;
                    $arr_data['job_address'] = $value->job_address;
                    $arr_data['job_city'] = $arr_city;
                    $arr_data['job_district'] = $arr_district;
                    $arr_data['note'] = $value->note;
                    $arr_data['time_notify'] = $value->time_notify;
                    $arr_data['repeat_notify'] = $value->repeat_notify;
                    $arr_data['number_day_notify'] = $number;
                    $arr_data['status_notify'] = $status_notify;
                    $arr_data['note'] = $note;
                    $arr_data['participant'] = $arr_par;
                    $arr_data['list_job_content'] = $arr_con;
                }
                success('Chi tiết công việc theo ngày', $arr_data);
            }
        }
    }

    public function updateJobContent()
    {
        $token              = $this->input->post('token');
        $id_content         = $this->input->post('id_content');
        $status             = $this->input->post('status');
        $secretKey          = $this->secretKey;
        $time               = time();
        if ($token == "" || $id_content == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = [
                    'content_staff_id' => $id_content,
                ];
                $data = [
                    'status' => $status,
                ];
                $a =  $this->Api_company_model->updateJobContent($data, $id);
                success('Cập nhật trạng thái thành công', []);
            }
        }
    }

    //1: đã hủy
    //2: đã làm
    //3: đang làm
    //4: Dự kiến
    public function getListJobByStatus()
    {
        $token          = $this->input->post('token');
        $staff_id       = $this->input->post('staff_id');
        // $status         = $this->input->post('status');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $staff_id == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $dahuy = [];
                $dalam = [];
                $danglam = [];
                $dukien = [];
                $dem = 0;
                for ($i = 1; $i < 5; $i++) {
                    $list = $this->Api_company_model->getListJobByStatus($i, $staff_id);
                    // var_dump($list['job_id']);
                    if ($i == 1) {
                        // $a = 44;
                        foreach ($list as $valuedh) {

                            $list_par = $this->Api_company_model->getListJobPar($valuedh->job_id);
                            $status = $valuedh->status;
                            $avatar_name = '';
                            $arr_par = [];
                            foreach ($list_par as $valuePar) {
                                $arr_par[] = [
                                    'id_staff' => $valuePar->staff_id,
                                ];
                            }
                            $list_content = $this->Api_company_model->list_content($valuedh->job_id);
                            $dahuy[] = [
                                'job_id' => $valuedh->job_id,
                                'staff_id' => $valuedh->staff_id,
                                'job_name' => $valuedh->job_name,
                                'status'   => $status,
                                'job_day_start' => date('d-m-Y', $valuedh->job_day_start),
                                'job_day_end' => date('d-m-Y', $valuedh->job_day_end),
                                'job_time_in' => date('H:i:s', $valuedh->job_time_in),
                                'job_time_out' => date('H:i:s', $valuedh->job_time_out),
                                'job_address' => $valuedh->job_address,
                                'job_city' => $valuedh->job_city,
                                'job_district' => $valuedh->job_district,
                                'participants' => $arr_par,
                                'content_list' => $list_content,
                            ];
                        }
                    } elseif ($i == 2) {
                        foreach ($list as $valuedh) {

                            $list_par = $this->Api_company_model->getListJobPar($valuedh->job_id);
                            $status = $valuedh->status;
                            $avatar_name = '';
                            $arr_par = [];
                            foreach ($list_par as $valuePar) {
                                $arr_par[] = [
                                    'id_staff' => $valuePar->staff_id,
                                ];
                            }
                            $list_content = $this->Api_company_model->list_content($valuedh->job_id);
                            $dalam[] = [
                                'job_id' => $valuedh->job_id,
                                'staff_id' => $valuedh->staff_id,
                                'job_name' => $valuedh->job_name,
                                'status'   => $status,
                                'job_day_start' => date('d-m-Y', $valuedh->job_day_start),
                                'job_day_end' => date('d-m-Y', $valuedh->job_day_end),
                                'job_time_in' => date('H:i:s', $valuedh->job_time_in),
                                'job_time_out' => date('H:i:s', $valuedh->job_time_out),
                                'job_address' => $valuedh->job_address,
                                'job_city' => $valuedh->job_city,
                                'job_district' => $valuedh->job_district,
                                'participants' => $arr_par,
                                'content_list' => $list_content,
                            ];
                        }
                    } elseif ($i == 3) {
                        foreach ($list as $valuedh) {

                            $list_par = $this->Api_company_model->getListJobPar($valuedh->job_id);
                            $status = $valuedh->status;
                            $avatar_name = '';
                            $arr_par = [];
                            foreach ($list_par as $valuePar) {
                                $arr_par[] = [
                                    'id_staff' => $valuePar->staff_id,
                                ];
                            }
                            $list_content = $this->Api_company_model->list_content($valuedh->job_id);
                            $danglam[] = [
                                'job_id' => $valuedh->job_id,
                                'staff_id' => $valuedh->staff_id,
                                'job_name' => $valuedh->job_name,
                                'status'   => $status,
                                'job_day_start' => date('d-m-Y', $valuedh->job_day_start),
                                'job_day_end' => date('d-m-Y', $valuedh->job_day_end),
                                'job_time_in' => date('H:i:s', $valuedh->job_time_in),
                                'job_time_out' => date('H:i:s', $valuedh->job_time_out),
                                'job_address' => $valuedh->job_address,
                                'job_city' => $valuedh->job_city,
                                'job_district' => $valuedh->job_district,
                                'participants' => $arr_par,
                                'content_list' => $list_content,
                            ]; # code...# code...
                        }
                    } else {
                        foreach ($list as $valuedh) {

                            $list_par = $this->Api_company_model->getListJobPar($valuedh->job_id);
                            $status = $valuedh->status;
                            $avatar_name = '';
                            $arr_par = [];
                            foreach ($list_par as $valuePar) {
                                $arr_par[] = [
                                    'id_staff' => $valuePar->staff_id,
                                ];
                            }
                            $list_content = $this->Api_company_model->list_content($valuedh->job_id);
                            $dukien[] = [
                                'job_id' => $valuedh->job_id,
                                'staff_id' => $valuedh->staff_id,
                                'job_name' => $valuedh->job_name,
                                'status'   => $status,
                                'job_day_start' => date('d-m-Y', $valuedh->job_day_start),
                                'job_day_end' => date('d-m-Y', $valuedh->job_day_end),
                                'job_time_in' => date('H:i:s', $valuedh->job_time_in),
                                'job_time_out' => date('H:i:s', $valuedh->job_time_out),
                                'job_address' => $valuedh->job_address,
                                'job_city' => $valuedh->job_city,
                                'job_district' => $valuedh->job_district,
                                'participants' => $arr_par,
                                'content_list' => $list_content,
                            ];
                        }
                    }
                }

                $arr = [
                    'dahuy' => $dahuy,
                    'dalam' => $dalam,
                    'danglam' => $danglam,
                    'dukien' => $dukien,
                ];

                success('Danh sách công việc đã làm của nhân viên', $arr);
            }
        }
    }

    public function scheduleHistoryStaff()
    {
        $token          = $this->input->post('token');
        $staff_id          = $this->input->post('staff_id');
        // $status          = $this->input->post('status');
        // $id_small          = $this->input->post('id_small');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $staff_id == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $dahuy = [];
                $dalam = [];
                $danglam = [];
                $dukien = [];
                for ($i = 1; $i < 5; $i++) {
                    $list = $this->Api_company_model->scheduleHistoryStaff($i, $staff_id);
                    foreach ($list as $value) {
                        if ($value->status == 1) {
                            $dahuy[] = $value;
                        } elseif ($value->status == 2) {
                            $dalam[] = $value;
                        } elseif ($value->status == 3) {
                            $danglam[] = $value;
                        } else {
                            $dukien[] = $value;
                        }
                    }
                }
                $arr = [
                    'dahuy' => $dahuy,
                    'dalam' => $dalam,
                    'danglam' => $danglam,
                    'dukien' => $dukien,
                ];

                success('Lịch sử lịch trình', $arr);
            }
        }
    }
    public function detailScheduleHistoryStaff()
    {
        $token          = $this->input->post('token');
        $schedule_id          = $this->input->post('schedule_id');
        $staff_id          = $this->input->post('staff_id');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $schedule_id == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $data_arr = [];
                // $schedule = $this->Api_company_model->scheduleById($schedule_id);
                $schedulePlace = $this->Api_company_model->detailSchedulePlace($schedule_id, $staff_id);

                $a1 = [];
                $data_sch = [];
                if ($staff_id == '') {
                    $listLatLong = $this->Api_company_model->detailScheduleLatLong(0, $schedule_id);
                    foreach ($listLatLong as $valuell) {
                        $data_sch[] = [
                            'id_lat_long' => $valuell->id,
                            'place' => $valuell->place,
                            'lat' => $valuell->lat,
                            'long' => $valuell->long,
                        ];
                    }
                } else {
                    foreach ($schedulePlace as $value) {
                        $listLatLong = $this->Api_company_model->detailScheduleLatLong($value->id_lat_long, 0);
                        foreach ($listLatLong as $valuell) {
                            $data_sch[] = [
                                'id_lat_long' => $valuell->id,
                                'place' => $valuell->place,
                                'lat' => $valuell->lat,
                                'long' => $valuell->long,
                                'status' => $value->status,
                            ];
                        }
                    }
                }
                $list = $this->Api_company_model->detailScheduleHistoryStaff($schedule_id, $staff_id);
                $arr_staff = [];
                // var_dump($schedulePlace);
                // die();
                foreach ($list as $value1) {
                    $list_staff = $this->Api_company_model->detailStaff($value1->staff_id);
                    foreach ($list_staff as $valueStaff) {
                        $avatar_name = '';
                        if ($valueStaff->avatar == "") {
                            $avatar_name = base_url() . "/images_staff/avatar_default.png";
                        } else {
                            $avatar_name = $valueStaff->avatar;
                        }
                        $arr_staff[] = [
                            'staff_id' => $valueStaff->staff_id,
                            'name_staff' => $valueStaff->name_staff,
                            'avatar' => $avatar_name,
                        ];
                        // var_dump($valueStaff->arr_staff);
                    }

                    $data_arr['schedule_id']    = $value1->schedule_id;
                    $data_arr['name']           = $value1->name;
                    $data_arr['date_start']     = $value1->date_start;
                    $data_arr['date_end']       = $value1->date_end;
                    $data_arr['status']         = $value1->status;
                    $data_arr['note']           = $value1->note;
                    // $data_arr['staff_id']       = $value1->staff_id;
                    $data_arr['data_sch']       = $data_sch;
                    $data_arr['data_staff']     = $arr_staff;
                }

                success('Chi tiết lịch sử lịch trình', $data_arr);
            }
        }
    }

    public function countJob()
    {
        $token          = $this->input->post('token');
        $today          = $this->input->post('today');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $today == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $today = strtotime($today);
                $id_small = 0;
                $id = $decodeToken->data->id;
                $job_type = 1;
                $a = 0;
                $b = 0;
                $list = $this->Api_company_model->getListJob($id, $id_small, $today, $job_type, $a, $b);
                $count_Status = $this->Api_company_model->countJob($id, $id_small, $job_type);
                $arr = [
                    'soluong_cv_homnay' => count($list),
                    'soluong_cv_dagiao' => count($count_Status),
                ];
                success('Số lượng công việc', $arr);
            }
        }
    }
    public function listJobByStaff()
    {
        $token          = $this->input->post('token');
        $staff_id       = $this->input->post('staff_id');
        $month          = $this->input->post('month');
        $id_small_com   = $this->input->post('id_small_com');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = 0;
                $id_small = 0;
                $id = $decodeToken->data->id;
                if ($id_small_com != 0 && $id_small_com != '') {
                    $id = $id_small_com;
                }
                $mydate = strtotime("01-" . $month);
                $list = $this->Api_company_model->listJobByStaff($id, $id_small, $staff_id, $mydate);
                $arr = [];
                foreach ($list as $value) {
                    $arr[] = [
                        'calendar_id' =>  $value->calendar_id,
                        'month' =>  $value->month,
                    ];
                }
                success('Danh sách lịch làm việc của nhân viên', $arr);
            }
        }
    }

    public function deleteCalendar()
    {
        $token          = $this->input->post('token');
        $id_calendar          = $this->input->post('id_calendar');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $id_calendar == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = [
                    'id' => $id_calendar,
                ];
                $data = [
                    'index_calendar' => 2,
                ];

                $del_ca = $this->Api_company_model->updateCalendar($data, $id);
                success('Xóa lịch làm việc thành công', []);
            }
        }
    }

    public function deleteStaffToCalendar()
    {

        $token = $this->input->post('token');
        $id_staff = $this->input->post('id_staff');
        $id_calendar = $this->input->post('id_calendar');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($id_staff == "" || $id_calendar == "" || $token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $detailCalendarstaff = $this->Api_company_model->detailCalendarStaff($id_calendar);
                $arr_staff = explode(',', $detailCalendarstaff['staff_id']);
                for ($i = 0; $i < count($arr_staff); $i++) {
                    if ($arr_staff[$i] == $id_staff) {
                        $arr = array_splice($arr_staff, $i, 1);
                    }
                }
                $arr_data = [
                    'staff_id' => implode(',', $arr_staff),
                ];
                $arr_id = [
                    'calendar_id' => $id_calendar,
                ];
                $update =  $this->Api_company_model->addStaffToCalendar($arr_data, $arr_id);
                success('Xóa nhân viên khỏi lịch lịch làm việc thành công', []);
            }
        }
    }

    public function listJobDeliver()
    {
        $id_department  = $this->input->post('id_department');
        $id_small_com   = $this->input->post('id_small_com');
        $token          = $this->input->post('token');
        $start_time     = $this->input->post('start_time');
        $end_time       = $this->input->post('end_time');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = 0;
                $id_small = 0;
                $id = $decodeToken->data->id;
                if ($id_small_com != 0 && $id_small_com != '') {
                    $id = $id_small_com;
                }
                $list = $this->Api_company_model->listJobDeliver($id, $id_department, $id_small_com, $start_time, $end_time);
                $dahuy = [];
                $dalam = [];
                $danglam = [];
                $dukien = [];
                foreach ($list as $value) {
                    if ($value['status'] == 1) {
                        $list_par = $this->Api_company_model->getListJobPar($value["job_id"]);
                        $avatar_name = '';
                        $arr_par = [];
                        foreach ($list_par as $valuePar) {
                            $arr_par[] = [
                                'staff_id' => $valuePar->staff_id,
                            ];
                        }
                        $list_content = $this->Api_company_model->list_content($value["job_id"]);
                        $dahuy[] = [
                            'job_id' => $value['job_id'],
                            'job_name' => $value['job_name'],
                            'job_city' => $value['job_city'],
                            'job_district' => $value['job_district'],
                            'job_address' => $value['job_address'],
                            'department' => $value['department'],
                            'job_day_start' =>  date('d-m-Y', $value['job_day_start']),
                            'job_day_end' => date('d-m-Y', $value['job_day_end']),
                            'status' => $value['status'],
                            "participants" => $arr_par,
                            "list_content" => $list_content,
                        ];
                    }
                    if ($value['status'] == 2) {
                        $list_par = $this->Api_company_model->getListJobPar($value["job_id"]);
                        $avatar_name = '';
                        $arr_par = [];
                        foreach ($list_par as $valuePar) {
                            $arr_par[] = [
                                'staff_id' => $valuePar->staff_id,
                            ];
                        }
                        $list_content = $this->Api_company_model->list_content($value["job_id"]);
                        $dalam[] = [
                            'job_id' => $value['job_id'],
                            'job_name' => $value['job_name'],
                            'job_city' => $value['job_city'],
                            'job_district' => $value['job_district'],
                            'job_address' => $value['job_address'],
                            'department' => $value['department'],
                            'job_day_start' =>  date('d-m-Y', $value['job_day_start']),
                            'job_day_end' => date('d-m-Y', $value['job_day_end']),
                            'status' => $value['status'],
                            "participants" => $arr_par,
                            "list_content" => $list_content,
                        ];
                    }
                    if ($value['status'] == 3) {
                        $list_par = $this->Api_company_model->getListJobPar($value["job_id"]);
                        $avatar_name = '';
                        $arr_par = [];
                        foreach ($list_par as $valuePar) {
                            $arr_par[] = [
                                'staff_id' => $valuePar->staff_id,
                            ];
                        }
                        $list_content = $this->Api_company_model->list_content($value["job_id"]);
                        $danglam[] = [
                            'job_id' => $value['job_id'],
                            'job_name' => $value['job_name'],
                            'job_city' => $value['job_city'],
                            'job_district' => $value['job_district'],
                            'job_address' => $value['job_address'],
                            'department' => $value['department'],
                            'job_day_start' =>  date('d-m-Y', $value['job_day_start']),
                            'job_day_end' => date('d-m-Y', $value['job_day_end']),
                            'status' => $value['status'],
                            "participants" => $arr_par,
                            "list_content" => $list_content,
                        ];
                    }
                    if ($value['status'] == 4) {
                        $list_par = $this->Api_company_model->getListJobPar($value["job_id"]);
                        $avatar_name = '';
                        $arr_par = [];
                        foreach ($list_par as $valuePar) {
                            $arr_par[] = [
                                'staff_id' => $valuePar->staff_id,
                            ];
                        }
                        $list_content = $this->Api_company_model->list_content($value["job_id"]);
                        $dukien[] = [
                            'job_id' => $value['job_id'],
                            'job_name' => $value['job_name'],
                            'job_city' => $value['job_city'],
                            'job_district' => $value['job_district'],
                            'job_address' => $value['job_address'],
                            'department' => $value['department'],
                            'job_day_start' =>  date('d-m-Y', $value['job_day_start']),
                            'job_day_end' => date('d-m-Y', $value['job_day_end']),
                            'status' => $value['status'],
                            "participants" => $arr_par,
                            "list_content" => $list_content,
                        ];
                    }
                }
                $arr = [
                    'dahuy' => $dahuy,
                    'dalam' => $dalam,
                    'danglam' => $danglam,
                    'dukien' => $dukien,
                ];
                success('Danh sách công việc theo trạng thái', $arr);
            }
        }
    }
    public function deleteSchedule()
    {
        $token          = $this->input->post('token');
        $id_schedule    = $this->input->post('id_schedule');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $id_schedule == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = [
                    'id' => $id_schedule,
                ];
                $id_staff = [
                    'schedule_id' => $id_schedule,
                ];

                $data = [
                    'schedule_index' => 2
                ];

                $updateSchedule = $this->Api_company_model->updateSchedule($data, $id);
                success('Xóa lịch trình thành công', []);
            }
        }
    }
    public function updateJobContentCompany()
    {
        $token          = $this->input->post('token');
        $id_content       = $this->input->post('id_content');
        $status       = $this->input->post('status');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $id_content == "" || $status == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = [
                    'id_content' => $id_content,
                ];
                if ($status == 1) {
                    $data = [
                        'status' => 2,
                    ];
                } else {
                    $data = [
                        'status' => 1,
                    ];
                }
                $this->Api_company_model->updateJobContentCompany($id, $data);
                success('Cập nhật trạng thái thành công', []);
            }
        }
    }
    public function addsSchedulePlace()
    {
        $token          = $this->input->post('token');
        $id_schedule    = $this->input->post('id_schedule');
        $place         = $this->input->post('place');
        $lat_long         = $this->input->post('lat_long');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $id_schedule == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $list_staff = $this->Api_company_model->schedulePlaceById($id_schedule);
                $place = explode(';', $place);
                $lat_long = explode(';', $lat_long);
                $arr_id = [];
                for ($i = 0; $i < count($place); $i++) {
                    $ex = explode(',', $lat_long[$i]);
                    $sch_placell = [
                        'schedule_id'       => $id_schedule,
                        'place'             => $place[$i],
                        'lat'               => $ex[0],
                        'long'               => $ex[1],
                    ];
                    $arr_id[] = $this->Api_company_model->createSchedulePlaceLatLong($sch_placell);
                }
                foreach ($list_staff as $value) {
                    for ($i = 0; $i < count($arr_id); $i++) {
                        $schedule_place = [
                            'schedule_id'       => $id_schedule,
                            'id_lat_long'       => $arr_id[$i],
                            'staff_id'          => $value->staff_id,
                        ];
                        // var_dump($schedule_place);
                        // die();
                        $this->Api_company_model->createSchedulePlace($schedule_place);
                    }
                }

                success('Thêm điểm đến thành công', []);
            }
        }
    }
    public function listStaffByRole()
    {
        $token              = $this->input->post('token');
        $id_small_com           = $this->input->post('id_com_small');
        $id_power           = $this->input->post('id_power');
        $secretKey          = $this->secretKey;
        $time               = time();

        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {

                // $id = 0;
                // if ($decodeToken->type == 1) {
                $id = $decodeToken->id;
                if ($id_small_com != 0 && $id_small_com != '') {
                    $id = $id_small_com;
                }
                // } else {
                //     $id = $decodeToken->id_parent;
                //     $id_small = $decodeToken->id;
                // }
                $id_small = 0;

                $data = $this->Api_company_model->listStaffByRole($id, $id_small, $id_power);
                $arr_data = [];
                foreach ($data as $value) {
                    $avatar_name = '';
                    if ($value->avatar == "") {
                        $avatar_name = base_url() . "/images_staff/avatar_default.png";
                    } else {
                        $avatar_name = $value->avatar;
                    }
                    $data_department = $this->Api_company_model->listDepartmentById($value->department);
                    $data_role = $this->Api_company_model->listRoleById($value->power);
                    $name_department = '';
                    if (count($data_department) == 0) {
                        $name_department = '';
                    } else {
                        $name_department = $data_department['name_department'];
                    }
                    $arr_data[] = [
                        'id_staff' => $value->staff_id,
                        'name' => $value->name_staff,
                        'avatar' => $avatar_name,
                        'name_department' => $name_department,
                        'id_power' => $data_role['id'],
                        'name_power' => $data_role['name'],
                    ];
                }
                success('Danh sách nhân viên theo quyền truy cập', $arr_data);
            }
        }
    }

    public function listCalendarByMonth()
    {
        $token              = $this->input->post('token');
        $id_small_com           = $this->input->post('id_com_small');
        $secretKey          = $this->secretKey;
        $time               = time();

        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {

                // $id = 0;
                // if ($decodeToken->type == 1) {
                $id = $decodeToken->id;
                if ($id_small_com != 0 && $id_small_com != '') {
                    $id = $id_small_com;
                }
                // } else {
                //     $id = $decodeToken->id_parent;
                //     $id_small = $decodeToken->id;
                // }

                $list = $this->Api_company_model->listCalendarByMonth($id, 0);
                $month = [];
                foreach ($list as $value) {
                    $month[] = [
                        'month' => date('m-Y', $value['month'])
                    ];
                }
                success('Danh sách tháng', $month);
            }
        }
    }

    public function createWifi()
    {
        $token              = $this->input->post('token');
        $id_small_com       = $this->input->post('id_com');
        $mac                = $this->input->post('mac');
        $ip                 = $this->input->post('ip');
        $name_wifi          = $this->input->post('name_wifi');
        $secretKey          = $this->secretKey;
        $time               = time();

        if ($token == "" || $ip == "" || $mac == "" || $name_wifi == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = $decodeToken->id;
                if ($id_small_com != 0 && $id_small_com != '') {
                    $id = $id_small_com;
                }

                $data = [
                    'ip' => $ip,
                    'mac' => $mac,
                    'name_wifi' => $name_wifi,
                    'created_at' => $time,
                    'updated_at' => $time,
                ];

                $id_wifi = $this->Api_company_model->createWifi($data);

                $listWifi = $this->Api_company_model->detailConfig($id, 0);
                $a = '';
                // foreach ($listWifi as $value) {
                //     $a = $value['id_wifi'];
                // }


                if ($listWifi['id_wifi'] != '') {
                    $a = $listWifi['id_wifi'] . ',' . $id_wifi;
                } else {
                    $a = $id_wifi;
                }
                // var_dump($listWifi['id_wifi']);
                // die();

                $data1 = [
                    'id_wifi' => $a,
                ];
                $id = [
                    'id' => $listWifi['id'],
                ];
                $this->Api_company_model->updateConfig($data1, $id);
                // var_dump($data1);
                // die();

                success('Thêm wifi thành công', []);
            }
        }
    }

    public function updateWifi()
    {
        $token              = $this->input->post('token');
        $id_wifi            = $this->input->post('id_wifi');
        $mac            = $this->input->post('mac');
        $ip           = $this->input->post('ip');
        $name_wifi           = $this->input->post('name_wifi');
        $secretKey          = $this->secretKey;
        $time               = time();

        if ($token == "" || $id_wifi == "" || $mac == "" || $ip == "" || $name_wifi == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {

                $data = [
                    'ip' => $ip,
                    'mac' => $mac,
                    'name_wifi' => $name_wifi,
                    'updated_at' => $time,
                ];

                $id = [
                    'id' => $id_wifi
                ];

                $this->Api_company_model->updateWifi($data, $id);
                success('Cập nhật wifi thành công', []);
            }
        }
    }
    public function deleteWifi()
    {
        $token              = $this->input->post('token');
        $id_small_com       = $this->input->post('id_com');
        $id_wifi            = $this->input->post('id_wifi');
        $secretKey          = $this->secretKey;
        $time               = time();

        if ($token == "" || $id_wifi == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = 0;
                $id = $decodeToken->id;
                if ($id_small_com != 0 && $id_small_com != '') {
                    $id = $id_small_com;
                }
                $listWifi = $this->Api_company_model->checkConfig($id, 0, $id_wifi, 0);
                if (count($listWifi) > 0) {
                    $ex = explode(',', $listWifi['id_wifi']);
                    for ($i = 0; $i < count($ex); $i++) {
                        if ($ex[$i] == $id_wifi) {
                            \array_splice($ex, $i, 1);
                        }
                    }
                    $ex = implode(',', $ex);
                    $data1 = [
                        'id_wifi' => $ex,
                    ];
                    $id_config = [
                        'id' => $listWifi['id'],
                    ];
                    $this->Api_company_model->updateConfig($data1, $id_config);
                    $id = [
                        'id' => $id_wifi
                    ];

                    $this->Api_company_model->deleteWifi($id);
                    success('Xóa wifi thành công', []);
                } else {
                    set_error(404, 'Xóa thất bại');
                }
            }
        }
    }

    public function createLatLong()
    {
        $token              = $this->input->post('token');
        $id_small_com       = $this->input->post('id_com');
        $address           = $this->input->post('address');
        $lat_long           = $this->input->post('lat_long');
        $secretKey          = $this->secretKey;
        $time               = time();

        if ($token == "" || $address == "" || $lat_long == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = 0;
                $id = $decodeToken->id;
                if ($id_small_com != 0 && $id_small_com != '') {
                    $id = $id_small_com;
                }
                $lat_long = explode(',', $lat_long);
                $data = [
                    'address' => $address,
                    'lat' => $lat_long[0],
                    'long' => $lat_long[1],
                    // 'lat_long' => $lat_long,
                    'created_at' => $time,
                    'updated_at' => $time,
                ];

                $id_lat_long = $this->Api_company_model->createLatLong($data);

                $listWifi = $this->Api_company_model->detailConfig($id, 0);
                $a = '';
                if ($listWifi['id_lat_long'] != '') {
                    $a = $listWifi['id_lat_long'] . ',' . $id_lat_long;
                } else {
                    $a = $id_lat_long;
                }

                $data1 = [
                    'id_lat_long' => $a,
                ];
                $id = [
                    'id' => $listWifi['id'],
                ];
                $this->Api_company_model->updateConfig($data1, $id);
                success('Thêm tọa độ thành công', []);
            }
        }
    }

    public function updateLatLong()
    {
        $token              = $this->input->post('token');
        $id_lat_long        = $this->input->post('id_lat_long');
        $address           = $this->input->post('address');
        $lat_long           = $this->input->post('lat_long');
        $secretKey          = $this->secretKey;
        $time               = time();

        if ($token == "" || $id_lat_long == "" || $address == "" || $lat_long == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id_small_com = 0;
                $id = $decodeToken->id;
                if ($id_small_com != 0 && $id_small_com != '') {
                    $id = $id_small_com;
                }
                $lat_long = explode(',', $lat_long);
                $data = [
                    'address' => $address,
                    'lat' => $lat_long[0],
                    'long' => $lat_long[1],
                    'updated_at' => $time,
                ];
                $id = [
                    'id' => $id_lat_long
                ];
                $this->Api_company_model->updateLatLong($data, $id);
                success('Cập nhật tọa độ thành công', []);
            }
        }
    }

    public function deleteLatLong()
    {
        $token              = $this->input->post('token');
        $id_small_com       = $this->input->post('id_com');
        $id_lat_long        = $this->input->post('id_lat_long');
        $secretKey          = $this->secretKey;
        $time               = time();

        if ($token == "" || $id_lat_long == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = 0;
                $id = $decodeToken->id;
                if ($id_small_com != 0 && $id_small_com != '') {
                    $id = $id_small_com;
                }
                $listWifi = $this->Api_company_model->checkConfig($id, 0, 0, $id_lat_long);
                if (count($listWifi) > 0) {
                    $ex = explode(',', $listWifi['id_lat_long']);
                    for ($i = 0; $i < count($ex); $i++) {
                        if ($ex[$i] == $id_lat_long) {
                            // echo $ex[$i];
                            \array_splice($ex, $i, 1);
                        }
                    }
                    $ex = implode(',', $ex);
                    $data1 = [
                        'id_lat_long' => $ex,
                    ];
                    $id_config = [
                        'id' => $listWifi['id'],
                    ];
                    // var_dump($ex);
                    // die();
                    $this->Api_company_model->updateConfig($data1, $id_config);
                    $id = [
                        'id' => $id_lat_long
                    ];
                    $this->Api_company_model->deleteLatLong($id);
                    success('Xóa tọa độ thành công', []);
                } else {
                    set_error(404, 'Xóa tọa độ thất bại');
                }
            }
        }
    }

    public function listStaffByMonth()
    {
        $token          = $this->input->post('token');
        $id_small_com   = $this->input->post('id_small_com');
        $name_staff     = $this->input->post('name_staff');
        $id_department     = $this->input->post('id_department');
        $month          = $this->input->post('month');
        $status         = $this->input->post('status');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id_small = 0;
                $id = $decodeToken->data->id;
                if ($id_small_com != 0 && $id_small_com != '') {
                    $id = $id_small_com;
                }
                $month = strtotime('01-' . $month);
                $list = $this->Api_company_model->listStaffByMonth($id, $id_small, $id_department, $name_staff, $month, $status);
                // var_dump($list);
                // die();
                $arr = [];
                $a = [];
                $list_calendar = [];
                if ($status == 1) {
                    foreach ($list as $value) {
                        $a[] = (int)$value['staff_id'];
                        if ($value['avatar'] == "") {
                            $avatar_name = base_url() . "/images_staff/avatar_default.png";
                        } else {
                            $avatar_name = $value['avatar'];
                        }
                        $dep = $this->Api_company_model->listDepartmentById($value['department']);
                        $listDayCalendar = $this->Api_company_model->listDayCalendar($value['id']);
                        $total_staff = 0;
                        $arr_calender = $this->Api_company_model->listMonthCalendarStaff($value['id']);
                        foreach ($arr_calender as $value1) {
                            if ($value1->staff_id == '') {
                                $total_staff = 0;
                            } else {
                                $staff = explode(',', $value1->staff_id);
                                $total_staff = count($staff);
                            }
                        }
                        $arr_calendar = [
                            'id_calendar' => $value['calendar_id'],
                            'name_calendar' => $value['name_calendar'],
                            'month' => $value['month'],
                            'total_staff' => $total_staff,
                            'listDayCalendar' => $listDayCalendar,
                        ];
                        $list_calendar[] = [
                            'staff_id'   => $value['staff_id'],
                            'name_staff' => $value['name_staff'],
                            'name_department' => $dep['name_department'],
                            'avatar' => $avatar_name,
                            'detail_calendar' => $arr_calendar,
                        ];
                    }
                }
                if ($month == "" && $status == 2) {
                    $list_staff = $this->Api_company_model->listStaff($id, $id_small, $id_department, $name_staff);
                    $b = [];
                    foreach ($list_staff as $valueStaff) {
                        $b[] = (int)$valueStaff['staff_id'];
                    }
                    $arr = array_diff($b, $a);
                    $khong_co_lich = [];
                    foreach ($arr as $valueIdStaff) {
                        $is = $this->Api_company_model->getNameStaffByid($valueIdStaff);
                        $avatar_name = '';
                        if ($is['avatar'] == "") {
                            $avatar_name = base_url() . "/images_staff/avatar_default.png";
                        } else {
                            $avatar_name = $is['avatar'];
                        }

                        $dep = $this->Api_company_model->listDepartmentById($is['department']);

                        $list_calendar[] = [
                            'staff_id'   => $is['staff_id'],
                            'name_staff' => $is['name_staff'],
                            'name_department' => $dep['name_department'],
                            'avatar' => $avatar_name,
                            'detail_calendar' => null,
                        ];
                    }
                }
                if ($status == '') {
                    foreach ($list as $value) {
                        $a[] = (int)$value['staff_id'];
                        if ($value['avatar'] == "") {
                            $avatar_name = base_url() . "/images_staff/avatar_default.png";
                        } else {
                            $avatar_name = $value['avatar'];
                        }
                        $dep = $this->Api_company_model->listDepartmentById($value['department']);
                        $listDayCalendar = $this->Api_company_model->listDayCalendar($value['id']);
                        $total_staff = 0;
                        $arr_calender = $this->Api_company_model->listMonthCalendarStaff($value['id']);
                        foreach ($arr_calender as $value1) {
                            if ($value1->staff_id == '') {
                                $total_staff = 0;
                            } else {
                                $staff = explode(',', $value1->staff_id);
                                $total_staff = count($staff);
                            }
                        }
                        $arr_calendar = [
                            'id_calendar' => $value['calendar_id'],
                            'name_calendar' => $value['name_calendar'],
                            'month' => $value['month'],
                            'total_staff' => $total_staff,
                            'listDayCalendar' => $listDayCalendar,
                        ];
                        $list_calendar[] = [
                            'staff_id'   => $value['staff_id'],
                            'name_staff' => $value['name_staff'],
                            'name_department' => $dep['name_department'],
                            'avatar' => $avatar_name,
                            'detail_calendar' => $arr_calendar,
                        ];
                    }

                    $list_staff = $this->Api_company_model->listStaff($id, $id_small, $id_department, $name_staff);
                    $b = [];
                    foreach ($list_staff as $valueStaff) {
                        $b[] = (int)$valueStaff['staff_id'];
                    }
                    $arr = array_diff($b, $a);
                    $khong_co_lich = [];
                    foreach ($arr as $valueIdStaff) {
                        $is = $this->Api_company_model->getNameStaffByid($valueIdStaff);
                        $avatar_name = '';
                        if ($is['avatar'] == "") {
                            $avatar_name = base_url() . "/images_staff/avatar_default.png";
                        } else {
                            $avatar_name = $is['avatar'];
                        }

                        $dep = $this->Api_company_model->listDepartmentById($is['department']);

                        $list_calendar[] = [
                            'staff_id'   => $is['staff_id'],
                            'name_staff' => $is['name_staff'],
                            'name_department' => $dep['name_department'],
                            'avatar' => $avatar_name,
                            'detail_calendar' => null,
                        ];
                    }
                }
                success('Danh sách nhân viên', $list_calendar);
            }
        }
    }


    public function deleteStaffSchedule()
    {
        $token              = $this->input->post('token');
        $id_staff           = $this->input->post('id_staff');
        $id_schedule        = $this->input->post('id_schedule');
        $secretKey          = $this->secretKey;
        $time               = time();

        if ($token == "" || $id_staff == "" || $id_schedule == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->data->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $arr = [
                    'schedule_id' => $id_schedule,
                    'staff_id' => $id_staff,
                ];
                $deleteScheduleStaff = $this->Api_company_model->deleteScheduleStaff($arr);
                $deleteSchedulePlace = $this->Api_company_model->deleteSchedulePlace($arr);
                success('Xóa nhân viên khỏi lịch trình thành công', []);
            }
        }
    }

    public function coordinateStaff()
    {
        $token              = $this->input->post('token');
        $id_staff           = $this->input->post('id_staff');
        $date               = $this->input->post('date');
        $secretKey          = $this->secretKey;
        $time               = time();

        if ($token == "" || $id_staff == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->data->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $day = 0;
                if ($date != '' && $date != 0) {
                    $day = strtotime($date);
                } else {
                    $day = strtotime(date('Y-m-d'));
                }
                $list =  $this->Api_company_model->coordinateStaff($id_staff, $day);
                $list_sch = $this->Api_company_model->getScheduleToday($id_staff, $day);
                $getSchedulelatLongToday = $this->Api_company_model->getSchedulelatLongToday($id_staff, $day);
                $arr_sch = [];
                foreach ($list_sch as $value) {
                    $arr_sch[] = [
                        'id'            => $value['id'],
                        'com_id'        => $value['com_id'],
                        'staff_id'      => $value['staff_id'],
                        'status'        => $value['status'],
                        'name'          => $value['name'],
                        'date_start'    => $value['date_start'],
                        'date_end'      => $value['date_end'],
                        'note'          => $value['note'],
                        'list_lat_long' => $getSchedulelatLongToday,
                    ];
                }

                $arr = [
                    'list' => $list,
                    'list_sch' => $arr_sch,
                ];
                success('Tọa độ nhân viên', $arr);
            }
        }
    }

    public function detailCalendar()
    {
        $id_calendar        = $this->input->post('id_calendar');
        $token                  = $this->input->post('token');
        $secretKey              = $this->secretKey;
        $time                   = time();

        if ($token == "" || $id_calendar == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->data->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $detailCalendar = $this->Api_company_model->detailCalendar($id_calendar);
                $listDayCalendar = $this->Api_company_model->listDayCalendar($id_calendar);
                $arr['id_calendar'] = $detailCalendar['id'];
                $arr['id_company'] = $detailCalendar['id_company'];
                $arr['name_calendar'] = $detailCalendar['name_calendar'];
                $arr['id_shift'] = $detailCalendar['id_shift'];
                $arr['month'] = $detailCalendar['month'];
                $arr['id_calendar'] = $detailCalendar['id'];
                $arr['listDayCalendar'] = $listDayCalendar;
                success('Chi tiết lịch làm việc', $arr);
            }
        }
    }

    public function create_number_day()
    {
        $com_id        = $this->input->post('com_id');
        $date        = $this->input->post('date');
        $number_day        = $this->input->post('number_day');
        $token                  = $this->input->post('token');
        $secretKey              = $this->secretKey;
        $time                   = time();

        if ($token == "" || $date == "" || $number_day == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->data->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                if ($com_id != '') {
                    $id = $com_id;
                }
                $date = strtotime("01-" . $date);
                $arr_id = [
                    'com_id' => $id,
                    'date' => $date,
                ];
                $delete_number_day = $this->Api_company_model->delete_number_day($arr_id);
                // var_dump($delete_number_day);
                $data = [
                    'com_id' => $id,
                    'date' => $date,
                    'number_day' => $number_day,
                    'created_at' => $time,
                    'updated_at' => $time,
                ];
                $create_number_day = $this->Api_company_model->create_number_day($data);
                success('Thiết lập số ngày làm việc thành công', []);
            }
        }
    }

    public function show_time_sheet()
    {
        $com_id        = $this->input->post('com_id');
        $token               = $this->input->post('token');
        $date_start               = $this->input->post('date_start');
        $date_end               = $this->input->post('date_end');
        $id_department               = $this->input->post('id_department');
        $time = time();
        $secretKey = $this->secretKey;
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->data->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                if ($com_id != '') {
                    $id = $com_id;
                }
                if ($date_start == '') {
                    $date_start = "2021-09-02";
                    // $date_start = date('Y-m-d',$time);
                }

                if ($date_end == '') {
                    $date_end = $date_start;
                }

                $list_shift             = $this->Api_company_model->list_shift($id);
                $show_time_sheet        = $this->Api_company_model->show_time_sheet($id, $date_start, $date_end, $id_department);
                $arr_sheet = [];
                foreach ($show_time_sheet as $sheets => $sheet) {
                    $index_sheet = $sheet['staff_id'] . '_' . date("d_m_Y", strtotime($sheet['at_time']));
                    $shift = [];
                    $detail_shift             = $this->Api_company_model->detail_shift($sheet['shift_id']);
                    $arr_sheet[] = [
                        'sheet_id' => $sheet['sheet_id'],
                        'staff_id' => $sheet['staff_id'],
                        'shift_id' => $detail_shift,
                        'name_staff' => $sheet['name_staff'],
                        'ts_image' => $sheet['ts_image'],
                        'ts_location_name' => $sheet['ts_location_name'],
                        'note' => $sheet['note'],
                        'department' => $sheet['department'],
                        'date' => strtotime($sheet['at_time']),
                    ];
                }
                success('lịch sử điểm danh', $arr_sheet);
            }
        }
    }

    public function get_number_day_sheet()
    {
        $com_id        = $this->input->post('com_id');
        $date        = $this->input->post('date');
        $token                  = $this->input->post('token');
        $secretKey              = $this->secretKey;
        $time                   = time();

        if ($token == "" || $date == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            $id = $decodeToken->data->id;
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                if ($com_id != "") {
                    $id = $com_id;
                }
                $date = strtotime("01-" . $date);
                $get_number_day_sheet = $this->Api_company_model->get_number_day_sheet($id, $date);
                if ($get_number_day_sheet == null) {
                    set_error(404, 'Không có giá trị');
                } else {
                    success('số ngày làm việc trong tháng', $get_number_day_sheet);
                }
            }
        }
    }

    public function notify_job_expired()
    {
        $token                  = $this->input->post('token');
        $secretKey              = $this->secretKey;
        $time = time();
        $time_end = $time + 86400 * 3;
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $com_id = $decodeToken->data->id;
                $list_job = $this->Api_company_model->notify_job_expired($com_id, $time, $time_end);
                $arr_id_staff = [];
                foreach ($list_job as $job) {
                    $list_staff = $this->Api_company_model->getListJobPar($job['job_id']);
                    foreach ($list_staff as $staff) {
                        $arr_id_staff[] = [
                            'staff_id' => $staff->staff_id,
                            'job_id' => $job['job_id'],
                            'job_day_end' => date('d-m-Y', $job['job_day_end']),
                        ];
                    }
                }
                foreach ($arr_id_staff as $value) {
                    $data_notify = [
                        'company' => $com_id,
                        'notify_to_staff' => $value['staff_id'],
                        'note' => 'Công việc được giao ngày ' . $value['job_day_end'] . ' sắp đến hạn bàn giao. Để không làm ảnh hưởng tiến độ công việc của các thành viên khác, bạn cố gắng đẩy nhanh tiến độ lên nhé',
                        'date' => time(),
                        'status' => 2,
                        'job_schedule' => $value['job_id'],
                        'type' => 1,
                        'image_notify' => 5,
                    ];
                    $add_notify = $this->Api_company_model->create_notify($data_notify);
                }
                success('Thông báo sắp hết hạn công việc thành công', $data_notify);
            }
        }
    }

    public function list_notify()
    {
        $token                  = $this->input->post('token');
        $secretKey              = $this->secretKey;
        $time                   = time();
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = $decodeToken->data->id;
                $notify = $this->Api_company_model->show_noti($id);
                $arr_notiffy = [];

                $access_token = $token;
                $header[]         = 'Authorization: ' . $access_token . '';
                $curl     = curl_init();
                $status = 'true';
                $url = 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php?filter_by[active]=' . $status;
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                    CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                    CURLOPT_HTTPHEADER => $header,
                ));
                $resp = curl_exec($curl);
                $staff_active = json_decode($resp);
                $staff_active = $staff_active->data->items;
                $arr_staff = [];
                foreach ($staff_active as $key => $value) {
                    $arr_staff[$value->ep_id] = [
                        'ep_id' => $value->ep_id,
                        'ep_name' => $value->ep_name,
                        'ep_image' => $value->ep_image,
                    ];
                }

                foreach ($notify as $key => $value) {
                    $arr_notiffy[] = [
                        'id_notify' => $value['id_notify'],
                        'staff_name' => $arr_staff[$value['staff']]['ep_name'],
                        'staff_image' => $arr_staff[$value['staff']]['ep_image'],
                        'staff_id' => $value['staff'],
                        'note' => $value['note'],
                        'date' => $value['date'],
                        'job_schedule' => $value['job_schedule'],
                        'type' => $value['type'],
                    ];
                }
                success('Thông báo', $arr_notiffy);
            }
        }
    }
}
