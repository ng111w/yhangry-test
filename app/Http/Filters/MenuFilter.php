<?php

namespace App\Http\Filters;

class MenuFilter extends QueryFilter
{
    protected $sortable = [
        'number_of_orders'
    ];

    /*
     * Search term: ?filter[name]=*Christ*
     * */
    public function name($value)
    {
        $likeString = str_replace('*', '%', $value);
        return $this->builder->where('name', 'like', $likeString);
    }

    /*
     * Search term: ?filter[is_halal]=1
     * */
    public function is_halal($value)
    {
        return $this->builder->where('is_halal', $value);
    }


    /*
     * Search terms:
     *  - ?filter[createdAt]=2022-02-01
     *  - ?filter[createdAt]=2022-02-01,2022-04-01
     * */
    public function createdAt($value)
    {
        $dates = explode(',', $value);

        if(count($dates) > 1) {

            return $this->builder->whereBetween('created_at', $dates);
        }
        return $this->builder->whereDate('created_at', $dates);
    }

    /*
     * Search term: ?filter[id]=1
     * */
    public function id($value)
    {
        return $this->builder->whereIn('id', explode(',', $value));
    }

}
