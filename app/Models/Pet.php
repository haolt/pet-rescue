<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar',
        'name',
        'age',
        'gender',
        'type_delivery',
        'type',
        'breed',
        'color',
        'status',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
