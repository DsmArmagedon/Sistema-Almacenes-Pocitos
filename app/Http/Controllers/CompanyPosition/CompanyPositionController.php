<?php

namespace App\Http\Controllers\CompanyPosition;

use Illuminate\Http\Request;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyPositionRequest;
use App\Repositories\CompanyPositionRepository;

class CompanyPositionController extends Controller {

    protected $companyPositionR;

    public function __construct(CompanyPositionRepository $companyPositionR) {
        $this->companyPositionR = $companyPositionR;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $companyPositions = $this->companyPositionR->getListCompanyPosition($request);
        if ($request->ajax()) {
            $view = view('company-positions.table-company-positions',compact('companyPositions'))->render();
            return response()->json($view);
        }
        return view('company-positions.index')->with('companyPositions', $companyPositions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyPositionRequest $request) {
        try {
            $companyPosition = $this->companyPositionR->fillModel($request);
            $companyPosition->save();
            if ($request->ajax()) {
                return response()->json(['message' => 'CARGO creado correctamente!']);
            }
            return redirect()->route('company-positions.index');
        } catch (\Exception $e) {
            throw new CustomException('Error al crear el CARGO', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $companyPosition = $this->companyPositionR->getShowUser($id);
        return response()->json($companyPosition);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $companyPosition = $this->companyPositionR->getShowUser($id);
        return response()->json($companyPosition);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {
            $companyPosition = $this->companyPositionR->fillModel($request, $id);
            $companyPosition->save();
            if ($request->ajax()) {
                return response()->json(['message' => 'CARGO actualizado correctamente!']);
            }
            return redirect()->route('company-positions.index');
        } catch (\Exception $e) {
            throw new CustomException('Error al actualizar el CARGO', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $companyPosition = $this->companyPositionR->findOrFail($id);
            $companyPosition->delete();
            return response()->json(['message' => 'CARGO eliminado correctamente!']);
        } catch (\Exception $e) {
            throw new CustomException('Error al eliminar el CARGO', 400);
        }
    }

}
