<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
// quang ********************************************************************************************************
// trang chủ
$route['gioi-thieu.html'] = 'home/HomeController/gioithieu';
$route['huong-dan.html'] = 'home/HomeController/huongdan';
$route['download.html'] = 'home/HomeController/download';
$route['dang-nhap.html'] = 'home/HomeController/dangnhap';
$route['dang-ky.html'] = 'home/HomeController/dangky';
$route['quy-dinh-bao-mat.html'] = 'home/HomeController/information_security';
$route['quan-ly-nhan-dien-khuon-mat.html'] = 'company/Company_controller/face';
$route['quan-ly-nhan-dien-khuon-mat.html/(:num)'] = 'company/Company_controller/face';

// staff
$route['dang-ky-nhan-vien.html'] = 'staff/StaffRegisterController/staff_register';
$route['xac-thuc-nhan-vien.html'] = 'staff/StaffLoginController/xac_thuc_nv';

$route['quen-mat-khau-nhan-vien.html'] = 'staff/StaffLoginController/staff_getpass';

$route['quan-ly-chung-nhan-vien.html'] = 'staff/StaffController/qlyChungNv';
$route['quan-ly-cham-cong-nhan-vien.html'] = 'staff/StaffController/qlyChamCong';
$route['quan-ly-cham-cong-nhan-vien.html/(:num)'] = 'staff/StaffController/qlyChamCong';
$route['quan-ly-lich-trinh-nhan-vien.html'] = 'staff/StaffController/qlyLichTrinh';
$route['quan-ly-lich-trinh-nhan-vien.html/(:num)'] = 'staff/StaffController/qlyLichTrinh';
$route['nhan-viec.html'] = 'staff/StaffController/qlyNhanViec';
$route['nhan-viec.html/(:num)'] = 'staff/StaffController/qlyNhanViec';
$route['chi-tiet-cong-viec-nhan-vien.html'] = 'staff/StaffController/detail_job';
$route['chi-tiet-thong-tin-nhan-vien.html'] = 'staff/StaffController/info';
$route['cap-nhat-thong-tin-nhan-vien.html'] = 'staff/StaffController/update_info';
$route['doi-mat-khau-nhan-vien.html'] = 'staff/StaffController/update_pass';
$route['bao-loi-nhan-vien.html'] = 'staff/StaffController/baoLoi';
$route['lich-trinh-cua-toi.html'] = 'staff/StaffController/lich_trinh_map';
$route['cap-nhat-trang-thai-cong-viec.html'] = 'staff/StaffController/autoUpdateStatusJob';
$route['cap-nhat-trang-thai-lich-trinh.html'] = 'staff/StaffController/autoUpdateStatusSchedule';









// company
$route['tao-lich-trinh.html'] = 'company/Company_controller/create_schedule';
$route['danh-cho-cong-ty/danh-sach-lich-trinh.html'] = 'company/Company_controller/schedule';
$route['danh-sach-phong-ban.html'] = 'company/Company_controller/list_department';
$route['danh-sach-phong-ban.html/(:num)'] = 'company/Company_controller/list_department';
$route['quan-ly-nhan-vien-cong-ty.html/(:num)'] = 'company/Company_controller/list_staff/$a';
$route['quan-ly-nhan-vien-cong-ty.html/(:num)/(:num)'] = 'company/Company_controller/list_staff/$a/$b';
$route['xuat-excel-nhan-vien.html/(:num)'] = 'company/Company_controller/export_excel/$a';
$route['xuat-excel-lich-trinh.html'] = 'company/Company_controller/export_excel_schedule';
$route['cap-nhat-trang-thai-cong-viec-cong-ty.html'] = 'company/Company_controller/autoUpdateStatusJob';


$route['quen-mat-khau-cong-ty.html'] = 'company/Company_controller/company_getpass';

