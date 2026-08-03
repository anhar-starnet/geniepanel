<?php

namespace App\Helpers;

class CodeGenerator
{
    /**
     * Generate kode otomatis berdasarkan ID terakhir.
     *
     * Contoh:
     * POP0001
     * CST000001
     * ODP0001
     */
    public static function generate(
        string $prefix,
        string $modelClass,
        int $length = 4
    ): string {

        $lastId = $modelClass::max('id') ?? 0;

        $nextId = $lastId + 1;

        return $prefix . str_pad(
            $nextId,
            $length,
            '0',
            STR_PAD_LEFT
        );
    }
}
