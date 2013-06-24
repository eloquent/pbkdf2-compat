<?php

/*
 * This file is part of the PBKDF2 compatibility package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!function_exists('hash_pbkdf2')) {
    function hash_pbkdf2($algo, $password, $salt, $iterations, $length = 0, $raw_output = false)
    {
        $algoLength = strlen(hash($algo, null, true));
        if (0 === $length) {
            $length = $algoLength;
            if (!$raw_output) {
                $length *= 2;
            }
        }
        $blocks = ceil($length / $algoLength);

        $digest = '';
        for ($i = 1; $i <= $blocks; $i++) {
            $ib = $block = hash_hmac(
                $algo,
                $salt . pack('N', $i),
                $password,
                true
            );

            for ($j = 1; $j < $iterations; $j++) {
                $ib ^= ($block = hash_hmac($algo, $block, $password, true));
            }

            $digest .= $ib;
        }

        if (!$raw_output) {
            $digest = bin2hex($digest);
        }
        $digest = substr($digest, 0, $length);

        return $digest;
    }
}
