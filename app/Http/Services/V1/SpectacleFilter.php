<?php

namespace App\Http\Services\V1;

use Illuminate\http\Request;

class SpectacleFilter {

    protected $safeParams = [
        'titre' => ['eq'],
        'date' => ['eq'],
        'description' => ['eq'],
        'is_premium' => ['eq']
    ];

    protected $columnMap = [
        'billet' => ['eq'],
    ];

    protected $operatorMap = [
        'eq' => '=',
        'ne' => '!=',
        'gt' => '>',
        'gte' => '>=',
        'lt' => '<',
        'lte' => '<=',
    ];

    public function transform(Request $request) {
        $finalQuery = [];

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                   $finalQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $finalQuery;
    }

}