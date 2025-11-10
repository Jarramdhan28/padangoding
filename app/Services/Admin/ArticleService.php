<?php

namespace App\Services\Admin;

use App\Models\Article;

class ArticleService
{
    /**
     * get data semua article yang di kirim user
     */
    public function getData($request)
    {
        $search = $request->query('search');
        $filter = $request->filter;

        $articles = Article::with('category', 'author')
            ->where('status', $filter)
            ->where('status', '!=', 'draft')
            ->when($search, function($query) use($search){
                $query->where('title', 'ILIKE', "%$search%")
                    ->orWhere('status', 'ILIKE', "%$search%")
                    ->orWhere('is_publish', 'ILIKE', "%$search%")
                    ->orWhereHas('category', function($categoryQuery) use ($search){
                        $categoryQuery->where('name', 'ILIKE', "%$search%");
                    })->orWhereHas('author', function($authorQuery) use ($search){
                        $authorQuery->where('name', 'ILIKE', "%$search%");
                    });
            })->orderBy('status', 'desc')
            ->paginate(10);

        return $articles;
    }

    public function getDetailArticle($article)
    {
        $detailArticle = Article::with('author', 'category')->where('slug', $article->slug)->first();
        dd($detailArticle);
        return $detailArticle;
    }
}
