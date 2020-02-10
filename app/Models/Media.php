<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'name', 'mime_type', 'url', 'created_id'
    ];

    public function getHashIdAttribute()
    {
        $hashIds = new Hashids();
        return $hashIds->encode($this->id);
    }
}
