<?php
//Công ty
$route['api_company_login']               = "api/api_company_controller/companyLogin";
$route['api_company_register']            = "api/api_company_controller/companyRegister";
$route['api_check_company_register_otp']  = "api/api_company_controller/checkCompanyRegisterOtp";
$route['api_company_resend_otp']          = "api/api_company_controller/resendOTP";
$route['api_get_small_company']           = "api/api_company_controller/getSmallCompanyList";
$route['api_create_schedule']             = "api/api_company_controller/createSchedule";
$route['api_create_department']           = "api/api_company_controller/createDepartment";
$route['api_update_department']           = "api/api_company_controller/updateDepartment";
$route['api_get_department_by_small_com'] = "api/api_company_controller/getDepartmentByCompanyId";
$route['api_create_staff']                = "api/api_company_controller/createStaff";
$route['api_update_staff']                = "api/api_company_controller/updateStaff";
$route['api_search_job']                  = "api/api_company_controller/searchJob";
$route['api_create_job']                  = "api/api_company_controller/create_job"; //chưa xong
$route['api_update_job']                  = "api/api_company_controller/update_job";
$route['api_create_small_company']        = "api/api_company_controller/create_small_company";
$route['api_update_small_company']        = "api/api_company_controller/update_small_company";
$route['api_info_company']                = "api/api_company_controller/info_company";
$route['api_update_company']              = "api/api_company_controller/update_company";
$route['api_change_pass_company']         = "api/api_company_controller/companyChangePass";
$route['api_contact_company']             = "api/api_company_controller/contactCompany";
$route['api_calendar']                    = "api/api_company_controller/addCalendar";
$route['api_update_calendar']             = "api/api_company_controller/updateCalendar";
$route['api_company_mail_otp']            = "api/api_company_controller/checkMailForgetPass";
$route['api_check_otp_forgot_pass']       = "api/api_company_controller/checkOtpforgotPass";
$route['api_forgot_pass']                 = "api/api_company_controller/forgotPass";
$route['api_contact']                     = "api/api_company_controller/contact";
$route['api_list_staff']                  = "api/api_company_controller/listStaff";
$route['api_list_staff_waiting']          = "api/api_company_controller/listStaffWaiting";
$route['api_browse_staff']                = "api/api_company_controller/browseStaff"; //
$route['api_delete_staff']                = "api/api_company_controller/deleteStaff"; //
$route['api_detail_staff']                = "api/api_company_controller/detailStaff";
$route['api_upadte_power']                = "api/api_company_controller/updateRole";
$route['api_list_schedule_staff']         = "api/api_company_controller/listScheduleStaff";
$route['api_detail_schedule_staff']       = "api/api_company_controller/detailScheduleStaff";
$route['api_detail_small_company']        = "api/api_company_controller/detailSmallCompany";
$route['api_create_shift']                = "api/api_company_controller/createShift";
$route['api_update_shift']                = "api/api_company_controller/updateShift";
$route['api_delete_shift']                = "api/api_company_controller/deleteShift";
$route['api_list_shift']                  = "api/api_company_controller/listShift";
$route['api_search_staff']                = "api/api_company_controller/searchStaff";
$route['api_create_config']               = "api/api_company_controller/createConfig";
$route['api_update_config']               = "api/api_company_controller/updateConfig";
$route['api_detail_config']               = "api/api_company_controller/detailConfig";
$route['api_delete_company_small']        = "api/api_company_controller/deleteCompanySmall";
$route['list_month_calendar']             = "api/api_company_controller/listMonthCalendar";
$route['list_month_staff']                = "api/api_company_controller/listMonthStaff";
$route['list_job']                        = "api/api_company_controller/getListJob";
$route['api_detail_job']                  = "api/api_company_controller/getDetailJob";
$route['api_list_job_by_status']          = "api/api_company_controller/getListJobByStatus";
$route['api_schedule_history_staff']      = "api/api_company_controller/scheduleHistoryStaff";
$route['api_detail_schedule_history_staff'] = "api/api_company_controller/detailScheduleHistoryStaff";
$route['api_count_job']                   = "api/api_company_controller/countJob";
$route['api_update_job_content']          = "api/api_company_controller/updateJobContent";
$route['api_list_job_by_staff']           = "api/api_company_controller/listJobByStaff";
$route['api_list_job_deliver']            = "api/api_company_controller/listJobDeliver";
$route['api_delete_schedule']             = "api/api_company_controller/deleteSchedule";
$route['api_updat_jobContent_company']    = "api/api_company_controller/updateJobContentCompany";
$route['api_update_schedule']             = "api/api_company_controller/updateSchedule";
$route['api_adds_schedule_place']         = "api/api_company_controller/addsSchedulePlace";
$route['api_list_staff_by_role']          = "api/api_company_controller/listStaffByRole";
$route['api_add_staff_toCalendar']        = "api/api_company_controller/addStaffToCalendar";
$route['api_list_calendar_by_month']      = "api/api_company_controller/listCalendarByMonth";
$route['api_create_wifi']                 = "api/api_company_controller/createWifi";
$route['api_update_wifi']                 = "api/api_company_controller/updateWifi";
$route['api_delete_wifi']                 = "api/api_company_controller/deleteWifi";
$route['api_list_wifi']                   = "api/api_company_controller/listWifi";
$route['api_create_lat_long']             = "api/api_company_controller/createLatLong";
$route['api_update_lat_long']             = "api/api_company_controller/updateLatLong";
$route['api_delete_lat_long']             = "api/api_company_controller/deleteLatLong";
$route['api_list_lat_long']               = "api/api_company_controller/listLatLong";
$route['api_list_staff_by_month']         = "api/api_company_controller/listStaffByMonth";
$route['api_delete_staff_schdule']        = "api/api_company_controller/deleteStaffSchedule";
$route['api_coordinate_staff']            = "api/api_company_controller/coordinateStaff";
$route['api_delete_calendar']             = "api/api_company_controller/deleteCalendar";
$route['api_delete_staff_calendar']       = "api/api_company_controller/deleteStaffToCalendar";
$route['api_detail_calendar']             = "api/api_company_controller/detailCalendar";
$route['api_create_number_day']           = "api/api_company_controller/create_number_day";
$route['api_show_time_sheet_com']         = "api/api_company_controller/show_time_sheet";
$route['api_get_number_day_sheet']        = "api/api_company_controller/get_number_day_sheet";
$route['api_get_number_day_sheet']        = "api/api_company_controller/get_number_day_sheet";
$route['api_notify_job_expired']          = "api/api_company_controller/notify_job_expired";
$route['api_list_notify']                 = "api/api_company_controller/list_notify";

