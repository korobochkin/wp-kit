<?php
namespace Korobochkin\WPKit\Tests\DataTransformers;

use Korobochkin\WPKit\DataTransformers\BooleanToStringTransformer;
use Symfony\Component\Form\Exception\TransformationFailedException;

class BooleanToStringTransformerTest extends \WP_UnitTestCase
{
    public function testConstruct()
    {
        $stub = new BooleanToStringTransformer('1', '0');
        $this->assertAttributeSame('1', 'trueValue', $stub);
        $this->assertAttributeSame('0', 'falseValue', $stub);
    }

    /**
     * @dataProvider casesTransform
     * @param $value mixed Input value to transform.
     * @param $expected mixed Expected result of transform.
     */
    public function testTransform($value, $expected)
    {
        $stub = new BooleanToStringTransformer('1', '0');

        if (is_a($expected, \Exception::class)) {
            /**
             * @var $expected \Exception
             */
            $this->setExpectedException(get_class($expected), $expected->getMessage());
            $stub->transform($value);
        }

        $this->assertSame($expected, $stub->transform($value));
    }

    public function casesTransform()
    {
        return array(
            array(null, null),
            array(true, '1'),
            array(false, '0'),
            array('string-value', new TransformationFailedException('Expected a Boolean.')),
        );
    }

    /**
     * @dataProvider casesReverseTransform
     * @param $value mixed Input value to transform.
     * @param $expected mixed Expected result of transform.
     */
    public function testReverseTransform($value, $expected)
    {
        $stub = new BooleanToStringTransformer('1', '0');

        if (is_a($expected, \Exception::class)) {
            /**
             * @var $expected \Exception
             */
            $this->setExpectedException(get_class($expected), $expected->getMessage());
            $stub->reverseTransform($value);
        }

        $this->assertSame($expected, $stub->reverseTransform($value));
    }

    public function casesReverseTransform()
    {
        return array(
            array(null, true),
            array('1', true),
            array('0', false),
            array('string-value', true),
            array(true, new TransformationFailedException('Expected a string.')),
            array(array(), new TransformationFailedException('Expected a string.')),
            array(new \stdClass(), new TransformationFailedException('Expected a string.')),
        );
    }
}
