<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Models\User;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'supply_center_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function supplyCenter()
    {
        return $this->belongsTo(SupplyCenter::class);
    }

    public function ordersPlaced()
    {
        return $this->hasMany(Order::class, 'placed_by');
    }

    public function ordersFulfilled()
    {
        return $this->hasMany(Order::class, 'fulfilled_by');
    }

    public function messages()
{
    return $this->hasMany(Message::class);
}


public function sentMessages()
    {
        return $this->hasMany(ChatMessage::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(ChatMessage::class, 'receiver_id');
    }



}



