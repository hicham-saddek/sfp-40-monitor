<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;
use Milebits\Eloquent\Filters\Concerns\DescriptionField;
use Milebits\Eloquent\Filters\Concerns\EnableField;
use Milebits\Eloquent\Filters\Concerns\SlugField;

class Role extends Model
{
    use SoftDeletes, HasFactory;
    use SlugField, DescriptionField, EnableField;

    protected $fillable = ['permissions'];

    protected $casts = ['permissions' => 'json'];

    public function permissions(): Collection
    {
        return $this->permissions;
    }

    #[Pure] public function hasPermission(string $permission): bool
    {
        return $this->permissions()->has($permission);
    }
}
