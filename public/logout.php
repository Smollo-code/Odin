<?php
session_start();
unset($_SESSION['userId']);
header('Location: http://odin.scam/');