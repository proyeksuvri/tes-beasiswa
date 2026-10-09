<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case Operator = 'operator';
    case Verifikator = 'verifikator';
    case Auditor = 'auditor';
    case Pimpinan = 'pimpinan';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin Sistem',
            self::Operator => 'Operator',
            self::Verifikator => 'Verifikator',
            self::Auditor => 'Auditor',
            self::Pimpinan => 'Pimpinan',
        };
    }
}
