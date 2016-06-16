<?php
session_start();



$con=mysql_connect("localhost","root","root");
if(!$con)
{
    die("could not connect to the database".mysql_error());
}

mysql_select_db("leavemgmt",$con);

if($_GET['EmployeeLeaveId'] != "0"){
    //update query here
    $employeeLeaveId = $_POST['EmployeeLeaveId'];
    mysql_query("UPDATE employeeleavedates SET
            LeaveDate = $_POST[dates],
            LeaveType = $_POST[LeaveTypeId],
            Description = $_POST[Description] WHERE EmployeeLeaveID == $employeeLeaveId" );

    echo "<script>alert('Leave request updated')</script>";
}
else {
    mysql_query("SELECT * FROM leavetypes as LT
                        JOIN employeeleavedates as LD on LD.LeaveTypeId = LT.LeaveTypeId
                        JOIN EmployeeLeaves AS L ON L.EmployeeLeaveId = LD.EmployeeLeaveId
                        JOIN Employees AS E ON E.EmployeeId = L.EmployeeId
                        WHERE L.EmployeeLeaveId= ". $employeeLeaveId);
    $insert1 = "insert into employeeleaves(`EmployeeId`,`SubmissionDate`) VALUES (". $_POST['employeeID'] . ",'". time()."')";
    mysql_query($insert1, $con);

    $result = mysql_query("SELECT MAX(EmployeeLeaveId) As EmployeeLeaveId FROM EmployeeLeaves", $con);
    while ($row = mysql_fetch_array($result)) {
        $employeeLeaveId = $row['EmployeeLeaveId'];
    }

    $insert2 = "insert into employeeleavedates( `EmployeeLeaveID`,`Description`,`LeaveType`) VALUES (" . $employeeLeaveId . ",'" . $_POST['Description'] . "'," . $_POST['LeaveTypeId'] . ")";
    mysql_query($insert2, $con);

    mysql_close($con);

    echo "<script>alert('New leave request posted')</script>";
}

header("location:leaveform.php EmployeeLeaveId= " . $employeeLeaveId);
?>