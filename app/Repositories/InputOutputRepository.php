<?php

namespace App\Repositories;

use App\Models\Code;
use App\Models\InputOutput;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputOutputRepository extends BaseRepository
{
    const CREATED = 'created';
    const UPDATED = 'updated';
    const DELETED = 'deleted';
    const MESSAGE_INPUT = 'ENTRADA';
    const MESSAGE_OUTPUT = 'SALIDA';
    /**
     * Permite enviar una instancia de la clase InputOutputRepository a BaseRepository
     *
     * @return InputOutput InputOutput
     */
    public function getModel()
    {
        return new InputOutput();
    }

    /**
     * Permite crear una instancia de la clase InputOutput.
     *
     * @return InputOutput InputOutput
     */
    public function inputOutput()
    {
        $instance = new InputOutput();
        return $instance;
    }
    
    /**
     * Permite obtener la lista de entradas y salidas
     * 
     * @param Request $request
     * return Collection $inputsOutputs
     */
    public function getListInputOutput($request, $fields = null)
    {
        $inputsOutputs = $this->inputOutput();
        $inputsOutputs = $inputsOutputs->whereHasWithLoad(new Product(),'product',$request, 'description,unit');
        $inputsOutputs = $inputsOutputs->search($request)->whereIn('type',['input','output'])->orderBy('date','DESC');
        return $inputsOutputs->paginate($request->per_page ?? 15 );
    }
    public function getShowInputOutput($id) {
        return $this->inputOutput()->findOrFail($id);
    }
    /**
     * Permite llenar los datos para crear  una nueva entrada o salida
     *
     * @param Request $request
     * @param string $code
     * @return InputOutput $inputOutput
     */
    public function fillModelStore($request, $code) {
        $inputOutput = $this->inputOutput();
        $inputOutput->code = Code::getGenerateCode(Code::INPUT_OUTPUT, $code);
        $inputOutput->type = $request->type;
        $inputOutput->user_id = Auth()->id();
        $inputOutput->product_code = $request->product_code;
        return $this->fillModel($request, $inputOutput);
    }

    /**
     * Permite llenar los datos de la entrada o salida por actualizacion
     *
     * @param Request $request
     * @param string $id
     * @return InputOutput $inputOutput
     */
    public function fillModelUpdate($request, $id) {
        $inputOutput = $this->inputOutput()->findOrFail($id);
        return $this->fillModel($request, $inputOutput);
    }
    /**
     * Permite llenar los datos de la Entrada o Salida.
     * @param  Request $request
     * @param  InputOutput $inputOutput
     * @return InputOutput $inputOutput
     */
    public function fillModel($request, $inputOutput) {
        $inputOutput->fill($request->only([
            'date',
            'operation',
            'quantity'
        ]));
        $message = ($inputOutput->type === $this->inputOutput()::INPUT) ? self::MESSAGE_INPUT : self::MESSAGE_OUTPUT;
        return array($inputOutput,$message) ;
    }
}
