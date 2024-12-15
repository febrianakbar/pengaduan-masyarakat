<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    protected $fillable = [
        'user_id', 'description', 'type', 'province', 'regency',
        'subdistrict', 'village', 'voting', 'viewers', 'image', 'statement'
    ];

    protected $casts = [
        'voting' => 'array',
    ];

    /**
     * Relasi ke model User
     */
    public function user()
{
    return $this->belongsTo(User::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}


public function votes()
{
    return $this->hasMany(Vote::class);
}

}
