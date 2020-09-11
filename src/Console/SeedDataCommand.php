<?php

namespace Capitalab\DPA\Console;

use Capitalab\DPA\Region;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SeedDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dpa:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Carga información de regiones, provincias y comunas de Chile';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $time_start = microtime(true);

        $json = File::get(__DIR__ . "/../../database/data/chile.json");
        $data = json_decode($json);

        foreach($data->regiones as $regionJson) {
            $region = Region::create([
                'nombre'  => $regionJson->nombre,
                'ordinal' => $regionJson->ordinal
            ]);

            foreach($regionJson->provincias as $provinciaJson) {
                $provincia = $region->provincias()->create(['nombre' => $provinciaJson->nombre]);

                foreach($provinciaJson->comunas as $comuna) {
                    $provincia->comunas()->create(['nombre' => $comuna]);
                }
            }
        }

        $time_end = microtime(true);
        $time = $time_end - $time_start;

        $this->info("Executed in {$time} ms");
    }
}
