<?php
session_start();
    $con = mysql_connect("localhost", "root", "root");
    mysql_select_db("leavemgmt", $con);
    $employeeName = $_POST['e_uname'];
    $password = $_POST['e_pw'];

    $result = mysql_query("SELECT eg.EmployeeGroupName, e.*
                        FROM `employees` as e
                        JOIN employeegroups as eg on e.EmployeeGroupId = eg.EmployeeGroupId
                        WHERE e.UserName = '" . $employeeName . "'");

    while ($row = mysql_fetch_array($result)) {
        if ($row['EmployeePassword'] == $password)
        {
            $_SESSION['EmployeeGroupId'] = $row['EmployeeGroupId'];
            $_SESSION['EmployeeId'] = $row['EmployeeId'];
            $_SESSION['EmployeeGroup'] = $row['EmployeeGroupName'];
            $_SESSION['EmployeeName'] = $row['EmployeeName'];
            header('location:main.php');
        } else {
            echo "<script>alert('Username or password do not match');</script>";
            header('location:login.html');
        }
    }

?>