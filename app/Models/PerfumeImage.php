<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerfumeImage extends Model
{
    protected $fillable = ['perfume_id', 'image_path', 'sort_order'];

    public function perfume()
    {
        return $this->belongsTo(Perfume::class);
    }
}
