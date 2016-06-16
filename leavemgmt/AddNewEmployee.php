<?php
session_start();

if($_SESSION['EmployeeGroup'] != 'Admin') {
    header('location:main.php');
    die();

}

?>

<?php
$con=mysql_connect("localhost","root","root");
mysql_select_db("leavemgmt",$con);
$employee1="insert into employees(EmployeeName,EmployeeContact,EmployeeAddress,EmployeeDepartment,Designation,UserName,
EmployeePassword,EmployeeGroupID)values('$_POST[e_name]','$_POST[e_contact]','$_POST[e_address]','$_POST[e_department]',
'$_POST[e_designation]','$_POST[username]','$_POST[e_pw1]','$_POST[Role]')";
mysql_query($employee1,$con);
mysql_close($con);
?>




<html>
<head>
    <link rel="stylesheet" href="content/css/welcome.css" type="text/css">

    <script language="JavaScript">

        function validateForm()
        {


            var a=document.new_employee.e_name.value;
            var b=document.new_employee.e_address.value;
            var c=document.new_employee.e_contact.value;
            var d=document.new_employee.e_department.value;
            var e=document.new_employee.e_designation.value;
            var f=document.new_employee.e_pw1.value;
            var g=document.new_employee.e_pw2.value;
            var h=document.new_employee.role.value;
            var i=document.new_employee.username.value;


            if((a==null||a=="")&&(b==null||b=="")&&(c==null||c=="")&&(d==null||d=="")
                &&(e==null||e=="")&&(f==null||f=="")&&(g==null||g=="")&&(h==null||h=="")&&(i==null||i==""))
            {

                alert("All fields are empty");
                a.focus();
                return false;
            }


            if(a==null||a=="")
            {

                alert("Name must be filled out!");
                b.focus();
                return false;
            }
            if(b==null||b=="")
            {

                alert("Address must be filled out!");
                c.focus();
                return false;
            }

            if(c==null||c=="")
            {
                alert("Phone number must be filled out!");
                c.focus();
                return false;

            }

            if(d==null||d=="")
            {
                alert("Please specify your department!");
                d.focus();
                return false;

            }

            if(e==null||e=="")
            {
                alert("please specify your designation");
                e.focus();
                return false;

            }

            if(f==null||f=="")
            {
                alert("Type your password");
                f.focus();
                return false;

            }

            if(g==null||g=="")
            {
                alert("retype your password");
                g.focus();
                return false;

            }
            if(f!=g)
            {
                alert("the two passwords doesn't match");
                g.focus();
                return false;
            }
            if(h==null||h=="")
            {
                alert("You haven't specified the role");
                h.focus();
                return false;

            }
            if(i==null||i=="")
            {
                alert("set a username");
                i.focus();
                return false;

            }

        }
    </script>

</head>
<body>
<div class="wrapper">
    <div class="header">Add new employee
    </div>
    <div class="wrapper">
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
    <br>
    <br>

<div align="center">
    <table border="1">
    <form name="new_employee" action="AddNewEmployee.php" method="post" onsubmit="return validateForm()">
        <tr>
            <td><label>EmployeeName</label></td>
        <td><input type="text" name="e_name"></td>
        </tr>
        <br>
        <br>
        <tr><td><label>Address</label></td>
        <td><input type="text" name="e_address"></td>
        </tr>
        <tr>
            <td><label>Contact</label></td>
        <td><input type="number" name="e_contact"></td>
        </tr>
        <tr>
        <td><label>Department</label></td>
        <td><select name="e_department">
            <option value=""></option>
            <option value="Science">Science</option>
            <option value="Management">Management</option>
            <option value="BIM">BIM</option>
            <option value="BBA">BBA</option>
            <option value="BBS">BBS</option>
            <option value="BSC CSIT">BSC CSIT</option>
            <option value="Finance" >Finance</option>
            <option value="Cleaning">Cleaning</option>
            <option value="Reception">Reception</option>
            <option value="Administrator">Administrator</option>
        </select>
        </td></tr>
        <tr>
        <td><label>Designation</label></td>
        <td><input type="text" name="e_designation"></td>
            </tr>
        <tr>
        <td><label>Username</label></td>
        <td><input type="text" name="username"></td>
            </tr>
        <tr>
        <td><label>Password</label></td>
        <td><input type="password" name="e_pw1"></td>
            </tr>
        <tr>
        <td><label>Retype password</label></td>
        <td><input type="password" name="e_pw2"></td>
        </tr>
        <tr>
        <td><label>Role</label></td>
        <td><select name="Role">
            <option value=""></option>
            <option value="1">Admin</option>
            <option value="2">Normal</option>
            </select></td>
            </tr>
        <br><br><br>
        <input type="submit" value="add">
        <input type="reset" value="Reset">
        <input type="button" value="cancel" onClick="history.go(-1);">
    </form>
    </table>
</div>
</div>
</body>
</html>
