<script>
    $('.add_unit').click(function(e) {
        e.preventDefault();
        var unit = $('#name_unit').val();

        if (unit) {
            $('.add_unit').attr('disabled', 'disabled');
            $('.add_unit').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                type: "POST",
                url: "{{url('add-unit-modal')}}",
                data: {
                    name: unit,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    if (data.error) {
                        $('.error_unit').html(data.error?.name);
                    } else {
                        $('#id_unit').append(`<option value="${data.id}" selected>${data.name}</option>`);
                        $('#id_unit').trigger('change');
                        $('#name_unit').val('');
                        $('.error_unit').html('');
                        $('#Modalunit').modal('hide');
                    }
                    $('.add_unit').removeAttr('disabled');
                    $('.add_unit').html('Guardar');
                },
                error: function(data) {
                    $('.error_unit').html('');
                    $('.add_unit').removeAttr('disabled');
                    $('.add_unit').html('Guardar');
                }
            })
        }
    });
</script>