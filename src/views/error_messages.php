<?php
    if (isset($_SESSION['error']) && ($_SESSION['error'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success']) && ($_SESSION['success'])) {
        echo '<div class="alert alert-success" role="alert">'. $_SESSION['success'] .'</div>';
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['warning']) && ($_SESSION['warning'])) {
        echo '<div class="alert alert-warning" role="alert">'. $_SESSION['success']. '</div>';
        unset($_SESSION['warning']);
    }
?>