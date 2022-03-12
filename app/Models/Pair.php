<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pair extends Model
{
    use HasFactory;

    protected $fillable = ['pairtype_id', 'name', 'base', 'symbol'];

    public function pairtype()
    {
        return $this->belongsTo(Pairtype::class);
    }


}
