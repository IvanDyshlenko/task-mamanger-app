<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ["username", "email", "description", "is_done", "id"];

    protected $hidden = ["created_at", "updated_at"];

    protected $primaryKey = "id";

    protected $keyType = 'string';
}
