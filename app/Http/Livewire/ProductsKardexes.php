<?php

namespace App\Http\Livewire;

use App\Models\Products;
use App\Models\Lote;
use Livewire\Component;

class ProductsKardexes extends Component
{

    public $products = [];
    public $allProducts = [];
    public $allLotes = [];
    public $expire = true;
    public $type = "";
    protected $prod_all = [];
    public function mount($products, $type, $expire = true)
    {
        $this->expire = $expire;
        $this->type = $type;

        if ($type == 'egress') {
            $this->allProducts = Products::where('stock', '>', 0)->orderBy('name', 'asc')->get();
            $this->allLotes = Lote::All();
        } elseif ($type == 'ingress') {

            $this->allProducts = Products::orderBy('name', 'asc')->get();
        } else {
            $this->allProducts = [];
        }

        /* products tiene la cantidad de productos agregados 
            tengan o no datos (Haber seleccionado el producto o poner una cantidad válida).
            Simplemente cargan los datos que previamente se guardaron 
            para que no haga todo el proceso de nuevo
        */
        try {
            //code...
            if (count($products) > 0) {
                foreach ($products as $index => $product) {
                    $this->products[$index] = [
                        'product_id' =>  $product['product_id'],
                        'quantity' =>   $product['quantity'],
                        'lote' =>  $product['lote'],
                        'lotes' =>  isset($product['lotes']) ? $product['lotes'] :  [],
                        'expire' => isset($product['expire']) ? $product['expire'] : null,
                    ];
                }
            } else {
                $this->products = [['product_id' => '', 'quantity' => 1, 'lote' => '', 'lotes' => [], 'expire' => '']];
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function addProduct()
    {
        $this->products[] = ['product_id' => '', 'quantity' => 1, 'lote' => '', 'lotes' => Lote::all()->toArray(), 'expire' => ''];
        /*     $this->set('products', $this->allProducts); */
    }

    public function removeProduct($index)
    {
        unset($this->products[$index]);
        $this->products = array_values($this->products);
    }

    public function changeProducts($value, $index)
    {
        /* Value is ID product */
        $newLotes = Lote::where('products_id', intval($value))->get()->toArray();
        $this->products[$index]['lotes'] =  $newLotes;
    }
    public function render()
    {
        return view('livewire.products-kardexes');
    }
}
