<?php

namespace App\Helpers;

class Helpers
{
    public static function isScheduleExist($day, $jam, $groupedJadwals)
    {
        foreach ($groupedJadwals[$day] as $jadwal) {
            if ($jadwal->jam_masuk == substr($jam, 0, 8)) {
                return true;
            }
        }
        return false;
    }
}
