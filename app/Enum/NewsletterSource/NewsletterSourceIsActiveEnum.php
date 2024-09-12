<?php

namespace App\Enum\NewsletterSource;

enum NewsletterSourceIsActiveEnum: int
{
    case PASSIVE = 0;
    case ACTIVE = 1;
}
