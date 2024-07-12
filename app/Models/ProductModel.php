<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'products';
    protected $fillable = [
        'nama',
        'harga',
        'jenis',
    ];

    public function images()
    {
        return $this->hasMany(ProductImageModel::class, 'product_id', 'id');
    }
}
