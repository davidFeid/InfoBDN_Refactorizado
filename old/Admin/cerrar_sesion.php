<?php 
    session_start();
    session_destroy();
    echo "<meta http-equiv=REFRESH content=0,URL=login.php>";
?>