<?php

namespace farenas\AdodbConect\Console\Commands;

use Illuminate\Console\Command;

class AdodbInitConfigCommand extends Command
{

    protected $signature = 'adodb:ini';

    protected $description = 'Genera el archivo de configuracion para adodbConect';

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

        $key = $this->getRandomKey();

        $path = config_path('dbConfig.php');
        print($path); die();
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                $this->laravel['config']['dbConfig.secret'], $key, file_get_contents($path)
            ));
        }

        $this->laravel['config']['dbConfig.secret'] = $key;

        $this->info("jwt-auth secret [$key] set successfully.");
    }
}