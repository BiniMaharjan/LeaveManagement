<?php
session_start();
$con = mysql_connect("localhost", "root", "root");
mysql_select_db("leavemgmt", $con);

$employeeLeaveId = 0;
$employeeId = $_SESSION['EmployeeId'];
$employeeName = '';

$leaveTypeHtml = '<select name="LeaveTypeId"><option value="0">Select..</option>';

$result = mysql_query("SELECT * FROM leavetypes ORDER BY LeaveType");
while ($row = mysql_fetch_array($result))
{
    $leaveTypeHtml = $leaveTypeHtml . "<option value='" . $row['LeaveTypeID'] . "'>" . $row['LeaveType'] . "</option>";
}

$leaveTypeHtml = $leaveTypeHtml . "</select>";

/*$abc=$_SESSION['EmployeeId'];
$result = mysql_query("SELECT * FROM employeeleaves WHERE EmployeeId = '$abc'");
while ($row = mysql_fetch_array($result))
{
    $li = $row['EmployeeLeaveID'];
echo$li;}
    //$department = $row['EmployeeDepartment'];
    //$designation = $row['Designation'];
echo $abc;
$result = mysql_query("SELECT * FROM leavetypes as LT
                        JOIN employeeleavedates as LD on LD.LeaveTypeId = LT.LeaveTypeId
                        JOIN EmployeeLeaves AS L ON L.EmployeeLeaveId = LD.EmployeeLeaveId
                        JOIN Employees AS E ON E.EmployeeId = L.EmployeeId
                        WHERE L.EmployeeLeaveId= '$li'");

while ($row = mysql_fetch_array($result))
{
    $employeeId = $row['EmployeeId'];
    $employeeName = $row['EmployeeName'];
    $department = $row['EmployeeDepartment'];
    $designation = $row['Designation'];
    echo$employeeName;
    echo$department;
    echo$designation;

}



*/
if ($_GET!= NULL) {

    $employeeLeaveId = $_GET['EmployeeLeaveId'];
    echo $employeeLeaveId;
    $result = mysql_query("SELECT * FROM leavetypes as LT
                        JOIN employeeleavedates as LD on LD.LeaveTypeId = LT.LeaveTypeId
                        JOIN EmployeeLeaves AS L ON L.EmployeeLeaveId = LD.EmployeeLeaveId
                        JOIN Employees AS E ON E.EmployeeId = L.EmployeeId
                        WHERE L.EmployeeLeaveId= ". $employeeLeaveId);
    while ($row = mysql_fetch_array($result))
    {
        $employeeId = $row['EmployeeId'];
        $employeeName = $row['EmployeeName'];
        $department = $row['EmployeeDepartment'];
        $designation = $row['Designation'];
    }

}
else
{
    $result = mysql_query("SELECT * FROM Employees WHERE EmployeeId = " . $_SESSION['EmployeeId']);
    while ($row = mysql_fetch_array($result))
    {
        $employeeName = $row['EmployeeName'];
        $department = $row['EmployeeDepartment'];
        $designation = $row['Designation'];
    }

    $result = mysql_query("SELECT 0 as EmployeeLeaveDateId, '' AS Description, 0 AS LeaveTypeId, '' AS LeaveDate");
}


?>



<html>
<head>

    <script language="JavaScript">

        function validateForm(LeaveForm) {


            var a =LeaveForm.submission_date.value;
            var b =LeaveForm.name.value;
            var c =LeaveForm.department.value;
            var d =LeaveForm.designation.value;
            var e =LeaveForm.leave_type.value;
            var f =LeaveForm.description.value;

            if ((a == null || a == "") && (b == null || b == "") && (c == null || c == "") && (d == null || d == "")
                    && (e == null || e == "") && (f == null || f == "")) {

                alert("All fields are empty");
                return false;
            }


            if (a == null || a == "") {

                alert("Submission date must be filled out!");
                leaveform.department.focus;
                return false;
            }
            if (b == null || b == "") {

                alert("employee name be filled out!");
                return false;
            }

            if (c == null || c == "") {
                alert("Your department must be specified!");

                return false;

            }

            if (d == null || d == "") {
                alert("you have not specified the dates you want leave on!");

                return false;

            }

            if (e == null || e == "") {
                alert("Please specify the leave type!");

                return false;

            }
        }
    </script>





</head>
<br>
<br>
<br>
<div align="center" >
<?php echo date('Y-m-d h:m:s', time());?>
    <form name="LeaveForm" onsubmit="return validateForm(this)" method="post" action="leaveform.php">
        <input type = "hidden"  name="employeeID" value="<?php echo $employeeId?>">
        <input type = "hidden"  name="EmployeeLeaveId" value="<?php echo $employeeLeaveId?>">
        <table border="1">

            <tr>
                <td>
                    <label>Employee Name</label>
                </td>
                <td>
                    <?php echo $employeeName;?>
                </td>
            </tr>
            <tr>
                <td><label>Department:</label></td>
                <td> <?php echo $department; ?></td>
            </tr>
            <tr>
                <td>
                    <label>Designation</label>
                </td>
                <td> <?php echo $designation; ?> </td>
            </tr>

            <?php
            while ($row = mysql_fetch_array($result))
            {?>
                <input type="hidden" name="EmployeeLeaveId" value="<?php echo $row['EmployeeLeaveId'];?>" />
                <tr>
                <td><label>Leave Date:</label></td>
                <td><input type="date" name"dates"></td>
            </tr>
            <tr>
                <td><label>Leave type</label></td>
                <td>
                    <?php echo $leaveTypeHtml;?>
                </td>
            </tr>
            <tr>
                <td><label>Description</label></td>
                <td><input type="text" size="20" name="Description"/></td>

            </tr>
            <?php
            }
            ?>

        </table>
        <input type="submit" value="Add">
        <input type="button" value="cancel" onClick="history.go(-1);">
    </form>
</div>

</body>
</html>