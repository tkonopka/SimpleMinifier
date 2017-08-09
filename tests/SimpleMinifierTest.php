<?php

use PHPUnit\Framework\TestCase;

require_once "src/SimpleMinifier.php";

/**
 * Tests for SimpleMinifier.
 * Each test reads two files from disk: an input and an expected output
 * 
 * @covers SimpleMinifier
 */
final class SimpleMinifierTest extends TestCase {

    public $_SM;

    protected function setUp() {
        parent::setUp();
        $this->_SM = new tkonopka\SimpleMinifier\SimpleMinifier();
    }

    public function genericTest($dir, $prefix) {
        $input = file_get_contents("tests/$dir/$prefix.$dir");
        $expected = file_get_contents("tests/$dir/$prefix.min.$dir");
        $output = $this->_SM->minify($input);
        $this->assertEquals(substr($expected, 0, -1), $output);
    }

    public function testJsSimple() {
        $this->genericTest("js", "simple");
    }

    public function testJsCommentBlock() {
        $this->genericTest("js", "block");
    }

    public function testJsComment() {
        $this->genericTest("js", "comment");
    }

    public function testJsSpacesInString() {
        $this->genericTest("js", "spacesInString");
    }
    
    public function testJsPreserveImportantComment() {
        $this->genericTest("js", "preserveImportantComment");
    }
    
    public function testJsMath() {
        $this->genericTest("js", "math");
    }
    
    public function testCssMultiline() {
        $this->genericTest("css", "multiline");
    }
    
    public function testCssBlockComment() {
        $this->genericTest("css", "blockComment");
    }
    
}
