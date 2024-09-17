<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'position',
        'dob',
        'phone',
        'address',
        'company_id'
    ];

    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class);
    }


    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }
}
