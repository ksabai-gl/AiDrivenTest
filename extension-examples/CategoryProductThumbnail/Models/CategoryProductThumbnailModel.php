<?php

namespace Extensions\CategoryProductThumbnail\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProductThumbnailModel extends Model
{
    protected $table = 'CategoryProductThumbnail';
    protected $fillable = ['category_product_id','fax'];
}