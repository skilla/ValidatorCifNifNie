<?php
/**
 * Created by PhpStorm.
 * User: Sergio Zambrano <sergio.zambrano@gmail.com>
 * Date: 10/11/16
 * Time: 10:35
 */

namespace Skilla\ValidatorCifNifNie;

class Constant
{
    const ALICANTE = 'Alicante';
    const BARCELONA = 'Barcelona';
    const MADRID = 'Madrid';
    const MALAGA = 'Málaga';
    const SEVILLA = 'Sevilla';
    const VALENCIA = 'Valencia';

    const DNI  = 'DNI';
    const NIE  = 'NIE';
    const NIF  = 'NIF';
    const CIFN = 'CIFN';
    const CIFL = 'CIFL';

    private static $patterns = array(
        self::DNI  => "~^\\d{8,8}[TRWAGMYFPDXBNJZSQVHLCKE]?$~",
        self::NIE  => "~^[XYZ]\\d{7,7}[TRWAGMYFPDXBNJZSQVHLCKE]?$~",
        self::NIF  => "~^[KLM]\\d{7,7}[ABCDEFGHIJ]?$~",
        self::CIFN => "~^[ABCDEFGHJUV]\\d{7,7}\\d?$~",
        self::CIFL => "~^[NPQRSW]\\d{7,7}[ABCDEFGHIJ]?$~",
    );

    private static $province = array(
        '01' => 'Álava',
        '02' => 'Albacete',
        '03' => self::ALICANTE,
        '53' => self::ALICANTE,
        '54' => self::ALICANTE,
        '04' => 'Almería',
        '05' => 'Ávila',
        '06' => 'Badajoz',
        '07' => 'Islas Baleares',
        '57' => 'Islas Baleares',
        '08' => self::BARCELONA,
        '58' => self::BARCELONA,
        '59' => self::BARCELONA,
        '60' => self::BARCELONA,
        '61' => self::BARCELONA,
        '62' => self::BARCELONA,
        '63' => self::BARCELONA,
        '64' => self::BARCELONA,
        '65' => self::BARCELONA,
        '66' => self::BARCELONA,
        '68' => self::BARCELONA,
        '09' => 'Burgos',
        '10' => 'Cáceres',
        '11' => 'Cádiz',
        '72' => 'Cádiz',
        '12' => 'Castellón',
        '13' => 'Ciudad Real',
        '14' => 'Córdoba',
        '56' => 'Córdoba',
        '15' => 'La Coruña',
        '70' => 'La Coruña',
        '16' => 'Cuenca',
        '17' => 'Girona',
        '55' => 'Girona',
        '18' => 'Granada',
        '19' => 'Guadalajara / Granada',
        '20' => 'Guipúzcoa',
        '75' => 'Guipúzcoa / Santa Cruz de Tenerife',
        '21' => 'Huelva',
        '22' => 'Huesca',
        '23' => 'Jaén',
        '24' => 'León',
        '25' => 'Lleida',
        '26' => 'La Rioja',
        '27' => 'Lugo',
        '28' => self::MADRID,
        '78' => self::MADRID,
        '79' => self::MADRID,
        '80' => self::MADRID,
        '81' => self::MADRID,
        '82' => self::MADRID,
        '83' => self::MADRID,
        '84' => self::MADRID,
        '85' => self::MADRID,
        '86' => self::MADRID,
        '87' => self::MADRID,
        '29' => self::MALAGA,
        '92' => self::MALAGA,
        '93' => self::MALAGA,
        '30' => 'Murcia',
        '73' => 'Murcia',
        '31' => 'Navarra',
        '71' => 'Navarra',
        '32' => 'Orense',
        '33' => 'Asturias',
        '74' => 'Asturias',
        '34' => 'Palencia',
        '35' => 'Las Palmas',
        '76' => 'Las Palmas',
        '36' => 'Pontevedra',
        '94' => 'Pontevedra',
        '37' => 'Salamanca',
        '38' => 'Santa Cruz de Tenerife',
        '39' => 'Cantabria',
        '40' => 'Segovia',
        '41' => self::SEVILLA,
        '90' => self::SEVILLA,
        '91' => self::SEVILLA,
        '42' => 'Soria',
        '43' => 'Tarragona',
        '77' => 'Tarragona',
        '44' => 'Teruel',
        '45' => 'Toledo',
        '46' => self::VALENCIA,
        '96' => self::VALENCIA,
        '97' => self::VALENCIA,
        '98' => self::VALENCIA,
        '47' => 'Valladolid',
        '48' => 'Vizcaya',
        '95' => 'Vizcaya',
        '49' => 'Zamora',
        '50' => 'Zaragoza',
        '99' => 'Zaragoza',
        '51' => 'Ceuta',
        '52' => 'Melilla',
    );

    public static function retrievePattern($documentType)
    {
        if (!isset(static::$patterns[$documentType])) {
            throw new InvalidParameterException("Patter '$documentType' not exists");
        }
        return static::$patterns[$documentType];
    }

    public static function retrieveProvince($provinceCode)
    {
        if (!isset(static::$province[$provinceCode])) {
            throw new InvalidParameterException("Province '$provinceCode' not exists");
        }
        return static::$province[$provinceCode];
    }
}
