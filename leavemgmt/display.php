<?php
$con = mysql_connect("localhost", "root", "root");
mysql_select_db("leavemgmt", $con);

if($_GET != NULL)
{
        if ($_GET['Action'] == "delete") {
            $employeeId = $_GET['EmployeeId'];
            $query = "DELETE FROM Employees WHERE EmployeeId = " . $employeeId;
            mysql_query($query);
            header("location:EmployeeList.php");
            die();
        }

}

$result = mysql_query ("select * from employees");
echo "List of employees";
echo "<table border='1'>
    <tr>
        <th></th>
        <th></th>
        <th>EmployeeID</th>
        <th>EmployeeName</th>
        <th>Contact</th>
        <th>Department</th>
        <th>Designation</th>
        <th>UserName</th>
        <th>EmployeePassword</th>
        <th>Role</th>

       </tr>";
//delete employee code

    while($row = mysql_fetch_array($result))
    {
        echo "<tr>";
        echo"<th><a href='update.php?EmployeeId=" .$row['EmployeeId'] . "'>Edit</a></th>";
        echo"<th><a href='display.php?EmployeeId=" .$row['EmployeeId'] . "&Action=delete'>Delete</a></th>";
        echo "<td>" .$row['EmployeeId']."</td>";
        echo "<td><a href='leavelist.php?id=25'>" .$row['EmployeeName']."</td>";
        echo "<td>" .$row['EmployeeContact']."</td>";
        echo "<td>" .$row['EmployeeDepartment']."</td>";
        echo "<td>" .$row['Designation']."</td>";
        echo "<td>" .$row['UserName']."</td>";
        echo "<td>" .$row['EmployeePassword']."</td>";
        if($row['EmployeeGroupID']=="1")
         {echo "<td>".admin."</td>";}
        else
        {echo "<td>".normal."</td>";}
        echo"</tr>";
    }
    echo"</table>";
mysql_close($con);
?>