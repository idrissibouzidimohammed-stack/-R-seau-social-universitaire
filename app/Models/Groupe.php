<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Groupe extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'createur_id'];

    public function createur()
    {
        return $this->belongsTo(User::class, 'createur_id');
    }

    public function membres()
    {
        return $this->belongsToMany(User::class, 'groupe_user')
            ->withPivot('role_dans_groupe')
            ->withTimestamps();
    }
}