<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
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

    public function getArticles(Request $request)
    {
        $articles = $this->articleServices->getData($request);
        return ResponseHelper::responseWithMeta($articles->isNotEmpty(), ArticleResource::collection($articles));
    }

    public function detailArticle($slug)
    {
        if (!Article::where('slug', $slug)->first()) {
            abort(404);
        }
        return view('pages.admin.article.detail');
    }

    public function getDetailArticle(Article $article)
    {
        return ResponseHelper::fetchResponse(true, new ArticleResource($article));
    }
}
