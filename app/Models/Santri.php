<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Santri extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        if (isset($filters['search']) ? $filters['search'] : false) {
            return $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('address', 'like', '%' . $filters['search'] . '%');
        }
    }
}