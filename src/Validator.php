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
     * @param string $documentId
     * @return bool
     */
    public function isDNIFormat($documentId)
    {
        return 1 === preg_match(Constant::retrievePattern(Constant::DNI), $documentId);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    public function isNIEFormat($documentId)
    {
         return 1 === preg_match(Constant::retrievePattern(Constant::NIE), $documentId);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    public function isNIFFormat($documentId)
    {
        return 1 === preg_match(Constant::retrievePattern(Constant::NIF), $documentId);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    private function isCIFL($documentId)
    {
         return 1 === preg_match(Constant::retrievePattern(Constant::CIFL), $documentId);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    private function isCIFN($documentId)
    {
         return 1 === preg_match(Constant::retrievePattern(Constant::CIFN), $documentId);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    public function isPersonalFormat($documentId)
    {
         return $this->isDNIFormat($documentId) || $this->isNIEFormat($documentId) || $this->isNIFFormat($documentId);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    public function isCIFFormat($documentId)
    {
        return $this->isCIFL($documentId) || $this->isCIFN($documentId);
    }


    /**
     * @param string $documentId
     * @return bool
     */
    public function isValidFormat($documentId)
    {
        return $this->isPersonalFormat($documentId) || $this->isCIFFormat($documentId);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    public function isValidDNI($documentId)
    {
        if (!is_string($documentId) || strlen($documentId)!==9 || !$this->isDNIFormat($documentId)) {
            return false;
        }

        $generator = new Generator();
        return $generator->getDNICode(substr($documentId, 0, 8)) === substr($documentId, -1, 1);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    public function isValidNIE($documentId)
    {
        if (!is_string($documentId) || strlen($documentId)!==9 || !$this->isNIEFormat($documentId)) {
            return false;
        }

        $generator = new Generator();
        return $generator->getNIECode(substr($documentId, 0, 8)) === substr($documentId, -1, 1);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    public function isValidNIF($documentId)
    {
        if (!is_string($documentId) || strlen($documentId)!==9 || !$this->isNIFFormat($documentId)) {
            return false;
        }

        $generator = new Generator();
        return $generator->getNIFCode(substr($documentId, 0, 8)) === substr($documentId, -1, 1);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    public function isValidCIF($documentId)
    {
        if (!is_string($documentId) || strlen($documentId)!==9 || !$this->isCIFFormat($documentId)) {
            return false;
        }

        $generator = new Generator();
        return $generator->getCIFCode(substr($documentId, 0, 8)) === substr($documentId, -1, 1);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    public function validate($documentId)
    {
        $generator = new Generator();
        $controlCode = $generator->getCodeFor(substr($documentId, 0, 8));
        return strlen($documentId)===9 && $controlCode === substr($documentId, -1, 1);
    }
}
