<?php
require_once ('../app/libraries/Controller.php');
use PHPMailer\PHPMailer\PHPMailer;

class Mail extends Controller{

    public function index(){

    }

    public function send(){

        if(isPost()){
            $error=[];
            $data=[
                'from' => getPost('from',$error,FILTER_SANITIZE_EMAIL),
                'to' => getPost('to',$error,FILTER_SANITIZE_EMAIL),
                'asunto' => getPost('asunto',$error,FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                'body' => getPost('body',$error)
            ];
            print_r($data);
            print_r($error);
            if(count($error)){
                $this->view('mail/send',array('Data'=>$data,'Error'=>$error));
            }
            exit;

        $mail = new PHPMailer;
        $mail->isSMTP(); 
        $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
        $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
        $mail->Port = 587; // TLS only
        $mail->SMTPSecure = 'tls'; // ssl is deprecated
        $mail->SMTPAuth = true;
        $mail->Username = 'mellambias@gmail.com'; // email
        $mail->Password = 'd4t55qpl'; // password
        $mail->setFrom('mellambias@gmail.com', 'infogestio'); // From email and name
        $mail->addAddress('info@bdinfogestio.es', 'Mr. Brown'); // to email and name
        $mail->Subject = 'Documento final';
        $mail->msgHTML("<h1>ATIB</h1>"); 
        //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
        $mail->AltBody = 'Doc ATIB'; // If html emails is not supported by the receiver, show this body
        // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
        $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
        if(!$mail->send()){
            echo "Mailer Error: " . $mail->ErrorInfo;
        }else{
            echo "Message sent!";
        }
    }else{
        $this->view('mail/send');
    }
    }
}