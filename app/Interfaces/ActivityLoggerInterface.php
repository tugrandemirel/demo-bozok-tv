<?php

namespace App\Interfaces;

interface ActivityLoggerInterface
{
    public function logActivity($activityTypeName, $description, $activityable);

}
