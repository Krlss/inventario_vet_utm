<div class="flex flex-col gap-2">
    <div class="grid md:grid-cols-4 grid-cols-1 gap-2">
        <div>
            <label for="name">{{ __('Name') }}*</label>
            {!! Form::text('name', $product->name ?? null, ['class' => 'form-control','placeholder' => __('Name'), 'required' => true]) !!}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
        <div>
            <label for="amount">{{ __('Btu amount') }}*</label>
            {!! Form::number('amount', $product->amount ?? null, ['class' => 'form-control','placeholder' => __('Amount'), 'required' => true, 'pattern' => '[0-9]+', 'min' => '0']) !!}
            @error('amount')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="cost">{{ __('Cost') }}*</label>
            {!! Form::number('cost', $product->cost ?? null, ['class' => 'form-control','placeholder' => __('Cost'), 'required' => true, 'pattern' => '[0-9]+', 'min' => '0', 'step'=> 0.01]) !!}

            @error('cost')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="stock_min">{{ __('Stock min') }}*</label>
            {!! Form::number('stock_min', $product->stock_min ?? null, ['class' => 'form-control','placeholder' => __('Stock min'), 'required' => true, 'pattern' => '[0-9]+', 'min' => '0']) !!}

            @error('stock_min')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>


    <div class="grid grid-cols-4 gap-2">
        <div>
            <div>
                <label for="id_type">{{ __('Types') }}</label>
                <x-button-modal target="type" />
            </div>
            {!! Form::select('id_type[]', $types, $typesSelected, ['class' => 'select2 form-control', 'multiple' => true, 'id' => 'id_type']) !!}

            @error('id_type')
            <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
        <div>
            <div>
                <label for="id_category">{{ __('Categories') }}</label>
                <x-button-modal target="category" />
            </div>
            {!! Form::select('id_category[]', $categories, $categoriesSelected, ['class' => 'select2 form-control','multiple' => true, 'id' => 'id_category']) !!}

            @error('id_category')
            <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
        <div>
            <div>
                <label for="unit">{{ __('Unit') }}*</label>
                <x-button-modal target="unit" />
            </div>
            {!! Form::select('id_unit', $units, $product->id_unit ?? null, ['class' => 'select2 form-control', 'required' => true]) !!}

            @error('id_unit')
            <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
    </div>

</div>

@push('js')
@include('partials.js_modals.unit')
@include('partials.js_modals.type')
@include('partials.js_modals.category')

<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script>
    $('#id_category').select2({
        width: '100%',
        placeholder: 'Selecciona las categorías',
        allowClear: true,
    });
    $('#id_type').select2({
        width: '100%',
        placeholder: 'Selecciona los tipos',
        allowClear: true,
    });

    $('.clear').on('click', function() {
        $('#id_category').val(null).trigger('change');
        $('#id_type').val(null).trigger('change');
        $('#unit').val(null).trigger('change');
        $('#name').val('');
        $('#amount').val('');
        $('#cost').val('');
    });
</script>
@endpush