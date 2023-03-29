<?php

namespace App\Models;

use App\ValueObjects\User\Email;
use App\ValueObjects\User\Id;
use App\ValueObjects\User\Password;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * ############################################
 * Fields which use mutators|accessors laravel:
 * id: mutator
 * email : mutator
 * password: mutator
 * ############################################
 *
 * @property string $id
 * @property string $login
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $lastName
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 *
 * @author <Mikhail Selyatin>
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /** @var string */
    protected $keyType = "string";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'login',
        'name',
        'email',
        'password',
        'last_name'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Mutator
     *
     * @return Attribute
     */
    protected function id(): Attribute
    {
        return Attribute::make(
            set: function (Id|string $value) {
                return $value instanceof Id ? $value->getValue() : $value;
            }
        );
    }

    /**
     * Mutator
     *
     * @return Attribute
     */
    protected function email(): Attribute
    {
        return Attribute::make(
            set: function (Email|string $value) {
                return $value instanceof Email ? $value->getValue() : $value;
            }
        );
    }

    /**
     * Mutator
     *
     * @return Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: function (Password|string $value) {
                return $value instanceof Password ? $value->getValue() : $value;
            }
        );
    }
}
