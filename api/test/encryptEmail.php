<?php

function encryptEmail($email) : string {
    $secretKey = "1234567890123456";
    return openssl_encrypt($email, 'AES-128-CTR', $secretKey, 0, '1234567891017180');
}

$email = "aadhil2001ahamed@gmail.com";
$encryptedEmail = encryptEmail($email);

echo $encryptedEmail;
echo "<br>";
echo "URL: https://eclipselk.com/interview/index.php?token=" . urlencode($encryptedEmail);

?>