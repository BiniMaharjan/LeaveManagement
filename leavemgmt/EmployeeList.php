<?php
session_start();

if($_SESSION['EmployeeGroup'] != 'Admin') {
    header('location:main.php');
    die();

}

?>



<html>
<head>
    <link rel="stylesheet" href="content/css/welcome.css" type="text/css">
</head>
<body>
<div class="wrapper">
    <div class="header"> Employee list
    </div>
    <div id="menu" align="left">
        <ul>
            <div align="left">
                <form>
                    <input type="button" value="back" onClick="history.go(-1);"/>
                </form>
            </div>
        </ul>
    </div>
    <div id="menu" align="right">
        <ul>
            <div align="right">
                <form action="search.php" method="post">
                    <input type="text" name="search" placeholder="search here" value="<?php echo $searchParam; ?>"/>
                    <input type="submit" value=">>"  />
                </form>
            </div>
        </ul>
    </div>

</div>
<br>
<br>
<br>
<div align="center">
    <?php require "display.php";?></div>
</body>