<?php

$scandir = scandir("inc/charset-test");
$fs_encode = mb_detect_encoding($scandir[2]);
$internal_encode = mb_internal_encoding();

define('FS_ENCODE', $fs_encode);
define('INTERNAL_ENCODE', $internal_encode);
