
<?php
echo "<table border='1'>
    <tr>
        <th></th>
        <th>SubmissionDate</th>
        <th>EmployeeName</th>
        <th>Contact</th>
        <th>Department</th>
        <th>Designation</th>
        <th>LeaveDate</th>
        <th>LeaveType</th>
        <th>Description</th>
       </tr>";
$con = mysql_connect("localhost", "root", "root");
mysql_select_db("leavemgmt", $con);
$result = mysql_query("SELECT e.*, el.*, eld.* FROM
          employees as e JOIN employeeleaves as el on e.EmployeeId = el.EmployeeId
          JOIN employeeleavedates as eld on el.EmployeeLeaveID = eld.EmployeeLeaveID
          WHERE e.EmployeeId = " . $_SESSION['EmployeeId']);


while($row = mysql_fetch_array($result))
{
    echo "<tr>";
    echo"<th><a href='leaveform.php?EmployeeId=" . $row['EmployeeId'] .  "'>Detail</a></th>";
    echo "<td>" .$row['SubmissionDate']."</td>";
    echo "<td>" .$row['EmployeeName']."</td>";
    echo "<td>" .$row['EmployeeContact']."</td>";
    echo "<td>" .$row['EmployeeDepartment']."</td>";
    echo "<td>" .$row['Designation']."</td>";
    echo "<td>" .$row['LeaveDate']."</td>";
    echo "<td>" .$row['LeaveType']."</td>";
    echo "<td>" .$row['Description']."</td>";
    echo"</tr>";
    echo "<tr>";

}
echo"</table>";
?>


<html>
<head>
<body>
<form>
    <input type="button" value="back" onclick="history.go(-1)";
</form>
</body>
</head>
</html>