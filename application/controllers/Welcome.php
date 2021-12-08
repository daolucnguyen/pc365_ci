<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	protected $_data;
	public function __construct()
    {
        /*call CodeIgniter's default Constructor*/
        parent::__construct();

        /*load database libray manually*/
        $this->load->database();

        /*load Model*/
        $this->load->model('company/Company_model');
        /*load Model*/
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
        $check = checkSession();
		$company_ss = $this->session->userdata('company');
		$staff_ss = $this->session->userdata('staff');
		$type = 0;
		if (isset($company_ss)) {
			$this->_data['name'] = $company_ss['name'];
			$this->_data['avatar'] = $company_ss['avatar'];
			$this->_data['type'] = $company_ss['type'];
		}
		if (isset($staff_ss)) {
			$type = $staff_ss['type'];
			$this->_data['name'] = $staff_ss['name'];
			$this->_data['avatar'] = $staff_ss['avatar'];
			$this->_data['type'] = $staff_ss['type'];

		}
        $this->_data['session'] = $check;
        $this->_data['type'] = $type;
		$this->_data['style'] = 'main_header';
		$this->_data['google'] = 'EIV7wHDvaTZkVpsLjmM4_neYDyPLTmjV9du0A8ho4TU';
		$this->_data['title'] = 'Punclock365 -  App chấm công và theo dõi lộ trình qua GPS miễn phí';
		$this->_data['Des'] = 'Tải miễn phí ngay app chấm công theo công nghệ mới áp dụng tính năng định vị qua GPS chính xác. Theo dõi lộ trình của nhân viên chuẩn xác, giúp quản lý nhân viên từ xa hiệu quả.';
		$this->_data['Key'] = 'App chấm công, PC365';
		$this->_data['content'] = 'home/trangchu';
		$this->_data['index'] = 'index,follow';
		// $this->_data['avatar'] = $info['com_avatar'];
		$this->load->view('home/main',$this->_data);
	}
}
