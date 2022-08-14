<div class="flex items-center justify-center space-x-3">
    @can('inventory.products.edit')
    <button>
        <a href="{{ route('dashboard.products.edit', $product) }}" class=''>
            <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
        </a>
    </button>
    @endcan

    @can('inventory.products.destroy')
    {!! Form::open(['route' => ['dashboard.products.destroy', $product], 'method' => 'delete']) !!}
    {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
    'type' => 'submit',
    'class' => '',
    'onclick' => "return confirm('Estás seguro que deseas eliminar a $product->name')",
    ]) !!}
    {!! Form::close() !!}
    @endcan
</div>