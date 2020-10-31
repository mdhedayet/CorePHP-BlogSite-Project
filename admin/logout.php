<?php 

    session_start();
    session_unset();
    session_destroy();
    $page = "index.php";
    echo '<script type="text/javascript">';
    echo 'window.location.href="'.$page.'";';
    echo '</script>';
    die();

?>
