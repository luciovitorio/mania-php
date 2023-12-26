<?php

namespace App\Enums;

enum ClientCollectionFrequencyEnum: string
{
    case Semanal   = 'semanal';
    case Quinzenal = 'quinzenal';
    case mensal    = 'mensal';
    case avulso    = 'avulso';
}
