<?php


$db = mysql_connect("localhost", "root","");
mysql_select_db("leavemgmt", $db);
$EmployeeName = '';
$Address = '';
$Contact = '';
$Department = '';
$Designation = '';
$UserName = '';
$EmployeePassword = '';
$Role = '';

$add=isset($_POST['add']);
if($add)
{
    $eid=$_POST['id'];
    $EmployeeName = $_POST['e_name'];
    $Address= $_POST['e_address'];
    $Contact = $_POST['e_contact'];
    $Department = $_POST['e_department'];
    $Designation = $_POST['e_designation'];
    $UserName = $_POST['username'];
    $EmployeePassword = $_POST['e_pw'];
    $Role = $_POST['role'];

//check if eid is provided from GET parameter
    if($eid != "")
    {
        $sql = "UPDATE employees SET
					 EmployeeName = '" .  $EmployeeName . "',
					 EmployeeAddress= '" . $Address . "'
					 WHERE EmployeeId = " . $eid;

        $result = mysql_query($sql);
        if($result > 0) {
            //echo"<b style=\"color:blue\">Information entered.\n</b>";
            echo"<script>alert('Information updated.')</script>";
        }
        else {
            //echo"<b style=\"color:blue\">Information could not be entered.\n</b>";
            echo"<script>alert('Information  could not be updated.')</script>";
        }
    }
    else
    {
        $sql = "INSERT INTO employees ";
        $sql = $sql . "(`EmployeeName`,`EmployeeContact`,`EmployeeAddress`,`EmployeeDepartment`,`Designation`,`UserName`,`EmployeePassword`,`Role`)";
        $sql = $sql . "values ( '" . $EmployeeName . "', '" . $Address . "', '" . $Department . "', '" . $Designation . "', '" . $UserName . "','" . $Address . "','" . $EmployeePassword . "','" . $Role . "') ";
        $result = mysql_query($sql);
        if($result > 0) {
            //echo"<b style=\"color:blue\">Information entered.\n</b>";
            echo"<script>alert('Information entered.')</script>";
        }
        else {
            //echo"<b style=\"color:blue\">Information could not be entered.\n</b>";
            echo"<script>alert('Information  could not be entered.')</script>";
        }

    }
}
else if($_GET != NULL) {

    $EmployeeId = $_GET['id'];
    $result = mysql_query("select * from employees WHERE $eid = " . $EmployeeId);

    while($row = mysql_fetch_array($result))
    {
        $eid=$_POST['id'];
        $EmployeeName = $_POST['e_name'];
        $Address= $_POST['e_address'];
        $Contact = $_POST['e_contact'];
        $Department = $_POST['e_department'];
        $Designation = $_POST['e_designation'];
        $UserName = $_POST['username'];
        $EmployeePassword = $_POST['e_pw'];
        $Role = $_POST['role'];
    }
}

?>

<form name="new_employee" action="update.php" method="post" onsubmit=" return validateForm()">
    <input type="hidden" name="id" value="<?php echo $id; ?>" />

    <label>EmployeeName</label>
    <input type="text" name="e_name" value="<?php echo $EmployeeName;?>"/>
    <br><label>Address</label>
    <input type="text" name="e_address" value="<?php echo $Address;?>"/>
    <br><label>Contact</label>
    <input type="number" name="e_contact" value="<?php echo $Contact;?>"/>
    <br><label>Department</label>
    <select name="e_department" value="<?php echo $Department;?>"/>
        <option></option>
        <option>Science</option>
        <option>Management</option>
        <option>BIM</option>
        <option>BBA</option>
        <option>BBS</option>
        <option>BSC CSIT</option>
        <option>Finance</option>
        <option>Cleaning</option>
        <option>Reception</option
        <option>Admin</option>
    </select>
    <br><label>Designation</label>
    <input type="text" name="e_designation" value="<?php echo $Designation;?>"/>
    <br><label>Username</label>
    <input type="text" name="username" value="<?php echo $UserName;?>"/>
    <br><label>Password</label>
    <input type="password" name="e_pw1" value="<?php echo $EmployeePassword;?>"/>
    <br><label>Retype password</label>
    <input type="password" name="e_pw2">
    <br><label>Role</label>
    <input type="radio" name="role">Employee<input type="radio" name="role" value="<?php echo $Role;?>"/>Admin
    <br><br><br><input type="submit" value="add" name="add">
    <input type="reset" value="Reset">
    <input type="button" value="cancel" onClick="history.go(-1);">
</form>