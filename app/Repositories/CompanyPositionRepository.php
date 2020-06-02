<?php

namespace App\Repositories;

use App\Models\CompanyPosition;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
class CompanyPositionRepository extends BaseRepository
{
    /**
     * Permite enviar una instancia de la clase CompanyPosition a BaseRepository
     *
     * @return CompanyPosition CompanyPosition
     */
    public function getModel()
    {
        return new CompanyPosition();
    }

    /**
     * Permite crear una instancia de la clase CompanyPosition.
     *
     * @return CompanyPosition CompanyPosition
     */
    public function companyPosition()
    {
        $instance = new CompanyPosition();
        return $instance;
    }

    /**
     * Permite obtener la lista de cargos
     * 
     * @param Request $request
     * return Collection $companyPositions
     */
    public function getListCompanyPosition($request,$fields = null)
    {
        $companyPositions = $this->companyPosition();

        $companyPositions = $companyPositions->search($request)->fields($fields)->orderBy('updated_at','DESC');
        return $companyPositions->paginate($request->per_page);
    }

    /**
     * Permite llenar los datos del Usuario.
     * @param  Request $request
     * @param  CompanyPosition $id
     * @return CompanyPosition
     */
    public function fillModel($request, $id = null) {
        $companyPosition = $this->companyPosition();
        if(!is_null($id))
        {
            $companyPosition = $companyPosition->findOrFail($id);
        }

        $companyPosition->fill($request->only([
            'name',
            'description',
            'status'
        ]));
        $companyPosition->slug = $this->str_replace_name($companyPosition->name);
        return $companyPosition;
    }
    
    /**
     * Permite obtener la lista de roles con los datos básicos id, name y que se encuentren activos
     * @param int|string $status
     * @return Collection $users
     */
    public function getListCompPositionBasic($status = null)
    {
        $companyPosition = $this->companyPosition()->fields('id,name');
        if (!is_null($status))
        {
            $companyPosition = $companyPosition->status($status);
        }
        return $companyPosition->get();
    }

    /**
     * Permite ver en detalle la informacion del CARGO.
     * 
     * @param Illuminate\Http\Request $request
     * @param int $id
     * @return Model $companyPosition
     */
    public function getShowUser($id)
    {   
        return $this->companyPosition()->findOrFail($id);
    }
}