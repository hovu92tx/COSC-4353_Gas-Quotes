<?php
function deencrypt_Data($encryption)
{
    $ciphering = "AES-128-CTR";

    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121';

    // Store the encryption key
    $encryption_key = "COSC4353";
    // Non-NULL Initialization Vector for decryption
    $decryption_iv = '1234567891011121';

    // Store the decryption key
    $decryption_key = "COSC4353";

    // Use openssl_decrypt() function to decrypt the data
    $decryption = openssl_decrypt(
        $encryption,
        $ciphering,
        $decryption_key,
        $options,
        $decryption_iv
    );

    // Display the decrypted string
    return $decryption;
}
