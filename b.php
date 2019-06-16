<?php
	@$action3=$_POST[page2];
	$DBNAME = "library";
	$servername = "localhost";
	$username = "root";
	$password = "root";
	
	$conn = mysqli_connect($servername, $username, $password);
	
// 检测连接
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
	//echo "连接成功";

	if( !mysqli_select_db($conn, $DBNAME)) {
  		die ("無法選擇資料庫");
	}
	// 設定連線編碼
	mysqli_query( $conn, "SET NAMES 'utf8'");
	$sql ="select email from 紀錄 where 書名='$action3'";
	$result = mysqli_query($conn, $sql);
	if ($result->num_rows > 0) {
    	// 输出数据
    	while($row = $result->fetch_assoc()) {
        	//echo "寄email給: " . $row["email"]. "了!";
			
    		require("PHPMailer/src/PHPMailer.php");
			require("PHPMailer/src/SMTP.php");
			require("PHPMailer/src/Exception.php");
   			
    		$mail= new PHPMailer\PHPMailer\PHPMailer();                            //建立新物件
    		//$mail->SMTPDebug = 2;                        
    		$mail->IsSMTP();                                    //設定使用SMTP方式寄信
    		$mail->SMTPAuth = true;                        //設定SMTP需要驗證
    		$mail->SMTPSecure = "ssl";                    // Gmail的SMTP主機需要使用SSL連線
    		$mail->Host = "smtp.gmail.com";             //Gamil的SMTP主機
    		$mail->Port = 465;                                 //Gamil的SMTP主機的埠號(Gmail為465)。
    		$mail->CharSet = "utf-8";                       //郵件編碼
    		$mail->Username = "";       //Gamil帳號
    		$mail->Password = "";                 //Gmail密碼
    		$mail->From = "";        //寄件者信箱
    		$mail->FromName = "圖書館";                  //寄件者姓名
    		$mail->Subject ="還書信"; //郵件標題
    		$mail->Body = "快還書"; //郵件內容
    		$mail->IsHTML(true); 
			$email=$row["email"];                            //郵件內容為html
    		$mail->AddAddress("$email");            //收件者郵件及名稱
    		if(!$mail->Send()){
    		    echo "Error: " . $mail->ErrorInfo;
   			}else{
        		//echo "寄信成功";
				echo"<script>alert('寄email成功');window.location.href=document.referrer;</script>";
    		}
    

		}
	}
	
?>