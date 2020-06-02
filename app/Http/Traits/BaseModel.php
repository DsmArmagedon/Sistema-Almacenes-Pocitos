<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use DateTime;

/**
 * Trait BaseModel
 * @author Daniel Roberto Sanchez Martinez <daniel.r.sanchez.martinez@gmail.com>
 */
trait BaseModel {

    /**
     * Scope que permite realizar busqueda con LIKE por columna
     * @param Builder $query
     * @param string $field
     * @param string $term
     * @return Builder $query
     */
    public function scopeLike($query, $field, $term) {
        return $query->where($field, 'LIKE', '%' . $term . '%');
    }

    /**
     * Scope que permite realizar un filtro de acuerdo al estado del recurso.
     * @param Builder $query
     * @param string $status
     * @return Builder $query
     */
    public function scopeStatus($query, $status) {
        return $query->where('status', $status);
    }

    /**
     * Permite seleccionar las columnas que se desean enviar al cliente.
     * 
     * @param Builder $query
     * @param string $paramsSelect
     * @return Builder $query
     */
    public function scopeFields($query, $paramsSelect) {
        if (!is_null($paramsSelect)) {
            $columns = explode(',', $paramsSelect);
            $columnsFilter = array_intersect($columns, $this->fillable);
            if (count($this::$keysTable) > 0) {
                $query = $query->select(array_merge($columnsFilter, $this::$keysTable));
            }
        }
        return $query;
    }

    /**
     * Permite cargar un recurso adicional al principal.
     * 
     * @param Builder $query
     * @param Model $model
     * @param string $relation
     * @param string $select
     * @return Builder $query
     */
    public function scopeWithLoad($query, $model, $relation, $select) {
        return $query->with([$relation => function ($q) use ($select, $model) {
                        return $model->scopeFields($q, $select);
                    }]);
    }

    /**
     * Permite realizar busqueda y realizar carga de los recursos adicionales al principal.
     * 
     * @param Builder $query
     * @param Model $model
     * @param string $relation
     * @param Illuminate\Http\Requests $request
     * @param string $selectOption
     * @return Builder $query
     */
    public function scopeWhereHasWithLoad($query, $model, $relation, $request, $selectOption) {
        return $query->whereHas($relation, function($q) use ($request, $model) {
                    return $model->scopeSearch($q, $request);
                })->withLoad($model, $relation, $selectOption);
    }

    public function isUpdatedOrDeleted() {
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $date = DateTime::createFromFormat('d-m-Y', $this->date);
        $yearValue = $date->format('Y');
        $monthValue = $date->format('m');
        if ($year === $yearValue && $month === $monthValue) {
            return true;
        }
        return false;
    }

    public function scopeDateRange($query, $requestDateInitial, $requestDateFinal) {
        if (!is_null($requestDateInitial) && !is_null($requestDateFinal)) {
            $dateInitial = DateTime::createFromFormat('d-m-Y', $requestDateInitial);
            $dateInitial = $dateInitial->format('Y-m-d');
            $dateFinal = DateTime::createFromFormat('d-m-Y', $requestDateFinal);
            $dateFinal = $dateFinal->format('Y-m-d');
            return $query->whereBetween('date', [$dateInitial, $dateFinal]);
        }
        return $query;
    }

}
