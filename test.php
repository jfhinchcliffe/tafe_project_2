<?php
ob_start();
if (isset($_COOKIE['test'])) {
    echo 'cookie is fine<br>';
    print_r($_COOKIE);
} else {
    setcookie('test', 'cookie test content', time()+3600);  /* expire in 1 hour */
    echo 'Trying to set cookie. Reload page plz';
}
