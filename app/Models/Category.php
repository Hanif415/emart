<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['files'];

    public static function shiftChild($category_id)
    {
        return Category::whereIn('id', $category_id)->update(['is_parent' => 1]);
    }

    public static function getChildParentById($id)
    {
        return Category::where('parent_id', $id)->pluck('title', 'id');
    }
}
