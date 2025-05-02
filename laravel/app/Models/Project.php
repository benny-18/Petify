<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'template_id',
        'title',
        'description',
        'pet_name',
        'sex',
        'age',
        'breed',
        'contact_person',
        'contact_number',
        'pet_description',
        'reward'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // proj belong to user
    }
}
