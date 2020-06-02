<?php

namespace App\Http\Controllers\InputOutput;

use App\Events\InputOutputCreatedUpdatedDeleted;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\InputOutputRequest;
use App\Models\Code;
use App\Models\InputOutput;
use App\Repositories\InputOutputRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InputOutputController extends Controller {

    protected $inputOutputR;
    protected $productR;

    public function __construct(InputOutputRepository $inputOutputR, ProductRepository $productR) {
        $this->inputOutputR = $inputOutputR;
        $this->productR = $productR;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $inputsOutputs = $this->inputOutputR->getListInputOutput($request);
        $products = $this->productR->getListProductCreates();
        if ($request->ajax()) {
            $view = view('inputs-outputs.table-inputs-outputs', compact('inputsOutputs'))->render();
            return response()->json($view);
        }
        return view('inputs-outputs.index')->with('inputsOutputs', $inputsOutputs)->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $code = Code::getCode(Code::INPUT_OUTPUT);
        return response()->json($code);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InputOutputRequest $request) {
        $objectCode = Code::getObjectCode(Code::INPUT_OUTPUT);
        list($inputOutput, $type) = $this->inputOutputR->fillModelStore($request, $objectCode->inputs_outputs);
        try {
            DB::beginTransaction();
            $inputOutput->save();
            $objectCode->save();
            $product = event(new InputOutputCreatedUpdatedDeleted($inputOutput, InputOutputRepository::CREATED));
            DB::commit();
            if ($request->ajax()) {
                return response()->json(['message' => $type . ' creada correctamente', 'product' => reset($product)]);
            }
            return redirect()->route('inputs-outputs.index');
        } catch (\Exception $e) {
            throw new CustomException('Error al crear la ' . $type, 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $inputOutput = $this->inputOutputR->getShowInputOutput($id);
        return response()->json($inputOutput);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InputOutputRequest $request, $id) {
        list($inputOutput, $type) = $this->inputOutputR->fillModelUpdate($request, $id);
        try {
            DB::beginTransaction();
            $product = event(new InputOutputCreatedUpdatedDeleted($inputOutput, InputOutputRepository::UPDATED));
            $inputOutput->save();
            DB::commit();
            if ($request->ajax()) {
                return response()->json(['message' => $type . ' actualizada correctamente', 'product' => reset($product)]);
            }
            return redirect()->route('inputs-outputs.index');
        } catch (\Exception $e) {
            throw new CustomException('Error al actualizar la ' . $type, 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        $inputOutput = $this->inputOutputR->findOrFail($id);
        $product = $this->productR->findOrFail($inputOutput->product_code);
        $type = ($inputOutput->type === InputOutput::INPUT) ? $this->inputOutputR::MESSAGE_INPUT : $this->inputOutputR::MESSAGE_OUTPUT;
        if ($product->stock <= $inputOutput->quantity && $inputOutput->type === InputOutput::INPUT) {
            return response()->json(['errors' => 'Falta disponibilidad en inventario del producto ' . $product->description], 422);
        }
        try {
            $inputOutput->delete();
            event(new InputOutputCreatedUpdatedDeleted($inputOutput, InputOutputRepository::DELETED));
            if ($request->ajax()) {
                return response()->json(['message' => $type . ' eliminada correctamente', 'product' => reset($product)]);
            }
            return redirect()->route('inputs-outputs.index');
        } catch (\Exception $e) {
            throw new CustomException('Error al eliminar la ' . $type, 400);
        }
    }

}
