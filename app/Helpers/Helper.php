<?php

function generateProfilePhotoPath($string)
{
    return 'https://ui-avatars.com/api/?name=' . $string[0] . '&color=fff&background=FFB509&bold=true&length=1';
}

function flashMessage($message, $type = 'success')
{
    if ($type == 'success') {
        $type = 'primary';
    } elseif ($type == 'error') {
        $type = 'danger';
    }

    return '<div class="alert alert-' . $type . ' alert-dismissible fade show" role="alert">' . $message . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}
