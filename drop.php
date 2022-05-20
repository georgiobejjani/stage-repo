<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <form>
        <select>
            <option style="color: red;">-- Select City --</option>
            <?php
            require_once "config/dbconnect.php";
            $wdet = "";
            $conn = oci_connect($orclUser, $orclPass, $orclConnStr);
            if ($conn) {
                $sql = "SELECT DEPTNO FROM dept";
                $stid2 = oci_parse($conn, $sql);
                oci_execute($stid2);
                while ($row = oci_fetch_array($stid2)) {
                    echo "<option value='" . $row['DEPTNO'] . "'>" . $row['DEPTNO'] . "</option>";
                }
            }

            ?>
        </select>
    </form>
</body>

</html>