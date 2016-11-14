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

    public function getDNICode($documentId)
    {
        $validator = new Validator();
        if (!is_string($documentId) || strlen($documentId)!==8 || !$validator->isDNIFormat($documentId)) {
            throw new InvalidParameterException();
        }

        $modulo = (int)$documentId % 23;
        return substr('TRWAGMYFPDXBNJZSQVHLCKE', $modulo, 1);
    }

    public function getNIECode($documentId)
    {
        $validator = new Validator();
        if (!is_string($documentId) || strlen($documentId)!==8 || !$validator->isNIEFormat($documentId)) {
            throw new InvalidParameterException();
        }

        $documentId = str_replace(array('X', 'Y', 'Z'), array('', '1', '2'), $documentId);

        $modulo = (int)$documentId % 23;
        return substr('TRWAGMYFPDXBNJZSQVHLCKE', $modulo, 1);
    }

    public function getNIFCode($documentId)
    {
        $validator = new Validator();
        if (!is_string($documentId) || strlen($documentId)!==8 || !$validator->isNIFFormat($documentId)) {
            throw new InvalidParameterException();
        }

        $modulo = $this->calculateModule($documentId);

        return $modulo[1];
    }

    public function getCIFCode($documentId)
    {
        $validator = new Validator();
        if (!is_string($documentId) || strlen($documentId)!==8 || !$validator->isCIFFormat($documentId)) {
            throw new InvalidParameterException();
        }

        $modulo = $this->calculateModule($documentId);

        if (1===preg_match(Constant::retrievePattern(Constant::CIFL), $documentId)) {
            return $modulo[1];
        } else {
            return $modulo[0];
        }
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

    public function getCodeFor($documentId)
    {
        foreach ($this->functions as $key => $method) {
            if (1===preg_match(Constant::retrievePattern($key), $documentId)) {
                echo "$method($documentId) => " . $this->$method($documentId) . "\n";
                return $this->$method($documentId);
            }
        }
        throw new InvalidParameterException();
    }
}
