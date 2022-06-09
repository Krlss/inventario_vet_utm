<script>
    $('.add_category').click(function(e) {
        e.preventDefault();
        var category = $('#name_category').val();

        if (category) {
            $('.add_category').attr('disabled', 'disabled');
            $('.add_category').html('Guardando... <i class="fa fa-spinner fa-spin"></i>');

            $.ajax({
                type: "POST",
                url: "{{url('add-category-modal')}}",
                data: {
                    name: category,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    if (data.error) {
                        $('.error_category').html(data.error?.name);
                    } else {
                        $('#id_category').append(`<option value="${data.id}" selected>${data.name}</option>`);
                        $('#id_category').trigger('change');
                        $('#name_category').val('');
                        $('.error_category').html('');
                        $('#Modalcategory').modal('hide');
                    }
                    $('.add_category').removeAttr('disabled');
                    $('.add_category').html('Guardar');
                },
                error: function(data) {
                    $('.error_category').html('');
                    $('.add_category').removeAttr('disabled');
                    $('.add_category').html('Guardar');
                }
            })
        }
    });
</script>