<?php
namespace Korobochkin\WPKit\Tests\DataComponents\Traits;

use Korobochkin\WPKit\DataComponents\Traits\DataTransformerTrait;
use Symfony\Component\Form\Extension\Core\DataTransformer\BooleanToStringTransformer;
use Symfony\Component\Form\ReversedTransformer;

class DataTransformerTraitTest extends \WP_UnitTestCase {

	/**
	 * @var DataTransformerTrait
	 */
	protected $stub;

	/**
	 * Prepare trait for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = $this->getMockForTrait(DataTransformerTrait::class);
	}

	/**
	 * Test Getter and Setter.
	 *
	 * @dataProvider casesForGetterAndSetter
	 *
	 * @param $value
	 */
	public function testGetterAndSetter($value) {
		$this->assertEquals($this->stub, $this->stub->setDataTransformer($value));
		$this->assertEquals($value, $this->stub->getDataTransformer());
	}

	public function casesForGetterAndSetter() {
		return array(
			array(new BooleanToStringTransformer('1')),
			array(new ReversedTransformer(new BooleanToStringTransformer('1'))),
		);
	}
}
