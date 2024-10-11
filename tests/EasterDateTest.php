<?php

use function PHPUnit\Framework\assertSame;

/**
 * Just tests some random things to demonstrate the concept of self-naming tests. Might be nice for cases
 * where the test implementation is short enough to also function as the name.
 *
 * Some tests intentionally fail so that we can see how the output appears for failing and passing tests.
 *
 * @coversNothing
 */
class EasterDateTest extends \PHPUnit\Framework\TestCase
{
    use SelfNamingTestCase;
    public static function testCases(): array
    {
        return [
            fn() => 1_711_843_200 === easter_date(2024),
            fn() => strtotime('Sun, 31 Mar 2024') === easter_date(2024),
            fn() => 1_711_843_201 === easter_date(2024),
            fn() => assertSame(35, easter_date(2024)),
            fn() => assertSame(1_711_843_200, easter_date(2024)),
            fn() => 3 > 1,
            fn() => 3 < 1,
            fn() => rand(0, 100) > 10,
        ];
    }
}