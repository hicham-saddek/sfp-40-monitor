<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Milebits\Eloquent\Filters\Concerns\ActiveField;
use Milebits\Eloquent\Filters\Concerns\DescriptionField;
use Milebits\Eloquent\Filters\Concerns\SlugField;
use Milebits\Eloquent\Filters\Concerns\TitleField;

/**
 *   Channel class
 * @property string $opc
 * @property int $clock
 * @property bool $active
 */
class Channel extends Model
{
    use SoftDeletes, HasFactory;
    use SlugField, TitleField, DescriptionField, ActiveField;

    const AUTO_SLUG = true;
    const ACTIVE_COLUMN_ENABLED = false;

    protected $fillable = [
        '3d_x', '3d_y', '3d_z', 'key', 'opc', 'clock'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variables(): HasMany
    {
        return $this->hasMany(Variable::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function data(): HasManyThrough
    {
        return $this->hasManyThrough(Data::class, Variable::class);
    }

    public function subscriptions(bool $state = true): HasMany
    {
        return $this->variables()->where(function (Builder $builder) use ($state) {
            return $builder->where('subscription_status', $state);
        });
    }
}
