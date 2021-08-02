<?php
session_start();

$post_id = $_POST['like'];
$list = $_SESSION['favorites'];

if (in_array($post_id, $list)) {
    $tmp_list = [];

    for ($i = 0; $i < count($list); $i++) {
        if ($list[$i] != $post_id) {
            array_push($tmp_list, $list[$i]);
        }
    }

    $_SESSION['favorites'] = $tmp_list;
    return true;
}

array_push($_SESSION['favorites'], $post_id);

return true;

