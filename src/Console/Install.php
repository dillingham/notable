<?php

namespace Notable\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notable:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Notable resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (is_dir(base_path('docs'))) {
            $this->comment('Notable installed already');

            return;
        }

        $this->makeDirIfMissing(resource_path('views/layouts'));
        $this->makeDirIfMissing(resource_path('views/docs'));
        $this->makeDirIfMissing(base_path('docs'));

        $this->addDocsDirectory();
        $this->addDocsRoutes();
        $this->addDocsViews();

        $this->info('Notable installed successfully.');
    }

    public function addDocsDirectory()
    {

        file_put_contents(base_path('docs/index.md'), '# Hello World');
    }

    public function addDocsRoutes()
    {
        $routes = file_get_contents(base_path('routes/web.php'));
        $routes = str_replace('<?php', "<?php\n\nRoute::markdown('docs', base_path('docs'));", $routes);
        file_put_contents(base_path('routes/web.php'), $routes);
    }

    public function addDocsViews()
    {
        file_put_contents(resource_path('views/docs/show.blade.php'), file_get_contents(__DIR__.'/../../resources/views/show.blade.php'));

        if(!file_exists(resource_path('views/layouts/app.blade.php'))) {
            file_put_contents(resource_path('views/layouts/app.blade.php'), file_get_contents(__DIR__.'/../../resources/views/layouts/app.blade.php'));
        }
    }

    public function makeDirIfMissing($path)
    {
        if(is_dir($path)) {
            return;
        }

        mkdir($path);
    }
}
