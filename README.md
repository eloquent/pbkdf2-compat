# PBKDF2-compat

*A compatibility library for the PHP 5.5 function hash_pbkdf2().*

[![The most recent stable version is 1.0.0][version-image]][Semantic versioning]
[![Current build status image][build-image]][Current build status]
[![Current coverage status image][coverage-image]][Current coverage status]

## Installation and documentation

- Available as [Composer] package [eloquent/pbkdf2-compat].

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

[ircmaxell/password_compat]: https://github.com/ircmaxell/password_compat
[PHP manual entry]: http://php.net/hash_pbkdf2
[hash_pbkdf2()]: http://php.net/hash_pbkdf2
[Pbkdf2PasswordEncoder]: https://github.com/symfony/symfony/blob/master/src/Symfony/Component/Security/Core/Encoder/Pbkdf2PasswordEncoder.php

[Composer]: http://getcomposer.org/
[build-image]: http://img.shields.io/travis/eloquent/pbkdf2-compat/develop.svg "Current build status for the develop branch"
[Current build status]: https://travis-ci.org/eloquent/pbkdf2-compat
[coverage-image]: http://img.shields.io/coveralls/eloquent/pbkdf2-compat/develop.svg "Current test coverage for the develop branch"
[Current coverage status]: https://coveralls.io/r/eloquent/pbkdf2-compat
[eloquent/pbkdf2-compat]: https://packagist.org/packages/eloquent/pbkdf2-compat
[Semantic versioning]: http://semver.org/
[version-image]: http://img.shields.io/:semver-1.0.0-brightgreen.svg "This project uses semantic versioning"
