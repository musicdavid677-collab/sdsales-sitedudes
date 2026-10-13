<tr data-hx-target="this" hx-swap="outerHTML">
      <td><strong>{{ $service->service }} </strong></td><td>$ {{ $service->price }}</td>
      <td><button class="btn btn-sm"
      arial-label="Edit Service"
      data-hx-get="{{ url("settings/service/edit/{$service->id}") }}">Edit Service</button></td>
</tr>
