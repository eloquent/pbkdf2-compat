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
    }
}
