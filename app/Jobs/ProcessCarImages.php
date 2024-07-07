<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\TestCreate;
use App\Models\Models\ExteriorImage;
use App\Models\Models\InteriorImage;

class ProcessCarImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $exteriorPaths;
    protected $interiorPaths;
    protected $testCreateId;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct($data)
    {
        $this->exteriorPaths = $data['exteriorPaths'] ?? [];
        $this->interiorPaths = $data['interiorPaths'] ?? [];
        $this->testCreateId = $data['testCreateId'];
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $testCreate = TestCreate::find($this->testCreateId);
        if (!$testCreate) {
            return;
        }

        // Process exterior images
        foreach ($this->exteriorPaths as $path) {
            $exteriorImage = new ExteriorImage();
            $exteriorImage->path = $path;
            $exteriorImage->test_create_id = $testCreate->id;
            $exteriorImage->save();
        }

        // Process interior images
        foreach ($this->interiorPaths as $path) {
            $interiorImage = new InteriorImage();
            $interiorImage->path = $path;
            $interiorImage->test_create_id = $testCreate->id;
            $interiorImage->save();
        }

    }
}
