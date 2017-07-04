<?php

#密码加密模式:
$user['salt'] = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
$user['password'] = encode_password($password, $user['salt']);

/**
 * 生成密码
 * @param unknown $raw
 * @param unknown $salt
 * @param string $algorithm
 * @return string
 */
function encode_password($raw, $salt, $algorithm = 'sha256') {
    $salted = merge_password_salt($raw, $salt);
    $digest = hash($algorithm, $salted, true);
    // "stretch" hash
    for ($i = 1; $i < 5000; $i++) {
        $digest = hash($algorithm, $digest.$salted, true);
    }

    return base64_encode($digest);
}
function merge_password_salt($password, $salt) {
    if (empty($salt)) {
        return $password;
    }

    return $password.'{'.$salt.'}';
}