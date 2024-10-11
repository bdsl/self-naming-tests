<?php
namespace BDSL\SelfNamingTestExample\Test;

trait SelfNamingTestCase
{

    public static function callablesProvider()
    {
        $testCases = [];
        foreach (self::checks() as $callable) {
            $reflectionFunction = new \ReflectionFunction($callable);
            $startLine = $reflectionFunction->getStartLine();
            $endLine = $reflectionFunction->getEndLine();
            $filename = $reflectionFunction->getFileName();
            $basename = basename($filename);

            if ($startLine !== $endLine) {

                throw new \Exception(
                    "$filename:$startLine-$endLine Multi-line closures are not supported - please use a traditional test"
                );
            }

            $file = new \SplFileObject($filename);
            $file->seek($startLine-1);
            $line = trim($file->current(), " \n\r\t\v\0,");
            $lineWithoutFunctionPrefix = preg_replace('/^fn\(\) =>\h+/s', '', $line);

            $testCases["$lineWithoutFunctionPrefix ($basename:$startLine)"] = [$callable];

        }

        return $testCases;
    }

    /** @dataProvider callablesProvider */
    public function testUsingCallables(\Closure $callable): void
    {
        $result = $callable();
        if ($result !== null) {
            $this->assertTrue($result);
        }
    }

    /**
     * Returns a list of one-line closures, each of which is a test.
     * The test passes if the closure returns null or true. It fails if it returns anything else or throws a
     * \PHPUnit\Framework\AssertionFailedError .
     *
     * @return list<Closure():null|bool> *
     */
    public abstract static function checks(): array;
}