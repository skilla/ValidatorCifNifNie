<?php
/**
 * Created by PhpStorm.
 * User: Sergio Zambrano Delfa <sergio.zambrano@gmail.com>
 * Date: 10/11/16
 * Time: 13:42
 */

namespace Skilla\ValidatorCifNifNie\Test;

use PHPUnit\Framework\TestCase;
use Skilla\ValidatorCifNifNie\Constant;


class ConstantTest extends TestCase
{
    public function testRetrievePattern()
    {
        self::assertNotEmpty(Constant::retrievePattern(Constant::DNI));
    }

    /**
     * @expectedException \Skilla\ValidatorCifNifNie\InvalidParameterException
     */
    public function testRetrievePatternException()
    {
        self::assertNotEmpty(Constant::retrievePattern('NOTVALID'));
    }

    public function testRetrieveProvince()
    {
        self::assertNotEmpty(Constant::retrieveProvince('08'));
    }

    /**
     * @expectedException \Skilla\ValidatorCifNifNie\InvalidParameterException
     */
    public function testretrieveProvinceException()
    {
        self::assertNotEmpty(Constant::retrieveProvince('00'));
    }
}
