<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Log;
use Throwable;

class JsRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'js:routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar rotas para acesso front-end via javascript';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private $absolute = false;
    private $prefix = '';
    private $filePath = 'resources/js/assets/routes.json';
    private $fs;

    public function __construct(Filesystem $fs)
    {
        parent::__construct();
        $this->fs = $fs;
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        try {
            $routes = collect(app('router')->getRoutes())->map(function ($route) {
                return [
                    'name' => $route->getName(),
                    'uri' => $route->uri
                ];
            })->toArray();
            $template = [
                'absolute' => $this->absolute,
                'prefix' => $this->prefix,
                'rootUrl' => env('APP_URL'),
                'routes' => $routes
            ];
            $this->fs->put(base_path($this->filePath), json_encode($template));

            echo "\nImportação de rotas para {$this->filePath} realizado com sucesso!\n";
        } catch (Throwable $th) {
            Log::error($th->getMessage());
            echo "\nFalha na importação de rotas para {$this->filePath}\n";
        }
    }
}
