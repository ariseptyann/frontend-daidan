<?php

namespace App\Helpers;

class BaseHelper
{

    public static function pagination($current_page, $page_number, $max_counter = 4)
    {
        
        $rst = array();
        $last_page = $page_number - 2;
        $first_number = $current_page - 2;
        $last_number = $current_page + 2;

        if ($last_number < $max_counter) {
            $last_number = $max_counter;
        } else {
            $last_number = $last_number - 1;
        }

        if ($first_number > ($page_number - $max_counter)) {
            $first_number = $page_number - $max_counter;
        }
        $more_number = $last_number + 1;

        for ($i = 1; $i <= $page_number; $i++) {
            $item = array();

            if ($page_number >= $max_counter && $i <= $last_number && $i >= $first_number) {
                $item = array(
                    'offset' => ($i - 1),
                    'page' => $i,
                    'active' => false,
                );
            } else if ($more_number < $page_number && $i == $more_number) {
                $item = array(
                    'offset' => null,
                    'page' => '...',
                    'active' => false,
                );
            } else if ($i >= ($last_page - 1)) {
                $item = array(
                    'offset' => ($i - 1),
                    'page' => $i,
                    'active' => false,
                );
            }

            if ($item) {
                if ($i == $current_page) {
                    $item['active'] = true;
                }

                $rst[] = $item;
            }
        }

        return $rst;
    }
}