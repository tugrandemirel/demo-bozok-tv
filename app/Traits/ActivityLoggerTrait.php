<?php

namespace App\Traits;

use App\Events\UserActivityLogged;
use App\Models\ActivityType;
use App\Models\UserActivity;

trait ActivityLoggerTrait
{
    public function logActivity($activityTypeName, $description, $activityable): void
    {

        $userId = auth()->id(); // Kullanıcı ID'si

        if (!$userId) {
            // Eğer kullanıcı girişi yapılmamışsa, hata mesajı verin
            throw new \Exception('Kullanıcı girişi yapılmamış.');
        }
        $activityType = ActivityType::query()
            ->firstOrCreate(['name' => $activityTypeName]);

        $activity = UserActivity::query()->create([
            'user_id' => $userId, // Authenticated user id or current model's id
            'activity_type_id' => $activityType->id,
            'activityable_id' => $activityable->id,
            'activityable_type' => get_class($activityable),
            'description' => $description,
        ]);

        // Aktivite Event'ini tetikle
        event(new UserActivityLogged($activity));
    }
}
