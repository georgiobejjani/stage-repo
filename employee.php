<html>

<?php
require_once "config/dbconnect.php";

$empno_pro = $_POST["empno"];
$ename_pro = $_POST["ename"];
$job_pro = $_POST["job"];
$mgr_pro = $_POST["mgr"];
$hiredate_pro = $_POST["hiredate"];
$salary_pro = $_POST["salary"];
$commission_pro = $_POST["comm"];
$deptno_pro = $_POST["deptno"];

$conn = oci_connect($orclUser, $orclPass, $orclConnStr);
if ($conn) {
    $sql2 = "SELECT empno FROM emp WHERE empno='$empno_pro'";
    $stid2 = oci_parse($conn, $sql2);
    oci_execute($stid2);
    $row = oci_fetch_array($stid2, OCI_ASSOC);

    $sql = "begin GEOMGM.INUP_emp(:WEMPNO,:WENAME ,:WJOB ,:WMGR,
    :WHIREDATE ,:WSAL,:WCOMM,:WDEPTNO);end;";
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ':WEMPNO', $empno_pro);
    oci_bind_by_name($stid, ':WENAME', $ename_pro);
    oci_bind_by_name($stid, ':WJOB', $job_pro);
    oci_bind_by_name($stid, ':WMGR', $mgr_pro);
    oci_bind_by_name($stid, ':WHIREDATE', $hiredate_pro);
    oci_bind_by_name($stid, ':WSAL', $salary_pro);
    oci_bind_by_name($stid, ':WCOMM', $commission_pro);
    oci_bind_by_name($stid, ':WDEPTNO', $deptno_pro);
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

<?php

require_once "config/dbconnect.php";
$wdet = "";

$conn = oci_connect($orclUser, $orclPass, $orclConnStr);
if ($conn) {
    $sql = "select e.empno,e.ename,e.job,e.hiredate,e.sal,e.comm,e.deptno,d.loc
    from emp e inner join dept d on e.deptno=d.deptno order by e.empno";
    $stid = oci_parse($conn, $sql);
    oci_execute($stid);


    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        $empno = $row['EMPNO'];
        $ename = $row['ENAME'];
        $job = $row['JOB'];
        $hire = $row['HIREDATE'];
        $salary = $row['SAL'];
        $comm = $row['COMM'];
        $deptno = $row['DEPTNO'];
        $location = $row['LOC'];

        $wdet = $wdet . "<tr><td align='justify' class='rowfont'>" . $empno  . "</td>
                                 <td align='justify' class='rowfont'>" . $ename . "</td>
                                 <td align='left' class='rowfont' >" . $job . "</td>
                                 <td align='justify' class='rowfont'>" . $hire . "</td>
                                 <td align='justify' class='rowfont' >" . $salary . "</td>
                                 <td align='justify' class='rowfont'>" . $comm . "</td>
                                 <td align='justify' class='rowfont' >" . $deptno  . "</td>
                                 <td align='justify' class='rowfont' >" . $location  . "</td>
                                 <td>";
    }
}
?>

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
    oci_bind_by_name($stid, ':WEMPNO', $empno_pro);
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

<?php
require_once "config/dbconnect.php";

$deptno_dele = $_POST["departmentdel"];

$conn = oci_connect($orclUser, $orclPass, $orclConnStr);
if ($conn) {
    $sql2 = "SELECT deptno FROM dept WHERE deptno='$deptno_dele'";
    $stid2 = oci_parse($conn, $sql2);
    oci_execute($stid2);
    $row = oci_fetch_array($stid2, OCI_ASSOC);

    $sql = "begin GEOMGM.DELETE_DEPT(:WDEPTNO);end;";
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ':WDEPTNO', $deptno_dele);
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

<?php
require_once "config/dbconnect.php";

$dep_tno = $_POST["dept_no"];
$dep_tna = $_POST["dept_na"];
$dep_tlo = $_POST["dept_lo"];

