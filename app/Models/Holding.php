<?php

namespace App\Models;

use App\Traits\CommonUserStamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Holding extends Model
{
    use SoftDeletes, CommonUserStamp;

    protected $primaryKey = "id";
    protected $table = "holdings";

    protected $fillable = [
        'client_id',
        'sector',
        'stock_code',
        'quantity',
        'buy_price',
        'current_price',
        'buy_date',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
