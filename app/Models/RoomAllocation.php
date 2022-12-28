<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAllocation extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'tenant_id');
    }
    public function room(){
        return $this->belongsTo(Room::class,'room_id');
    }

    public function adminuser(){
        return $this->belongsTo(AdminUser::class,'admin_id');
    }
}
