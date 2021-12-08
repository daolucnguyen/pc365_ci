<?php
class Company_model extends CI_Model
{

    public function SendMailAmazon($title, $name, $email, $body)
    {
        require "system/helpers/class.phpmailer.php";
        require "system/helpers/class.smtp.php";
        $usernameSmtp = 'AKIASP3FAETFWQKSULUF';
        $passwordSmtp = 'BCOYT02e1Y2OKZCwQAj5nV4HaNsijyt0e8SaB/Vl0nI9';
        $host = 'email-smtp.ap-south-1.amazonaws.com';
        $port = 587;
        $sender = 'no-reply@timviec365.com.vn';
        $senderName = 'Pc365.com';

        $mail             = new PHPMailer(true);

        $mail->IsSMTP();
        $mail->SetFrom($sender, $senderName);
        $mail->Username   = $usernameSmtp;  // khai bao dia chi email
        $mail->Password   = $passwordSmtp;              // khai bao mat khau   
        $mail->Host       = $host;    // sever gui mail.
        $mail->Port       = $port;         // cong gui mail de nguyen 
        $mail->SMTPAuth   = true;    // enable SMTP authentication
        $mail->SMTPSecure = "tls";   // sets the prefix to the servier        
        $mail->CharSet  = "utf-8";
        $mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
        // xong phan cau hinh bat dau phan gui mail
        $mail->isHTML(true);
        $mail->Subject    = $title; // tieu de email 
        $mail->Body       = $body;
        $mail->addAddress($email, $name);


        if (!$mail->Send()) {
            echo $mail->ErrorInfo;
        }
    }
    public function signup_company($data)
    {
        $this->db->insert('company', $data);
        $com_id = $this->db->insert_id();
        $com_name = $data['com_name'];
        $com_otp = $data['com_otp'];
        $com_email = $data['com_email'];
        $body = file_get_contents('email_template/email.html');
        $body = str_replace('%name%', $com_name, $body);
        $body = str_replace('%otp%', $com_otp, $body);
        $title = "Xác thực tài khoản công ty";
        $this->SendMailAmazon($title, $com_name, $com_email, $body);
        return $com_id;
    }
    public function checkmail($email)
    {
        $this->db->select('com_email,com_active');
        $this->db->from('company');
        $this->db->where('com_email', $email);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }


