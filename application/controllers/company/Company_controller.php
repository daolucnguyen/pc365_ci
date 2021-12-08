<?php
class Company_controller extends CI_Controller
{

    public function __construct()
    {
        /*call CodeIgniter's default Constructor*/
        parent::__construct();

        /*load database libray manually*/
        $this->load->database();

        /*load Model*/
        $this->load->model('company/Company_model');
        /* session */
        $this->load->library('session');
        /* xóa dấu */
        $this->load->helper('text');
        /*upload ảnh*/
        $this->load->library('upload');

        $this->load->library('Globals');

        $this->load->helper('resize_image');

        // check login_company
        $this->load->helper('func');

        // load Pagination library
        $this->load->library('pagination');

        // load URL helper
        $this->load->helper('url');
    }

    function check_image($path, $filename)
    {
        $sExtension = getExtension($filename);
        //Check image file type extensiton
        $checkImg = true;
        switch ($sExtension) {
            case "gif":
                $checkImg = @imagecreatefromgif($path . $filename);
                break;
            case $sExtension == "jpg" || $sExtension == "jpe" ||  $sExtension == "jpeg":
                $checkImg = @imagecreatefromjpeg($path . $filename);
                break;
            case "png":
                $checkImg = @imagecreatefrompng($path . $filename);
                break;
        }
        if (!$checkImg) {
            delete_file($path, $filename);
            return 0;
        }
        return 1;
    }
    function resize_image($path, $filename, $maxwidth, $maxheight, $quality, $type = "small_", $new_path = "")
    {
        $sExtension = substr($filename, (strrpos($filename, ".") + 1));
        $sExtension = strtolower($sExtension);

        // Get new dimensions
        list($width, $height) = getimagesize($path . $filename);
        if ($width != 0 && $height != 0) {
            if ($maxwidth / $width > $maxheight / $height) $percent = $maxheight / $height;
            else $percent = $maxwidth / $width;
        }

        $new_width    = $width * $percent;
        $new_height    = $height * $percent;

        // Resample
        $image_p = imagecreatetruecolor($new_width, $new_height);
        //check extension file for create
        switch ($sExtension) {
            case "gif":
                $image = imagecreatefromgif($path . $filename);
                break;
            case $sExtension == "jpg" || $sExtension == "jpe" || $sExtension == "jpeg":
                $image = imagecreatefromjpeg($path . $filename);
                break;
            case "png":
                $image = imagecreatefrompng($path . $filename);
                imagealphablending($image_p, false);
                imagesavealpha($image_p, true);
                $transparent = imagecolorallocatealpha($image_p, 255, 255, 255, 127);
                imagefilledrectangle($image_p, 0, 0, $new_width, $new_height, $transparent);
                break;
        }
        //Copy and resize part of an image with resampling
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        // Output

        // check new_path, nếu new_path tồn tại sẽ save ra đó, thay path = new_path
        if ($new_path != "") $path = $new_path;

        switch ($sExtension) {
            case "gif":
                imagegif($image_p, $path . $type . $filename);
                break;
            case $sExtension == "jpg" || $sExtension == "jpe" || $sExtension == "jpeg":
                imagejpeg($image_p, $path . $type . $filename, $quality);
                break;
            case "png":
                imagepng($image_p, $path . $type . $filename);
                break;
        }
        imagedestroy($image_p);
    }
    function croped_image($path, $filename, $width, $height, $new_width, $new_height, $start_width, $start_height, $quality = 100, $type = "s_", $new_path = "", $new_filename = "")
    {

        $percent  = 1;
        $sExtension = substr($filename, (strrpos($filename, ".") + 1));
        $sExtension = strtolower($sExtension);
        $image  = '';
        //echo $sExtension . "<br>";
        //echo $sExtension . "<br>";

        // Resample
        $image_p = imagecreatetruecolor($new_width, $new_height);
        //check extension file for create
        switch ($sExtension) {
            case "gif":
                $image = imagecreatefromgif($path . $filename);
                break;
            case $sExtension == "jpg" || $sExtension == "jpe" || $sExtension == "jpeg":
                $image = imagecreatefromjpeg($path . $filename);
                break;
            case "png":
                $image = imagecreatefrompng($path . $filename);
                break;
        }

        //Copy and resize part of an image with resampling
        imagecopyresampled($image_p, $image, 0, 0, $start_width, $start_height, $new_width, $new_height, $width, $height);
        //imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
        // Output

        // check new_path, nếu new_path tồn tại sẽ save ra đó, thay path = new_path
        if ($new_path != "") $path = $new_path;
        if ($new_filename != '') $filename = $new_filename;
        $new_filename  =  $path . $type . $filename;
        switch ($sExtension) {
            case "gif":
                imagegif($image_p, $new_filename);
                break;
            case $sExtension == "jpg" || $sExtension == "jpe" || $sExtension == "jpeg":
                imagejpeg($image_p, $new_filename, $quality);
                break;
            case "png":
                imagepng($image_p, $new_filename);
                break;
        }
        imagedestroy($image_p);
        return $type . $filename;
    }
    function saveImageFromBase64Type($data_img, $fs_filepath)
    {
        preg_match('/data:([^;]*);base64,(.*)/', trim($data_img), $matches);
        if (!isset($matches[1])) {
            $matches[1] = "image/jpeg";
            $matches[2] = end(explode(',', $data_img));
        }
        $filename = '';
        $data   = '';
        switch (strtolower($matches[1])) {
            case "image/jpeg":
            case "image/jpg":
                $filename  = generate_name("abc.jpg");
                $data   = ($matches[2]);
                break;
            case "image/png":
                $filename = generate_name("abc.png");
                $data   = ($matches[2]);
                break;
            case "image/gif":
                $filename = generate_name("abc.gif");
                $data   = ($matches[2]);
                break;
        }
        if ($filename != '' && $data != '') {
            $array  = array();
            $array["error"] = '';
            $array["name"] = $filename;
            $path_new = $fs_filepath . $filename;
            if (!file_exists(dirname($path_new))) {
                //m_saveLog('log_mobile_image.cfn','Error path gallery : ' . $path_new);
                return 0;
            }
            $data = str_replace(' ', '+', $data);
            $data = base64_decode($data);
            file_put_contents($path_new, $data);
            if (file_exists($path_new)) {
                $array["path"] = str_replace("..", "", $path_new);
            } else {
                $array["error"] = 'error';
            }
            return $array;
            echo $array;
        }
    }
    public function page($num, $segment, $url, $per_page)
    {
        $config = array();
        $config["base_url"] = $url;
        $page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $config["total_rows"] = $num;
        $config["per_page"] = $per_page;
        $config["uri_segment"] = $segment;

        $config['num_links'] = 2;
        $config['use_page_numbers'] = TRUE;
        $config['reuse_query_string'] = TRUE;
        $config['cur_page'] = $page;

        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';

        $config['first_link'] = '<<';
        $config['first_tag_open'] = '<span class="firstlink">';
        $config['first_tag_close'] = '</span>';

        $config['last_link'] = '>>';
        $config['last_tag_open'] = '<span class="lastlink">';
        $config['last_tag_close'] = '</span>';

        $config['next_link'] = '>';
        $config['next_tag_open'] = '<span class="nextlink">';
        $config['next_tag_close'] = '</span>';

        $config['prev_link'] = '<';
        $config['prev_tag_open'] = '<span class="prevlink">';
        $config['prev_tag_close'] = '</span>';

        $config['cur_tag_open'] = '<span class="curlink">';
        $config['cur_tag_close'] = '</span>';

        $config['num_tag_open'] = '<span class="numlink">';
        $config['num_tag_close'] = '</span>';

        $this->pagination->initialize($config);

        if ($page == 0) {
            $page = 1;
        }

        return $page;
    }
    function show_com_small()
    {
        $company_ss = $this->session->userdata('company');
        $response = $this->Company_model->show_company_small($company_ss['id']);
        return $response;
    }
    function show_department($id_com = '')
    {
        $com  = $this->session->userdata('company');
        if (isset($com)) {
            $access_token     = $com['token'];
            $id               = $com['id'];
            if ($id_com != '') {
                $id = $id_com;
            }
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $url = 'https://chamcong.24hpay.vn/service/list_department.php?id_com=' . $id;
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => $header,
            ));
            $resp = curl_exec($curl);
            $list = json_decode($resp);
            curl_close($curl);
            $arr_department = [];
            foreach ($list->data->items as $value) {
                $arr_department[$value->dep_id] = [
                    'dep_id'    => $value->dep_id,
                    'dep_name'  => $value->dep_name,
                ];
            }
            return $arr_department;
        }
    }
    function show_position()
    {
        $com  = $this->session->userdata('company');
        $id = $com['id'];
        $id_small = 0;
        $response = [
            1  => 'SINH VIÊN THỰC TẬP',
            9  => 'NHÂN VIÊN PART TIME',
            2  => 'NHÂN VIÊN THỬ VIỆC',
            3  => 'NHÂN VIÊN CHÍNH THỨC',
            4  => 'TRƯỞNG NHÓM',
            20 => 'NHÓM PHÓ',
            13 => 'TỔ TRƯỞNG',
            12 => 'PHÓ TỔ TRƯỞNG',
            11 => 'TRƯỞNG BAN DỰ ÁN',
            10 => 'PHÓ BAN DỰ ÁN',
            6  => 'TRƯỞNG PHÒNG',
            5  => 'PHÓ TRƯỞNG PHÒNG',
            8  => 'GIÁM ĐỐC',
            7  => 'PHÓ GIÁM ĐỐC',
            16 => 'TỔNG GIÁM ĐỐC',
            14 => 'PHÓ TỔNG GIÁM ĐỐC',
            21 => 'TỔNG GIÁM ĐỐC TẬP ĐOÀN',
            22 => 'PHÓ TỔNG GIÁM ĐỐC TẬP ĐOÀN',
            19 => 'CHỦ TỊCH HỘI ĐỒNG QUẢN TRỊ',
            18 => 'PHÓ CHỦ TỊCH HỘI ĐỒNG QUẢN TRỊ',
            17 => 'THÀNH VIÊN HỘI ĐỒNG QUẢN TRỊ</option>',
        ];
        return $response;
    }
    function show_role()
    {
        $response = [
            1 => 'Admin (Toàn bộ quyền)',
            4 => 'Nhân sự (Quản lý chấm công)',
            3 => 'Nhân viên',
        ];
        return $response;
    }
    public function notify()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $show_noti = $this->Company_model->show_noti($company_ss['id']);
        return $show_noti;
    }
    public function login_company()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('pass');
        if ($email == '' || $password == '') {
            $result = [
                "result" => false,
            ];
        } else {
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
                        'pass'     => $password,
                        'os' 	=> 2,
    				    'from' 	=> 'pc365'
                    )
                )
            );
            $resp = curl_exec($curl);
            $responsive = json_decode($resp);
            if ($responsive->error == null) {
                $token = $responsive->data->access_token;
                $id = $responsive->data->user_info->com_id;
                $email = $responsive->data->user_info->com_email;
                $name = $responsive->data->user_info->com_name;
                $avatar = $responsive->data->user_info->com_logo;
                $phone = $responsive->data->user_info->com_phone;
                $auth = $responsive->data->user_info->com_authentic;
                $address = $responsive->data->user_info->com_address;
                if ($auth == 1) {
                    $session_com = [
                        'token' => $token,
                        'id' => $id,
                        'email' => $email,
                        'name' => $name,
                        'phone' => $phone,
                        'address' => $address,
                        'avatar' => 'https://chamcong.24hpay.vn/upload/company/logo/' . $avatar,
                        'type' => 1,
                    ];
                    $this->session->set_userdata('company', $session_com);
                    $result = [
                        "result" => 1,
                    ];
                } else {
                    $session_email = [
                        'email' => $email,
                    ];
                    $this->session->set_userdata('email', $session_email);
                    $result = [
                        "result" => 2,
                    ];
                }
            } else if ($responsive->error->code == 200) {
                $result = [
                    "result" => 3,
                    "msg" => $responsive->error->message,
                ];
            }
        }
        echo json_encode($result);
    }

    public function infoCompanySmall()
    {
        $ss_com = $this->session->userdata('company_small');

        $com  = $this->Company_model->infor_companySmall($ss_com['id']);
        return $com;
    }

    public function infoCompany()
    {
        $ss_com = $this->session->userdata('company');

        $com  = $this->Company_model->infor_company($ss_com['email']);
        return $com;
    }


    public function showDistrict()
    {
        $cit_id = $this->input->post('cit_id');
        if ($cit_id == '') {
            $result = [
                'result' => false,
                'message' => 'vui lòng nhập đủ các trường',
            ];
        } else {
            $list = $this->Company_model->showDistrict($cit_id);
            $result = [
                'result' => true,
                'message' => $list,
            ];
        }
        echo json_encode($result);
    }

    public function view_sign_up_company()
    {
        $check = checkSession();
        if ($check == 0) {
            $data['session'] = $check;
            $this->load->view('manager/company/dang_ky_cty', $data);
        } else {
            return redirect('/');
        }
    }

    public function sign_up_company()
    {
        $com_email      = $this->input->post('com_email');
        $com_pass       = $this->input->post('com_pass');
        $com_name       = $this->input->post('com_name');
        $com_phone      = $this->input->post('com_phone');
        $com_address    = $this->input->post('com_address');
        if ($com_email != '' && $com_pass != '' && $com_name != '' && $com_phone != '' && $com_address != '') {
            $curl     = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'https://chamcong.24hpay.vn/service/register_company.php',
                    CURLOPT_POST => 1,
                    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL 
                    CURLOPT_POSTFIELDS => array(
                        'email'             => $com_email,
                        'password'          => $com_pass,
                        'company_name'      => $com_name,
                        'company_phone'     => $com_phone,
                        'company_address'   => $com_address,
                    )
                )
            );
            $resp = curl_exec($curl);
            $responsive = json_decode($resp);
            if ($responsive->error != null) {
                $data = [
                    'result' => 1,
                    'message' => $responsive->error->message,
                ];
            } else {
                $responsive_otp = send_otp($com_email, 2);
                $session_email = [
                    'email' => $com_email,
                    'type' => 2,
                    'id' => $responsive->data->id
                ];
                $this->session->set_userdata('email', $session_email);
                $data = [
                    'result' => 2,
                    'message' => 'Đăng ký tài khoản thành công'
                ];
            }
        } else {
            $data = [
                'result' => 3,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        }
        echo json_encode($data);
    }

    public function check_mail()
    {
        $email = $this->input->post('email');
        $qr = $this->Company_model->checkmail($email);
        if (count($qr) == 0) {
            $data = [
                "result" => true,
                "msg" => "Email không trùng",
            ];
        } else {
            $data = [
                "result" => false,
                "msg" => "Email trùng rồi này",
            ];
        }
        echo json_encode($data);
    }
    public function mail_small_com()
    {
        $email = $this->input->post('email');
        $qr = $this->Company_model->mail_small_com($email);

        if ($qr == true) {
            $data = [
                "result" => true,
                "msg" => "Email không trùng",
            ];
        } else {
            $data = [
                "result" => false,
                "msg" => "Email trùng rồi này",
            ];
        }
        echo json_encode($data);
    }
    public function check_name()
    {
        $name = $this->input->post('ten_cty');
        $qr = $this->Company_model->checkname($name);

        if (count($qr) == 0) {
            $data = [
                "result" => true,
                "msg" => "Tên này dùng được",
            ];
        } else {
            $data = [
                "result" => false,
                "msg" => "Tên công ty đã tồn tại",
            ];
        }
        echo json_encode($data);
    }
    public function view_verification_signup()
    {
        $check = checkSession();
        if ($check == 0) {
            $ss = $this->session->userdata('email');
            $data['com_email'] = $ss['email'];
            if ($ss['email'] == '') {
                return redirect('/');
            } else {
                $company = $this->Company_model->show_otp($data);
                $check = checkSession();
                $data['com_id'] = $company['com_id'];
                $data['session'] = $check;
                $this->load->view('manager/company/xac_thuc_dky', $data);
            }
        } else {
            return redirect('/');
        }
    }
    public function verification_signup()
    {
        $otp = $this->input->post('otp');
        $ss = $this->session->userdata('email');
        if ($ss['email'] != '' && $otp != '') {
            $curl     = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'https://chamcong.24hpay.vn/service/verify_otp.php',
                    CURLOPT_POST => 1,
                    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL 
                    CURLOPT_POSTFIELDS => array(
                        'email'        => $ss['email'],
                        'type_user'    => 2,
                        'otp_code'     => $otp,
                    )
                )
            );
            $resp_curl = curl_exec($curl);
            $responsive_otp = json_decode($resp_curl);
            if ($responsive_otp->error == null) {
                $data = [
                    'result' => true,
                ];
            } else {
                $data = [
                    'result' => false,
                ];
            }
        } else {
            $data = [
                'result' => false,
            ];
        }
        echo json_encode($data);
    }
    public function re_otp()
    {
        $arr = $this->session->userdata('email');
        if ($arr['email'] != '') {
            $responsive_otp = send_otp($arr['email'], 2);
            if ($responsive_otp->error == null) {
                $result = [
                    'result' => true,
                ];
            } else {
                $result = [
                    'result' => false,
                ];
            }
        } else {
            $result = [
                'result' => false,
            ];
        }
        echo json_encode($result);
    }
    public function company_getpass()
    {
        $check = checkSession();
        if ($check == 0) {
            $this->_data['session'] = $check;
            $this->_data['title'] = 'Quên mật khẩu công ty';
            $this->_data['style'] = 'nv_out';
            $this->_data['js'] = 'nv_out';
            $this->_data['content'] = 'home/company_getPass';
            $this->load->view('home/main', $this->_data);
        } else {
            return redirect('/');
        }
    }

    public function company_getpass1()
    {
        $email = $this->input->post('email');
        if ($email == "") {
            $result = [
                'status' => false,
            ];
        } else {
            $responsive_otp = send_otp($email, 2);
            if ($responsive_otp->error != null) {
                $result = [
                    'result' => false,
                    'message' => $responsive_otp->error->message,
                ];
            } else {
                $session_email = [
                    'email' => $email,
                    'type' => 2,
                ];
                $this->session->set_userdata('email', $session_email);
                $result = [
                    'status' => true,
                ];
            }
        }
        echo json_encode($result);
    }
    public function company_getpass2()
    {
        $arr = $this->session->userdata('email');
        $otp1 = $this->input->post('otp1');
        $otp2 = $this->input->post('otp2');
        $otp3 = $this->input->post('otp3');
        $otp4 = $this->input->post('otp4');
        $otp5 = $this->input->post('otp5');
        $otp6 = $this->input->post('otp6');
        $otp = "{$otp1}{$otp2}{$otp3}{$otp4}{$otp5}{$otp6}";
        if ($arr['email'] == "") {
            $result = [
                'status' => false,
            ];
        } else {
            $email = $arr['email'];
            $curl     = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'https://chamcong.24hpay.vn/service/forget_pass_company.php',
                    CURLOPT_POST => 1,
                    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL 
                    CURLOPT_POSTFIELDS => array(
                        'email'             => $email,
                        'otp_code'          => $otp,
                    )
                )
            );
            $resp_curl = curl_exec($curl);
            $response_otp = json_decode($resp_curl);
            if ($response_otp->error != null) {
                $result = [
                    'status' => false,
                    'message' => $response_otp->error->message,
                ];
            } else {
                $session_email = [
                    'email' => $email,
                    'otp'   => $otp,
                    'type'  => 2,
                ];
                $this->session->set_userdata('email', $session_email);
                $result = [
                    'status' => true,
                ];
            }
            // $result = [
            //     'result' => true,
            // ];
        }
        echo json_encode($result);
    }
    public function company_getpass3()
    {
        $pass = $this->input->post('pass');
        $arr = $this->session->userdata('email');
        $result = [];
        if ($arr['email'] == '' || $pass == '') {
            $result = [
                'result' => false,
            ];
        } else {
            $curl     = curl_init();
            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'https://chamcong.24hpay.vn/service/forget_pass_company.php',
                    CURLOPT_POST => 1,
                    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL 
                    CURLOPT_POSTFIELDS => array(
                        'email'             => $arr['email'],
                        'otp_code'          => $arr['otp'],
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
                $this->session->sess_destroy();
                $result = [
                    'status' => true,
                ];
            }
        }
        echo json_encode($result);
    }

    public function check_mailler()
    {
        $email = $this->input->post('email');
        if ($email != '') {
            $qr = $this->Company_model->check_mail_nv($email);
            if (count($qr) == 0) {
                $data = [
                    "result" => true,
                    "msg" => "",
                ];
            } else {
                $data = [
                    "result" => false,
                    "msg" => "Email đã tồn tại",
                ];
            }
        } else {
            $data = [
                "result" => false,
                "msg" => "Vui lòng nhập email",
            ];
        }
        echo json_encode($data);
    }
    public function sign_up_complete()
    {

        $check = checkSession();
        $company_ss = $this->session->userdata('email');
        if ($company_ss['email'] != '') {
            $data['session'] = $check;
            $data['show_position'] = $this->show_position();
            $this->load->view('manager/company/dang_ky_cty3', $data);
        } else {
            return redirect('/');
        }
    }

    public function add_second_account()
    {
        $check = checkSession();
        $company_ss = $this->session->userdata('email');
        $email = $this->input->post('email');
        $mat_khau = $this->input->post('mat_khau');
        $ten_ns = $this->input->post('ten_ns');
        $telephone = $this->input->post('telephone');
        $chuc_vu = $this->input->post('chuc_vu');
        $phan_quyen = $this->input->post('phan_quyen');
        $dia_chi = $this->input->post('dia_chi');
        $time = time();
        $result = [];
        if ($email == "" || $ten_ns == "" || $mat_khau == "" || $telephone == "" || $chuc_vu == "" || $phan_quyen == "" || $dia_chi == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $curl = curl_init();
            $data = array(
                'email' => $email,
                'ep_name' => $ten_ns,
                'ep_phone' => $telephone,
                'password' => $mat_khau,
                'ep_address' => $dia_chi,
                'dep_id' => '',
                'com_id' => $company_ss['id'],
                'role' => $phan_quyen,
                'position_id' => $chuc_vu,
                'gioi_tinh' => '',
                'user_birthday' => '',
                'hoc_van' => '',
                'start_time' => '',
                'hon_nhan' => '',
                'n_kinh_nghiem' => '',
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
                    'result' => false,
                    'message' => $response->error->message,
                ];
            } else {
                $this->session->sess_destroy();
                $result = [
                    'result' => true,
                ];
            }
        }
        echo json_encode($result);
    }
    public function del_session()
    {
        $this->session->sess_destroy();
        $result = [
            'result' => true,
        ];
        echo json_encode($result);
    }

    public function curl_list_shift($id_com)
    {
        $access_token = $_SESSION['company']['token'];
        $curl = curl_init();
        $header[]         = 'Authorization: ' . $access_token . '';
        $url = "https://chamcong.24hpay.vn/service/list_shift.php?id_com=$id_com";
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $exec = curl_exec($curl);
        $js_decode = json_decode($exec);
        $arr_shift = [];
        foreach ($js_decode->data->items as $key => $value) {
            $arr_shift[$value->shift_id] = [
                'shift_id' => $value->shift_id,
                'shift_name' => $value->shift_name,
                'start_time' => $value->start_time,
                'end_time' => $value->end_time,
                'start_time_latest' => $value->start_time_latest,
                'end_time_earliest' => $value->end_time_earliest,
            ];
        }
        return $arr_shift;
    }

    public function quan_ly_cty()
    {
        $data['title'] = "Quản lý chung";
        $data['chart_js'] = 'Chart.min.js';
        $data['js'] = 'qly_cty.js';
        $data['content'] = 'manager/company/quan_ly_cty';
        $date = strtotime(date('Y-m-d'));
        $date_start = date('d-m-Y', $date);
        $date_end = date('d-m-Y', $date);
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $company = [
            'com_id' => $company_ss['id'],
            'com_name' => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];


        $count_job = $this->Company_model->countJob($company_ss['id'], '', $date, $date, 0, 0);
        $count_schedule = $this->Company_model->count_schedule($company_ss['id'], $date, $date);
        $count_time_sheet        = $this->Company_model->show_time_sheet($company_ss['id'], '', $date_start, $date_end, '', '');
        $list_shift             = $this->Company_model->list_shift($company_ss['id']);
        $arr_sheet = [];
        foreach ($count_time_sheet as $sheets => $sheet) {
            $index_sheet = $sheet['staff_id'] . '_' . date("d_m_Y", strtotime($sheet['at_time']));
            $shift = [];
            foreach ($list_shift as $value_shifts => $value_shift) {
                $show_sheet_by_id_shift_min = [];
                $show_sheet_by_id_shift_max = [];
                $show_sheet_by_id_shift_min        = $this->Company_model->count_sheet_by_id_shift_min($value_shift['id_shift'], $sheet['staff_id'], $sheet['at_time'], $value_shift['time_in'], $value_shift['time_out']);
                // $show_sheet_by_id_shift_max         = $this->Company_model->count_sheet_by_id_shift_max($value_shift['id_shift'], $sheet['staff_id'], $sheet['at_time'],$value_shift['time_in'],$value_shift['time_out']);

                $shift[$value_shift['id_shift']] = [
                    'in_shift' => $show_sheet_by_id_shift_min['in_shift'],
                    // 'out_shift' => $show_sheet_by_id_shift_max['out_shift'],
                ];
            }
            $arr_sheet[$index_sheet] = [
                'staff_id'      => $sheet['staff_id'],
                'name_staff'    => $sheet['name_staff'],
                'avatar'        => $sheet['avatar'],
                'department'    => $sheet['department'],
                'date'          => date("d-m-Y", strtotime($sheet['at_time'])),
                'list'          => $shift,
            ];
        }
        $count_late = 0;
        foreach ($arr_sheet as $value) {
            foreach ($value['list'] as $value_list) {
                if ($value_list['in_shift'] != '') {
                    $count_late++;
                }
            }
        }

        $date_start = date('Y-m-d', $date);
        $date_end = date('Y-m-d', $date);

        $access_token = $company_ss['token'];
        $header[]         = 'Authorization: ' . $access_token . '';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/get_history_time_keeping_by_company.php?id_com=' . $company_ss['id'] . '&start_date=' . $date_start . '&end_date=' . $date_end;
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $sheet = json_decode($resp);
        $arr_sheet = [];
        $arr_shift = $this->curl_list_shift($company_ss['id']);
        foreach ($sheet->data->items as $value) {
            $arr_sheet[] = $value->ep_id;
        }
        $arr_sheet = array_unique($arr_sheet);
        $data['detail_company'] = $company;
        $data['date'] = $date;
        $data['notify'] = $this->notify();
        $data['count_job'] = count($count_job);
        $data['count_time_sheet'] = count($arr_sheet);
        $data['count_schedule'] = $count_schedule;
        $data['count_late'] = $count_late;
        $this->load->view('manager/company/manager', $data);
    }
    public function curl_list_company()
    {
        $access_token = $_SESSION['company']['token'];
        $curl = curl_init();
        $header[]         = 'Authorization: ' . $access_token . '';
        $url = "https://chamcong.24hpay.vn/service/list_child_of_company.php?is_all=true";
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $exec = curl_exec($curl);
        $js_decode = json_decode($exec);
        return $js_decode->data->items;
    }

    public function curl_history_time_keeping($com_id, $dp = 0, $id = 0, $d1 = 0, $d2 = 0, $start = 0, $rowperpage = 0)
    {
        $access_token = $_SESSION['company']['token'];
        $curl = curl_init();
        $header[]         = 'Authorization: ' . $access_token . '';
        $url = "https://chamcong.24hpay.vn/service/get_history_time_keeping_by_company.php?id_com=" . $com_id . "&id_dep=" . $dp . "&id_ep=" . $id . "&start_date=" . $d1 . "&end_date=" . $d2 . "&off_set=" . $start . '&length=' . $rowperpage;
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $exec = curl_exec($curl);
        $js_decode = json_decode($exec);
        curl_close($curl);
        return $js_decode;
    }
    public function qly_cham_cong()
    {
        checkLogin();
        $company_ss     = $this->session->userdata('company');
        $data['title'] = "Quản lý chấm công";
        $data['chart_js'] = 'Chart.min.js';
        $data['js'] = 'qly_cty.js';
        $data['content'] = 'manager/company/qly_cham_cong';
        $company_ss = $this->session->userdata('company');
        $keyWord = $this->input->get('keyWord');
        $dateStart = $this->input->get('datestart');
        $dateEnd = $this->input->get('dateend');
        $com_id = $this->input->get('cty');
        $department = $this->input->get('phong_ban');


        $arr_sheet = $list_shift = [];

        $company = [
            'com_id' => $company_ss['id'],
            'com_name' => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];

        // Lâm
        $com = $company_ss['id'];
        if (!empty($com_id)) {
            $com = $com_id;
        }
        $list_company           = $this->curl_list_company();
        $segment = 2;
        $per_page = 10;
        $type = $this->uri->segment(2);
        $access_token     = $company_ss['token'];
        $off_set = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        if ($off_set != 0) {
            $off_set                     = ($off_set - 1) * $per_page;
        }
        $d01 = date('Y-m-01');
        $d02 = date('Y-m-d');
        if ($dateEnd != '') {
            $d02 = $dateEnd;
        }
        if ($dateStart != '') {
            $d01 = $dateStart;
        }
        $curl_history_time_keeping = $this->curl_history_time_keeping($com, $department, $keyWord, $d01, $d02, $off_set, $per_page);
        $url =  urlQlyChamCongCty();
        $page = $this->page($curl_history_time_keeping->data->totalItems, $segment, $url, $per_page);
        $data["links"] = $this->pagination->create_links();
        $dateStart = ($dateStart != '') ? $dateStart : $d01;
        $dateEnd = ($dateEnd != '') ? $dateEnd : $d02;

        $curl     = curl_init();
        $header[]         = 'Authorization: ' . $access_token . '';
        $url = 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php?filter_by[active]=true&id_com=' . $com; // 
        if ($department != 0) {
            $url .= '&filter_by[department]=' . $department;
        }
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL quyen_truy_cap
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $staff_active = json_decode($resp);
        curl_close($curl);

        $data['list_company'] = $list_company;
        $data['list_shift'] = $list_shift;
        $data['arr_sheet'] = $curl_history_time_keeping->data->items;
        $data['keyWord'] = $keyWord;
        $data['dateStart'] = $dateStart;
        $data['dateEnd'] = $dateEnd;
        $data['com_id'] = $com_id;
        $data['department'] = $department;
        $data['list_ep'] = $staff_active->data->items;

        $data['show_department'] = $this->show_department();
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/qly_cham_cong', $data);
    }

    public function lich_trinh_nv()
    {
        checkLogin();
        $name       = $this->input->get('keyWord');
        $datestart  = $this->input->get('datestart');
        $dateend    = $this->input->get('dateend');
        $cty        = $this->input->get('cty');
        $phong_ban  = $this->input->get('phong_ban');
        $lich_trinh = $this->input->get('lich_trinh');
        if ($dateend != '') {
            $dateend = strtotime($dateend);
        }
        if ($datestart != '') {
            $datestart = strtotime($datestart);
        }
        $a              = $this->uri->segment(2);
        $company_ss     = $this->session->userdata('company');
        $id_small       = 0;
        $segment        = 2;
        $per_page       = 10;

        $url                            =  urlQlyLichTrinhCty();
        $num                            = $this->Company_model->count_lich_trinh_nv($company_ss['id'], $id_small, $name, $datestart, $dateend, $cty, $phong_ban, $lich_trinh);
        $page                           = $this->page(count($num), $segment, $url, $per_page);
        $data["links"]                  = $this->pagination->create_links();
        $company = [
            'com_id' => $company_ss['id'],
            'com_name' => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];
        $comSmall                       = $this->Company_model->show_company_small($company_ss['id']);
        $data['detail_company']         = $company;
        $data['detail_company_small']   = $this->list_companySmall();
        $data['department']             = $this->show_department();
        $list                           = $this->Company_model->lich_trinh_nv($company_ss['id'], $id_small, $per_page, $per_page * ($page - 1), $name, $datestart, $dateend, $cty, $phong_ban, $lich_trinh);
        $listSchedule                   = $this->Company_model->listSchedule($company_ss['id'], $id_small);

        $access_token = $company_ss['token'];
        $header[]         = 'Authorization: ' . $access_token . '';
        $status = 'true';
        $curl     = curl_init();
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
        $arr_ep = [];
        foreach ($staff_active->data->items as $key => $value) {
            $arr_ep[$value->ep_id] = [
                'ep_id' => $value->ep_id,
                'ep_name' => $value->ep_name,
                'ep_image' => $value->ep_image,
                'dep_name' => $value->dep_name,
            ];
        }
        $data['info_schedule']          = $list;
        $data['arr_ep']                 = $arr_ep;
        $data['listSchedule']           = $listSchedule;
        $data['name']                   = $name;
        $data['datestart']              = $datestart;
        $data['dateend']                = $dateend;
        $data['cty']                    = $cty;
        $data['phong_ban']              = $phong_ban;
        $data['lich_trinh']             = $lich_trinh;
        $data['notify']                 = $this->notify();
        $this->load->view('manager/company/lich_trinh_nv', $data);
    }

    public function export_excel_schedule()
    {
        checkLogin();
        $company_ss     = $this->session->userdata('company');
        $name       = $this->input->get('keyWord');
        $datestart  = $this->input->get('datestart');
        $dateend    = $this->input->get('dateend');
        $cty        = $this->input->get('cty');
        $phong_ban  = $this->input->get('phong_ban');
        $lich_trinh = $this->input->get('lich_trinh');
        $list       = $this->Company_model->count_lich_trinh_nv($company_ss['id'], 0, $name, $datestart, $dateend, $cty, $phong_ban, $lich_trinh);
        $access_token = $company_ss['token'];
        $header[]         = 'Authorization: ' . $access_token . '';
        $status = 'true';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=' . $status;
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $staff_active = json_decode($resp);
        $arr_ep = [];
        foreach ($staff_active->data->items as $key => $value) {
            foreach ($list as $key => $sch) {
                if ($value->ep_id == $sch['staff_id']) {
                    $arr_ep[] = $value;
                }
            }
        }
        $th_array = array(
            'B' => 'Thông tin nhân viên(ID)',
            'C' => 'Tên lịch trình',
            'D' => 'ngày tháng',
            'E' => 'Ghi chú',
        );
        $role = $this->show_role();
        $i = 0;
        foreach ($list as $key => $value) {
            $name = $arr_ep[$i]->ep_id . '(' . $arr_ep[$i]->ep_name . ')';
            $date = date("d-m-Y", $value['date_start']) . '||' . date("d-m-Y", $value['date_end']);
            $tr_array[] = array(
                'B' => $name,
                'C' =>  $value['name'],
                'D' => $date,
                'E' =>  $value['note'],
            );
            $i++;
        }
        $this->globals->my_export('staff_pc365', 'Thống kê nhân viên', $th_array, $tr_array);
    }

    public function sua_lich_trinh()
    {
        checkLogin();
        $id_sch = $this->input->get('sc');
        if (!isset($id_sch) || $id_sch == 0 || $id_sch == '') {
            return redirect('/');
        }
        $id_small = 0;
        $company_ss = $this->session->userdata('company');
        $detail = $this->Company_model->detailSchedule($id_sch);
        $detailSchedulePlace = $this->Company_model->detailSchedulePlace($id_sch);
        $listScheduleStaff = $this->Company_model->listScheduleStaff($id_sch);
        $company = [
            'com_id' => $company_ss['id'],
            'com_name' => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];
        $comSmall = $this->list_companySmall();
        $access_token = $company_ss['token'];
        $header[]         = 'Authorization: ' . $access_token . '';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/list_child_of_company.php?id_com=' . $detail['com_id'];
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $response = json_decode($resp);

        $url = 'https://chamcong.24hpay.vn/service/list_department.php?id_com=' . $detail['com_id'];
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $department = json_decode($resp);

        $getDepartment = $this->Company_model->getDepartment($id_sch);
        $listDepartment = $this->Company_model->listDeparment($detail['com_id'], 0);
        $show_staff_department = [];
        foreach ($getDepartment as $key => $value) {
            $show_staff_department[] = $this->Company_model->show_staff_by_department($value['department'], "");
        }

        $status = 'true';
        $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=' . $status;
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $staff_active = json_decode($resp);
        $arr = [];
        $arr_dep = [];
        foreach ($staff_active->data->items as $key => $value) {
            foreach ($listScheduleStaff as $key => $sch_staff) {
                if ($value->ep_id == $sch_staff['staff_id']) {
                    $arr[] = $value;
                    $arr_dep[] = $value->dep_id;
                }
            }
        }
        $arr_dep = array_unique($arr_dep);
        $arr_staff = [];
        foreach ($staff_active->data->items as $key => $value) {
            foreach ($arr_dep as $key => $dep) {
                if ($value->dep_id == $dep) {
                    $arr_staff[] = $value;
                }
            }
        }

        $data['detail'] = $detail;
        $data['listDepartment'] = $department->data->items;
        $data['listScheduleStaff'] = $listScheduleStaff;
        $data['getDepartment'] = $arr_dep;
        $data['show_staff_department'] = $arr_staff;
        $data['phongban'] = $this->show_department();
        $data['detail_schedulePlace'] = $detailSchedulePlace;
        $data['detail_company_small'] = $comSmall;
        $data['detail_company'] = $company;
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/sua_lich_trinh', $data);
    }

    public function nv_cung_lich()
    {
        checkLogin();
        $scheduleId = $this->input->get('schduleId');
        if (!isset($scheduleId) || $scheduleId == 0 || $scheduleId == '') {
            return redirect(urlQlyLichTrinhCty());
        }
        $company_ss = $this->session->userdata('company');
        $id_small = 0;
        $segment = 2;
        $per_page = 10;

        $url =  urlChiTietLichTrinh();
        $num = $this->Company_model->count_nv_cung_lich($company_ss['id'], $scheduleId);
        $page = $this->page(count($num), $segment, $url, $per_page);
        $data["links"] = $this->pagination->create_links();
        $list = $this->Company_model->nv_cung_lich($company_ss['id'], $per_page, $per_page * ($page - 1), $scheduleId);

        $access_token = $company_ss['token'];
        $header[]         = 'Authorization: ' . $access_token . '';
        $status = 'true';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php?id_com=' . $company_ss['id'];
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $staff_active = json_decode($resp);
        $arr_ep = [];
        foreach ($staff_active->data->items as $key => $value) {
            $arr_ep[$value->ep_id] = [
                'ep_id' => $value->ep_id,
                'ep_name' => $value->ep_name,
                'ep_image' => $value->ep_image,
                'dep_name' => $value->dep_name,
            ];
        }
        $company = [
            'com_id' => $company_ss['id'],
            'com_name' => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];
        $comSmall = $this->Company_model->show_company_small($company_ss['id']);
        $data['detail_company'] = $company;
        $data['arr_ep'] = $arr_ep;
        $data['info_schedule'] = $list;
        $data['department'] = $this->show_department();
        $data['detail_company_small'] = $comSmall;
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/nv_cung_lich', $data);
    }
    public function qly_giao_viec()
    {
        $keyWord = $this->input->get('keyWord');
        $date_start = $this->input->get('datestart');
        $date_end = $this->input->get('dateend');
        $cty = $this->input->get('cty');
        $department = $this->input->get('phong_ban');
        $status = $this->input->get('status');
        $date_start = strtotime($date_start);
        $date_end = strtotime($date_end);
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $company = [
            'com_id' => $company_ss['id'],
            'com_name' => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];
        $id = 0;
        if ($cty != '' && $cty != 0) {
            $id = $cty;
        } else {
            $id = $company_ss['id'];
        }
        // $autoupdate = $this->autoUpdateStatusJob();

        $segment = 2;
        $per_page = 10;
        $url =  urlQlyGiaoViecCty();
        $num = $this->Company_model->countJob($id, $keyWord, $date_start, $date_end, $department, $status);
        $page = $this->page(count($num), $segment, $url, $per_page);
        $data["links"] = $this->pagination->create_links();
        // $company = $this->Company_model->infor_company($company_ss['email']);
        $list = $this->Company_model->showJob($id, $per_page, $per_page * ($page - 1), $keyWord, $date_start, $date_end, $department, $status);

        $access_token = $company_ss['token'];
        $header[]         = 'Authorization: ' . $access_token . '';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php?id_com=' . $id;
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $staff_active = json_decode($resp);
        $showCity = $this->Company_model->show_city();
        $staff_active = $staff_active->data->items;
        $arr_staff = [];
        foreach ($staff_active as $key => $value) {
            $arr_staff[$value->ep_id] = [
                'ep_id' => $value->ep_id,
                'ep_name' => $value->ep_name,
                'ep_image' => $value->ep_image,
            ];
        }
        // echo "<pre>";
        // var_dump($arr_staff);
        // die();
        $showJobPra = [];
        foreach ($list as $value) {
            $showJobPra[$value['job_id']] = $this->Company_model->showJobPraByIdJob($value['job_id']);
        }
        $data['detail_company'] = $company;
        $data['detail_company_small'] = $this->list_companySmall();
        $data['keyWord'] = $keyWord;
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
        $data['department'] = $department;
        $data['status'] = $status;
        $data['listJob'] = $list;
        $data['showCity'] = $showCity;
        $data['showJobPra'] = $showJobPra;
        $data['staff_active'] = $arr_staff;
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/qly_giao_viec', $data);
    }

    public function chitiet_cong_viec()
    {
        checkLogin();
        $jobId = $this->input->get('jobId');
        if (!isset($jobId) || $jobId == 0 || $jobId == '') {
            return redirect(urlQlyGiaoViecCty());
        }
        $company_ss = $this->session->userdata('company');
        $company = [
            'com_id' => $company_ss['id'],
            'com_name' => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];
        $comSmall = $this->list_companySmall();
        $infoJob = $this->Company_model->infoJob($jobId);
        $show_city = $this->Company_model->show_city();
        $listStaffByJob = $this->Company_model->listStaffByJob($jobId);
        $show_job_content = $this->Company_model->show_job_content($jobId);
        $show_staff = $this->Company_model->count_staff($company_ss['id'], '', 0, 0, 0);
        $job_content = $this->Company_model->job_content();
        $getDepartment = $this->Company_model->getDepartmentByJob($jobId);
        $getJobNote = $this->Company_model->getJobNote($jobId);
        $listScheduleStaff = $this->Company_model->listStaffByJob($jobId);



        $access_token = $company_ss['token'];
        $header[]         = 'Authorization: ' . $access_token . '';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/list_department.php?id_com=' . $infoJob['job_com_id'];
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $department = json_decode($resp);

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
        $arr = [];
        $arr_dep = [];
        foreach ($staff_active->data->items as $key => $value) {
            foreach ($listScheduleStaff as $key => $sch_staff) {
                if ($value->ep_id == $sch_staff['staff_id']) {
                    $arr[] = $value;
                    $arr_dep[] = $value->dep_name;
                }
            }
        }
        $arr_dep = array_unique($arr_dep);
        $arr_staff = [];
        foreach ($staff_active->data->items as $key => $value) {
            foreach ($arr as $key => $staff) {
                if ($value->ep_id == $staff->ep_id) {
                    $arr_staff[] = $value;
                }
            }
        }

        $data['job_content'] = $job_content;
        $data['getJobNote'] = $getJobNote;
        $data['infoJob'] = $infoJob;
        $data['show_staff'] = $show_staff;
        $data['listStaffByJob'] = $arr_staff;
        $data['show_job_content'] = $show_job_content;
        $data['department'] = $arr_dep;
        $data['getDepartment'] = $getDepartment;
        $data['show_city'] = $show_city;
        $data['detail_company'] = $company;
        $data['detail_company_small'] = $comSmall;
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/chitiet_cong_viec', $data);
    }

    function updateStatusJob()
    {
        $job_id = $this->input->post('job_id');
        $checked = $this->input->post('checked');
        $noChecked = $this->input->post('noChecked');

        if ($checked == '' && $noChecked == '') {
            $result = [
                'result' => false,
                'message' => "Vui lòng nhập đủ các trường",
            ];
        } else {
            $checked = explode(',', $checked);
            for ($i = 0; $i < count($checked); $i++) {
                $id = [
                    'content_staff_id' => $checked[$i],
                ];
                $data = [
                    'status' => 1,
                ];
                $this->Company_model->update_job_content($data, $id);
            }
            if ($noChecked == '') {
                $id_job = [
                    'job_id' => $job_id,
                ];
                $data_job = [
                    'status' => 2,
                ];
                $this->Company_model->job_participants($data_job, $id_job);
                $this->Company_model->updatejob($data_job, $id_job);
            } else {
                $noChecked = explode(',', $noChecked);
                for ($i = 0; $i < count($noChecked); $i++) {
                    $id = [
                        'content_staff_id' => $noChecked[$i],
                    ];
                    $data = [
                        'status' => 2,
                    ];
                    $this->Company_model->update_job_content($data, $id);
                }
            }

            //
            $list_jobContent = $this->Company_model->job_content_by_jobId($job_id);
            $da_lam = 0;
            foreach ($list_jobContent as $value_status) {
                if ($value_status['status'] == 1) {
                    $da_lam++;
                }
            }
            $arr_dalam = [
                'status' => 2,
            ];
            $arr_id_job = [
                'job_id' => $job_id,
            ];
            if ($da_lam == count($list_jobContent)) {
                $this->Company_model->updatejob($arr_dalam, $arr_id_job);
            }
            $this->autoUpdateStatusJob();
            $result = [
                'result' => true,
                'message' => "Cập nhật trạng thái thành công",
            ];
        }
        echo json_encode($result);
    }
    function deleteJObContent()
    {
        $checked = $this->input->post('checked');
        if ($checked == '') {
            $result = [
                'result' => false,
                'message' => "Vui lòng nhập đủ các trường",
            ];
        } else {
            $checked = explode(',', $checked);
            for ($i = 0; $i < count($checked); $i++) {
                $id = [
                    'content_staff_id' => $checked[$i],
                ];
                $id_content = [
                    'id' => $checked[$i],
                ];
                // $this->Company_model->deleteJobContent($id);
                // $this->Company_model->deleteJobContentStaff($id_content);
            }
            $result = [
                'result' => true,
                'message' => "Xóa việc cần làm thành công",
            ];
        }
        echo json_encode($result);
    }

    public function tao_cong_viec()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');

        $company = [
            'com_id' => $company_ss['id'],
            'com_name' => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];

        $comSmall = $this->list_companySmall();
        $show_city = $this->Company_model->show_city();
        $data['detail_company'] = $company;
        $data['detail_company_small'] = $comSmall;
        $data['show_city'] = $show_city;
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/tao_cong_viec', $data);
    }
    public function sua_cong_viec()
    {
        checkLogin();
        $id_job = $this->input->get('id_job');
        if ($id_job == '' || $id_job == 0) {
            return redirect(urlQlyGiaoViecCty());
        } else {
            $company_ss = $this->session->userdata('company');
            $company = [
                'com_id' => $company_ss['id'],
                'com_name' => $company_ss['name'],
                'com_avatar' => $company_ss['avatar']
            ];

            $comSmall = $this->list_companySmall();
            $listScheduleStaff = $this->Company_model->listStaffByJob($id_job);
            $show_city = $this->Company_model->show_city();
            $infoJob = $this->Company_model->infoJob($id_job);
            $show_city2 = $this->Company_model->showDistrict($infoJob['job_city']);
            $getDepartment = $this->Company_model->getDepartmentByJob($id_job);
            $listDepartment = $this->Company_model->listDeparment($infoJob['job_com_id'], 0);
            $show_staff_department = [];
            foreach ($getDepartment as $key => $value) {
                $show_staff_department[] = $this->Company_model->show_staff_by_department($value['department'], '');
            }

            $access_token = $company_ss['token'];
            $header[]         = 'Authorization: ' . $access_token . '';
            $curl     = curl_init();
            $url = 'https://chamcong.24hpay.vn/service/list_department.php?id_com=' . $infoJob['job_com_id'];
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => $header,
            ));
            $resp = curl_exec($curl);
            $department = json_decode($resp);

            $status = 'true';
            $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=' . $status;
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
            ));
            $resp = curl_exec($curl);
            $staff_active = json_decode($resp);
            $arr = [];
            $arr_dep = [];
            foreach ($staff_active->data->items as $key => $value) {
                foreach ($listScheduleStaff as $key => $sch_staff) {
                    if ($value->ep_id == $sch_staff['staff_id']) {
                        $arr[] = $value;
                        $arr_dep[] = $value->dep_id;
                    }
                }
            }
            $arr_dep = array_unique($arr_dep);
            $arr_staff = [];
            foreach ($staff_active->data->items as $key => $value) {
                foreach ($arr_dep as $key => $dep) {
                    if ($value->dep_id == $dep) {
                        $arr_staff[] = $value;
                    }
                }
            }

            $show_job_content = $this->Company_model->show_job_content($id_job);
            $data['detail_company_small'] = $comSmall;
            $data['listDepartment'] = $department->data->items;
            $data['listScheduleStaff'] = $listScheduleStaff;
            $data['show_staff_department'] = $arr_staff;
            $data['department'] = $arr_dep;
            $data['detail_company'] = $company;
            $data['show_city'] = $show_city;
            $data['show_city2'] = $show_city2;
            $data['show_job_content'] = $show_job_content;
            $data['infoJob'] = $infoJob;
            $data['notify'] = $this->notify();
            $this->load->view('manager/company/sua_cong_viec', $data);
        }
    }
    public function cty_thongtin()
    {
        $com = $this->session->userdata('company');
        if (!$com) {
            return redirect('/');
        } else {
            $data['title'] = 'cập nhật thông tin công ty';
            $detail_company = [
                'com_name' => $com['name'],
                'com_id' => $com['id'],
                'com_email' => $com['email'],
                'com_phone' => $com['phone'],
                'com_address' => $com['address'],
                'com_avatar' => $com['avatar']
            ];
            $data['detail_company'] = $detail_company;
            $data['notify'] = $this->notify();
            $this->load->view('manager/company/cty_thongtin', $data);
        }
    }
    public function cty_update_thongtin()
    {
        $com = $this->session->userdata('company');
        if (!$com) {
            return redirect('/');
        } else {
            $detail_company = [
                'com_name' => $com['name'],
                'com_id' => $com['id'],
                'com_email' => $com['email'],
                'com_phone' => $com['phone'],
                'com_address' => $com['address'],
                'com_avatar' => $com['avatar']
            ];
            $data['detail_company'] = $detail_company;
            $data['notify'] = $this->notify();
            $this->load->view('manager/company/cty_update_thongtin', $data);
        }
    }

    public function curl_update_com($data, $token)
    {
        $header[] = 'Authorization: ' . $token . '';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/update_user_info_company.php';
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL 
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $header,
        ));
        $response = curl_exec($curl);
        $a = json_decode($response,  true);
        curl_close($curl);
        return $a;
    }

    public function curl_update_avatar($id_com, $file, $token)
    {
        $filename = $file['name'];
        $filetype = $file['type'];
        $filedata = $file['tmp_name'];
        $header[] = 'Authorization: ' . $token . '';
        $curl = curl_init();
        $data = array(
            'id_com' => $id_com,
            'logo' => curl_file_create($filedata, $filetype, $filename)
        );
        $url = 'https://chamcong.24hpay.vn/service/update_logo_company.php';
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL 
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $header,
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        // do anything you want with your response
        $a = json_decode($response, true);
        return $a;
    }
    public function update_ntd()
    {
        $com = $this->session->userdata('company');
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');
        $id_com = $com['id'];
        $token = $com['token'];
        $data = array(
            'company_name' => $name,
            'company_phone' => $phone,
            'company_address' => $address,
            'id_com' => $id_com
        );
        $resp = $this->curl_update_com($data, $token);
        if (isset($_FILES['avatar'])) {
            $file = $_FILES['avatar'];
            $res_ava = $this->curl_update_avatar($id_com, $file, $token);

            if ($res_ava['data']['id'] != '')
                $_SESSION['company']['avatar'] = 'https://chamcong.24hpay.vn/upload/company/logo/' . $res_ava['data']['id'];
        }
        if ($resp['data'] != '') {
            $_SESSION['company']['name'] = $name;
            $_SESSION['company']['phone'] = $phone;
            $_SESSION['company']['address'] = $address;
            $result = [
                'result' => true,
                'message' => 'cập nhật thông tin thành công',
            ];
        } else {
            $result = [
                'result' => false,
                'message' => $resp['error']['message'],
            ];
        }
        echo json_encode($result);
    }
    public function cty_doi_mk()
    {

        $com = checkLogin();
        $company_ss = $this->session->userdata('company');
        $company = $this->Company_model->infor_company($company_ss['email']);
        $data['detail_company'] = $company;
        $this->load->helper('url');
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/cty_doi_mk', $data);
    }
    public function cty_baoloi()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $company = $this->Company_model->infor_company($company_ss['email']);
        $data['detail_company'] = $company;
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/cty_baoloi', $data);
    }
    public function checkPass()
    {
        $pass = $this->input->post('pass');
        $pass = md5($pass);
        $ss =  $this->session->userdata('company');
        $checkpass = $this->Company_model->checkPass($pass, $ss['id']);

        if (count($checkpass) == 0) {
            $data = [
                'result' => false,
            ];
        } else {
            $data = [
                'result' => true,
            ];
        }
        echo json_encode($data);
    }

    public function curl_changePassword($data, $token)
    {
        $header[]         = 'Authorization: ' . $token . '';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/change_pass_company.php';
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL 
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => $header,
        ));
        $response = curl_exec($curl);
        $a = json_decode($response,  true);
        curl_close($curl);
        return $a;
    }
    public function changePassword()
    {
        $ss =  $this->session->userdata('company');
        $passnew = $this->input->post('pass');
        $old_pass = $this->input->post('old_pass');
        $token = $ss['token'];
        $data = array(
            'old_pass' => $old_pass,
            'new_pass' => $passnew
        );
        $resp = $this->curl_changePassword($data, $token);

        if ($resp['data'] != '')
            $result = ['result' => true];
        else
            $result = ['result' => false, 'msg' => $resp['error']['message']];
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    public function list_company_small()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $access_token     = $company_ss['token'];
        $header[]         = 'Authorization: ' . $access_token . '';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/list_child_of_company.php';
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL list_companySmall
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $list_company_small = json_decode($resp);
        $ds_cty_con = [];
        foreach ($list_company_small->data->items as $key => $value) {
            if ($value->com_parent_id != null) {
                $ds_cty_con[$value->com_id] = [
                    'com_id' => $value->com_id,
                    'com_name' => $value->com_name,
                    'com_phone' => $value->com_phone,
                    'com_address' => $value->com_address,
                    'com_logo' => $value->com_logo,
                    'com_email' => $value->com_email,
                ];
            }
        }
        curl_close($curl);
        return $ds_cty_con;
    }

    public function ds_cty_con()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $congty = $this->input->get('congty');
        $per_page = 10;
        $company = [
            'com_id'     => $company_ss['id'],
            'com_name'   => $company_ss['name'],
            'com_avatar' => $company_ss['avatar'],
        ];
        $data['ds_cty_con'] = $this->list_company_small();
        $data['detail_company'] = $company;
        $data['congty'] = $congty;
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/ds_cty_con', $data);
    }
    public function add_company_small()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $com_email = $this->input->post('email');
        $com_name = $this->input->post('ten_cty');
        $com_phone = $this->input->post('telephone');
        $com_address = $this->input->post('address');
        $OTP = rand(100000, 999999);
        if ($com_email == "" || $com_name == "" || $com_phone == "" || $com_address == "") {
            $result = [
                'result' => 1,
            ];
        } else {
            $access_token       = $company_ss['token'];
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $data     = [
                'email'                 => $com_email,
                'company_name'          => $com_name,
                'company_phone'         => $com_phone,
                'company_address'       => $com_address,
            ];

            $url = 'https://chamcong.24hpay.vn/service/add_child_company.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            $add_company = json_decode($resp);

            if ($add_company->error != null) {
                $result = [
                    'result' => 3,
                    'message' => $add_company->error->message,
                ];
            } else {
                if (isset($_FILES['avatar'])) {
                    $filename = $_FILES['avatar']['name'];
                    $filetype = $_FILES['avatar']['type'];
                    $filedata = $_FILES['avatar']['tmp_name'];
                    $data_logo = array(
                        'id_com' => $add_company->data->id,
                        'logo' => curl_file_create($filedata, $filetype, $filename)
                    );
                    $url = 'https://chamcong.24hpay.vn/service/update_logo_company.php';
                    curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => $url,
                        CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                        CURLOPT_POST => 1,
                        CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                        CURLOPT_HTTPHEADER => $header,
                        CURLOPT_POSTFIELDS => $data_logo
                    ));
                    $resp = curl_exec($curl);
                    curl_close($curl);
                }
                $result = [
                    'result' => 2,
                    'message' => 'Thêm công ty con thành công',
                ];
            }
        }
        echo json_encode($result);
    }

    public function detailCompany()
    {
        $id = $this->input->post('id');
        if ($id == "") {
            $result = [
                'result' => false,
            ];
        } else {
            $company = $this->Company_model->infor_companyById($id);
            $result = [
                'result' => true,
                'info' => $company,
            ];
        }
        echo json_encode($result);
    }

    public function detailCompanySmall()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $id = $this->input->post('id');
        if ($id == "") {
            $result = [
                'result' => false,
            ];
        } else {
            $list_company_small = $this->list_company_small();
            $result = [
                'result' => true,
                'info' => $list_company_small[$id],
            ];
        }
        echo json_encode($result);
    }

    public function updateComSmall()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $id         = $this->input->post('id');
        $ten_cty    = $this->input->post('ten_cty');
        $telephone  = $this->input->post('telephone');
        $address    = $this->input->post('address');
        if ($id == "" || $ten_cty == "" || $telephone == "" || $address == "") {
            $result = [
                'result' => false,
                'message' => "Vui lòng nhập đủ các trường",
            ];
        } else {
            $access_token       = $company_ss['token'];
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $data     = [
                'id_com'                => $id,
                'company_name'          => $ten_cty,
                'company_phone'         => $telephone,
                'company_address'       => $address,
                'logo'                  => '',
            ];
            if (isset($_FILES['avatar'])) {
                $filename = $_FILES['avatar']['name'];
                $filetype = $_FILES['avatar']['type'];
                $filedata = $_FILES['avatar']['tmp_name'];
                $data_logo = array(
                    'id_com' => $id,
                    'logo' => curl_file_create($filedata, $filetype, $filename)
                );
                $url = 'https://chamcong.24hpay.vn/service/update_logo_company.php';
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url,
                    CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                    CURLOPT_POST => 1,
                    CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                    CURLOPT_HTTPHEADER => $header,
                    CURLOPT_POSTFIELDS => $data_logo
                ));
                $resp = curl_exec($curl);
            }
            $url = 'https://chamcong.24hpay.vn/service/update_user_info_company.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            $edit_company = json_decode($resp);
            $result = [
                'result' => 2,
                'message' => 'Cập nhật thông tin thành công',
            ];
            if ($edit_company->error != null) {
                $result = [
                    'result' => 3,
                    'message' => $edit_company->error->message,
                ];
            }
        }
        echo json_encode($result);
    }

    public function delete_company_small()
    {
        $id = $this->input->post('id');
        if ($id == "") {
            $result = [
                'result' => false,
                'message' => "Vui lòng nhập đủ các trường",
            ];
        } else {
            $arr_id = [
                'com_id' => $id,
            ];
            $arr_update = [
                'com_email' => "",
            ];
            $update = $this->Company_model->updateComSmall($arr_update, $arr_id);
            $result = [
                'result' => true,
                'message' => "Xóa thành công",
            ];
        }
        echo json_encode($result);
    }
    public function ds_nv_phong()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $id_department = $this->input->get('id');
        $keyWord = $this->input->get('keyWord');
        if (!isset($id_department) || isset($id_department) == 0) {
            return redirect(urlQlyDanhSachPhongBan());
        }
        $segment = 2;
        $per_page = 10;
        $url =  urlQlyDanhSachNvTheoPhongBan();
        $num = $this->Company_model->show_staff_by_department($id_department, $keyWord);
        $page = $this->page(count($num), $segment, $url, $per_page);
        $list = $this->Company_model->show_page_staff_by_department($id_department, $per_page, $per_page * ($page - 1), $keyWord);
        $name_department = $this->Company_model->select_name_department($id_department);
        $data['name_department'] = $name_department['name_department'];
        $company = $this->Company_model->infor_company($company_ss['email']);
        $data["links"] = $this->pagination->create_links();
        $data['detail_company'] = $company;
        $data['id_department'] = $id_department;
        $data['list'] = $list;
        $data['show_position'] = $this->show_position();
        $data['phongban'] = $this->show_department();
        $data['small_com'] = $this->list_companySmall();
        $data['quyen'] = $this->show_role();
        $this->load->helper('url');
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/ds_nv_phong', $data);
    }
    public function quyen_truy_cap()
    {
        $keyWord = $this->input->get('keyWord');
        $chiNhanh = $this->input->get('cn');
        $phongBan = $this->input->get('pb');
        $quyen = $this->input->get('q');
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $company = [
            'com_id'     => $company_ss['id'],
            'com_name'   => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];
        $segment = 2;
        $per_page = 10;
        $type = $this->uri->segment(2);
        $access_token     = $company_ss['token'];
        $header[]         = 'Authorization: ' . $access_token . '';
        $rowperpage     = 10;
        $off_set = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        if ($off_set != 0) {
            $off_set                     = ($off_set - 1) * $rowperpage;
        }
        $id_com = $company_ss['id'];
        if ($chiNhanh != '') {
            $id_com = $chiNhanh;
        }
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=true&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com;
        if ($keyWord == '' && $phongBan != 0 && $phongBan != '') {
            $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=true&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com . '&filter_by[department]=' . $phongBan;
        } else if ($keyWord != '' && $phongBan == 0 && $phongBan == '') {
            $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=true&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com . '&filter_by[search]=' . $keyWord;
        } else if ($keyWord != '' && $phongBan != 0 && $phongBan != '') {
            $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=true&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com . '&filter_by[department]=' . $phongBan . '&filter_by[search]=' . $keyWord;
        }
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL quyen_truy_cap
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $staff_active = json_decode($resp);
        curl_close($curl);
        $url =  urlQlyQuyenTruyCap();
        $num = $staff_active->data->totalItems;
        $page = $this->page($num, $segment, $url, $per_page);

        $data["links"] = $this->pagination->create_links();
        $data['quyen'] = $this->show_role();
        $data['show_department'] = $this->show_department();
        $data['detail_company']         = $company;
        $data['detail_company_small']   = $this->list_companySmall();
        $data['staff_active']   = $staff_active->data->items;
        $data['keyWord'] = $keyWord;
        $data['chiNhanh'] = $chiNhanh;
        $data['quyen_search'] = $quyen;
        $data['phongBan'] = $phongBan;
        $this->load->helper('url');
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/quyen_truy_cap', $data);
    }

    public function updateRoleStaff()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $staff_id = $this->input->post('staff_id');
        $id_role = $this->input->post('id_role');
        if ($staff_id == "" || $id_role == "") {
            $result = [
                'result' => 1,
                'message' => 'Vui lòng nhập đủ các trường!',
            ];
        } else {
            $access_token       = $company_ss['token'];
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $data     = [
                'id_ep_update'                 => $staff_id,
                'role_id'          => $id_role,
            ];

            $url = 'https://chamcong.24hpay.vn/service/update_permission.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            $updateRoleStaff = json_decode($resp);
            if ($updateRoleStaff->error != null) {
                $result = [
                    'result' => 3,
                    'message' => $updateRoleStaff->error->message,
                ];
            } else {
                $result = [
                    'result' => 2,
                    'message' => 'Cập nhật phân quyền thành công',
                ];
            }
        }
        echo json_encode($result);
    }

    public function create_schedule()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $comSmall = $this->list_companySmall();
        $company = [
            'com_id' => $company_ss['id'],
            'com_name' => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];
        $this->_data['detail_company'] = $company;
        $this->_data['detail_company_small'] = $comSmall;
        $this->_data['title'] = 'Tạo lịch trình';
        $this->_data['style'] = 'quan_ly_cty';
        $this->_data['js'] = 'tao_lich_trinh.js';
        $this->_data['content'] = 'manager/company/tao_lich_trinh';
        $this->_data['notify'] = $this->notify();
        $this->load->view('manager/company/manager', $this->_data);
    }
    public function create_schedule_post()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $com_id = $company_ss['id'];
        $name = $this->input->post('tao_lich');
        $date_start = $this->input->post('date_start');
        $date_end = $this->input->post('date_end');
        $note = $this->input->post('ghi_chu');
        $place = $this->input->post('place');
        $id_staff = $this->input->post('chon_nv');

        if ($com_id != '' && $name != '' && $date_start != '' && $date_end != '' && $id_staff != '' && $place != '') {
            $ex = explode(';', $place);
            $staff = explode(',', $id_staff);
            $id_small = 0;
            $date_start = strtotime($date_start);
            $date_end = strtotime($date_end);
            $schedule = [
                'com_id'     => $com_id,
                'com_small_id' => $id_small,
                'name'       => $name,
                'date_start' => $date_start,
                'date_end'   => $date_end,
                'note'       => $note,
            ];
            $schedule_id = $this->Company_model->createSchedule($schedule);

            $arr_id = [];
            for ($i = 0; $i < count($ex) - 1; $i++) {
                $sch_placell = [
                    'schedule_id'       => $schedule_id,
                    'place'             => $ex[$i],
                    // 'lat_long'          => $lat_long[$i],
                    // 'staff_id'          => $value,
                ];
                $arr_id[] = $this->Company_model->createSchedulePlaceLatLong($sch_placell);
            }

            foreach ($staff as $value) {
                for ($i = 0; $i < count($arr_id); $i++) {
                    $sch_place = [
                        'schedule_id'       => $schedule_id,
                        'id_lat_long'             => $arr_id[$i],
                        'staff_id'          => $value,
                    ];
                    $this->Company_model->createSchedulePlace($sch_place);
                }
            }

            foreach ($staff as $value) {
                $schedule_staff = [
                    'schedule_id' => $schedule_id,
                    'staff_id'    => $value,
                    'status'      => 4,
                ];
                $this->Company_model->createScheduleStaff($schedule_staff);
                $data_notify = [
                    'company' => $com_id,
                    'notify_to_staff' => $value,
                    'note' => $company_ss['name'] . ' vừa thêm bạn vào 1 lịch trình mới',
                    'date' => time(),
                    'image_notify' => 5,
                ];
                $insertNotify = $this->Company_model->insertNotify($data_notify);
            }
            $data = [
                'result' => true,
                'message' => "Tạo lịch trình thành công",
            ];
        } else {
            $data = [
                'result' => false,
                'message' => "Tạo lịch trình thất bại",
            ];
        }
        echo json_encode($data);
    }

    public function update_schedule_post()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('tao_lich');
        $staff = $this->input->post('chon_nv');
        $date_start = $this->input->post('date_start');
        $date_end = $this->input->post('date_end');
        $note = $this->input->post('ghi_chu');
        $place = $this->input->post('place');
        if ($id == '' || $name == '' || $staff == '' || $date_start == '' || $date_end == '') {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhâp đủ các trường',
            ];
        } else {
            $id_1 = [
                'id' => $id,
            ];
            $id_2 = [
                'schedule_id' => $id,
            ];
            $data_1 = [
                'name' => $name,
                'date_start' => strtotime($date_start),
                'date_end' => strtotime($date_end),
                'note' => $note,
            ];
            $update = $this->Company_model->UpdateSchedule($data_1, $id_1);

            $ex = explode(';', $place);
            $staff = explode(',', $staff);
            $a = $this->Company_model->deletePlace($id_2);
            $b = $this->Company_model->deleteScheduleStaff($id_2);
            $c = $this->Company_model->deleteSchedulelatlong($id_2);
            $arr_id = [];
            for ($i = 0; $i < count($ex) - 1; $i++) {
                $sch_placell = [
                    'schedule_id'       => $id,
                    'place'             => $ex[$i],
                    // 'lat_long'          => $lat_long[$i],
                    // 'staff_id'          => $value,
                ];
                $arr_id[] = $this->Company_model->createSchedulePlaceLatLong($sch_placell);
            }
            foreach ($staff as $value) {
                for ($i = 0; $i < count($arr_id); $i++) {
                    $sch_place = [
                        'schedule_id'       => $id,
                        'id_lat_long'             => $arr_id[$i],
                        'staff_id'          => $value,
                    ];
                    $this->Company_model->createSchedulePlace($sch_place);
                }
            }

            foreach ($staff as $value) {
                $schedule_staff = [
                    'schedule_id' => $id,
                    'staff_id'    => $value,
                    'status'      => 4,
                ];
                $this->Company_model->createScheduleStaff($schedule_staff);
            }
            $result = [
                'result' => true,
                'message' => 'Cập nhật thành công',
            ];
        }

        echo json_encode($result);
    }

    public function deleteStaffBySchedule()
    {
        $id_sch = $this->input->post('id_sch');
        $id_staff = $this->input->post('id_staff');
        if ($id_sch == '' || $id_staff == '') {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $data = [
                'schedule_id' => $id_sch,
                'staff_id' => $id_staff
            ];
            $a = $this->Company_model->deletePlace($data);
            $b = $this->Company_model->deleteScheduleStaff($data);

            $result = [
                'result' => true,
                'message' => 'Xóa nhân viên khỏi lịch trình thành công',
            ];
        }
        echo json_encode($result);
    }
    public function list_department()
    {
        $company_ss = $this->session->userdata('company');
        $keyWord = $this->input->get('keyWord');
        $congty = $this->input->get('congty');

        $company = [
            'com_id'     => $company_ss['id'],
            'com_name'   => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];
        $this->info['detail_company'] = $company;
        $this->info['detail_company_small'] = $this->list_companySmall();
        $this->info['congty'] = $congty;
        $this->info['department'] = $this->show_department($congty);
        $this->info['keyWord'] = $keyWord;
        $this->info['congty'] = $congty;
        $this->info['title'] = 'Danh sách phòng ban';
        $this->info['style'] = 'quan_ly_cty';
        $this->info['js'] = 'them_phong_ban.js';
        $this->info['content'] = 'manager/company/ds_phong_ban';
        $this->info['notify'] = $this->notify();
        return $this->load->view('manager/company/manager', $this->info);
    }

    public function list_companySmall()
    {
        $com  = $this->session->userdata('company');
        $access_token = $com['token'];
        $header[]         = 'Authorization: ' . $access_token . '';
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
        $response = json_decode($resp);
        curl_close($curl);
        return $response->data->items;
    }
    public function list_staff()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');

        $keyword = $this->input->get('keyWord');
        $department = $this->input->get('d');
        $chiNhanh = $this->input->get('cn');
        $company = [
            'com_id'     => $company_ss['id'],
            'com_name'   => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];
        $segment = 3;
        $per_page = 10;
        $type = $this->uri->segment(2);
        $access_token     = $company_ss['token'];
        $header[]         = 'Authorization: ' . $access_token . '';
        $rowperpage     = 10;
        $segment = 3;
        $off_set = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        if ($off_set != 0) {
            $off_set                     = ($off_set - 1) * $rowperpage;
        }
        $id_com = $company_ss['id'];
        if ($chiNhanh != '') {
            $id_com = $chiNhanh;
        }
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=true&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com;
        if ($keyword == '' && $department != 0 && $department != '') {
            $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=true&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com . '&filter_by[department]=' . $department;
        } else if ($keyword != '' && $department == 0 && $department == '') {
            $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=true&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com . '&filter_by[search]=' . $keyword;
        } else if ($keyword != '' && $department != 0 && $department != '') {
            $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=true&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com . '&filter_by[department]=' . $department . '&filter_by[search]=' . $keyword;
        }
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $staff_active = json_decode($resp);
        curl_close($curl);
        $url =  urlQlyNhanVienCtyActive(1);
        $num = $staff_active->data->totalItems;
        $page = $this->page($num, $segment, $url, $per_page);
        $data["pagination"] = $this->pagination->create_links();

        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=false&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com;
        if ($keyword == '' && $department != 0 && $department != '') {
            $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=false&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com . '&filter_by[department]=' . $department;
        } else if ($keyword != '' && $department == 0 && $department == '') {
            $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=false&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com . '&filter_by[search]=' . $keyword;
        } else if ($keyword != '' && $department != 0 && $department != '') {
            $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=false&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com . '&filter_by[department]=' . $department . '&filter_by[search]=' . $keyword;
        }
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $staff_no_active = json_decode($resp);
        curl_close($curl);
        $url =  urlQlyNhanVienCtyActive(2);
        $num = $staff_no_active->data->totalItems;
        $page = $this->page($num, $segment, $url, $per_page);
        $data["links1"] = $this->pagination->create_links();

        $data['staff_active'] = $staff_active->data->items;
        $data['staff_no_active'] = $staff_no_active->data->items;
        $data['keyword'] = $keyword;
        $data['chiNhanh'] = $chiNhanh;
        $data['department'] = $department;
        $data['type'] = $type;
        $data['detail_company'] = $company;
        $data['count_staff_active'] = $staff_active->data->totalItems;
        $data['count_staff_no_active'] = $staff_no_active->data->totalItems;
        $data['title'] = "Quản lý nhân viên";
        $data['js'] = 'them_nv_cty.js';
        $data['content'] = 'manager/company/qly_nhan_vien';
        $data['phongban'] = $this->show_department();
        $data['chucvu'] = $this->show_position();
        $data['small_com'] = $this->list_companySmall();
        $data['quyen'] = $this->show_role();
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/manager', $data);
    }

    public function export_excel()
    {

        checkLogin();
        $type = $this->uri->segment(4);
        $keyWord = $this->input->get('keyWord');
        $depment = $this->input->get('d');
        $com = $this->input->get('cn');
        if ($type == 2) {
            $type = 0;
        }
        $name = $this->uri->segment(5);
        $company_ss = $this->session->userdata('company');
        $list = $this->Company_model->list_staff_excel($company_ss['id'], $keyWord, $com, $depment, $type);

        $th_array = array(
            'B' => 'Thông tin nhân viên(ID)',
            'C' => 'Email',
            'D' => 'Số điện thoại',
            'E' => 'Quyền truy cập',
        );
        $role = $this->show_role();
        foreach ($list as $key => $value) {
            $name = $value->name_staff . '(' . $value->staff_id . ')';
            $name_role = 'Chưa phân quyền';
            foreach ($role as $key => $value_role) {
                if ($value->power == $value_role['id']) {
                    $name_role = $value_role['name'];
                }
            }
            $tr_array[] = array(
                'B' => $name,
                'C' =>  $value->email,
                'D' => $value->telephone,
                'E' =>  $name_role,
            );
        }
        $this->globals->my_export('staff_pc365', 'Thống kê nhân viên', $th_array, $tr_array);
    }

    public function detail_staff()
    {
        checkLogin();
        $staff_id = $this->input->get('staff_id');
        if (!isset($staff_id) || $staff_id == 0 || $staff_id == '') {
            return redirect(urlQlyNhanVienCtyActive(1));
        }
        $company_ss = $this->session->userdata('company');
        $company = [
            'com_id'     => $company_ss['id'],
            'com_name'   => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];
        $staff = detailStaff($staff_id,$company_ss['token']);
        $data['phongban'] = $this->show_department();
        $data['chucvu'] = $this->show_position();
        $data['quyen'] = $this->show_role();
        $data['detail_company'] = $company;
        $data['company_small'] = $this->list_companySmall();
        $data['staff'] = $staff;
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/detail_staff', $data);
    }
    public function create_department()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $name_department = $this->input->post('name_department');
        if ($name_department == "") {
            $result = [
                'result' => 1,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $access_token       = $company_ss['token'];
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $data     = [
                'dep_name'              => $name_department,
            ];
            $url = 'https://chamcong.24hpay.vn/service/add_department.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            $create_department = json_decode($resp);
            curl_close($curl);
            $result = [
                'result' => 2,
                'message' => 'Thêm phòng ban thành công',
            ];
            if ($create_department->error != null) {
                $result = [
                    'result' => 3,
                    'message' => $create_department->error->message,
                ];
            }
        }
        echo json_encode($result);
    }

    public function update_department()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $name_department = $this->input->post('name_department');
        $id_department = $this->input->post('id_department');
        if ($id_department == "" && $name_department == "") {
            $result = [
                'result' => 1,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $access_token       = $company_ss['token'];
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $data     = [
                'dep_name'              => $name_department,
                'dep_id'              => $id_department,
            ];
            $url = 'https://chamcong.24hpay.vn/service/update_department.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            $update_department = json_decode($resp);
            curl_close($curl);
            $result = [
                'result' => 2,
                'message' => 'Cập nhật phòng ban thành công',
            ];
            if ($update_department->error != null) {
                $result = [
                    'result' => 3,
                    'message' => $update_department->error->message,
                ];
            }
        }
        echo json_encode($result);
    }
    public function delete_department()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $id_department = $this->input->post('id_department');
        if ($id_department != '') {
            $access_token       = $company_ss['token'];
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $data     = [
                'dep_id'              => $id_department,
            ];
            $url = 'https://chamcong.24hpay.vn/service/delete_department.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            $update_department = json_decode($resp);
            curl_close($curl);
            $result = [
                'result' => 2,
                'message' => 'Xóa phòng ban thành công',
            ];
            if ($update_department->error != null) {
                $result = [
                    'result' => 3,
                    'message' => $update_department->error->message,
                ];
            }
        } else {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        }
        echo json_encode($result);
    }
    public function add_staff()
    {
        checkLogin();
        $com                =  $this->session->userdata('company');
        $com_id             = $com['id'];
        $name               = $this->input->post('ten_ns');
        $email              = $this->input->post('email');
        $pass               = $this->input->post('mat_khau');
        $phone              = $this->input->post('telephone');
        $role               = $this->input->post('truy_cap');
        $dep_id             = $this->input->post('phong_ban2');
        $position_id        = $this->input->post('chuc_vu');
        if ($com_id == '' || $name == '' || $email == '' || $pass == '') {
            $result = [
                'result' => 1,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $curl = curl_init();
            $data = array(
                'email' => $email,
                'ep_name' => $name,
                'ep_phone' => $phone,
                'password' => $pass,
                'ep_address' => '',
                'dep_id' => $dep_id,
                'com_id' => $com_id,
                'role' => $role,
                'position_id' => $position_id,
                'gioi_tinh' => '',
                'user_birthday' => '',
                'hoc_van' => '',
                'start_time' => '',
                'hon_nhan' => '',
                'n_kinh_nghiem' => '',
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
                if ($responsive_otp->error != null) {
                    $result = [
                        'result' => 2,
                        'message' => $response->error->message,
                    ];
                } else {
                    $result = [
                        'result' => 3,
                        'message' => 'Đăng ký tài khoản thành công',
                    ];
                }
            }
        }
        echo json_encode($result);
    }

    public function update_staff()
    {
        $staff_id = $this->input->post('staff_id');
        $name_staff = $this->input->post('ten_ns');
        $telephone = $this->input->post('telephone');
        $dep_id = $this->input->post('phong_ban2');
        $position = $this->input->post('chuc_vu');
        if ($name_staff != '' && $telephone != '' && $position != '' && $dep_id != '') {
            $company_ss         = $this->session->userdata('company');
            $access_token       = $company_ss['token'];
            $data_update     = [
                'id_ep'            => $staff_id,
                'ep_name'         => $name_staff,
                'ep_phone'        => $telephone,
                'dep_id'        => $dep_id,
                'position_id'    => $position,
            ];
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $url = 'https://chamcong.24hpay.vn/service/company_update_employee_info.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data_update
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            $status = [
                'result' => true,
                'message' => 'Cập nhật thông tin thành công',
            ];
        } else {
            $status = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        }
        echo json_encode($status);
    }

    public function cau_hinh_cham_cong()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $com_id = $company_ss['id'];
        $company = [
            'com_id'     => $company_ss['id'],
            'com_name'   => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];
        $access_token     = $company_ss['token'];
        $header[]         = 'Authorization: ' . $access_token . '';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/get_config_timekeeping_new.php?id_com=' . $company_ss['id'];
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $timekeeping = json_decode($resp);
        curl_close($curl);
        $data['company_small'] = $this->list_companySmall();
        $data['detail_company'] = $company;
        $data['config_wifi']    = $timekeeping->data->config->list_wifi;
        $data['config'] = explode(',', $timekeeping->data->config->id_way);
        $this->load->helper('url');
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/cau_hinh_cham_cong', $data);
    }

    public function update_config()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $id = $this->input->post('id');
        if ($id == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường!',
            ];
        } else {
            $access_token       = $company_ss['token'];
            $data = array(
                'lst_way_id' => $id,
            );
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $url = 'https://chamcong.24hpay.vn/service/update_way_timekeeping.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            $result = [
                'result' => true,
                'message' => 'Cập nhật cấu hình thành công',
            ];
        }
        echo json_encode($result);
    }

    public function update_wifi()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $arr_wifi_update = $this->input->post('wifi_update');
        $arr_wifi_new = $this->input->post('wifi_new');
        if ($arr_wifi_update == "" || $arr_wifi_new == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường!',
            ];
        } else {
            $arr_wifi_update = json_decode($arr_wifi_update);
            $arr_wifi_new = json_decode($arr_wifi_new);
            $access_token       = $company_ss['token'];
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            if (count($arr_wifi_new) > 0) {
                for ($i = 0; $i < count($arr_wifi_new); $i++) {
                    $data = [
                        'wifi_name' => $arr_wifi_new[$i]->name_wifi,
                        'ip_address' => $arr_wifi_new[$i]->ip_wifi,
                        'mac_address' => $arr_wifi_new[$i]->mac,
                    ];
                    $url = 'https://chamcong.24hpay.vn/service/add_company_wifi.php';
                    curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => $url,
                        CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                        CURLOPT_POST => 1,
                        CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                        CURLOPT_HTTPHEADER => $header,
                        CURLOPT_POSTFIELDS => $data
                    ));
                    $resp = curl_exec($curl);
                    $create_wifi = json_decode($resp);
                }
            }
            if (count($arr_wifi_update) > 0) {
                for ($i = 0; $i < count($arr_wifi_update); $i++) {
                    $data = [
                        'wifi_id' => $arr_wifi_update[$i]->id_wifi,
                        'wifi_name' => $arr_wifi_update[$i]->name_wifi,
                        'ip_address' => $arr_wifi_update[$i]->ip_wifi,
                        'mac_address' => $arr_wifi_update[$i]->mac,
                    ];
                    $url = 'https://chamcong.24hpay.vn/service/update_company_wifi.php';
                    $curl             = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_URL => $url,
                        CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                        CURLOPT_POST => 1,
                        CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                        CURLOPT_HTTPHEADER => $header,
                        CURLOPT_POSTFIELDS => $data
                    ));
                    $resp = curl_exec($curl);
                    $update_wifi = json_decode($resp);
                    curl_close($curl);
                }
            }

            $result = [
                'result' => true,
                'message' => 'Cập nhật cấu hình thành công',
            ];
        }
        echo json_encode($result);
    }

    public function delete_wifi()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $id = $this->input->post('id');
        if ($id == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường!',
            ];
        } else {
            $access_token       = $company_ss['token'];
            $data = array(
                'wifi_id' => $id,
            );
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $url = 'https://chamcong.24hpay.vn/service/delete_company_wifi.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            $result = [
                'result' => true,
                'message' => 'Xóa wifi thành công',
            ];
        }
        echo json_encode($result);
    }

    public function default_wifi()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $id = $this->input->post('id');
        if ($id == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường!',
            ];
        } else {
            $access_token       = $company_ss['token'];
            $data = array(
                'wifi_id' => $id,
            );
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $url = 'https://chamcong.24hpay.vn/service/set_company_wifi_default.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            $result = [
                'result' => true,
                'message' => 'Thêm wifi mặc định thành công',
            ];
        }
        echo json_encode($result);
    }

    public function ds_llv()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $keyWord = $this->input->get('key');
        $date = $this->input->get('date');
        $search_date = '';
        if ($date != '') {
            $search_date = strtotime($date . '-01');
        }
        $segment = 2;
        $per_page = 10;
        $url =  urlDslichLamViec();
        $num = $this->Company_model->count_calendar($company_ss['id'], $keyWord, $search_date);
        $page = $this->page(count($num), $segment, $url, $per_page);
        $data['show_list_calendar'] = $this->Company_model->show_list_calendar($company_ss['id'], $per_page, $per_page * ($page - 1), $keyWord, $search_date);
        $data["links"] = $this->pagination->create_links();
        $arr_list_shift = [];
        foreach ($data['show_list_calendar'] as $key => $value) {
            $arr_shift = [];
            $getShiftByCalendar = $this->Company_model->getShiftByCalendar($value['id']);
            foreach ($getShiftByCalendar as $key => $shift) {
                $arr = explode(',', $shift['id_shift']);
                foreach ($arr as $key => $value_arr) {
                    $arr_shift[] = $value_arr;
                }
            }
            $arr_list_shift[] = array_unique($arr_shift);
        }
        $company = $this->Company_model->infor_company($company_ss['email']);
        $comSmall = $this->Company_model->show_company_small($company_ss['id']);
        $list_shift = $this->Company_model->list_shift($company_ss['id']);

        $data['detail_company'] = $company;
        $data['arr_list_shift'] = $arr_list_shift;
        $data['company_small'] = $comSmall;
        $data['list_shift'] = $list_shift;
        $data['date'] = $date;
        $data['keyWord'] = $keyWord;
        $this->load->helper('url');
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/ds_llv', $data);
    }

    public function ds_nv_co_lich()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');

        $keyWord = $this->input->get('keyWord');
        $id_calendar = $this->input->get('id_calendar');
        if ($id_calendar == '' || $id_calendar == 0) {
            return redirect(urlDslichLamViec());
        }
        $segment = 2;
        $per_page = 10;
        $url =  urlLichLamViecNvCty();
        $num = $this->Company_model->countCalendarStaff($company_ss['id'], $keyWord, $id_calendar);
        $page = $this->page(count($num), $segment, $url, $per_page);
        $listCalendarStaff = $this->Company_model->listCalendarStaff($company_ss['id'], $per_page, $per_page * ($page - 1), $keyWord, $id_calendar);
        $data["links"] = $this->pagination->create_links();
        $company = $this->Company_model->infor_company($company_ss['email']);
        $comSmall = $this->Company_model->show_company_small($company_ss['id']);
        $listMonth = $this->Company_model->listMonth($company_ss['id']);
        $data['listCalendarStaff'] = $listCalendarStaff;
        $data['listMonth'] = $listMonth;
        $data['detail_company'] = $company;
        $data['company_small'] = $comSmall;
        $data['id_calendar'] = $id_calendar;
        $data['phongban'] = $this->show_department();
        $this->load->helper('url');
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/ds_nv_co_lich', $data);
    }

    public function them_nhan_vien()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $id_calendar = $this->input->get('id_calendar');
        if ($id_calendar == '' || $id_calendar == 0) {
            return redirect(urlDslichLamViec());
        }
        $company = $this->Company_model->infor_company($company_ss['email']);
        $comSmall = $this->Company_model->show_company_small($company_ss['id']);
        $detail_calendar = $this->Company_model->detail_calendar($id_calendar);
        $id_com = $detail_calendar['id_company'];
        $show_department = $this->Company_model->show_department($id_com, 0);

        $data['id_calendar'] = $id_calendar;
        $data['detail_company'] = $company;
        $data['company_small'] = $comSmall;
        $data['show_department'] = $show_department;
        $this->load->helper('url');
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/them_nhan_vien', $data);
    }

    public function them_llv()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $company = $this->Company_model->infor_company($company_ss['email']);
        $comSmall = $this->Company_model->show_company_small($company_ss['id']);
        $list_shift = $this->Company_model->list_shift($company_ss['id']);
        $data['detail_company'] = $company;
        $data['company_small'] = $comSmall;
        $data['list_shift'] = $list_shift;
        $this->load->helper('url');
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/them_llv', $data);
    }

    public function sua_llv()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $calendar_id = $this->input->get('calendar_id');
        if ($calendar_id == 0 || $calendar_id == '') {
            return redirect(urlDslichLamViec());
        } else {
            $company = $this->Company_model->infor_company($company_ss['email']);
            $comSmall = $this->Company_model->show_company_small($company_ss['id']);
            $detail_calendar = $this->Company_model->detail_calendar($calendar_id);
            $list_shift = $this->Company_model->list_shift($company_ss['id']);
            $data['detail_company'] = $company;
            $data['company_small'] = $comSmall;
            $data['list_shift'] = $list_shift;
            $data['detail_calendar'] = $detail_calendar;
            $this->load->helper('url');
            $data['notify'] = $this->notify();
            $this->load->view('manager/company/sua_llv', $data);
        }
    }

    public function createCalendar()
    {
        $name = $this->input->post('name');
        $month = $this->input->post('month');
        $arr_calendar = $this->input->post('arr_calendar');
        $arr_company = $this->input->post('arr_company');
        $choose_calendar = $this->input->post('choose_calendar');
        $ca_lam = $this->input->post('ca_lam');
        if ($name == '' || $month == '' || $choose_calendar == '' || $ca_lam == '' || $arr_calendar == '' || $arr_company == '') {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $arr_calendar = json_decode($arr_calendar);
            $arr_company = explode(',', $arr_company);
            $month = strtotime($month . '-01');
            foreach ($arr_company as $value) {
                $data_month = [
                    'name_calendar' => $name,
                    'month' => $month,
                    'choose_calendar' => $choose_calendar,
                    'id_company' => $value,
                    'id_company_small' => 0,
                    'calendar_parent' => 0,
                ];
                $insertMonth = $this->Company_model->createCalendar($data_month);
                $data_id = [
                    'calendar_id' => $insertMonth,
                ];
                $insertCalendarStaff = $this->Company_model->createCalendarStaff($data_id);
                foreach ($arr_calendar as $key => $value_day) {
                    $day = $value_day->day;
                    $id_shift = $value_day->shift;
                    $data_day = [
                        'id_company' => $value,
                        'id_company_small' => 0,
                        'date' => strtotime($day),
                        'id_shift' => $id_shift,
                        'calendar_parent' => $insertMonth,
                    ];
                    $insertday = $this->Company_model->createCalendar($data_day);
                }
            }

            $result = [
                'result' => true,
                'message' => 'Tạo lịch làm việc thành công',
            ];
        }
        echo json_encode($result);
    }

    public function updateCalendar()
    {
        $id_calendar = $this->input->post('id_calendar');
        $name = $this->input->post('name');
        $month = $this->input->post('month');
        $arr_calendar = $this->input->post('arr_calendar');
        $arr_company = $this->input->post('arr_company');
        $choose_calendar = $this->input->post('choose_calendar');
        $ca_lam = $this->input->post('ca_lam');
        if ($id_calendar == '' || $name == '' || $month == '' || $choose_calendar == '' || $ca_lam == '' || $arr_calendar == '' || $arr_company == '') {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $arr_calendar = json_decode($arr_calendar);
            $month = strtotime($month . '-01');
            $data_month = [
                'name_calendar' => $name,
                'month' => $month,
                'choose_calendar' => $choose_calendar,
                'id_shift' => $ca_lam,
                'id_company' => $arr_company,
                'id_company_small' => 0,
                'calendar_parent' => 0,
            ];
            $data_id = [
                'id' => $id_calendar,
            ];
            $updateCalendar = $this->Company_model->updateCalendar($data_month, $data_id);
            // $data_id = [
            //     'calendar_id' => $insertMonth,
            // ];
            // $insertCalendarStaff = $this->Company_model->createCalendarStaff($data_id);
            foreach ($arr_calendar as $key => $value_day) {
                $day = $value_day->day;
                $id_shift = $value_day->shift;
                $data_day = [
                    'id_company' => $arr_company,
                    'id_company_small' => 0,
                    'id_shift' => $id_shift,
                ];
                $data_id_day = [
                    'date' => strtotime($day),
                ];
                $updateday = $this->Company_model->updateCalendar($data_day, $data_id_day);
            }

            $result = [
                'result' => true,
                'message' => 'Cập nhật lịch làm việc thành công',
            ];
        }
        echo json_encode($result);
    }

    public function deleteCalendar()
    {
        $id_calendar = $this->input->post('id_calendar');
        if ($id_calendar == '') {
            $result = [
                'result' => false,
                'message' => "Vui lòng nhập đủ các trường",
            ];
        } else {
            $id = [
                'id' => $id_calendar,
            ];
            $data = [
                'index_calendar' => 2,
            ];
            $updateCalendar = $this->Company_model->updateCalendar($data, $id);
            $result = [
                'result' => true,
                'message' => "Xóa lịch làm việc thành công",
            ];
        }
        echo json_encode($result);
    }

    public function addStaffToCalendar()
    {
        $id_calendar = $this->input->post('id_calendar');
        $arr_staff = $this->input->post('arr_staff');
        if ($arr_staff == '' || $id_calendar == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường!',
            ];
        } else {
            $detailCalendarstaff = $this->Company_model->detailCalendarStaff($id_calendar);
            $list_staff = '';
            if ($detailCalendarstaff['staff_id'] != '') {
                $explode_staff_new = explode(',', $arr_staff);
                $explode_staff_old = explode(',', $detailCalendarstaff['staff_id']);
                $arr = [];
                for ($j = 0; $j < count($explode_staff_old); $j++) {
                    for ($i = 0; $i < count($explode_staff_new); $i++) {
                        if ($explode_staff_new[$i] ==  $explode_staff_old[$j]) {
                            $arr = array_splice($explode_staff_new, $i, 1);
                        }
                    }
                }

                if (count($explode_staff_new) > 0) {
                    $list_staff = $detailCalendarstaff['staff_id'] . ',' . implode(',', $explode_staff_new); # code...
                } else {
                    $list_staff = $detailCalendarstaff['staff_id'];
                }
            } else {
                $list_staff = $arr_staff;
            }
            $arr_id = [
                'calendar_id' => $id_calendar,
            ];
            $arr_data = [
                'staff_id' => $list_staff,
            ];
            $update = $this->Company_model->updateCalendarStaff($arr_data, $arr_id);
            $result = [
                'result' => true,
                'message' => 'Thêm nhân viên vào lịch làm việc thành công',
            ];
        }
        echo json_encode($result);
    }

    public function updateStaffToCalendar()
    {
        $lich_moi = $this->input->post('lich_moi');
        $staff_id = $this->input->post('staff_id');
        $lich_cu = $this->input->post('lich_cu');

        if ($lich_moi == "" || $staff_id == "" || $lich_cu == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $detailCalendarstaff_old = $this->Company_model->detailCalendarStaff($lich_cu);
            $detailCalendarstaff_new = $this->Company_model->detailCalendarStaff($lich_moi);
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
                    'calendar_id' => $lich_cu,
                ];

                $arr_dataCalenderStaff_old = [
                    'staff_id' => implode(',', $arr_staff),
                ];
                $updateCalendarStaff_old = $this->Company_model->updateCalendarStaff($arr_dataCalenderStaff_old, $arr_idCalenderStaff);

                $detailCalendarstaff_new = $this->Company_model->detailCalendarStaff($lich_moi);
                if ($detailCalendarstaff_new['staff_id'] != '') {
                    $staff_id_new = $detailCalendarstaff_new['staff_id'] . ',' . $staff_id;
                } else {
                    $staff_id_new = $staff_id;
                }
                $arr_dataCalenderStaff_new = [
                    'staff_id' => $staff_id_new,
                ];
                $arr_idCalenderStaff_new = [
                    'calendar_id' => $lich_moi,
                ];
                $updateCalendarStaff_old = $this->Company_model->updateCalendarStaff($arr_dataCalenderStaff_new, $arr_idCalenderStaff_new);
                $result = [
                    'result' => true,
                    'message' => 'Cập nhật thành công',
                ];
            }
        }

        echo json_encode($result);
    }

    public function deleteStaffToCalendar()
    {
        $id_staff = $this->input->post('id_staff');
        $id_calendar = $this->input->post('id_calendar');
        if ($id_staff == "" || $id_calendar == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $detailCalendarstaff = $this->Company_model->detailCalendarStaff($id_calendar);
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
            $updateCalendarStaff_old = $this->Company_model->updateCalendarStaff($arr_data, $arr_id);
            $result = [
                'result' => true,
                'message' => 'Xoá nhân viên khỏi lịch làm việc thành công',
            ];
        }
        echo json_encode($result);
    }

    public function llv_cua_nv()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');

        $keyWord = $this->input->get('keyWord');
        $id_calendar = $this->input->get('id_calendar');

        $segment = 2;
        $per_page = 10;
        $url =  urlLichLamViecNvCty();
        $num = $this->Company_model->countCalendarStaff($company_ss['id'], $keyWord, $id_calendar);
        $page = $this->page(count($num), $segment, $url, $per_page);
        $listCalendarStaff = $this->Company_model->listCalendarStaff($company_ss['id'], $per_page, $per_page * ($page - 1), $keyWord, $id_calendar);
        $data["links"] = $this->pagination->create_links();

        $company = $this->Company_model->infor_company($company_ss['email']);
        $comSmall = $this->Company_model->show_company_small($company_ss['id']);
        $listMonth = $this->Company_model->listMonth($company_ss['id']);
        $data['listCalendarStaff'] = $listCalendarStaff;
        $data['listMonth'] = $listMonth;
        $data['detail_company'] = $company;
        $data['company_small'] = $comSmall;
        $data['phongban'] = $this->show_department();
        $this->load->helper('url');
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/llv_cua_nv', $data);
    }

    public function infoStaff()
    {
        $staff_id = $this->input->post('staff_id');
        checkLogin();
        $company_ss = $this->session->userdata('company');
        if ($staff_id != 0) {
            $detail = detailStaff($staff_id,$company_ss['token']);
            $result = [
                'result' => true,
                'info' => $detail,
            ];
        } else {
            $result = [
                'result' => false,
            ];
        }
        echo json_encode($result);
    }

    public function activeStaff()
    {
        $data = $this->input->post('active');
        if ($data == '') {
            $result = [
                'result' => false,
            ];
        } else {
            $company_ss         = $this->session->userdata('company');
            $access_token       = $company_ss['token'];
            $data_update     = [
                'arr_ep_id'            => $data,
            ];
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $url = 'https://chamcong.24hpay.vn/service/accept_employee_wait.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data_update
            ));
            $resp = curl_exec($curl);
            $activeStaff = json_decode($resp);
            curl_close($curl);
            if ($activeStaff->error != null) {
                $result = [
                    'result' => false,
                    'message' => 'Duyệt nhân viên thất bại',
                ];
            } else {
                $result = [
                    'result' => true,
                    'message' => 'Duyệt nhân viên thành công',
                ];
            }
        }
        echo json_encode($result);
    }

    public function deleteNoActive()
    {
        checkLogin();
        $staff_id = $this->input->post('id');
        $result = [];
        if ($staff_id == '' || $staff_id == 0) {
            $result = [
                'result' => false,
            ];
        } else {
            $company_ss         = $this->session->userdata('company');
            $access_token       = $company_ss['token'];
            $data_update     = [
                'arr_ep_id'            => $staff_id,
            ];
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $url = 'https://chamcong.24hpay.vn/service/remove_employee_wait.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data_update
            ));
            $resp = curl_exec($curl);
            $deleteStaff = json_decode($resp);
            curl_close($curl);
            if ($deleteStaff->error != null) {
                $result = [
                    'result' => false,
                    'message' => 'Xóa nhân viên chờ duyệt thất bại',
                ];
            } else {
                $result = [
                    'result' => true,
                    'message' => 'Xóa nhân viên chờ duyệt thành công',
                ];
            }
        }
        echo json_encode($result);
    }

    public function deleteActive()
    {
        checkLogin();
        $ep_id = $this->input->post('id');
        $result = [];
        if ($ep_id == '' || $ep_id == 0) {
            $result = [
                'result' => false,
            ];
        } else {
            $company_ss         = $this->session->userdata('company');
            $access_token       = $company_ss['token'];
            $curl             = curl_init();
            $data_update     = ['ep_id' => $ep_id];
            $header[]         = 'Authorization: ' . $access_token . '';
            $url = 'https://chamcong.24hpay.vn/service/delete_employee.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data_update
            ));
            $resp = curl_exec($curl);
            curl_close($curl);
            $result = [
                'result' => true,
            ];
        }
        echo json_encode($result);
    }

    public function list_department_by_id()
    {
        checkLogin();
        $com_ss = $this->session->userdata('company');
        $id = $this->input->post('id');
        if ($id == '') {
            $data = [
                'result' => false,
                'list' => 'không được để trống',
            ];
        } else {
            $access_token     = $com_ss['token'];
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $curl     = curl_init();
            $url = 'https://chamcong.24hpay.vn/service/list_department.php?id_com=' . $id;
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
            ));
            $resp = curl_exec($curl);
            $list = json_decode($resp);
            curl_close($curl);
            if ($list != null) {
                $list = $list->data->items;
            }
            $curl     = curl_init();
            //$url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=true&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com;
            //https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=true&filter_by[company]=1&filter_by[search]=bạn
            $url = 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php?filter_by[active]=true&id_com=' . $id;
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
            ));
            $resp = curl_exec($curl);
            $show_staff = json_decode($resp);
            curl_close($curl);
            // var_dump($show_staff);
            $data = [
                'result' => true,
                'list' => $list,
                'show_staff' => $show_staff->data->items,
            ];
        }
        echo json_encode($data);
    }

    public function show_staff_by_department()
    {
        checkLogin();
        $com_ss = $this->session->userdata('company');
        $id = $this->input->post('id');
        $id = explode(',', $id);
        $list = [];
        $status = 'true';
        $access_token     = $com_ss['token'];
        $curl             = curl_init();
        $header[]         = 'Authorization: ' . $access_token . '';
        $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=' . $status;
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $show_staff = json_decode($resp);
        curl_close($curl);
        for ($i = 0; $i < count($show_staff->data->items); $i++) {
            foreach ($id as $value) {
                if ($show_staff->data->items[$i]->dep_id == $value) {
                    $list[] = $show_staff->data->items[$i];
                }
            }
        }


        $data = [
            'result' => true,
            'list' => $list,
        ];
        echo json_encode($data);
    }

    public function show_staff_by_department_calendar()
    {
        $id = $this->input->post('id');
        $id_calendar = $this->input->post('id_calendar');
        $id = explode(',', $id);
        $list = [];
        $list_staff_by_department = [];
        foreach ($id as $key => $value) {
            $list_staff_by_department[] = $this->Company_model->show_staff_by_department($value, "");
        }
        $list = $this->Company_model->show_staff_by_department_calendar($id_calendar);
        $arr = [];
        foreach ($list_staff_by_department as $staff) {
        }
        for ($i = 0; $i < count($list_staff_by_department); $i++) {
            foreach ($list as $key => $value) {
                for ($j = 0; $j < count($list_staff_by_department[$i]); $j++) {
                    if ($list_staff_by_department[$i][$j]['staff_id'] == $value['staff_id']) {
                        array_splice($list_staff_by_department[$i], $j, 1);
                    }
                }
            }
        }
        $data = [
            'result' => true,
            'list' => $list_staff_by_department,
        ];
        echo json_encode($data);
    }

    public function create_job()
    {
        $name_job           = $this->input->post('ten_cty');
        // $job_department_id  = $this->input->post('job_department_id');
        $date_start         = $this->input->post('date_start');
        $date_end           = $this->input->post('date_end');
        $time_in            = $this->input->post('time_in');
        $time_out           = $this->input->post('time_out');
        // $job_day            = $this->input->post('job_day');
        $staff_id           = $this->input->post('chon_nv');
        $job_address        = $this->input->post('dia_chi');
        $job_city           = $this->input->post('city');
        $job_district       = $this->input->post('district');
        // $notify             = $this->input->post('notify');
        $job_content        = $this->input->post('content');
        $note               = $this->input->post('note');
        $time_notify                = $this->input->post('time_nhac');
        $repeat_notify              = $this->input->post('cach_nhac');
        $status_notify              = $this->input->post('status_notify');
        $number_day_notify          = $this->input->post('number_day_notify');
        if ($name_job == '' || $staff_id == '' || $job_address == '' || $job_city == '' || $job_district == '') {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $company_ss = $this->session->userdata('company');
            $id = $company_ss['id'];

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
            $time = time();
            $job_id = $this->Company_model->create_job($data_job);
            $staff_id = explode(',', $staff_id);
            if ($time >= $time_in && $time <= $time_out) {
                $status = 3;
            } else if ($time >= $date_start && $time <= $date_end) {
                $status = 3;
            } else {
                $status = 4;
            }
            for ($i = 0; $i < count($staff_id); $i++) {
                $data_jobPar = [
                    'job_id' => $job_id,
                    'staff_id' => $staff_id[$i],
                    'status' => $status,
                ];
                $add_jobPra = $this->Company_model->createJobPar($data_jobPar);
            }
            if ($job_content != '') {
                $job_content = explode('||', $job_content);
                $arr_con = [];
                for ($j = 0; $j < count($job_content) - 1; $j++) {
                    $data_jobcontent = [
                        'job_id' => $job_id,
                        'content' => $job_content[$j],
                    ];
                    $arr_con[] = $this->Company_model->createJobContentStaff($data_jobcontent);
                }

                // $job_content = explode('||', $job_content);
                for ($j = 0; $j < count($arr_con); $j++) {
                    for ($i = 0; $i < count($staff_id); $i++) {
                        $data_jobcontent = [
                            'job_id' => $job_id,
                            'content_staff_id' => $arr_con[$j],
                            'staff_id' => $staff_id[$i],
                            'status' => 2,
                        ];
                        $add_jobContent = $this->Company_model->createJobContent($data_jobcontent);
                    }
                }
                for ($i = 0; $i < count($staff_id); $i++) {
                    $data_notify = [
                        'company' => $id,
                        'notify_to_staff' => $staff_id[$i],
                        'note' => $company_ss['name'] . ' đã giao cho bạn 1 công việc mới',
                        'date' => time(),
                        'image_notify' => 4,
                    ];
                    $insertNotify = $this->Company_model->insertNotify($data_notify);
                }
            }
            $result = [
                'result' => true,
                'message' => 'Tạo việc làm thành công',
            ];
        }
        echo json_encode($result);
    }
    public function update_job()
    { // xem lại
        // $token              = $this->input->post('token');
        $id_job             = $this->input->post('id');
        $name_job           = $this->input->post('ten_cty');
        // $job_department_id  = $this->input->post('job_department_id');
        $date_start         = $this->input->post('date_start');
        $date_end           = $this->input->post('date_end');
        $time_in            = $this->input->post('time_in');
        $time_out           = $this->input->post('time_out');
        $staff_id           = $this->input->post('chon_nv');
        $job_address        = $this->input->post('dia_chi');
        $job_city           = $this->input->post('city');
        $job_district       = $this->input->post('district');
        $job_content        = $this->input->post('content');
        // $notify             = $this->input->post('notify');
        // $file               = $this->input->post('file');
        $note               = $this->input->post('note');
        // $id_com             = $this->input->post('id_com');
        $time_notify        = $this->input->post('time_nhac');
        $repeat_notify      = $this->input->post('cach_nhac');
        $status_notify      = $this->input->post('status_notify');
        $number_day_notify  = $this->input->post('number_day_notify');
        //    $job_type           = $this->input->post('job_type');
        $time               = time();
        if ($name_job == '' || $id_job == '' || $staff_id == '' || $job_address == '' || $job_city == '' || $job_district == '') {
            $result = [
                'result' => false,
                'message' => 'Cập nhật công việc thất bại',
            ];
        } else {
            $company_ss = $this->session->userdata('company');
            $id = $company_ss['id'];

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

            $arr_delete = [
                'job_id' => $id_job,
            ];
            $arr_update = [
                'job_id' => $id_job,
            ];

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
            $this->Company_model->updatejob($data_job, $arr_update);
            $time = time();

            $deleteJobPar = $this->Company_model->deleteJobPar($arr_delete);
            $deleteJobContent = $this->Company_model->deleteJobContent($arr_delete);
            $deleteJobContentStaff = $this->Company_model->deleteJobContentStaff($arr_delete);

            $staff_id = explode(',', $staff_id);
            if ($time >= $time_in && $time <= $time_out) {
                $status = 3;
            } else if ($time >= $date_start && $time <= $date_end) {
                $status = 3;
            } else {
                $status = 4;
            }
            for ($i = 0; $i < count($staff_id); $i++) {
                $data_jobPar = [
                    'job_id' => $id_job,
                    'staff_id' => $staff_id[$i],
                    'status' => $status,
                ];
                $add_jobPra = $this->Company_model->createJobPar($data_jobPar);
            }
            if ($job_content != '') {
                $job_content = explode('||', $job_content);
                $arr_con = [];
                for ($j = 0; $j < count($job_content) - 1; $j++) {
                    $data_jobcontent = [
                        'job_id' => $id_job,
                        'content' => $job_content[$j],
                    ];
                    $arr_con[] = $this->Company_model->createJobContentStaff($data_jobcontent);
                }

                // $job_content = explode('||', $job_content);
                for ($j = 0; $j < count($arr_con); $j++) {
                    for ($i = 0; $i < count($staff_id); $i++) {
                        $data_jobcontent = [
                            'job_id' => $id_job,
                            'content_staff_id' => $arr_con[$j],
                            'staff_id' => $staff_id[$i],
                            'status' => 2,
                        ];
                        $add_jobContent = $this->Company_model->createJobContent($data_jobcontent);
                    }
                }
            }
            $result = [
                'result' => true,
                'message' => 'Cập nhật công việc làm thành công',
            ];
        }
        echo json_encode($result);
    }

    public function list_shift($token, $id_com)
    {
        $header[]         = 'Authorization: ' . $token . '';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/list_shift.php?id_com=' . $id_com;
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL quyen_truy_cap
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $ds_ca_lam = json_decode($resp);
        curl_close($curl);
        $arr_shift = [];
        foreach ($ds_ca_lam->data->items as $value) {
            $arr_shift[$value->shift_id] = [
                'com_id' => $value->com_id,
                'shift_id' => $value->shift_id,
                'shift_name' => $value->shift_name,
                'start_time' => $value->start_time,
                'end_time' => $value->end_time,
                'shift_type' => $value->shift_type,
                'num_to_calculate' => $value->num_to_calculate,
                'start_time_latest' => $value->start_time_latest,
                'end_time_earliest' => $value->end_time_earliest,
            ];
        }
        return $arr_shift;
    }

    public function ds_ca_lam()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $com = $this->input->get('com');
        $company = [
            'com_id'     => $company_ss['id'],
            'com_name'   => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];
        $access_token     = $company_ss['token'];
        $id_com = $company_ss['id'];
        if ($com != '') {
            $id_com = $com;
        }
        $data['detail_company'] = $company;
        $data['id_com'] = $id_com;
        $data['company_small'] = $this->list_companySmall();
        $data['ds_ca_lam'] = $this->list_shift($access_token, $id_com);
        $this->load->helper('url');
        $data['notify'] = $this->notify();
        $this->load->view('manager/company/ds_ca_lam', $data);
    }

    public function getInfoShift()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $id_shift = $this->input->post('id');
        if ($id_shift == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $access_token     = $company_ss['token'];
            $detail = $this->list_shift($company_ss['token'], $company_ss['id']);
            $result = [
                'result' => true,
                'id_com' => $detail[$id_shift]['com_id'],
                'shift_id' => $detail[$id_shift]['shift_id'],
                'shift_name' => $detail[$id_shift]['shift_name'],
                'start_time' => $detail[$id_shift]['start_time'],
                'end_time' => $detail[$id_shift]['end_time'],
                'shift_type' => $detail[$id_shift]['shift_type'],
                'num_to_calculate' => $detail[$id_shift]['num_to_calculate'],
                'start_time_latest' => $detail[$id_shift]['start_time_latest'],
                'end_time_earliest' => $detail[$id_shift]['end_time_earliest'],
            ];
        }
        echo json_encode($result);
    }
    public function createShift()
    {
        // shname: ca mưới
        // sh1: 16:01
        // sh2: 04:01
        // sh3: 17:02
        // sh4: 03:02
        // num_to_calculate: 1
        // shift_type: 2==> tính công theo giờ
        // cp: 1761

        // shname: ca tiếp theo
        // sh1: 04:03 => ca vào
        // sh2: 16:03 => ca ra
        // sh3: 04:04=> Sớm nhất
        // sh4: 16:02 => muộn nhất
        // num_to_calculate: 1 => số công tương ứng
        // shift_type: 1 ==> tính công theo số ca
        // cp: 1761

        checkLogin();
        $company_ss = $this->session->userdata('company');
        $id_com = $this->input->post('ten_cty');
        $name = $this->input->post('ca_lam');
        $time_in = $this->input->post('gio_vao');
        $time_out = $this->input->post('gio_ra');
        $gio_vao_muon = $this->input->post('gio_vao_muon');
        $gio_ra_som = $this->input->post('gio_ra_som');
        $type = $this->input->post('type');
        $num_to_calculate = $this->input->post('num_to_calculate');
        if ($id_com == "" || $name == "" || $time_in == "" || $time_out == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $access_token       = $company_ss['token'];
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $data     = [
                'shift_name'        => $name,
                'start_time'        => $time_in,
                'end_time'          => $time_out,
                'sh3'               => $gio_vao_muon,
                'sh4'               => $gio_ra_som,
                'id_com'            => $id_com,
                'shift_type'        => $type,
                'num_to_calculate'  => $num_to_calculate,
            ];
            $url = 'https://chamcong.24hpay.vn/api_web_cham_cong/add_shift.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            $createShift = json_decode($resp);
            $result = [
                'result' => true,
                'message' => 'Thêm ca làm việc thành công',
            ];
            if ($createShift->error != null) {
                $result = [
                    'result' => false,
                    'message' => $createShift->error->message,
                ];
            }
            curl_close($curl);
        }
        echo json_encode($result);
    }
    public function updateShift()
    {
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $id_shift = $this->input->post('id_shift');
        $id_com = $this->input->post('id_com');
        $name = $this->input->post('ten_ca');
        $time_in = $this->input->post('time_in');
        $time_out = $this->input->post('time_out');
        $gio_vao_muon = $this->input->post('gio_vao_muon');
        $gio_ra_som = $this->input->post('gio_ra_som');
        $type = $this->input->post('type');
        $num_to_calculate = $this->input->post('num_to_calculate');
        if ($id_shift == "" || $id_com == "" || $name == "" || $time_in == "" || $time_out == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $data = array(
                'shift_name' => $name,
                'start_time' => $time_in,
                'end_time' => $time_out,
                'sh3' => $gio_vao_muon,
                'sh4' => $gio_ra_som,
                'shift_id' => $id_shift,
                'shift_type' => $type,
                'num_to_calculate' => $num_to_calculate,

            );
            $access_token       = $company_ss['token'];
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $url = 'https://chamcong.24hpay.vn/api_web_cham_cong/update_shift.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            $updateShift = json_decode($resp);
            $result = [
                'result' => true,
                'message' => 'Cập nhật ca làm việc thành công',
            ];
            if ($updateShift->error != null) {
                $result = [
                    'result' => false,
                    'message' => $updateShift->error->message,
                ];
            }
        }
        echo json_encode($result);
    }

    public function deleteShift()
    {
        $id_shift = $this->input->post('id');
        $company_ss = $this->session->userdata('company');
        if ($id_shift == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $access_token       = $company_ss['token'];
            $curl             = curl_init();
            $header[]         = 'Authorization: ' . $access_token . '';
            $data = array(
                'shift_id' => $id_shift,
                'id_com' => $company_ss['id']
            );
            $url = 'https://chamcong.24hpay.vn/service/delete_shift.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            $update_department = json_decode($resp);
            curl_close($curl);
            $result = [
                'result' => true,
                'message' => 'Xóa ca làm việc thành công',
            ];
            if ($update_department->error != null) {
                $result = [
                    'result' => false,
                    'message' => $update_department->error->message,
                ];
            }
        }
        echo json_encode($result);
    }
    public function evaluate()
    {
        $company_ss = $this->session->userdata('company');
        $star = $this->input->post('star');
        $note = $this->input->post('note');
        if ($star == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $data = [
                'id_com' => $company_ss['id'],
                'star' => $star,
                'detail_evaluate' => $note,
                'created_at' => time(),
                'updated_at' => time(),
            ];
            $create = $this->Company_model->evaluate($data);
            $result = [
                'result' => true,
                'message' => 'Cảm ơn bạn đã đánh giá',
            ];
        }
        echo json_encode($result);
    }

    public function error()
    {
        $note = $this->input->post('note');
        $company_ss = $this->session->userdata('company');
        if ($note == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $id = 0;
            $id_small = 0;
            $staff = 0;
            $data = [];
            $data_insert = [
                'com_id' => $company_ss['id'],
                'id_com_small' => $id_small,
                'staff_id' => $staff,
                'content' => $note,
            ];
            $id_error = $this->Company_model->error($data_insert);
            if (isset($_FILES['images'])) {
                if (!empty($_FILES['images']['name']) && count(array_filter($_FILES['images']['name'])) > 0) {
                    $filesCount = count($_FILES['images']['name']);
                    for ($i = 0; $i < $filesCount; $i++) {
                        $temp                    = explode(".", $_FILES['images']['name'][$i]);
                        $newfilename             = round(microtime(true)) . md5(rand()) . '.' . end($temp);
                        $_FILES['file']['name']     = $newfilename;
                        $_FILES['file']['type']     = $_FILES['images']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                        $_FILES['file']['error']     = $_FILES['images']['error'][$i];
                        $_FILES['file']['size']     = $_FILES['images']['size'][$i];

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
                            $link_file = $uploadPath . $newfilename;
                            $data_img_error = [
                                'id_notify_error' => $id_error,
                                'image' => $link_file,
                            ];
                            $insert_images = $this->Company_model->error_images($data_img_error);
                            // $fileData = $this->upload->data(); 
                            // $uploadData[$i]['file_name'] = $fileData['file_name']; 
                            // $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s"); 
                        } else {
                            $result = [
                                'result' => false,
                                'message' => 'Tải ảnh lên thất bại',
                            ];
                        }
                    }
                }
            }
            $result = [
                'result' => true,
                'message' => 'Thông báo lỗi thành công',
            ];
        }
        echo json_encode($result);
    }

    public function updateNotify()
    {
        checkLogin();
        $status = $this->input->post('status');
        $company_ss = $this->session->userdata('company');
        if ($status == '' || $company_ss['id'] == '') {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường'
            ];
        } else {
            $arr_data = [
                'status' => $status,
            ];

            $arr_id = [
                'notify_to_company' => $company_ss['id'],
            ];

            $updateNotify = $this->Company_model->updateNotify($arr_data, $arr_id);
            $result = [
                'result' => true,
                'message' => 'Cập nhật thành công'
            ];
        }
        echo json_encode($result);
    }

    public function deleteNotifyCompany()
    {
        checkLogin();
        $status = $this->input->post('status');
        $company_ss = $this->session->userdata('company');
        if ($status == '' || $company_ss['id'] == '') {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường'
            ];
        } else {
            $arr_data = [
                'status' => $status,
            ];

            $arr_id = [
                'notify_to_company' => $company_ss['id'],
            ];

            $deleteNotiffy = $this->Company_model->deleteNotiffy($arr_data);
            $result = [
                'result' => true,
                'message' => 'Xóa thành công'
            ];
        }
        echo json_encode($result);
    }

    public function getWeeday()
    {

        $monday = strtotime("last monday");
        $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;

        // $sunday = strtotime(date("Y-m-d", $monday) . " +6 days");

        // $this_week_start = date("Y-m-d", $monday);
        // $this_week_end = date("Y-m-d", $sunday);
        // $day = strtotime($this_week_start) + 86400;
        checkLogin();
        $company_ss = $this->session->userdata('company');
        $company = $this->Company_model->infor_company($company_ss['email']);
        $list_late = [];
        $list_early = [];
        $list_timely_min = [];
        $staff = [];
        for ($i = 0; $i < 7; $i++) {
            $day = strtotime(date("d-m-Y", $monday) . "+" . $i . " days");
            $date_start = date('d-m-Y', $day);
            $date_end = date('d-m-Y', $day);
            $count_time_sheet        = $this->Company_model->show_time_sheet($company_ss['id'], '', $date_start, $date_end, '', '');
            $list_shift             = $this->Company_model->list_shift($company_ss['id']);
            $arr_sheet = [];
            $list_staff = [];
            foreach ($count_time_sheet as $sheets => $sheet) {
                $index_sheet = $sheet['staff_id'] . '_' . date("d_m_Y", strtotime($sheet['at_time']));
                $shift = [];
                foreach ($list_shift as $value_shifts => $value_shift) {
                    $show_sheet_by_id_shift_min = [];
                    $show_sheet_by_id_shift_max = [];
                    $count_timely_min = [];
                    $show_sheet_by_id_shift_min         = $this->Company_model->count_sheet_by_id_shift_min($value_shift['id_shift'], $sheet['staff_id'], $sheet['at_time'], $value_shift['time_in'], $value_shift['time_out']);
                    $show_sheet_by_id_shift_max         = $this->Company_model->count_sheet_by_id_shift_max($value_shift['id_shift'], $sheet['staff_id'], $sheet['at_time'], $value_shift['time_in'], $value_shift['time_out']);
                    $count_timely_min                   = $this->Company_model->count_timely_min($value_shift['id_shift'], $sheet['staff_id'], $sheet['at_time'], $value_shift['time_in'], $value_shift['time_out']);

                    $shift[$value_shift['id_shift']] = [
                        'in_shift' => $show_sheet_by_id_shift_min['in_shift'],
                        'out_shift' => $show_sheet_by_id_shift_max['out_shift'],
                        'timely_min' => $count_timely_min['timely_min'],
                    ];
                }
                $arr_sheet[$index_sheet] = [
                    'staff_id'      => $sheet['staff_id'],
                    'name_staff'    => $sheet['name_staff'],
                    'avatar'        => $sheet['avatar'],
                    'department'    => $sheet['department'],
                    'date'          => date("d-m-Y", strtotime($sheet['at_time'])),
                    'list'          => $shift,
                ];
            }
            $count_late = 0;
            $count_early = 0;
            $count_timely_min = 0;
            foreach ($arr_sheet as $value) {
                foreach ($value['list'] as $value_list) {
                    if ($value_list['in_shift'] != '') {
                        $count_late++;
                    }
                    if ($value_list['out_shift'] != '') {
                        $count_early++;
                    }

                    if ($value_list['timely_min'] != '') {
                        $count_timely_min++;
                    }
                }
                $list_staff[] = $value['staff_id'];
            }
            $staff[] = $list_staff;
            $list_late[] = $count_late;
            $list_early[] = $count_early;
            $list_timely_min[] = $count_timely_min;
        }
        $arr = [];
        for ($i = 0; $i < count($staff); $i++) {
            $list_staff             = $this->Company_model->list_staff($company_ss['id']);
            foreach ($list_staff as $valueStaff) {
                for ($j = 0; $j < count($staff[$i]); $j++) {
                    if ($staff[$i][$j] == $valueStaff['staff_id']) {
                        array_splice($list_staff, $i, 1);
                    }
                }
            }
            $arr[] = count($list_staff);
        }
        $result = [
            'list_late' => $list_late,
            'list_early' => $list_early,
            'list_timely_min' => $list_timely_min,
            'list_staff_no_sheet' => $arr,
        ];
        echo json_encode($result);
    }

    public function dangky_tuvan()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $quymo = $this->input->post('quymo');
        $nd = $this->input->post('nd');
        if ($name == '' || $email == '' || $phone == '' || $quymo == '' || $nd == '') {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $data = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'scale' => $quymo,
                'content' => $nd,
                'created_at' => time(),
                'updated_at' => time(),
            ];
            $create = $this->Company_model->signup_consultation($data);
            $result = [
                'result' => true,
                'message' => 'Đăng ký thành công. Chúng tôi sẽ sớm liên hệ với bạn.',
            ];
        }
        echo json_encode($result);
    }

    public function autoUpdateStatusJob()
    {
        $company_ss = $this->session->userdata('company');
        $time = strtotime(date('Y-m-d'));
        $time_end = $time - 86400;
        $list = $this->Company_model->getListJobToday($time, $time_end);
        $arr_quaHan = [
            'status' => 1,
        ];
        $arr_daLam = [
            'status' => 2,
        ];
        $arr_dangLam = [
            'status' => 3,
        ];
        foreach ($list as $key => $value) {
            $arr_id = [
                'job_id' => $value['job_id'],
            ];
            if ($value['job_day_start'] == $time) {
                $this->Company_model->updatejob($arr_dangLam, $arr_id);
            }
            if ($value['job_day_end'] == $time_end) {
                $list_jobContent = $this->Company_model->job_content_by_jobId($value['job_id']);
                $chua_lam = 0;
                foreach ($list_jobContent as $value_status) {
                    if ($value_status['status'] == 2) {
                        $chua_lam++;
                    }
                }
                if ($chua_lam > 0) {
                    $this->Company_model->updatejob($arr_quaHan, $arr_id);
                }
                if ($chua_lam == 0) {
                    $this->Company_model->updatejob($arr_daLam, $arr_id);
                }
            }
        }
    }
    public function face()
    {
        $company_ss = $this->session->userdata('company');
        $keyword = $this->input->get('keyWord');
        $department = $this->input->get('d');
        $chiNhanh = $this->input->get('cn');
        $company = [
            'com_id'     => $company_ss['id'],
            'com_name'   => $company_ss['name'],
            'com_avatar' => $company_ss['avatar']
        ];
        $segment = 2;
        $per_page = 10;
        $access_token     = $company_ss['token'];
        $header[]         = 'Authorization: ' . $access_token . '';
        $rowperpage     = 10;
        $off_set = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        if ($off_set != 0) {
            $off_set                     = ($off_set - 1) * $rowperpage;
        }
        $id_com = $company_ss['id'];
        if ($chiNhanh != '') {
            $id_com = $chiNhanh;
        }
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=true&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com;
        if ($keyword == '' && $department != 0 && $department != '') {
            $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=true&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com . '&filter_by[department]=' . $department;
        } else if ($keyword != '' && $department == 0 && $department == '') {
            $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=true&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com . '&filter_by[search]=' . $keyword;
        } else if ($keyword != '' && $department != 0 && $department != '') {
            $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[active]=true&off_set=' . $off_set . '&length=' . $rowperpage . '&id_com=' . $id_com . '&filter_by[department]=' . $department . '&filter_by[search]=' . $keyword;
        }
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $staff_active = json_decode($resp);
        curl_close($curl);
        $url =  urlFace();
        $num = $staff_active->data->totalItems;
        $page = $this->page($num, $segment, $url, $per_page);
        $data["links"] = $this->pagination->create_links();
        $data["keyword"] = $keyword;
        $data['notify'] = $this->notify();
        $data['staff_active'] = $staff_active->data->items;
        $this->load->view('manager/company/face', $data);
    }

    public function update_face()
    {
        $ep_id = (int)$this->input->post('ep_id');
        if ($ep_id != 0) {
            $curl     = curl_init();
            $data = array(
                'id_ep' => $ep_id
            );
            $token = $_SESSION['company']['token'];
            $header[]         = 'Authorization: ' . $token . '';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://chamcong.24hpay.vn/service/update_allow_update_face.php',
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            $face = json_decode($resp);
            curl_close($curl);
            $result = [
                'result' => true,
                'message' => 'Cấp quyền thành công',
            ];
            if ($face->error != null) {
                $result = [
                    'result' => false,
                    'message' => 'Cấp quyền thất bại',
                ];
            }
        }else{
            $result = [
                'result' => true,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        }
        echo json_encode($result);
    }
}
