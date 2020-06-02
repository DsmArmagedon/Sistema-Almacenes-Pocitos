<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    protected $productR;

    public function __construct(ProductRepository $productR)
    {
        $this->productR = $productR;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->productR->getListProduct($request);
        if($request->ajax())
        {
            $view = view('products.table-products', compact('products'))->render();
            return response()->json($view);
        }
        return view('products.index')->with('products' ,$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = $this->productR->fillModel($request);
            $product->save();
            if($request->ajax())
            {
                return response()->json(['message' => 'PRODUCTO creado correctamente!']);
            }
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            throw new CustomException('Error al crear el PRODUCTO', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productR->getShowProduct($id); 
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productR->getShowProduct($id); 
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $product = $this->productR->fillModel($request, $id);
            $product->save();
            if($request->ajax())
            {
                return response()->json(['message' => 'PRODUCTO actualizado correctamente!']);
            }
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            throw new CustomException('Error al actualizar el PRODUCTO', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = $this->productR->findOrFail($id);
            $product->delete();
            return response()->json(['message' => 'PRODUCTO eliminado correctamente!']);
        } catch (\Exception $e) {
            throw new CustomException('Error al eliminar el PRODUCTO', 400);
        }
    }
}
