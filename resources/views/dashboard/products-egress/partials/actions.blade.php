<div class="flex items-center justify-center space-x-3">

    @can('inventory.egress-products.show')
    <button>
        <a href="{{route('dashboard.products-egress.show', $kardex)}}">
            <x-icon icon='view-log' width={{22}} height={{22}} class="fas fa-edit text-gray-500 hover:text-blue-700" />
        </a>
    </button>
    @endcan

    @can('inventory.egress-products.edit')
    <button>
        <a href="{{ route('dashboard.products-egress.edit', $kardex) }}" class=''>
            <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
        </a>
    </button>
    @endcan

    @can('inventory.egress-products.destroy')
    {!! Form::open(['route' => ['dashboard.products-egress.destroy', $kardex], 'method' => 'delete']) !!}
    {!! Form::button('<i class="fa fa-trash text-gray-500 hover:text-red-700"></i>', [
    'type' => 'submit',
    'class' => '',
    'onclick' => "return confirm('Estás seguro que deseas eliminar a $kardex->name')",
    ]) !!}
    {!! Form::close() !!}
    @endcan
</div>