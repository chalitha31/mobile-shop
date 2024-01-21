<?php
   require 'Exception.php';
   require 'PHPMailer.php';
   require 'SMTP.php';
  
   use PHPMailer\PHPMailer\PHPMailer;
    $email = $_GET["email"];
    $name = $_GET["name"];
    $connection = new mysqli("localhost","root","Charu@123","test8","3306");
    $mo = $connection->query("SELECT * FROM `user` WHERE  `username`='".$name."' OR `email`='".$email."' ");
    $vo = $mo->num_rows;
   if(empty($email)){
   
    echo "Please Enter Your Email";

   }else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
     echo "please Enter A VAlid Email";
   }else if(empty($name)){
     echo "Please Enter Your User Name";
   }else if($vo>= 1){
       echo "USer Name Or Password Already Existes";
   }


   else{
       $connection = new mysqli("localhost","root","Charu@123","test8","3306");
       $Validationcode = mt_rand(200000,900000);
       $sql = "INSERT INTO `user`(`email`,`username`,`validation_code`) VALUES('".$email."','".$name."','".$Validationcode."')";   
       $connection->query($sql);
       
    
 // email code
 $mail = new PHPMailer;
 $mail->IsSMTP();
 $mail->Host = 'smtp.gmail.com';
 $mail->SMTPAuth = true;
 $mail->Username = 'j.c.dhananjana@gmail.com';
 $mail->Password = 'charuka25218';
 $mail->SMTPSecure = 'ssl';
 $mail->Port = 465;
 $mail->setFrom('j.c.dhananjana@gmail.com', 'Email Validation');
 $mail->addReplyTo('j.c.dhananjana@gmail.com', 'Email Validation');
 $mail->addAddress($email);
 $mail->isHTML(true);
 $mail->Subject = 'Your Email Verfication Code';
 $bodyContent = '<h1 style="color:red;">Hi '.$name.'<br/>Your Email Validation Code is :'.$Validationcode .'</h1>';
 $bodyContent .= '<p>Submit The Code in Web page</p>';
 $mail->Body    = $bodyContent;
  if(!$mail->send()){
     echo "email Validation Failed";
  }else{
       
      echo $name;
  }
       
   }


?>