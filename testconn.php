<?php

  require_once 'config/dbconnect.php';

  $stmtLastStmt = "SELECT 'Hello Oracle Connection Test is successful' DP_RES FROM DUAL";
    
  $stmtLastParsed   = ociparse($orclConn, $stmtLastStmt);
    if (!$stmtLastParsed)
    { print ocierror($orclConn);
    }
    $stmtLastExecuted = ociexecute($stmtLastParsed, OCI_COMMIT_ON_SUCCESS);
    if (!$stmtLastExecuted)
    { print ocierror($stmtLastParsed);
    }
    ocifetchinto ($stmtLastParsed, $resultRow, OCI_ASSOC);

    $res = $resultRow['DP_RES'];

  echo "Result: ".$res;
?>
