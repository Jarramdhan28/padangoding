<?php

namespace App\Http\Controllers\Admin\Reference;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Referensi\TagRequest;
use App\Http\Resources\Admin\Referensi\TagResource;
use App\Models\Reference\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('pages.admin.reference.tag.index');
    }

    public function get(Request $request)
    {
        $result = Tag::where('name', 'ILIKE', "%$request->search%")->paginate(20);
        return ResponseHelper::responseWithMeta((bool) $result, TagResource::collection($result));
    }

    public function store(TagRequest $request)
    {
        $result = Tag::create($request->validated());
        return ResponseHelper::sendResponse((bool) $result, "tambah");
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $result = $tag->update($request->validated());
        return ResponseHelper::sendResponse((bool) $result, "update");
    }

    public function destroy(Tag $tag)
    {
        $result = $tag->delete();
        return ResponseHelper::sendResponse((bool) $result, "Hapus");
    }
}
