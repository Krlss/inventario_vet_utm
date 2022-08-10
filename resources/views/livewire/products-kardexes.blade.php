<div class="card">
    <div class="card-header font-bold">
        {{ __('Products') }}
    </div>

    <div wire:loading wire:target="removeProduct,addProduct,changeProducts" class="progress-bar hidden">
        <div class="progress-bar-value"></div>
    </div>

    <div class="card-body">
        <table class="table" id="products_table">
            <thead>
                <tr>
                    <th>{{ __('Product Name | Stock | Unit | Amount') }}*</th>
                    <th>{{ __('Quantity') }}*</th>
                    <th>{{ __('Lote') }}</th>
                    @if ($expire)
                        <th>{{ __('Expire') }}*</th>
                    @endif
                    <th></th>
                </tr>
            </thead>
            <tbody id='body'>
                @if ($errors->has('products'))
                    <span class="text-red-500 text-xs ">{{ $errors->first('products') }}</span>
                @endif
                @foreach ($products as $index => $product)
                    <tr>
                        <td>
                            <select name="products[{{ $index }}][product_id]" class="select2 form-control"
                                id="product_input{{ $index }}"
                                wire:model="products.{{ $index }}.product_id"
                                @if ($type == 'egress') wire:change="changeProducts($event.target.value,{{ $index }})" @endif
                                class="form-control" required>
                                <option value="">{{ __('Choose a product') }}</option>
                                @foreach ($allProducts as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->name }}, {{ $product->stock }},
                                        {{ $product->unit->name }},
                                        {{ $product->amount }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('products.' . $index . '.product_id'))
                                <span
                                    class="text-red-500 text-xs ">{{ $errors->first('products.' . $index . '.product_id') }}</span>
                            @endif

                        </td>
                        <td>
                            <input type="number" min='1' name="products[{{ $index }}][quantity]"
                                class="form-control" wire:model="products.{{ $index }}.quantity" required />
                            @if ($errors->has('products.' . $index . '.quantity'))
                                <span
                                    class="text-red-500 text-xs ">{{ $errors->first('products.' . $index . '.quantity') }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($type == 'ingress')
                                <input type="text" name="products[{{ $index }}][lote]" class="form-control"
                                    wire:model="products.{{ $index }}.lote" />
                                @if ($errors->has('products.' . $index . '.lote'))
                                    <span
                                        class="text-red-500 text-xs  ">{{ $errors->first('products.' . $index . '.lote') }}</span>
                                @endif
                            @else
                                <select wire:model="products.{{ $index }}.lote"
                                    name="products[{{ $index }}][lote]" class="form-control select2" required>
                                    <option value="">{{ __('Choose a lote') }}</option>
                                    @if ($products[$index]['lotes'])
                                        @foreach ($products[$index]['lotes'] as $lote)
                                            <option value="{{ $lote['lote'] }}"
                                                @if ($products[$index]['lote'] == $lote['lote']) selected @endif>
                                                {{ $lote['lote'] }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            @endif
                            @if ($errors->has('products.' . $index . '.lote'))
                                <span
                                    class="text-red-500 text-xs ">{{ $errors->first('products.' . $index . '.lote') }}</span>
                            @endif
                        </td>
                        @if ($expire)
                            <td>
                                <input type="date" name="products[{{ $index }}][expire]" class="form-control"
                                    wire:model="products.{{ $index }}.expire" required
                                    max="{{ date('Y-m-d') }}" />
                                @if ($errors->has('products.' . $index . '.expire'))
                                    <span
                                        class="text-red-500 text-xs ">{{ $errors->first('products.' . $index . '.expire') }}</span>
                                @endif
                            </td>
                        @endif
                        <td>
                            <a href="#" wire:click.prevent="removeProduct({{ $index }})">
                                <div
                                    class="text-red rotate-45 text-lg flex items-center justify-center hover:font-bold">
                                    +</div>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-sm btn-secondary add" wire:click.prevent="addProduct">+
                    {{ __('Add Another Product') }}</button>
            </div>
        </div>
    </div>
</div>
{{-- @push('js')
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var products = [];
            $('button.add').on('click', function() {
                console.log(products);
            })

            window.livewire.on('add_Product', function() {
                $("select.select").map(function(index, value) {
                    console.log(value);
                    value.select2({
                        ajax: {
                            url: 'https://api.github.com/search/repositories',
                            data: function(params) {
                                var query = {
                                    search: params.term,
                                    page: params.page || 1
                                }

                                return query;
                            }
                        }
                    });
                })

            });

        });

       
    </script>
@endpush --}}
