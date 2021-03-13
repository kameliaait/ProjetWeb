<?php

namespace App\Models;

use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Formation extends Model
{
    use HasFactory;
    use Authorizable;
    protected $fillable =['title', 'description'];
    protected $appends = ['permition'];
    //this function is used to add the user id automatically when we create the formztion 
    protected static function booted(){
        static::creating(
            function ($formation){
                $formation->user_id= auth()->id();
            }
     );
    }
    public function getPermitionAttribute(){
        return $this->can('permition-formation',$this);
    }
   
    public function episodes(){
        return $this->hasMany(Episode::class);

    }
    public function user(){
            return $this->belongsTo(User::class);
        
    }
}
