<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller
{
    protected $_data;
    public function __construct()
    {
        /*call CodeIgniter's default Constructor*/
        parent::__construct();

        /*load database libray manually*/
        $this->load->database();

        /*load Model*/
        $this->load->model('company/Company_model');
        $this->load->model('staff/StaffModel');
        /* session */
        $this->load->library('session');
        /* xóa dấu */
        $this->load->helper('text');
        /*upload ảnh*/
        $this->load->library('upload');

        $this->load->helper('resize_image');

        // check login_company
        $this->load->helper('func');
    }

    public function index()
    {
        $this->load->helper('url');
        $this->_data['style'] = 'main_header';
        $this->_data['title'] = 'Punclock365 -  App chấm công và theo dõi lộ trình qua GPS miễn phí';
        $check = checkSession();
        var_dump($check);
        die();
        $this->_data['session'] = $check;
        $this->_data['content'] = 'home/trangchu';
        $this->load->view('home/main', $this->_data);
    }
    public function gioithieu()
    {
        $check = checkSession();
        $company_ss = $this->session->userdata('company');
        $staff_ss = $this->session->userdata('staff');
        $type = 0;
		if (isset($company_ss)) {
			$type = $company_ss['type'];
			$this->_data['name'] =  $company_ss['name'];
			$this->_data['avatar'] = $company_ss['avatar'];
		}
		if (isset($staff_ss)) {
			$type = $staff_ss['type'];
			$this->_data['name'] = $staff_ss['name'];
			$this->_data['avatar'] = $staff_ss['avatar'];
		}
        $this->_data['session'] = $check;
        $this->_data['type'] = $type;
        $this->load->helper('url');
        $this->_data['title'] = 'Hướng dẫn';
        $this->_data['content'] = 'home/huongdan';
        $this->load->view('home/main', $this->_data);
    }
    public function huongdan()
    {
        $check = checkSession();
        $company_ss = $this->session->userdata('company');
        $staff_ss = $this->session->userdata('staff');
        $type = 0;
		if (isset($company_ss)) {
			$type = $company_ss['type'];
			$this->_data['name'] =  $company_ss['name'];
			$this->_data['avatar'] = $company_ss['avatar'];
		}
		if (isset($staff_ss)) {
			$type = $staff_ss['type'];
			$this->_data['name'] = $staff_ss['name'];
			$this->_data['avatar'] = $staff_ss['avatar'];
		}
        $this->_data['session'] = $check;
        $this->_data['type'] = $type;
        $this->load->helper('url');
        $this->_data['title'] = 'Giới thiệu';
        $this->_data['content'] = 'home/gioithieu';
        $this->load->view('home/main', $this->_data);
    }
    public function download()
    {
        $check = checkSession();
        $company_ss = $this->session->userdata('company');
        $staff_ss = $this->session->userdata('staff');
        $type = 0;
		if (isset($company_ss)) {
			$type = $company_ss['type'];
			$this->_data['name'] =  $company_ss['name'];
			$this->_data['avatar'] = $company_ss['avatar'];
		}
		if (isset($staff_ss)) {
			$type = $staff_ss['type'];
			$this->_data['name'] = $staff_ss['name'];
			$this->_data['avatar'] = $staff_ss['avatar'];
		}
        $this->_data['session'] = $check;
        $this->_data['type'] = $type;
        $this->load->helper('url');
        $this->_data['title'] = 'Download';
        $this->_data['content'] = 'home/download';
        $this->load->view('home/main', $this->_data);
    }
    public function information_security()
    {
        $check = checkSession();
        $company_ss = $this->session->userdata('company');
        $staff_ss = $this->session->userdata('staff');
        $type = 0;
		if (isset($company_ss)) {
			$type = $company_ss['type'];
			$this->_data['name'] =  $company_ss['name'];
			$this->_data['avatar'] = $company_ss['avatar'];
		}
		if (isset($staff_ss)) {
			$type = $staff_ss['type'];
			$this->_data['name'] = $staff_ss['name'];
			$this->_data['avatar'] = $staff_ss['avatar'];
		}
        $this->_data['session'] = $check;
        $this->_data['type'] = $type;
        $this->load->helper('url');
        $this->_data['title'] = 'Bảo mật thông tin';
        $this->_data['content'] = 'home/information_security';
        $this->_data['style'] = 'infomation_security';
        $this->load->view('home/main', $this->_data);
    }
    public function dangnhap()
    {
        $check = checkSession();
        if ($check == 0) {
            $this->_data['session'] = $check;
            $this->load->helper('url');
            $this->_data['title'] = 'Lựa chọn đăng nhập';
            $this->_data['content'] = 'home/dashboard_login';
            $this->load->view('home/main', $this->_data);
        } else {
            return redirect('/');
        }
    }
    public function dangky()
    {
        $check = checkSession();
        if ($check == 0) {
            $this->_data['session'] = $check;
            $this->load->helper('url');
            $this->_data['title'] = 'Lựa chọn đăng ký';
            $this->_data['content'] = 'home/dashboard_register';
            $this->load->view('home/main', $this->_data);
        } else {
            return redirect('/');
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        return redirect('/');
        // $check = checkSession();
        // $this->_data['session'] = $check;
        // $this->_data['style'] = 'main_header';
        // $this->_data['title'] = 'Trang chủ';
        // $this->_data['content'] = 'home/trangchu';
        // $data_com = $this->session->userdata('company');
        // $info = $this->Company_model->infor_company($data_com['email']);
        // $this->_data['name'] = $info['com_name'];
        // $this->_data['avatar'] = $info['com_avatar'];
        // $this->load->view('home/main',$this->_data);
    }
}
