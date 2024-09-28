<?php

namespace App\Enum\MorphImage;

enum MorphImageImageTypeEnum: string
{
        case COVER = 'COVER';
        case INSIDE = 'INSIDE';
        case FEATURED = 'FEATURED';
}
