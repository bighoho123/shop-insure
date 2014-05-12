<?php 
	


	if ($_FILES["upload"]["error"] > 0) {
	    echo "Error: " . $_FILES["upload"]["error"] . "<br>";
	} else {
	    
		require("../phplib/phpmailer/PHPMailerAutoload.php");
	    // Store the file in a non-temp location
	    $folderName=date("YmdHis",time()).rand(0,100);
	    mkdir($_SERVER['DOCUMENT_ROOT']."/upload/".$folderName, 0777);
		$newPath=$_SERVER['DOCUMENT_ROOT']."/upload/".$folderName."/".$_FILES["upload"]["name"];
		rename($_FILES["upload"]["tmp_name"], $newPath);

		$emailName=isset($_POST['emailNameHidden'])?$_POST['emailNameHidden']:'Anonymous';
		$emailContact=isset($_POST['emailContactHidden'])?$_POST['emailContactHidden']:"unknown";
		$emailNote=isset($_POST['emailNoteHidden'])?$_POST['emailNoteHidden']:"";
		$mail = new PHPMailer();

		$mail->IsSMTP(); 
	    $mail->Host = "localhost"; 
	    $mail->SMTPAuth=false;
	    
		$mail->FromName = 'ShopInsure';
		$mail->addAddress('jinzhe@dnaevolution.com.au');

		$mail->Subject = $emailName.' wants to know more about the attached file';
		$mail->Body    = 'You can reply to '.$emailName.' via '.$emailContact.' Additional Note: '.$emailNote;
		$mail->addAttachment($newPath);

		if(!$mail->send()) {
		   echo 'Message could not be sent.';
		   echo 'Mailer Error: ' . $mail->ErrorInfo;
		   exit;
		}

		echo "<div style='width:100%;text-align:center;font-size:30px'>Email sent. We will get back to you shortly...";
	    echo "</div>";

	}


	
?>