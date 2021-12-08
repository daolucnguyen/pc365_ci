<?php 
/**
 * 
 */
class Globals 
{
	public function sendMail($to, $subject, $content)
	{
		require_once(APPPATH.'/libraries/phpmailer/class.phpmailer.php');
		require_once(APPPATH.'/libraries/phpmailer/class.smtp.php');
		$mail = new PHPMailer();

        $mail->IsSMTP(); // set mailer to use SMTP
     
		$name = "Timviec365.com.vn";
		$usernameSmtp = 'AKIA4H45CLBRDNNBQ4NW';
		$passwordSmtp = 'BBhUIbTmBLQkalYzuYFoRFjnWZRXhzkiyod+qfGtxvME';  
		$host = 'email-smtp.eu-west-1.amazonaws.com';
		$port = 587;
		$sender = 'no-reply@timviec365.com.vn';
		$senderName = 'Timviec365.com.vn';

		$mail             = new PHPMailer(true);

		$mail->IsSMTP(); 
		$mail->SetFrom($sender, $senderName);
		$mail->Username   = $usernameSmtp;  // khai bao dia chi email
		$mail->Password   = $passwordSmtp;              // khai bao mat khau   
		$mail->Host       = $host;    // sever gui mail.
		$mail->Port       = $port;         // cong gui mail de nguyen 
		$mail->SMTPAuth   = true;    // enable SMTP authentication
		$mail->SMTPSecure = "tls";   // sets the prefix to the servier        
		$mail->CharSet  = "utf-8";
		$mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
		// xong phan cau hinh bat dau phan gui mail
		$mail->isHTML(true);
		$mail->Subject    = $subject;// tieu de email 
		$mail->Body       = $content;
		$mail->addAddress($to,$name);
		if(!$mail->Send()){
			echo $mail->ErrorInfo;
		}
        if(!$mail->Send())
        {
        	return false;
        }
        else
        {
        	return true;
        }
    }
    function my_export($name,$title,$th_array,$tr_array){
        // Bước 1:
        // Lấy dữ liệu từ database

        // Bước 2: Import thư viện phpexcel
        require_once(APPPATH.'libraries/PHPExcel.php');

        // Bước 3: Khởi tạo đối tượng mới và xử lý
        $PHPExcel = new PHPExcel();

        // Bước 4: Chọn sheet - sheet bắt đầu từ 0
        $PHPExcel->setActiveSheetIndex(0);

        // Bước 5: Tạo tiêu đề cho sheet hiện tại
        $PHPExcel->getActiveSheet()->setTitle($title);

        // Bước 6: Tạo tiêu đề cho từng cell excel,
        // Các cell của từng row bắt đầu từ A1 B1 C1 ...
        $PHPExcel->getActiveSheet()->setCellValue('A1', 'STT');
        foreach ($th_array as $key => $item) {
            $PHPExcel->getActiveSheet()->setCellValue($key.'1', $item);
        }

        // Bước 7: Lặp data và gán vào file
        // Vì row đầu tiên là tiêu đề rồi nên những row tiếp theo bắt đầu từ 2
        $rowNumber = 2;
        $d= 1;
        if($tr_array){
            foreach($tr_array as $tr_item){
                $PHPExcel->getActiveSheet()->setCellValue('A'.$rowNumber, $d);
                foreach ($tr_item as $key => $td) {
                    $PHPExcel->getActiveSheet()->setCellValue($key.$rowNumber, $td);
                }

                // Tăng row lên để khỏi bị lưu đè
                $rowNumber++;
                $d++;
            }
        }
        // Bước 8: Khởi tạo đối tượng Writer
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
        ob_end_clean();
        // Bước 9: Trả file về cho client download
        header('Content-Type: application/vnd.ms-excel');
        $file_name = $name."_".time();
        header('Content-Disposition: attachment;filename="'.$file_name.'.xls"');
        header('Cache-Control: max-age=0');
        if (isset($objWriter)) {
            $objWriter->save('php://output');
        }
    }
}
?>