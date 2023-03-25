<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => (empty($value)) ? Str::slug($this->title) : Str::slug($value)
        );
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}