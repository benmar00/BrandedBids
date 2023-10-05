<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reply()
    {
        return $this->belongsTo(Comment::class,'reply_id');
    }
    public function flags()
    {
        return $this->hasMany(Flagged::class);
    }
    public function flagged()
    {
        return $this->hasMany(Flagged::class)->where('user_id',Auth::user()->id);
    }
    public function liked()
    {
        return $this->hasMany(Like::class)->where('user_id',Auth::user()->id);
    }

    public function like()
    {
        return $this->hasMany(Like::class);
    }
}
