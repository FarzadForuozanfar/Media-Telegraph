<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
      }
    include "model/database.php";
    $caption = $_POST['caption'];
    $user_id = $_SESSION['username_login']['id'];
    $post_id = $_POST['post-id'];
    try
    {
        $db->query("INSERT INTO comments(text, user_id, post_id) VALUES ('$caption', '$user_id', '$post_id')");
    }
    catch (Exception $e)
    {
        echo "Error: " . $e->getMessage();
    }
?>
