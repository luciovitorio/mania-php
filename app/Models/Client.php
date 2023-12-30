<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'branch_id',
        'plan_id',
        'name',
        'cpf',
        'rg',
        'date_of_birth',
        'email',
        'home_phone',
        'cell_phone',
        'collection_frequency',
        'collection_day',
        'collection_time',
        'delivery_day',
        'delivery_time',
        'collection_start',
        'description',
        'delivery_fee',
        'delivery_amount',
        'due_date',
        'is_active'
    ];

    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($value !== null && strlen($value) === 11) {
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

    protected function deliveryAmount(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($value !== null) {
                    return number_format($value, 2, ',', '');
                }
                return null;
            },
            set: function ($value) {
                if ($value !== null) {
                    return number_format(
                        (float)str_replace(',', '.', str_replace('.', '', $value)),
                        2,
                        '.',
                        ''
                    );
                }
                return null;
            }
        );
    }

    protected function isActive(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => $value == 'on' ? 1 : 0
        );
    }

    protected function deliveryFee(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => $value == 'on' ? 1 : 0
        );
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
