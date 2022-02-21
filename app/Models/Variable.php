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
 * @property Channel $channel
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
        return $this->update(['subscription_state' => true]);
    }

    public function unsubscribe(): bool
    {
        return $this->update(['subscription_state' => false]);
    }

    public function toggleSubscription(): bool
    {
        return $this->update(['subscription_state' => ! $this->subscriptionStatus()]);
    }

    #[Pure] public function isSubscribedTo(): bool
    {
        return $this->subscriptionStatus();
    }

    #[Pure] public function isNotSubscribedTo(): bool
    {
        return ! $this->isSubscribedTo();
    }

    public function subscriptionStatus(): bool
    {
        return $this->subscription_status;
    }
}
