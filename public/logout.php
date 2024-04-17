/* reused code from sessions_lab */
<?php
require_once '../src/session.php';
$session = new session();
$session->forgetSession();
?>