// company
$route['dang-nhap-cong-ty.html'] = "company/Company_controller/login_company";
// Đăng ký
$route['dang-ky-cong-ty.html'] = "company/Company_controller/view_sign_up_company";
$route['xac-thuc-dang-ky.html'] = "company/Company_controller/view_verification_signup";
$route['hoan-tat-dang-ky.html'] = "company/Company_controller/sign_up_complete";
// quản lý chung
$route['quan-ly-cong-ty.html'] = 'company/Company_controller/quan_ly_cty';
// quản lý chấm công
$route['quan-ly-cham-cong.html'] = 'company/Company_controller/qly_cham_cong';
$route['quan-ly-cham-cong.html/(:num)'] = 'company/Company_controller/qly_cham_cong';
// Quản lý nhân viên
// $route['danh-cho-cong-ty/quan-ly-nhan-vien.html'] = 'company/Company_controller/qly_nhan_vien';
// Quản lý lịch trình
$route['quan-ly-lich-trinh.html'] = 'company/Company_controller/lich_trinh_nv';
$route['quan-ly-lich-trinh.html/(:num)'] = 'company/Company_controller/lich_trinh_nv';
// $route['danh-cho-cong-ty/tao-lich-trinh.html'] = 'company/Company_controller/tao_lich_trinh';
$route['sua-lich-trinh.html'] = 'company/Company_controller/sua_lich_trinh';
// $route['danh-cho-cong-ty/lich-trinh-nhan-vien-tren-map.html'] = 'company/Company_controller/lich_trinh_map';
$route['nhan-vien-cung-lich.html'] = 'company/Company_controller/nv_cung_lich';
// quản lý giao việc
$route['giao-viec.html'] = 'company/Company_controller/qly_giao_viec';
$route['giao-viec.html/(:num)'] = 'company/Company_controller/qly_giao_viec';
// Chi tiết công việc
$route['chi-tiet-cong-viec.html'] = 'company/Company_controller/chitiet_cong_viec';
$route['tao-cong-viec.html'] = 'company/Company_controller/tao_cong_viec';
$route['cap-nhat-cong-viec.html'] = 'company/Company_controller/sua_cong_viec';
// Thông tin công ty
$route['thong-tin-cong-ty.html'] = 'company/Company_controller/cty_thongtin';
$route['cap-nhat-thong-tin-cong-ty.html'] = 'company/Company_controller/cty_update_thongtin';
// Đổi mật khẩu công ty
$route['doi-mat-khau-cong-ty.html'] = 'company/Company_controller/cty_doi_mk';
// báo lỗi
$route['bao-loi-cong-ty.html'] = 'company/Company_controller/cty_baoloi';
// Quản lý côgn ty con
$route['danh-sach-cong-ty-con.html'] = 'company/Company_controller/ds_cty_con';
$route['danh-sach-cong-ty-con.html/(:num)'] = 'company/Company_controller/ds_cty_con';
// Quản lý phòng ban
// $route['danh-cho-cong-ty/danh-sach-phong-ban.html'] = 'company/Company_controller/ds_phong_ban';
// DS nhân viên phòng ban
$route['danh-sach-nhan-vien-theo-phong-ban.html'] = 'company/Company_controller/ds_nv_phong';
$route['danh-sach-nhan-vien-theo-phong-ban.html/(:num)'] = 'company/Company_controller/ds_nv_phong';
// Quản lý truy cập
$route['quan-ly-quyen-truy-cap.html'] = 'company/Company_controller/quyen_truy_cap';
$route['quan-ly-quyen-truy-cap.html/(:num)'] = 'company/Company_controller/quyen_truy_cap';
// Cấu hình chấm công
$route['cau-hinh-cham-cong.html'] = 'company/Company_controller/cau_hinh_cham_cong';
// DS ca làm
$route['danh-sach-ca-lam-viec.html'] = 'company/Company_controller/ds_ca_lam';
$route['danh-sach-ca-lam-viec.html/(:num)'] = 'company/Company_controller/ds_ca_lam';
// danh sách lịch làm việc
$route['danh-sach-lich-lam-viec.html'] = 'company/Company_controller/ds_llv';
$route['danh-sach-lich-lam-viec.html/(:num)'] = 'company/Company_controller/ds_llv';
$route['thiet-lap-lich-lam-viec.html'] = 'company/Company_controller/them_llv';
$route['sua-lich-lam-viec.html'] = 'company/Company_controller/sua_llv';
// thêm nhân viên theo lịch
$route['them-nhan-vien-vao-lich-lam-viec.html'] = 'company/Company_controller/them_nhan_vien';
$route['danh-sach-nhan-vien-co-lich.html'] = 'company/Company_controller/ds_nv_co_lich';

$route['lich-lam-viec-cua-nhan-vien.html'] = 'company/Company_controller/llv_cua_nv';
$route['lich-lam-viec-cua-nhan-vien.html/(:num)'] = 'company/Company_controller/llv_cua_nv';

$route['chi-tiet-nhan-vien.html'] = 'company/Company_controller/detail_staff';



//lực -------------------------------------
$route['dang-xuat.html'] = 'home/HomeController/logout';
// $route['page/(:num)'] = 'page';












include "api_routes.php";
