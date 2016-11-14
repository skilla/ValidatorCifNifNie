<?php
/**
 * Created by PhpStorm.
 * User: Sergio Zambrano Delfa <sergio.zambrano@gmail.com>
 * Date: 10/11/16
 * Time: 9:40
 */

namespace Skilla\ValidatorCifNifNie\Test;

use Skilla\ValidatorCifNifNie\Generator;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Skilla\ValidatorCifNifNie\InvalidParameterException
     */
    public function testInvalidFormatException()
    {
        $generator = new Generator();
        $this->assertEquals('A', $generator->getCodeFor('1A3B5C7D8'));
    }

    /**
     * @expectedException \Skilla\ValidatorCifNifNie\InvalidParameterException
     */
    public function testValidateDNIException()
    {
        $generator = new Generator();
        $this->assertEquals('A', $generator->getCodeFor('12345678A'));
    }

    /**
     * @expectedException \Skilla\ValidatorCifNifNie\InvalidParameterException
     */
    public function testValidateNIEException()
    {
        $generator = new Generator();
        $this->assertEquals('A', $generator->getCodeFor('X0812345A'));
    }

    /**
     * @expectedException \Skilla\ValidatorCifNifNie\InvalidParameterException
     */
    public function testValidateNIFException()
    {
        $generator = new Generator();
        $this->assertEquals('A', $generator->getCodeFor('K0812345A'));
    }

    /**
     * @expectedException \Skilla\ValidatorCifNifNie\InvalidParameterException
     */
    public function testValidateCIFException()
    {
        $generator = new Generator();
        $this->assertEquals('6', $generator->getCodeFor('A08123456'));
    }

    public function testValidate()
    {
        $generator = new Generator();

        $this->assertEquals('Z', $generator->getCodeFor('12345678'));
        $this->assertEquals('Z', $generator->getCodeFor('X9994480'));
        $this->assertEquals('G', $generator->getCodeFor('K0812345'));
        $this->assertEquals('9', $generator->getCodeFor('A0101537'));
        $this->assertEquals('G', $generator->getCodeFor('N0812345'));
    }
}
