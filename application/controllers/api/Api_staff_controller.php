<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/jwt/JWT.php';

use \Firebase\JWT\JWT;

class api_staff_controller extends CI_Controller
{

    protected $secretKey = 'Chamcong365@';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/Api_staff_model');
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->helper('api_result');
        // $this->load->helper('resize_image');
        $this->load->library('upload');
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
            $com_id = $decodeToken->data->com_id;
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

    public function staffLogin()
    {
        $email    = $this->input->post('email');
        $password = $this->input->post('pass');
        if ($email == "" || $password == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
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
                $staff_arr = [
                    'id'   =>  (int)$responsive->data->user_info->ep_id,
                    'name' => $responsive->data->user_info->ep_name,
                    'email' => $responsive->data->user_info->ep_email,
                    'phone' => $responsive->data->user_info->ep_phone,
                    'address' => $responsive->data->user_info->ep_address,
                    'avatar' => $responsive->data->user_info->ep_image,
                    'dep_name' => $responsive->data->user_info->dep_name,
                ];
                $arrToken  = [
                    'id'         => (int)$responsive->data->user_info->ep_id,
                    'name'       => $responsive->data->user_info->ep_name,
                    'email' => $responsive->data->user_info->ep_email,
                    'com_id'     => $responsive->data->user_info->com_id,
                    'type'       => 4,
                    'exp'    => time() + 86400 * 7,
                    'token'    => $responsive->data->access_token,
                ];
                $secretKey = $this->secretKey;
                $token = JWT::encode($arrToken, $secretKey);
                $data = [
                    'token' => $token,
                    'info' => $staff_arr,
                ];
                success('Đăng nhập thành công', $data);
            }
        }
    }
    public function staffRegister()
    {
        $secretKey = $this->secretKey;

        $OTP        = rand(100000, 999999);
        $company_id = $this->input->post('id_company');
        $email      = $this->input->post('email');
        $pass       = $this->input->post('pass');
        $name_staff = $this->input->post('staff_name');
        $alias      = url_title(convert_accented_characters($name_staff));
        $telephone  = $this->input->post('phone');
        $department = $this->input->post('department');
        $position   = $this->input->post('position');
        $address   = $this->input->post('address');
        $gio_tinh   = $this->input->post('gio_tinh');
        $birthday   = $this->input->post('birthday');
        $marriage   = $this->input->post('marriage'); // hôn nhân
        $work_experience   = $this->input->post('work_experience'); // kinh nghiệm làm việc
        $date_start_work   = $this->input->post('date_start_work'); // ngày bắt đầu làm việc
        $education   = $this->input->post('education'); // học vấns
        if ($company_id == "" || $email == "" || $pass == "" || $name_staff == "" || $telephone == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $curl     = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'https://chamcong.24hpay.vn/service/register_employee.php',
                    CURLOPT_POST => 1,
                    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                    CURLOPT_POSTFIELDS => array(
                        'email'         => $email,
                        'password'      => $pass,
                        'ep_name'       => $name_staff,
                        'ep_phone'      => $telephone,
                        'role'          => 4,
                        'com_id'        => $company_id,
                        'dep_id'        => $department,
                        'position'      => $position,
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

    public function resendOTP()
    {
        $secretKey = $this->secretKey;
        $token     = $this->input->post('token');
        // $title     = $this->input->post('title');
        $OTP       = rand(100000, 999999);

        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {

            $time        = time();
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $staff_id   = $decodeToken->data->id;
                $name_staff = $decodeToken->name;
                $email      = $decodeToken->email;

                $body  = file_get_contents('email_template/email.html');
                $body  = str_replace('%name%', $name_staff, $body);
                $body  = str_replace('%otp%', $OTP, $body);
                $title = "Xác thực tài khoản nhân viên";
                $this->Api_staff_model->SendMailAmazon($title, $name_staff, $email, $body);
                $data = [
                    'otp' => $OTP,
                ];
                $condition = [
                    'staff_id' => $staff_id,
                ];
                $this->Api_staff_model->updateStaff($data, $condition);
                success('Gữi mã xác thực OTP thành công', []);
            }
        }
    }
    public function checkStaffRegisterOtp()
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
                $staff_id = $decodeToken->data->id;

                $checked = $this->Api_staff_model->checkOTP($staff_id, $otp);
                if ($checked == 0) {
                    set_error(404, 'Sai OTP');
                } else {
                    $this->Api_staff_model->verifyRegister($staff_id);
                    success('Đăng kí thành công', []);
                }
            }
        }
    }
    public function passForget()
    {
        $email = $this->input->post('email');
        if ($email == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $mail_check = $this->Api_staff_model->checkMail($email);

            if ($mail_check == 0) {
                set_error(404, 'Email không tồn tại');
            } else {
                $staff_name = $this->Api_staff_model->getStaffByEmail($email)->row();
                $OTP        = rand(100000, 999999);
                $name_staff = $staff_name->name_staff;

                $data = [
                    'otp' => $OTP,
                ];
                $condition = [
                    'email' => $email,
                ];
                $this->Api_staff_model->updateStaff($data, $condition);
                // Gửi mail otp
                $body  = file_get_contents('email_template/email.html');
                $body  = str_replace('%name%', $name_staff, $body);
                $body  = str_replace('%otp%', $OTP, $body);
                $title = "Xác thực quên mật khẩu";
                $this->Api_staff_model->SendMailAmazon($title, $name_staff, $email, $body);
                //Tạo token
                $secretKey           = "Punclock365.timviec365.api";
                $arrToken            = array();
                $arrToken['id']      = $staff_name->staff_id;
                $arrToken['exp'] = time() + 86400;
                $tokenOTP            = JWT::encode($arrToken, $secretKey);
                $data                = [
                    'token' => $tokenOTP,
                ];
                success('Gửi OTP thành công  ', $data);
            }
        }
    }
    public function checkPassForgetOtp()
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
                $staff_id = $decodeToken->data->id;
                $checked  = $this->Api_staff_model->checkOTP($staff_id, $otp);
                if ($checked == 0) {
                    set_error(404, 'Sai OTP');
                } else {
                    $this->Api_staff_model->verifyRegister($staff_id);
                    success('Mã OTP đúng', []);
                }
            }
        }
    }
    public function changePass()
    {
        $pass      = md5($this->input->post('pass'));
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
                $staff_id = $decodeToken->data->id;
                $data     = [
                    'pass' => $pass,
                ];
                $condition = [
                    'staff_id' => $staff_id,
                ];
                $this->Api_staff_model->changePass($data, $condition);
                success('Đối mật khẩu thành công', []);
            }
        }
    }
    public function changeStaffPass()
    {
        $old_pass  = $this->input->post('old_pass');
        $new_pass  = $this->input->post('new_pass');
        $token     = $this->input->post('token');
        $secretKey = $this->secretKey;
        $time      = time();

        if ($token == "" || $old_pass == "" || $new_pass == "") {
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
                        CURLOPT_URL => 'https://chamcong.24hpay.vn/service/change_pass_employee.php',
                        CURLOPT_POST => 1,
                        CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                        CURLOPT_HTTPHEADER => $header,
                        CURLOPT_POSTFIELDS => array(
                            'old_pass'      => $old_pass,
                            'new_pass'      => $new_pass,
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
    public function updateStaffInfo()
    {
        $token      = $this->input->post('token');
        $name       = $this->input->post('name');
        $phone      = $this->input->post('phone');
        // $file       = $this->input->post('avatar');
        $address   = $this->input->post('address');
        $gio_tinh   = $this->input->post('gio_tinh');
        $birthday   = $this->input->post('birthday');
        $marriage   = $this->input->post('marriage'); // hôn nhân
        $work_experience   = $this->input->post('work_experience'); // kinh nghiệm làm việc
        $date_start_work   = $this->input->post('date_start_work'); // ngày bắt đầu làm việc
        $education      = $this->input->post('education'); // học vấns
        $com_id         = $this->input->post('com_id');
        $dep_id         = $this->input->post('dep_id');
        $position_id    = $this->input->post('position_id');
        $secretKey = $this->secretKey;
        $time      = time();

        if ($token == "" || $name == "" || $phone == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);

            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $access_token = $decodeToken->token;
                var_dump($decodeToken->com_id);
                die();
                $header[]         = 'Authorization: ' . $access_token . '';
                $curl     = curl_init();
                curl_setopt_array(
                    $curl,
                    array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => 'https://chamcong.24hpay.vn/service/update_user_info_employee.php',
                        CURLOPT_POST => 1,
                        CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                        CURLOPT_HTTPHEADER => $header,
                        CURLOPT_POSTFIELDS => array(
                            'ep_name'             => $name,
                            'ep_phone'      => $phone,
                            'ep_address'     => $address,
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
    public function getStaffInfo()
    {
        $token     = $this->input->post('token');
        $secretKey = $this->secretKey;
        $time      = time();

        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $detailStaff = $this->detailEmploye($token, 0);
            if ($detailStaff->data->items[0]->ep_image == "") {
                $avatar_name = base_url() . "/images_staff/avatar_default.png";
            } else {
                $avatar_name = $detailStaff->data->items[0]->ep_image;
            }
            $staff_info = [
                'staff_id'          => (int) $detailStaff->data->items[0]->ep_id,
                'staff_avatar'      => $avatar_name,
                'staff_name'        => $detailStaff->data->items[0]->ep_name,
                'com_id'            =>  $detailStaff->data->items[0]->com_id,
                'com_name'          => $detailStaff->data->items[0]->com_name,
                'staff_email'       => $detailStaff->data->items[0]->ep_email,
                'staff_phone'       => $detailStaff->data->items[0]->ep_phone,
                'department_id'     => $detailStaff->data->items[0]->dep_id,
                'department_name'   => $detailStaff->data->items[0]->dep_name,
                'position_id'       => $detailStaff->data->items[0]->position_id,
                // 'position_name'     => $position_name,
                'address'           => $detailStaff->data->items[0]->ep_address,
                // 'education'         => $staff->education,
                'marriage'          => $detailStaff->data->items[0]->ep_married,
                // 'work_experience'   => $staff->work_experience,
                // 'date_start_work'   => $staff->date_start_work,
                'gio_tinh'          => $detailStaff->data->items[0]->ep_gender,
                'birthday'          => $detailStaff->data->items[0]->ep_birth_day,
            ];
            success('Thông tin nhân viên', $staff_info);
        }
    }
    public function getDepartmentPositionList()
    {
        $com_id     = $this->input->post('com_id');
        $secretKey = $this->secretKey;
        $time      = time();

        if ($com_id == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $department_list = $this->Api_staff_model->getDepartmentList($com_id);
            $department_arr  = [];

            foreach ($department_list as $department) {
                array_push($department_arr, [
                    'id_department'   => (int) $department->id_department,
                    'name_department' => $department->name_department,
                ]);
            }

            $position_list = $this->Api_staff_model->getPositionList($com_id);
            $position_arr  = [];
            foreach ($position_list as $position) {
                array_push($position_arr, [
                    'id_position'   => (int) $position->id_position,
                    'name_position' => $position->name_position,
                ]);
            }
            $data = [
                'department_list' => $department_arr,
                'position_list'   => $position_arr,
            ];

            success('Danh sách phòng ban', $data);
        }
    }
    public function getCompanyList()
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
                $com_id       = $decodeToken->com_id;
                $company_list = $this->Api_staff_model->getCompanyList($com_id);

                $data = [];
                foreach ($company_list as $company) {
                    array_push($data, [
                        'com_id'   => (int) $company->com_id,
                        'com_name' => $company->com_name,
                    ]);
                }
                success('Danh sách công ty', $data);
            }
        }
    }
    public function showStaffHome()
    {
        $token     = $this->input->post('token');
        $secretKey = $this->secretKey;
        $time      = time();
        $date      = strtotime(date('d-m-Y'));
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $staff_id = $decodeToken->data->id;
                $data = [
                    'staff_id' => $staff_id,
                    'date' => $date,
                    'time_in' => '',
                    'time_out' => '',
                ];
                $job_list = $this->Api_staff_model->getListJobToday($data);
                $a = 0;
                $b = 0;
                $c = 0;
                $d = 0;
                // $count_job = $this->Api_staff_model->count_job($staff_id);
                foreach ($job_list as $value) {
                    if ($value['status'] == 1) {
                        $a++;
                    } else if ($value['status'] == 2) {
                        $b++;
                    } else if ($value['status'] == 3) {
                        $c++;
                    } else {
                        $d++;
                    }
                }
                $arr = [
                    'count_job_list' => count($job_list),
                    'da_huy' => $a,
                    'da_lam' => $b,
                    'dang_lam' => $c,
                    'du_kien' => $d,
                ];
                success('Công việc', $arr);
            }
        }
    }
    public function completeScheduleHistoryList()
    {
        $token     = $this->input->post('token');
        $date_start     = $this->input->post('date_start');
        $date_end    = $this->input->post('date_end');
        $secretKey = $this->secretKey;
        $time      = time();
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id   = $decodeToken->data->id;
                $date_start = strtotime($date_start);
                $date_end = strtotime($date_end);
                if ($date_end == "") {
                    $date_end = $date_start;
                }
                $data = [
                    'staff_id' => $id,
                    'status'   => 2,
                    'date_start' => $date_start,
                    'date_end'   => $date_end,
                ];
                $schedule_list = $this->Api_staff_model->getScheduleHistoryList($data)->result();

                $schedule_arr = [];
                foreach ($schedule_list as $schedule) {
                    array_push($schedule_arr, [
                        'id' => $schedule->schedule_id,
                        'name' => $schedule->name,
                        'note' => $schedule->note,
                        'date_start' => date('d-m-Y', $schedule->date_start),
                        'date_end' => date('d-m-Y', $schedule->date_end),
                    ]);
                }
                success('Danh sách lịch trình hoàn thành', $schedule_arr);
            }
        }
    }
    public function cancelScheduleHistoryList()
    {
        $token     = $this->input->post('token');
        $date_start     = $this->input->post('date_start');
        $date_end    = $this->input->post('date_end');
        $secretKey = $this->secretKey;
        $time      = time();

        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id   = $decodeToken->data->id;
                $date_start = strtotime($date_start);
                $date_end = strtotime($date_end);
                if ($date_end == "") {
                    $date_end = $date_start;
                }
                $data = [
                    'staff_id' => $id,
                    'status'   => 1,
                    'date_start' => $date_start,
                    'date_end'   => $date_end,
                ];
                $schedule_list = $this->Api_staff_model->getScheduleHistoryList($data)->result();
                $schedule_arr  = [];
                foreach ($schedule_list as $schedule) {
                    array_push($schedule_arr, [
                        'id' => $schedule->schedule_id,
                        'name' => $schedule->name,
                        'note' => $schedule->note,
                        'date_start' => date('d-m-Y', $schedule->date_start),
                        'date_end' => date('d-m-Y', $schedule->date_end),
                    ]);
                }
                success('Danh sách lịch trình đã hủy', $schedule_arr);
            }
        }
    }
    public function getScheduleToday()
    {
        $token          = $this->input->post('token');
        $date_start     = $this->input->post('date_start');
        $date_end       = $this->input->post('date_end');
        $secretKey      = $this->secretKey;
        $time           = time();

        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {

            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = $decodeToken->data->id;
                $date_start = strtotime($date_start);
                $date_end   = strtotime($date_end);
                if ($date_end == 0 || $date_end == "") {
                    $date_end = $date_start;
                }
                $data = [
                    'staff_id' => $id,
                    'today'    => strtotime(date('d-m-Y', time())),
                ];
                $schedule_list = $this->Api_staff_model->getScheduleToday($data, $date_start, $date_end);
                // var_dump(date('d-m-Y',1629910800));
                $schedule_arr  = [];
                $dahuy = [];
                $dalam = [];
                $danglam = [];
                $dukien = [];
                foreach ($schedule_list as $schedule) {
                    //1: đã hủy
                    //2: đã làm
                    //3: đang làm
                    //còn lại: chưa làm
                    if ($schedule->status == 1) {
                        // $dahuy[] = $value;
                        if ($schedule->date_start) {
                            # code...
                        }
                        array_push($dahuy, [
                            'id' => $schedule->schedule_id,
                            'name' => $schedule->name,
                            'note' => $schedule->note,
                            'date_start' => $schedule->date_start,
                            'date_end' => $schedule->date_end,
                        ]);
                    }
                    if ($schedule->status == 2) {
                        // $dalam[] = $value;
                        array_push($dalam, [
                            'id' => $schedule->schedule_id,
                            'name' => $schedule->name,
                            'note' => $schedule->note,
                            'date_start' => $schedule->date_start,
                            'date_end' => $schedule->date_end,
                        ]);
                    }
                    if ($schedule->status == 3) {
                        // $danglam[] = $value;/
                        array_push($danglam, [
                            'id' => $schedule->schedule_id,
                            'name' => $schedule->name,
                            'note' => $schedule->note,
                            'date_start' => $schedule->date_start,
                            'date_end' => $schedule->date_end,
                        ]);
                    }
                    if ($schedule->status == 4) {
                        // $dukien[] = $value;
                        array_push($dukien, [
                            'id' => $schedule->schedule_id,
                            'name' => $schedule->name,
                            'note' => $schedule->note,
                            'date_start' => $schedule->date_start,
                            'date_end' => $schedule->date_end,
                        ]);
                    }
                }
                $schedule_arr['dahuy'] = $dahuy;
                $schedule_arr['dalam'] = $dalam;
                $schedule_arr['danglam'] = $danglam;
                $schedule_arr['dukien'] = $dukien;
                success('Danh sách lịch trình hôm nay', $schedule_arr);
            }
        }
    }
    public function searchSchedule()
    {
        $token     = $this->input->post('token');
        $name      = $this->input->post('name');
        $date_start      = $this->input->post('date_start');
        $date_end     = $this->input->post('date_end');
        $secretKey = $this->secretKey;
        $time      = time();
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id   = $decodeToken->data->id;
                $date_start = strtotime($date_start);
                $date_end = strtotime($date_end);
                $data = [
                    'staff_id'     => $id,
                    'name'         => $name,
                    'date_start'   => $date_start,
                    'date_end'     => $date_end,
                ];
                $schedule_list = $this->Api_staff_model->searchSchedule($data);
                // var_dump($schedule_list);
                // die();
                $schedule_arr  = [];
                foreach ($schedule_list as $schedule) {
                    array_push($schedule_arr, [
                        'id' => $schedule->schedule_id,
                        'name'   => $schedule->name,
                        'note'   => $schedule->note,
                        'date_start'   => date('d-m-Y', $schedule->date_start),
                        'date_end'   => date('d-m-Y', $schedule->date_end),
                        'status' => $schedule->status,
                    ]);
                }
                success('Danh sách lịch trình tìm kiếm', $schedule_arr);
            }
        }
    }
    //https://chamcong.24hpay.vn/upload/employee/
    public function getListJobToday()
    {
        $token     = $this->input->post('token');
        $time = time();
        $date      = $this->input->post('today');
        $secretKey = $this->secretKey;
        if ($token == "" || $date == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id   = $decodeToken->data->id;
                $data = [
                    'staff_id' => $id,
                    'date' => strtotime($date),
                    'time_in' => '',
                    'time_out' => '',
                ];
                $job_list = $this->Api_staff_model->getListJobToday($data);
                $job_arr = [];
                foreach ($job_list as $value) {
                    $getListParticipant = $this->Api_staff_model->getListParticipant($value['job_id']);
                    $participant_arr = [];
                    foreach ($getListParticipant as $value2) {
                        $arr_ep = $this->detailEmploye($token, $value2['staff_id']);
                        $avatar_name = '';
                        $name_staff = '';
                        if (count($arr_ep->data->items) > 0) {
                            if ($arr_ep->data->items[0]->ep_image == null) {
                                $avatar_name = base_url() . "/images_staff/avatar_default.png";
                            } else {
                                $avatar_name = 'https://chamcong.24hpay.vn/upload/employee/' . $arr_ep->data->items[0]->ep_image;
                            }
                            $name_staff = $arr_ep->data->items[0]->ep_name;
                        }
                        $participant_arr[] = [
                            'Participant_id' => $value2['Participant_id'],
                            'job_id' => $value2['job_id'],
                            'staff_id' => $value2['staff_id'],
                            'status' => $value2['status'],
                            // 'name_staff' => $value2['name_staff'],
                            'avatar' => $avatar_name,
                        ];
                    }
                    $city = $this->Api_staff_model->getCityById($value['job_city']);
                    $arr_city = [];
                    $arr_city['id'] = $city['cit_id'];
                    $arr_city['name'] = $city['cit_name'];
                    $district = $this->Api_staff_model->getDistrictById($value['job_district']);
                    $arr_diss = [];
                    $arr_diss['id'] = $district['cit_id'];
                    $arr_diss['name'] = $district['cit_name'];
                    $job_arr[] = [
                        'job_id' => $value['job_id'],
                        'staff_id' => $value['staff_id'],
                        'job_name' => $value['job_name'],
                        'job_staff_admin_id' => $value['job_staff_admin_id'],
                        'job_day_start' => date("d-m-Y", $value['job_day_start']),
                        'job_day_end' => date("d-m-Y", $value['job_day_end']),
                        'job_time_in' => date("H:i:s", $value['job_time_in']),
                        'job_time_out' => date("H:i:s", $value['job_time_out']),
                        'job_address' => $value['job_address'],
                        'status' => $value['status'],
                        'job_city' => $arr_city,
                        'job_district' => $arr_diss,
                        'participant' => $participant_arr,
                    ];
                }

                success('Danh sách công việc ngày hôm nay', $job_arr);
            }
        }
    }

    public function getDetailJobToday()
    {
        $token     = $this->input->post('token');
        $job_id     = $this->input->post('job_id');
        $time = time();
        $secretKey = $this->secretKey;
        if ($token == "" || $job_id == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id   = $decodeToken->data->id;
                $data = [
                    'staff_id' => $id,
                    'job_id' => $job_id,
                ];
                $schedule_list = $this->Api_staff_model->getDetailJobToday($data);
                if (count($schedule_list) == 0) {
                    set_error(404, 'Danh sách trống');
                } else {
                    $participant_list = $this->Api_staff_model->getListParticipant($job_id);
                    $participant_arr = [];
                    $avatar_name = '';
                    foreach ($participant_list as $value) {
                        $arr_ep = $this->detailEmploye($token, $value['staff_id']);
                        $avatar_name = '';
                        $name_staff = '';
                        if (count($arr_ep->data->items) > 0) {
                            if ($arr_ep->data->items[0]->ep_image == null) {
                                $avatar_name = base_url() . "/images_staff/avatar_default.png";
                            } else {
                                $avatar_name = 'https://chamcong.24hpay.vn/upload/employee/' . $arr_ep->data->items[0]->ep_image;
                            }
                            $name_staff = $arr_ep->data->items[0]->ep_name;
                        }
                        $participant_arr[] = [
                            'Participant_id' => $value['Participant_id'],
                            'job_id' => $value['job_id'],
                            'staff_id' => $value['staff_id'],
                            'status' => $value['status'],
                            'name_staff' => $name_staff,
                            'avatar' => $avatar_name,
                        ];
                    }
                    $content_list = $this->Api_staff_model->getListContentJob($job_id);
                    $arr_content = [];
                    foreach ($content_list as $key => $value) {
                        if ($value->staff_id == $id ) {
                            $arr_content[] = [
                                "id_content"=> $value->id_content,
                                "staff_id"=>  $value->staff_id,
                                "content_staff_id"=> $value->content_staff_id,
                                "status"=> $value->status,
                                "content"=> $value->content,
                            ];
                        }
                    }
                    foreach ($schedule_list as $value) {
                        $city = $this->Api_staff_model->getCityById($value->job_city);
                        $arr_city = [];
                        $arr_city['id'] = $city['cit_id'];
                        $arr_city['name'] = $city['cit_name'];
                        $district = $this->Api_staff_model->getDistrictById($value->job_district);
                        $arr_diss = [];
                        $arr_diss['id'] = $district['cit_id'];
                        $arr_diss['name'] = $district['cit_name'];
                        $note = '';
                        if ($value->note != "") {
                            $note = $value->note;
                        }
                        $detail_company = $this->detail_company( $value->job_staff_admin_id);
                        $schedule_arr = [
                            'job_id' => $value->job_id,
                            'job_name' => $value->job_name,
                            'job_staff_admin_id' =>$detail_company->data->detail_company->com_name,
                            'job_day_start' => $value->job_day_start,
                            'job_day_end' => $value->job_day_end,
                            'job_time_in' => $value->job_time_in,
                            'job_time_out' => $value->job_time_out,
                            'job_address' => $value->job_address,
                            'job_city' => $arr_city,
                            'job_district' => $arr_diss,
                            'job_deadline' => $value->job_deadline,
                            'note' => $note,
                            'participant' => $participant_arr,
                            'content_list' => $arr_content,
                        ];
                    }
                    success('Chi tiết công việc ngày hôm nay', $schedule_arr);
                }
            }
        }
    }

    public function getCity()
    {
        $list = $this->Api_staff_model->getCity();
        $arr_city = [];
        foreach ($list as $value) {
            $arr_city[] = $value;
        }
        success('Danh sách tỉnh thành', $arr_city);
    }

    public function getDistrict()
    {
        $cit_id = $this->input->post('cit_id');
        if ($cit_id == "") {
            set_error(404, 'Danh sách trống');
        } else {
            $arr_dis = [];
            $list = $this->Api_staff_model->getDistrict($cit_id);

            // var_dump($list);
            foreach ($list as $value) {
                $arr_dis[] = $value;
            }
            success('Danh sách quận huyện', $arr_dis);
        }
    }

    public function detailScheduleHistoryStaff()
    {
        $token          = $this->input->post('token');
        $schedule_id          = $this->input->post('schedule_id');
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
                $staff_id = $decodeToken->data->id;
                // echo $staff_id;
                // die();
                $schedulePlace = $this->Api_staff_model->detailSchedulePlace($schedule_id, $staff_id);
                // var_dump($schedulePlace);
                // die();
                $a = [];
                $data_sch = [];
                foreach ($schedulePlace as $value) {
                    $listLatLong = $this->Api_staff_model->detailScheduleLatLong($value->id_lat_long);
                    foreach ($listLatLong as $valuell) {
                        $data_sch[] = [
                            'id_place' => $value->id,
                            'place' => $valuell->place,
                            'lat' => $valuell->lat,
                            'long' => $valuell->long,
                            'status' => $value->status,
                        ];
                    }
                }

                $list = $this->Api_staff_model->detailScheduleHistoryStaff($schedule_id, $staff_id);
                // var_dump($list);
                // die();
                foreach ($list as $value1) {
                    if ($value1->status == 1) {
                        $a = 'Đã hủy';
                    } else if ($value1->status == 2) {
                        $a = 'Đã làm';
                    } else if ($value1->status == 3) {
                        $a = 'Đang làm';
                    } else {
                        $a = 'Dự kiến';
                    }

                    $data_arr['schedule_id']   = $value1->schedule_id;
                    $data_arr['name']   = $value1->name;
                    $data_arr['status']   = $value1->status;
                    $data_arr['note']   = $value1->note;
                    $data_arr['staff_id']   = $value1->staff_id;
                    $data_arr['data_sch']   = $data_sch;
                }

                success('Chi tiết lịch sử lịch trình', $data_arr);
            }
        }
    }

    public function updateStatusSchedule()
    {
        $token          = $this->input->post('token');
        // $schedule_id          = $this->input->post('schedule_id');
        $id_place          = $this->input->post('id_place');
        $status          = $this->input->post('status');
        $secretKey      = $this->secretKey;
        $time           = time();
        if ($token == "" || $id_place == "" || $status == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $staff_id = $decodeToken->data->id;
                $id = [
                    'id' => $id_place,
                ];
                if ($status == 2) {
                    $data = [
                        'status' => 1,
                    ];
                } else {
                    $data = [
                        'status' => 2,
                    ];
                }

                $detail_schedule = $this->Api_staff_model->detailSchedulePlaceById($id_place);
                $noti = "vừa cập nhật điểm đến trong lịch trình";
                $data_notify = [
                    'staff' => $staff_id,
                    'notify_to_company' => $decodeToken->data->com_id,
                    'note' => $noti,
                    'date' => time(),
                    'status' => 2,
                    'job_schedule' => $detail_schedule['schedule_id'],
                    'type' => 2,
                    'image_notify' => 5,
                ];

                $add_notify = $this->Api_staff_model->create_notify($data_notify);
                $this->Api_staff_model->updateStatusSchedule($data, $id);
                success('Cập nhật điểm đến thành công', []);
            }
        }
    }

    public function scheduleHistoryStaff()
    {
        // echo date('d-m-Y',1627059600);
        // echo '---------';
        // echo date('d-m-Y',1627664400);
        // die();
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
                $dahuy = [];
                $dalam = [];
                $danglam = [];
                $dukien = [];
                $staff_id = $decodeToken->data->id;
                for ($i = 1; $i < 5; $i++) {
                    $list = $this->Api_staff_model->scheduleHistoryStaff($i, $staff_id);
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

    public function updateJobContentStaff()
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
                $detail = $this->Api_staff_model->detailJobContent($id_content);
                $noti = "vừa cập nhật trạng thái công việc";
                $data_notify = [
                    'staff' => $decodeToken->data->id,
                    'notify_to_company' => $decodeToken->data->com_id,
                    'note' => $noti,
                    'date' => time(),
                    'status' => 2,
                    'job_schedule' => $detail['job_id'],
                    'type' => 1,
                    'image_notify' => 4,
                ];
                $this->Api_staff_model->create_notify($data_notify);
                $this->Api_staff_model->updateJobContentStaff($id, $data);
                $detail = $this->Api_staff_model->detailJobContent($id_content);
                $list = $this->Api_staff_model->getListContentJob($detail['job_id']);
                $dem = 0;
                foreach ($list as $key => $value) {
                    if ($value->status == 1) {
                        $dem++;
                    }
                }
                if (count($list) == $dem ) {
                    $data_job = [
                        'status' => 2,
                    ];
                    $data_id = [
                        'job_id' => $detail['job_id'],
                    ];
                    $this->Api_staff_model->updatejob($data_job,$data_id);
                }
                success('Cập nhật trạng thái thành công', []);
            }
        }
    }

    public function getListJob()
    {
        $token     = $this->input->post('token');
        $time_in = $this->input->post('time_in');
        $time_out = $this->input->post('time_out');
        $time = time();
        // $date = strtotime(date('d-m-Y'));
        $secretKey = $this->secretKey;
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id   = $decodeToken->data->id;
                $data = [
                    'staff_id' => $id,
                    'date' => 0,
                    'time_in' => $time_in,
                    'time_out' => $time_out
                ];
                $job_list = $this->Api_staff_model->getListJobToday($data);
                $dahuy = [];
                $dalam = [];
                $danglam = [];
                $dukien = [];
                foreach ($job_list as $value) {
                    if ($value['status'] == 1) {
                        $participant_arr = [];
                        $a = $this->Api_staff_model->getListParticipant($value['job_id']);

                        foreach ($a as $value2) {
                            $arr_ep = $this->detailEmploye($token, $value2['staff_id']);
                            $avatar_name = '';
                            $name_staff = '';
                            if (count($arr_ep->data->items) > 0) {
                                if ($arr_ep->data->items[0]->ep_image == null) {
                                    $avatar_name = base_url() . "/images_staff/avatar_default.png";
                                } else {
                                    $avatar_name = 'https://chamcong.24hpay.vn/upload/employee/' . $arr_ep->data->items[0]->ep_image;
                                }
                                $name_staff = $arr_ep->data->items[0]->ep_name;
                            }
                            $participant_arr[] = [
                                'Participant_id' => $value2['Participant_id'],
                                'job_id' => $value2['job_id'],
                                'staff_id' => $value2['staff_id'],
                                'status' => $value2['status'],
                                'name_staff' => $name_staff,
                                'avatar' => $avatar_name,
                            ];
                        }
                        $content_list = $this->Api_staff_model->getListContentJob($value['job_id']);

                        $city = $this->Api_staff_model->getCityById($value['job_city']);
                        $arr_city = [];
                        $arr_city['id'] = $city['cit_id'];
                        $arr_city['name'] = $city['cit_name'];
                        $district = $this->Api_staff_model->getDistrictById($value['job_district']);
                        $arr_diss = [];
                        $arr_diss['id'] = $district['cit_id'];
                        $arr_diss['name'] = $district['cit_name'];
                        $dahuy[] = [
                            'job_id' => $value['job_id'],
                            'job_name' => $value['job_name'],
                            'job_staff_admin_id' => $value['job_staff_admin_id'],
                            'job_day_start' => date("d-m-Y", $value['job_day_start']),
                            'job_day_end' => date("d-m-Y", $value['job_day_end']),
                            'job_address' => $value['job_address'],
                            'job_city' => $arr_city,
                            'job_district' => $arr_diss,
                            'participant' => $participant_arr,
                            'content_list' => $content_list,
                        ];
                    }
                    if ($value['status'] == 2) {
                        $participant_arr = [];
                        $a = $this->Api_staff_model->getListParticipant($value['job_id']);
                        foreach ($a as $value2) {
                            $arr_ep = $this->detailEmploye($token, $value2['staff_id']);
                            $avatar_name = '';
                            $name_staff = '';
                            if (count($arr_ep->data->items) > 0) {
                                if ($arr_ep->data->items[0]->ep_image == null) {
                                    $avatar_name = base_url() . "/images_staff/avatar_default.png";
                                } else {
                                    $avatar_name = 'https://chamcong.24hpay.vn/upload/employee/' . $arr_ep->data->items[0]->ep_image;
                                }
                                $name_staff = $arr_ep->data->items[0]->ep_name;
                            }
                            $participant_arr[] = [
                                'Participant_id' => $value2['Participant_id'],
                                'job_id' => $value2['job_id'],
                                'staff_id' => $value2['staff_id'],
                                'status' => $value2['status'],
                                'name_staff' => $name_staff,
                                'avatar' => $avatar_name,
                            ];
                        }
                        $content_list = $this->Api_staff_model->getListContentJob($value['job_id']);
                        $city = $this->Api_staff_model->getCityById($value['job_city']);
                        $arr_city = [];
                        $arr_city['id'] = $city['cit_id'];
                        $arr_city['name'] = $city['cit_name'];
                        $district = $this->Api_staff_model->getDistrictById($value['job_district']);
                        $arr_diss = [];
                        $arr_diss['id'] = $district['cit_id'];
                        $arr_diss['name'] = $district['cit_name'];
                        $dalam[] = [
                            'job_id' => $value['job_id'],
                            'job_name' => $value['job_name'],
                            'job_staff_admin_id' => $value['job_staff_admin_id'],
                            'job_day_start' => date("d-m-Y", $value['job_day_start']),
                            'job_day_end' => date("d-m-Y", $value['job_day_end']),
                            'job_address' => $value['job_address'],
                            'job_city' => $arr_city,
                            'job_district' => $arr_diss,
                            'participant' => $participant_arr,
                            'content_list' => $content_list,
                        ];
                    }
                    if ($value['status'] == 3) {
                        $participant_arr = [];
                        $a = $this->Api_staff_model->getListParticipant($value['job_id']);
                        foreach ($a as $value2) {
                            $arr_ep = $this->detailEmploye($token, $value2['staff_id']);
                            $avatar_name = '';
                            $name_staff = '';
                            if (count($arr_ep->data->items) > 0) {
                                if ($arr_ep->data->items[0]->ep_image == null) {
                                    $avatar_name = base_url() . "/images_staff/avatar_default.png";
                                } else {
                                    $avatar_name = 'https://chamcong.24hpay.vn/upload/employee/' . $arr_ep->data->items[0]->ep_image;
                                }
                                $name_staff = $arr_ep->data->items[0]->ep_name;
                            }
                            $participant_arr[] = [
                                'Participant_id' => $value2['Participant_id'],
                                'job_id' => $value2['job_id'],
                                'staff_id' => $value2['staff_id'],
                                'status' => $value2['status'],
                                'name_staff' => $name_staff,
                                'avatar' => $avatar_name,
                            ];
                        }
                        $content_list = $this->Api_staff_model->getListContentJob($value['job_id']);
                        $city = $this->Api_staff_model->getCityById($value['job_city']);
                        $arr_city = [];
                        $arr_city['id'] = $city['cit_id'];
                        $arr_city['name'] = $city['cit_name'];
                        $district = $this->Api_staff_model->getDistrictById($value['job_district']);
                        $arr_diss = [];
                        $arr_diss['id'] = $district['cit_id'];
                        $arr_diss['name'] = $district['cit_name'];
                        $danglam[] = [
                            'job_id' => $value['job_id'],
                            'job_name' => $value['job_name'],
                            'job_staff_admin_id' => $value['job_staff_admin_id'],
                            'job_day_start' => date("d-m-Y", $value['job_day_start']),
                            'job_day_end' => date("d-m-Y", $value['job_day_end']),
                            'job_address' => $value['job_address'],
                            'job_city' => $arr_city,
                            'job_district' => $arr_diss,
                            'participant' => $participant_arr,
                            'content_list' => $content_list,
                        ];
                    }
                    if ($value['status'] == 4) {
                        $participant_arr = [];
                        $a = $this->Api_staff_model->getListParticipant($value['job_id']);
                        foreach ($a as $value2) {
                            $arr_ep = $this->detailEmploye($token, $value2['staff_id']);
                            $avatar_name = '';
                            $name_staff = '';
                            if (count($arr_ep->data->items) > 0) {
                                if ($arr_ep->data->items[0]->ep_image == null) {
                                    $avatar_name = base_url() . "/images_staff/avatar_default.png";
                                } else {
                                    $avatar_name = 'https://chamcong.24hpay.vn/upload/employee/' . $arr_ep->data->items[0]->ep_image;
                                }
                                $name_staff = $arr_ep->data->items[0]->ep_name;
                            }
                            $participant_arr[] = [
                                'Participant_id' => $value2['Participant_id'],
                                'job_id' => $value2['job_id'],
                                'staff_id' => $value2['staff_id'],
                                'status' => $value2['status'],
                                'name_staff' => $name_staff,
                                'avatar' => $avatar_name,
                            ];
                        }
                        $content_list = $this->Api_staff_model->getListContentJob($value['job_id']);
                        $city = $this->Api_staff_model->getCityById($value['job_city']);
                        $arr_city = [];
                        $arr_city['id'] = $city['cit_id'];
                        $arr_city['name'] = $city['cit_name'];
                        $district = $this->Api_staff_model->getDistrictById($value['job_district']);
                        $arr_diss = [];
                        $arr_diss['id'] = $district['cit_id'];
                        $arr_diss['name'] = $district['cit_name'];
                        $dukien[] = [
                            'job_id' => $value['job_id'],
                            'job_name' => $value['job_name'],
                            'job_staff_admin_id' => $value['job_staff_admin_id'],
                            'job_day_start' => date("d-m-Y", $value['job_day_start']),
                            'job_day_end' => date("d-m-Y", $value['job_day_end']),
                            'job_address' => $value['job_address'],
                            'job_city' => $arr_city,
                            'job_district' => $arr_diss,
                            'participant' => $participant_arr,
                            'content_list' => $content_list,
                        ];
                    }
                }
                $job_arr = [
                    'dahuy' => $dahuy,
                    'dalam' => $dalam,
                    'danglam' => $danglam,
                    'dukien' => $dukien,
                ];
                success('Danh sách công việc', $job_arr);
            }
        }
    }

    public function evaluate()
    {
        $token               = $this->input->post('token');
        $star                = $this->input->post('star');
        $detail_evaluate     = $this->input->post('detail_evaluate');
        $time = time();
        // $date = strtotime(date('d-m-Y'));
        $secretKey = $this->secretKey;
        if ($token == "" || $star == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                // $id   = $decodeToken->data->id;
                $id = 0;
                $id_small = 0;
                $staff = 0;
                if ($decodeToken->data->role == 3) {
                    $staff   = $decodeToken->data->id;
                }
                if ($decodeToken->data->role == 2) {
                    $id_small   = $decodeToken->data->id;
                }
                if ($decodeToken->data->role == 1) {
                    $id   = $decodeToken->data->id;
                }
                $data = [
                    'id_com' => $id,
                    'id_com_small' => $id_small,
                    'id_staff' => $staff,
                    'star' => $star,
                    'detail_evaluate' => $detail_evaluate,
                    'created_at' => $time,
                    'updated_at' => $time,
                ];

                $create = $this->Api_staff_model->evaluate($data);
                success('Đánh giá thành công', []);
            }
        }
    }

    public function error()
    {
        $token               = $this->input->post('token');
        $detail_error     = $this->input->post('detail_error');
        $time = time();
        $secretKey = $this->secretKey;
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = 0;
                $id_small = 0;
                $staff = 0;
                if ($decodeToken->data->role == 3) {
                    $staff   = $decodeToken->data->id;
                }
                if ($decodeToken->data->role == 2) {
                    $id_small   = $decodeToken->data->id;
                }
                if ($decodeToken->data->role == 1) {
                    $id   = $decodeToken->data->id;
                }
                // $id   = $decodeToken->data->id;
                $data = [];
                $data_insert = [
                    'com_id' => $id,
                    'id_com_small' => $id_small,
                    'staff_id' => $staff,
                    'content' => $detail_error,
                ];
                $id_error = $this->Api_staff_model->error($data_insert);
                if (isset($_FILES['files'])) {
                    if (!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0) {
                        $filesCount = count($_FILES['files']['name']);
                        for ($i = 0; $i < $filesCount; $i++) {
                            $temp                    = explode(".", $_FILES['files']['name'][$i]);
                            $newfilename             = round(microtime(true)) . md5(rand()) . '.' . end($temp);
                            $_FILES['file']['name']     = $newfilename;
                            $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                            $_FILES['file']['error']     = $_FILES['files']['error'][$i];
                            $_FILES['file']['size']     = $_FILES['files']['size'][$i];

                            $uploadPath = 'images_error/';
                            $config['upload_path'] = $uploadPath;
                            $config['allowed_types'] = 'jpg|jpeg|png|gif';
                            //$config['max_size']    = '100'; 
                            //$config['max_width'] = '1024'; 
                            //$config['max_height'] = '768'; 

                            // Load and initialize upload library 
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);

                            // Upload file to server 
                            if ($this->upload->do_upload('file')) {
                                // Uploaded file data 
                                $link_file = base_url() . $uploadPath . $newfilename;
                                $data_img_error = [
                                    'id_notify_error' => $id_error,
                                    'image' => $link_file,
                                ];
                                $insert_images = $this->Api_staff_model->error_images($data_img_error);
                            } else {
                                set_error(404, 'Tải ảnh thất bại');
                            }
                        }
                    }
                }
                success('Thông báo lỗi thành công', []);
            }
        }
    }

    public function createLatLongStaff()
    {
        $token               = $this->input->post('token');
        $lat_long     = $this->input->post('lat_long');
        $time = time();
        $secretKey = $this->secretKey;
        if ($token == "" || $lat_long == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id   = $decodeToken->data->id;
                $explodell = explode(';', $lat_long);
                foreach ($explodell as $value) {
                    $ll = explode(',', $value);
                    $data = [
                        'id_staff' => $id,
                        'lat' => $ll[0],
                        'long' => $ll[1],
                        'created_at' => strtotime(date('Y-m-d')),
                    ];

                    $update = $this->Api_staff_model->createLatLongStaff($data);
                }
                success('Cập nhật tọa độ thành công', []);
            }
        }
    }
    public function checkCom()
    {
        $id_com          = $this->input->post('id_com');
        if ($id_com == '') {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $list = $this->Api_staff_model->getCompanyById($id_com);

            if (count($list) == 0) {
                set_error(404, 'Mã công ty không tồn tại');
            } else {
                success('Mã công ty tồn tại', []);
            }
        }
    }

    public function checkFaceId()
    {
        $token               = $this->input->post('token');
        $time = time();
        $secretKey = $this->secretKey;
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = $decodeToken->data->id;
                $checkFaceId = $this->Api_staff_model->show_info($id);
                if ($checkFaceId['face_id_img'] == '') {
                    set_error(404, 'Chưa nhân diện khuôn mặt');
                } else {
                    success('Đã nhận diện khuôn mặt', []);
                }
            }
        }
    }

    public function notify()
    {
        $token               = $this->input->post('token');
        $time = time();
        $secretKey = $this->secretKey;
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = $decodeToken->data->id;
                $notify = $this->Api_staff_model->show_noti($id);
                $arr_notiffy = [];
                foreach ($notify as $key => $value) {
                    $arr_notiffy[] = [
                        'id_notify' => $value['id_notify'],
                        'company' => $value['company'],
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
    public function show_time_sheet()
    {
        $token               = $this->input->post('token');
        $date_start               = $this->input->post('date_start');
        $date_end               = $this->input->post('date_end');
        $time = time();
        $secretKey = $this->secretKey;
        if ($token == "") {
            set_error(404, 'Vui lòng nhập đủ các trường');
        } else {
            $decodeToken = JWT::decode($token, $secretKey, ['HS256']);
            if ($decodeToken->exp < $time) {
                set_error(404, 'Token đã hết hạn');
            } else {
                $id = $decodeToken->data->id;
                $show_info = $this->Api_staff_model->show_info($id);
                if ($date_start == '') {
                    // $date_start = "2021-09-02";
                    $date_start = date('Y-m-d', $time);
                }

                if ($date_end == '') {
                    $date_end = $date_start;
                }
                $list_shift             = $this->Api_staff_model->list_shift($show_info['company_id']);

                $show_time_sheet        = $this->Api_staff_model->show_time_sheet($show_info['staff_id'], $date_start, $date_end);
                $arr_sheet = [];

                foreach ($show_time_sheet as $sheets => $sheet) {
                    $index_sheet = $sheet['staff_id'] . '_' . date("d_m_Y", strtotime($sheet['at_time']));
                    $shift = [];
                    $detail_shift             = $this->Api_staff_model->detail_shift($sheet['shift_id']);
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
                        // 'list' => $shift,
                    ];
                }
                success('lịch sử điểm danh', $arr_sheet);
            }
        }
    }
}
