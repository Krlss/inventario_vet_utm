<div>
    <button type="button" data-toggle="modal" data-target="#universalModal" class="btn btn-sm btn-primary edit" data-id="{{$category->id}}" data-name="{{$category->name}}">{{__('Edit')}}</button>
    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
        @csrf
        {{ method_field('DELETE') }}
        <button type="submit" onclick="return confirm('Estás seguro que deseas eliminar esta categoría?')" class="btn btn-sm btn-danger">{{__('Delete')}}</button>
    </form>
</div>