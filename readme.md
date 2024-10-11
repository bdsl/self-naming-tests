# Self naming tests

Barney Laurance <barney@barneylaurance.uk>

Testing out the idea of having anonymous / self-naming unit test cases. The source code for each
test must be short (no more than one line) and so also functions as the name of the test.

Given tests defined like so:

```php
    public static function checks(): array
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
```

output is as follows, as you can see in [github actions](https://github.com/bdsl/self-naming-tests/actions)
is currently as follows:

```text
Run vendor/bin/phpunit
PHPUnit 10.5.36 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.1.2-1ubuntu2.19
Configuration: /home/runner/work/self-naming-tests/self-naming-tests/phpunit.xml

..FF..F.                                                            8 / 8 (100%)

Time: 00:00.010, Memory: 8.00 MB

There were 3 failures:

1) BDSL\SelfNamingTestExample\Test\EasterDateTest::testUsingCallables with data set "1_711_843_201 === easter_date(2024) (EasterDateTest.php:23)" (Closure Object (...))
Failed asserting that false is true.

/home/runner/work/self-naming-tests/self-naming-tests/tests/SelfNamingTestCase.php:41

2) BDSL\SelfNamingTestExample\Test\EasterDateTest::testUsingCallables with data set "assertSame(35, easter_date(2024)) (EasterDateTest.php:24)" (Closure Object (...))
Failed asserting that 1711843200 is identical to 35.

/home/runner/work/self-naming-tests/self-naming-tests/tests/EasterDateTest.php:24
/home/runner/work/self-naming-tests/self-naming-tests/tests/SelfNamingTestCase.php:39

3) BDSL\SelfNamingTestExample\Test\EasterDateTest::testUsingCallables with data set "3 < 1 (EasterDateTest.php:27)" (Closure Object (...))
Failed asserting that false is true.

/home/runner/work/self-naming-tests/self-naming-tests/tests/SelfNamingTestCase.php:41

FAILURES!
Tests: 8, Assertions: 8, Failures: 3.
Error: Process completed with exit code 1.
```

Or with the testdox option:

```text
Run vendor/bin/phpunit --testdox
PHPUnit 10.5.36 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.1.2-1ubuntu2.19
Configuration: /home/runner/work/self-naming-tests/self-naming-tests/phpunit.xml

..FF..F.                                                            8 / 8 (100%)

Time: 00:00.010, Memory: 8.00 MB

Easter Date (BDSL\SelfNamingTestExample\Test\EasterDate)
 ✔ Using callables with data set "1_711_843_200 === easter_date(2024) (EasterDateTest.php:21)"
 ✔ Using callables with data set "strtotime('Sun, 31 Mar 2024') === easter_date(2024) (EasterDateTest.php:22)"
 ✘ Using callables with data set "1_711_843_201 === easter_date(2024) (EasterDateTest.php:23)"
   │
   │ Failed asserting that false is true.
   │
   │ /home/runner/work/self-naming-tests/self-naming-tests/tests/SelfNamingTestCase.php:41
   │
 ✘ Using callables with data set "assertSame(35, easter_date(2024)) (EasterDateTest.php:24)"
   │
   │ Failed asserting that 1711843200 is identical to 35.
   │
   │ /home/runner/work/self-naming-tests/self-naming-tests/tests/EasterDateTest.php:24
   │ /home/runner/work/self-naming-tests/self-naming-tests/tests/SelfNamingTestCase.php:39
   │
 ✔ Using callables with data set "assertSame(1_711_843_200, easter_date(2024)) (EasterDateTest.php:25)"
 ✔ Using callables with data set "3 > 1 (EasterDateTest.php:26)"
 ✘ Using callables with data set "3 < 1 (EasterDateTest.php:27)"
   │
   │ Failed asserting that false is true.
   │
   │ /home/runner/work/self-naming-tests/self-naming-tests/tests/SelfNamingTestCase.php:41
   │
 ✔ Using callables with data set "rand(0, 100) > 10 (EasterDateTest.php:28)"

FAILURES!
Tests: 8, Assertions: 8, Failures: 3.
Error: Process completed with exit code 1.
```