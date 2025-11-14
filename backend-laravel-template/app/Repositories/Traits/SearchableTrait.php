<?php

// app/Repositories/SearchableTrait.php

namespace App\Repositories\Traits;

trait SearchableTrait
{
    protected $searchableFields = [
        'id' => ['field' => 'id', 'operator' => '='],
        // 'name'    => ['field' => 'name', 'operator' => 'like', ],
        // 'ids'     => ['field' => 'id', 'operator' => 'in', ],
    ];

    public function search($query, $request)
    {
        $searchableFields = $this->getSearchableFields();

        foreach ($request->all() as $key => $value) {
            if (array_key_exists($key, $searchableFields)) {
                $operator = $searchableFields[$key]['operator'];
                $field = $searchableFields[$key]['field'];

                $query = $this->applySearchCondition($query, $field, $value, $operator);
            }
        }

        return $query;
    }

    public function searchData($query, $request)
    {
        return $this->search($query, $request)->get();
    }

    protected function applySearchCondition($query, $key, $value, $operator)
    {
        switch ($operator) {
            case 'like':
                return $query->where($key, "%$value%", 'like');
            case '=':
                return $query->where($key, $value);
            case 'in':
                $items = explode(',', $value);

                return $query->whereIn($key, $items);
            default:
                return $query;
        }
    }

    protected function getSearchableFields()
    {
        return property_exists($this, 'searchableFields') ? $this->searchableFields : [];
    }
}
