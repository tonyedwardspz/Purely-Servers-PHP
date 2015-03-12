<?php

require_once dirname(__FILE__) . '/../includes/functions.php';

class functionsTest extends \PHPUnit_Framework_TestCase
{
	public function testATest(){
		// Are tests working?
		$this->assertTrue(true);
	}

	// Check that a uni email will come back true
	public function testUniEmail(){
		$emailString = "tony@students.plymouth.ac.uk";
		$result = checkUniEmail($emailString);
		$this -> assertTrue($result);
	}

	// check non uni email will come back false
	public function testNonUniEmail(){
		$emailString = "tony@gmail.com";
		$result = checkUniEmail($emailString);
		$this -> assertFalse($result);
	}

	// 2 tests to check the odd/even table row color
	public function testEvenRowColor(){
		$result = getTableRowColor(2);
		$expectedResult = "even";
		$this->assertEquals($expectedResult, $result);
	}

	public function testOddRowColor(){
		$result = getTableRowColor(1);
		$expectedResult = "odd";
		$this->assertEquals($expectedResult, $result);
	}

	// test the int stripping function
	public function testPrepareInt(){
		$intString = " p0)d";
		$expectedResult = 0;
		$result = prepareInt($intString);
		$this->assertEquals($expectedResult, $result);
	}

	// test the string filtering function
	public function testPrepareString(){
		$string = "<b>naughty; hackers<b>";
		// $string = "naughty hackers";
		$expectedResult = "naughty hackers";
		$result = prepareString($string);
		$this->assertEquals($expectedResult, $result);
	}
}

?>