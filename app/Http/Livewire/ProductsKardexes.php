<?php

namespace App\Http\Livewire;

use App\Models\Products;
use Livewire\Component;

class ProductsKardexes extends Component
{

    public $products = [];
    public $allProducts = [];

    public function mount($products, $type)
    {


        $this->allProducts = Products::where('stock', '>', 0)->orderBy('name', 'asc')->get();


        /* products tiene la cantidad de productos agregados 
            tengan o no datos (Haber seleccionado el producto o poner una cantidad válida).
            Simplemente cargan los datos que previamente se guardaron 
            para que no haga todo el proceso de nuevo
        */

        if (count($products) > 0) {
            foreach ($products as $index => $product) {
                $this->products[$index] = [
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                ];
            }
        } else {
            $this->products = [['product_id' => '', 'quantity' => 1]];
        }
    }
    public function addProduct()
    {
        $this->products[] = ['product_id' => '', 'quantity' => 1];
    }

    public function removeProduct($index)
    {
        unset($this->products[$index]);
        $this->products = array_values($this->products);
    }

    public function render()
    {
        return view('livewire.products-kardexes');
    }
}
