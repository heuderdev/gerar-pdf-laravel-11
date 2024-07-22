<?php

namespace App\Jobs;

use App\Models\Donwload;
use Dompdf\Dompdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class PDFGenerator implements ShouldQueue
{
    use Queueable;

    protected $posts;

    /**
     * Create a new job instance.
     */
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $uuid = Uuid::uuid4()->toString();

        $html = view('pdf', ['posts' => $this->posts])->render();

        $dompdf = new Dompdf();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $pdfOutput = $dompdf->output();
        $pdfPath = 'public/' . $uuid . '.pdf';
        Storage::put($pdfPath, $pdfOutput);
        $pdfUrl = Storage::url($pdfPath);

        Donwload::query()->create([
            'link' => env('APP_URL') . $pdfUrl
        ]);
    }
}
