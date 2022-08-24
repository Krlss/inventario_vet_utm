<script>
    $('.add_type').click(function(e) {
        e.preventDefault();
        var type = $('#name_type').val();

        if (type) {
            $('.add_type').attr('disabled', 'disabled');
            $('.add_type').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                type: "POST",
                url: "{{url('add-type-modal')}}",
                data: {
                    name: type,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    if (data.error) {
                        $('.error_type').html(data.error?.name);
                    } else {
                        $('#id_type').append(`<option value="${data.id}" selected>${data.name}</option>`);
                        $('#id_type').trigger('change');
                        $('#name_type').val('');
                        $('.error_type').html('');
                        $('#Modaltype').modal('hide');
                    }
                    $('.add_type').removeAttr('disabled');
                    $('.add_type').html('Guardar');
                },
                error: function(data) {
                    $('.error_type').html('');
                    $('.add_type').removeAttr('disabled');
                    $('.add_type').html('Guardar');
                }
            })
        }
    });
</script>