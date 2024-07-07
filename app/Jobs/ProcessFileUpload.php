<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessFileUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $fileName;
    protected $filePath;

    /**
     * Create a new job instance.
     *
     * @param string $fileName
     * @param string $filePath
     * @return void
     */
    public function __construct($fileName, $filePath)
    {
        $this->fileName = $fileName;
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Process the uploaded file (example logic)
        // For instance, move the file to final storage directory
        $finalPath = storage_path('app/uploads/' . $this->fileName);
        // Example move operation
        // Ensure the directory exists before moving the file
        if (!file_exists(dirname($finalPath))) {
            mkdir(dirname($finalPath), 0755, true);
        }
        rename($this->filePath, $finalPath);
    }
}

