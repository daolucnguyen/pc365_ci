<?php

/**
 * @SWG\Swagger(
 *     basePath="",
 *     host="chamcong.timviec365.com/",
 *     schemes={"https"},
 *
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="chamcong.timviec365.com",
 *         description="A sample API that uses a petstore as an example to demonstrate features in the swagger-2.0 specification",
 *         termsOfService="http://swagger.io/terms/",
 *         @SWG\Contact(name="Swagger API Team"),
 *         @SWG\License(name="MIT")
 *     ),
 *     @SWG\Definition(
 *         definition="ErrorModel",
 *         type="object",
 *         required={"code", "message"},
 *         @SWG\Property(
 *             property="code",
 *             type="integer",
 *             format="int32"
 *         ),
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     )
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_staff_login",
 *     summary="Đăng nhập",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="email",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="pass",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_staff_register",
 *     summary="Đăng kí",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="id_company",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="email",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="pass",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="staff_name",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="phone",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="department",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="position",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_check_staff_register_otp",
 *     summary="Check otp đăng kí",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="otp",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_staff_resend_otp",
 *     summary="Gửi lại OTP ",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_staff_pass_forget",
 *     summary="Quên mật khẩu",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="email",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_check_staff_pass_forget_otp",
 *     summary="Check otp quên mật khẩu",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="otp",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_foget_pass_change",
 *     summary="Đổi mật mật khẩu của quên mật khẩu",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="pass",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_staff_pass_change",
 *     summary="Đổi mật mật khẩu của nhân viên",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="old_pass",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="new_pass",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_get_staff_info",
 *     summary="Thông tin nhân viên",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_staff_info_update",
 *     summary="Cập nhật thông tin",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="avatar",
 *      in="formData",
 *      required=false,
 *      type="file",
 *     ),
 *     @SWG\Parameter(
 *      name="name",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="phone",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="department",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="position",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_get_department_position",
 *     summary="Danh sách phòng ban và vị trí",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_get_company",
 *     summary="Danh sách công ty",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_staff_home",
 *     summary="Trang chủ nhân viên",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_complete_schedule_history",
 *     summary="Lịch sử lịch trình hoàn thành",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_start",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_end",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_cancel_schedule_history",
 *     summary="Lịch sử lịch trình đã hủy",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_start",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_end",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_search_schedule",
 *     summary="Tìm kiếm lịch trình",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="name",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_start",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_end",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_schedule_today",
 *     summary="Lịch trình ngày hôm nay",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_start",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_end",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_company_login",
 *     summary="Đăng nhập",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="email",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="pass",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_company_register",
 *     summary="Đăng kí",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="email",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="pass",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="com_name",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="phone",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="address",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="city",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="district",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_check_company_register_otp",
 *     summary="Check otp đăng kí",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="otp",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_company_resend_otp",
 *     summary="Gửi lại OTP ",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_get_small_company",
 *     summary="Danh sách công ty con",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_create_schedule",
 *     summary="Tạo lịch trình",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="name",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="place",
 *      in="formData",
 *      required=false,
 *      type="string",
 *      ),
 *     @SWG\Parameter(
 *      name="lat_long",
 *      in="formData",
 *      required=false,
 *      type="string",
 *      ),
 *     @SWG\Parameter(
 *      name="staff_id",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_start",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_end",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="note",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_update_schedule",
 *     summary="Cập nhật lịch trình",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_schedule",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="name",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="place",
 *      in="formData",
 *      required=false,
 *      type="string",
 *      ),
 *     @SWG\Parameter(
 *      name="lat_long",
 *      in="formData",
 *      required=false,
 *      type="string",
 *      ),
 *     @SWG\Parameter(
 *      name="staff_id",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_start",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_end",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="note",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */


