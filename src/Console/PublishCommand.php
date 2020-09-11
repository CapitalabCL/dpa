<?php


namespace Capitalab\DPA\Console;


use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dpa:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publica migraciones de base de datos';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag'   => 'dpa-migrations',
            '--force' => true,
        ]);
    }
}
