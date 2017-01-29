# ValidatorCifNifNie
Validator for Spanish National documents (CIF, NIF, NIE)

[![Latest Stable Version](https://img.shields.io/github/release/skilla/ValidatorCifNifNie.svg)](https://packagist.org/packages/skilla/validator-cif-nif-nie)
[![Build Status](https://travis-ci.org/skilla/ValidatorCifNifNie.svg?branch=master)](https://travis-ci.org/skilla/ValidatorCifNifNie)
[![Total Downloads](https://poser.pugx.org/skilla/validator-cif-nif-nie/downloads)](https://packagist.org/packages/skilla/validator-cif-nif-nie)
[![Latest Unstable Version](https://poser.pugx.org/skilla/validator-cif-nif-nie/v/unstable)](https://packagist.org/packages/skilla/validator-cif-nif-nie#dev-master)
[![License](https://poser.pugx.org/skilla/validator-cif-nif-nie/license)](https://packagist.org/packages/skilla/validator-cif-nif-nie)
[![composer.lock](https://poser.pugx.org/skilla/validator-cif-nif-nie/composerlock)](https://packagist.org/packages/skilla/validator-cif-nif-nie)
[![codecov](https://codecov.io/gh/skilla/ValidatorCifNifNie/branch/master/graph/badge.svg)](https://codecov.io/gh/skilla/ValidatorCifNifNie)

## [__Installation__ | __Instalación__]


composer require skilla/validator-cif-nif-nie


## [__Description__ | __Descripción__]

The identity documents in Spain are composed of 9 alphanumeric digits with different formats, their generic form is 1 => [alphanumeric] + 7 => [numeric] +1 => [alphanumeric]

The validator has four simple methods to validate only the format (length and combination of letters and numbers) and three additional composite methods that make validations by groups, personal documents, documents of legal organizations and a third method that validates all kinds of Identification documents.

- isDNIFormat => To validate the format of the document identifiers of Spanish people.
- isNIEFormat => To validate the format of the document identifiers of foreign persons residing in Spain.
- isNIFFormat => To validate the format of the document identifiers of Spanish or foreign persons in special situations.
- isPersonalFormat => To validate the format of the document identifiers of any of the three types above.
- isCIFFormat => To validate the format of document identifiers of Spanish or foreign organizations with the Spanish Tax Identification Code.
- isValidFormat => To validate the format of document identifiers of individuals or organizations with the Spanish Tax Identification Code.

It also has 5 methods to validate that the identifier, including the check digit is correct.

- isValidDNI => To validate the document identifiers of Spanish people.
- isValidNIE => To validate the document identifiers of foreign persons residing in Spain.
- isValidNIF => To validate the document identifiers of Spanish or foreign persons in special situations.
- isValidCIF => To validate the document identifiers of Spanish or foreign organizations with the Spanish Tax Identification Code.
- validate => To validate the document identifiers of individuals or organizations with the Spanish Tax Identification Code.

Los documentos de identidad en España están compuestos de 9 dígitos alfanuméricos con distintos formatos, su forma genérica es 1=>[alfanumérico] + 7=>[numéricos] +1=>[alfanumérico]

El validador dispone de cuatro métodos simples para validar únicamente el formato (longitud y combinación de letras y números) y tres métodos compuestos adicionales que hacen validaciones por grupos, los documentos personales, los documentos de organizaciones jurídicas y un tercero método que valida todo tipo de documentos de identificación.

- isDNIFormat => Para validar el formato de los identificadores de documentos de personas españoles.
- isNIEFormat => Para validar el formato de los identificadores de documentos de personas extranjeras residentes en España.
- isNIFFormat => Para validar el formato de los identificadores de documentos de personas Españolas o extranjeras en situaciones especiales.
- isPersonalFormat => Para validar el formato de los identificadores de documentos de cualquiera de los tres tipos anteriores.
- isCIFFormat => Para validar el formato de los identificadores de documentos de organizaciones Españolas o extranjeras con Código de identificación fiscal de España.
- isValidFormat => Para validar el formato de los identificadores de documentos de personas u organizaciones con Código de identificación fiscal de España.

También dispone de 5 métodos para validar que el identificador, incluido el dígito de control sea correcto.

- isValidDNI => Para validar los identificadores de documentos de personas españoles.
- isValidNIE => Para validar los identificadores de documentos de personas extranjeras residentes en España.
- isValidNIF => Para validar los identificadores de documentos de personas Españolas o extranjeras en situaciones especiales.
- isValidCIF => Para validar los identificadores de documentos de organizaciones Españolas o extranjeras con Código de identificación fiscal de España.
- validate => Para validar los identificadores de documentos de personas u organizaciones con Código de identificación fiscal de España.


[__Examples__ | __Ejemplos__](https://github.com/skilla/ValidatorCifNifNie/blob/master/Tests/ValidatorTest.php)
