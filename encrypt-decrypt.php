<?php
//dycrypt the message
if ($_POST["message"] != "" && $_POST["key"] != "") {
    $errorMsg = "Something unexpected happended.";

    if ($_POST["key"] == "new") {
        $config = array(
            "private_key_bits" => 2048,
        );
        // Create the private and public key
        $res = openssl_pkey_new($config);
        // Extract the private key from $res to $privKey
        openssl_pkey_export($res, $privKey);
        // Extract the public key from $res to $pubKey
        $pubKey = openssl_pkey_get_details($res);
        $pubKey = $pubKey["key"];

        openssl_public_encrypt($_POST["message"], $encrypted, $pubKey);
        if ($encrypted) {
            openssl_private_decrypt($encrypted, $decrypted, $privKey);
            $decrypted = $decrypted ? $decrypted : $errorMsg;
            header('Content-Type: application/json');
            echo json_encode(["encrypted" => base64_encode($encrypted), "decrypted" => $decrypted]);
        } else {
            echo json_encode(["encrypted" => $errorMsg]);
        }
    } elseif($_POST["key"] == "public-key.rsa.pub") {
        $publicKey = file_get_contents('./public-key.rsa.pub');
        $privateKey = file_get_contents('./private-key.rsa');

        openssl_public_encrypt($_POST["message"], $encrypted, $publicKey);
        if ($encrypted) {
            openssl_private_decrypt($encrypted, $decrypted, $privateKey);
            $decrypted = $decrypted ? $decrypted : $errorMsg;
            echo json_encode(["encrypted" => base64_encode($encrypted), "decrypted" => $decrypted]);
        } else {
            echo json_encode(["encrypted" => $errorMsg]);
        }
    } elseif($_POST["key"] == "public-key.pem") {
        $publicKey = file_get_contents('./public-key.pem');
        $privateKey = file_get_contents('./private-key.pem');

        openssl_public_encrypt($_POST["message"], $encrypted, $publicKey);
        if ($encrypted) {
            openssl_private_decrypt($encrypted, $decrypted, $privateKey);
            $decrypted = $decrypted ? $decrypted : $errorMsg;
            echo json_encode(["encrypted" => base64_encode($encrypted), "decrypted" => $decrypted]);
        } else {
            echo json_encode(["encrypted" => $errorMsg]);
        }
    } elseif($_POST["key"] == "term-public.pem") {
        $publicKey = file_get_contents('./term-public.pem');
        $privateKey = file_get_contents('./term-private.pem');

        openssl_public_encrypt($_POST["message"], $encrypted, $publicKey);
        if ($encrypted) {
            openssl_private_decrypt($encrypted, $decrypted, $privateKey);
            $decrypted = $decrypted ? $decrypted : $errorMsg;
            echo json_encode(["encrypted" => base64_encode($encrypted), "decrypted" => $decrypted]);
        } else {
            echo json_encode(["encrypted" => $errorMsg]);
        }
    }

} else {
    echo "Message and Keys are missing.";
}
exit;