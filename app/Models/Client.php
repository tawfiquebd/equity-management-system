<?php

namespace App\Models;

use App\Traits\CommonUserStamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes, CommonUserStamp;

    protected $primaryKey = "id";
    protected $table = "clients";

    protected $fillable = [
        "name",
        "email",
        "phone",
        "created_by",
        "updated_by",
        "deleted_by",
    ];
}
