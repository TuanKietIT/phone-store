<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wiki extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'image',
        'status',
        'jobwiki_id'
    ];
    public function jobWiki(){
        return $this->belongsTo(Jobwiki::class,'jobwiki_id');
    }
}
