<?php
session_start();?>

<html>
<head>
    <link rel="stylesheet" href="content/css/welcome.css" type="text/css">
</head>
<body>
<div class="wrapper">
    <div class="header">
        Welcome <?php echo $_SESSION['EmployeeName']; ?>
    </div>

    <div id="menu">
        <ul>
            <li>
                <a href="#">Leave</a>
                <ul>
                    <li><a href="leaveform.php">Request a leave</a> </li>
                    <li><a href="leaveform.php">View your leave status</a> </li>

                    <?php if($_SESSION['EmployeeGroup'] == 'Admin') {?>
                    <li><a href="leavelist.php">View Employees' leave Request</a> </li>
                    <?php }?>
                </ul>
            <li>
                <a href="LeaveTypeInfo.php">LeaveType</a>
            </li>
            </li>
            <?php if($_SESSION['EmployeeGroup'] == 'Admin') {?>
                <li>
                    <a href="#">Employees</a>
                    <ul>
                        <li> <a href="AddNewEmployee.php">Add new Employee</a></li>
                        <li><a href="EmployeeList.php">Employee List</a> </li>
                    </ul>
                </li>
                <li>
                    <a href="Reports.php">Reports</a>
                </li>
            <?php }?>
            <li>
                <a href="logout.php">Logout</a>
            </li>

        </ul>
    </div>
</div>


</body>
</html>


