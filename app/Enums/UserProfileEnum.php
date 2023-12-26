<?php

namespace App\Enums;

enum UserProfileEnum: string
{
    case Administrador = 'administrador';
    case Passadeira    = 'passadeira';
    case Supervisao    = 'supervisao';
}