//default
$route['api_get_city']                    = "api/Api_staff_controller/getCity";
$route['api_get_district']                = "api/Api_staff_controller/getDistrict";

//Nhân viên
$route['api_staff_login']                 = "/api/Api_staff_controller/staffLogin";
$route['api_staff_register']              = "api/api_staff_controller/staffRegister";
$route['api_check_staff_register_otp']    = "api/api_staff_controller/checkStaffRegisterOtp";
$route['api_staff_resend_otp']            = "api/api_staff_controller/resendOTP";
$route['api_staff_pass_forget']           = "api/api_staff_controller/passForget";
$route['api_check_staff_pass_forget_otp'] = "api/api_staff_controller/checkPassForgetOtp";
$route['api_foget_pass_change']           = "api/api_staff_controller/changePass";
$route['api_staff_pass_change']           = "api/api_staff_controller/changeStaffPass";
$route['api_staff_info_update']           = "api/api_staff_controller/updateStaffInfo";
$route['api_get_staff_info']              = "api/api_staff_controller/getStaffInfo";
$route['api_get_department_position']     = "api/api_staff_controller/getDepartmentPositionList";
$route['api_get_company']                 = "api/api_staff_controller/getCompanyList";
$route['api_staff_home']                  = "api/api_staff_controller/showStaffHome"; //chưa làm xong
$route['api_complete_schedule_history']   = "api/api_staff_controller/completeScheduleHistoryList";
$route['api_cancel_schedule_history']     = "api/api_staff_controller/cancelScheduleHistoryList";
$route['api_search_schedule']             = "api/api_staff_controller/searchSchedule";
$route['api_schedule_today']              = "api/api_staff_controller/getScheduleToday";
$route['api_list_job_today']              = "api/api_staff_controller/getListJobToday";
$route['api_detail_job_today']            = "api/api_staff_controller/getDetailJobToday";
$route['api_detail_schedule_history']     = "api/api_staff_controller/detailScheduleHistoryStaff";
$route['api_list_schedule_history']       = "api/api_staff_controller/scheduleHistoryStaff";
$route['api_update_job_content_staff']    = "api/api_staff_controller/updateJobContentStaff";
$route['api_list_job']                    = "api/api_staff_controller/getListJob";
$route['api_evaluate']                    = "api/api_staff_controller/evaluate";
$route['api_notify_error']                = "api/api_staff_controller/error";
$route['api_update_status_schedule']      = "api/api_staff_controller/updateStatusSchedule";
$route['api_update_LatLong']              = "api/api_staff_controller/createLatLongStaff";
$route['api_check_com']                   = "api/api_staff_controller/checkCom";
$route['api_check_face_id']               = "api/api_staff_controller/checkFaceId";
$route['api_notify']                      = "api/api_staff_controller/notify";
$route['api_time_sheet']                  = "api/api_staff_controller/show_time_sheet";
