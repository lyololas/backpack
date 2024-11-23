<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Projects extends Model
{
    use CrudTrait;
    use hasFactory;
    protected $fillable = [
        'type',
        'title',
        'description',
        'image',
        'docs',
    ];
    public function user()
        {
            return $this->belongsTo(User::class);
        }
}