    public function checkmailStaff($email)
    {
        $this->db->select('email,company_id');
        $this->db->from('staff');
        $this->db->where('email', $email);
        $this->db->group_start();
        $this->db->where('power', 1);
        $this->db->or_where('power', 2);
        $this->db->group_end();
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    public function checkmailSmall($email)
    {
        $this->db->select('email');
        $this->db->from('small_company');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $row = $query->row();
        return $row;
    }

    public function mail_small_com($email)
    {
        $this->db->select('email');
        $this->db->from('small_company');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $row = $query->row();
        // return $this->db->last_query();
        // die();
        if (count($row) == 0) {
            return true;
        } else {
            return false;
        }
    }

    // public function checkActive($id_company){
    //     $this->db->select("staff_id,name_staff,department,email,telephone,power");
    //     $this->db->from("staff");
    //     $this->db->where("company_id",$id_company);
    //     $this->db->where("active",0);
    //     $staff = $this->db->get()->result_array();
    //     return $staff;
    // }

    public function checkname($name)
    {
        $this->db->select('com_name');
        $this->db->from('company');
        $this->db->where('com_name', $name);
        $this->db->where('com_email !=', "");
        $query = $this->db->get();
        $row = $query->result();
        return $row;
    }
    public function verify_otp($data)
    {
        $this->db->select('com_id,com_otp');
        $this->db->from('company');
        $this->db->where('com_email', $data['com_email']);
        $this->db->where('com_otp', $data['com_otp']);
        $query = $this->db->get();
        $row = $query->row();
        if (count($row) == 0) {
            return false;
        } else {
            $this->db->where('com_email', $data['com_email']);
            $this->db->where('com_otp', $data['com_otp']);
            $this->db->update('company', ['com_active' => 1]);
            return true;
        }
    }
    public function show_otp($data)
    {
        $this->db->select('com_id,com_otp');
        $this->db->from('company');
        $this->db->where('com_email', $data['com_email']);
        $company = $this->db->get()->row_array();
        return $company;
    }
    public function reOtp($data)
    {
        $this->db->select('com_email,com_name');
        $this->db->from('company');
        $this->db->where("com_email", $data['email']);
        $company = $this->db->get();
        $row = $company->row();
        if (count($row) == 0) {
            return false;
        } else {
            $query = $company->result_array();
            $com_email = ($query[0]['com_email']);
            $com_name = ($query[0]['com_name']);
            $com_otp = $data['com_otp'];
            $this->db->where('com_email', $data['email']);
            $this->db->update('company', ['com_otp' => $com_otp]);

            $body = file_get_contents('email_template/email.html');
            $body = str_replace('%name%', $com_name, $body);
            $body = str_replace('%otp%', $com_otp, $body);
            $title = "Xác thực tài khoản công ty";
            $this->SendMailAmazon($title, $com_name, $com_email, $body);
            return true;
        }
    }

    public function quen_mat_khau_cty($email, $com_name, $OTP,$title)
    {
        $body = file_get_contents('email_template/email.html');
        $body = str_replace('%name%', $com_name, $body);
        $body = str_replace('%otp%', $OTP, $body);
        if ($title == '') {
            $title = "Xác thực tài khoản";
        }
        $this->SendMailAmazon($title, $com_name, $email, $body);
    }

    public function checkotp($email, $otp)
    {
        $this->db->select('com_id');
        $this->db->from('company');
        $this->db->where('com_email', $email);
        $this->db->where('com_otp', $otp);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function check_mail_nv($email)
    {
        $this->db->select('email');
        $this->db->from('staff');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $row = $query->row();
        return $row;
    }
    public function sign_up_complete($data)
    {
        $this->db->insert('staff', $data);
        $staff_id = $this->db->insert_id();
        return $staff_id;
    }
    public function login_company($data)
    {
        $email = $data['com_email'];
        $pass = $data['com_password'];
        $condition = [
            "com_email" => $email,
            "com_password" => $pass,
        ];
        $this->db->select("com_id,com_email,com_password,type_sign_up");
        $this->db->from("company");
        $this->db->where($condition);
        $qr = $this->db->get();
        $company = $qr->row_array();
        // return $this->db->last_query();
        // die();
        return $company;
    }

    public function login_Staff($data)
    {
        $email = $data['email'];
        $pass = $data['pass'];
        $condition = [
            "email" => $email,
            "pass" => $pass,
        ];
        $this->db->select("company_id");
        $this->db->from("staff");
        $this->db->where($condition);
        $qr = $this->db->get();
        $company = $qr->row_array();
        // return $this->db->last_query();
        // die();
        return $company;
    }

    public function login_company_small($data)
    {
        $email = $data['com_email'];
        $pass = $data['com_password'];
        $condition = [
            "email" => $email,
            "password" => $pass,
        ];
        $this->db->select("id_com,id_parent,email,password");
        $this->db->from("small_company");
        $this->db->where($condition);
        $qr = $this->db->get();
        $company = $qr->row_array();
        return $company;
    }
    public function manager()
    {
        // $this->base_url = $_POST['base_url'];
    }

    public function checkPass($pass, $id)
    {
        $this->db->select("*");
        $this->db->from("company");
        $this->db->where("com_password", $pass);
        $this->db->where("com_id", $id);
        $company = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $company->row_array();
    }

    public function changePassword($data, $id)
    {
        $this->db->update('company', $data, $id);
        return true;
    }

    public function infor_company($email)
    {
        $this->db->select("com_id,com_email,com_name,com_phone,com_address,com_avatar,created_at,type_sign_up");
        $this->db->where("com_email", $email);
        return $this->db->get("company")->row_array();
    }
    public function infor_companyById($id)
    {
        $this->db->select("com_id,com_email,com_name,com_phone,com_address,com_avatar,created_at,type_sign_up");
        $this->db->where("com_id", $id);
        return $this->db->get("company")->row_array();
    }
    public function infor_companySmall($id)
    {
        $this->db->select("id_com,id_parent,email,name_company,	telephone,address,logo_company,created_at");
        $this->db->where("id_com", $id);
        return $this->db->get("company")->row_array();
    }
    public function update_info_com($com_email)
    {
        $this->db->select("com_id,com_email,com_name,com_phone,com_address,com_avatar,created_at");
        $this->db->from("company");
        $this->db->where("com_email", $com_email);
        $db = $this->db->get()->row_array();
        return $db;
    }
    public function update_company($data, $id)
    {
        // $this->db->where("com_email",$com_email);
        // return $this->db->update("company", $data);
        $this->db->update("company", $data, $id);
        return true;
    }

    public function show_small_company($id_parent)
    {
        $this->db->select("*");
        $this->db->from("small_company");
        $this->db->where('id_parent', $id_parent);
        $company = $this->db->get();
        return $company;
    }
    public function add_small_company($data)
    {
        $this->db->insert('company', $data);
        $small_com_id = $this->db->insert_id();
        return $small_com_id;
    }

    public function updateComSmall($data, $id)
    {
        $this->db->update('company', $data, $id);
        return true;
    }
    // public function show_department($com_id)
    // {
    //     $this->db->select("id_department,id_company,name_department");
    //     $this->db->from('department');
    //     $this->db->where('id_company',$com_id);
    //     $company = $this->db->get()->result();
    //     return $company[0];
    // }
    // public function update_entry()
    // {
    //     $this->title    = $_POST['title'];
    //     $this->content  = $_POST['content'];
    //     $this->date     = time();

    //     $this->db->update('entries', $this, array('id' => $_POST['id']));
    // }


    // quang
    public function created_schedule_m($data)
    {
        $this->db->insert('schedule', $data);
        $schedule = $this->db->insert_id();
        return $schedule;
    }
    public function created_schedule_place_m($data)
    {
        $this->db->insert('schedule_place', $data);
        return true;
    }
    public function created_schedule_staff_m($data)
    {
        $this->db->insert('schedule_staff', $data);
        return true;
    }

    public function show_list_department($com_id, $id_small, $keyWord, $congty)
    {
        $this->db->select("id_department,name_department");
        $this->db->from("department");
        $this->db->where("index_department", 1);
        if ($congty != "" && $congty != 0) {
            $this->db->where("id_company", $congty);
        } else {
            $this->db->where("id_company", $com_id);
        }
        if ($keyWord != "") {
            $this->db->like("name_department", $keyWord);
        }
        $company = $this->db->get()->result_array();
        return $company;
    }
    public function page_list_department($com_id, $limit, $start, $keyWord, $congty)
    {
        $this->db->select("id_department,name_department");
        $this->db->from("department");
        $this->db->where("index_department", 1);
        if ($congty != "" && $congty != 0) {
            $this->db->where("id_company", $congty);
        } else {
            $this->db->where("id_company", $com_id);
        }
        if ($keyWord != "") {
            $this->db->like("name_department", $keyWord);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by('id_department', 'DESC');
        $company = $this->db->get()->result_array();
        return $company;
    }
    public function checkDepartment($com_id, $name_department, $id_department)
    {
        $this->db->select("id_department,name_department");
        $this->db->from("department");
        $this->db->where("id_company", $com_id);
        $this->db->where("index_department", 1);
        $this->db->where("name_department", $name_department);
        if ($id_department != 0 && $id_department != "") {
            $this->db->where("id_department !=", $id_department);
        }
        $company = $this->db->get()->result_array();
        // return $this->db->last_query();
        // die();
        return $company;
    }
    public function show_list_department_small($com_id)
    {
        $this->db->select("id_department,name_department");
        $this->db->from("department");
        $this->db->where("index_department", 1);
        $this->db->where('find_in_set("' . $com_id . '", id_company_small) <> 0');
        $company = $this->db->get()->result_array();
        return $company;
    }
    public function select_name_department($id)
    {
        $this->db->select("name_department");
        $this->db->from("department");
        $this->db->where("index_department", 1);
        $this->db->where("id_department", $id);
        $company = $this->db->get()->row_array();
        return $company;
    }
    public function insert_department($data)
    {
        $this->db->insert('department', $data);
        return true;
    }
    public function update_department_m($data, $id)
    {
        $this->db->update('department', $data, $id);
        return true;
    }
    public function delete_department_m($id_department)
    {
        $this->db->delete('department', array('id_department' => $id_department));
        return true;
    }

    public function select_com_id($email)
    {
        $this->db->select('com_id');
        $this->db->from('company');
        $this->db->where('com_email', $email);
        $result = $this->db->get()->result_array();
        return $result;
    }
    public function show_company_small($id_parent)
    {
        $this->db->select('com_id,com_name,com_phone,com_address,com_avatar');
        $this->db->where('com_parent', $id_parent);
        $this->db->where('com_email !=', "");
        $this->db->order_by('com_id', 'DESC');
        $fetched_records = $this->db->get('company');
        $com_small = $fetched_records->result_array();
        return $com_small;
    }
    public function countSmall($id_parent, $keyWord, $congty)
    {
        $this->db->select('com_id,com_name,com_phone,com_address,com_avatar');
        $this->db->where('com_parent', $id_parent);
        $this->db->where('com_email !=', "");
        if ($keyWord != "") {
            $this->db->like('com_name', $keyWord);
        }
        if ($congty != "") {
            $this->db->where('com_id', $congty);
        }
        $fetched_records = $this->db->get('company');
        $com_small = $fetched_records->result_array();
        return $com_small;
    }
    public function ds_cty_con($id_parent, $limit, $start, $keyWord, $congty)
    {
        $this->db->select('com_id,com_name,com_phone,com_address,com_avatar');
        $this->db->where('com_parent', $id_parent);
        $this->db->where('com_email !=', "");
        if ($keyWord != "") {
            $this->db->like('com_name', $keyWord);
        }
        if ($congty != "") {
            $this->db->where('com_id', $congty);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by('com_id', 'DESC');
        $fetched_records = $this->db->get('company');
        $com_small = $fetched_records->result_array();
        return $com_small;
    }

    public function show_department($id, $id_small)
    {
        $this->db->select('id_department,name_department');
        $this->db->where('id_company', $id);
        $this->db->where('id_company_small', $id_small);
        $this->db->where("index_department", 1);
        $fetched_records = $this->db->get('department');
        $com_small = $fetched_records->result_array();
        return $com_small;
    }
    public function show_position($id, $id_small)
    {
        $this->db->select('id_position,name_position');
        $fetched_records = $this->db->get('position');
        $com_small = $fetched_records->result_array();
        return $com_small;
    }
    public function show_role($id_parent)
    {
        $this->db->select('id,name');
        $this->db->from("role");
        $fetched_records = $this->db->get();
        $com_small = $fetched_records->result_array();
        return $com_small;
    }

    public function add_staff_m($data)
    {
        $this->db->insert('staff', $data);
        return true;
    }
    public function update_staff_m($data, $staff_id)
    {
        $this->db->update("staff", $data, $staff_id);
        return true;
    }

    public function show_staff_avtive($id_company, $limit, $start, $keyword, $department, $chiNhanh)
    {
        $this->db->select("staff_id,name_staff,department,email,telephone,power,active,avatar");
        $this->db->from("staff");
        $this->db->where("email !=", "");
        $this->db->where("active", 1);
        if ($keyword != '') {
            $this->db->like("staff.name_staff", $keyword);
        }
        if ($department != '') {
            $this->db->where("staff.department", $department);
        }
        if ($chiNhanh != '') {
            $this->db->where("staff.company_id", $chiNhanh);
        } else {
            $this->db->where("staff.company_id", $id_company);
        }
        $this->db->order_by('staff_id', 'DESC');
        $this->db->limit($limit, $start);
        $staff = $this->db->get()->result_array();
        return $staff;
    }
    public function count_avtive($id_company, $keyword, $department, $chiNhanh)
    {
        $this->db->select('*');
        $this->db->from("staff");
        $this->db->where("email !=", "");
        $this->db->where("staff.active", 1);
        if ($keyword != '') {
            $this->db->like("staff.name_staff", $keyword);
        }
        if ($department != '') {
            $this->db->where("staff.department", $department);
        }
        if ($chiNhanh != '') {
            $this->db->where("staff.company_id", $chiNhanh);
        } else {
            $this->db->where("staff.company_id", $id_company);
        }
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }

    public function count_staff($id_company, $keyWord, $chiNhanh, $phongBan, $quyen)
    {
        $this->db->select('staff_id,name_staff,avatar,email,telephone,power');
        $this->db->from("staff");
        $this->db->where("email !=", "");
        $this->db->where("staff.active", 1);
        if ($keyWord != '') {
            $this->db->like("staff.name_staff", $keyWord);
        }
        if ($phongBan != '' && $phongBan != 0) {
            $this->db->where("staff.department", $phongBan);
        }
        if ($quyen != '' && $quyen != 0) {
            $this->db->where("staff.power", $quyen);
        }
        if ($chiNhanh != '' && $chiNhanh != 0) {
            $this->db->where("staff.company_id", $chiNhanh);
        } else {
            $this->db->where("staff.company_id", $id_company);
        }
        $data = $this->db->get();
        return $data->result();
    }

    public function list_staff_excel($id, $key, $com, $depment, $type)
    {
        $this->db->select('*');
        $this->db->from("staff");
        $this->db->where("email !=", "");
        $this->db->where("staff.active", $type);
        if ($key != '') {
            $this->db->like("staff.name_staff", $key);
        }
        if ($depment != '') {
            $this->db->where("staff.department", $depment);
        }
        if ($com != '') {
            $this->db->where("staff.company_id", $com);
        } else {
            $this->db->where("staff.company_id", $id);
        }
        $this->db->order_by('staff_id', 'DESC');
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }

    public function show_staff($id_company, $limit, $start, $keyWord, $chiNhanh, $phongBan, $quyen)
    {
        $this->db->select("staff_id,name_staff,department,email,telephone,power,active,avatar");
        $this->db->from("staff");
        $this->db->where("email !=", "");
        $this->db->where("active", 1);
        if ($keyWord != '') {
            $this->db->like("staff.name_staff", $keyWord);
        }
        if ($phongBan != '') {
            $this->db->where("staff.department", $phongBan);
        }
        if ($quyen != '') {
            $this->db->where("staff.power", $quyen);
        }
        if ($chiNhanh != '' && $chiNhanh != 0) {
            $this->db->where("staff.company_id", $chiNhanh);
        } else {
            $this->db->where("staff.company_id", $id_company);
        }
        $this->db->order_by('staff_id', 'DESC');
        $this->db->limit($limit, $start);
        $staff = $this->db->get()->result_array();
        return $staff;
    }

    public function count_Noavtive($id_company, $keyword, $department, $chiNhanh)
    {
        $this->db->select('*');
        $this->db->from("staff");
        $this->db->where("email !=", "");
        $this->db->where("staff.active", 0);
        if ($keyword != '') {
            $this->db->like("staff.name_staff", $keyword);
        }
        if ($department != '') {
            $this->db->where("staff.department", $department);
        }
        if ($chiNhanh != '') {
            $this->db->where("staff.company_id", $chiNhanh);
        } else {
            $this->db->where("staff.company_id", $id_company);
        }
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }
    public function show_count_staff_avtive($id_company, $keyword, $department, $chiNhanh)
    {
        $this->db->select("*");
        $this->db->from("staff");
        if ($keyword != '') {
            $this->db->like("staff.name_staff", $keyword);
        }
        if ($department != '') {
            $this->db->where("staff.department", $department);
        }
        if ($chiNhanh != '') {
            $this->db->where("staff.company_id", $chiNhanh);
        } else {
            $this->db->where("staff.company_id", $id_company);
        }
        $this->db->where("email !=", "");
        $this->db->where("active", 1);
        $staff = $this->db->count_all_results();
        return $staff;
    }
    public function show_count_staff_no_avtive($id_company, $keyword, $department, $chiNhanh)
    {
        $this->db->select("staff_id");
        $this->db->from("staff");
        $this->db->where("email !=", "");
        if ($keyword != '') {
            $this->db->like("staff.name_staff", $keyword);
        }
        if ($department != '') {
            $this->db->where("staff.department", $department);
        }
        if ($chiNhanh != '') {
            $this->db->where("staff.company_id", $chiNhanh);
        } else {
            $this->db->where("staff.company_id", $id_company);
        }
        $this->db->where("active", 0);
        $staff = $this->db->count_all_results();
        return $staff;
    }
    public function show_staff_no_avtive($id_company, $limit, $start, $keyword, $department, $chiNhanh)
    {
        $this->db->select('*');
        $this->db->from("staff");
        $this->db->where("email !=", "");
        $this->db->where("staff.active", 0);
        if ($keyword != '') {
            $this->db->like("staff.name_staff", $keyword);
        }
        if ($department != '') {
            $this->db->where("staff.department", $department);
        }
        if ($chiNhanh != '') {
            $this->db->where("staff.company_id", $chiNhanh);
        } else {
            $this->db->where("staff.company_id", $id_company);
        }
        $this->db->order_by('staff_id', 'DESC');
        $this->db->limit($limit, $start);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function infoStaff($staff_id)
    {
        $this->db->select("*");
        $this->db->from("staff");
        $this->db->where("staff_id", $staff_id);
        $staff = $this->db->get()->row_array();
        return $staff;
    }
    public function activeStaff($active, $data)
    {
        $this->db->update('staff', $active, $data);
        return true;
    }

    public function deleteStaff($data)
    {
        $this->db->delete('staff', $data);
        return true;
    }

    public function searchStaff($id, $name, $active)
    {
        $this->db->select('*');
        $this->db->from("staff");
        $this->db->where("staff.company_id", $id);
        $this->db->where("email !=", "");
        $this->db->where("staff.id_small_company", 0);
        if ($active == 1) {
            $this->db->where("staff.active", 1);
        } else {
            $this->db->where("staff.active", 0);
        }
        if ($name != '') {
            $this->db->like("staff.name_staff", $name);
        }
        $this->db->order_by('staff_id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function list_companySmall($id)
    {
        $this->db->select('com_id,com_name');
        $this->db->from("company");
        $this->db->where("com_parent", $id);
        $this->db->order_by('com_id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function show_staff_by_department($id_department, $keyWord)
    {
        $this->db->select('staff_id,email,telephone,name_staff,avatar,name_department,position');
        $this->db->from("staff");
        $this->db->join("department", 'staff.department = department.id_department');
        $this->db->where("department", $id_department);
        $this->db->where("email !=", "");
        $this->db->where("active", 1);
        if ($keyWord != "") {
            $this->db->like("name_staff", $keyWord);
        }
        $this->db->order_by('staff_id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function show_page_staff_by_department($id_department, $limit, $start, $keyWord)
    {
        $this->db->select('staff_id,email,telephone,name_staff,avatar,name_department,position');
        $this->db->from("staff");
        $this->db->join("department", 'staff.department = department.id_department');
        $this->db->where("department", $id_department);
        $this->db->where("email !=", "");
        $this->db->where("active", 1);
        if ($keyWord != "") {
            $this->db->like("name_staff", $keyWord);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by('staff_id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }


    public function createSchedule($data)
    {
        $this->db->insert('schedule', $data);
        $schedule_id = $this->db->insert_id();
        return $schedule_id;
    }
    public function createSchedulePlace($data)
    {
        $this->db->insert('schedule_place', $data);
        return true;
    }
    public function createSchedulePlaceLatLong($data)
    {
        $this->db->insert('schedule_place_lat_long', $data);
        return $this->db->insert_id();
    }

    public function UpdateSchedule($data, $id)
    {
        $this->db->update('schedule', $data, $id);
        return true;
    }

    public function deletePlace($data)
    {
        $this->db->delete('schedule_place', $data);
        return true;
    }

    public function deleteScheduleStaff($data)
    {
        $this->db->delete('schedule_staff', $data);
        return true;
    }

    public function deleteSchedulelatlong($data)
    {
        $this->db->delete('schedule_place_lat_long', $data);
        return true;
    }

    public function createScheduleStaff($data)
    {
        $this->db->insert('schedule_staff', $data);
        return true;
    }

    public function count_schedule($id, $date_start, $date_end)
    {
        $this->db->select('id');
        $this->db->from("schedule");
        $this->db->where("schedule_index", 1);
        $this->db->where("com_id", $id);
        if ($date_start != '' && $date_end != '') {
            $this->db->group_start();
            $this->db->where('date_start', $date_start);
            $this->db->or_where('date_end', $date_end);
            $this->db->or_group_start();
            $this->db->where('date_start <=', $date_start);
            $this->db->where('date_end >=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('date_start >=', $date_start);
            $this->db->where('date_end <=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('date_start >=', $date_start);
            $this->db->where('date_start <=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('date_end >=', $date_start);
            $this->db->where('date_end <=', $date_end);
            $this->db->group_end();
            $this->db->group_end();
        }
        $data = $this->db->get();
        return $data->num_rows();
    }

    public function count_lich_trinh_nv($id, $id_small, $name, $date_start, $date_end, $cty, $phong_ban, $lich_trinh)
    {
        $this->db->select('schedule.id,name,date_start,date_end,note,schedule_staff.status,schedule_staff.staff_id');
        $this->db->from("schedule_staff");
        $this->db->join("schedule", 'schedule.id = schedule_staff.schedule_id');
        // $this->db->where("schedule.com_id", $id);
        $this->db->where("schedule_index", 1);

        if ($cty != '') {
            $this->db->where("schedule.com_id", $cty);
        } else {
            $this->db->where("schedule.com_id", $id);
        }

        if ($name != '') {
            $this->db->like("schedule.name", $name);
        }
        if ($lich_trinh != '' && $lich_trinh != 0) {
            $this->db->where("schedule_staff.schedule_id", $lich_trinh);
        }
        if ($date_start != '' && $date_end != '') {
            $this->db->group_start();
            $this->db->where('date_start', $date_start);
            $this->db->or_where('date_end', $date_end);
            $this->db->or_group_start();
            $this->db->where('date_start <=', $date_start);
            $this->db->where('date_end >=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('date_start >=', $date_start);
            $this->db->where('date_end <=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('date_start >=', $date_start);
            $this->db->where('date_start <=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('date_end >=', $date_start);
            $this->db->where('date_end <=', $date_end);
            $this->db->group_end();
            $this->db->group_end();
        }
        $this->db->order_by('schedule.id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }


    public function lich_trinh_nv($id, $id_small, $limit, $start, $name, $date_start, $date_end, $cty, $phong_ban, $lich_trinh)
    {
        $this->db->select('schedule.id,name,date_start,date_end,note,schedule_staff.status,schedule_staff.staff_id');
        $this->db->from("schedule_staff");
        $this->db->join("schedule", 'schedule.id = schedule_staff.schedule_id');
        $this->db->where("schedule_index", 1);

        if ($cty != '') {
            $this->db->where("schedule.com_id", $cty);
        } else {
            $this->db->where("schedule.com_id", $id);
        }

        if ($name != '') {
            $this->db->like("schedule.name", $name);
        }
        if ($lich_trinh != '' && $lich_trinh != 0) {
            $this->db->where("schedule_staff.schedule_id", $lich_trinh);
        }
        if ($date_start != '' && $date_end != '') {
            $this->db->group_start();
            $this->db->where('date_start', $date_start);
            $this->db->or_where('date_end', $date_end);
            $this->db->or_group_start();
            $this->db->where('date_start <=', $date_start);
            $this->db->where('date_end >=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('date_start >=', $date_start);
            $this->db->where('date_end <=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('date_start >=', $date_start);
            $this->db->where('date_start <=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('date_end >=', $date_start);
            $this->db->where('date_end <=', $date_end);
            $this->db->group_end();
            $this->db->group_end();
        }
        $this->db->limit($limit, $start);
        $this->db->order_by('schedule.id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function count_nv_cung_lich($id, $schduleId)
    {
        $this->db->select('schedule.id,name,date_start,date_end,note,schedule_staff.status,schedule_staff.staff_id');
        $this->db->from("schedule_staff");
        $this->db->join("schedule", 'schedule.id = schedule_staff.schedule_id');
        $this->db->where("schedule.com_id", $id);
        $this->db->where("schedule.id", $schduleId);
        $this->db->where("schedule_index", 1);
        $data = $this->db->get();
        return $data->result_array();
    }


    public function nv_cung_lich($id, $limit, $start, $schduleId)
    {
        $this->db->select('schedule.id,name,date_start,date_end,note,schedule_staff.status,schedule_staff.staff_id');
        $this->db->from("schedule_staff");
        $this->db->join("schedule", 'schedule.id = schedule_staff.schedule_id');
        $this->db->where("schedule.com_id", $id);
        $this->db->where("schedule.id", $schduleId);
        $this->db->where("schedule_index", 1);
        $this->db->limit($limit, $start);
        $this->db->order_by('schedule.id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function listSchedule($id, $id_small)
    {
        $this->db->select('id,name');
        $this->db->from("schedule");
        $this->db->where("schedule.com_id", $id);
        $this->db->where("schedule.com_small_id", $id_small);
        $this->db->where("schedule_index", 1);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function detailSchedule($id_sch)
    {
        $this->db->select('*');
        $this->db->from("schedule");
        $this->db->where("schedule.id", $id_sch);
        $this->db->where("schedule_index", 1);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function detailSchedulePlace($id_sch)
    {
        $this->db->select('*');
        $this->db->from("schedule_place_lat_long");
        $this->db->where("schedule_id", $id_sch);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getDepartment($id_sch)
    {
        $this->db->select('DISTINCT(department)');
        $this->db->from("schedule_staff");
        $this->db->join("staff", 'staff.staff_id = schedule_staff.staff_id');
        $this->db->where("schedule_id", $id_sch);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getDepartmentByJob($id)
    {
        $this->db->select('DISTINCT(department)');
        $this->db->from("job_participants");
        $this->db->join("staff", 'staff.staff_id = job_participants.staff_id');
        $this->db->where("job_id", $id);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function listDeparment($id, $id_small)
    {
        $this->db->select('*');
        $this->db->from("department");
        $this->db->where("id_company", $id);
        $this->db->where("id_company_small", $id_small);
        $this->db->where("index_department", 1);
        $data = $this->db->get();
        return $data->result_array();
    }


    public function listScheduleStaff($id_sch)
    {
        $this->db->select('*');
        $this->db->from("schedule_staff");
        $this->db->where("schedule_id", $id_sch);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function listStaffByJob($id)
    {
        $this->db->select('*');
        $this->db->from("job_participants");
        $this->db->where("job_id", $id);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function show_city()
    {
        $this->db->select('cit_id,cit_name');
        $this->db->from("city");
        $data = $this->db->get();
        return $data->result_array();
    }

    public function showDistrict($cit_id)
    {
        $this->db->select('cit_id,cit_name');
        $this->db->from("city2");
        $this->db->where("cit_parent", $cit_id);
        $data = $this->db->get();
        return $data->result_array();
    }
    public function create_job($data)
    {
        $this->db->insert('job', $data);
        return $this->db->insert_id();
    }

    public function createJobPar($data)
    {
        $this->db->insert('job_participants', $data);
        return true;
    }

    public function createJobContent($data)
    {
        $this->db->insert('job_content', $data);
        return true;
    }

    public function createJobContentStaff($data)
    {
        $this->db->insert('job_content_staff', $data);
        return $this->db->insert_id();
    }

    public function countJob($id, $name, $date_start, $date_end, $id_department, $status)
    {
        $this->db->select('DISTINCT(job.job_id)');
        $this->db->from("job");
        $this->db->join("job_participants", "job.job_id = job_participants.job_id");
        // $this->db->join("staff", "staff.staff_id = job_participants.staff_id");
        $this->db->join("city2", 'job.job_district = city2.cit_id');
        $this->db->where("job_com_id", $id);
        $this->db->where("job_index", 1);
        // if ($id_department != "" && $id_department != 0) {
        //     $this->db->where("department", $id_department);
        // }
        if ($name != "") {
            $this->db->like("job_name", $name);
        }
        if ($status != "" && $status != 0) {
            $this->db->where("job.status", $status);
        }
        if ($date_start != '' && $date_end != '') {
            $this->db->group_start();
            $this->db->where('job_day_start', $date_start);
            $this->db->or_where('job_day_end', $date_end);
            $this->db->or_group_start();
            $this->db->where('job_day_start <=', $date_start);
            $this->db->where('job_day_end >=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('job_day_start >=', $date_start);
            $this->db->where('job_day_end <=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('job_day_start >=', $date_start);
            $this->db->where('job_day_start <=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('job_day_end >=', $date_start);
            $this->db->where('job_day_end <=', $date_end);
            $this->db->group_end();
            $this->db->group_end();
        }
        $this->db->order_by('job_id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function showJob($id, $limit, $start, $name, $date_start, $date_end, $id_department, $status)
    {
        $this->db->select('DISTINCT(job.job_id),job_name,job_address,job.status,job_district,job_day_start,job_day_end,job_time_in,job_time_out,cit_name,job_city');
        $this->db->from("job");
        $this->db->join("job_participants", "job.job_id = job_participants.job_id");
        // $this->db->join("staff", "staff.staff_id = job_participants.staff_id");
        $this->db->join("city2", 'job.job_district = city2.cit_id');
        $this->db->where("job_com_id", $id);
        $this->db->where("job_index", 1);
        // if ($id_department != "" && $id_department != 0) {
        //     $this->db->where("department", $id_department);
        // }
        if ($status != "" && $status != 0) {
            $this->db->where("job.status", $status);
        }
        if ($name != "") {
            $this->db->like("job_name", $name);
        }
        if ($date_start != '' && $date_end != '') {
            $this->db->group_start();
            $this->db->where('job_day_start', $date_start);
            $this->db->or_where('job_day_end', $date_end);
            $this->db->or_group_start();
            $this->db->where('job_day_start <=', $date_start);
            $this->db->where('job_day_end >=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('job_day_start >=', $date_start);
            $this->db->where('job_day_end <=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('job_day_start >=', $date_start);
            $this->db->where('job_day_start <=', $date_end);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('job_day_end >=', $date_start);
            $this->db->where('job_day_end <=', $date_end);
            $this->db->group_end();
            $this->db->group_end();
        }
        $this->db->order_by('job_id', 'DESC');
        $this->db->limit($limit, $start);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result_array();
    }

    public function showJobPra()
    {
        $this->db->select('staff_id,job_id');
        $this->db->from("job_participants");
        $data = $this->db->get();
        return $data->result_array();
    }

    public function showJobPraByIdJob($id)
    {
        $this->db->select('staff_id,job_id');
        $this->db->from("job_participants");
        $this->db->where('job_id ', $id);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getJobNote($job_id)
    {
        $this->db->select('*');
        $this->db->from("job_note");
        $this->db->where('job_id', $job_id);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function infoJob($id_job)
    {
        $this->db->select('job_id,job_com_id,job_staff_admin_id,time_notify,note,job_name,job_address,job_district,job_day_start,job_day_end,job_time_in,job_time_out,cit_name,job_city');
        $this->db->from("job");
        $this->db->join("city2", 'job.job_district = city2.cit_id');
        $this->db->where("job_id", $id_job);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->row_array();
    }

    public function show_job_content($id_job)
    {
        $this->db->select('*');
        $this->db->from("job_content_staff");
        $this->db->where("job_id", $id_job);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result_array();
    }


    public function job_content()
    {
        $this->db->select('*');
        $this->db->from("job_content");
        $data = $this->db->get();
        return $data->result_array();
    }

    public function list_job_by_idCom($id_com)
    {
        $this->db->select('job_id');
        $this->db->from("job");
        $this->db->where("job_com_id", $id_com);
        $this->db->where("job_index", 1);
        $data = $this->db->get();
        return $data->result_array();
    }
    public function job_content_by_jobId($id_job)
    {
        $this->db->select('*');
        $this->db->from("job_content");
        $this->db->where("job_id", $id_job);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function check($id_job, $staff_id)
    {
        $this->db->select('*');
        $this->db->from("job_content");
        $this->db->join('job_content_staff  ', 'job_content.content_staff_id = job_content_staff.id');
        $this->db->where("job_content.job_id ", $id_job);
        $this->db->where("job_content.staff_id", $staff_id);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function updatejob($data, $condition)
    {
        $this->db->update('job', $data, $condition);
        return true;
    }
    public function update_job_content($data, $id)
    {
        $this->db->update('job_content', $data, $id);
        return true;
    }

    public function job_participants($data, $id)
    {
        $this->db->update('job_participants', $data, $id);
        return true;
    }

    public function deleteJobPar($data)
    {
        $this->db->delete('job_participants', $data);
        return true;
    }


    public function deleteJobContent($data)
    {
        $this->db->delete('job_content', $data);
        return true;
    }

    public function deleteJobContentStaff($data)
    {
        $this->db->delete('job_content_staff', $data);
        return true;
    }

    public function config($id)
    {
        $this->db->select('*');
        $this->db->from("config");
        $this->db->where("com_id", $id);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function config_wifi()
    {
        $this->db->select('*');
        $this->db->from("config_wifi");
        $data = $this->db->get();
        return $data->result_array();
    }

    public function config_lat_long()
    {
        $this->db->select('*');
        $this->db->from("config_lat_long");
        $data = $this->db->get();
        return $data->result_array();
    }

    public function createConfig($data)
    {
        $this->db->insert('config', $data);
        return true;
    }

    public function createConfigWifi($data)
    {
        $this->db->insert('config_wifi', $data);
        return $this->db->insert_id();
    }

    public function createConfigLatLong($data)
    {
        $this->db->insert('config_lat_long', $data);
        return $this->db->insert_id();
    }

    public function deleteConfigWifi($data)
    {
        $this->db->delete('config_wifi', $data);
        return true;
    }

    public function deleteConfigLatLong($data)
    {
        $this->db->delete('config_lat_long', $data);
        return true;
    }

    public function updateConfig($data, $id)
    {
        $this->db->update('config', $data, $id);
        return true;
    }

    public function count_ds_ca_lam($id, $com, $keyWord)
    {
        $this->db->select('*');
        $this->db->from("shifts");
        $this->db->where('index_shift', 1);
        if ($com != '' && $com != 0) {
            $this->db->where("id_com", $com);
        } else {
            $this->db->where("id_com", $id);
        }
        if ($keyWord != '') {
            $this->db->like("name_shift", $keyWord);
        }
        $data = $this->db->get();
        return $data->result_array();
    }

    public function ds_ca_lam($id, $limit, $start, $com, $keyWord)
    {
        $this->db->select('*');
        $this->db->from("shifts");
        $this->db->where('index_shift', 1);
        if ($com != '' && $com != 0) {
            $this->db->where("id_com", $com);
        } else {
            $this->db->where("id_com", $id);
        }
        if ($keyWord != '') {
            $this->db->like("name_shift", $keyWord);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by('id_shift', "DESC");
        $data = $this->db->get();
        return $data->result_array();
    }

    public function detail_shift($id_shift)
    {
        $this->db->select('*');
        $this->db->from("shifts");
        $this->db->where('index_shift', 1);
        $this->db->where("id_shift", $id_shift);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function list_shift($id)
    {
        $this->db->select('*');
        $this->db->from("shifts");
        $this->db->where('index_shift', 1);
        $this->db->where("id_com", $id);
        $this->db->order_by('id_shift', "DESC");
        $data = $this->db->get();
        return $data->result_array();
    }

    public function checkNameShift($name, $id_com, $id_shift)
    {
        $this->db->select('*');
        $this->db->from("shifts");
        $this->db->where("name_shift", $name);
        $this->db->where('index_shift', 1);
        $this->db->where("id_com", $id_com);
        if ($id_shift != "" && $id_shift != 0) {
            $this->db->where("id_shift !=", $id_shift);
        }
        $data = $this->db->get();
        return $data->result();
    }

    public function create_shift($data)
    {
        $this->db->insert('shifts', $data);
        return true;
    }
    public function upadte_shift($data, $id)
    {
        $this->db->update('shifts', $data, $id);
        return true;
    }

    public function evaluate($data)
    {
        $this->db->insert('evaluate', $data);
        return true;
    }

    public function error($data_insert)
    {
        $this->db->insert('notify_error', $data_insert);
        return $this->db->insert_id();
    }

    public function error_images($data_insert)
    {
        $this->db->insert('error_images', $data_insert);
        return true;
    }

    public function countCalendarStaff($id, $keyWord, $id_calendar)
    {
        $name = "";
        if ($keyWord != '' && $keyWord != 0) {
            $name = ' AND name_staff LIKE "%' . $keyWord . '%"';
        }
        $date = "";
        if ($id_calendar != '' && $id_calendar != 0) {
            $date = ' AND calendar.id = ' . $id_calendar;
        }
        $sql = 'SELECT * FROM `calendar_staff` JOIN `staff` ON `FIND_IN_SET`(staff.staff_id,calendar_staff.staff_id) JOIN `calendar` ON `calendar`.`id`=`calendar_staff`.`calendar_id` WHERE index_calendar = 1 AND `calendar`.`id_company` = ' . $id . $name . $date;
        return $this->db->query($sql)->result_array();
    }

    public function listCalendarStaff($id, $limit, $start, $keyWord, $id_calendar)
    {
        $name = "";
        if ($keyWord != '') {
            $name = ' AND name_staff LIKE "%' . $keyWord . '%"';
        }
        $date = "";
        if ($id_calendar != '') {
            $date = ' AND calendar.id = ' . $id_calendar;
        }
        $sql = 'SELECT calendar.id,staff.staff_id,staff.name_staff,avatar,department,calendar.month,name_calendar FROM `calendar_staff` JOIN `staff` ON `FIND_IN_SET`(staff.staff_id,calendar_staff.staff_id) JOIN `calendar` ON `calendar`.`id`=`calendar_staff`.`calendar_id` WHERE index_calendar = 1 AND `calendar`.`id_company` = ' . $id . $name . $date . ' ORDER BY calendar_staff.id DESC LIMIT ' . $start . ',' . $limit;
        return $this->db->query($sql)->result_array();
        // return $sql;
    }

    public function show_staff_by_department_calendar($id_calendar)
    {
        $sql = 'SELECT * FROM `calendar_staff` JOIN `staff` ON `FIND_IN_SET`(staff.staff_id,calendar_staff.staff_id) JOIN `calendar` ON `calendar`.`id`=`calendar_staff`.`calendar_id` WHERE calendar_id = ' . $id_calendar . ' AND index_calendar = 1';
        return $this->db->query($sql)->result_array();
    }

    public function listMonth($id)
    {
        $this->db->select('id,month,name_calendar');
        $this->db->from('calendar');
        $this->db->where('calendar_parent', 0);
        $this->db->where('id_company', $id);
        $this->db->where('index_calendar', 1);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function createCalendar($data)
    {
        $this->db->insert('calendar', $data);
        return $this->db->insert_id();
    }

    public function createCalendarStaff($data)
    {
        $this->db->insert('calendar_staff', $data);
        return true;
    }

    public function count_calendar($id, $key, $search_date)
    {
        $this->db->select('calendar.id,month');
        $this->db->from('calendar');
        $this->db->join('calendar_staff', 'calendar_staff.calendar_id = calendar.id');
        $this->db->where('calendar_parent', 0);
        $this->db->where('index_calendar', 1);
        if ($key != '') {
            $this->db->like('name_calendar', $key);
        }
        if ($search_date != '') {
            $this->db->where('date', $search_date);
        }
        $this->db->where('id_company', $id);
        $data = $this->db->get();
        return $this->db->last_query();
        die();
        return $data->result_array();
    }

    public function show_list_calendar($id, $limt, $start, $key, $search_date)
    {
        $this->db->select('calendar.id,month,staff_id,id_shift,name_calendar');
        $this->db->from('calendar');
        $this->db->join('calendar_staff', 'calendar_staff.calendar_id = calendar.id');
        $this->db->where('calendar_parent', 0);
        $this->db->where('id_company', $id);
        $this->db->where('index_calendar', 1);
        if ($key != '') {
            $this->db->like('name_calendar', $key);
        }
        if ($search_date != '') {
            $this->db->where('date', $search_date);
        }
        $this->db->order_by('calendar.id', 'DESC');
        $this->db->limit($limt, $start);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function detail_calendar($id)
    {
        $this->db->select('*');
        $this->db->from('calendar');
        $this->db->where('index_calendar', 1);
        $this->db->where('id', $id);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function detailCalendarStaff($id)
    {
        $this->db->select('*');
        $this->db->from('calendar_staff');
        $this->db->where('calendar_id', $id);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function updateCalendarStaff($data, $id)
    {
        $this->db->update('calendar_staff', $data, $id);
        return true;
    }

    public function updateCalendar($data, $id)
    {
        $this->db->update('calendar', $data, $id);
        return true;
    }

    public function list_staff($id_company)
    {
        $this->db->select("staff_id");
        $this->db->from("staff");
        $this->db->where("email !=", "");
        $this->db->where("active", 1);
        $this->db->where("staff.company_id", $id_company);
        $staff = $this->db->get()->result_array();
        return $staff;
    }
    public function insertNotify($data)
    {
        $this->db->insert('notify', $data);
        return true;
    }

    public function show_noti($id)
    {
        $this->db->select('*');
        $this->db->from("notify");
        $this->db->where("notify_to_company", $id);
        $this->db->order_by('id_notify', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }
    public function updateNotify($data, $id)
    {
        $this->db->update('notify', $data, $id);
        return true;
    }

    public function deleteNotiffy($data)
    {
        $this->db->delete('notify', $data);
        return true;
    }

    public function count_time_sheet($id)
    {
        $this->db->select('DISTINCT(staff_id)');
        $this->db->from("staff");
        $this->db->join("time_sheets", "staff.staff_id = time_sheets.ep_id");
        $this->db->where("staff.company_id", $id);
        $this->db->order_by('sheet_id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function show_time_sheet($id, $keyWord, $dateStart, $dateEnd, $com_id, $department)
    {
        $this->db->select('*');
        $this->db->from("staff");
        $this->db->join("time_sheets", "staff.staff_id = time_sheets.ep_id");
        if ($com_id != 0 && $com_id != '') {
            $this->db->where("staff.company_id", $com_id);
        } else {
            $this->db->where("staff.company_id", $id);
        }

        if ($keyWord != '') {
            $this->db->like("staff.name_staff", $keyWord);
        }

        if ($dateStart != '' && $dateEnd != '') {
            $dateStart = date('Y-m-d', strtotime($dateStart)) . " 00:00:00";
            $dateEnd   = date('Y-m-d', strtotime($dateEnd)) . " 23:59:59";
            $this->db->where("at_time > ", $dateStart);
            $this->db->where("at_time < ", $dateEnd);
        }

        if ($department != 0 && $department != '') {
            $this->db->where("staff.department", $department);
        }
        $this->db->order_by('sheet_id', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function show_time_by_id()
    {
        $this->db->select('sheet_id,at_time');
        $this->db->from("time_sheets");
        $data = $this->db->get();
        $this->db->where("is_success", 1);
        return $data->result_array();
    }

    public function show_sheet_by_id_shift_min($id, $staff_id, $time)
    {
        $time_begin = date('Y-m-d', strtotime($time)) . " 00:00:00";
        $time_end   = date('Y-m-d', strtotime($time)) . " 23:59:59";

        $this->db->select('min(at_time) as in_shift');
        $this->db->from("time_sheets");
        $this->db->where("shift_id", $id);
        $this->db->where("ep_id", $staff_id);
        $this->db->where("at_time > ", $time_begin);
        $this->db->where("at_time < ", $time_end);
        $this->db->where("is_success", 1);
        $data = $this->db->get();
        return $data->row_array();
    }


    public function show_sheet_by_id_shift_max($id, $staff_id, $time)
    {
        $time_begin = date('Y-m-d', strtotime($time)) . " 00:00:00";
        $time_end   = date('Y-m-d', strtotime($time)) . " 23:59:59";

        $this->db->select('max(at_time) as out_shift');
        $this->db->from("time_sheets");
        $this->db->where("shift_id", $id);
        $this->db->where("ep_id", $staff_id);
        $this->db->where("at_time > ", $time_begin);
        $this->db->where("at_time < ", $time_end);
        $this->db->where("is_success", 1);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function count_sheet_by_id_shift_min($id, $staff_id, $time, $time_in, $time_out)
    {
        $time_begin = date('Y-m-d', strtotime($time)) . ' ' . date('H:i:s', $time_in);
        $time_end   = date('Y-m-d', strtotime($time)) . ' ' . date('H:i:s', $time_out);

        $this->db->select('min(at_time) as in_shift');
        $this->db->from("time_sheets");
        $this->db->where("shift_id", $id);
        $this->db->where("ep_id", $staff_id);
        $this->db->where("at_time > ", $time_begin);
        $this->db->where("at_time < ", $time_end);
        $this->db->where("is_success", 1);
        $data = $this->db->get();
        return $data->row_array();
    }


    public function count_sheet_by_id_shift_max($id, $staff_id, $time, $time_in, $time_out)
    {
        $time_begin = date('Y-m-d', strtotime($time)) . ' ' . date('H:i:s', $time_in);
        $time_end   = date('Y-m-d', strtotime($time)) . ' ' . date('H:i:s', $time_out);

        $this->db->select('max(at_time) as out_shift');
        $this->db->from("time_sheets");
        $this->db->where("shift_id", $id);
        $this->db->where("ep_id", $staff_id);
        $this->db->where("at_time > ", $time_begin);
        $this->db->where("at_time < ", $time_end);
        $this->db->where("is_success", 1);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->row_array();
    }

    public function count_timely_min($id, $staff_id, $time, $time_in)
    {
        $time_begin = date('Y-m-d', strtotime($time)) . ' ' . date('H:i:s', $time_in);

        $this->db->select('min(at_time) as timely_min');
        $this->db->from("time_sheets");
        $this->db->where("shift_id", $id);
        $this->db->where("ep_id", $staff_id);
        $this->db->where("at_time > ", $time_begin);
        $this->db->where("is_success", 1);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->row_array();
    }

    public function signup_consultation($data)
    {
        $this->db->insert('signup_consultation', $data);
        return true;
    }

    public function getStatusJob($id){
        $this->db->select('job_id,job_day_start,job_day_end,status');
        $this->db->from("job");
        $this->db->where("job_index", 1);
        $this->db->where("job_com_id", $id);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getShiftByCalendar($id_calendar){
        $this->db->select('DISTINCT(id_shift)');
        $this->db->from("calendar");
        $this->db->where("calendar_parent", $id_calendar);
        $this->db->where("id_shift !=", '');
        $data = $this->db->get();
        return $data->result_array();
    }

    public function getListJobToday($time,$time_end){
        $this->db->select('job_id,job_day_start,job_day_end');
        $this->db->from("job");
        $this->db->where("job_day_start", $time);
        $this->db->where("job_day_end", $time_end);
        $this->db->or_where("job_index", 1);
        $data = $this->db->get();
        return $data->result_array();
    }
}
