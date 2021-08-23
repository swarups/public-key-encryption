<?php
/**
 * Encrypt message with public key encryption.
 * Keys can be generated using PHP OPENSSL methdods or From Terminal
 */
session_start();

$config = array(
    "private_key_bits" => 512,
);

// Create the private and public key
$res = openssl_pkey_new($config);

// Extract the private key from $res to $privKey
openssl_pkey_export($res, $privKey);
$_SESSION['private_key'] = $privKey;
// Extract the public key from $res to $pubKey
$pubKey = openssl_pkey_get_details($res);
$pubKey = $pubKey["key"];

// $_SESSION['private_key'] = <<<'KEY'
// -----BEGIN PRIVATE KEY-----
// MIIBVAIBADANBgkqhkiG9w0BAQEFAASCAT4wggE6AgEAAkEAn2b+jYRiwDM85Mxa
// zY7Vl2fvbzsxr8/sDY5atQbe8TrfadWfd3ZtgWlp+WzPhlayI5wNDJ7kALSAuGEd
// /cT2fQIDAQABAkBlICkzzJ39g0QJfx/IMuqMgFKlRW9zMzx1KS+gkvhTHt8O52jb
// PHazqmr95ENcfRNhfQpxqM7jtNV+Wk8OJD1hAiEAzVP8dYgQx3tRPzC8orZDj1fP
// Hh6hg8LrFNd4kyYnhJkCIQDGvY59epkkWe/bkz3ey7mcPPyVrqFNnmCWOhp/8O6L
// hQIhAI4ioHXf3fWpKQH8Q+jDERuOZoLsI1SpvsArtHzwgZSpAiAqdsgiUXa1SK4y
// WWSn3Rm8o19I0DZQ8l0q3CFbYuxlTQIgM6UBJvL89PR6maAkV9ebE6ATNt+N2cMJ
// bLDIhDhOdqs=
// -----END PRIVATE KEY-----
// KEY;

// $pubKey = <<<'KEY'
// -----BEGIN PUBLIC KEY-----
// MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAJ9m/o2EYsAzPOTMWs2O1Zdn7287Ma/P
// 7A2OWrUG3vE632nVn3d2bYFpaflsz4ZWsiOcDQye5AC0gLhhHf3E9n0CAwEAAQ==
// -----END PUBLIC KEY-----
// KEY;

$data = 'Plain message to be encrypted';
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Demo | Public Key Encryption  </title>
        <meta http-equiv = "Content-Type" content = "text/html; charset = UTF-8">
        <script type = "text/javascript" src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
        <script type = "text/javascript" src = "./js/jsencryption.js"> </script>
        <script type = "text/javascript" src = "./js/main.js"> </script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
        <style>
            body {
                padding: 25px 0px;
            }
            .decrypt-area {
                display: none;
                padding: 20px 0px;
            }
            .decrypt-button {
                margin: 15px 0px;
            }
            .js-decrypt-area {
                display: none;
                padding-bottom: 20px;
            }
            .php-decrypt-area {
                display: none;
                padding-bottom: 20px;
            }
            label {
                font-weight: bold;
            }
            .encrypted-message {
                padding: 10px;
                background-color: #D6CFC7;
                word-break: break-all;
            }
            .php-decrypted-message{
                padding: 10px;
                background-color: #C7C6C1;
            }
            .js-decrypted-message{
                padding: 10px;
                background-color: #BEBDB8;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul>
                        <li>Example for public key encryption and decryption.</li>
                        <li>Keys can be generated using predefined php methods(shown here) and with command in terminal.</li>
                        <li>Encryption in client end is done using jsecryption library from <a href="https://github.com/travist/jsencrypt ">https://github.com/travist/jsencrypt</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="publickey">Public key</label>
                        <textarea id="publickey" class="form-control" rows="4" cols="50"><?php echo $pubKey;?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="privatekey">Private key</label>
                        <textarea id="privatekey" class="form-control" rows="4" cols="50"><?php echo $_SESSION['private_key'];?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message_plain">Message to be encrypted</label>
                        <textarea id="message_plain" class="form-control" rows="8" cols=70><?php echo $data;?></textarea>
                    </div>
                    <button class="btn btn-primary" onClick = "encryptTheMessage();">Encrypt With Javascript</button>
                </div>
            </div>
            <div class="row">
                <div class="decrypt-area">
                    <div class="col-md-8">
                        <label for="encrypted_message_contianer">Public key encrypted message</label>
                        <div id="encrypted_message_contianer" class="encrypted-message"></div>
                        <input type="hidden" id="encrypted_message" class="form-control" name="encoded_message" />
                    </div>
                    <div class="row decrypt-button">
                        <div class="col-md-8">
                            <button class="btn btn-primary mr-1" onClick = "decryptTheMessage();">Decrypt With Javascript</button>
                            <button class="btn btn-primary ml-1" onClick = "decryptTheMessagePhp();">Decrypt With PHP</button>
                        </div>
                    </div>
                    <div class="row js-decrypt-area">
                        <div class="col-md-8">
                            <label for="js_decrypted_message_contianer">JS Dencrypted message</label>
                            <div id="js_decrypted_message_contianer" class="js-decrypted-message"></div>
                        </div>
                    </div>
                    <div class="row php-decrypt-area">
                        <div class="col-md-8">
                            <label for="php_decrypted_message_contianer">PHP Dencrypted message</label>
                            <div id="php_decrypted_message_contianer" class="php-decrypted-message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>