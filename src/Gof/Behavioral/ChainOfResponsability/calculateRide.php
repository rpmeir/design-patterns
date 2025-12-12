<?php

declare(strict_types=1);

namespace Src\Gof\Behavioral\ChainOfResponsability;

function calc ($movArray)
{
    $result = 0;
    foreach ($movArray as $mov) {
        if ($mov['dist'] != null && is_numeric($mov['dist']) && $mov['dist'] > 0) {
            $date = \date_create($mov['ds']);
            if ($date != null && $date instanceof \DateTime && $date != false)
            {
                // overnight
                if($date->format('H:i') >= '22:00' || $date->format('H:i') <= '06:00')
                {
                    // if day is not sunday
                    if($date->format('N') != 7)
                    {
                        $result += $mov['dist'] * 3.90;
                    }
                    else
                    {
                        $result += $mov['dist'] * 5.0;
                    }
                } else {
                    // daytime
                    if($date->format('N') == 7)
                    {
                        $result += $mov['dist'] * 2.9;
                    }
                    else
                    {
                        $result += $mov['dist'] * 2.10;
                    }
                }
            } else {
                return -2;
            }
        } else {
            return -1;
        }
    }
    if ($result < 10) {
        return 10;
    } else {
        return $result;
    }
}
