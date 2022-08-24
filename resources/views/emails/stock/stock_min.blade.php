@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# {{ __('Whoops!') }}
@else
# {{__('Hello!')}}
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ __($line) }}

@endforeach

<!-- table products -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">{{ __('Name') }}</th>
            <th scope="col">{{ __('Stock') }}</th>
            <th scope="col">{{ __('Min Stock') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($detail as $product)
        <tr>
            <td class="border p-2">{{ $product['name'] }}</td>
            <td class="border p-2">{{ $product['stock'] }}</td>
            <td class="border p-2">{{ $product['min_stock'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>


{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ __($line) }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
{{__('Salutations')}},<br>
{{ config('app.name') }}
@endif

@endcomponent