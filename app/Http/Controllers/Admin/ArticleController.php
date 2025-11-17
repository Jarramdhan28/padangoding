<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Article\UpdateStatusRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\Admin\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleServices;

    public function __construct(ArticleService $article_service)
    {
        $this->articleServices = $article_service;
    }

    public function index()
    {
        return view('pages.admin.article.index');
    }

    public function getData(Request $request)
    {
        $articles = $this->articleServices->get($request);
        return ResponseHelper::responseWithMeta($articles->isNotEmpty(), ArticleResource::collection($articles));
    }

    public function detailPage($slug)
    {
        if (!Article::where('slug', $slug)->first()) {
            abort(404);
        }
        return view('pages.admin.article.detail');
    }

    public function getDataDetails(Article $article)
    {
        return ResponseHelper::fetchResponse(true, new ArticleResource($article));
    }

    public function statusUpdate(Article $article, UpdateStatusRequest $request)
    {
        if($article->status->value === 'approved'){
            return ResponseHelper::errorResponse('Status approved tidak bisa diupdate', 400);
        }

        $this->articleServices->statusUpdate($article, $request);

        $message = $request->status === 'approved' ? 'Artikel berhasil disetujui.' : 'Artikel berhasil dikirim untuk revisi.';

        return response()->json([
            'status' => 'success',
            'message' => $message,
            'redirect' => route('admin.article.index'),
        ]);
    }
}