$conn = oci_connect($orclUser, $orclPass, $orclConnStr);
if ($conn) {
    $sql2 = "SELECT DEPTNO FROM DEPT WHERE DEPTNO='$dep_tno'";
    $stid2 = oci_parse($conn, $sql2);
    oci_execute($stid2);
    $row = oci_fetch_array($stid2, OCI_ASSOC);

    $sql = "begin GEOMGM.INUP_DEPT(:WDEPTNO,:WDNAME,:WLOC);end;";
    $stid = oci_parse($conn, $sql);
    oci_bind_by_name($stid, ':WDEPTNO', $dep_tno);
    oci_bind_by_name($stid, ':WDNAME', $dep_tna);
    oci_bind_by_name($stid, ':WLOC', $dep_tlo);
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
<?php

require_once "config/dbconnect.php";

$wdett = "";

$conn = oci_connect($orclUser, $orclPass, $orclConnStr);
if ($conn) {

    $sql = "SELECT * FROM dept order by deptno";
    $stid = oci_parse($conn, $sql);
    oci_execute($stid);


    while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        $deptno = $row['DEPTNO'];
        $deptname = $row['DNAME'];
        $deptloc = $row['LOC'];

        $wdett = $wdett . "<tr><td align='justify' class='rowfont'>" . $deptno  . "</td>
                                 <td align='justify' class='rowfont'>" . $deptname . "</td>
                                 <td align='justify' class='rowfont' >" . $deptloc . "</td>
                                 <td>";
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a id="myButton" style="cursor:pointer;"><img src="cat.png" class="navbar-brand" width="100" height="50"></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <script type="text/javascript">
                            document.getElementById("myButton").onclick = function() {
                                location.href = "https://training.caterp.net/register.php";
                            };
                        </script>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- ADD EMPLOYEE-->
    <form action="employee.php" method="post" name="form1">
        <div class="modal fade" id="createEmp" tabindex="-1" role="dialog" aria-labelledby="EmpModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EmpModal">Create New Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputempnum">Employee Number</label>
                                    <input type="number" class="form-control" id="inputempnum" name="empno" placeholder="Employee Number" disabled value="20">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputname">Name</label>
                                    <input type="text" class="form-control" id="inputname" name="ename" placeholder="Employee Name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputjob">Job</label>
                                    <input type="text" class="form-control" id="inputjob" name="job" placeholder="Analyst">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputhiredate">Hiredate</label>
                                    <input type="text" class="form-control" id="inputhiredate" name="hiredate" placeholder="Day/Month/Year">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputdeptnum">Department Number</label>
                                    <select id="mylist" name="deptno" class="form-control">
                                        <option>Deptno</option>
                                        <?php
                                        require_once "config/dbconnect.php";
                                        $conn = oci_connect($orclUser, $orclPass, $orclConnStr);
                                        if ($conn) {
                                            $sql = "SELECT deptno FROM dept order by deptno";
                                            $stid2 = oci_parse($conn, $sql);
                                            oci_execute($stid2);


                                            while ($row = oci_fetch_array($stid2)) {
                                                echo "<option value='" . $row['DEPTNO'] . "'>"  . $row['DEPTNO'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputcomm">Commission</label>
                                    <input type="number" class="form-control" id="inputcomm" name="comm" placeholder="commission">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputsalary">Salary</label>
                                    <input type="number" class="form-control" id="inputsalary" name="salary" placeholder="Salary">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputmgr">Manager Number</label>
                                    <select id="mylist" name="mgr" class="form-control">
                                        <option>Manager</option>
                                        <?php
                                        require_once "config/dbconnect.php";
                                        $conn = oci_connect($orclUser, $orclPass, $orclConnStr);
                                        if ($conn) {
                                            $sql = "SELECT EMPNO FROM emp where job='MANAGER'";
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
                        </form>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-secondary mr-auto " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary mb-3">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- UPDATE EMPLOYEE -->
    <form action="employee.php" method="post" name="form1">
        <div class="modal fade" id="updateEmp" tabindex="-1" role="dialog" aria-labelledby="EmpModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EmpModal">Update Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputempnum">Employee Number</label>
                                    <select id="mylist" name="empno" class="form-control">
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
                                <div class="form-group col-md-6">
                                    <label for="inputname">Name</label>
                                    <input type="text" class="form-control" id="inputname" name="ename" placeholder="Employee Name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputjob">Job</label>
                                    <input type="text" class="form-control" id="inputjob" name="job" placeholder="Analyst">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputhiredate">Hiredate</label>
                                    <input type="text" class="form-control" id="inputhiredate" name="hiredate" placeholder="Day/Month/Year">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputdeptnum">Department Number</label>
                                    <select id="mylist" name="deptno" class="form-control">
                                        <option>Deptno</option>
                                        <?php
                                        require_once "config/dbconnect.php";
                                        $conn = oci_connect($orclUser, $orclPass, $orclConnStr);
                                        if ($conn) {
                                            $sql = "SELECT deptno FROM dept order by deptno";
                                            $stid2 = oci_parse($conn, $sql);
                                            oci_execute($stid2);


                                            while ($row = oci_fetch_array($stid2)) {
                                                echo "<option value='" . $row['DEPTNO'] . "'>"  . $row['DEPTNO'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputcomm">Commission</label>
                                    <input type="number" class="form-control" id="inputcomm" name="comm" placeholder="commission">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputsalary">Salary</label>
                                    <input type="number" class="form-control" id="inputsalary" name="salary" placeholder="Salary">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputmgr">Manager Number</label>
                                    <select id="mylist" name="mgr" class="form-control">
                                        <option>Manager</option>
                                        <?php
                                        require_once "config/dbconnect.php";
                                        $conn = oci_connect($orclUser, $orclPass, $orclConnStr);
                                        if ($conn) {
                                            $sql = "SELECT EMPNO FROM emp where job='MANAGER'";
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
                        </form>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-secondary mr-auto " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary mb-3">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- DELETE EMPLOYEE -->

    <form action="employee.php" method="post" name="form1">
        <div class="modal fade" id="deletemp" tabindex="-1" role="dialog" aria-labelledby="EmpModal" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EmpModal">Remove Employees</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="input-group filterEMPNO">
                                <span class="input-group-text logofilter" id="addon-wrapping"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                    </svg></span>
                                <select id="mylist1" name="input" class="form-control">
                                    <option>EMPNO</option>
                                    <?php
                                    require_once "config/dbconnect.php";
                                    $conn = oci_connect($orclUser, $orclPass, $orclConnStr);
                                    if ($conn) {
                                        $sql = "SELECT EMPNO, ENAME FROM emp order by empno";
                                        $stid2 = oci_parse($conn, $sql);
                                        oci_execute($stid2);


                                        while ($row = oci_fetch_array($stid2)) {
                                            echo "<option value='" . $row['EMPNO'] . "'>"  . $row['EMPNO'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-secondary mr-auto " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary mb-3">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>

<div class="container ded">
    <div class="filtericon">
        <span class="filter">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z" />
            </svg></span>
    </div>
    <div class="input-group filterdeptno">
        <span class="input-group-text logofilter" id="addon-wrapping"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
            </svg></span>
        <select id="myfilter1" onchange="myFunction1()" class="form-control">
            <option value="" disabled selected hidden>Deptno</option>
            <option>0</option>
            <?php
            require_once "config/dbconnect.php";
            $conn = oci_connect($orclUser, $orclPass, $orclConnStr);
            if ($conn) {
                $sql = "SELECT distinct(deptno) FROM emp ORDER BY deptno";
                $stid2 = oci_parse($conn, $sql);
                oci_execute($stid2);
                while ($row = oci_fetch_array($stid2)) {
                    echo "<option value='" . $row['DEPTNO'] . "'>" . $row['DEPTNO'] . "</option>";
                }
            }

            ?>
        </select>
    </div>

    <div class="input-group filterjob">
        <span class="input-group-text logofilter" id="addon-wrapping"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
            </svg></span>
        <select id="myfilter2" onchange="myFunction2()" class="form-control">
            <option value="" disabled selected hidden>Job</option>
            <?php
            require_once "config/dbconnect.php";
            $conn = oci_connect($orclUser, $orclPass, $orclConnStr);
            if ($conn) {
                $sql = "SELECT distinct(job) FROM emp";
                $stid2 = oci_parse($conn, $sql);
                oci_execute($stid2);
                while ($row = oci_fetch_array($stid2)) {
                    echo "<option value='" . $row['JOB'] . "'>" . $row['JOB'] . "</option>";
                }
            }

            ?>
        </select>
    </div>
    </th>
    <table id="myTable" class="table table-striped table-hover">
        <i class="bi bi-archive"></i>
        </svg>
        <thead>
            <tr>
                <th class="headline"> Employee#</th>
                <th class="headline"> Name</th>
                <th class="headline"> Job</th>
                <th class="headline"> HireDate</th>
                <th class="headline"> Salary</th>
                <th class="headline"> Commission</th>
                <th class="headline">Department#</th>
                <th class="headline"> Location</th>
                <th style="width: 2cm;" class="adddept">
                    <div class='dropdown'><button class=' dropes btn btn-secondary ' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-list' viewBox='0 0 16 16'>
                                <path fill-rule='evenodd' d='M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z' />
                            </svg></button>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                            <li align='center'><a class='dropdown-item' data-toggle='modal' data-target='#deletemp' id='item1'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z' />
                                    </svg> Delete</a></li>
                            <li align='center'><a class='dropdown-item' data-toggle='modal' data-target='#updateEmp' id='item2'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z' />
                                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z' />
                                    </svg> Update</a></li>
                            <li align='center'><a class='dropdown-item' data-toggle='modal' data-target='#createEmp' id='item3'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-person-plus-fill' viewBox='0 0 16 16'>
                                        <path d='M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z' />
                                        <path fill-rule="evenodd" d='M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z' />
                                    </svg> New Emp</a></li>
                            </svg>
                        </ul>
                    </div>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($wdet)) {
                echo $wdet;
            } ?>
        </tbody>
    </table>
</div>

<!-- Add Department -->
<form action="employee.php" method="post" name="form1">
    <div class="modal fade" id="createdept" tabindex="-1" aria-labelledby="deptmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="inputdeptnum" class="form-label">Department Number</label>
                                <input type="number" name="dept_no" class="form-control" id="inputdeptnum" placeholder="20" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputdeptNa" class="form-label">Department Name</label>
                                <input type="text" name="dept_na" class="form-control" id="inputdeptNa" placeholder="Sales" required>
                            </div>

                            <div class="col-md-4">
                                <label for="inputloc" class="form-label">Department Location</label>
                                <input type="text" name="dept_lo" class="form-control" id="inputloc" placeholder="Beirut" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary" onclick="submitForm()">Create</button>
                </div>


            </div>
        </div>
    </div>
</form>
<!-- Update Department -->
<form action="employee.php" method="post" name="form1">
    <div class="modal fade" id="updateDept" tabindex="-1" aria-labelledby="deptmodal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="inputdeptnum" class="form-label">Department Number</label>
                                <select id="mylist" name="dept_no" class="form-control" required>
                                    <option>Deptno</option>
                                    <?php
                                    require_once "config/dbconnect.php";
                                    $conn = oci_connect($orclUser, $orclPass, $orclConnStr);
                                    if ($conn) {
                                        $sql = "SELECT deptno FROM dept order by deptno";
                                        $stid2 = oci_parse($conn, $sql);
                                        oci_execute($stid2);


                                        while ($row = oci_fetch_array($stid2)) {
                                            echo "<option value='" . $row['DEPTNO'] . "'>"  . $row['DEPTNO'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="inputdeptNa" class="form-label">Department Name</label>
                                <input type="text" name="dept_na" class="form-control" id="inputdeptNa" placeholder="Sales" required>
                            </div>

                            <div class="col-md-4">
                                <label for="inputloc" class="form-label">Department Location</label>
                                <input type="text" name="dept_lo" class="form-control" id="inputloc" placeholder="Beirut" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="submit" class="btn btn-primary" onclick="submitForm()">Create</button>
                </div>


            </div>
        </div>
    </div>
</form>
<!-- Delete Departments -->
<form action="employee.php" method="post" name="form1">
    <div class="modal fade" id="deletdept" tabindex="-1" role="dialog" aria-labelledby="EmpModal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="EmpModal">Remove Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="input-group filterEMPNO">
                            <span class="input-group-text logofilter" id="addon-wrapping"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                    <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                </svg></span>
                            <select id="mylist" name="departmentdel" class="form-control">
                                <option>Department</option>
                                <?php
                                require_once "config/dbconnect.php";
                                $conn = oci_connect($orclUser, $orclPass, $orclConnStr);
                                if ($conn) {
                                    $sql = "SELECT deptno FROM dept order by deptno";
                                    $stid2 = oci_parse($conn, $sql);
                                    oci_execute($stid2);


                                    while ($row = oci_fetch_array($stid2)) {
                                        echo "<option value='" . $row['DEPTNO'] . "'>"  . $row['DEPTNO'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary mr-auto " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary mb-3">Delete</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="container ded">
    <table id="myTable2" class="table table-striped table-hover">
        <i class="bi bi-archive"></i>
        <thead>
            <tr>
                <th class="headline"> Department#</th>
                <th class="headline">Name</th>
                <th class="headline">Location</th>
                <th style="width: 2cm;" class="adddept">
                    <div class='dropdown'><button class=' dropes btn btn-secondary ' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor' class='bi bi-list' viewBox='0 0 16 16'>
                                <path fill-rule='evenodd' d='M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z' />
                            </svg></button>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                            <li align='center'><a class='dropdown-item' data-bs-toggle="modal" data-bs-target="#deletdept" id='item1'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z' />
                                    </svg> Delete</a></li>
                            <li align='center'><a class='dropdown-item' data-bs-toggle="modal" data-bs-target="#updateDept" id='item2'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z' />
                                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z' />
                                    </svg> Update</a></li>
                            <li align='center'><a data-bs-toggle="modal" data-bs-target="#createdept" class='dropdown-item' id='item3'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" />
                                    </svg> New Dept</a></li>
                            </svg>
                        </ul>
                    </div>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($wdett)) {
                echo $wdett;
            } ?>
        </tbody>
    </table>
</div>





<script>
    function myFunction1() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myfilter1");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[6];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

<script>
    function myFunction2() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myfilter2");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
<style>
    body {
        height: 100%;
        background-image: url("background2.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    .nav-link {
        color: white;
    }

    .filterdeptno {

        width: 5cm;
        top: 1cm;
        left: 1.5cm;
    }

    .filterjob {
        width: 5cm;

        left: 7cm;
    }


    .logofilter {
        background-color: #05f7ff;
    }

    .filtericon {
        position: absolute;
        margin-left: 0.5cm;
        top: 4cm;
    }

    .nav-link:hover {
        color: red;
        cursor: pointer;
    }

    .ded {
        margin-top: 1cm;
        width: 1600px;
        padding-bottom: 1cm;
        border-radius: 1cm;
        right: 8cm;
        height: auto;
        background-color: rgba(255, 255, 255, .8);
    }

    .headline {
        color: #52595D;
        font-size: 18px;
    }

    .rowfont,
    .dropdown-item {
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        color: #52595D;
        font-weight: bold;
        font-size: 14px;
    }

    table {
        max-width: 100%;
    }

    .dropes {
        border: none;
        background-color: transparent;
        color: black;
        outline: none;
    }

    .dropes:hover,
    .dropes:focus {
        background-color: transparent;
        color: red;
        outline: 0;
        box-shadow: 0 0 0 0rem rgb(0 0 0 /100%);
        outline: none;
    }

    #item1:hover,
    #item1:focus {
        color: red;

    }

    #item3:hover,
    #item3:focus {
        color: blue;

    }

    #item2:hover,
    #item2:focus {
        color: green;

    }

    .adddept {
        color: #52595D;
        cursor: pointer;

    }
</style>

</html>