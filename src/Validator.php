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
    const DOCUMENT_LENGTH_WITH_CODE = 9;
    const DOCUMENT_LENGTH_WITHOUT_CODE = 8;

    /**
     * @var Generator
     */
    private $generator;

    /**
     * @param Generator $generator
     */
    public function __construct($generator)
    {
        $this->generator = $generator;
    }

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
        if (!is_string($documentId) ||
            strlen($documentId) !== static::DOCUMENT_LENGTH_WITH_CODE ||
            !$this->isDNIFormat($documentId)
        ) {
            return false;
        }

        $documentFirstEightChars = substr($documentId, 0, static::DOCUMENT_LENGTH_WITHOUT_CODE);
        $code = $this->generator->getDNICode($documentFirstEightChars);
        
        $lastChar = $this->getLastCharOfString($documentId);

        return ($code === $lastChar || strtolower($code) === $lastChar);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    public function isValidNIE($documentId)
    {
        if (!is_string($documentId) || strlen($documentId)!== static::DOCUMENT_LENGTH_WITH_CODE || !$this->isNIEFormat($documentId)) {
            return false;
        }
        $documentFirstEightChars = substr($documentId, 0, static::DOCUMENT_LENGTH_WITHOUT_CODE);
        $code = $this->generator->getNIECode($documentFirstEightChars);
        
        $lastChar = $this->getLastCharOfString($documentId);

        return ($code === $lastChar || strtolower($code) === $lastChar);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    public function isValidNIF($documentId)
    {
        if (!is_string($documentId) ||
            strlen($documentId) !== static::DOCUMENT_LENGTH_WITH_CODE ||
            !$this->isNIFFormat($documentId)
        ) {
            return false;
        }
        $documentFirstEightChars = substr($documentId, 0, static::DOCUMENT_LENGTH_WITHOUT_CODE);
        $code = $this->generator->getNIFCode($documentFirstEightChars);
        
        $lastChar = $this->getLastCharOfString($documentId);

        return ($code === $lastChar || strtolower($code) === $lastChar);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    public function isValidCIF($documentId)
    {
        if (!is_string($documentId) ||
            strlen($documentId) !== static::DOCUMENT_LENGTH_WITH_CODE
            || !$this->isCIFFormat($documentId)
        ) {
            return false;
        }
        $documentFirstEightChars = substr($documentId, 0, static::DOCUMENT_LENGTH_WITHOUT_CODE);
        $code = $this->generator->getCIFCode($documentFirstEightChars);
        
        $lastChar = $this->getLastCharOfString($documentId);

        return ($code === $lastChar || strtolower($code) === $lastChar);
    }

    /**
     * @param string $documentId
     * @return bool
     */
    public function validate($documentId)
    {
        $documentFirstEightChars = substr($documentId, 0, static::DOCUMENT_LENGTH_WITHOUT_CODE);
        $controlCode = $this->generator->getDocumentCode($documentFirstEightChars);

        $lastChar = $this->getLastCharOfString($documentId);
        
        return strlen($documentId) === static::DOCUMENT_LENGTH_WITH_CODE && 
                        ($controlCode === $lastChar || strtolower($controlCode) === $lastChar);
    }

    /**
     * @param string $documentId
     * @return string
     */
    private function getLastCharOfString($documentId)
    {
        return substr($documentId, -1, 1);
    }
}
