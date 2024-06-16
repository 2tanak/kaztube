<?php

namespace App\Models;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

/**
 * User
 *
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<array-key, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<array-key, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<array-key, mixed>
     */
    protected $casts = ['email_verified_at' => 'datetime'];

    /**
     * The attributes that should be cast.
     *
     * @return HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class, 'author_id');
    }

    /**
     * @var User
     */
    protected static User $current;

    /**
     * @psalm-suppress MoreSpecificReturnType
     * @psalm-suppress RedundantPropertyInitializationCheck
     * @psalm-suppress RedundantCondition
     * @psalm-suppress PropertyTypeCoercion
     * @psalm-suppress TypeDoesNotContainType
     * @psalm-suppress LessSpecificReturnStatement
     *
     * @return self
     *
     * phpcs:disable Squiz.Commenting.FunctionCommentThrowTag.Missing
     */
    public static function current(): User
    {
        if (!isset(self::$current)) {
            $current = Auth::user();

            if (!$current) {
                throw new AuthorizationException('Пользователь не авторизован');
            }

            self::$current ??= $current;
        }

        return self::$current;
    }
}
