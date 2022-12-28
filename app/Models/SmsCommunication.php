<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsCommunication extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'receiver_id');
    }

    public function adminuser(){
        return $this->belongsTo(AdminUser::class,'sender_id');
    }
}
