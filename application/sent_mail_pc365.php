<?
function SendMailAmazon($title,$name,$email,$body){
    $usernameSmtp = 'AKIASP3FAETFWQKSULUF';
    $passwordSmtp = 'BCOYT02e1Y2OKZCwQAj5nV4HaNsijyt0e8SaB/Vl0nI9';
    $host = 'email-smtp.ap-south-1.amazonaws.com';
    $port = 587;
    $sender = 'no-reply@timviec365.com.vn';
    $senderName = 'HoulyJob365.com.vn';
  
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
    $mail->Subject    = $title;// tieu de email 
    $mail->Body       = $body;
    $mail->addAddress($email,$name);
  
    
    if(!$mail->Send()){
        echo $mail->ErrorInfo;
    }
}

?>