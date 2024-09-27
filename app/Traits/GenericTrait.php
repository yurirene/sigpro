<?php

namespace App\Traits;

use App\Models\User;
use App\Scopes\UserScope;
use App\Services\AuditableService;
use App\Services\AuditService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait GenericTrait
{
   /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope);

        //-----GERA O UUID PARA AS TABELAS-----

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();

                $model->user_id = auth()->id();
            }
        });


        // create a event to happen on updating
        static::updating(function ($table) {
            AuditableService::store(
                $table,
                Auth::id() ?? null,
                'updating'
            );
        });

        // create a event to happen on saving
        static::created(function ($table) {
            AuditableService::store(
                $table,
                Auth::id() ?? null,
                'created'
            );
        });

        // create a event to happen on deleting
        static::deleting(function ($table) {
            AuditableService::store(
                $table,
                Auth::id() ?? null,
                'deleting'
            );
        });
    }

   /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

   /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
