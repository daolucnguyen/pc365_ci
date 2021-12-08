<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StaffController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('staff/StaffModel');
        $this->load->helper('url');
        $this->load->helper('text');
        $this->load->library('session');
        // check login_staff
        $this->load->helper('func');
        // load Pagination library
        $this->load->library('pagination');
        $this->load->library('Globals');


        checkLoginStaff();
    }
    function show_department()
    {
        $response = $this->StaffModel->show_department();
        return $response;
    }

    public function notify()
    {

        $staff_ss = $this->session->userdata('staff');
        $show_noti = $this->StaffModel->show_noti($staff_ss['id']);
        return $show_noti;
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

    public function qlyChungNv()
    {
        $staff_ss = $this->session->userdata('staff');
        $show_info = [
            'id' => $staff_ss['id'],
            'avatar' => $staff_ss['avatar'],
            'name' => $staff_ss['name'],
        ];
        $date = strtotime(date('Y-m-d'));
        $date_start = date('Y-m-d', $date);
        $date_end = date('Y-m-d', $date);
        // $count_time_sheet        = $this->StaffModel->show_time_sheet($staff_ss['id'], '', $date_start, $date_end);
        $count_job_day = $this->StaffModel->countJob($staff_ss['id'], "", $date, $date, '');
        $count_schedule_day = $this->StaffModel->listSchedule($staff_ss['id'], '', $date, $date, '');


        $access_token     = $staff_ss['token'];
        $curl             = curl_init();
        $header[]         = 'Authorization: ' . $access_token . '';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php?filter_by[active]=true&id_com=' . $staff_ss['com_id'];
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $show_staff = json_decode($resp);
        $arr_staff = [];
        if ($show_staff->data->items != null) {
            foreach ($show_staff->data->items as $key => $value) {
                $arr_staff[] = [
                    'ep_id' => $value->ep_id,
                    'avatar' => $value->ep_image,
                ];
            }
        }

        $url = 'https://chamcong.24hpay.vn/service/get_last_history_time_keeping.php?start_date=' . $date_start . '&end_date=' . $date_end;
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $sheet = json_decode($resp);
        curl_close($curl);
        $data["showJobPra"] = $this->StaffModel->showJobPra();
        $data["show_city"] = $this->StaffModel->show_city();
        $data["arr_staff"] = $arr_staff;
        $data['count_sheet'] = count($sheet->data->items);
        $data['count_job_day'] = count($count_job_day);
        $data['list_job_today'] = $count_job_day;
        $data['count_schedule_day'] = count($count_schedule_day);
        $data['show_info'] = $show_info;
        $data['notify'] = $this->notify();
        $this->load->view('manager/staff/qly_chung_nv', $data);
    }

    public function curl_history_time_keeping($d1 = 0, $d2 = 0, $start = 0, $rowperpage = 0)
    {
        $access_token = $_SESSION['staff']['token'];
        $curl = curl_init();
        $header[]         = 'Authorization: ' . $access_token . '';
        $url = "https://chamcong.24hpay.vn/service/get_last_history_time_keeping.php?start_date=" . $d1 . "&end_date=" . $d2 . "&off_set=" . $start . '&length=' . $rowperpage;
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

    public function qlyChamCong()
    {
        $staff_ss = $this->session->userdata('staff');
        $show_info = $this->StaffModel->show_info($staff_ss['id']);

        $keyWord = $this->input->get('key');
        $dateStart = $this->input->get('date_start');
        $dateEnd = $this->input->get('date_end');

        $list_shift             = $this->StaffModel->list_shift($show_info['company_id']);
        $show_time_sheet        = $this->StaffModel->show_time_sheet($show_info['staff_id'], $keyWord, $dateStart, $dateEnd);
        $arr_sheet = [];

        $d01 = date('Y-m-01');
        $d02 = date('Y-m-d');
        if ($dateEnd != '') {
            $d02 = $dateEnd;
        }
        if ($dateStart != '') {
            $d01 = $dateStart;
        }
        $segment = 2;
        $per_page = 10;
        $off_set = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        if ($off_set != 0) {
            $off_set                     = ($off_set - 1) * $per_page;
        }
        $curl_history_time_keeping = $this->curl_history_time_keeping($d01, $d02, $off_set, $per_page);
        $url =  urlQlyChamCong();
        $page = $this->page($curl_history_time_keeping->data->totalItems, $segment, $url, $per_page);
        $data["links"] = $this->pagination->create_links();

        // $segment = 2;
        // $per_page = 10;
        // $url =  urlQlyChamCong();

        // foreach ($show_time_sheet as $sheets => $sheet) {
        //     $index_sheet = $sheet['staff_id'] . '_' . date("d_m_Y", strtotime($sheet['at_time']));
        //     $shift = [];
        //     foreach ($list_shift as $value_shifts => $value_shift) {
        //         $show_sheet_by_id_shift_min = [];
        //         $show_sheet_by_id_shift_max = [];
        //         $show_sheet_by_id_shift_min         = $this->StaffModel->show_sheet_by_id_shift_min($value_shift['id_shift'], $sheet['staff_id'], $sheet['at_time']);
        //         $show_sheet_by_id_shift_max         = $this->StaffModel->show_sheet_by_id_shift_max($value_shift['id_shift'], $sheet['staff_id'], $sheet['at_time']);

        //         $shift[$value_shift['id_shift']] = [
        //             'in_shift' => $show_sheet_by_id_shift_min['in_shift'],
        //             'out_shift' => $show_sheet_by_id_shift_max['out_shift'],
        //         ];
        //     }
        //     $arr_sheet[$index_sheet] = [
        //         'staff_id' => $sheet['staff_id'],
        //         'name_staff' => $sheet['name_staff'],
        //         'avatar' => $sheet['avatar'],
        //         'department' => $sheet['department'],
        //         'date' => date("d-m-Y", strtotime($sheet['at_time'])),
        //         'list' => $shift,
        //     ];
        // }

        // $index_page = $page - 1;
        // // $data["links"] = $this->pagination->create_links();
        // $data['list_shift'] = $list_shift;
        // $data['show_time_sheet'] = $show_time_sheet;
        // $arr_sheet = array_chunk($arr_sheet, $per_page);
        // $a = [];
        // if (count($arr_sheet) > 0) {
        //     $a = $arr_sheet[$index_page];
        // }
        $data['arr_sheet'] = $curl_history_time_keeping->data->items;
        $data['show_department'] = $this->show_department();

        $data['key'] = $keyWord;
        $data['date_start'] = $d01;
        $data['date_end'] = $d02;

        $data['show_info'] = $show_info;
        $data['notify'] = $this->notify();
        $this->load->view('manager/staff/qly_cham_cong', $data);
    }

    public function qlyLichTrinh()
    {

        $staff_ss = $this->session->userdata('staff');
        $key = $this->input->get('key');
        $date_start = $this->input->get('date_start');
        $date_end = $this->input->get('date_end');
        $status = $this->input->get('status');
        if ($date_start != '') {
            $date_start = strtotime($date_start);
        }

        if ($date_end != '') {
            $date_end = strtotime($date_end);
        }
        $show_info = [
            'id' => $staff_ss['id'],
            'avatar' => $staff_ss['avatar'],
            'name' => $staff_ss['name'],
        ];
        $segment = 2;
        $per_page = 10;
        $url =  urlQlyLichTrinh();
        $num = $this->StaffModel->listSchedule($staff_ss['id'], $key, $date_start, $date_end, $status);
        $page = $this->page(count($num), $segment, $url, $per_page);
        $data["links"] = $this->pagination->create_links();
        $listPageSchedule = $this->StaffModel->listPageSchedule($staff_ss['id'], $per_page, $per_page * ($page - 1), $key, $date_start, $date_end, $status);
        $data['show_info'] = $show_info;
        $data['show_department'] = $this->show_department();
        $data['listPageSchedule'] = $listPageSchedule;
        $data['key'] = $key;
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
        $data['status'] = $status;
        $data['notify'] = $this->notify();
        $this->autoUpdateStatusSchedule();

        $this->load->view('manager/staff/qly_lich_trinh', $data);
    }


    public function export_excel_schedule()
    {
        $staff_ss = $this->session->userdata('staff');
        $key = $this->input->get('key');
        $date_start = $this->input->get('date_start');
        $date_end = $this->input->get('date_end');
        $status = $this->input->get('status');
        if ($date_start != '') {
            $date_start = strtotime($date_start);
        }

        if ($date_end != '') {
            $date_end = strtotime($date_end);
        }
        $list = $this->StaffModel->listSchedule($staff_ss['id'], $key, $date_start, $date_end, $status);
        $th_array = array(
            'B' => 'Thông tin nhân viên(ID)',
            'C' => 'Tên lịch trình',
            'D' => 'ngày tháng',
            'E' => 'Ghi chú',
        );
        foreach ($list as $key => $value) {
            $name = $value->name_staff . '(' . $value->staff_id . ')';
            $date = date("d-m-Y", $value->date_start) . '||' . date("d-m-Y", $value->date_end);
            $tr_array[] = array(
                'B' => $name,
                'C' =>  $value->name,
                'D' => $date,
                'E' =>  $value->note,
            );
        }
        $this->globals->my_export('staff_pc365', 'Thống kê lịch trình nhân viên', $th_array, $tr_array);
    }

    public function lich_trinh_map()
    {

        $staff_ss = $this->session->userdata('staff');
        $show_info = $this->StaffModel->show_info($staff_ss['id']);
        $data['show_info'] = $show_info;
        $data['notify'] = $this->notify();
        $this->load->view('manager/staff/nv_lich_trinh_map', $data);
    }

    public function qlyNhanViec()
    {

        $staff_ss = $this->session->userdata('staff');

        $key1 = $this->input->get('key');
        $date_start = $this->input->get('date_start');
        $date_end = $this->input->get('date_end');
        $status = $this->input->get('status');
        if ($date_start != '') {
            $date_start = strtotime($date_start);
        }

        if ($date_end != '') {
            $date_end = strtotime($date_end);
        }
        $segment = 2;
        $per_page = 10;
        $url =  urlQlyNhanViec();
        $num = $this->StaffModel->countJob($staff_ss['id'], $key1, $date_start, $date_end, $status);
        $page = $this->page(count($num), $segment, $url, $per_page);
        $list = $this->StaffModel->showJob($staff_ss['id'], $per_page, $per_page * ($page - 1), $key1, $date_start, $date_end, $status);
        $info = $this->StaffModel->show_info($staff_ss['id']);
        $data["links"] = $this->pagination->create_links();
        $data["showJobPra"] = $this->StaffModel->showJobPra();
        $show_info = [
            'id' => $staff_ss['id'],
            'avatar' => $staff_ss['avatar'],
            'name' => $staff_ss['name'],
        ];

        $access_token     = $staff_ss['token'];
        $curl             = curl_init();
        $header[]         = 'Authorization: ' . $access_token . '';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php?filter_by[active]=true&id_com=' . $staff_ss['com_id'];
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $show_staff = json_decode($resp);
        $arr_staff = [];
        if ($show_staff->data->items != null) {
            foreach ($show_staff->data->items as $key => $value) {
                $arr_staff[] = [
                    'ep_id' => $value->ep_id,
                    'avatar' => $value->ep_image,
                ];
            }
        }
        curl_close($curl);
        $data['key1'] = $key1;
        $data['arr_staff'] = $arr_staff;
        $data['date_start'] = $date_start;
        $data['date_end'] = $date_end;
        $data['status'] = $status;
        $data['show_info'] = $show_info;
        $data['list'] = $list;
        $data['notify'] = $this->notify();

        $this->load->view('manager/staff/qly_nhan_viec', $data);
    }

    public function detail_job()
    {
        $job_id = $this->input->get('job_id');
        if ($job_id == '') {
            return redirect(urlQlyNhanViec());
        }

        $staff_ss = $this->session->userdata('staff');
        $show_info = $this->StaffModel->show_info($staff_ss['id']);
        $detailJob = $this->StaffModel->detailJob($staff_ss['id'], $job_id);
        $show_job_content = $this->StaffModel->show_job_content($job_id, $staff_ss['id']);

        $access_token     = $staff_ss['token'];
        $curl             = curl_init();
        $header[]         = 'Authorization: ' . $access_token . '';
        $curl     = curl_init();
        $url = 'https://chamcong.24hpay.vn/service/list_all_employee_of_company.php?filter_by[active]=true&id_com=' . $staff_ss['com_id'];
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $show_staff = json_decode($resp);
        $arr_staff = [];
        if ($show_staff->data->items != null) {
            foreach ($show_staff->data->items as $key => $value) {
                $arr_staff[] = [
                    'ep_id' => $value->ep_id,
                    'avatar' => $value->ep_image,
                    'ep_name' => $value->ep_name,
                ];
            }
        }
        curl_close($curl);


        // $job_content = $this->StaffModel->job_content();
        $data['arr_staff'] = $arr_staff;
        $data["showJobPra"] = $this->StaffModel->showJobPra();
        $data["show_city"] = $this->StaffModel->show_city();
        $data['show_info'] = $show_info;
        $data['detailJob'] = $detailJob;
        $data['show_job_content'] = $show_job_content;
        $data['notify'] = $this->notify();

        // $this->autoUpdateStatusJob();

        $this->load->view('manager/staff/chi_tiet_cong_viec', $data);
    }

    public function updateStatusJob()
    {

        $checked = $this->input->post('checked');
        $note_job = $this->input->post('note');
        $noChecked = $this->input->post('noChecked');
        $job_id = $this->input->post('job_id');
        $staff_ss = $this->session->userdata('staff');
        if ($noChecked == '') {
            $show_info = $this->StaffModel->show_info($staff_ss['id']);
            $detailJob = $this->StaffModel->detailJob($staff_ss['id'], $job_id);
            $note = $show_info['name_staff'] . ' vừa hoàn thành công việc: ' . $detailJob['job_name'];
            $data_notify = [
                'staff' => $staff_ss['id'],
                'notify_to_company' => $show_info['company_id'],
                'note' => $note,
                'date' => time(),
                'image_notify' => 3,
            ];

            $insertNotify = $this->StaffModel->insertNotify($data_notify);
        }
        $checked = explode(',', $checked);
        $noChecked = explode(',', $noChecked);
        if ($checked == '' && $noChecked == '') {
            $result = [
                'result' => false,
                'message' => "Vui lòng nhập đủ các trường",
            ];
        } else {
            for ($i = 0; $i < count($checked); $i++) {
                $id = [
                    'content_staff_id' => $checked[$i],
                    'staff_id' => $staff_ss['id'],
                ];
                $data = [
                    'status' => 1,
                ];
                $this->StaffModel->update_job_content($data, $id);
            }
            for ($i = 0; $i < count($noChecked); $i++) {
                $id = [
                    'content_staff_id' => $noChecked[$i],
                    'staff_id' => $staff_ss['id'],
                ];
                $data = [
                    'status' => 2,
                ];
                $this->StaffModel->update_job_content($data, $id);
            }
            $note_job = explode("||", $note_job);
            for ($i = 0; $i < count($note_job) - 1; $i++) {
                var_dump($note_job[$i]);
                $data_note_job = [
                    'job_id' => $job_id,
                    'staff_id' => $staff_ss['id'],
                    'note' => $note_job[$i],
                    'created_at' => time(),
                    'updated_at' => time(),
                ];
                $this->StaffModel->create_job_note($data_note_job);
            }
            $result = [
                'result' => true,
                'message' => "Cập nhật việc cần làm thành công",
            ];

            // $this->autoUpdateStatusJob();
        }
        echo json_encode($result);
    }

    public function baoLoi()
    {

        $staff_ss = $this->session->userdata('staff');
        $show_info = $this->StaffModel->show_info($staff_ss['id']);
        $data['show_info'] = $show_info;
        $data['notify'] = $this->notify();
        $this->load->view('manager/staff/nv_bao_loi', $data);
    }

    public function dangxuat()
    {
        // 
        // $staff_ss = $this->session->userdata('staff');
        // $show_info = $this->StaffModel->show_info($staff_ss['id']);
        // $data['show_info'] = $show_info;
        // $this->load->view('manager/staff/nv_bao_loi', $data);
    }

    public function info()
    {
        $staff_ss = $this->session->userdata('staff');
        $show_info = $this->StaffModel->show_info($staff_ss['id']);
        $data['show_info'] = $show_info;
        $data['show_department'] = $this->show_department();
        $data['title'] = 'Chi tiết thông tin nhân viên';
        $data['style'] = 'nv_qly';
        $data['js'] = 'profile';
        $data['content'] = 'manager/staff/staff_info';
        $data['notify'] = $this->notify();
        $this->load->view('manager/staff/staff', $data);
    }

    public function update_info()
    {

        $staff_ss = $this->session->userdata('staff');
        $show_info = $this->StaffModel->show_info($staff_ss['id']);
        $data['show_info'] = $show_info;
        $data['show_department'] = $this->show_department();
        $path = "images_staff/";
        $data['title'] = 'Cập nhật thông tin nhân viên';
        $data['style'] = 'nv_qly';
        $data['js'] = 'profile';
        $data['content'] = 'manager/staff/staff_update';
        $data['notify'] = $this->notify();
        $this->load->view('manager/staff/staff', $data);
    }

    public function updateStaff()
    {
        $staff_ss = $this->session->userdata('staff');

        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        if ($name == "" || $phone == "") {
            $result = [
                'result' => false,
                'message' => "Vui lòng nhập đủ các trường",
            ];
        } else {
            $curl = curl_init();
            $access_token       = $staff_ss['token'];
            $header[]         = 'Authorization: ' . $access_token . '';
            $avatar_name = $staff_ss['avatar'];
            if (isset($_FILES['avatar'])) {
                $filename = $_FILES['avatar']['name'];
                $filetype = $_FILES['avatar']['type'];
                $filedata = $_FILES['avatar']['tmp_name'];
                $data_logo = array(
                    'id_ep' => $staff_ss['id'],
                    'logo' => curl_file_create($filedata, $filetype, $filename)
                );
                $url = 'https://chamcong.24hpay.vn/service/update_logo_employee.php';
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
                $update_logo_ep = json_decode($resp);

                if ($update_logo_ep->error != null) {
                    $result = [
                        'result' => false,
                        'message' => $update_logo_ep->error->message,
                    ];
                } else {
                    $avatar_name = 'https://chamcong.24hpay.vn/upload/employee/' . $update_logo_ep->data->id;
                }
            }
            $data = array(
                'ep_name' => $name,
                'ep_phone' => $phone,
            );
            $url = 'https://chamcong.24hpay.vn/service/update_user_info_employee.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            $update_ep = json_decode($resp);
            curl_close($curl);
            $session_staff = [
                'token'     => $staff_ss['token'],
                'id'        => $staff_ss['id'],
                'email'     => $staff_ss['email'],
                'name'      => $name,
                'avatar'    => $avatar_name,
                'com_id'    => $staff_ss['com_id'],
                'com_name'  => $staff_ss['com_name'],
                'type'      => 3,
                'dep_name'  => $staff_ss['dep_name'],
                'ep_phone'  => $staff_ss['ep_phone'],
            ];


            if ($update_ep->error != null) {
                $result = [
                    'result' => true,
                    'message' => $update_ep->error->message,
                ];
            } else {
                $this->session->set_userdata('staff', $session_staff);
                $result = [
                    'result' => true,
                    'message' => "Cập nhật thông tin thành công",
                    'avatar' => $avatar_name,
                ];
            }
        }
        echo json_encode($result);
    }

    public function update_pass()
    {

        $staff_ss = $this->session->userdata('staff');
        $show_info = $this->StaffModel->show_info($staff_ss['id']);
        $this->_data['title'] = 'Đổi mật khẩu nhân viên';
        $this->_data['style'] = 'nv_qly';
        $this->_data['js'] = 'profile';
        $this->_data['show_info'] = $show_info;
        $this->_data['content'] = 'manager/staff/staff_updatepass';
        $this->_data['notify'] = $this->notify();
        $this->load->view('manager/staff/staff', $this->_data);
    }

    public function updatePass()
    {
        $staff_ss = $this->session->userdata('staff');
        $pass_new = $this->input->post('new_pass');
        $old_pass = $this->input->post('old_pass');
        if ($pass_new == "" || $old_pass == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin!',
            ];
        } else {
            $curl = curl_init();
            $access_token       = $staff_ss['token'];
            $header[]         = 'Authorization: ' . $access_token;
            $data = array(
                'new_pass' => $pass_new,
                'old_pass' => $old_pass,
            );
            $url = 'https://chamcong.24hpay.vn/service/change_pass_employee.php';
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url,
                CURLOPT_USERAGENT => 'chamcong.timviec365.com',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $data
            ));
            $resp = curl_exec($curl);
            $update_pass = json_decode($resp);
            curl_close($curl);
            $result = [
                'result' => true,
                'message' => 'Đổi mật khẩu thành công',
            ];
            if ($update_pass->error != null) {
                $result = [
                    'result' => false,
                    'message' => $update_pass->error->message,
                ];
            }
        }
        echo json_encode($result);
    }

    public function error()
    {
        $note = $this->input->post('note');
        $staff_ss = $this->session->userdata('staff');
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
                'com_id' => $id,
                'id_com_small' => $id_small,
                'staff_id' => $staff_ss['id'],
                'content' => $note,
            ];
            $id_error = $this->StaffModel->error($data_insert);
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
                            $insert_images = $this->StaffModel->error_images($data_img_error);
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

    public function evaluate()
    {
        $staff_ss = $this->session->userdata('staff');
        $star = $this->input->post('star');
        $note = $this->input->post('note');
        if ($star == "") {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường',
            ];
        } else {
            $data = [
                'id_com' => 0,
                'id_com_small' => 0,
                'id_staff' => $staff_ss['id'],
                'star' => $star,
                'detail_evaluate' => $note,
                'created_at' => time(),
                'updated_at' => time(),
            ];
            $create = $this->StaffModel->evaluate($data);
            $result = [
                'result' => true,
                'message' => 'Cảm ơn bạn đã đánh giá',
            ];
        }
        echo json_encode($result);
    }

    public function updateNotify()
    {
        $status = $this->input->post('status');
        $staff_ss = $this->session->userdata('staff');
        if ($status == '' || $staff_ss['id'] == '') {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường'
            ];
        } else {
            $arr_data = [
                'status' => $status,
            ];

            $arr_id = [
                'notify_to_staff' => $staff_ss['id'],
            ];

            $updateNotify = $this->StaffModel->updateNotify($arr_data, $arr_id);
            $result = [
                'result' => true,
                'message' => 'Cập nhật thành công'
            ];
        }
        echo json_encode($result);
    }

    public function autoUpdateStatusJob()
    {
        $staff_ss = $this->session->userdata('staff');
        $show_info = $this->StaffModel->show_info($staff_ss['id']);
        $time = strtotime(date('Y-m-d'));
        $list_job_by_idCom = $this->StaffModel->list_job_by_idCom($show_info['company_id']);
        foreach ($list_job_by_idCom as $value1) {

            $dalam = 0;
            $chualam = 0;
            $status1 = 0;
            $check = $this->StaffModel->check($value1['job_id'], $staff_ss['id']);
            foreach ($check as $valuecheck) {
                if ($valuecheck['status'] == 1) {
                    $dalam++;
                } else {
                    $chualam++;
                }
            }
            if (count($check) != $chualam && count($check) == $dalam) {
                $status1 = 2;
            } else if (count($check) == $chualam && count($check) != $dalam) {
                $status1 = 4;
            } else {
                $status1 = 3;
            }
            $arr_data = [
                'status' => $status1,
            ];
            $arr_id = [
                'staff_id' => $staff_ss['id'],
                'job_id' => $value1['job_id'],
            ];
            $this->StaffModel->update_job_participants($arr_data, $arr_id);
            $dHuy = 0;
            $dLam = 0;
            $dangl = 0;
            $dKien = 0;

            $check_job_participants = $this->StaffModel->check_job_participants($value1['job_id']);
            foreach ($check_job_participants as $value_pra) {
                if ($value_pra['status'] == 1) {
                    $dHuy++;
                } else if ($value_pra['status'] == 2) {
                    $dLam++;
                } else if ($value_pra['status'] == 3) {
                    $dangl++;
                } else if ($value_pra['status'] == 4) {
                    $dKien++;
                }
            }
            if ($value1['status'] != 2) {
                if (count($check_job_participants) == $dHuy && count($check_job_participants) != $dLam && count($check_job_participants) != $dangl && count($check_job_participants) != $dKien) {
                    $status = 1;
                } else if (count($check_job_participants) != $dHuy && count($check_job_participants) == $dLam && count($check_job_participants) != $dangl && count($check_job_participants) != $dKien) {
                    $status = 2;
                } else if (count($check_job_participants) != $dHuy && count($check_job_participants) != $dLam && count($check_job_participants) == $dangl && count($check_job_participants) != $dKien) {
                    $status = 3;
                } else if (count($check_job_participants) != $dHuy && count($check_job_participants) != $dLam && count($check_job_participants) != $dangl && count($check_job_participants) == $dKien) {
                    $status = 4;
                } else {
                    $status = 1;
                }
                $arr_data_job = [
                    'status' => $status,
                ];
                $arr_id_job = [
                    'job_id' => $value1['job_id'],
                ];
            }
            $this->StaffModel->update_job($arr_data_job, $arr_id_job);
        }
    }
    public function autoUpdateStatusSchedule()
    {
        $staff_ss = $this->session->userdata('staff');
        $show_info = $this->StaffModel->show_info($staff_ss['id']);

        $list_schedule_by_idCom = $this->StaffModel->list_schedule_by_idCom($show_info['company_id']);
        foreach ($list_schedule_by_idCom as $value) {
            $check = $this->StaffModel->check_schedule($value['id'], $staff_ss['id']);
            $dalam = 0;
            $chualam = 0;
            $status1 = 0;
            foreach ($check as $valuecheck) {
                if ($valuecheck['status'] == 1) {
                    $dalam++;
                } else {
                    $chualam++;
                }
            }
            if (count($check) != $chualam && count($check) == $dalam) {
                $status1 = 2;
            } else if (count($check) == $chualam && count($check) != $dalam) {
                $status1 = 4;
            } else {
                $status1 = 3;
            }
            $arr_data = [
                'status' => $status1,
            ];
            $arr_id = [
                'staff_id' => $staff_ss['id'],
                'schedule_id' => $value['id'],
            ];
            $update = $this->StaffModel->update_schedule_staff($arr_data, $arr_id);
            $dHuy = 0;
            $dLam = 0;
            $dangl = 0;
            $dKien = 0;

            $check_schedule_staff = $this->StaffModel->check_schedule_staff($value['id']);
            foreach ($check_schedule_staff as $value_pra) {
                if ($value_pra['status'] == 1) {
                    $dHuy++;
                } else if ($value_pra['status'] == 2) {
                    $dLam++;
                } else if ($value_pra['status'] == 3) {
                    $dangl++;
                } else if ($value_pra['status'] == 4) {
                    $dKien++;
                }
            }
            if (count($check_schedule_staff) == $dHuy && count($check_schedule_staff) != $dLam && count($check_schedule_staff) != $dangl && count($check_schedule_staff) != $dKien) {
                $status = 1;
            } else if (count($check_schedule_staff) != $dHuy && count($check_schedule_staff) == $dLam && count($check_schedule_staff) != $dangl && count($check_schedule_staff) != $dKien) {
                $status = 2;
            } else if (count($check_schedule_staff) != $dHuy && count($check_schedule_staff) != $dLam && count($check_schedule_staff) == $dangl && count($check_schedule_staff) != $dKien) {
                $status = 3;
            } else if (count($check_schedule_staff) != $dHuy && count($check_schedule_staff) != $dLam && count($check_schedule_staff) != $dangl && count($check_schedule_staff) == $dKien) {
                $status = 4;
            } else {
                $status = 3;
            }
            $arr_data_schedule = [
                'status' => $status,
            ];
            $arr_id_schedule = [
                'id' => $value['id'],
            ];
            // var_dump($value['id']);
            // var_dump(count($check_schedule_staff));
            // var_dump($dHuy);
            // var_dump($dLam);
            // var_dump($dangl);
            // var_dump($dKien);
            // var_dump($status);
            $this->StaffModel->update_schedele($arr_data_schedule, $arr_id_schedule);
        }
    }

    public function deleteNotifystaff()
    {
        $status = $this->input->post('status');
        $staff_ss = $this->session->userdata('staff');
        if ($status == '' || $staff_ss['id'] == '') {
            $result = [
                'result' => false,
                'message' => 'Vui lòng nhập đủ các trường'
            ];
        } else {
            $arr_data = [
                'status' => $status,
            ];

            $arr_id = [
                'notify_to_staff' => $staff_ss['id'],
            ];

            $deleteNotiffy = $this->StaffModel->deleteNotiffy($arr_data);
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
        $staff_ss = $this->session->userdata('staff');
        $list_late = [];
        $list_early = [];
        $khong_diem_danh = [];
        $di_muon_ve_som = [];

        for ($i = 0; $i < 7; $i++) {
            $day = strtotime(date("d-m-Y", $monday) . "+" . $i . " days");
            $date_start = date('d-m-Y', $day);
            $date_end = date('d-m-Y', $day);
            $show_info = $this->StaffModel->show_info($staff_ss['id']);
            $list_shift             = $this->StaffModel->list_shift($show_info['company_id']);
            $show_time_sheet        = $this->StaffModel->show_time_sheet($show_info['staff_id'], '', $date_start, $date_end);
            $arr_sheet = [];
            foreach ($show_time_sheet as $sheets => $sheet) {
                $index_sheet = $sheet['staff_id'] . '_' . date("d_m_Y", strtotime($sheet['at_time']));
                $shift = [];
                $shift_1 = [];
                foreach ($list_shift as $value_shifts => $value_shift) {
                    $show_sheet_by_id_shift_min = [];
                    $show_sheet_by_id_shift_max = [];

                    $show_sheet_by_id_shift_min         = $this->StaffModel->count_sheet_by_id_shift_min($value_shift['id_shift'], $sheet['staff_id'], $sheet['at_time'], $value_shift['time_in'], $value_shift['time_out']);

                    $show_sheet_by_id_shift_max         = $this->StaffModel->count_sheet_by_id_shift_max($value_shift['id_shift'], $sheet['staff_id'], $sheet['at_time'], $value_shift['time_in'], $value_shift['time_out']);

                    $out_shift = null;
                    if ($show_sheet_by_id_shift_max['out_shift'] != '' && $show_sheet_by_id_shift_max['out_shift'] != $show_sheet_by_id_shift_min['in_shift']) {
                        $out_shift = $show_sheet_by_id_shift_max['out_shift'];
                    }

                    $shift[] = [
                        'in_shift' => $show_sheet_by_id_shift_min['in_shift'],
                        'out_shift' => $out_shift,
                    ];

                    $count_on_time_min = [];
                    $count_on_time_max = [];

                    $count_on_time_min         = $this->StaffModel->count_on_time_min($value_shift['id_shift'], $sheet['staff_id'], $sheet['at_time'], $value_shift['time_in'], $value_shift['time_out']);

                    $count_on_time_max         = $this->StaffModel->count_on_time_max($value_shift['id_shift'], $sheet['staff_id'], $sheet['at_time'], $value_shift['time_in'], $value_shift['time_out']);

                    $out_shift1 = null;
                    if ($count_on_time_max['out_shift'] != '' && $count_on_time_max['out_shift'] != $count_on_time_min['in_shift']) {
                        $out_shift = $count_on_time_max['out_shift'];
                    }

                    $shift_1[] = [
                        'in_shift_1' => $count_on_time_min['in_shift'],
                        'out_shift_1' => $count_on_time_max['out_shift'],
                    ];
                }

                $arr_sheet[$index_sheet] = [
                    'staff_id' => $sheet['staff_id'],
                    'name_staff' => $sheet['name_staff'],
                    'avatar' => $sheet['avatar'],
                    'department' => $sheet['department'],
                    'date' => date("d-m-Y", strtotime($sheet['at_time'])),
                    'list' => $shift,
                    'list_1' => $shift_1,
                ];
            }
            $dem = 0;
            $dem1 = 0;
            $dem2 = 0;
            $dem3 = 0;
            $dem_total = 0;
            $dem_total_1 = 0;
            foreach ($arr_sheet as $key => $value) {
                foreach ($value['list'] as $key => $valueList) {
                    if ($valueList['in_shift'] != '') {
                        $dem++;
                    }

                    if ($valueList['out_shift'] != '') {
                        $dem1++;
                    }
                    $dem_total++;
                }

                foreach ($value['list_1'] as $key => $valueList_1) {
                    if ($valueList_1['in_shift_1'] != '') {
                        $dem2++;
                    }
                    if ($valueList_1['out_shift_1'] != '') {
                        $dem3++;
                    }
                    $dem_total_1++;
                }
            }
            $total = $dem + $dem1;
            $total_1 = $dem2 + $dem3;
            $total_3 = 0;
            if (($total + $total_1) > ($dem_total_1 + $dem_total)) {
                $total_3 = ($total + $total_1) - ($dem_total_1 + $dem_total);
            } else {
                $total_3 = ($dem_total_1 + $dem_total) - ($total + $total_1);
            }
            $di_muon_ve_som[] = $total;
            $dung_gio[] = $total_1;
            $khong_diem_danh[] = $total_3;
        }
        $result = [
            'di_muon_ve_som' => $di_muon_ve_som,
            'dung_gio' => $dung_gio,
            'khong_diem_danh' => $khong_diem_danh,
        ];
        echo json_encode($result);
    }
}
