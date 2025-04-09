<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ServeTestCommand extends Command
{
    /**
     * Название и сигнатура консольной команды.
     *
     * @var string
     */
    protected $signature = 'serve:test';

    /**
     * Описание консольной команды.
     *
     * @var string
     */
    protected $description = 'Start the development server on 0.0.0.0:8000';

    /**
     * Выполнение консольной команды.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting development server on 0.0.0.0:8000...');
        
        $process = new Process(['php', 'artisan', 'serve', '--host=0.0.0.0', '--port=8000']);
        $process->setTimeout(null);
        $process->start();

        $this->info('Server started: http://0.0.0.0:8000');
        $this->info('Press Ctrl+C to stop the server');

        $process->wait();
        
        return 0;
    }
}