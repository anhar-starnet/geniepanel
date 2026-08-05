<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GenieACS\HistoryService;

class CollectGenieHistory extends Command
{
    /**
     * Nama command.
     */
    protected $signature = 'genie:history';

    /**
     * Deskripsi.
     */
    protected $description = 'Collect GenieACS device history';

    public function __construct(
        protected HistoryService $history
    ) {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->info('Collecting GenieACS history...');

        $count = $this->history->collect();

        $this->newLine();

        $this->info("Collected {$count} devices.");

        $this->newLine();

        $stats = $this->history->statistics();

        $this->table(
            ['Today', 'Week', 'Month'],
            [[
                $stats['today'],
                $stats['week'],
                $stats['month'],
            ]]
        );

        return self::SUCCESS;
    }
}