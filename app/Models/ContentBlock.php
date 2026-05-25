<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContentBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'section',
        'payload',
        'status',
        'version',
        'published_at',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function revisions(): HasMany
    {
        return $this->hasMany(ContentRevision::class);
    }
}
