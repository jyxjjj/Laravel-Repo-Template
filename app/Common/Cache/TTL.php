<?php

namespace App\Common\Cache;

enum TTL: int
{
    case NONE = 0;
    case MINUTE_1 = 60;
    case MINUTE_5 = 300;
    case MINUTE_10 = 600;
    case MINUTE_15 = 900;
    case MINUTE_30 = 1800;
    case HOUR_1 = 3600;
    case HOUR_2 = 7200;
    case HOUR_12 = 43200;
    case DAY_1 = 86400;
    case DAY_2 = 172800;
    case DAY_7 = 604800;
    case DAY_30 = 2592000;
    case DAY_60 = 5184000;
    case DAY_90 = 7776000;
    case DAY_180 = 15552000;
    case DAY_365 = 31536000;
}
