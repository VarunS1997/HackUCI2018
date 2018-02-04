<?php
require __DIR__ . '/vendor/autoload.php';

if (!session_id()) {
    session_start();
    session_destroy();
    header("Location: ../");
}

?>
