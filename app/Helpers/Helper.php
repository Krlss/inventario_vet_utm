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

function shortenNumber($number, $precision = 2)
{
    if ($number < 1000) {
        return $number;
    }

    $suffixes = array('', 'k', 'm', 'b', 't');
    $exponent = floor(log($number) / log(1000));

    return round($number / pow(1000, $exponent), $precision) . $suffixes[$exponent];
}
