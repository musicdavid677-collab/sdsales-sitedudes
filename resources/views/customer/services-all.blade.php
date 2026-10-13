<ul id="services">
    @foreach ($servicess as $service)
        @include('customer/service-one', [
            'service' => $service,
        ])
    @endforeach
</ul>