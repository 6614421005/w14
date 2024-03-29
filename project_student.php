<?php session_start() ?>
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
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <p>Login Area</p>
                </div>  
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <h4>แสดงรายชื่อนักศึกษา</h4>
                    <a href="student_add.php" class="btn btn-link">เพิ่มข้อมูลนักศึกษา</a>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>รหัส</th>
                                    <th colspan="1">ชื่อ-สกุล</th>
                                    <th>สาขา</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
            include 'connectdb.php';
            
            $sql = 'select std_id,title.ttl_name,std_fname,std_lname,program.prg_name FROM student JOIN title ON student.std_ttl_id=title.ttl_id JOIN program ON student.std_prg_id=program.prg_id ORDER BY std_id';

            $result = mysqli_query($conn, $sql);

            while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                echo '<tr>';
                echo '<td>' . $row['std_id'] . '</td>';
                echo '<td>' . $row['ttl_name'] .' '.$row['std_fname'] .' '.$row['std_lname'].'</td>';
                echo '<td>' . $row['prg_name'] . '</td>';
                echo '<td>';
                ?><?php if(isset($_SESSION['Status']) && $_SESSION['Status'] == "ADMIN") {
                echo '<a href="student_edit.php?std_id='.$row['std_id'].'" class="btn btn-warning">แก้ไข</a>';
                echo '<a href="JavaScript:if(confirm(\'ยืนยันการลบ\')==true) {window.location=\'student_delete.php?std_id='.$row["std_id"].'\'}" class="btn btn-danger">ลบ</a>';
                }?>
                <?php
                echo '</td>';
                echo '</tr>';
            }

            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>  
            </div>
            <div class="row">
                <address>คณะวิทยาการคอมพิวเตอร์และเทคโนโลยีสารสนเทศ</address>
            </div>
        </div>    
    </body>
</html>