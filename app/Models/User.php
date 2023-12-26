<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserProfileEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'branch_id',
        'cpf',
        'date_of_birth',
        'profile',
        'percent',
        'is_active'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_active'         => 'boolean',
        //        'profile'           => UserProfileEnum::class
    ];

    protected function profile(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => ucfirst($value)
        );
    }

    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                if (strlen($value) === 11) {
                    return substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr(
                            $value,
                            6,
                            3
                        ) . '-' . substr($value, 9, 2);
                }
                return $value;
            }
        );
    }

    protected function isActive(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => $value == 'on' ? 1 : 0
        );
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'user_id', 'id');
    }
}
