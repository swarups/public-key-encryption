## Public Key Encryption and Decryption.
> Keys can be generated using predefined php methods(shown here) and with command in terminal.
> Encryption in client end is done using jsecryption library from https://github.com/travist/jsencrypt
> We can store the keys in .pem, .rsa file and use them to encrypt and decrypt.

> Basically when you encrypt something using an RSA key (whether public or private), the encrypted value must be smaller than the key (due to the maths used to do the actual encryption). So if you have a 1024-bit key, in theory you could encrypt any 1023-bit value (or a 1024-bit value smaller than the key) with that key. For more details please follow https://www.php.net/manual/en/function.openssl-public-encrypt.php