/**
 * @SWG\Post(
 *     path="/api_create_department",
 *     summary="Tạo phòng ban",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="name",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_company_small",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_get_department_by_small_com",
 *     summary="Danh sách phòng ban và chức vụ của công ty",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_com",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_list_job_today",
 *     summary="Danh sách công việc hàng ngày",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="today",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_detail_job_today",
 *     summary="Chi tiết công việc hàng ngày",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="job_id",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_create_staff",
 *     summary="Tạo nhân viên của công ty",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="name_staff",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="email",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="pass",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="telephone",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="department",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="power",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="position",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_update_staff",
 *     summary="Cập nhật thông tin nhân viên",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="avatar",
 *      in="formData",
 *      required=false,
 *      type="file",
 *     ),
 *     @SWG\Parameter(
 *      name="id_staff",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="name_staff",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="pass",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="telephone",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="department",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="position",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_search_job",
 *     summary="bộ lọc tìm kiếm công việc",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="name_job",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="job_com_id",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="department",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="status",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="date_start",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_end",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_create_job",
 *     summary="Tạo công việc",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="name_job",
 *      in="formData",
 *      description="tên công việc",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_start",
 *      in="formData",
 *      description="ngày bắt đầu",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_end",
 *      in="formData",
 *      description="ngày kết thúc",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="time_in",
 *      in="formData",
 *      description="thời gian bắt đầu",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="time_out",
 *      in="formData",
 *      description="thời gian kết thúc",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="staff_id",
 *      description="id nhân viên",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="job_address",
 *      description="địa chỉ",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="job_city",
 *      in="formData",
 *      description="id tỉnh thành",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="job_district",
 *      in="formData",
 *      description="id quận huyện",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="note",
 *      in="formData",
 *      description="ghi chú",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="job_content",
 *      in="formData",
 *      description="công việc cần làm",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="time_notify",
 *      description="thời gian thông báo",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="repeat_notify",
 *      description="thời gian lặp lại mặc định",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="number_day_notify",
 *      in="formData",
 *      description="số lượng",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="status_notify",
 *      in="formData",
 *      required=false,
 *      description="Nhập định dạng",
 *      type="integer",
 *     ),
 *     security={}
 * )
 */


/**
 * @SWG\Post(
 *     path="/api_update_job",
 *     summary="Cập nhật công việc",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_job",
 *      in="formData",
 *      description="id công việc",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="name_job",
 *      in="formData",
 *      description="tên công việc",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_start",
 *      in="formData",
 *      description="ngày bắt đầu công việc",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_end",
 *      in="formData",
 *      description="ngày kết thúc công việc",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="time_in",
 *      in="formData",
 *      description="giờ bắt đầu công việc",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="time_out",
 *      in="formData",
 *      description="giờ kết thúc công việc",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="staff_id",
 *      in="formData",
 *      description="id nhân viên",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="job_address",
 *      in="formData",
 *      description="địa chỉ",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="job_city",
 *      in="formData",
 *      description="id thành phố",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="job_district",
 *      in="formData",
 *      description="id quận huyện",
 *      description="địa chỉ",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="note",
 *      in="formData",
 *      description="ghi chú",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="job_content",
 *      in="formData",
 *      description="công việc cần làm",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="time_notify",
 *      description="thời gian thông báo",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="repeat_notify",
 *      description="thời gian lặp lại",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="number_day_notify",
 *      description="số lượng ",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="status_notify",
 *      description="Định dạng",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_create_small_company",
 *     summary="Tạo công ty con",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="avatar",
 *      description="ảnh",
 *      in="formData",
 *      required=false,
 *      type="file",
 *     ),
 *     @SWG\Parameter(
 *      name="name",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="email",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="phone",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="address",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_update_job_content",
 *     summary="Cập nhật trạng thái công việc cần làm",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_content",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="status",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_update_small_company",
 *     summary="Cập nhật công ty con",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_small_com",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="avatar",
 *      in="formData",
 *      required=false,
 *      type="file",
 *     ),
 *     @SWG\Parameter(
 *      name="name",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="phone",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="address",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_info_company",
 *     summary="Thông tin công ty",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_update_company",
 *     summary="Cập nhật thông tin công ty",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="com_name",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="com_phone",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="com_address",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_update_department",
 *     summary="Cập nhật phòng ban",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_department",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="name",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_company_small",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_change_pass_company",
 *     summary="Đổi mật khẩu",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="pass",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="passnew",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_get_city",
 *     summary="Tỉnh thành",
 *     tags={"Dung chung"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_get_district",
 *     summary="Quận huyện",
 *     tags={"Dung chung"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="cit_id",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_calendar",
 *     summary="Tạo lịch làm việc",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="name_date",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="json_date",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="choose",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="shift",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_update_calendar",
 *     summary="Cập nhật lịch làm việc",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_calendar",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="name_date",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="json_date",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="choose",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="shift",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_add_staff_toCalendar",
 *     summary="Thêm nhân viên vào lịch làm việc",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_calendar_new",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="id_calendar_old",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="staff_id",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_contact",
 *     summary="liên hệ",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="name",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="email",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="content",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_list_staff",
 *     summary="Danh sách nhân viên của công ty",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_browse_staff",
 *     summary="Duyệt nhân viên",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="str_id_staff",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_delete_staff",
 *     summary="Xóa nhân viên",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="str_id_staff",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_detail_staff",
 *     summary="Chi tiết nhân viên của công ty",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_staff",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_upadte_power",
 *     summary="Cập nhật phân quyền",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_small_com",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="id_staff",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="id_power",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_detail_small_company",
 *     summary="Chi tiết công ty con",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_small_com",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_list_schedule_staff",
 *     summary="Danh sách nhân viên theo lịch trình",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_com",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="status",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="staff_id",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_start",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="date_end",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_department",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */


