<html>
<?php
require_once "config/dbconnect.php";

$empno_pro = $_POST["input"];

$conn = oci_connect($orclUser, $orclPass, $orclConnStr);
if ($conn) {
    $sql2 = "SELECT empno FROM emp WHERE empno='$empno_pro'";
    $stid2 = oci_parse($conn, $sql2);
    oci_execute($stid2);
    $row = oci_fetch_array($stid2, OCI_ASSOC);

    $sql = "begin GEOMGM.DELETE_EMP(:WEMPNO);end;";
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ':WEMPNO',$empno_pro);
    oci_execute($stid);
    if (oci_execute($stid)) {
        oci_free_statement($stid);
        oci_close($conn);
    } else {
        $l = oci_error($stid)["message"];
        echo oci_error($stid)["message"];
    }
}
?>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
<form action="test.php" method="post" name="form1">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteemployee">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="deleteemp" tabindex="-1" aria-labelledby="deleteemp" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteemp">Remove Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group filterEMPNO">
                        <span class="input-group-text logofilter" id="addon-wrapping"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                            </svg></span>
                        <select id="mylist" name="input" class="form-control">
                            <option>EMPNO</option>
                            <?php
                            require_once "config/dbconnect.php";
                            $conn = oci_connect($orclUser, $orclPass, $orclConnStr);
                            if ($conn) {
                                $sql = "SELECT EMPNO, ENAME FROM emp";
                                $stid2 = oci_parse($conn, $sql);
                                oci_execute($stid2);


                                while ($row = oci_fetch_array($stid2)) {
                                    echo "<option value='" . $row['EMPNO'] . "'>"  . $row['EMPNO'] . "</option>";
                                }
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>


</form>

</body>

</html>