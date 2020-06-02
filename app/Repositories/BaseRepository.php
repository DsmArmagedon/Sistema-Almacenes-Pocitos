<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Utils\SimpleImage;
abstract class BaseRepository
{
    const ENABLED = 'enabled';
    const DISABLED = 'disabled';
    const LOAD = 'load';
    const NOT_LOAD = 'notLoad';
    const STATUS_FALSE = '0';
    const STATUS_TRUE = '1';

    protected $model;
    abstract public function getModel();

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate($offset = 25)
    {
        return $this->model->paginate($offset);
    }

    public function count()
    {
        return $this->model->count();
    }

    public function findWhere($column, $id)
    {
        return $this->model->findWhere($column, $id);
    }

    public function destroy($array)
    {
        return $this->model->destroy($array);
    }

    public function where($column, $id)
    {
        return $this->model->where($column, $id);
    }

    public function create($data)
    {
        return $this->model->create($data->toArray());
    }

    /**
     * Permite calcular el total de la venta
     *
     * @param array $products
     * @return float
     */
    public function calculateTotalSale ($products) {
        $total = 0;
        foreach($products as $product) {
            $total += $product['price_unit'] * $product['quantity'];  
        }
        return $total;
    }
    /**
     * Permite calcular el total de la compra
     *
     * @param array $products
     * @return float
     */
    public function calculateTotalPurchase ($products) {
        $total = 0;
        foreach($products as $product) {
            $total += $product['import'];  
        }
        return $total;
    }
    /**
     * Permite cambiar las silabas para un mejor control del slug.
     * @param string $name
     * @return string
     */
    public function str_replace_name($name)
    {
        return str_replace([' ','á','é','í','ó','ú'],['_','a','e','i','o','u'], mb_strtolower($name));
    }
    
    public function saveImage($image, $model, $folder, $name) {
        $path = public_path($folder. '/' . $name);
        $pathThumb60  = public_path('images/' . $name . '/thumb60/');
        $pathThumb150 = public_path('images/' . $name . '/thumb150/');
        if (!is_dir($folder)) {
            mkdir($folder);
        }
        if (!is_dir($path)) {
            mkdir($path);
        }
        if (!is_dir($pathThumb60)) {
            mkdir($pathThumb60);
        }
        if (!is_dir($pathThumb150)) {
            mkdir($pathThumb150);
        }
        if ($model->image == 1) {
            $fileName = $model->ci . '.' . $model->extension;
            \Storage::disk('images')->put($name.'/'.$fileName,  \File::get($image));
            $this->thumb($path, $pathThumb60, $fileName, 60);
            $this->thumb($path, $pathThumb150, $fileName, 150);
        }
    }

    public function thumb($path, $pathThumb, $fileName, $size) {
        $imageThumb = new SimpleImage();
        $imageThumb->load($path . '/' . $fileName);
        $imageThumb->resizeToHeight($size);
        $imageThumb->save($pathThumb . $fileName);
    }
    
    public function getMonthForNumber($number) {
        $months = [
            'Enero' => 1,
            'Febrero' => 2,
            'Marzo' => 3,
            'Abril' => 4,
            'Mayo' => 5,
            'Junio' => 6,
            'Julio' => 7,
            'Agosto' => 8,
            'Septiembre' => 9,
            'Octubre' => 10,
            'Noviembre' => 11,
            'Diciembre' => 12
        ];
        return array_search((integer)$number, $months);
    }
}
