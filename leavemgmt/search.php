<?php
$con = mysql_connect("localhost","root","root");

if(!mysql_select_db("leavemgmt",$con)){
    die("cannot connect");
}

mysql_select_db("leavemgmt",$con);

$per_page = 3;

$searchParam = '';

if(!isset($_GET['page']))
    $page = 1;
else
    $page = $_GET['page'];

if($page <= 1)
    $start = 0;
else
    $start = ($page * $per_page) - ($per_page - 1);

if(isset($_POST['search'])) {
    $searchParam = $_POST['search'];
}

if(isset($_GET['search'])) {
    $searchParam = $_GET['search'];
}

$query = "SELECT * FROM employees";

if($searchParam != "")
    $query = $query . " WHERE EmployeeName LIKE '%" . $searchParam . "%' OR EmployeeDepartment LIKE '%" . $searchParam . "%' ";

$num_row = mysql_num_rows(mysql_query($query));
$no_of_pages = ceil($num_row/$per_page);

$query = $query . " LIMIT " . $start . " , " . $per_page;

$result = mysql_query($query);

//echo $query . "<br/><br/>";
?>

<html>
<head>
    <title>lms</title><script language="javascript">

        function hightlight(obj) {
            obj.setAttribute("style", "background-color : orange; cursor: pointer;");
        }

        function unhightlight(obj) {
            obj.setAttribute("style", "background-color : white;");
        }
    </script>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-5">
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<div id="container">
    <div id="center" class="column">
        <div id="content">
            <form action="search.php" method="post">
                <input type="text" name="search" placeholder="search here" value="<?php echo $searchParam; ?>"/>
                <input type="submit" value=">>"  />
            </form>

            <centre><h3>Employees's Table</h3></centre>
            <table border='1' cellspacing="0" cellpadding="0" style="margin-top: 10px;">
                <tr>
                    <th></th>
                    <th></th>
                    <th>Employee Name</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Username</th>
                    <th>Role</th>

                </tr>
                <?php
                if (mysql_num_rows($result) > 0)
                {
                    while ($row = mysql_fetch_array($result)) {
                        echo "<tr id='" . $row['EmployeeId'] . "' onClick='javascript: showDetails(" . $row['EmployeeId'] . ");' onMouseOver='javascript: hightlight(this);' onMouseOut='javascript: unhightlight(this);' style='background-color : white;'>";
                        echo"<th><a href='update.php?EmployeeId=" .$row['EmployeeId'] . "'>Edit</a></th>";
                        echo"<th><a href='display.php?EmployeeId=" .$row['EmployeeId'] . "&Action=delete'>Delete</a></th>";
                        echo "<td>" . $row['EmployeeName'] . "</td>";
                        echo "<td>" . $row['EmployeeContact'] . "</td>";
                        echo "<td>" . $row['EmployeeAddress'] . "</td>";
                        echo "<td>" . $row['EmployeeDepartment'] . "</td>";
                        echo "<td>" . $row['Designation'] . "</td>";
                        echo "<td>" . $row['UserName'] . "</td>";
                        echo "<td>" . $row['Role'] . "</td>";
                        echo "</tr>";
                    }
                }
                else
                {
                    echo "<tr><td colspan='7'>No records found</td></tr>";
                }
                ?>
            </table>
        </div>

        <div id="pagingDiv">
            <?php
            $prev = $page - 1;
            $next = $page + 1;

            echo "<hr>";

            if ($prev > 0)
                echo "<a href='?page=$prev&search=$searchParam'> Prev</a>";

            $number = 1;

            for ($number; $number <= $no_of_pages; $number = $number + 1) {
                if ($page == $number) {
                    echo "<b>[$number]</b>";
                } else {
                    echo "<a href='?page=$number&search=$searchParam'>$number </a>";
                }
            }

            if ($next < $no_of_pages + 1)
                echo "<a href='?page=$next&search=$searchParam'> Next </a>";
            ?>

        </div>
    </div>
</body>
</html>
<?php mysql_close($con); ?>