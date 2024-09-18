<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'country',
        'branch',
        'address'
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
