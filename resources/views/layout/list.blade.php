@extends('layout.index')

@section('content')
<script>
    jQuery(document).ready(function (){
        jQuery('.box').click(function() {
            let formData = jQuery(this).closest('form').serialize();
            jQuery.ajax({
                url: 'complete',
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function(res) {
                    if (res.listCompleted) {
                        let selector = '.list_' + res.listId + ' .box';
                        jQuery(selector).each(function(){
                            jQuery(this).attr('disabled', true);
                        });
                    }
                }
            })
        });
    });
</script>


@foreach ($lists->sortBy('id') as $list)
    <p>{{ $list->title }}</p>
    <ul class="task-list list_{{ $list->id }}">
        @foreach ($list->items as $item)
            <li>
                {{ $item->title }}

                @if ($item->active && strtotime("now") < strtotime($item->deadline))
                    <form>
                        @csrf
                        <input type="hidden" name="taskId" value="{{ $item->id }}">
                        <input type="checkbox" class="box" name="completed" {{ $item->completed ?'checked' : 'unchecked' }}>
                    </form>
                @else
                    <input type="checkbox" disabled>
                @endif
            </li>
        @endforeach
    </ul>
    <a href="{{ route('list.edit', $list->id) }}">Edit</a>
    <form method="POST" action="{{ route('list.delete') }}">
        @csrf
        <input type="hidden" value="{{ $list->id }}" name="id">
        <input type="submit" value="Delete">
    </form>
@endforeach
@endsection
