<?php

namespace App\Services\Admin;

use App\Models\Article;

class ArticleService
{
    /**
     * get data semua article yang di kirim user
     */
    public function get($request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter');

        $query = Article::query()->with('category', 'author')
            ->where('status', '!=', 'draft');
        if($filter) $query->where('status', $filter);
        if($search){
            $query->where(function($query) use($search){
                $query->where('title', 'ILIKE', "%$search%")
                    ->orWhere('status', 'ILIKE', "%$search%")
                    ->orWhere('is_publish', 'ILIKE', "%$search%")
                    ->orWhereHas('category', function($categoryQuery) use ($search){
                        $categoryQuery->where('name', 'ILIKE', "%$search%");
                    })->orWhereHas('author', function($authorQuery) use ($search){
                        $authorQuery->where('name', 'ILIKE', "%$search%");
                    });
            });
        }
        $articles = $query->orderBy('status', 'desc')->paginate(10);
        return $articles;
    }

    public function statusUpdate($article, $request)
    {
        $statusUpdate = $article->update([
            'status' => $request->status,
            'comment' => $request->comment,
        ]);

        return $statusUpdate;
    }
}
