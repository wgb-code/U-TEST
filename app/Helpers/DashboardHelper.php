<?php

namespace App\Helpers;

class DashboardHelper
{
    public function formatDatePTBR(string $date, string $format = 'd/m/Y H:i:s'): string
    {
        $dateTime = new \DateTime($date);
        return $dateTime->format($format);
    }
}
