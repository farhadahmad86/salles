@component('mail::message')
    # Hello From Sale Force

    Welcome To Sale Force
    {{--
    @component('mail::button', ['url' => ''])
        Button Text
    @endcomponent --}}

    Thanks,
    {{ config('app.name') }}
@endcomponent
