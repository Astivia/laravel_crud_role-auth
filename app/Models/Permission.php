<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['name','description'];

    //foreign key to roles_has_permission table
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_has_permission', 'id_permission', 'id_role')
                    ->withTimestamps();
    }

}
