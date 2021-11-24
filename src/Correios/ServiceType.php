<?php


namespace Correios;


abstract class ServiceType
{
    const PAC = '4510';
    const PAC_CONTRATO = '4669';
    const PAC_CONTRATO_04812 = '4812';
    const PAC_CONTRATO_41068 = '41068';
    const PAC_CONTRATO_41211 = '41211';
    const SEDEX = '4014';
    const SEDEX_CONTRATO = '4162';
    const SEDEX_A_COBRAR = '40045';
    const SEDEX_10 = '40215';
    const SEDEX_HOJE = '40290';
    const SEDEX_CONTRATO_04316 = '4316';
    const SEDEX_CONTRATO_40096 = '40096';
    const SEDEX_CONTRATO_40436 = '40436';
    const SEDEX_CONTRATO_40444 = '40444';
    const SEDEX_CONTRATO_40568 = '40568';

    public static function name(string $code): string
    {
        return match($code) {
            self::PAC,
            self::PAC_CONTRATO,
            self::PAC_CONTRATO_04812,
            self::PAC_CONTRATO_41068,
            self::PAC_CONTRATO_41211 => 'PAC',
            self::SEDEX,
            self::SEDEX_CONTRATO,
            self::SEDEX_CONTRATO_04316,
            self::SEDEX_CONTRATO_40096,
            self::SEDEX_CONTRATO_40436,
            self::SEDEX_CONTRATO_40444,
            self::SEDEX_CONTRATO_40568=> 'SEDEX',
            self::SEDEX_A_COBRAR => 'SEDEX a Cobrar',
            self::SEDEX_10 => 'SEDEX 10',
            self::SEDEX_HOJE => 'SEDEX Hoje',
            default => ''
        };
    }

    public static function isPAC(string $code): bool
    {
        return match($code) {
            self::PAC,
            self::PAC_CONTRATO,
            self::PAC_CONTRATO_04812,
            self::PAC_CONTRATO_41068,
            self::PAC_CONTRATO_41211 => true,
            default => false
        };
    }
}