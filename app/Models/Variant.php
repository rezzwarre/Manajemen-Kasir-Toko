<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'sku',
        'barcode',
        'size',
        'color',
        'cost_price',
        'price',
        'stock_quantity',
        'min_stock',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'cost_price' => 'decimal:2',
            'price' => 'decimal:2',
            'stock_quantity' => 'integer',
            'min_stock' => 'integer',
        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}
