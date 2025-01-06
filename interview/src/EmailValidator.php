<?php

use Database;

class EmailValidator {
    private const SECRET_KEY = "MAGEADARETHARAMdannawanam";

    public static function validateToken($token) : ?string {
        $email = self::decodeToken($token);

        if($email == false) {
            return null;
        }

        if(!self::isExist($email)) {
            return null;
        }

        return $email;
    }

    private static function decodeToken($token) : string|bool {
        return openssl_decrypt($token, 'AES-128-CTR', self::SECRET_KEY, 0, '2468101214161820');
    }

    private static function isExist($email) : bool {
        $rs_user = Database::s("SELECT * FROM `user` WHERE `email`='". $email ."';");
        return $rs_user->num_rows > 0;
    }
}

?>