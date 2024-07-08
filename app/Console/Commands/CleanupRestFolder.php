<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CleanupRestFolder extends Command
{
    protected $signature = 'cleanup:rest-folder';
    protected $description = 'Delete files in the rest folder that are older than 24 hours';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $restPath = storage_path('app/public/uploads/rest');
        $files = Storage::files('public/uploads/rest');

        foreach ($files as $file) {
            $lastModified = Storage::lastModified($file);
            $fileAge = Carbon::createFromTimestamp($lastModified);

            if ($fileAge->diffInHours(Carbon::now()) > 24) {
                Storage::delete($file);
                $this->info("Deleted old file: $file");
            }
        }

        $this->info('Cleanup completed.');
    }
}
