<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockHistorial extends Model
{
    use HasFactory;

    protected $table = 'stock_historial';
    protected $fillable = ['artificio_id', 'cantidad'];

    public function artificio()
    {
        return $this->belongsTo(Artificio::class, 'artificio_id');
    }
}
