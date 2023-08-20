<?php

if (!function_exists('getPrevious')) {
    function getPrevious($currentPage, $previouspage)
    {
        if ($currentPage <= 1)
            return  '<li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>';
        else
            return '<li class="page-item">
                        <a href="javascript:void(0);" class="page-link paginate" data-page="' . $previouspage . '">Previous</a>
                    </li>';
    }
}

if (!function_exists('getNext')) {
    function getNext($currentPage, $lastPage, $nextpage)
    {
        if ($currentPage >= $lastPage)
            return '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
        else
            return '<li class="page-item"><a class="page-link paginate" href="#" data-page="' . $nextpage . '">Next</a></li>';
    }
}

if(!function_exists('validateDate'))
{
    function validateDate($date)
    {
        $dateRequest = date('Y-m-d', strtotime($date));
        $status = "false";
        $lastDateInMonth = date('Y-m-t');
        $nextTwoMonth = date('Y-m-t', strtotime("+2 months", strtotime($lastDateInMonth)));
        if($dateRequest <= $lastDateInMonth){
            $status = false;
        }else if($dateRequest > $nextTwoMonth){
            $status = true;
        }else {
            $status = false;
        }

        return $status;
    }
}