/**
 * @SWG\Post(
 *     path="/api_company_mail_otp",
 *     summary="Check mail quên mật khẩu",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="email",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_check_otp_forgot_pass",
 *     summary="Check otp quên mật khẩu",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="otp",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_forgot_pass",
 *     summary="Đổi mật khẩu của quên mật khẩu",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="pass",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_create_shift",
 *     summary="Tạo ca làm việc",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_com",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="name_shift",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="time_in",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="time_out",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_update_shift",
 *     summary="Cập nhật ca làm việc",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_com",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="id_shift",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="name_shift",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="time_in",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="time_out",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_delete_shift",
 *     summary="Xóa ca làm việc",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_shift",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_list_shift",
 *     summary="Danh sách ca làm việc",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_com",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_search_staff",
 *     summary="Tìm kiếm nhân viên",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="name_staff",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_department",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="id_position",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="status",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="id_small_com",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_create_config",
 *     summary="Tạo cấu hình chấm công",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_com",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="method",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
/**
 * @SWG\Post(
 *     path="/api_detail_config",
 *     summary="Chi tiết cấu hình chấm công",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_com",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_delete_company_small",
 *     summary="Xóa công ty con",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_small",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/list_job",
 *     summary="Danh sách công việc theo ngày",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_small",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="today",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_department",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="status",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_detail_job",
 *     summary="Chi tiết công việc theo ngày",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_job",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_list_job_by_status",
 *     summary="Danh sách công việc đã làm của nhân viên",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="staff_id",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_schedule_history_staff",
 *     summary="Lịch sử lịch trình",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="staff_id",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_detail_schedule_history_staff",
 *     summary="Chi tiết lịch trình",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="schedule_id",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="staff_id",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_count_job",
 *     summary="Số lượng công việc",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="today",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_detail_schedule_history",
 *     summary="Chi tiết lịch trình",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="schedule_id",
 *      description="id lịch trình",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_list_schedule_history",
 *     summary="lịch sử lịch trình",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_list_job_deliver",
 *     summary="Danh sách công việc theo phòng ban",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_department",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="id_small_com",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_update_job_content_staff",
 *     summary="Cập nhật việc cần làm",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_content",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="status",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_list_job",
 *     summary="danh sách công việc",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="time_in",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *      @SWG\Parameter(
 *      name="time_out",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_list_job_by_staff",
 *     summary="danh sách lịch làm việc của nhân viên",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="staff_id",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="month",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_delete_schedule",
 *     summary="Xóa lịch trình",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_schedule",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_evaluate",
 *     summary="Đánh giá",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="star",
 *      description="Số lượng sao",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="detail_evaluate",
 *      description="chi tiết đánh giá",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_notify_error",
 *     summary="Thông báo lỗi",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="detail_error",
 *      description="Chi tiết lỗi",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="files[]",
 *      description="Tải ảnh",
 *      in="formData",
 *      required=false,
 *      type="file",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_notify",
 *     summary="Thông báo",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_update_status_schedule",
 *     summary="Cập nhật điểm đến",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_place",
 *      description="id của điểm đến",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="status",
 *      description="trạng thái",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_updat_jobContent_company",
 *     summary="Cập nhật việc cần làm",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_content",
 *      description="id của việc cần làm",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="status",
 *      description="trạng thái",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_adds_schedule_place",
 *     summary="Thêm điểm đến",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_schedule",
 *      description="id của lịch trình",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="place",
 *      description="địa điểm",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="lat_long",
 *      description="tọa độ",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */


