<tr data-hx-target="this" hx-swap="outerHTML">
      <td><strong>{{ $vertical->vertical }} </strong></td>
      <td><button class="btn btn-sm"
      arial-label="Edit vertical"
      data-hx-get="{{ url("settings/vertical/edit/{$vertical->id}") }}">Edit</button></td>
</tr>
