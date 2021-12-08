<?php
class StaffModel extends CI_Model
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
    public function checkid($id_com)
    {
        $this->db->select('com_id');
        $this->db->from('company');
        $this->db->where('com_id', $id_com);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }
    public function checkemail($email)
    {
        $this->db->select('email');
        $this->db->from('staff');
        $this->db->where('email', $email);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }
    public function show_department()
    {
        $this->db->select('id_department,name_department');
        $this->db->where("index_department", 1);
        $fetched_records = $this->db->get('department');
        $com_small = $fetched_records->result_array();
        return $com_small;
    }
    // function show_position_m($id_parent){
    //     $this->db->select('id_position,name_position');
    //     $this->db->where('id_parent',$id_parent);
    //     $fetched_records = $this->db->get('position');
    //     $chucvu = $fetched_records->result_array();

    //     // Initialize Array with fetched data
    //     $data = array();
    //     foreach($chucvu as $cv){
    //        $data[] = array("id"=>$cv['id_position'], "text"=>$cv['name_position']);
    //     }
    //     echo json_encode($data);
    //  }

    public function insert_staff($data)
    {
        $this->db->insert('staff', $data);
        $name = $data['name_staff'];
        $otp = $data['otp'];
        $email = $data['email'];
        $body = file_get_contents('email_template/email.html');
        $body = str_replace('%name%', $name, $body);
        $body = str_replace('%otp%', $otp, $body);
        $title = "Xác thực tài khoản nhân viên";
        $this->SendMailAmazon($title, $name, $email, $body);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function checkotp($email, $otp)
    {
        $this->db->select('staff_id');
        $this->db->from('staff');
        $this->db->where('email', $email);
        $this->db->where('otp', $otp);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }
    public function upload_faceid($email, $img)
    {
        $this->db->set('face_id_img', $img);
        $this->db->where('email', $email);
        $this->db->update('staff');
        return true;
    }
    public function loginstaff($email, $pass)
    {
        $this->db->select('staff_id');
        $this->db->from('staff');
        $this->db->where('email', $email);
        $this->db->where('pass', MD5($pass));
        $result = $this->db->get()->row_array();
        return $result;
    }
    public function getpass($email,$otp)
    {
        $this->db->select('name_staff');
        $this->db->where('email', $email);
        $query_email = $this->db->get('staff');
        $query1 = $query_email->result_array();
        $name = ($query1[0]['name_staff']);

        $this->db->select('otp');
        $this->db->where('email', $email);
        $query_otp = $this->db->get('staff');
        $query2 = $query_otp->result_array();
        // $otp = ($query2[0]['otp']);

        $body = file_get_contents('email_template/email.html');
        $body = str_replace('%name%', $name, $body);
        $body = str_replace('%otp%', $otp, $body);
        $title = "Xác thực khoản nhân viên";
        $this->SendMailAmazon($title, $name, $email, $body);

        return $name;
    }
    public function getpass_updatepass($email, $pass)
    {
        $this->db->set('pass', $pass);
        $this->db->where('email', $email);
        $this->db->update('staff');
        return true;
    }
    public function show_info($id)
    {
        $this->db->select('staff_id,name_staff,company_id,com_name,position,verification,department,email,avatar,telephone,staff.created_at');
        $this->db->from('staff');
        $this->db->join('company', 'com_id = company_id');
        $this->db->where('staff_id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    public function show_info_by_Email($email)
    {
        $this->db->select('staff_id,name_staff,company_id,position,email,avatar,telephone,created_at');
        $this->db->from('staff');
        $this->db->where('email', $email);
        $query = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $query->row_array();
    }
    public function updateStaff($data, $id)
    {
        $this->db->update('staff', $data, $id);
        return true;
    }
    public function updatepass($id, $pass)
    {
        $this->db->set([
            'pass' => $pass,
        ]);
        $this->db->where('staff_id', $id);
        $this->db->update('staff');
        return true;
    }
    public function selectidcom($id)
    {
        $this->db->select('company_id');
        $this->db->from('staff');
        $this->db->where('staff_id', $id);
        $result = $this->db->get()->result_array();
        return $result;
    }
    public function select_com_name($com_id)
    {
        $this->db->select('com_name');
        $this->db->from('company');
        $this->db->where('com_id', $com_id);
        $result = $this->db->get()->result_array();
        return $result;
    }
    public function select_position_name($id_position)
    {
        $this->db->select('name_position');
        $this->db->from('position');
        $this->db->where('id_position', $id_position);
        $result = $this->db->get()->result_array();
        return $result;
    }
    public function update_time($id, $time_update)
    {
        $this->db->set([
            'update_at' => $time_update

        ]);
        $this->db->where('staff_id', $id);
        $this->db->update('staff');
        return true;
    }
    public function getListDepartment($id_company, $id_com_small)
    {
        $this->db->select('*');
        $this->db->from('department');
        $this->db->where('id_company', $id_company);
        $this->db->where('id_company_small', $id_com_small);
        $this->db->where("index_department", 1);
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function getListPosition()
    {
        $this->db->select('*');
        $this->db->from('position');
        $result = $this->db->get()->result_array();
        return $result;
    }
    public function checkPass($id, $pass)
    {
        $this->db->select('pass');
        $this->db->from('staff');
        $this->db->where('pass', $pass);
        $this->db->where('staff_id', $id);
        $result = $this->db->get()->result_array();
        return $result;
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

    public function evaluate($data)
    {
        $this->db->insert('evaluate', $data);
        return true;
    }

    public function listSchedule($staff_id, $key, $date_start, $date_end, $status)
    {
        $this->db->select("schedule.id,name,schedule_staff.staff_id,schedule_staff.status,note,date_start,date_end");
        $this->db->from("schedule_staff");
        $this->db->join("schedule", "schedule.id = schedule_staff.schedule_id");
        $this->db->where("schedule_staff.staff_id", $staff_id);
        $this->db->where("schedule_index", 1);
        $this->db->order_by('schedule.id', 'DESC');
        if ($date_start != "" && $date_end != "") {
            $this->db->group_start();
            $this->db->group_start();
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
        if ($status != '' && $status != 0) {
            $this->db->where("schedule_staff.status", $status);
        }
        if ($key != '' && $key != 0) {
            $this->db->like("name", $key);
        }
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }

    public function listPageSchedule($staff_id, $limit, $start, $key, $date_start, $date_end, $status)
    {
        $this->db->select("schedule.id,name,schedule_staff.staff_id,schedule_staff.status,note,date_start,date_end");
        $this->db->from("schedule_staff");
        $this->db->join("schedule", "schedule.id = schedule_staff.schedule_id");
        $this->db->where("schedule_staff.staff_id", $staff_id);
        $this->db->where("schedule_index", 1);
        if ($key != '') {
            $this->db->like("name", $key);
        }
        if ($date_start != "" && $date_end != "") {
            $this->db->group_start();
            $this->db->group_start();
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
        if ($status != '' && $status != 0) {
            $this->db->where("schedule_staff.status", $status);
        }
        $this->db->order_by('schedule.id', 'DESC');
        // if ($id_department != '' && $id_department != 0) {
        //     $this->db->where("department", $id_department);
        // }
        $this->db->limit($limit, $start);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result_array();
    }


    public function countJob($id,$key,$date_start,$date_end,$status)
    {
        $this->db->select('DISTINCT(job.job_id),job_name,job_address,cit_name');
        $this->db->from("job");
        $this->db->join("job_participants", "job.job_id = job_participants.job_id");
        $this->db->join("city2", 'job.job_district = city2.cit_id');
        $this->db->where("job_participants.staff_id", $id);
        $this->db->where("job_index", 1);

        if ($status != "" && $status != 0) {
            $this->db->where("job_participants.status", $status);
        }

        if ($key != "") {
            $this->db->like("job_name", $key);
        }

        if ($date_start != '' && $date_end != '') {
            $this->db->group_start();
            $this->db->group_start();
            $this->db->where('job_day_start', $date_start);
            $this->db->where('job_day_end', $date_end);
            $this->db->group_end();
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

        $this->db->order_by('job_participants.job_id', 'DESC');
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result_array();
    }

    public function showJob($id, $limit, $start,$key,$date_start,$date_end,$status)
    {
        $this->db->select('DISTINCT(job.job_id),job_name,job_address,job.status,job_district,job_day_start,job_day_end,job_time_in,job_time_out,cit_name,job_city');
        $this->db->from("job");
        $this->db->join("job_participants", "job.job_id = job_participants.job_id");
        $this->db->join("city2", 'job.job_district = city2.cit_id');
        $this->db->where("job_participants.staff_id", $id);
        $this->db->where("job_index", 1);

        if ($status != "" && $status != 0) {
            $this->db->where("job_participants.status", $status);
        }

        if ($key != "") {
            $this->db->like("job_name", $key);
        }

        if ($date_start != '' && $date_end != '') {
            $this->db->group_start();
            $this->db->group_start();
            $this->db->where('job_day_start', $date_start);
            $this->db->where('job_day_end', $date_end);
            $this->db->group_end();
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

        $this->db->order_by('job_participants.job_id', 'DESC');
        $this->db->limit($limit, $start);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result_array();
    }
    public function showJobPra()
    {
        $this->db->select('*');
        $this->db->from("job_participants");
        $data = $this->db->get();
        return $data->result_array();
    }

    public function detailJob($id,$job_id)
    {
        $this->db->select('DISTINCT(job.job_id),note,job_name,job_address,job_participants.status,job_district,job_day_start,job_day_end,job_time_in,job_time_out,cit_name,job_city');
        $this->db->from("job");
        $this->db->join("job_participants", "job.job_id = job_participants.job_id");
        $this->db->join("city2", 'job.job_district = city2.cit_id');
        $this->db->where("job_participants.staff_id", $id);
        $this->db->where("job_participants.job_id", $job_id);
        $this->db->where("job_index", 1);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->row_array();
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

    public function show_job_content($id_job,$staff_id)
    {
        $this->db->select('*');
        $this->db->from("job_content_staff");
        $this->db->join("job_content", "job_content_staff.id = job_content.content_staff_id");
        $this->db->where("job_content.job_id ", $id_job);
        $this->db->where("staff_id ", $staff_id );
        $data = $this->db->get();
        return $data->result_array();
    }

    public function update_job_content($data,$id)
    {
        $this->db->update('job_content',$data,$id);
        return true;
    }

    public function update_job_participants($data,$id)
    {
        $this->db->update('job_participants',$data,$id);
        return true;
    }

    public function update_job($data,$id)
    {
        $this->db->update('job',$data,$id);
        return true;
    }

    public function check($id_job, $staff_id)
    {
        $this->db->select('*');
        $this->db->from("job_content");
        $this->db->join('job_content_staff  ', 'job_content.content_staff_id = job_content_staff.id');
        $this->db->where("job_content.job_id ", $id_job);
        $this->db->where("job_content.staff_id", $staff_id);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result_array();
    }
    public function list_job_by_idCom($id_com)
    {
        $this->db->select('job_id,job_day_start,job_day_end,status');
        $this->db->from("job");
        $this->db->where("job_com_id", $id_com);
        $this->db->where("job_index", 1);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function check_job_participants($id_job){
        $this->db->select('status,job_id,staff_id');
        $this->db->from("job_participants");
        $this->db->where("job_id", $id_job);
        // $this->db->where("staff_id", $id_staff);
        // $this->db->where("job_index", 1);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function show_noti($id){
        $this->db->select('*');
        $this->db->from("notify");
        $this->db->where("notify_to_staff", $id);
        $this->db->order_by('id_notify', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
    }


    public function updateNotify($data,$id){
        $this->db->update('notify',$data,$id);
        return true;
    }

    public function list_schedule_by_idCom($id_com)
    {
        $this->db->select('id');
        $this->db->from("schedule");
        $this->db->where("schedule_index", 1);
        $this->db->where("com_id", $id_com);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function check_schedule($schedule_id, $staff_id)
    {
        $this->db->select('*');
        $this->db->from("schedule_place");
        // $this->db->join('schedule_staff  ', 'schedule_staff.schedule_id = schedule_place.schedule_id');
        $this->db->where("schedule_place.schedule_id ", $schedule_id);
        $this->db->where("schedule_place.staff_id", $staff_id);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function update_schedule_staff($data,$id){
        $this->db->update('schedule_staff',$data,$id);
        return true;
    }

    public function check_schedule_staff($id_job){
        $this->db->select('status,schedule_id,staff_id');
        $this->db->from("schedule_staff");
        $this->db->where("schedule_id", $id_job);
        // $this->db->where("staff_id", $id_staff);
        // $this->db->where("job_index", 1);
        $data = $this->db->get();
        return $data->result_array();
    }
    
    public function update_schedele($data,$id){
        $this->db->update('schedule',$data,$id);
        return true;
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

    public function show_time_sheet($id, $keyWord, $dateStart, $dateEnd)
    {
        $this->db->select('*');
        $this->db->from("staff");
        $this->db->join("time_sheets", "staff.staff_id = time_sheets.ep_id");
        $this->db->where("staff_id ", $id);
        if ($keyWord != '') {
            $this->db->like("staff.name_staff", $keyWord);
        }

        if ($dateStart != '' && $dateEnd != '') {
            $dateStart = date('Y-m-d', strtotime($dateStart)) . " 00:00:00";
            $dateEnd   = date('Y-m-d', strtotime($dateEnd)) . " 23:59:59";
            $this->db->where("at_time > ", $dateStart);
            $this->db->where("at_time < ", $dateEnd);
        }
        $this->db->order_by('sheet_id', 'DESC');
        $this->db->where("is_success", 1);
        $data = $this->db->get();
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

    public function insertNotify($data)
    {
        $this->db->insert('notify', $data);
        return true;
    }

    public function deleteNotiffy($data)
    {
        $this->db->delete('notify', $data);
        return true;
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
        return $data->row_array();
    }

    public function count_on_time_min($id, $staff_id, $time, $time_in, $time_out)
    {
        $time_begin = date('Y-m-d', strtotime($time)) . ' ' . date('H:i:s', $time_in);
        $time_end   = date('Y-m-d', strtotime($time)) . ' ' . date('H:i:s', $time_out);
        $gio_dau_ngay = date('Y-m-d', strtotime($time)) . " 00:00:00";

        $this->db->select('min(at_time) as in_shift');
        $this->db->from("time_sheets");
        $this->db->where("shift_id", $id);
        $this->db->where("ep_id", $staff_id);
        $this->db->where("at_time > ", $gio_dau_ngay);
        $this->db->where("at_time < ", $time_begin);
        $this->db->where("at_time < ", $time_end);
        $this->db->where("is_success", 1);
        $data = $this->db->get();
        return $data->row_array();
    }


    public function count_on_time_max($id, $staff_id, $time, $time_in, $time_out)
    {
        $time_begin = date('Y-m-d', strtotime($time)) . ' ' . date('H:i:s', $time_in);
        $time_end   = date('Y-m-d', strtotime($time)) . ' ' . date('H:i:s', $time_out);
        $gio_cuoi_ngay   = date('Y-m-d', strtotime($time)) . " 23:59:59";

        $this->db->select('max(at_time) as out_shift');
        $this->db->from("time_sheets");
        $this->db->where("shift_id", $id);
        $this->db->where("ep_id", $staff_id);
        $this->db->where("at_time >", $time_begin);
        $this->db->where("at_time > ", $time_end);
        $this->db->where("at_time < ", $gio_cuoi_ngay);
        $this->db->where("is_success", 1);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function count_timely_min($id, $staff_id, $time, $time_in){
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

    public function detail_shift_by_id($id){
        $this->db->select('*');
        $this->db->from("shifts");
        $this->db->where("id_shift", $id);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function create_job_note($data)
    {
        $this->db->insert('job_note', $data);
        return $this->db->insert_id();
    }
}
