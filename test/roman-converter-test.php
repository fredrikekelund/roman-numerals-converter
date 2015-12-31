<?php
require 'roman-converter.php';

class RomanConverterTest extends PHPUnit_Framework_TestCase
{
	public function testToInteger()
	{
		$romanConverter = new RomanConverter();

		$this->assertEquals(1, $romanConverter->toInteger('I'));
		$this->assertEquals(2, $romanConverter->toInteger('II'));
		$this->assertEquals(4, $romanConverter->toInteger('IV'));
		$this->assertEquals(472, $romanConverter->toInteger('CDLXXII'));
		$this->assertEquals(1516, $romanConverter->toInteger('MDXVI'));
		$this->assertEquals(2999, $romanConverter->toInteger('MMCMXCIX'));
	}

	/**
	 * @expectedException Exception
	 */
	public function testException()
	{
		$romanConverter = new RomanConverter();
		$romanConverter->toInteger('CAB');
	}
}
