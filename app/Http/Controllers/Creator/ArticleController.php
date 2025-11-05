<?php

namespace App\Http\Controllers\Creator;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Creator\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\Creator\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $article_service)
    {
        $this->articleService = $article_service;
    }

    public function index()
    {
        return view('pages.creator.article.index');
    }

    public function getArticles(Request $request)
    {
        $author_id = Auth::user()->id;
        $articles = $this->articleService->getArticleByAuthor($request, $author_id);
        return ResponseHelper::responseWithMeta((bool) $articles, ArticleResource::collection($articles));
    }

    public function create()
    {
        return view('pages.creator.article.create');
    }

    public function store(ArticleRequest $request)
    {
        $result = $this->articleService->create($request);
        return ResponseHelper::sendResponse((bool) $result, "tambahkan", "Artikel", route('creator.article.index'));
    }

    public function editPage($slug)
    {
        if (!Article::where('slug', $slug)->first()) {
            abort(404);
        }
        return view('pages.creator.article.create');
    }

    public function getArticleBySlug($slug)
    {
        $artikel = Article::with('author', 'category')->where('slug', $slug)->first();
        return new ArticleResource($artikel);
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $result = $this->articleService->update($request, $article);
        return ResponseHelper::sendResponse((bool) $result, "update", "Artikel", route('creator.article.index'));
    }

    public function detailPage($slug)
    {
        if (!Article::where('slug', $slug)->first()) {
            abort(404);
        }
        return view('pages.creator.article.show');
    }
}