/**
 * @SWG\Post(
 *     path="/api_list_staff_by_role",
 *     summary="Danh sách nhân viên theo quyền truy cập",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_com_small",
 *      description="id của lịch trình",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="id_power",
 *      description="id phân quyền",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_create_wifi",
 *     summary="Thêm wifi",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_com",
 *      description="id",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="mac",
 *      description="id",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="ip",
 *      description="ip",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="name_wifi",
 *      description="name_wifi",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_update_wifi",
 *     summary="Cập nhật wifi",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_wifi",
 *      description="id",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="mac",
 *      description="id",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="ip",
 *      description="ip",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="name_wifi",
 *      description="name_wifi",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_delete_wifi",
 *     summary="Xóa wifi",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_com",
 *      description="id",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="id_wifi",
 *      description="id_wifi",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */


/**
 * @SWG\Post(
 *     path="/api_create_lat_long",
 *     summary="Thêm tọa độ",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_com",
 *      description="id",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="address",
 *      description="address",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="lat_long",
 *      description="lat_long",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_update_lat_long",
 *     summary="Cập nhật tọa độ",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_lat_long",
 *      description="id_lat_long",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="address",
 *      description="address",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="lat_long",
 *      description="lat_long",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_delete_lat_long",
 *     summary="Xóa tọa độ",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="id_com",
 *      description="id",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_lat_long",
 *      description="id_lat_long",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */


/**
 * @SWG\Post(
 *     path="/list_month_calendar",
 *     summary="Danh sách lịch làm việc theo tháng",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_com",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="month",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/list_month_staff",
 *     summary="Danh sách nhân viên có lịch làm việc theo tháng",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_calendar",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_update_LatLong",
 *     summary="Cập nhật vị trí nhân viên",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="lat_long",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_delete_staff_schdule",
 *     summary="Xóa nhân viên khỏi lịch trình",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_staff",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_schedule",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_coordinate_staff",
 *     summary="Tọa độ của nhân viên",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_staff",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="date",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_check_com",
 *     summary="Check công ty",
 *     tags={"Nhân viên"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="id_com",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_list_staff_by_month",
 *     summary="Danh sách nhân viên có lịch làm việc theo tháng",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_small_com",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="name_staff",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_department",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="month",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="status",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_delete_calendar",
 *     summary="Xóa lịch làm việc",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_calendar",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */


/**
 * @SWG\Post(
 *     path="/api_delete_staff_calendar",
 *     summary="Xóa nhân viên khỏi lịch làm việc",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     @SWG\Parameter(
 *      name="id_calendar",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     @SWG\Parameter(
 *      name="id_staff",
 *      in="formData",
 *      required=false,
 *      type="integer",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_notify_job_expired",
 *     summary="Tạo thông báo công việc sắp hết hạn",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */

/**
 * @SWG\Post(
 *     path="/api_list_notify",
 *     summary="Thông báo công ty",
 *     tags={"Công ty"},
 *     @SWG\Response(
 *         response=200,
 *         description="Invalid input",
 *     ),
 *     @SWG\Parameter(
 *      name="token",
 *      in="formData",
 *      required=false,
 *      type="string",
 *     ),
 *     security={}
 * )
 */
