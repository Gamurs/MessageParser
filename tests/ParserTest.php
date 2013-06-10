<?php

class ParserTest extends TestCase {
	public function testParser()
	{
		$parser = new Gamurs\MessageParser\Parser;
		$string = 'fuck this';
		$expected = 'f**k this';
		$actual = $parser->filterBadWords($string);
		$this->assertEquals($expected, $actual);
	}
}