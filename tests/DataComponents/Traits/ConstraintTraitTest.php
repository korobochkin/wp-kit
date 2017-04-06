<?php
namespace Korobochkin\WPKit\Tests\DataComponents\Traits;

use Korobochkin\WPKit\DataComponents\Traits\ConstraintTrait;
use Symfony\Component\Validator\Constraints;

class ConstraintTraitTest extends \WP_UnitTestCase {

	/**
	 * @var ConstraintTrait
	 */
	protected $stub;

	/**
	 * Prepare trait for tests.
	 */
	public function setUp() {
		parent::setUp();
		$this->stub = $this->getMockForTrait(ConstraintTrait::class);
	}

	/**
	 * Test Getter and Setter.
	 *
	 * @dataProvider casesForGetterAndSetter
	 *
	 * @param $value \Symfony\Component\Validator\Constraint[]|\Symfony\Component\Validator\Constraint
	 */
	public function testGetterAndSetter($value) {
		$this->assertEquals($this->stub, $this->stub->setConstraint($value));
		$this->assertEquals($value, $this->stub->getConstraint());
	}

	public function casesForGetterAndSetter() {
		return array(
			array(new Constraints\Blank()),
			array(new Constraints\NotNull()),
			array(array(
				new Constraints\Blank(),
				new Constraints\NotNull(),
			)),
		);
	}
}
