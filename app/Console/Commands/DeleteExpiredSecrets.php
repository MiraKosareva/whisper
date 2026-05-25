<?php

namespace App\Console\Commands;

use App\Models\Secret;
use Illuminate\Console\Command;

class DeleteExpiredSecrets extends Command
{
    /**
     * Execute the console command.
     */

    protected $signature = 'secrets:delete-expired';

    protected $description = 'Удаляет все секреты с истекшим сроком жизни';

    public function handle(): void
    {
        $count = Secret::where('expires_at', '<', now())->count();

        if ($count === 0)
            {
                $this->info('Нет просроченных секретов');
                return;
            }

            Secret::where('expires_at', '<', now())->delete();
            $this->info("Удалено {$count} просроченных секретов");
    }
}
