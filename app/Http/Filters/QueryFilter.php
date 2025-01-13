<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $builder;

    protected $request;

    protected $sortable = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        // iterating over all the query string parameters
        foreach ($this->request->all() as $key => $value)
        {
            if(method_exists($this, $key)) {
                $this->$key($value);
            }
        }

        return  $builder;
    }

    /*
     * Sort term:
     *   ?sort=columnName
     *      or
     *   ?sort=-columnName
     * */
    protected function filter($array)
    {
        foreach ($array as $key => $value) {
            if(method_exists($this, $key)) {
                $this->$key($value);
            }
        }
        return  $this->builder;
    }

    protected function sort($value)
    {
        $sortAttrs = explode(',', $value);

        foreach ($sortAttrs as $sortAttr) {
            $upOrDown = 'asc';

            if(strpos($sortAttr, '-') === 0) {

                $upOrDown = 'desc';
                $sortAttr = substr($sortAttr, 1);
            }

            if(!in_array($sortAttr, $this->sortable)) {
                continue;
            }
            $this->builder->orderBy($sortAttr, $upOrDown);

        }

    }
}
