# PBKDF2-compat

*A compatibility library for the PHP 5.5 function hash_pbkdf2().*

[![Build Status]][Latest build]
[![Test Coverage]][Test coverage report]

## Installation

Available as [Composer] package [eloquent/pbkdf2-compat].

## What does it do?

This library provides a forwards-compatible implementation of the
[hash_pbkdf2()] function introduced in PHP 5.5. It allows the use of this
function in versions of PHP prior to 5.5, and falls back to the native function
when it is available.

## Usage

See the [PHP manual entry].

## Behaviour of length parameter

Although the documentation does not specify, the $length parameter refers to the
resulting string length, not the length of the raw hash. This means that when
$raw_output is false, $length needs to be doubled to produce a hash containing
the same amount of data (because hex encoding doubles the number of bytes in the
result string).

## Acknowledgements

Inspired by [ircmaxell/password_compat]. PBKDF2 implementation derived from
Symfony's [Pbkdf2PasswordEncoder].

<!-- References -->

[Build Status]: https://raw.github.com/eloquent/pbkdf2-compat/gh-pages/artifacts/images/icecave/regular/build-status.png
[Composer]: http://getcomposer.org/
[eloquent/pbkdf2-compat]: https://packagist.org/packages/eloquent/pbkdf2-compat
[ircmaxell/password_compat]: https://github.com/ircmaxell/password_compat
[Latest build]: http://travis-ci.org/eloquent/pbkdf2-compat
[PHP manual entry]: http://php.net/hash_pbkdf2
[Test coverage report]: http://lqnt.co/pbkdf2-compat/artifacts/tests/coverage/
[Test Coverage]: https://raw.github.com/eloquent/pbkdf2-compat/gh-pages/artifacts/images/icecave/regular/coverage.png
[hash_pbkdf2()]: http://php.net/hash_pbkdf2
[Pbkdf2PasswordEncoder]: https://github.com/symfony/symfony/blob/master/src/Symfony/Component/Security/Core/Encoder/Pbkdf2PasswordEncoder.php
