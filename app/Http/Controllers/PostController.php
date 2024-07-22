<?php

namespace App\Http\Controllers;

use App\Jobs\PDFGenerator;
use App\Models\Post;
use Dompdf\Dompdf;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Post::paginate(100));
    }

    public function store()
    {
        $posts = Post::limit(1500)->get();
        PDFGenerator::dispatch($posts);
        return response()->json(['message' => 'PDF generation is in progress.']);
    }
}
