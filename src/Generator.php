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
        Constant::NIF => 'getDNICode',
        Constant::CIFA => 'getDNICode',
        Constant::CIFB => 'getDNICode',
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

        str_replace(array('X', 'Y', 'Z'), array('', '1', '2'), $documentId);

        $modulo = (int)$documentId % 23;
        return substr('TRWAGMYFPDXBNJZSQVHLCKE', $modulo, 1);
    }

    public function getCodeFor($documentId)
    {
        foreach ($this->functions as $key => $method) {
            if (1===preg_match(Constant::retrievePattern($key), $documentId)) {
                return $this->$method($documentId);
            }
        }
        throw new InvalidParameterException();
    }
}
