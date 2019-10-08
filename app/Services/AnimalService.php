<?php

namespace App\Services;

class AnimalService
{
    /**
     * 
     */
    public function filterAnimals($filters, $query)
    {

        // 篩選欄位條件
        if (isset($filters)) {
            $filtersArray = explode(',', $filters);
            foreach ($filtersArray as $key => $filter) {
                list($criteria, $value) = explode(':', $filter);
                $query->where($criteria, $value);
            }
        }

        return $query;
    }
    
    /**
     * 
     */
    public function sortAnimals($sorts, $query)
    {
        if (isset($sorts)) {
            $sortArray = explode(',', $sorts);
            foreach ($sortArray as $key => $sort) {
                list($criteria, $value) = explode(':', $sort);
                if ($value == 'asc' || $value == 'desc') {
                    $query->orderBy($criteria, $value);
                }
            }
        } else {
            $query->orderBy('id', 'asc');
        }

        return $query;
    }
}

