<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\RightsRequest;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function rightsRequests(): HasMany
    {
        return $this->hasMany(RightsRequest::class);
    }

    // Role check methods
  public function isDepartmentHead()
{
    return $this->role === 'department_head';
}

public function isFinanceHead()
{
    return $this->role === 'finance_head';
}

public function isAdmin()
{
    return $this->role === 'admin';
}
}