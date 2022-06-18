<script>
    $('#modal_form').on('submit', function(event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: "{{ route('ajaxdata.postdata') }}",
            method: "POST",
            data: form_data,
            dataType: "json",
            success: function(data) {
                $('.save').html("{{__('Save')}}");
                $('.save').prop('disabled', false);
                if (data.error) {
                    $('.error_modal').html(data.error?.name);
                } else {
                    $('#modal_form')[0].reset();
                    $('.modal-title').text(data.modal_title);
                    $('#button_action').val(data.button_action);
                    $('#table').DataTable().ajax.reload();
                    $('#universalModal').modal('hide');
                    $('div.flash-message').html(data.success);
                }
            }
        })
    });
</script>