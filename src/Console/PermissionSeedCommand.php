<?php

namespace DevSajid\Permission\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PermissionSeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Database Seed Successfully';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('db:seed', [
            '--class' => 'DevSajid\Permission\database\seeders\DatabaseSeeder'
        ]);

        $this->info('Permission Seed Successfully');
    }
}
