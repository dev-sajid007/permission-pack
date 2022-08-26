<?php

namespace DevSajid\Permission\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
  

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    //For Authorization
    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }
}
