<?php

session_start();

define("USER_ID", $_SESSION['user_id'] ?? '');

define("IS_USER_LOGGED_IN", USER_ID != '');
