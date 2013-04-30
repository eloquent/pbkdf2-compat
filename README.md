# PBKDF2-compat

*A compatibility library for the PHP 5.5 function hash_pbkdf2().*

[![Build Status]](http://travis-ci.org/eloquent/pbkdf2-compat)
[![Test Coverage]](http://lqnt.co/pbkdf2-compat/artifacts/tests/coverage/)

## Installation

Available as [Composer](http://getcomposer.org/) package
[eloquent/pbkdf2-compat](https://packagist.org/packages/eloquent/pbkdf2-compat).

## What does it do?

This library provides a forwards-compatible implementation of the
[hash_pbkdf2()](http://php.net/hash_pbkdf2) function introduced in PHP 5.5.

It allows the use of this function in versions of PHP prior to 5.5, and falls
back to the native function when it is available.

## Acknowledgements

Inspired by [ircmaxell/password_compat](https://github.com/ircmaxell/password_compat).
PBKDF2 implementation derived from Symfony's
[Pbkdf2PasswordEncoder](https://github.com/symfony/symfony/blob/master/src/Symfony/Component/Security/Core/Encoder/Pbkdf2PasswordEncoder.php).
