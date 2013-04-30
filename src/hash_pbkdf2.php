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
        if ($length % 2 !== 0) {
            throw new InvalidArgumentException('Length must be a multiple of 2.');
        }
        $length = $length / 2;

        if (0 === $length) {
            $blocks = 1;
        } else {
            $blocks = ceil($length / strlen(hash($algo, null, true)));
        }

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

        if (0 !== $length) {
            $digest = substr($digest, 0, $length);
        }
        if (!$raw_output) {
            $digest = bin2hex($digest);
        }

        return $digest;
    }
}
