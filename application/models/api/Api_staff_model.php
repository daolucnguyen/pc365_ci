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
        $this->db->select('staff_id,position,department,avatar,name_staff,staff.email,staff.pass,staff.created_at,company_id,verification,staff.telephone,name_staff,com_name');
        $this->db->from('staff');
        // $this->db->join('department', 'department.id_department = staff.department');
        $this->db->join('company', 'company.com_id = staff.company_id');
        $this->db->where('staff.email', $email);
        $this->db->where('staff.pass', $pass);
        $data = $this->db->get();

        return $data->row_array();
    }
    public function getDepartmentById($com_id, $id)
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
    public function getPositionById($com_id, $id)
    {
        $this->db->select('id_position,name_position');
        $this->db->where('id_position', $id);
        $data = $this->db->get('position')->row();
        return $data;
    }
    public function getPositionList($com_id)
    {
        $this->db->select('id_position,name_position');
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
    public function updateStaff($data, $condition)
    {
        $this->db->update('staff', $data, $condition);
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
        $num_results = $this->db->get();
        return $num_results->result_array();
    }
    public function verifyRegister($staff_id)
    {
        $this->db->set('verification', 1);
        $this->db->where('staff_id', $staff_id);
        $this->db->update('staff');
        return true;
    }
    public function changePass($data, $condition)
    {
        $this->db->update('staff', $data, $condition);
        return true;
    }
    public function checkOldStaffPass($pass, $staff_id)
    {
        $this->db->where('pass', $pass);
        $this->db->where('staff_id', $staff_id);
        $num_results = $this->db->get('staff')->num_rows();
        return $num_results;
    }

    public function getStaffInfo()
    {
    }

    public function getScheduleHistoryList($data)
    {
        $staff_id = $data['staff_id'];
        $status   = $data['status'];
        $date_start = $data['date_start'];
        $date_end   = $data['date_end'];
        $this->db->select('*');
        $this->db->from('schedule_staff');
        $this->db->join('schedule', 'schedule_staff.schedule_id = schedule.id');
        $this->db->where("FIND_IN_SET(" . $staff_id . ", staff_id)");
        $this->db->where('schedule.status', $status);
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
        $query = $this->db->get();
        return $query;
    }
    public function getScheduleToday($data, $date_start, $date_end)
    {
        $staff_id = $data['staff_id'];
        $today    = $data['today'];
        $this->db->select('schedule_id,name,note,date_start,date_end,schedule_staff.status');
        $this->db->from('schedule_staff');
        $this->db->join('schedule', 'schedule_staff.schedule_id = schedule.id');
        $this->db->where("FIND_IN_SET(" . $staff_id . ", staff_id)");
        if ($date_start != "" && $date_end != "") {
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
        } else {
            $this->db->group_start();
            $this->db->where('date_start', $today);
            $this->db->or_where('date_end', $today);
            $this->db->or_group_start();
            $this->db->where('date_start <=', $today);
            $this->db->where('date_end >=', $today);
            $this->db->group_end();
            $this->db->group_end();
        }
        $query = $this->db->get();
        return  $query->result();
    }
    public function searchSchedule($data)
    {
        $staff_id = $data['staff_id'];
        $name     = $data['name'];
        $date_staff = $data['date_start'];
        $date_end = $data['date_end'];
        $this->db->select('*');
        $this->db->from('schedule_staff');
        $this->db->join('schedule', 'schedule_staff.schedule_id = schedule.id');
        $this->db->where('schedule_staff.staff_id', $staff_id);
        // $this->db->where("FIND_IN_SET(" . $staff_id . ", schedule_staff.staff_id)");
        if ($name != "") {
            $this->db->like('name', $name);
        }

        if ($date_staff != '' && $date_end != '') {
            $this->db->group_start();

            $this->db->where('date_start', $date_staff);
            $this->db->or_where('date_start', $date_end);

            $this->db->or_group_start();
            $this->db->where('date_start >=', $date_staff);
            $this->db->where('date_start <=', $date_end);
            $this->db->group_end();

            $this->db->or_group_start();
            $this->db->where('date_start >=', $date_staff);
            $this->db->where('date_start <=', $date_end);
            $this->db->group_end();

            $this->db->or_group_start();
            $this->db->where('date_start <=', $date_staff);
            $this->db->where('date_start >=', $date_end);
            $this->db->group_end();
            $this->db->group_end();
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getListJobToday($data)
    {
        $staff_id = $data['staff_id'];
        $today = $data['date'];
        $this->db->select('*');
        $this->db->from('job_participants');
        $this->db->join('job', 'job_participants.job_id = job.job_id');
        $this->db->where('job_participants.staff_id', $staff_id);
        if ($today > 0) {
            $this->db->group_start();
            $this->db->where('job_day_start', $today);
            $this->db->or_where('job_day_end', $today);
            $this->db->or_group_start();
            $this->db->where('job_day_start <=', $today);
            $this->db->where('job_day_end >=', $today);
            $this->db->group_end();
            $this->db->group_end();
        }
        if ($data['time_in'] != '' && $data['time_out'] == '') {
            $str_time = strtotime($data['time_in']);
            $month = date('m', $str_time);
            $day = date('d', $str_time);
            $year = date('Y', $str_time);
            $dateStart = mktime(0, 0, 0, $month, $day, $year);
            $dateEnd = mktime(23, 59, 59, $month, $day, $year);
            $this->db->where('job_day_start >=', $dateStart);
            $this->db->where('job_day_end <=', $dateEnd);
        }
        if ($data['time_in'] != '' && $data['time_out'] != '') {
            $time_in = strtotime($data['time_in']);
            $time_out = strtotime($data['time_out']);
            if ($time_in == $time_out) {
                $today = $time_out;
                $this->db->group_start();
                $this->db->where('job_day_start', $today);
                $this->db->or_where('job_day_end', $today);
                $this->db->or_group_start();
                $this->db->where('job_day_start <=', $today);
                $this->db->where('job_day_end >=', $today);
                $this->db->group_end();
                $this->db->group_end();
            } else {
                $this->db->where('job_day_start >=', $time_in);
                $this->db->where('job_day_end <=', $time_out);
            }
        }
        $this->db->order_by('job.job_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function count_job($staff_id)
    {
        $this->db->select('*');
        $this->db->from('job_participants');
        $this->db->join('job', 'job_participants.job_id = job.job_id');
        $this->db->where('job_participants.staff_id', $staff_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getListParticipant($data)
    {
        $this->db->select('Participant_id,job_participants.job_id,job_participants.staff_id,status');
        $this->db->from('job_participants');
        $this->db->where('job_participants.job_id', $data);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDetailJobToday($data)
    {
        $job_id = $data['job_id'];
        $this->db->select('*');
        $this->db->from('job');
        $this->db->where('job_id', $job_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function detailJobContent($job_id)
    {
        $this->db->select('*');
        $this->db->from('job_content');
        $this->db->where('id_content', $job_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getListContentJob($job_id)
    {
        $this->db->select('id_content,id_content,staff_id,content_staff_id,status,content');
        $this->db->from('job_content');
        $this->db->join("job_content_staff", "job_content_staff.id = job_content.content_staff_id");
        $this->db->where('job_content.job_id', $job_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getCity()
    {
        $this->db->select('*');
        $this->db->from('city');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDistrict($data)
    {
        $this->db->select('cit_id,cit_name');
        $this->db->from('city2');
        $this->db->where('cit_parent', $data);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function detailScheduleHistoryStaff($schedule_id, $staff_id)
    {
        $this->db->select("*");
        $this->db->from("schedule_staff");
        $this->db->join("schedule", "schedule_staff.schedule_id = schedule.id");
        $this->db->where("schedule_staff.schedule_id", $schedule_id);
        $this->db->where("schedule_staff.staff_id", $staff_id);
        $data = $this->db->get();
        return $data->result();
    }

    public function detailSchedulePlaceById($id)
    {
        $this->db->select("*");
        $this->db->from("schedule_place");
        $this->db->where("id", $id);
        $data = $this->db->get();
        return $data->row_array();
    }

    public function create_notify($data)
    {
        $this->db->insert('notify', $data);
        return true;
    }
    public function scheduleHistoryStaff($status, $staff_id)
    {
        $this->db->select('*');
        $this->db->from('schedule');
        $this->db->join('schedule_staff', 'schedule_staff.schedule_id = schedule.id');
        $this->db->where('staff_id', $staff_id);
        $this->db->where('schedule_staff.status', $status);
        $data = $this->db->get();
        return $data->result();
    }

    public function updateJobContentStaff($id, $data)
    {
        $this->db->update('job_content', $data, $id);
        return true;
    }

    public function updatejob($data, $condition)
    {
        $this->db->update('job', $data, $condition);
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

    public function detailSchedulePlace($schedule_id, $staff_id)
    {
        $this->db->select("*");
        $this->db->from("schedule_place");
        $this->db->where("schedule_place.schedule_id", $schedule_id);
        $this->db->where("staff_id", $staff_id);
        $data = $this->db->get();
        return $data->result();
    }

    public function detailScheduleLatLong($schedule_id)
    {
        $this->db->select("*");
        $this->db->from("schedule_place_lat_long");
        $this->db->where("id", $schedule_id);
        $data = $this->db->get();
        return $data->result();
    }

    public function updateStatusSchedule($data, $id)
    {
        $this->db->update('schedule_place', $data, $id);
        return true;
    }

    public function createLatLongStaff($data)
    {
        $this->db->insert('staff_coordinates', $data);
        return true;
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

    public function show_info($id)
    {
        $this->db->select('*');
        $this->db->from('staff');
        $this->db->where('staff_id', $id);
        return $this->db->get()->row_array();
    }

    public function show_noti($id)
    {
        $this->db->select('*');
        $this->db->from("notify");
        $this->db->where("notify_to_staff", $id);
        $this->db->order_by('id_notify', 'DESC');
        $data = $this->db->get();
        return $data->result_array();
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

    public function show_time_sheet($id, $dateStart, $dateEnd)
    {
        $this->db->select('*');
        $this->db->from("staff");
        $this->db->join("time_sheets", "staff.staff_id = time_sheets.ep_id");
        $this->db->where("staff_id ", $id);
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

        $this->db->select('min(at_time) as in_shift,ts_image,ts_location_name,note');
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
        $this->db->select('max(at_time) as out_shift,ts_image,ts_location_name,note');
        $this->db->from("time_sheets");
        $this->db->where("shift_id", $id);
        $this->db->where("ep_id", $staff_id);
        $this->db->where("at_time > ", $time_begin);
        $this->db->where("at_time < ", $time_end);
        $this->db->where("is_success", 1);
        $data = $this->db->get();
        return $data->row_array();
    }
}
