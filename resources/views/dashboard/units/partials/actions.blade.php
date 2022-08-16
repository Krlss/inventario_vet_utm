<div>
    @can('inventory.units.edit')
    <button type="button" data-toggle="modal" data-target="#universalModal" class="btn btn-sm btn-primary edit" data-id="{{$unit->id}}" data-name="{{$unit->name}}">{{__('Edit')}}</button>
    @endcan
    @can('inventory.units.destroy')
    <form action="{{ route('units.destroy', $unit) }}" method="POST" class="d-inline">
        @csrf
        {{ method_field('DELETE') }}
        <button type="submit" onclick="return confirm('Estás seguro que deseas eliminar esta UND?')" class="btn btn-sm btn-danger">{{__('Delete')}}</button>
    </form>
    @endcan
</div>