<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait CommonUserStamp
{
    public static function bootCommonUserStamp()
    {
        static::creating(function ($model) {
            $model->created_by = Auth::id() ?? null;
            $model->updated_by = Auth::id() ?? null;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id() ?? null;
        });

        static::deleting(function ($model) {
            if (method_exists($model, 'runSoftDelete')) {
                $model->deleted_by = Auth::id() ?? null;
                $model->save();
            }
        });
    }
}
