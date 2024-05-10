<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Blade;

class BuildTemplateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'template:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renders all views specified in this command in /public as html files';

    /**
     * List of files to render from resrouces/views dir
     *
     * @var string[]
     */
    protected static $files_to_render = [
        'index'
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (self::$files_to_render as $file_name) {
            $view_path = "./resources/views/pages/" . $file_name . ".blade.php";
            $view = fopen($view_path, "r") or die("Unable to open " . $view_path);


            $html_path = "./public/" . $file_name . ".html";
            if ($file_name !== 'index') {
                $dirname = "./public/" . $file_name . '/';
                if (!file_exists($dirname)) {
                    mkdir($dirname);
                }
                $html_path = "./public/" . $file_name . "/index.html";
            }
            $view_content = fread($view, filesize($view_path));
            file_put_contents($html_path, Blade::render($view_content));

            $this->info("Compiled " . $view_path . " into " . $html_path);
        }
    }
}
