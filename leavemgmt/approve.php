<?php
$con = mysql_connect("localhost", "root", "root");
mysql_select_db("leavemgmt", $con);


$employeeid = $_GET['EmployeeId'];

echo $_GET['EmployeeId'];
$result = mysql_query("SELECT e.*, el.*, eld.* FROM
          employees as e JOIN employeeleaves as el on e.EmployeeId = el.EmployeeId
          JOIN employeeleavedates as eld on el.EmployeeLeaveID = eld.EmployeeLeaveID");
if ($row = mysql_fetch_array($result)) {
    $EmployeeId = $row['EmployeeId'];
    mysql_query("update employeeleavedates set Response = 'approve' WHERE $EmployeeId = $employeeid");
}