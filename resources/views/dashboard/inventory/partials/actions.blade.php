<div class="flex items-center justify-center space-x-3">

    <button>
        <a href="{{ route('dashboard.inventory.edit', $product) }}" class=''>
            <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
        </a>
    </button>

    <form action="{{ route('dashboard.inventory.destroy', $product) }}"  method="DELETE">
        <button type="submit" onclick="return confirm('Estás seguro que deseas eliminar el producto?')" class="">
            <i class="fas fa-trash text-gray-500 hover:text-red-700"></i>
        </button>
    </form>
    {{-- {!! Form::open(['route' => ['dashboard.inventory.destroy', $product], 'method' => 'delete']) !!}
        {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
            'type' => 'submit',
            'class' => '',
            'onclick' => "return confirm('Estás seguro que deseas eliminar a $product->name')",
        ]) !!}
        {!! Form::close() !!} --}}

</div>
