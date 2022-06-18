<div>
    <button type="button" data-toggle="modal" data-target="#universalModal" class="btn btn-sm btn-primary edit" data-id="{{$type->id}}" data-name="{{$type->name}}">{{__('Edit')}}</button>
    <form action="{{ route('types.destroy', $type) }}" method="POST" class="d-inline">
        @csrf
        {{ method_field('DELETE') }}
        <button type="submit" onclick="return confirm('Estás seguro que deseas eliminar este tipo?')" class="btn btn-sm btn-danger">{{__('Delete')}}</button>
    </form>
</div>