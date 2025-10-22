<?php

namespace App\Services\Admin\Reference;

use App\Models\Reference\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    public function create($request)
    {
        $validated = $request->validated();
        try {
            DB::beginTransaction();
            $filename = null;
            if ($request->hasFile('icon')) {
                $icon = $request->file('icon');
                $filename = time().'.'.$icon->extension();
                $icon->storeAS('icon/categories', $filename, 'public');
            }

            $data = Category::create([
                'name' => $validated['name'],
                'icon' => $filename,
            ]);
            DB::commit();

            return response()->json([
                'message' => 'success'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error'
            ]);
        }
    }

    public function update($request, $category)
    {
        $validated = $request->validated();

        if ($request->hasFile('icon')) {
            $request->validate([
                'icon' => ['image', 'max:2048'],
            ]);

            $icon = $request->file('icon');
            $documentPath = 'icon/categories/';

            if ($category->icon && Storage::disk('public')->exists($documentPath . $category->icon)) {
                Storage::disk('public')->delete($documentPath . $category->icon);
            }

            $filename = time().'.'.$icon->extension();
            $icon->storeAS('icon/categories', $filename, 'public');
            $validated['icon'] = $filename;
        } else{
                unset($validated['icon']);
            }

        $category->update($validated);

        return true;
    }

    public function delete($category)
    {
        $iconDirectory = 'icon/categories/';

        if ($category->icon) {
            $fullPath = $iconDirectory . $category->icon;
            if (Storage::disk('public')->exists($fullPath)) {
                Storage::disk('public')->delete($fullPath);
            }
        }

        $category->delete();

        return true;
    }
}
