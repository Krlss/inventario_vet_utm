<div class="flex items-center justify-center space-x-3">
    @can('inventory.lotes.edit')
    <button>
        <a href="{{ route('dashboard.lotes.edit', $lote) }}" class=''>
            <i class="fas fa-edit text-gray-500 hover:text-green-700"></i>
        </a>
    </button>
    @endcan
</div>