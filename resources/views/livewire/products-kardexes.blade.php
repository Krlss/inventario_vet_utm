<div class="card">
    <div class="card-header font-bold">
        {{__('Products')}}
    </div>

    <div wire:loading wire:target="removeProduct,addProduct" class="progress-bar hidden">
        <div class="progress-bar-value"></div>
    </div>

    <div class="card-body">
        <table class="table" id="products_table">
            <thead>
                <tr>
                    <th>{{__('Product Name | Stock | Unit | Amount')}}</th>
                    <th>{{__('Quantity')}}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                <tr>
                    <td>
                        <select name="products[{{$index}}][product_id]" wire:model="products.{{$index}}.product_id" class="form-control">
                            <option value="">{{__('Choose a product')}}</option>
                            @foreach ($allProducts as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }}, {{ $product->stock }}, {{ $product->unit->name }}, {{ $product->amount }}
                            </option>
                            @endforeach
                        </select>

                        <!-- Errores... -->
                        @if($errors->has('products'))
                        <span class="text-red-500 text-xs italic">{{$errors->first('products')}}</span>
                        @endif

                        @if($errors->has('products.'.$index.'.product_id'))
                        <span class="text-red-500 text-xs italic">{{$errors->first('products.'.$index.'.product_id')}}</span>
                        @endif

                    </td>
                    <td>
                        <input type="number" min='1' name="products[{{$index}}][quantity]" class="form-control" wire:model="products.{{$index}}.quantity" />
                        @if($errors->has('products.'.$index.'.quantity'))
                        <span class="text-red-500 text-xs italic">{{$errors->first('products.'.$index.'.quantity')}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="#" wire:click.prevent="removeProduct({{$index}})">
                            <div class="text-red rotate-45 text-lg flex items-center justify-center hover:font-bold">+</div>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-sm btn-secondary" wire:click.prevent="addProduct">+ {{__('Add Another Product')}}</button>
            </div>
        </div>
    </div>
</div>