<?php
namespace Aws\Test\Crypto\Polyfill;

use Aws\Crypto\Polyfill\Key;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;

/**
 * Class KeyTest
 * @covers Aws\Test\Crypto\Polyfill
 */
class KeyTest extends TestCase
{
    public function testConstructor()
    {
        $this->assertInstanceOf(Key::class, new Key('test'));
    }

    public function testDebugInfo()
    {
        if (PHP_VERSION_ID < 50600) {
            $this->markTestSkipped('This feature did not exist until PHP 5.6.0');
            return;
        }
        $test = 'some unique test string';
        $key = new Key($test);
        ob_start();
        var_dump($key);
        $output = ob_get_clean();
        $this->assertStringNotContainsString($test, $output, 'debugInfo() did not suppress output');
    }

    public function testReturnTypeValue()
    {
        $test = 'some unique test string';
        $key = new Key($test);

        $this->assertIsString($key->get());
        $this->assertSame($test, $key->get());
    }
}
