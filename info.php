<?php
require_once "config/dbconnect.php";

$user = $_POST["uname"];
$pass = $_POST["password"];

$conn = oci_connect($orclUser, $orclPass, $orclConnStr);
if ($conn) 
{
    $sql = "SELECT * FROM loginf WHERE USERNAME='$user' and PASSWORD='$pass'";
    $stid = oci_parse($conn, $sql);
    oci_execute($stid);
    $row = oci_fetch_array($stid, OCI_ASSOC);
    if (!$row) 
    {
        echo "invalid credentials";
    } 
    else
    {
       header("Location: https://training.caterp.net/employee.php");
    }  
} 
else 
{
    echo 'System Error';
}
?>
