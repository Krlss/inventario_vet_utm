@extends('layouts.app')

@section('content')

@section('content_header')
<div class="flex justify-between items-center">
    <div class="text-lg font-bold">{{ __('Permissions list') }}</div>
</div>
@endsection

<div class="table table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="sort">{{ __('Permission') }}</th>
                @foreach ($roles as $role)
                <th class="sticky">{{ $role->name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
            <tr>
                <td>{{ __($permission->name) }}</td>
                @foreach ($roles as $role)
                <td>
                    @if ($role->hasPermissionTo($permission->name))
                    <div class='checkbox icheck'><label><input type='checkbox' name='namehere' class='permission' data-role-id='{{ $role->id }}' data-permission='{{ $permission->name }}' checked></label></div>
                    @else
                    <div class='checkbox icheck'><label><input type='checkbox' name='namehere' class='permission' data-role-id='{{ $role->id }}' data-permission='{{ $permission->name }}'></label></div>
                    @endif
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('js')
<script>
    $('input[type="checkbox"].permission').click(function(event) {
        var url = "";
        var roleId = $(this).data('role-id');
        var permission = $(this).data('permission');
        if ($(this).is(':checked')) {
            url = "{{ url('permissions/give-permission-to-role') }}";
        } else {
            url = "{{ url('permissions/revoke-permission-to-role') }}";
        }
        $.ajax({
                method: "POST",
                url: url,
                data: {
                    _token: "{{ csrf_token() }}",
                    roleId: roleId,
                    permission: permission
                }
            })
            .done(function(msg) {

            });

    });
</script>
@endpush