<?php

// Database credentials

define('ORCLSERVER',    '10.135.179.25');
define('PHPSERVER',     'https://training.caterp.net');
define('PHPPORT',       '80');
define('ORCLPORT',      '1521');
// define('ORCLSID',       'MAC12DB');
define('ORCLSID',       'xepdb1');
define('ORCLUSER',      'SCOTT');
define('ORCLPASS',      'TIGER');

/**
 * Connect to DB
 */

$orclServer   = ORCLSERVER;
$orclPort     = ORCLPORT;
$phpServer    = PHPSERVER;
$phpPort      = PHPPORT;
$orclSid      = ORCLSID;
$orclUser     = ORCLUSER;
$orclPass     = ORCLPASS;

$orclConnStr  = "(DESCRIPTION =
                                   (ADDRESS_LIST =
                                       (ADDRESS =
                                           (PROTOCOL = 'TCP')
                                           (HOST = {$orclServer})
                                           (PORT = {$orclPort})
                                        )
                                    )
                                   (CONNECT_DATA =
                                       (SERVICE_NAME = {$orclSid})
                                    )
                                )";

$orclConn     = ocilogon($orclUser, $orclPass, $orclConnStr);

if (!$orclConn) {
  // print ocierror();
  $e = oci_error();
  echo $e['message'];
}

// oci_close($orclConn);

ini_set("max_execution_time",   "240");
ini_set("memory_limit",         "128M");
// ini_set("display_errors",       0);

?>
