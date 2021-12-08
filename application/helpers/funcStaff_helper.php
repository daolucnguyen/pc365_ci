<?php

function checkLoginStaff()
{
    $CI = &get_instance();
    $CI->load->library('session');
    $checkLogin = $CI->session->userdata('staff');
    if (!isset($checkLogin)) {
        return redirect('/');
    }
}

function checkSession()
{
    $CI = &get_instance();
    $CI->load->library('session');
    $ss = $CI->session->userdata('company');
    $ss_staff = $CI->session->userdata('staff');
    // $check = 0;
    if (isset($ss) || isset($ss_staff)) {
        return 1;
    } else {
        return 0;
    }
}

function urlQlyChungNv(){
    return base_url()."quan-ly-chung-nhan-vien.html";
}

function urlQlyChamCong()
{
    return base_url()."quan-ly-cham-cong-nhan-vien.html";
}

function urlQlyLichTrinh()
{
    return base_url()."quan-ly-lich-trinh-nhan-vien.html";
}

function urlLichTrinhMap()
{
    return base_url()."lich-trinh-cua-toi.html";
}

function urlQlyNhanViec()
{
    return base_url()."nhan-viec.html";
}

function urlChiTietCongViec()
{
    return base_url()."chi-tiet-cong-viec-nhan-vien.html";
}

function urlThongTinNV()
{
    return base_url()."chi-tiet-thong-tin-nhan-vien.html";
}

function urlDoiMatKhau()
{
    return base_url()."doi-mat-khau-nhan-vien.html";
}

function urlCapNhatThongTinNV()
{
    return base_url()."cap-nhat-thong-tin-nhan-vien.html";
}

function urlBaoLoi()
{
    return base_url()."bao-loi-nhan-vien.html";
}

function urlDangXuat()
{
    return base_url()."dang-xuat.html";
}