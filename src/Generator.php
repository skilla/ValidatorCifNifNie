<?php
/**
 * Created by PhpStorm.
 * User: Sergio Zambrano <sergio.zambrano@gmail.com>
 * Date: 10/11/16
 * Time: 9:44
 */

namespace Skilla\ValidatorCifNifNie;

class Generator
{
    private $functions = array(
        Constant::DNI => 'getDNICode',
        Constant::NIE => 'getNIECode',
        Constant::NIF => 'getNIFCode',
        Constant::CIFN => 'getCIFCode',
        Constant::CIFL => 'getCIFCode',
    );

    const DOCUMENT_LENGTH_WITHOUT_CODE = 8;

    /**
     * @param string $documentId
     * @return string
     * @throws InvalidParameterException
     */
    public function getDNICode($documentId)
    {
        if (!is_string($documentId) || strlen($documentId) !== static::DOCUMENT_LENGTH_WITHOUT_CODE) {
            throw new InvalidParameterException();
        }
        $modulo = (int)$documentId % 23;

        return substr('TRWAGMYFPDXBNJZSQVHLCKE', $modulo, 1);
    }

    /**
     * @param string $documentId
     * @return string
     * @throws InvalidParameterException
     */
    public function getNIECode($documentId)
    {
        if (!is_string($documentId) || strlen($documentId) !== static::DOCUMENT_LENGTH_WITHOUT_CODE) {
            throw new InvalidParameterException();
        }
        $documentId = str_replace(array('X', 'Y', 'Z'), array('', '1', '2'), $documentId);
        $modulo = (int)$documentId % 23;

        return substr('TRWAGMYFPDXBNJZSQVHLCKE', $modulo, 1);
    }

    /**
     * @param string $documentId
     * @return mixed
     * @throws InvalidParameterException
     */
    public function getNIFCode($documentId)
    {
        if (!is_string($documentId) || strlen($documentId) !== static::DOCUMENT_LENGTH_WITHOUT_CODE) {
            throw new InvalidParameterException();
        }
        $modulo = $this->calculateModule($documentId);

        return $modulo[1];
    }

    /**
     * @param string $documentId
     * @return string
     * @throws InvalidParameterException
     */
    public function getCIFCode($documentId)
    {
        if (!is_string($documentId) || strlen($documentId) !== static::DOCUMENT_LENGTH_WITHOUT_CODE) {
            throw new InvalidParameterException();
        }
        $modulo = $this->calculateModule($documentId);

        $code = $modulo[0];
        if (1 === preg_match(Constant::retrievePattern(Constant::CIFL), $documentId)) {
            $code = $modulo[1];
        }

        return $code;
    }

    private function calculateModule($documentId)
    {
        $controlCodes = 'JABCDEFGHI';
        $even = 0;
        for ($i=2; $i<=6; $i+=2) {
            $even += (int)substr($documentId, $i, 1);
        }
        $odd = 0;
        for ($i=1; $i<=7; $i+=2) {
            $partial = 2*(int)substr($documentId, $i, 1);
            if ($partial>9) {
                $odd += 1 + ($partial - 10);
            } else {
                $odd += $partial;
            }
        }
        $modulo = ($even + $odd) % 10;
        if ($modulo!=0) {
            $modulo = 10 - $modulo;
        }
        return array("$modulo", substr($controlCodes, $modulo, 1));
    }

    /**
     * @param string $documentId
     * @return mixed
     * @throws InvalidParameterException
     */
    public function getDocumentCode($documentId)
    {
        foreach ($this->functions as $key => $method) {
            if (1 === preg_match(Constant::retrievePattern($key), $documentId)) {
                return $this->$method($documentId);
            }
        }
        throw new InvalidParameterException();
    }
}
