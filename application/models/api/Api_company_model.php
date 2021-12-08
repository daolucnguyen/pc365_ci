<?php
class api_company_model extends CI_Model
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
    // public function getComByEmail($email)
    // {
    //     $this->db->select('*');
    //     $this->db->from('staff');
    //     $this->db->where('email', $email);
    //     $this->db->where('staff.active',1);
    //     $this->db->order_by('staff_id', 'DESC');
    //     $data = $this->db->get();
    //     // return $this->db->last_query();
    //     // die();
    //     return $data;
    // }

    public function getComByid($email)
    {
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('staff_id', $email);
        $this->db->where('staff.active', 1);
        $this->db->order_by('staff_id', 'DESC');
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data;
    }
    public function getComByEmailPass($data)
    {
        $email = $data['email'];
        $pass  = $data['password'];

        $this->db->select('com_id,com_name,com_email,com_password,created_at,com_active,com_phone,type_sign_up');
        $this->db->from('company');
        $this->db->where('com_email', $email);
        $this->db->where('com_email !=', "");
        $this->db->where('com_password', $pass);
        $data = $this->db->get();
        return $data->result_array();
    }
    public function checkmailStaffLogin($data)
    {
        $email = $data['email'];
        $pass  = $data['password'];

        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('email', $email);
        $this->db->where('pass', $pass);
        $this->db->group_start();
        $this->db->where('power', 1);
        $this->db->or_where('power', 2);
        $this->db->group_end();
        $data = $this->db->get();
        return $data->result_array();
    }
    public function getComByEmailPassSmall($data)
    {
        $email = $data['email'];
        $pass  = $data['password'];

        $this->db->select('*');
        $this->db->from('small_company');
        $this->db->where('email', $email);
        $this->db->where('password', $pass);
        $data = $this->db->get();
        return $data->result_array();
    }
    public function insertCompany($data)
    {
        $this->db->insert('company', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function updateCompany($data, $condition)
    {
        $this->db->update('company', $data, $condition);
        return true;
    }
    public function updateCompanySmall($data, $condition)
    {
        $this->db->update('small_company', $data, $condition);
        return true;
    }
    public function checkMail($email)
    {
        $this->db->select('com_id');
        $this->db->from('company');
        $this->db->where('com_email', $email);
        $this->db->where('com_email !=', "");
        $num_results = $this->db->count_all_results();
        return $num_results;
    }
    public function checkName($alias)
    {
        $this->db->select('*');
        $this->db->from('company');
        $this->db->where('com_alias', $alias);
        $this->db->where('com_email !=', "");
        $num_results = $this->db->count_all_results();
        return $num_results;
    }
    public function ComEmail($email)
    {
        $this->db->select('*');
        $this->db->from('company');
        $this->db->where('com_email', $email);
        $this->db->where('com_email !=', "");
        $data = $this->db->get();
        return $data->result_array();
    }
    public function checkMailSmall($email)
    {
        $this->db->select('*');
        $this->db->from('small_company');
        $this->db->where('email', $email);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    public function checkMailStaff($email, $company_id)
    {
        $this->db->select('company_id');
        $this->db->from('staff');
        $this->db->where('email', $email);
        $this->db->where('company_id', $company_id);
        $this->db->where('staff.active', 1);
        $this->db->order_by('staff_id', 'DESC');
        $num_results = $this->db->count_all_results();
        // return $this->db->last_query();
        // die();
        return $num_results;
    }

    public function checkAlias($alias)
    {
        $this->db->select('com_id');
        $this->db->from('company');
        $this->db->where('com_alias', $alias);
        $this->db->where('com_email !=', "");
        $num_results = $this->db->count_all_results();
        return $num_results;
    }
    public function checkOTP($com_id, $otp)
    {
        $this->db->select('com_id');
        $this->db->from('company');
        $this->db->where('com_id', $com_id);
        $this->db->where('com_email !=', "");
        $this->db->where('com_otp', $otp);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }
    public function verifyRegister($com_id)
    {
        $this->db->set('com_active', 1);
        $this->db->where('com_id', $com_id);
        $this->db->update('company');
        return true;
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
    public function createScheduleStaff($data)
    {
        $this->db->insert('schedule_staff', $data);
        return true;
    }
    public function createSchedulePlaceLatLong($data)
    {
        $this->db->insert('schedule_place_lat_long', $data);
        return $this->db->insert_id();
    }
    public function getSmallCompanyList($data)
    {
        $query = $this->db->get_where('company', $data)->result();
        $this->db->where('com_email !=', "");
        return $query;
    }
    public function createDepartment($data)
    {
        $this->db->insert('department', $data);
        return true;
    }
    public function getDepartmentByCompanyId($id, $id_small)
    {
        $this->db->select('*');
        $this->db->from('department');
        $this->db->where("id_company", $id);
        $this->db->order_by("id_department", 'DESC');
        $query = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $query->result();
    }

    public function getPositionByCompanyId($id, $id_small)
    {
        $this->db->select('*');
        $this->db->from('position');
        $query = $this->db->get();
        return $query->result();
    }

    public function checkSmallCompany($data)
    {
        $query = $this->db->get_where('small_company', $data)->num_rows();
        return $query;
    }
    public function createStaff($data)
    {
        $this->db->insert('staff', $data);
        return true;
        // return insert_id();
    }

    public function updateStaff($data, $condition)
    {
        $this->db->update('staff', $data, $condition);
        return true;
    }

    public function searchJob($job_com_id, $department, $status, $date_staff, $date_end, $name_job)
    {
        // $this->db->distinct("");
        $this->db->select('DISTINCT(job_participants.job_id),job_com_id,job_name,job_city,job_district,job_address,job_day_start,job_day_end,job.status');
        $this->db->from('job');
        $this->db->join('job_participants', 'job_participants.job_id = job.job_id');
        // $this->db->join('staff', 'job_participants.staff_id = staff.staff_id');
        // $this->db->join('department', 'department.id_department = staff.department');
        $this->db->where('job_com_id', $job_com_id);
        $this->db->order_by('job_participants.job_id', 'DESC');
        // if ($department != '') {
        //     $this->db->where('staff.department', $department);
        // }
        if ($date_staff != '' && $date_end != '') {
            $this->db->group_start();
            $this->db->where('job_day_start <=', $date_staff);
            $this->db->where('job_day_end >=', $date_end);

            $this->db->or_group_start();
            $this->db->where('job_day_start >=', $date_staff);
            $this->db->where('job_day_end <=', $date_end);
            $this->db->group_end();

            $this->db->or_group_start();
            $this->db->where('job_day_start >=', $date_staff);
            $this->db->where('job_day_start <=', $date_end);
            $this->db->group_end();

            $this->db->or_group_start();
            $this->db->where('job_day_end >=', $date_staff);
            $this->db->where('job_day_end <=', $date_end);
            $this->db->group_end();
            $this->db->group_end();
        }
        if ($name_job != '') {
            $this->db->like('job_name', $name_job);
        }
        // if ($job_com_id != '' && $job_com_id != 0) {
        //     $this->db->where('job_com_id',$job_com_id);
        // }
        // if ($department != '') {
        //     $this->db->where('job_department_id',$department);
        // }
        if ($status != '') {
            $this->db->where('job.status', $status);
        }
        $num_results = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $num_results->result_array();
        // return $this->db->last_query();
        //SELECT DISTINCT(job_participants.job_id),job_name,job_city,job_district,job_address FROM `job` JOIN `job_participants` ON `job_participants`.`job_id` = `job`.`job_id` WHERE `job_com_id` = '1' AND `job_day_start` <= '1626368400' AND `job_day_end`>= '1626368400'
    }

    public function create_job($data)
    {
        $this->db->insert('job', $data);
        return $this->db->insert_id();
    }

    public function create_time_work($data)
    {
        $this->db->insert('time_work', $data);
        return $this->db->insert_id();
    }
    public function create_notify($data)
    {
        $this->db->insert('notify', $data);
        return true;
    }
    public function getNameStaffByid($id)
    {
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('staff_id', $id);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->row_array();
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

    public function updatejob($data, $condition)
    {
        $this->db->update('job', $data, $condition);
        return true;
    }

    public function selectNotify($data)
    {
        $this->db->select('id_time_work');
        $this->db->from('notify');
        $this->db->where('job_id', $data);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result_array();
    }

    public function deleteTimeWord($data)
    {
        $arr = [
            'id' => $data,
        ];
        // $this->db->where('id', $id);
        $this->db->delete('time_work', $arr);

        // return $this->db->last_query();
        // die();
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

    public function deleteNotify($data)
    {
        $this->db->delete('notify', $data);
        return true;
    }

    public function add_small_company($data)
    {
        $this->db->insert('company', $data);
        return $this->db->insert_id();
    }

    public function update_small_company($data, $id)
    {
        $this->db->update('company', $data, $id);
        return true;
    }
    public function infoCompany($data)
    {
        $this->db->select("com_id,com_name,com_email,com_phone,com_address,com_city,com_district,com_avatar,type_sign_up,created_at");
        $this->db->from('company');
        $this->db->where('com_id', $data);
        $data = $this->db->get();
        return $data->result();
    }

    public function updateDepartment($data, $id)
    {
        $this->db->update('department', $data, $id);
        return true;
    }

    public function checkCompanyPass($pass, $id)
    {
        $this->db->select("com_password");
        $this->db->from('company');
        $this->db->where('com_email !=', "");
        $this->db->where('com_password', $pass);
        $this->db->where('com_id', $id);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function companyChangePass($data, $id)
    {
        $this->db->update('company', $data, $id);
        return true;
    }

    // ----

    public function checkSmallCompanyPass($pass, $id)
    {
        $this->db->select("password");
        $this->db->from('small_company');
        $this->db->where('com_email !=', "");
        $this->db->where('password', $pass);
        $this->db->where('id_com', $id);
        $data = $this->db->get();
        return $data->result_array();
    }
    public function smallCompanyChangePass($data, $id)
    {
        $this->db->update('small_company', $data, $id);
        return true;
    }

    // ----

    public function addCalendar($data)
    {
        $this->db->insert('calendar', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function updateCalendar($data, $id)
    {
        $this->db->update('calendar', $data, $id);
        // return $this->db->last_query();
        // die();
        return true;
    }

    public function addStaffToCalendar($data, $id)
    {
        $this->db->update('calendar_staff', $data, $id);
        // return $this->db->last_query();
        // die();
        return true;
    }

    public function addCalendarStaff($data)
    {
        $this->db->insert('calendar_staff', $data);
        // $insert_id = $this->db->insert_id();
        return true;
    }

    public function updateOTP($email, $otp)
    {
        $this->db->update('company', $email, $otp);
        return true;
    }

    public function contact($data)
    {
        $this->db->insert('contact', $data);
        return true;
    }

    public function listStaff($data, $id_small, $id_department, $name_staff)
    {
        $this->db->select('staff_id,name_staff,telephone,avatar,department,active');
        $this->db->from("staff");
        $this->db->where("staff.company_id", $data);
        $this->db->where("staff.id_small_company", $id_small);

        if ($id_department != "" && $id_department != "") {
            $this->db->where("staff.department", $id_department);
        }

        if ($name_staff != "" && $name_staff != "") {
            $this->db->like("staff.name_staff", $name_staff);
        }
        $this->db->order_by('staff_id', 'DESC');
        // $this->db->where("staff.active",$active);
        $data = $this->db->get();
        return $data->result_array();
    }
    public function updateBrowseStaff($data, $id)
    {
        $this->db->update('staff', $data, $id);
        return true;
    }
    public function deleteStaff($id)
    {
        $this->db->delete('staff', $id);
        return true;
    }

    public function detailStaff($id_staff)
    {
        $this->db->select('*');
        $this->db->from("staff");
        $this->db->join("department", "department.id_department = staff.department");
        $this->db->join("position", "position.id_position = staff.position");
        // $this->db->join("company","staff.company_id = company.com_id");
        $this->db->where("staff.staff_id", $id_staff);
        $this->db->where('staff.active', 1);
        $this->db->order_by('staff_id', 'DESC');
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }

    public function updateRole($data, $id)
    {
        $this->db->update('staff', $data, $id);
        return true;
    }

    public function listSchedule($id, $id_small, $status1, $staff_id, $date_start, $date_end, $id_department)
    {
        $this->db->select("schedule.id,name,schedule_staff.staff_id,schedule.status,note,date_start,date_end");
        $this->db->from("schedule_staff");
        $this->db->join("schedule", "schedule.id = schedule_staff.schedule_id");
        $this->db->where("com_id", $id);
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
        if ($staff_id != '' && $staff_id != 0) {
            $this->db->where("schedule_staff.staff_id", $staff_id);
        }
        if ($status1 != '' && $status1 != 0) {
            $this->db->where("schedule_staff.status", $status1);
        }
        if ($id_department != '' && $id_department != 0) {
            $this->db->where("department", $id_department);
        }
        $data = $this->db->get();
        return $data->result();
    }

    public function listSchedules($id, $id_small, $status1, $staff_id, $date_start, $date_end, $id_department)
    {
        $this->db->select("schedule.id,name,schedule_staff.staff_id,schedule.status,note,date_start,date_end,avatar,name_staff");
        $this->db->from("schedule_staff");
        $this->db->join("schedule", "schedule.id = schedule_staff.schedule_id");
        $this->db->join("staff", "staff.staff_id = schedule_staff.staff_id");
        $this->db->where("com_id", $id);
        $this->db->where("schedule_index", 1);
        $this->db->where("com_small_id", $id_small);
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
        if ($staff_id != '' && $staff_id != 0) {
            $this->db->where("schedule_staff.staff_id", $staff_id);
        }
        if ($status1 != '' && $status1 != 0) {
            $this->db->where("schedule_staff.status", $status1);
        }
        if ($id_department != '' && $id_department != 0) {
            $this->db->where("department", $id_department);
        }
        $data = $this->db->get();
        return $this->db->last_query();
        die();
        return $data->result();
    }

    public function listScheduleStaff($id_schedule)
    {
        $this->db->select("*");
        $this->db->from("schedule_staff");
        $this->db->where("schedule_id", $id_schedule);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }

    public function scheduleById($id_schedule)
    {
        $this->db->select("*");
        $this->db->from("schedule");
        $this->db->where("id", $id_schedule);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->row_array();
    }

    public function schedule($id, $id_small)
    {
        $this->db->select("*");
        $this->db->from("schedule");
        $this->db->where("com_id", $id);
        // if ($id_small != 0) {
        //     $this->db->where("com_small_id",$id_small);
        // }
        $this->db->where("com_small_id", $id_small);
        $this->db->where("schedule_index", 1);
        $this->db->order_by('schedule.id', 'DESC');
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }

    public function detailScheduleStaff($id_schedule, $id_staff)
    {
        // if ($id_schedule != 0 && $id_schedule != '') {
        //     $this->db->select("DISTINCT(schedule_place.staff_id)");
        // }
        $this->db->select("*");
        $this->db->from("schedule_staff");
        $this->db->join("schedule", "schedule_staff.schedule_id = schedule.id");
        $this->db->join("schedule_place", "schedule_staff.schedule_id = schedule_place.schedule_id");
        if ($id_staff != 0 && $id_staff != '') {
            $this->db->where("schedule_place.staff_id", $id_staff);
        }
        $this->db->where("schedule_place.schedule_id", $id_schedule);
        $this->db->where("schedule_index", 1);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }

    public function detailSmallCompany($id)
    {
        $this->db->select("*");
        $this->db->from("company");
        $this->db->where('com_email !=', "");
        $this->db->where("com_id", $id);
        $data = $this->db->get();
        return $data->result();
    }

    public function participantsSchedule($id, $staff_id)
    {
        $this->db->select("*");
        $this->db->from("schedule_staff");
        $this->db->where("schedule_id", $id);
        if ($staff_id != '' && $staff_id != 0) {
            $this->db->where("staff_id", $staff_id);
        }
        $data = $this->db->get();
        return $data->result();
    }

    public function checkDepartment($id_com, $id_com_small, $name)
    {
        $this->db->select("*");
        $this->db->from("department");
        $this->db->where("id_company", $id_com);
        $this->db->where("name_department", $name);
        $data = $this->db->get();
        return $data->result();
    }

    public function createShift($data)
    {
        $this->db->insert('shifts', $data);
        return true;
    }

    public function updateShift($data, $id)
    {
        $this->db->update('shifts', $data, $id);
        return true;
    }

    public function checkShift($id, $name, $id_shift)
    {
        $this->db->select('*');
        $this->db->from('shifts');
        $this->db->where('id_com', $id);
        $this->db->where('index_shift', 1);
        $this->db->where('name_shift', $name);
        if ($id_shift > 0) {
            $this->db->where('id_shift !=', $id_shift);
        }
        $data = $this->db->get();
        return $data->result_array();
    }

    public function listShift($id, $id_small)
    {
        $this->db->select('*');
        $this->db->from('shifts');
        $this->db->where('id_com', $id);
        $this->db->where('index_shift', 1);
        $this->db->where('id_com_small', $id_small);
        $data = $this->db->get();
        return $data->result();
    }

    public function searchStaff($id, $company_id, $id_small_company, $name_staff, $id_department, $status, $id_position)
    {
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->join("position", "staff.position = position.id_position");
        $this->db->join("department", "staff.department = department.id_department");
        $this->db->join("role", "role.id = staff.power");
        $this->db->where('staff.active', 1);
        $this->db->order_by('staff_id', 'DESC');
        $this->db->where('company_id', $company_id);

        if ($id != "" && $id != 0) {
            $this->db->where('staff_id', $id);
        }
        if ($id_small_company != ""  && $id_small_company != 0) {
            $this->db->where('id_small_company', $id_small_company);
        }
        if ($id_department != "" && $id_department != 0) {
            $this->db->where('department', $id_department);
        }
        if ($name_staff != "" && $name_staff != 0) {
            $this->db->like('name_staff', $name_staff);
        }

        if ($id_position != "" && $id_position != 0) {
            $this->db->where('position', $id_position);
        }
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }

    public function createConfig($data)
    {
        $this->db->insert('config', $data);
        return true;
    }

    public function updateConfig($data, $id)
    {
        $this->db->update('config', $data, $id);
        return true;
    }
    public function deleteConfig($id, $id_small)
    {
        $arr = [
            'com_id' => $id,
            'id_com_small' => $id_small,
        ];
        $this->db->delete('config', $arr);
        return true;
    }


    public function checkConfig($id, $id_small, $id_wifi, $id_lat_long)
    {
        $this->db->select('*');
        $this->db->from('config');
        $this->db->where('com_id', $id);
        $this->db->where('id_com_small', $id_small);
        if ($id_wifi != 0 && $id_wifi != '') {
            $this->db->where("FIND_IN_SET(" . $id_wifi . ", id_wifi)");
        }
        if ($id_lat_long != 0 && $id_lat_long != '') {
            $this->db->where("FIND_IN_SET(" . $id_lat_long . ", id_lat_long)");
        }
        $data = $this->db->get();
        return $data->row_array();
    }

    public function detailConfig($id, $id_small)
    {
        $this->db->select('*');
        $this->db->from('config');
        // if ($id_small == 0) {
        //     $this->db->join('company','company.com_id = config.com_id');
        // }
        $this->db->where('config.com_id', $id);
        $this->db->where('config.id_com_small', $id_small);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function deleteCompanySmall($id)
    {
        $this->db->delete('company', $id);
        return true;
    }

    public function deleteShift($id)
    {
        $this->db->delete('shifts', $id);
        return true;
    }

    public function listMonthCalendar($id, $id_small, $month)
    {
        $this->db->select('*');
        $this->db->from('calendar');
        $this->db->where('id_company', $id);
        $this->db->where('id_company_small	', $id_small);
        $this->db->where('calendar_parent', 0);
        $this->db->where('index_calendar', 1);
        if ($month != 0 && $month != '') {
            $this->db->where('month', $month);
        }
        // $this->db->join('calendar_staff','calendar_staff.calendar_id = calendar.id');
        // $this->db->where('date_start >=',$mydate_begin_date);
        // $this->db->where('date_end <=',$last_day_this_month);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }

    public function listDayCalendar($id)
    {
        $this->db->select('*');
        $this->db->from('calendar');
        $this->db->where('calendar_parent', $id);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function listMonthCalendarStaff($id)
    {
        $this->db->select('*');
        $this->db->from('calendar_staff');
        $this->db->where('calendar_id', $id);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }

    public function detailCalendarStaff($id)
    {
        $this->db->select('*');
        $this->db->from('calendar_staff');
        $this->db->where('calendar_id', $id);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function listMonthStaff($id_calendar)
    {
        $this->db->select('*');
        $this->db->from('calendar_staff');
        // $this->db->join('calendar_staff','calendar_staff.calendar_id = calendar.id');
        // $this->db->join('staff','staff.staff_id = calendar_staff.staff_id');
        // $this->db->join('department','department.id_department = staff.department');
        // $this->db->where('date_start >=',$mydate_begin_date);
        // $this->db->where('date_end <=',$last_day_this_month);
        // $this->db->where('calendar.id_company',$id);
        $this->db->where('calendar_staff.calendar_id', $id_calendar);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }

    public function getListJob($id, $id_small, $today, $job_type, $department, $status)
    {
        $this->db->select('DISTINCT(job_participants.job_id),job.status,job_name,job_day_start,job_day_end,job_time_in,job_time_out,job_address,job_city,job_district');
        $this->db->from('job');
        $this->db->join('job_participants', 'job_participants.job_id = job.job_id');
        // $this->db->join('staff', 'job_participants.staff_id = staff.staff_id');
        $this->db->where('job_com_id', $id);
        // $this->db->where('job_type',$job_type);
        if ($department != 0 && $department != '') {
            $this->db->where('department', $department);
        }
        if ($status != 0 && $status != '') {
            $this->db->where('job.status', $status);
        }
        if ($today != 0 && $today != '') {
            $this->db->group_start();
            $this->db->group_start();
            $this->db->where("job_day_start <=", $today);
            $this->db->where("job_day_end  >=", $today);
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('job_day_start >=', $today);
            $this->db->where('job_day_end <=', $today);
            $this->db->group_end();

            $this->db->or_group_start();
            $this->db->where('job_day_start', $today);
            $this->db->or_where('job_day_end', $today);
            $this->db->group_end();
            $this->db->group_end();
        }
        $this->db->order_by('job.job_id', 'DESC');
        $data = $this->db->get();
        return $data->result();
    }

    public function getListJobPar($id)
    {
        $this->db->select('*');
        $this->db->from('job_participants');
        $this->db->where('job_id', $id);
        $data = $this->db->get();
        return $data->result();
    }

    public function getDetailJob($id)
    {
        $this->db->select('*');
        $this->db->from('job');
        $this->db->where('job.job_id', $id);
        $data = $this->db->get();
        return $data->result();
    }
    public function list_content($id)
    {
        $this->db->select('*');
        $this->db->from('job_content_staff');
        $this->db->where('job_id', $id);
        $data = $this->db->get();
        return $data->result();
    }
    public function list_content_staff($id)
    {
        $this->db->select('*');
        $this->db->from('job_content');
        $this->db->where('job_id', $id);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function updateJobContent($data, $id)
    {
        $this->db->update('job_content', $data, $id);
        return true;
    }

    public function getListJobByStatus($status, $staff_id)
    {
        $this->db->select('job_participants.job_id,job_day_start,job_day_end,job_time_out,job_time_in,staff_id,job_name,status,job_address,job_city,job_district');
        $this->db->from('job');
        $this->db->join('job_participants', 'job_participants.job_id = job.job_id');
        // $this->db->where('job.job_com_id',$id);
        // $this->db->where('job.job_type',$job_type);
        $this->db->where('status', $status);
        $this->db->where('staff_id', $staff_id);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }

    public function scheduleHistoryStaff($status, $staff_id)
    {
        $this->db->select('*');
        $this->db->from('schedule');
        $this->db->join('schedule_staff', 'schedule_staff.schedule_id = schedule.id');
        // $this->db->join('schedule_place','schedule_place.schedule_id = schedule.id');
        // $this->db->where('com_id',$id);
        $this->db->where('staff_id', $staff_id);
        $this->db->where("schedule_index", 1);
        $this->db->where('status', $status);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }


    public function detailScheduleHistoryStaff($schedule_id, $staff_id)
    {
        $this->db->select("*");
        $this->db->from("schedule_staff");
        $this->db->join("schedule", "schedule_staff.schedule_id = schedule.id");
        // $this->db->join("schedule_place","schedule_staff.schedule_id = schedule_place.schedule_id");
        $this->db->where("schedule_staff.schedule_id", $schedule_id);
        $this->db->where("schedule_index", 1);
        if ($staff_id != '' && $staff_id != 0) {
            $this->db->where("schedule_staff.staff_id", $staff_id);
        }
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }
    public function detailScheduleLatLong($id, $schedule_id)
    {
        $this->db->select("*");
        $this->db->from("schedule_place_lat_long");
        if ($schedule_id != 0) {
            $this->db->where("schedule_id", $schedule_id);
        }
        if ($id != 0) {
            $this->db->where("id", $id);
        }
        $data = $this->db->get();
        return $data->result();
    }

    public function detailSchedulePlace($schedule_id, $staff_id)
    {
        $this->db->select("*");
        $this->db->from("schedule_place");
        if ($schedule_id != 0 && $schedule_id != '') {
            $this->db->where("schedule_id", $schedule_id);
        }
        if ($staff_id != 0 && $staff_id != '') {
            $this->db->where("staff_id", $staff_id);
        }
        $data = $this->db->get();
        return $data->result();
    }

    public function countJob($id, $id_small, $job_type)
    {
        $this->db->select('*');
        $this->db->from('job');
        // $this->db->join('job_participants','job_participants.job_id = job.job_id');
        $this->db->where('job_com_id', $id);
        $this->db->where('job_type', $job_type);
        $this->db->where('job.status !=', 4);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }

    public  function listJobByStaff($id, $id_com_small, $staff_id, $mydate)
    {
        $this->db->select('*');
        $this->db->from('calendar_staff');
        $this->db->join('calendar ', 'calendar.id = calendar_staff.calendar_id');
        $this->db->where('index_calendar', 1);
        // $this->db->where('calendar_staff.staff_id',$staff_id);
        if ($staff_id != '' && $staff_id != 0) {
            $this->db->where("FIND_IN_SET(" . $staff_id . ", calendar_staff.staff_id)");
        }
        if ($mydate != '' && $mydate != 0) {
            $this->db->where('month', $mydate);
            $this->db->where('calendar_parent', 0);
        }
        $this->db->where('id_company', $id);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result();
    }

    public function deleteCalendar($id)
    {
        $this->db->delete('calendar', $id);
        return true;
    }

    public function deleteCalendarStaff($id)
    {
        $this->db->delete('calendar_staff', $id);
        return true;
    }
    public function listJobDeliver($id, $id_department, $id_small_com, $time_start = '', $time_end = '')
    {
        //SELECT DISTINCT(job_participants.job_id) FROM `staff` JOIN department ON staff.department = department.id_department JOIN job_participants ON job_participants.staff_id = staff.staff_id JOIN job ON job.job_id = job_participants.job_id WHERE department = 1 AND job.job_com_id = 1
        $this->db->select('DISTINCT(job_participants.job_id),job.status,job_name,job_address,job_day_start,job_day_end,job_city,job_district,job_address');
        $this->db->from('job');
        // $this->db->join('department ', 'staff.department = department.id_department');
        // $this->db->join('job_participants ', 'job_participants.staff_id = staff.staff_id');
        $this->db->join('job_participants', 'job.job_id = job_participants.job_id');
        $this->db->where('job_department_id', $id_department);
        $this->db->where('job.job_com_id', $id);
        // $this->db->where('staff.active', 1);
        if ($time_start != '') {
            $this->db->where('job_day_start > ', strtotime($time_start));
        }
        if ($time_end != '') {
            $this->db->where('job_day_end < ', strtotime($time_end));
        }
        $this->db->order_by('job_participants.job_id', 'DESC');
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result_array();
    }

    public function deleteSchedule($id)
    {
        $this->db->delete('schedule', $id);
        return true;
    }

    public function deleteScheduleStaff($id)
    {
        $this->db->delete('schedule_place', $id);
        return true;
    }

    public function deleteSchedulePlace($id)
    {
        $this->db->delete('schedule_staff', $id);
        return true;
    }
    public function deleteSchedulelatlong($data)
    {
        $this->db->delete('schedule_place_lat_long', $data);
        return true;
    }
    public function updateJobContentCompany($id, $data)
    {
        $this->db->update('job_content', $data, $id);
        return true;
    }

    public function updateSchedule($schedule, $id)
    {
        $this->db->update('schedule', $schedule, $id);
        return true;
    }

    public function schedulePlaceById($id_schedule)
    {
        $this->db->select('DISTINCT(staff_id)');
        $this->db->from('schedule_place');
        $this->db->where('schedule_id', $id_schedule);
        $data = $this->db->get();
        return $data->result();
    }

    public function listStaffByRole($id, $id_small, $id_power)
    {
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('company_id', $id);
        $this->db->where('id_small_company', $id_small);
        $this->db->where('staff.active', 1);
        $this->db->order_by('staff_id', 'DESC');
        if ($id_power != 0 && $id_power != '') {
            $this->db->where('power', $id_power);
        } else {
            $this->db->where('power !=', 0);
        }
        $data = $this->db->get();
        return $data->result();
    }

    public function listDepartmentById($id)
    {
        $this->db->select('*');
        $this->db->from('department');
        $this->db->where('id_department', $id);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function listRoleById($id)
    {
        $this->db->select('*');
        $this->db->from('role');
        $this->db->where('id', $id);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function check_date($id, $id_small, $mydate)
    {
        $this->db->select('*');
        $this->db->from('calendar');
        $this->db->where('index_calendar', 1);
        $this->db->where('id_company', $id);
        $this->db->where('id_company_small', $id_small);
        $this->db->where('month', $mydate);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result_array();
    }

    public function listCalendarByMonth($id, $id_small)
    {
        $this->db->select('DISTINCT(month)');
        $this->db->from('calendar');
        $this->db->where('index_calendar', 1);
        $this->db->where('id_company', $id);
        $this->db->where('id_company_small', $id_small);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result_array();
    }

    public function createWifi($data)
    {
        $this->db->insert('config_wifi', $data);
        return $this->db->insert_id();
    }

    public function updateWifi($data, $id)
    {
        $this->db->update('config_wifi', $data, $id);
        return true;
    }

    public function deleteWifi($id)
    {
        $this->db->delete('config_wifi', $id);
        return true;
    }

    public function listWifi($id, $id_small)
    {
        $this->db->select('*');
        $this->db->from('config_wifi');
        $this->db->where('id_com', $id);
        $this->db->where('id_com_small', $id_small);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function createLatLong($data)
    {
        $this->db->insert('config_lat_long', $data);
        return $this->db->insert_id();
    }

    public function updateLatLong($data, $id)
    {
        $this->db->update('config_lat_long', $data, $id);
        return true;
    }

    public function deleteLatLong($id)
    {
        $this->db->delete('config_lat_long', $id);
        return true;
    }

    public function listLatLong($id, $id_small)
    {
        $this->db->select('*');
        $this->db->from('config_lat_long');
        $this->db->where('id_com', $id);
        $this->db->where('id_com_small', $id_small);
        $data = $this->db->get();
        return $data->result_array();
    }

    public function StaffById($id)
    {
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('staff_id', $id);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function detailwifi($id)
    {
        $this->db->select('*');
        $this->db->from('config_wifi');
        $this->db->where('id', $id);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function detaillatlong($id)
    {
        $this->db->select('id,address,lat,long,created_at,updated_at');
        $this->db->from('config_lat_long');
        $this->db->where('id', $id);
        $data = $this->db->get();
        return $data->row_array();
    }


    public function getCityById($id)
    {
        $this->db->select('cit_id,cit_name');
        $this->db->from('city');
        $this->db->where('cit_id', $id);
        return $this->db->get()->row_array();
    }

    public function getDistrictById($id)
    {
        $this->db->select('cit_id,cit_name');
        $this->db->from('city2');
        $this->db->where('cit_id', $id);
        return $this->db->get()->row_array();
    }

    public function listStaffByMonth($id, $id_small, $id_department, $name_staff, $month, $status)
    {
        if ($id_department != '' && $id_department != 0) {
            $id_department = ' AND staff.department = ' . $id_department;
        }
        $name = "";
        if ($name_staff != '') {
            $name = ' AND name_staff LIKE "%' . $name_staff . '%"';
        }

        // if ($month != '' && $month != 0) {
        //     $month = ' AND month = ' . $month;
        // }

        if ($month != '' && $month != 0) {
            $month = ' AND calendar.month = ' . $month;
        }

        $sql = 'SELECT * FROM `calendar_staff` JOIN `staff` ON `FIND_IN_SET`(staff.staff_id,calendar_staff.staff_id) JOIN `calendar` ON `calendar`.`id`=`calendar_staff`.`calendar_id` WHERE index_calendar = 1 AND `calendar`.`id_company` = ' . $id . ' AND `staff`.`id_small_company` = ' . $id_small . $id_department . $name . $month . ' ORDER BY staff.staff_id DESC';
        return $this->db->query($sql)->result_array();
    }

    public function list_calenderStaff()
    {
        $this->db->select('*');
        $this->db->from('calendar_staff');
        // $this->db->where('staff.company_id',$id);
        // $this->db->where('staff.id_small_company',$id_small);
        return $this->db->get()->result_array();
    }

    public function coordinateStaff($id_staff, $date)
    {
        $this->db->select('*');
        $this->db->from('staff_coordinates');
        $this->db->where('id_staff', $id_staff);
        if ($date != 0 && $date != '') {
            $this->db->where('created_at', $date);
        }
        // $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $this->db->get()->result_array();
    }

    public function getScheduleToday($staff_id, $today)
    {
        $this->db->select('schedule.id,staff_id,schedule.status,com_id,name,date_start,date_end,note');
        $this->db->from('schedule_staff');
        $this->db->join('schedule', 'schedule_staff.schedule_id = schedule.id');
        $this->db->where("staff_id", $staff_id);

        $this->db->where("schedule_index", 1);
        $this->db->group_start();
        $this->db->where('date_start', $today);
        $this->db->or_where('date_end', $today);
        $this->db->or_group_start();
        $this->db->where('date_start <=', $today);
        $this->db->where('date_end >=', $today);
        $this->db->group_end();
        $this->db->group_end();

        $query = $this->db->get();
        return  $query->result_array();
    }

    public function getSchedulelatLongToday($staff_id, $today)
    {
        $this->db->select(' schedule_place_lat_long.place,schedule_place_lat_long.lat,schedule_place_lat_long.long');
        $this->db->from('schedule_staff');
        $this->db->join('schedule', 'schedule_staff.schedule_id = schedule.id');
        $this->db->join('schedule_place', 'schedule_place.schedule_id = schedule.id');
        $this->db->join('schedule_place_lat_long', 'schedule_place_lat_long.id = schedule_place.id_lat_long');
        $this->db->where('schedule_place.staff_id', $staff_id);
        $this->db->where('schedule_staff.staff_id', $staff_id);

        $this->db->where("schedule_index", 1);
        $this->db->group_start();
        $this->db->where('date_start', $today);
        $this->db->or_where('date_end', $today);
        $this->db->or_group_start();
        $this->db->where('date_start <=', $today);
        $this->db->where('date_end >=', $today);
        $this->db->group_end();
        $this->db->group_end();

        $query = $this->db->get();
        return  $query->result();
    }

    public function detailCalendar($id_calendar)
    {
        $this->db->select('*');
        $this->db->from('calendar');
        $this->db->join('calendar_staff', 'calendar_staff.calendar_id = calendar.id');
        $this->db->where('calendar.id', $id_calendar);
        $query = $this->db->get();
        // return $this->db->last_query();
        // die();
        return  $query->row_array();
    }

    public function create_number_day($data)
    {
        $this->db->insert('number_work_days', $data);
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
    public function detail_shift($id)
    {
        $this->db->select('*');
        $this->db->from("shifts");
        $this->db->where('index_shift', 1);
        $this->db->where("id_shift", $id);
        $this->db->order_by('id_shift', "DESC");
        $data = $this->db->get();
        return $data->row_array();
    }

    public function show_time_sheet($id, $dateStart, $dateEnd, $department)
    {
        $this->db->select('*');
        $this->db->from("staff");
        $this->db->join("time_sheets", "staff.staff_id = time_sheets.ep_id");

        $this->db->where("staff.company_id", $id);
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


    public function get_number_day_sheet($id, $date)
    {
        $this->db->select('*');
        $this->db->from("number_work_days");
        $this->db->where('com_id', $id);
        $this->db->where("date", $date);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function delete_number_day($arr_id)
    {
        $this->db->delete('number_work_days', $arr_id);
        return true;
    }

    public function notify_job_expired($com_id, $time, $time_end)
    {
        $this->db->select('*');
        $this->db->from("job");
        $this->db->where('job_com_id', $com_id);
        $this->db->where("job_day_end >", $time);
        $this->db->where("job_day_end <", $time_end);
        $data = $this->db->get();
        // return $this->db->last_query();
        // die();
        return $data->result_array();
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
}
