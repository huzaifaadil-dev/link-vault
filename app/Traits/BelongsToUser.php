<?php

namespace App\Traits;

use App\Models\Scopes\UserScope;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

trait BelongsToUser
{
    protected static function bootBelongsToUser(): void
    {
        static::addGlobalScope(new UserScope);

        static::creating(function (Model $model): void {
            if ($model->getAttribute('user_id') !== null) {
                return;
            }

            if ($userId = Auth::id()) {
                $model->setAttribute('user_id', $userId);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
