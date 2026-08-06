<?php

namespace App\Services\History;

use App\Models\DeviceHistory;

class HistoryWriter
{
    /**
     * Simpan batch snapshot.
     */
    public function insert(array &$rows): void
    {
        if (empty($rows)) {
            return;
        }

        DeviceHistory::insert($rows);

        $rows = [];
    }
}