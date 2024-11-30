<?php

namespace App\Enums;

enum OrderStatusEnum: string
{
    case Pending = 'pending';
    case Preparing = 'preparing';
    case Transport = 'transport';
    case Concluded = 'concluded';
    case Cancelled = 'cancelled';
}
