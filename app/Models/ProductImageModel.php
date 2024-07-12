<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImageModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'product_image';
    protected $fillable = [
        'product_id',
        'nama'
    ];

    public function produk()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
}
