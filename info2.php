<?php
require_once "config/dbconnect.php";

$user = $_POST["uname"];
$pass = $_POST["password"];

$conn = oci_connect($orclUser, $orclPass, $orclConnStr);
if ($conn) {

    $sql = "SELECT USERNAME FROM loginf WHERE USERNAME='$user'";
    $stid = oci_parse($conn, $sql);
    oci_execute($stid);
    $row = oci_fetch_array($stid, OCI_ASSOC);

    if (!$row) {
        $sql2 = "INSERT INTO loginf(PASSWORD,USERNAME) VALUES ('$pass','$user')";
        $statement2 = oci_parse($conn, $sql2);
        oci_execute($statement2);
        header("Location: https://training.caterp.net/employee.php"); 
        oci_commit($conn);
    } else
        echo "Username Already registered";
}
