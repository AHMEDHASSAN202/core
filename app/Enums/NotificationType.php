<?php

namespace Modules\Core\Enums;

enum NotificationType: int
{
    case READ = 1;

    case NOT_READ = 0;

    public function getNotificationStatus(): string
    {
        return match ($this) {
            self::READ => 'read',
            self::NOT_READ => 'not_read',
        };
    }
}
