<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['player_id', 'confirmed'];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}