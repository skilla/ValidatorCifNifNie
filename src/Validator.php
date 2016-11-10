<?php
/**
 * Created by PhpStorm.
 * User: Sergio Zambrano Delfa <sergio.zambrano@gmail.com>
 * Date: 10/11/16
 * Time: 9:38
 */

namespace Skilla\ValidatorCifNifNie;

class Validator
{
    /**
     * @param $documentId
     * @return bool
     */
    public function isDNIFormat($documentId)
    {
        return 1===preg_match(Constant::retrievePattern(Constant::DNI), $documentId);
    }

    /**
     * @param $documentId
     * @return bool
     */
    public function isNIEFormat($documentId)
    {
         return 1===preg_match(Constant::retrievePattern(Constant::NIE), $documentId);
    }

    /**
     * @param $documentId
     * @return bool
     */
    public function isPersonalFormat($documentId)
    {
         return $this->isDNIFormat($documentId) || $this->isNIEFormat($documentId);
    }

    /**
     * @param $documentId
     * @return bool
     */
    public function isNIFFormat($documentId)
    {
        return 1===preg_match(Constant::retrievePattern(Constant::NIF), $documentId);
    }

    /**
     * @param $documentId
     * @return bool
     */
    public function isCIFFormat($documentId)
    {
        return $this->isCIFA($documentId) || $this->isCIFB($documentId);
    }

    private function isCIFA($documentId)
    {
         return 1===preg_match(Constant::retrievePattern(Constant::CIFA), $documentId);
    }

    private function isCIFB($documentId)
    {
         return 1===preg_match(Constant::retrievePattern(Constant::CIFB), $documentId);
    }

    public function isJuristicFormat($documentId)
    {
         return $this->isNIFFormat($documentId) || $this->isCIFFormat($documentId);
    }

    public function isValidFormat($documentId)
    {
        return $this->isPersonalFormat($documentId) || $this->isJuristicFormat($documentId);
    }

    public function isValidDNI($documentId)
    {
        if (!is_string($documentId) || strlen($documentId)!==9 || !$this->isDNIFormat($documentId)) {
            return false;
        }

        $generator = new Generator();
        return $generator->getDNICode(substr($documentId, 0, 8)) === substr($documentId, -1, 1);
    }

    public function isValidNIE($documentId)
    {
        if (!is_string($documentId) || strlen($documentId)!==9 || !$this->isNIEFormat($documentId)) {
            return false;
        }

        $generator = new Generator();
        return $generator->getNIECode(substr($documentId, 0, 8)) === substr($documentId, -1, 1);
    }

    public function validate($documentId)
    {
        $generator = new Generator();
        $controlCode = $generator->getCodeFor(substr($documentId, 0, 8));
        return $controlCode === substr($documentId, -1, 1);
    }
}
