function encryptTheMessage () {
    var encrypt = new JSEncrypt();
    encrypt.setPublicKey($('#publickey').val());
    var encrypted = encrypt.encrypt($('#message_plain').val());
    $('#encrypted_message').val(encrypted);
    $('#encrypted_message_contianer').html(encrypted);

    $('#js_decrypted_message_contianer, #php_decrypted_message_contianer').html('');
    $('.js-decrypt-area, .php-decrypt-area').hide();
    $('.decrypt-area').show();
}

function decryptTheMessage() {
    var encrypt = new JSEncrypt();
    encrypt.setPrivateKey($('#privatekey').val());
    var decrypted = encrypt.decrypt($('#encrypted_message').val());
    $('#js_decrypted_message_contianer').html(decrypted);
    $('.js-decrypt-area').show();
}
function decryptTheMessagePhp() {
    if ($('#encrypted_message').val()) {
        $.post('decrypt.php', { encoded_message: $('#encrypted_message').val() }, function (data, textStatus, jqXHR) {  // success callback
            if (textStatus === 'success') {
                $('#php_decrypted_message_contianer').html(data);
            } else {
                $('#php_decrypted_message_contianer').html('Unknown error occured!');
            }
            $('.php-decrypt-area').show();
        });
    }
}