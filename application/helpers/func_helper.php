<?php


// check login

// $CI = &get_instance();
function checkLogin()
{
    $CI = &get_instance();
    $CI->load->library('session');
    $checkLogin = $CI->session->userdata('company');
    if (!isset($checkLogin)) {
        return redirect('/');
    }
}

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

// nhân viên

function urlQlyChungNv()
{
    return base_url() . "quan-ly-chung-nhan-vien.html";
}

// công ty
function urlDangKy()
{
    return base_url() . "dang-ky.html";
}
function urlQlyCty()
{
    return base_url() . "quan-ly-cong-ty.html";
}

function urlQlyChamCongCty()
{
    return base_url() . "quan-ly-cham-cong.html";
}

function urlFace()
{
    return base_url() . "quan-ly-nhan-dien-khuon-mat.html";
}
function urlQlyNhanVienCty()
{
    return base_url() . "quan-ly-nhan-vien-cong-ty.html";
}
function urlQlyNhanVienCtyActive($a)
{
    return base_url() . "quan-ly-nhan-vien-cong-ty.html/" . $a;
}

function urlExportExcelStaff($a, $b, $c, $d)
{
    return base_url() . "xuat-excel-nhan-vien.html/" . $a . "/" . $b . "/" . $c . "/" . $d;
}

function urlChiTietNhanVien()
{
    return base_url() . "chi-tiet-nhan-vien.html";
}

function urlQlyLichTrinhCty()
{
    return base_url() . "quan-ly-lich-trinh.html";
}

function urlTaolichtrinh()
{
    return base_url() . "tao-lich-trinh.html";
}

function urlSualichtrinh()
{
    return base_url() . "sua-lich-trinh.html";
}

function urlChiTietLichTrinh()
{
    return base_url() . "nhan-vien-cung-lich.html";
}

function urlQlyGiaoViecCty()
{
    return base_url() . "giao-viec.html";
}
function urlTaoCongViec()
{
    return base_url() . "tao-cong-viec.html";
}

function urlChiTietCongViec()
{
    return base_url() . "chi-tiet-cong-viec.html";
}

function urlCapNhatCongViec()
{
    return base_url() . "cap-nhat-cong-viec.html";
}

function urlQlyDanhSachCtyCon()
{
    return base_url() . "danh-sach-cong-ty-con.html";
}

function urlQlyDanhSachPhongBan()
{
    return base_url() . "danh-sach-phong-ban.html";
}

function urlQlyDanhSachNvTheoPhongBan()
{
    return base_url() . "danh-sach-nhan-vien-theo-phong-ban.html";
}

function urlQlyQuyenTruyCap()
{
    return base_url() . "quan-ly-quyen-truy-cap.html";
}

function urlCauHinhChamCong()
{
    return base_url() . "cau-hinh-cham-cong.html";
}

function urlDsCaLamViec()
{
    return base_url() . "danh-sach-ca-lam-viec.html";
}

function urlThietLapLichLamViec()
{
    return base_url() . "thiet-lap-lich-lam-viec.html";
}

function urlDslichLamViec()
{
    return base_url() . "danh-sach-lich-lam-viec.html";
}

function urlThemNvvaoLichLamViec()
{
    return base_url() . "them-nhan-vien-vao-lich-lam-viec.html";
}

function urlChiTietLichLamViec()
{
    return base_url() . "danh-sach-nhan-vien-co-lich.html";
}

function urlSualichLamViec()
{
    return base_url() . "sua-lich-lam-viec.html";
}

function urlLichLamViecNvCty()
{
    return base_url() . "lich-lam-viec-cua-nhan-vien.html";
}

function urlThongTinCty()
{
    return base_url() . "thong-tin-cong-ty.html";
}

function urlCapNhatThongTinCty()
{
    return base_url() . "cap-nhat-thong-tin-cong-ty.html";
}

function urlDoiMatKhauCty()
{
    return base_url() . "doi-mat-khau-cong-ty.html";
}

function urlBaoLoiCty()
{
    return base_url() . "bao-loi-cong-ty.html";
}

// Đăng xuất

function urlDangXuatCty()
{
    return base_url() . "dang-xuat.html";
}


//nhan vien

// function checkLoginStaff()
// {
//     $CI = &get_instance();
//     $CI->load->library('session');
//     $checkLogin = $CI->session->userdata('staff');
//     if (!isset($checkLogin)) {
//         return redirect('/');
//     }
// }

// function checkSession()
// {
//     $CI = &get_instance();
//     $CI->load->library('session');
//     $ss = $CI->session->userdata('company');
//     $ss_staff = $CI->session->userdata('staff');
//     // $check = 0;
//     if (isset($ss) || isset($ss_staff)) {
//         return 1;
//     } else {
//         return 0;
//     }
// }

// function urlQlyChungNv(){
//     return base_url()."quan-ly-chung-nhan-vien.html";
// }

function urlQlyChamCong()
{
    return base_url() . "quan-ly-cham-cong-nhan-vien.html";
}

function urlQlyLichTrinh()
{
    return base_url() . "quan-ly-lich-trinh-nhan-vien.html";
}

function urlLichTrinhMap()
{
    return base_url() . "lich-trinh-cua-toi.html";
}

function urlQlyNhanViec()
{
    return base_url() . "nhan-viec.html";
}

function urlChiTietCongViecnv()
{
    return base_url() . "chi-tiet-cong-viec-nhan-vien.html";
}

function urlThongTinNV()
{
    return base_url() . "chi-tiet-thong-tin-nhan-vien.html";
}

function urlDoiMatKhau()
{
    return base_url() . "doi-mat-khau-nhan-vien.html";
}

function urlCapNhatThongTinNV()
{
    return base_url() . "cap-nhat-thong-tin-nhan-vien.html";
}

function urlBaoLoi()
{
    return base_url() . "bao-loi-nhan-vien.html";
}

function urlDangXuat()
{
    return base_url() . "dang-xuat.html";
}

function send_otp($email, $type)
{
    if ($email != '' && $type != 0) {

        $curl     = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://chamcong.24hpay.vn/service/send_otp.php',
                CURLOPT_POST => 1,
                CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL 
                CURLOPT_POSTFIELDS => array(
                    'email'             => $email,
                    'type_user'          => $type,
                )
            )
        );
        $resp_curl = curl_exec($curl);
        $response_otp = json_decode($resp_curl);
        return $response_otp;
    }
}

function detailStaff($staff_id = 0, $access_token = '')
{
    if ($staff_id != 0 && $access_token != '') {
        $CI = &get_instance();
        $CI->load->library('session');
        $curl     = curl_init();
        $header[]         = 'Authorization: ' . $access_token . '';
        $url = 'https://chamcong.24hpay.vn/service/get_list_employee_from_company.php?filter_by[ep_id]=' . $staff_id;
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'chamcong.timviec365.com',
            CURLOPT_SSL_VERIFYPEER => false, //Bỏ kiểm SSL
            CURLOPT_HTTPHEADER => $header,
        ));
        $resp = curl_exec($curl);
        $staff_active = json_decode($resp);
        return $staff_active->data->items[0];
    }
}
