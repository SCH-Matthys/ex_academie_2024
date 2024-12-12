<?php
session_start();
session_unset();
session_destroy();
header("Location:/php%20academie%202024/index.php");