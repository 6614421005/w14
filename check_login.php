<?php
	session_start();
    include 'connectdb.php';
	$strSQL = "SELECT * FROM member WHERE mem_user = '"
    .mysqli_real_escape_string($conn,$_POST['txtUsername'])." 'and mem_password = '"
    .md5(mysqli_real_escape_string($conn,$_POST['txtPassword']))."'";
	$objQuery = mysqli_query($conn,$strSQL);
	$objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>php-id-w10</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="bootstrap/js/html5shiv.min.js"></script>
            <script src="bootstrap/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>        
        <div class="container">
            <div class="row"> 
                <div class="jumbotron" style="background-color: cornflowerblue;">
                    <?php include 'topbanner.php';?>
                </div>
            </div>
            <div class="row">
                <?php include 'menu.php';?>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-9 col-lg-9">
                <?php
	if(!$objResult["mem_status"] == "member")
	{
			header("location:title_list.php");
	}
	else
	{
			$_SESSION["UserID"]  = $objResult["mem_id"];
			$_SESSION["Status"]  = $objResult["mem_status"];
            $_SESSION["UserName"] = $objResult["mem_user"];

			session_write_close();
			
			if($objResult["mem_status"] == "ADMIN")
			{
				header("location:project_add.php");
			}
	}
	mysqli_close($conn);
?>
                </div>    
            </div>
            <div class="row">
                <address>คณะวิทยาการคอมพิวเตอร์และเทคโนโลยีสารสนเทศ</address>
            </div>
        </div>    
    </body>
</html>