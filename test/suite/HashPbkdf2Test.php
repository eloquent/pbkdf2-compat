<?php

/*
 * This file is part of the PBKDF2 compatibility package.
 *
 * Copyright © 2013 Erin Millard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class HashPbkdf2Test extends PHPUnit_Framework_TestCase
{
    /**
     * See [RFC 6070 section 2](http://tools.ietf.org/html/rfc6070#section-2).
     */
    public function pbkdf2Data()
    {
        return array(
            array('password',                 'salt',                                 1,        20, '0c60c80f961f0e71f3a9b524af6012062fe037a6'),
            array('password',                 'salt',                                 2,        20, 'ea6c014dc72d6f8ccd1ed92ace1d41f0d8de8957'),
            array('password',                 'salt',                                 4096,     20, '4b007901b765489abead49d926f721d065a429c1'),
            // disabled because this test takes a large amount of time to complete
            // array('password',                 'salt',                                 16777216, 20, 'eefe3d61cd4da4e4e9945b3d6ba2158c2634e984'),
            array('passwordPASSWORDpassword', 'saltSALTsaltSALTsaltSALTsaltSALTsalt', 4096,     25, '3d2eec4fe41c849b80c8d83662c0e44a8b291a964cf2f07038'),
            array("pass\0word",               "sa\0lt",                               4096,     16, '56fa6aa75548099dcc37d7f03425e0c3'),
        );
    }

    /**
     * @dataProvider pbkdf2Data
     */
    public function testHashPbkdf2($password, $salt, $iterations, $length, $expectedHexHash)
    {
        $hexHash = hash_pbkdf2('sha1', $password, $salt, $iterations, $length);
        $rawHash = hash_pbkdf2('sha1', $password, $salt, $iterations, $length, true);

        $this->assertSame($expectedHexHash, $hexHash);
        $this->assertSame(pack('H*', $expectedHexHash), $rawHash);
    }
}
