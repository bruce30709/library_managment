<?php
	@$action=$_POST[book];
	@$action1=$_POST[id];
	@$action2=$_POST[auth];
	@$action3=$_POST[key];
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
	$sql ="insert into book values('$action3','$action','$action2','$action1')";
	$result = mysqli_query($conn, $sql);
	require("PHPMailer/src/PHPMailer.php");
	require("PHPMailer/src/SMTP.php");
	require("PHPMailer/src/Exception.php");
   	$sql2 = "select * from student";
			
	$result2 = mysqli_query($conn, $sql2);
    if ($result2->num_rows > 0)
	{
		while($row = $result2->fetch_assoc())
		{
			
			$temp=$row["email"];
			
	$mail= new PHPMailer\PHPMailer\PHPMailer();                            //建立新物件 
    		//$mail->SMTPDebug = 2;                        
    $mail->AddAddress("$temp");
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
    $mail->Subject ="新書信"; //郵件標題
    $mail->Body = "有新書叫做$action"; //郵件內容
    $mail->IsHTML(true); 
	//$email=$row["email"];                            //郵件內容為html
    
	 
		
	          //收件者郵件及名稱
    if(!$mail->Send()){
    	echo "Error: " . $mail->ErrorInfo;
   	}else{
        //echo "寄信成功";
		//$name=$row["name"];
		
    }
    }
	echo"<script>alert('寄給所有人成功');window.location.href=document.referrer;</script>";
    }
?>