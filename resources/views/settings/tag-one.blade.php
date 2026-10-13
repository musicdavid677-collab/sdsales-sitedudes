<tr data-hx-target="this" hx-swap="outerHTML">
      <td><strong>{{ $tag->tag }} </strong></td><td><strong>{{ $tag->type }} </strong></td>
      <td><button class="btn btn-sm"
      arial-label="Edit tag"
      data-hx-get="{{ url("settings/tag/edit/{$tag->id}") }}">Edit</button></td>
</tr>
