<?php
/**
 * Created by PhpStorm.
 * User: Sergio Zambrano Delfa <sergio.zambrano@gmail.com>
 * Date: 10/11/16
 * Time: 9:40
 */

namespace Skilla\ValidatorCifNifNie\Test;

use Skilla\ValidatorCifNifNie\Generator;
use Skilla\ValidatorCifNifNie\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    /**
     * @var Validator
     */
    private $objectToTest;

    public function setUp()
    {
        $this->objectToTest = new Validator(
            new Generator()
        );
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
            ),
            array(
                '14167864W',
                '14167864'
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

    /**
     * @param string $documentId
     * @dataProvider goodFormatNIFProvider
     */
    public function testIsCorrectNIFFormat($documentId)
    {
        $this->assertTrue(
            $this->objectToTest->isNIFFormat($documentId),
            sprintf("%s is not in a proper NIF format", $documentId)
        );
    }

    public function goodFormatNIFProvider()
    {
        return array(
            array(
                'K0812345A',
                'K0812345'
            )
        );
    }

    /**
     * @param string $documentId
     * @dataProvider badFormatNIFProvider
     */
    public function testIsWrongNIFFormat($documentId)
    {
        $this->assertFalse(
            $this->objectToTest->isNIFFormat($documentId),
            sprintf("%s is in a proper NIF format", $documentId)
        );
    }

    public function badFormatNIFProvider()
    {
        return array(
            array(
                '12345678A',
                '12345678',
                '123456789',
                'X0812345A',
                'X0812345',
                'X08123456',
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
     * @dataProvider goodFormatPersonalProvider
     */
    public function testIsCorrectPersonalFormat($documentId)
    {
        $this->assertTrue(
            $this->objectToTest->isPersonalFormat($documentId),
            sprintf("%s is not in a proper personal format", $documentId)
        );
    }

    public function goodFormatPersonalProvider()
    {
        return array(
            array(
                '12345678A',
                '12345678',
                'X0812345A',
                'X0812345',
                'K0812345A',
                'K0812345'
            )
        );
    }

    /**
     * @param string $documentId
     * @dataProvider badFormatPersonalProvider
     */
    public function testIsWrongPersonalFormat($documentId)
    {
        $this->assertFalse(
            $this->objectToTest->isPersonalFormat($documentId),
            sprintf("%s is in a proper personal format", $documentId)
        );
    }

    public function badFormatPersonalProvider()
    {
        return array(
            array(
                '123456789',
                'X08123456',
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
     * @dataProvider goodFormatCIFProvider
     */
    public function testIsCorrectCIFFormat($documentId)
    {
        $this->assertTrue(
            $this->objectToTest->isCIFFormat($documentId),
            sprintf("%s is not in a proper CIF format", $documentId)
        );
    }

    public function goodFormatCIFProvider()
    {
        return array(
            array(
                'A08123456',
                'A0812345',
                'N0812345A',
                'N0812345'
            )
        );
    }

    /**
     * @param string $documentId
     * @dataProvider badFormatCIFProvider
     */
    public function testIsWrongCIFFormat($documentId)
    {
        $this->assertFalse(
            $this->objectToTest->isCIFFormat($documentId),
            sprintf("%s is in a proper CIF format", $documentId)
        );
    }

    public function badFormatCIFProvider()
    {
        return array(
            array(
                '12345678A',
                '12345678',
                '123456789',
                'X0812345A',
                'X0812345',
                'X08123456',
                'K0812345A',
                'K0812345',
                'K08123456',
                'N08123456',
                'A0812345B'
            )
        );
    }

    /**
     * @param string $documentId
     * @dataProvider validFormatProvider
     */
    public function testIsValidFormat($documentId)
    {
        $this->assertTrue(
            $this->objectToTest->isValidFormat($documentId),
            sprintf("%s is a not valid format", $documentId)
        );
    }

    public function validFormatProvider()
    {
        return array(
            array(
                '12345678A',
                '12345678',
                'X0812345',
                'X0812345A',
                'K0812345',
                'K0812345A',
                'A08123456',
                'A0812345',
                'N0812345A',
                'N0812345',
            )
        );
    }

    /**
     * @param string $documentId
     * @dataProvider notValidFormatProvider
     */
    public function testIsNotValidFormat($documentId)
    {
        $this->assertFalse(
            $this->objectToTest->isValidFormat($documentId),
            sprintf("%s is a valid format", $documentId)
        );
    }

    public function notValidFormatProvider()
    {
        return array(
            array(
                '123456789',
                'X08123456',
                'K08123456',
                'A0812345B',
                'N08123456'
            )
        );
    }

    /**
     * @param string $documentId
     * @dataProvider validCifProvider
     */
    public function testIsValidCIF($documentId)
    {
        $this->assertTrue(
            $this->objectToTest->isValidCIF($documentId),
            sprintf("%s is a not valid CIF", $documentId)
        );
    }

    public function validCIFProvider()
    {
        return array(
            array(
                'A01015379',
                'B01117084',
                'C28328508',
                'D90051129',
                'E02473809',
                'F25331422',
                'G08411068',
                'J04795183',
                'H43530633',
                'N0012622G',
                'P0830600C',
                'Q0801212B',
                'U63240501',
                'V46055810',
                'W0049001A'
            )
        );
    }

    /**
     * @param string $documentId
     * @dataProvider notValidCIFProvider
     */
    public function testIsNotValidCIF($documentId)
    {
        $this->assertFalse(
            $this->objectToTest->isValidCIF($documentId),
            sprintf("%s is a valid CIF", $documentId)
        );
    }

    public function notValidCIFProvider()
    {
        return array(
            array(
                'A0101537',
                'A01015370',
                'B0111708',
                'B01117080',
                'C2832850',
                'C28328500',
                'D9005112',
                'D90051120',
                'E0247380',
                'E02473800',
                'F2533142',
                'F25331420',
                'G0841106',
                'G08411060',
                'H4353063',
                'H43530630',
                'J0479518',
                'J04795180',
                'N0012622',
                'N0012622A',
                'P0830600',
                'P0830600A',
                'Q0801212',
                'Q0801212A',
                'U6324050',
                'U63240500',
                'V4605581',
                'V46055811',
                'W0049001',
                'W0049001B'
            )
        );
    }

    /**
     * @string $documentId
     * @dataProvider validDocumentIdsProvider
     */
    public function testValidDocumentIds($documentId)
    {
        $this->assertTrue(
            $this->objectToTest->validate($documentId),
            sprintf("%s is a not valid document id", $documentId)
        );
    }

    public function validDocumentIdsProvider()
    {
        return array(
            array(
                'A01015379',
                'B01117084',
                'C28328508',
                'D90051129',
                'E02473809',
                'F25331422',
                'G08411068',
                'H43530633',
                'J04795183',
                'N0012622G',
                'P0830600C',
                'Q0801212B',
                'U63240501',
                'V46055810',
                'W0049001A',
                'X9994480Z',
                'Y4674358J',
                'Z2842169H',
                '14167864W'
            )
        );
    }

    /**
     * @string $documentId
     * @dataProvider notValidDocumentIdsProvider
     */
    public function testNotValidDocumentIds($documentId)
    {
        $this->assertFalse(
            $this->objectToTest->validate($documentId),
            sprintf("%s is a valid document id", $documentId)
        );
    }

    public function notValidDocumentIdsProvider()
    {
        return array(
            array(
                'J0479518',
                'F2533142',
                'F25331420',
                'A0101537',
                'A01015370',
                'H4353063',
                'G08411060',
                'E0247380',
                'D9005112',
                'D90051120',
                'C2832850',
                'B0111708',
                'B01117080',
                'C28328500',
                'E02473800',
                'G0841106',
                'H43530630',
                'J04795180',
                'N0012622',
                'N0012622A',
                'P0830600',
                'P0830600A',
                'Q0801212',
                'Q0801212A',
                'U6324050',
                'U63240500',
                'V4605581',
                'V46055811',
                'W0049001',
                'W0049001B',
                'X9994480',
                'X9994480A',
                'Y4674358',
                'Y4674358A',
                'Z2842169',
                'Z2842169A',
            )
        );
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
}
