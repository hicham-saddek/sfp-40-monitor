<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;
use Milebits\Eloquent\Filters\Concerns\DescriptionField;
use Milebits\Eloquent\Filters\Concerns\EnableField;
use Milebits\Eloquent\Filters\Concerns\TitleField;

/**
 *   Variable class
 *
 * @property Channel                 $channel
 * @property Collection|Data[]|array $data
 * @method static create(mixed[] $attributes)
 */
class Variable extends Model
{
    use SoftDeletes, HasFactory;
    use TitleField, DescriptionField, EnableField;

    protected $fillable = [
        'node_id', 'subscription_status',
    ];

    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    public function data(): HasMany
    {
        return $this->hasMany(Data::class);
    }

    public function subscribe(): bool
    {
        return $this->subscriptionStatus(true);
    }

    public function subscriptionStatus(bool $value = null): bool
    {
        if (is_null($value))
            return $this->subscription_status;
        $this->subscription_status = $value;
        return $this->save();
    }

    public function unsubscribe(): bool
    {
        return $this->subscriptionStatus(false);
    }

    public function toggleSubscription(): bool
    {
        return $this->subscriptionStatus(!$this->subscriptionStatus());
    }

    #[Pure] public function isNotSubscribedTo(): bool
    {
        return !$this->isSubscribedTo();
    }

    #[Pure] public function isSubscribedTo(): bool
    {
        return $this->subscriptionStatus();
    }
}
