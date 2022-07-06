<?php


namespace App\Http\Controllers\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait DataProvider
{
    protected function prepareModel(Request $request, $query, bool $isJoin = false)
    {
        $filter = $request->filter;
        $sort = (string)$request->sort;



        if ($isJoin && $query instanceof \Illuminate\Database\Query\Builder) {
            $columns = [];
            foreach ($query->columns as $column) {
                $parts = explode(' ', $column);
                $columns[$parts[count($parts) - 1]] = $parts[0];
            }
        }




        if (is_array($filter)) {
            foreach($filter as $filterKey => $param) {
                $col = $isJoin ?  $columns[$filterKey] : $filterKey;

                foreach($param as $key => $value) {
                    if ($key === 'like') {
                        $value = "%$value%";
                    }
                    $query->where($col, $key, $value);
                }
            }
        }

        if ($sort !== '') {
            if ($sort[0] === '-') {
                $sort = substr($sort, 1);
                $query->orderByDesc($sort);
            } else {
                $query->orderBy($sort);
            }
        }
        return $query;
    }
}