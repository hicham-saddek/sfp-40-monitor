<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Data extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = ['value', 'collected_at'];

    protected $casts = [
        'value' => 'bool',
        'collected_at' => 'datetime',
    ];

    public function variable(): BelongsTo
    {
        return $this->belongsTo(Variable::class);
    }
}
