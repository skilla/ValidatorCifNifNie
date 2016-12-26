<?php
/**
 * Created by PhpStorm.
 * User: Sergio Zambrano Delfa <sergio.zambrano@gmail.com>
 * Date: 10/11/16
 * Time: 9:40
 */

namespace Skilla\ValidatorCifNifNie\Test;

use Skilla\ValidatorCifNifNie\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Validator
     */
    private $objectToTest;

    public function setUp()
    {
        $this->objectToTest = new Validator();
    }

    /**
     * @param string $documentId
     * @dataProvider goodFormatDNIProvider
     */
    public function testIsCorrectDNIFormat($documentId)
    {
        $this->assertTrue(
            $this->objectToTest->isDNIFormat($documentId),
            sprintf("%s is not in a proper DNI format", $documentId)
        );
    }

    public function goodFormatDNIProvider()
    {
        return array(
            array(
                '12345678A',
                '12345678'
            )
        );
    }

    /**
     * @param string $documentId
     * @dataProvider badFormatDNIProvider
     */
    public function testIsWrongDNIFormat($documentId)
    {
        $this->assertFalse(
            $this->objectToTest->isDNIFormat($documentId),
            sprintf("%s is in a proper DNI format", $documentId)
        );
    }

    public function badFormatDNIProvider()
    {
        return array(
            array(
                '123456789',
                'X0812345A',
                'X0812345',
                'X08123456',
                'K0812345A',
                'K0812345',
                'K08123456',
                'A08123456',
                'A0812345',
                'A0812345B',
                'N0812345A',
                'N0812345',
                'N08123456'
            )
        );
    }

    /**
     * @param string $documentId
     * @dataProvider goodFormatNIEProvider
     */
    public function testIsCorrectNIEFormat($documentId)
    {
        $this->assertTrue(
            $this->objectToTest->isNIEFormat($documentId),
            sprintf("%s is not in a proper NIE format", $documentId)
        );
    }

    public function goodFormatNIEProvider()
    {
        return array(
            array(
                'X0812345A',
                'X0812345'
            )
        );
    }

    /**
     * @param string $documentId
     * @dataProvider badFormatNIEProvider
     */
    public function testIsWrongNIEFormat($documentId)
    {
        $this->assertFalse(
            $this->objectToTest->isNIEFormat($documentId),
            sprintf("%s is in a proper NIE format", $documentId)
        );
    }

    public function badFormatNIEProvider()
    {
        return array(
            array(
                '12345678A',
                '12345678',
                '123456789',
                'X08123456',
                'K0812345A',
                'K0812345',
                'K08123456',
                'A08123456',
                'A0812345',
                'A0812345B',
                'N0812345A',
                'N0812345',
                'N08123456'
            )
        );
    }

    public function testIsNIFFormat()
    {

        $this->assertFalse($this->objectToTest->isNIFFormat('12345678A'));
        $this->assertFalse($this->objectToTest->isNIFFormat('12345678'));
        $this->assertFalse($this->objectToTest->isNIFFormat('123456789'));

        $this->assertFalse($this->objectToTest->isNIFFormat('X0812345A'));
        $this->assertFalse($this->objectToTest->isNIFFormat('X0812345'));
        $this->assertFalse($this->objectToTest->isNIFFormat('X08123456'));

        $this->assertTrue($this->objectToTest->isNIFFormat('K0812345A'));
        $this->assertTrue($this->objectToTest->isNIFFormat('K0812345'));
        $this->assertFalse($this->objectToTest->isNIFFormat('K08123456'));

        $this->assertFalse($this->objectToTest->isNIFFormat('A08123456'));
        $this->assertFalse($this->objectToTest->isNIFFormat('A0812345'));
        $this->assertFalse($this->objectToTest->isNIFFormat('A0812345B'));

        $this->assertFalse($this->objectToTest->isNIFFormat('N0812345A'));
        $this->assertFalse($this->objectToTest->isNIFFormat('N0812345'));
        $this->assertFalse($this->objectToTest->isNIFFormat('N08123456'));
    }

    public function testIsPersonalFormat()
    {

        $this->assertTrue($this->objectToTest->isPersonalFormat('12345678A'));
        $this->assertTrue($this->objectToTest->isPersonalFormat('12345678'));
        $this->assertFalse($this->objectToTest->isPersonalFormat('123456789'));

        $this->assertTrue($this->objectToTest->isPersonalFormat('X0812345A'));
        $this->assertTrue($this->objectToTest->isPersonalFormat('X0812345'));
        $this->assertFalse($this->objectToTest->isPersonalFormat('X08123456'));

        $this->assertTrue($this->objectToTest->isPersonalFormat('K0812345A'));
        $this->assertTrue($this->objectToTest->isPersonalFormat('K0812345'));
        $this->assertFalse($this->objectToTest->isPersonalFormat('K08123456'));

        $this->assertFalse($this->objectToTest->isPersonalFormat('A08123456'));
        $this->assertFalse($this->objectToTest->isPersonalFormat('A0812345'));
        $this->assertFalse($this->objectToTest->isPersonalFormat('A0812345B'));

        $this->assertFalse($this->objectToTest->isPersonalFormat('N0812345A'));
        $this->assertFalse($this->objectToTest->isPersonalFormat('N0812345'));
        $this->assertFalse($this->objectToTest->isPersonalFormat('N08123456'));
    }

    public function testIsCIFFormat()
    {

        $this->assertFalse($this->objectToTest->isCIFFormat('12345678A'));
        $this->assertFalse($this->objectToTest->isCIFFormat('12345678'));
        $this->assertFalse($this->objectToTest->isCIFFormat('123456789'));

        $this->assertFalse($this->objectToTest->isCIFFormat('X0812345A'));
        $this->assertFalse($this->objectToTest->isCIFFormat('X0812345'));
        $this->assertFalse($this->objectToTest->isCIFFormat('X08123456'));

        $this->assertFalse($this->objectToTest->isCIFFormat('K0812345A'));
        $this->assertFalse($this->objectToTest->isCIFFormat('K0812345'));
        $this->assertFalse($this->objectToTest->isCIFFormat('K08123456'));

        $this->assertTrue($this->objectToTest->isCIFFormat('A08123456'));
        $this->assertTrue($this->objectToTest->isCIFFormat('A0812345'));
        $this->assertFalse($this->objectToTest->isCIFFormat('A0812345B'));

        $this->assertTrue($this->objectToTest->isCIFFormat('N0812345A'));
        $this->assertTrue($this->objectToTest->isCIFFormat('N0812345'));
        $this->assertFalse($this->objectToTest->isCIFFormat('N08123456'));
    }

    public function testIsValidFormat()
    {

        $this->assertTrue($this->objectToTest->isValidFormat('12345678A'));
        $this->assertTrue($this->objectToTest->isValidFormat('12345678'));
        $this->assertFalse($this->objectToTest->isValidFormat('123456789'));

        $this->assertTrue($this->objectToTest->isValidFormat('X0812345A'));
        $this->assertTrue($this->objectToTest->isValidFormat('X0812345'));
        $this->assertFalse($this->objectToTest->isValidFormat('X08123456'));

        $this->assertTrue($this->objectToTest->isValidFormat('K0812345A'));
        $this->assertTrue($this->objectToTest->isValidFormat('K0812345'));
        $this->assertFalse($this->objectToTest->isValidFormat('K08123456'));

        $this->assertTrue($this->objectToTest->isValidFormat('A08123456'));
        $this->assertTrue($this->objectToTest->isValidFormat('A0812345'));
        $this->assertFalse($this->objectToTest->isValidFormat('A0812345B'));

        $this->assertTrue($this->objectToTest->isValidFormat('N0812345A'));
        $this->assertTrue($this->objectToTest->isValidFormat('N0812345'));
        $this->assertFalse($this->objectToTest->isValidFormat('N08123456'));
    }

    public function testIsValidDNI()
    {

        $this->assertTrue($this->objectToTest->isValidDNI('00000000T'));
        $this->assertFalse($this->objectToTest->isValidDNI('00000000'));
        $this->assertFalse($this->objectToTest->isValidDNI('00000000A'));
    }

    public function testIsValidNIE()
    {

        $this->assertTrue($this->objectToTest->isValidNIE('X0000000T'));
        $this->assertFalse($this->objectToTest->isValidNIE('X0000000'));
        $this->assertFalse($this->objectToTest->isValidNIE('X0000000A'));
    }

    public function testIsValidNIF()
    {

        $this->assertTrue($this->objectToTest->isValidNIF('K5881850A'));
        $this->assertFalse($this->objectToTest->isValidNIF('K5881850'));
        $this->assertFalse($this->objectToTest->isValidNIF('K5881850B'));
    }

    public function testIsValidCIF()
    {

        $this->assertTrue($this->objectToTest->isValidCIF('A01015379'));
        $this->assertFalse($this->objectToTest->isValidCIF('A0101537'));
        $this->assertFalse($this->objectToTest->isValidCIF('A01015370'));

        $this->assertTrue($this->objectToTest->isValidCIF('B01117084'));
        $this->assertFalse($this->objectToTest->isValidCIF('B0111708'));
        $this->assertFalse($this->objectToTest->isValidCIF('B01117080'));

        $this->assertTrue($this->objectToTest->isValidCIF('C28328508'));
        $this->assertFalse($this->objectToTest->isValidCIF('C2832850'));
        $this->assertFalse($this->objectToTest->isValidCIF('C28328500'));

        $this->assertTrue($this->objectToTest->isValidCIF('D90051129'));
        $this->assertFalse($this->objectToTest->isValidCIF('D9005112'));
        $this->assertFalse($this->objectToTest->isValidCIF('D90051120'));

        $this->assertTrue($this->objectToTest->isValidCIF('E02473809'));
        $this->assertFalse($this->objectToTest->isValidCIF('E0247380'));
        $this->assertFalse($this->objectToTest->isValidCIF('E02473800'));

        $this->assertTrue($this->objectToTest->isValidCIF('F25331422'));
        $this->assertFalse($this->objectToTest->isValidCIF('F2533142'));
        $this->assertFalse($this->objectToTest->isValidCIF('F25331420'));

        $this->assertTrue($this->objectToTest->isValidCIF('G08411068'));
        $this->assertFalse($this->objectToTest->isValidCIF('G0841106'));
        $this->assertFalse($this->objectToTest->isValidCIF('G08411060'));

        $this->assertTrue($this->objectToTest->isValidCIF('H43530633'));
        $this->assertFalse($this->objectToTest->isValidCIF('H4353063'));
        $this->assertFalse($this->objectToTest->isValidCIF('H43530630'));

        $this->assertTrue($this->objectToTest->isValidCIF('J04795183'));
        $this->assertFalse($this->objectToTest->isValidCIF('J0479518'));
        $this->assertFalse($this->objectToTest->isValidCIF('J04795180'));

        $this->assertTrue($this->objectToTest->isValidCIF('N0012622G'));
        $this->assertFalse($this->objectToTest->isValidCIF('N0012622'));
        $this->assertFalse($this->objectToTest->isValidCIF('N0012622A'));

        $this->assertTrue($this->objectToTest->isValidCIF('P0830600C'));
        $this->assertFalse($this->objectToTest->isValidCIF('P0830600'));
        $this->assertFalse($this->objectToTest->isValidCIF('P0830600A'));

        $this->assertTrue($this->objectToTest->isValidCIF('Q0801212B'));
        $this->assertFalse($this->objectToTest->isValidCIF('Q0801212'));
        $this->assertFalse($this->objectToTest->isValidCIF('Q0801212A'));

        $this->assertTrue($this->objectToTest->isValidCIF('U63240501'));
        $this->assertFalse($this->objectToTest->isValidCIF('U6324050'));
        $this->assertFalse($this->objectToTest->isValidCIF('U63240500'));

        $this->assertTrue($this->objectToTest->isValidCIF('V46055810'));
        $this->assertFalse($this->objectToTest->isValidCIF('V4605581'));
        $this->assertFalse($this->objectToTest->isValidCIF('V46055811'));

        $this->assertTrue($this->objectToTest->isValidCIF('W0049001A'));
        $this->assertFalse($this->objectToTest->isValidCIF('W0049001'));
        $this->assertFalse($this->objectToTest->isValidCIF('W0049001B'));
    }

    public function testValidate()
    {

        $this->assertTrue($this->objectToTest->validate('A01015379'));
        $this->assertFalse($this->objectToTest->validate('A0101537'));
        $this->assertFalse($this->objectToTest->validate('A01015370'));

        $this->assertTrue($this->objectToTest->validate('B01117084'));
        $this->assertFalse($this->objectToTest->validate('B0111708'));
        $this->assertFalse($this->objectToTest->validate('B01117080'));

        $this->assertTrue($this->objectToTest->validate('C28328508'));
        $this->assertFalse($this->objectToTest->validate('C2832850'));
        $this->assertFalse($this->objectToTest->validate('C28328500'));

        $this->assertTrue($this->objectToTest->validate('D90051129'));
        $this->assertFalse($this->objectToTest->validate('D9005112'));
        $this->assertFalse($this->objectToTest->validate('D90051120'));

        $this->assertTrue($this->objectToTest->validate('E02473809'));
        $this->assertFalse($this->objectToTest->validate('E0247380'));
        $this->assertFalse($this->objectToTest->validate('E02473800'));

        $this->assertTrue($this->objectToTest->validate('F25331422'));
        $this->assertFalse($this->objectToTest->validate('F2533142'));
        $this->assertFalse($this->objectToTest->validate('F25331420'));

        $this->assertTrue($this->objectToTest->validate('G08411068'));
        $this->assertFalse($this->objectToTest->validate('G0841106'));
        $this->assertFalse($this->objectToTest->validate('G08411060'));

        $this->assertTrue($this->objectToTest->validate('H43530633'));
        $this->assertFalse($this->objectToTest->validate('H4353063'));
        $this->assertFalse($this->objectToTest->validate('H43530630'));

        $this->assertTrue($this->objectToTest->validate('J04795183'));
        $this->assertFalse($this->objectToTest->validate('J0479518'));
        $this->assertFalse($this->objectToTest->validate('J04795180'));

        $this->assertTrue($this->objectToTest->validate('N0012622G'));
        $this->assertFalse($this->objectToTest->validate('N0012622'));
        $this->assertFalse($this->objectToTest->validate('N0012622A'));

        $this->assertTrue($this->objectToTest->validate('P0830600C'));
        $this->assertFalse($this->objectToTest->validate('P0830600'));
        $this->assertFalse($this->objectToTest->validate('P0830600A'));

        $this->assertTrue($this->objectToTest->validate('Q0801212B'));
        $this->assertFalse($this->objectToTest->validate('Q0801212'));
        $this->assertFalse($this->objectToTest->validate('Q0801212A'));

        $this->assertTrue($this->objectToTest->validate('U63240501'));
        $this->assertFalse($this->objectToTest->validate('U6324050'));
        $this->assertFalse($this->objectToTest->validate('U63240500'));

        $this->assertTrue($this->objectToTest->validate('V46055810'));
        $this->assertFalse($this->objectToTest->validate('V4605581'));
        $this->assertFalse($this->objectToTest->validate('V46055811'));

        $this->assertTrue($this->objectToTest->validate('W0049001A'));
        $this->assertFalse($this->objectToTest->validate('W0049001'));
        $this->assertFalse($this->objectToTest->validate('W0049001B'));

        $this->assertTrue($this->objectToTest->validate('X9994480Z'));
        $this->assertFalse($this->objectToTest->validate('X9994480'));
        $this->assertFalse($this->objectToTest->validate('X9994480A'));

        $this->assertTrue($this->objectToTest->validate('Y4674358J'));
        $this->assertFalse($this->objectToTest->validate('Y4674358'));
        $this->assertFalse($this->objectToTest->validate('Y4674358A'));

        $this->assertTrue($this->objectToTest->validate('Z2842169H'));
        $this->assertFalse($this->objectToTest->validate('Z2842169'));
        $this->assertFalse($this->objectToTest->validate('Z2842169A'));
    }
}
