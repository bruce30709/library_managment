<?php
		@$action2=$_POST[page];
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
		if($action3&&$action2)
		{
			$date = date('Y-m-d H:i:s');
			$date2=date("Y-m-d" , mktime(0,0,0,date("m"),date("d")+10,date("Y")) );
			$sql ="Insert into 紀錄 value('$date','$date2','$action2','$action3')"
			;
			if ($conn->query($sql) === TRUE) {
    			echo"<script>alert('借書成功');window.location.href=document.referrer;</script>"; 
			} else {
    			echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
?>

