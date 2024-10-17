<?php

namespace App\Helpers;

class DashboardHelper
{
    public function formatDatePTBR(string $date, string $format = 'd/m/Y H:i:s'): string
    {
        $dateTime = new \DateTime($date);
        return $dateTime->format($format);
    }

    public function convertTypeToString($type): string {

        $typeString = [];

        switch ($type) {
            case 'C':
                $typeString = 'Contratado';
                break;
            case 'D':
                $typeString = 'Demitido';
                break;
            case 'E':
                $typeString = 'Estagiário';
                break;
            case 'A':
                $typeString = 'Afastado';
                break;
            case 'F':
                $typeString = 'Férias';
                break;
            default:
                $typeString = 'Contratado';
                break;
        }

        return $typeString;
    }
}
