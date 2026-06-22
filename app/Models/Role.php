<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','is_active'];

    //foreign key to user_has_roles table
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_roles', 'id_role', 'id_user')
                    ->withTimestamps();
    }
    //foreign key to roles_has_permission table
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_has_permission', 'id_role', 'id_permission')
                    ->withTimestamps();
    }

    //check if role has a specific permission
    public function hasPermission($permission)
    {
        return $this->permissions()->where('name', $permission)->exists();
    }
    
}
