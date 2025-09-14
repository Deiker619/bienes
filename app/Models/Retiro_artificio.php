<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retiro_artificio extends Model
{
    protected $fillable = ['artificio_id', 'cantidad', 'retiro_id'];
    protected $table = 'retiro_artificios';
    use HasFactory;

    public function artificio()
    {
        return $this->belongsTo(Artificio::class, 'artificio_id');
    }

    public function retiro()
    {
        return $this->belongsTo(Retiro::class, 'retiro_id');
    }
}
