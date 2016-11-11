<?php
/**
 * Created by PhpStorm.
 * User: Sergio Zambrano Delfa <sergio.zambrano@gmail.com>
 * Date: 10/11/16
 * Time: 9:40
 */

namespace Skilla\ValidatorCifNifNie\Test;

use Skilla\ValidatorCifNifNie\Generator;
use Skilla\ValidatorCifNifNie\Kk;
use Skilla\ValidatorCifNifNie\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testIsDNIFormat()
    {
        $validator = new Validator();
        $this->assertTrue($validator->isDNIFormat('12345678A'));
        $this->assertTrue($validator->isDNIFormat('12345678'));
        $this->assertFalse($validator->isDNIFormat('123456789'));

        $this->assertFalse($validator->isDNIFormat('X0812345A'));
        $this->assertFalse($validator->isDNIFormat('X0812345'));
        $this->assertFalse($validator->isDNIFormat('X08123456'));

        $this->assertFalse($validator->isDNIFormat('K0812345A'));
        $this->assertFalse($validator->isDNIFormat('K0812345'));
        $this->assertFalse($validator->isDNIFormat('K08123456'));

        $this->assertFalse($validator->isDNIFormat('A08123456'));
        $this->assertFalse($validator->isDNIFormat('A0812345'));
        $this->assertFalse($validator->isDNIFormat('A0812345B'));

        $this->assertFalse($validator->isDNIFormat('N0812345A'));
        $this->assertFalse($validator->isDNIFormat('N0812345'));
        $this->assertFalse($validator->isDNIFormat('N08123456'));
    }

    public function testIsNIEFormat()
    {
        $validator = new Validator();
        $this->assertFalse($validator->isNIEFormat('12345678A'));
        $this->assertFalse($validator->isNIEFormat('12345678'));
        $this->assertFalse($validator->isNIEFormat('123456789'));

        $this->assertTrue($validator->isNIEFormat('X0812345A'));
        $this->assertTrue($validator->isNIEFormat('X0812345'));
        $this->assertFalse($validator->isNIEFormat('X08123456'));

        $this->assertFalse($validator->isNIEFormat('K0812345A'));
        $this->assertFalse($validator->isNIEFormat('K0812345'));
        $this->assertFalse($validator->isNIEFormat('K08123456'));

        $this->assertFalse($validator->isNIEFormat('A08123456'));
        $this->assertFalse($validator->isNIEFormat('A0812345'));
        $this->assertFalse($validator->isNIEFormat('A0812345B'));

        $this->assertFalse($validator->isNIEFormat('N0812345A'));
        $this->assertFalse($validator->isNIEFormat('N0812345'));
        $this->assertFalse($validator->isNIEFormat('N08123456'));
    }

    public function testIsPersonalFormat()
    {
        $validator = new Validator();
        $this->assertTrue($validator->isPersonalFormat('12345678A'));
        $this->assertTrue($validator->isPersonalFormat('12345678'));
        $this->assertFalse($validator->isPersonalFormat('123456789'));

        $this->assertTrue($validator->isPersonalFormat('X0812345A'));
        $this->assertTrue($validator->isPersonalFormat('X0812345'));
        $this->assertFalse($validator->isPersonalFormat('X08123456'));

        $this->assertFalse($validator->isPersonalFormat('K0812345A'));
        $this->assertFalse($validator->isPersonalFormat('K0812345'));
        $this->assertFalse($validator->isPersonalFormat('K08123456'));

        $this->assertFalse($validator->isPersonalFormat('A08123456'));
        $this->assertFalse($validator->isPersonalFormat('A0812345'));
        $this->assertFalse($validator->isPersonalFormat('A0812345B'));

        $this->assertFalse($validator->isPersonalFormat('N0812345A'));
        $this->assertFalse($validator->isPersonalFormat('N0812345'));
        $this->assertFalse($validator->isPersonalFormat('N08123456'));
    }

    public function testIsNIFFormat()
    {
        $validator = new Validator();
        $this->assertFalse($validator->isNIFFormat('12345678A'));
        $this->assertFalse($validator->isNIFFormat('12345678'));
        $this->assertFalse($validator->isNIFFormat('123456789'));

        $this->assertFalse($validator->isNIFFormat('X0812345A'));
        $this->assertFalse($validator->isNIFFormat('X0812345'));
        $this->assertFalse($validator->isNIFFormat('X08123456'));

        $this->assertTrue($validator->isNIFFormat('K0812345A'));
        $this->assertTrue($validator->isNIFFormat('K0812345'));
        $this->assertFalse($validator->isNIFFormat('K08123456'));

        $this->assertFalse($validator->isNIFFormat('A08123456'));
        $this->assertFalse($validator->isNIFFormat('A0812345'));
        $this->assertFalse($validator->isNIFFormat('A0812345B'));

        $this->assertFalse($validator->isNIFFormat('N0812345A'));
        $this->assertFalse($validator->isNIFFormat('N0812345'));
        $this->assertFalse($validator->isNIFFormat('N08123456'));
    }

    public function testIsCIFFormat()
    {
        $validator = new Validator();
        $this->assertFalse($validator->isCIFFormat('12345678A'));
        $this->assertFalse($validator->isCIFFormat('12345678'));
        $this->assertFalse($validator->isCIFFormat('123456789'));

        $this->assertFalse($validator->isCIFFormat('X0812345A'));
        $this->assertFalse($validator->isCIFFormat('X0812345'));
        $this->assertFalse($validator->isCIFFormat('X08123456'));

        $this->assertFalse($validator->isCIFFormat('K0812345A'));
        $this->assertFalse($validator->isCIFFormat('K0812345'));
        $this->assertFalse($validator->isCIFFormat('K08123456'));

        $this->assertTrue($validator->isCIFFormat('A08123456'));
        $this->assertTrue($validator->isCIFFormat('A0812345'));
        $this->assertFalse($validator->isCIFFormat('A0812345B'));

        $this->assertTrue($validator->isCIFFormat('N0812345A'));
        $this->assertTrue($validator->isCIFFormat('N0812345'));
        $this->assertFalse($validator->isCIFFormat('N08123456'));
    }

    public function testIsJuristicFormat()
    {
        $validator = new Validator();
        $this->assertFalse($validator->isJuristicFormat('12345678A'));
        $this->assertFalse($validator->isJuristicFormat('12345678'));
        $this->assertFalse($validator->isJuristicFormat('123456789'));

        $this->assertFalse($validator->isJuristicFormat('X0812345A'));
        $this->assertFalse($validator->isJuristicFormat('X0812345'));
        $this->assertFalse($validator->isJuristicFormat('X08123456'));

        $this->assertTrue($validator->isJuristicFormat('K0812345A'));
        $this->assertTrue($validator->isJuristicFormat('K0812345'));
        $this->assertFalse($validator->isJuristicFormat('K08123456'));

        $this->assertTrue($validator->isJuristicFormat('A08123456'));
        $this->assertTrue($validator->isJuristicFormat('A0812345'));
        $this->assertFalse($validator->isJuristicFormat('A0812345B'));

        $this->assertTrue($validator->isJuristicFormat('N0812345A'));
        $this->assertTrue($validator->isJuristicFormat('N0812345'));
        $this->assertFalse($validator->isJuristicFormat('N08123456'));
    }

    public function testIsValidFormat()
    {
        $validator = new Validator();
        $this->assertTrue($validator->isValidFormat('12345678A'));
        $this->assertTrue($validator->isValidFormat('12345678'));
        $this->assertFalse($validator->isValidFormat('123456789'));

        $this->assertTrue($validator->isValidFormat('X0812345A'));
        $this->assertTrue($validator->isValidFormat('X0812345'));
        $this->assertFalse($validator->isValidFormat('X08123456'));

        $this->assertTrue($validator->isValidFormat('K0812345A'));
        $this->assertTrue($validator->isValidFormat('K0812345'));
        $this->assertFalse($validator->isValidFormat('K08123456'));

        $this->assertTrue($validator->isValidFormat('A08123456'));
        $this->assertTrue($validator->isValidFormat('A0812345'));
        $this->assertFalse($validator->isValidFormat('A0812345B'));

        $this->assertTrue($validator->isValidFormat('N0812345A'));
        $this->assertTrue($validator->isValidFormat('N0812345'));
        $this->assertFalse($validator->isValidFormat('N08123456'));
    }

    public function testIsValidDNI()
    {
        $validator = new Validator();
        $this->assertTrue($validator->isValidDNI('00000000T'));
        $this->assertFalse($validator->isValidDNI('00000000'));
        $this->assertFalse($validator->isValidDNI('00000000A'));
    }

    public function testIsValidNIE()
    {
        $validator = new Validator();
        $this->assertTrue($validator->isValidNIE('X0000000T'));
        $this->assertFalse($validator->isValidNIE('X0000000'));
        $this->assertFalse($validator->isValidNIE('X0000000A'));
    }

    public function testIsValidNIF()
    {
        $validator = new Validator();
        $this->assertTrue($validator->isValidNIF('K5881850A'));
        $this->assertFalse($validator->isValidNIF('K5881850'));
        $this->assertFalse($validator->isValidNIF('K5881850B'));
    }

    public function testIsValidCIF()
    {
        $validator = new Validator();
        $this->assertTrue($validator->isValidCIF('A01015379'));
        $this->assertFalse($validator->isValidCIF('A0101537'));
        $this->assertFalse($validator->isValidCIF('A01015370'));

        $this->assertTrue($validator->isValidCIF('B01117084'));
        $this->assertFalse($validator->isValidCIF('B0111708'));
        $this->assertFalse($validator->isValidCIF('B01117080'));

        $this->assertTrue($validator->isValidCIF('C28328508'));
        $this->assertFalse($validator->isValidCIF('C2832850'));
        $this->assertFalse($validator->isValidCIF('C28328500'));

        $this->assertTrue($validator->isValidCIF('D90051129'));
        $this->assertFalse($validator->isValidCIF('D9005112'));
        $this->assertFalse($validator->isValidCIF('D90051120'));

        $this->assertTrue($validator->isValidCIF('E02473809'));
        $this->assertFalse($validator->isValidCIF('E0247380'));
        $this->assertFalse($validator->isValidCIF('E02473800'));

        $this->assertTrue($validator->isValidCIF('F25331422'));
        $this->assertFalse($validator->isValidCIF('F2533142'));
        $this->assertFalse($validator->isValidCIF('F25331420'));

        $this->assertTrue($validator->isValidCIF('G08411068'));
        $this->assertFalse($validator->isValidCIF('G0841106'));
        $this->assertFalse($validator->isValidCIF('G08411060'));

        $this->assertTrue($validator->isValidCIF('H43530633'));
        $this->assertFalse($validator->isValidCIF('H4353063'));
        $this->assertFalse($validator->isValidCIF('H43530630'));

        $this->assertTrue($validator->isValidCIF('J04795183'));
        $this->assertFalse($validator->isValidCIF('J0479518'));
        $this->assertFalse($validator->isValidCIF('J04795180'));

        $this->assertTrue($validator->isValidCIF('N0012622G'));
        $this->assertFalse($validator->isValidCIF('N0012622'));
        $this->assertFalse($validator->isValidCIF('N0012622A'));

        $this->assertTrue($validator->isValidCIF('P0830600C'));
        $this->assertFalse($validator->isValidCIF('P0830600'));
        $this->assertFalse($validator->isValidCIF('P0830600A'));
    }

    public function testValidate()
    {
        $validator = new Validator();
        $this->assertTrue($validator->validate('43504758M'));
        $this->assertFalse($validator->validate('43504758A'));
    }
}
