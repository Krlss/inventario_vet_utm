<div class="flex flex-col gap-2">
    <div class="grid md:grid-cols-4 grid-cols-1 gap-2">
        <div>
            <label for="name">{{ __('Name') }}*</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('Name') }}"
                value="{{ old('name') }}" required>

            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
        <div>
            <label for="amount">{{ __('Btu amount') }}*</label>
            <input min="0" pattern="[0-9]+" type="number" class="form-control" id="amount" name="amount"
                placeholder="{{ __('Amount') }}" value="{{ old('amount') ?? 0 }}" required>

            @error('amount')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            {{-- <label for="expire">{{ __('Expire') }}*</label>
            <input type="date" name="expire" id="expire" class="form-control" value="{{old('expire')}}" />

            @error('expire')
            <span class="text-danger">{{ $message }}</span>
            @enderror --}}
        </div>
        <div>
            <label for="cost">{{ __('Cost') }}*</label>
            <input min="0" pattern="[0-9]+" step=0.01 type="number" class="form-control" id="cost"
                name="cost" placeholder="{{ __('Cost') }}" value="{{ old('cost') ?? 0 }}" required>

            @error('cost')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="stock_min">{{ __('Stock min') }}*</label>
            <input min="0" pattern="[0-9]+" type="number" class="form-control" id="stock_min" name="stock_min"
                placeholder="{{ __('Stock min') }}" value="{{ old('stock_min') ?? 0 }}" required>

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
            <select class="form-control" id="id_type" name="id_type[]" multiple>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}"
                        {{ collect(old('id_type'))->contains($type->id) ? 'selected' : '' }}>{{ $type->name }}
                    </option>
                @endforeach
            </select>

            @error('id_type')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
        <div>
            <div>
                <label for="id_category">{{ __('Categories') }}</label>
                <x-button-modal target="category" />
            </div>
            <select class="form-control" id="id_category" name="id_category[]" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ collect(old('id_category'))->contains($category->id) ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>

            @error('id_category')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
        <div>
            <div>
                <label for="unit">{{ __('Unit') }}*</label>
                <x-button-modal target="unit" />
            </div>
            <select class="form-control" id="id_unit" name="id_unit" required>
                <option value="">Selecciona una unidad de medida</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" {{ old('id_unit') == $unit->id ? 'selected' : '' }}>
                        {{ $unit->name }}</option>
                @endforeach
            </select>

            @error('id_unit')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
    </div>


    <div class="grid md:grid-cols-3 grid-cols-1 gap-2">


        <div>
        </div>
        <div>
        </div>
    </div>
    {{-- <div class="grid grid-cols-1 gap-2">

    </div> --}}

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
