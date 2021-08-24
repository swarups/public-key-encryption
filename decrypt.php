<?php
session_start();

//dycrypt the message
if ($_POST["encoded_message"] != "") {
    // echo $_POST["encoded_message"]; exit;
    openssl_private_decrypt(base64_decode($_POST["encoded_message"]), $plainMessage, $_SESSION["private_key"]);
    echo $plainMessage;
} else {
    echo "This page works with form post.";
}
exit;