<?php

namespace App\Services\Creator;

use App\Models\Article;
use App\Models\User;
use App\Notifications\ArticleForReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\support\Str;

class ArticleService
{
    /**
     * Create a new article.
     */
    public function create($request)
    {
        $data = $request->validated();
        $slug = str::slug($data['title']);

        try {
            DB::beginTransaction();

            $fileThumbnail = null;
            if($request->hasFile('thumbnail')){
                $thumbnail = $request->file('thumbnail');
                $fileThumbnail = time().'.'.$thumbnail->extension();
                $thumbnail->storeAs('article/thumbnail', $fileThumbnail, 'public');
            }

            $article = Article::create([
                'slug' => $slug,
                'thumbnail' => $fileThumbnail,
                'title' => $data['title'],
                'content' => $data['content'],
                'description' => $data['description'],
                'category_id' => $data['category_id'],
                'author_id' => Auth::user()->id,
                'status' => $data['status'],
                'is_publish' => false,
            ]);

            if($data['status'] === 'review'){
                $adminUser = User::role('admin')->get();
                Notification::send($adminUser, new ArticleForReview($article));
            }

            DB::commit();
            return true;
        } catch(\Throwable $th){
            DB::rollBack();
            return false;
        }
    }

    public function getArticleByAuthor(Request $request, $author_id)
    {
        $article = Article::with('author', 'category')
            ->where('author_id', $author_id)
            ->when($request->search, function($query, $q){
                $query->where('title', 'ILIKE', "%$q%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        return $article;
    }

    public function update($request, $article)
    {
        $data = $request->validated();
        $slug = str::slug($data['title']);

        try {
            DB::beginTransaction();

            $fileThumbnail = $article->thumbnail;
            if($request->hasFile('thumbnail')){
                $thumbnail = $request->file('thumbnail');
                $fileThumbnail = time().'.'.$thumbnail->extension();
                $thumbnail->storeAs('article/thumbnail', $fileThumbnail, 'public');
            }

            $article->update([
                'slug' => $slug,
                'thumbnail' => $fileThumbnail,
                'title' => $data['title'],
                'content' => $data['content'],
                'description' => $data['description'],
                'category_id' => $data['category_id'],
                'author_id' => Auth::user()->id,
                'status' => $data['status'],
                'is_publish' => false,
            ]);

            if($data['status'] === 'review'){
                $adminUser = User::role('admin')->get();
                Notification::send($adminUser, new ArticleForReview($article));
            }

            DB::commit();
            return true;
        } catch(\Throwable $th){
            DB::rollBack();
            Log::info($th->getMessage());
            return false;
        }
    }

    public function delete($article)
    {
        if($article->thumbnail){
            if(Storage::disk('public')->exists('article/thumbnail/' . $article->thumbnail)){
                Storage::disk('public')->delete('article/thumbnail/' . $article->thumbnail);
            }
        }

        return $article->delete();
    }
}
