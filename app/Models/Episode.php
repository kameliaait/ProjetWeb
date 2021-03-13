<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'video_url', 'formation_id'];
    public function formation(){
        return $this->belongsTo(Formation::class);
    }
}
