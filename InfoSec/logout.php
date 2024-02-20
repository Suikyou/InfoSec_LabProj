<?php
    session_start();
    session_destroy();
    header("Location: http://localhost/sent_codes/crud_app/InfoSec/login.php");
?>