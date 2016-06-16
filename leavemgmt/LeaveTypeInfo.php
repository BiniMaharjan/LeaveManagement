<html>
<head>
    <link rel="stylesheet" href="content/css/welcome.css" type="text/css">
</head>
<body>
<div class="wrapper">
    <div class="header">Types of Leave
    </div>
</body>
</html>
<?php
$con = mysql_connect("localhost", "root", "root");
mysql_select_db("leavemgmt", $con);
echo "<table border='1'>
    <tr>

        <th>LeaveTypes</th>
        <th>Description</th>
        <th>Leave days allowed</th>
       </tr>";
$result = mysql_query("SELECT * FROM LeaveTypes");
while($row = mysql_fetch_array($result))
{
    echo "<tr>";
    echo "<td>" .$row['LeaveType']."</td>";
    echo "<td>" .$row['Description']."</td>";
    echo "<td>" .$row['LeaveDays']."</td>";
    echo"</tr>";
    echo "<tr>";

}
echo"</table>";
?>
