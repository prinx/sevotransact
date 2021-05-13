<?php

/*
 * This file is part of the Sevotransact package.
 *
 * (c) Prince Dorcis <princedorcis@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Prinx\Sevotransact\Support;

class Combination
{
    public static function combine($array, $minLength = 1, $maxLength = 2000)
    {
        $count = count($array);
        $members = pow(2, $count);
        $keys = array_keys($array);
        $return = [];

        for ($i = 0; $i < $members; $i++) {
            $b = sprintf('%0'.$count.'b', $i);

            $out = [];

            for ($j = 0; $j < $count; $j++) {
                if ($b[$j] == '1') {
                    $out[$keys[$j]] = $array[$keys[$j]];
                }
            }

            if (count($out) >= $minLength && count($out) <= $maxLength) {
                $return[] = $out;
            }
        }

        return $return;
    }
}
