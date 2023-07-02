<?php

namespace App\Traits;

use App\Models\AuditTrail;
use Illuminate\Support\Arr;

trait Auditable
{
    protected static function bootAuditable()
    {
        static::created(function ($model) {
            $model->createAuditTrail('created');
        });

        static::updated(function ($model) {
            $model->createAuditTrail('updated', $model->getChanges());
        });

        static::deleted(function ($model) {
            $model->createAuditTrail('deleted');
        });
    }

    protected function createAuditTrail($event, $changes = null)
    {
        $auditTrail = new AuditTrail([
            'user_id' => auth()->id(),
            'event' => $event,
            'auditable_type' => get_class($this),
            'auditable_id' => $this->getKey(),
            'old_values' => $changes ? json_encode(Arr::except($changes, ['updated_at'])) : null,
            'new_values' => $changes ? json_encode($this->getAttributes()) : null,
        ]);

        $this->auditTrails()->save($auditTrail);
    }

    public function auditTrails()
    {
        return $this->morphMany(AuditTrail::class, 'auditable');
    }
}
