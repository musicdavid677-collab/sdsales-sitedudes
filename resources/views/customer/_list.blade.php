@foreach ($customers as $customer)
<tr>
    <td><a href="{{ url('customers/profile/' . $customer->id) }}?customer_id={{ $customer->customer_id }}">{{ $customer->first_name }} {{ $customer->last_name }}</a></td>
    <td>{{ $customer->customer_id }}</td>
    <td>{{ $customer->email_address }}</td>
    <td>{{ $customer->url }}</td>
</tr>
@endforeach
