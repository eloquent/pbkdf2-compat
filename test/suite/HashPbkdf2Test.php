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
    public function rfcTestVectorData()
    {
        return array(
            'RFC test vector #1' => array('password',                 'salt',                                 'sha1', 1,    20, '0c60c80f961f0e71f3a9b524af6012062fe037a6'),
            'RFC test vector #2' => array('password',                 'salt',                                 'sha1', 2,    20, 'ea6c014dc72d6f8ccd1ed92ace1d41f0d8de8957'),
            'RFC test vector #3' => array('password',                 'salt',                                 'sha1', 4096, 20, '4b007901b765489abead49d926f721d065a429c1'),
            // for test vector 4, see testHashPbkdf2WithManyIterations() below
            'RFC test vector #5' => array('passwordPASSWORDpassword', 'saltSALTsaltSALTsaltSALTsaltSALTsalt', 'sha1', 4096, 25, '3d2eec4fe41c849b80c8d83662c0e44a8b291a964cf2f07038'),
            'RFC test vector #6' => array("pass\0word",               "sa\0lt",                               'sha1', 4096, 16, '56fa6aa75548099dcc37d7f03425e0c3'),
        );
    }

    public function pbkdf2Data()
    {
        $data = array(
            'Default length'              => array('password', 'salt', 'sha1', 1, 0, '0c60c80f961f0e71f3a9'),
            'Alternate hashing algorithm' => array('password', 'salt', 'sha512', 1, 0, '867f70cf1ade02cff3752599a3a53dc4af34c7a669815ae5d513554e1c8cf252'),
        );

        return array_merge($this->rfcTestVectorData(), $data);
    }

    public function pbkdf2RawData()
    {
        $data = array(
            'Default length'              => array('password', 'salt', 'sha1', 1, 0, '0c60c80f961f0e71f3a9b524af6012062fe037a6'),
            'Alternate hashing algorithm' => array('password', 'salt', 'sha512', 1, 0, '867f70cf1ade02cff3752599a3a53dc4af34c7a669815ae5d513554e1c8cf252c02d470a285a0501bad999bfe943c08f050235d7d68b1da55e63f73b60a57fce'),
        );

        return array_merge($this->rfcTestVectorData(), $data);
    }

    /**
     * @dataProvider pbkdf2Data
     */
    public function testHashPbkdf2($password, $salt, $algo, $iterations, $length, $expectedHexHash)
    {
        $this->assertSame(
            $expectedHexHash,
            hash_pbkdf2($algo, $password, $salt, $iterations, $length * 2)
        );
    }

    /**
     * @dataProvider pbkdf2RawData
     */
    public function testHashPbkdf2Raw($password, $salt, $algo, $iterations, $length, $expectedHexHash)
    {
        $this->assertSame(
            pack('H*', $expectedHexHash),
            hash_pbkdf2($algo, $password, $salt, $iterations, $length, true)
        );
    }

    /**
     * Performance intensive test from the RFC test vectors.
     *
     * See [RFC 6070 section 2](http://tools.ietf.org/html/rfc6070#section-2).
     *
     * @group intensive
     */
    public function testHashPbkdf2WithManyIterations()
    {
        $this->testHashPbkdf2('password', 'salt', 16777216, 20, 'eefe3d61cd4da4e4e9945b3d6ba2158c2634e984');
    }
}
