<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'branch_id',
        'client_id',
        'cep',
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
    ];

    protected function cep(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                return substr($value, 0, 5) . '-' . substr($value, 5);
            },
            set: function (string $value) {
                return strtolower(str_replace('-', '', $value));
            }
        );
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
