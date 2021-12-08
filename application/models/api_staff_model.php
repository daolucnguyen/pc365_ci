<?php
class api_staff_model extends CI_Model
{
    public function SendMailAmazon($title, $name, $email, $body)
    {
        require "system/helpers/class.phpmailer.php";
        require "system/helpers/class.smtp.php";
        $usernameSmtp = 'AKIASP3FAETFWQKSULUF';
        $passwordSmtp = 'BCOYT02e1Y2OKZCwQAj5nV4HaNsijyt0e8SaB/Vl0nI9';
        $host         = 'email-smtp.ap-south-1.amazonaws.com';
        $port         = 587;
        $sender       = 'no-reply@timviec365.com.vn';
        $senderName   = 'Pc365.com';

        $mail = new PHPMailer(true);

        $mail->IsSMTP();
        $mail->SetFrom($sender, $senderName);
        $mail->Username   = $usernameSmtp; // khai bao dia chi email
        $mail->Password   = $passwordSmtp; // khai bao mat khau
        $mail->Host       = $host; // sever gui mail.
        $mail->Port       = $port; // cong gui mail de nguyen
        $mail->SMTPAuth   = true; // enable SMTP authentication
        $mail->SMTPSecure = "tls"; // sets the prefix to the servier
        $mail->CharSet    = "utf-8";
        $mail->SMTPDebug  = 0; // enables SMTP debug information (for testing)
        // xong phan cau hinh bat dau phan gui mail
        $mail->isHTML(true);
        $mail->Subject = $title; // tieu de email
        $mail->Body    = $body;
        $mail->addAddress($email, $name);

        if (!$mail->Send()) {
            echo $mail->ErrorInfo;
        }
    }
    public function getStaffByEmail($email)
    {
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('email', $email);
        $data = $this->db->get();
        return $data;
    }
    public function getStaffByEmailPass($data)
    {
        $email = $data['email'];
        $pass  = $data['password'];

        $this->db->select('staff_id,name_staff,email,pass,created_at,company_id');
        $this->db->from('staff');
        $this->db->where('email', $email);
        $this->db->where('pass', $pass);
        $data = $this->db->get();
        return $data;
    }
    public function getDepartmentById($com_id,$id)
    {
        $this->db->select('id_department,name_department');
        $this->db->where('id_company', $com_id);
        $this->db->where('id_department', $id);
        $data = $this->db->get('department')->row();
        return $data;
    }
    public function getDepartmentList($com_id)
    {
        $this->db->select('id_department,name_department');
        $this->db->where('id_company', $com_id);
        $data = $this->db->get('department')->result();
        return $data;
    }
    public function getPositionById($com_id,$id)
    {
        $this->db->select('id_position,name_position');
        $this->db->where('id_company', $com_id);
        $this->db->where('id_company', $id);
        $data = $this->db->get('position')->row();
        return $data;
    }
    public function getPositionList($com_id)
    {
        $this->db->select('id_position,name_position');
        $this->db->where('id_company', $com_id);
        $data = $this->db->get('position')->result();
        return $data;
    }
    public function getCompanyById($com_id)
    {
        $this->db->select('com_id,com_name');
        $this->db->where('com_id', $com_id);
        $data = $this->db->get('company')->row();
        return $data;
    }
    public function getCompanyList($com_id)
    {
        $this->db->select('com_id,com_name');
        $data = $this->db->get('company')->result();
        return $data;
    }

    public function insertStaff($data)
    {
        $this->db->insert('staff', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function updateStaff($data,$condition)
    {
        $this->db->update('staff', $data,$condition);
        return true;
    }
    public function checkOTP($staff_id, $otp)
    {
        $this->db->select('staff_id');
        $this->db->from('staff');
        $this->db->where('staff_id', $staff_id);
        $this->db->where('otp', $otp);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }
    public function checkMail($email)
    {
        $this->db->select('staff_id');
        $this->db->from('staff');
        $this->db->where('email', $email);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }
    public function verifyRegister($staff_id)
    {
        $this->db->set('verification', 1);
        $this->db->where('staff_id', $staff_id);
        $this->db->update('staff');
        return true;
    }
    public function changePass($data,$condition)
    {
        $this->db->update('staff', $data,$condition);
        return true;
    }
    
}
