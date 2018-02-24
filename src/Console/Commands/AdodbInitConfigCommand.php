<?php

namespace farenas\AdodbConect\Console\Commands;

use Illuminate\Console\Command;

class AdodbInitConfigCommand extends Command
{

    protected $signature = 'adodb:clearcache';

    protected $description = 'Elimina cache de AdodbConect';

    public function __construct()
    {

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // $key = $this->getRandomKey();

        // $path = config_path('dbConfig.php');
        // print($path); die();
        // if (file_exists($path)) {
        //     file_put_contents($path, str_replace(
        //         $this->laravel['config']['dbConfig.secret'], $key, file_get_contents($path)
        //     ));
        // }

        // $this->laravel['config']['dbConfig.secret'] = $key;

        $this->info("Cache eliminada con exito.");
    }
}