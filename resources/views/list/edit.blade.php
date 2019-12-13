@extends('layout.index')

@section('content')

    <script>
    jQuery( function() {
        let tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        jQuery( "#datepicker" ).datepicker({
            minDate: tomorrow,
            dateFormat: 'yy-mm-dd',
        });

        jQuery('#addTask').click(function(){
            let newTask = jQuery('.task').last().clone();

            let title = newTask.find('[name^=taskTitle]');
            title.val("");
            title.attr('name', 'newTitle[]');

            let deadline = newTask.find('[name^=deadline]');
            deadline.val("");
            deadline.attr('name', 'newDeadline[]');

            let active = newTask.find('[name^=active]');
            active.prop('checked', true);
            active.attr('name', 'newActive[]');

            jQuery('.tasks').append(newTask);
            jQuery( '#datepicker' ).datepicker({
                minDate: tomorrow,
                dateFormat: 'yy-mm-dd',
            });
        });
    } );
    </script>

    <h1>Edit To-Do list</h1>
    <form method="POST" action="{{ route('list.update', $list->id) }}">
        @method('PUT')
        @csrf

        <label for="title">List title :</label><br>
        <input type="text" name="title" value="{{ $list->title }}"><br>

        <div class="tasks">
        @foreach ($list->items as $item)
            <div class="task">
                <label>Task title :</label><br>
                <input type="text" name="taskTitle[{{ $item->id }}]" value="{{ $item->title }}"><br>

                <label>Deadline</label><br>
                <input type="text" name="deadline[{{ $item->id }}]" id="datepicker" value="{{ $item->deadline }}"> <br>

                <label>Active ?</label>
                <input type="checkbox" name="active[{{ $item->id }}]" {{ $item->active ? 'checked' : 'unchecked' }}>
            </div>
        @endforeach
        </div>

        <div class="links">
            <a href="#" id="addTask">Add task</a>
        </div>

        <input type="submit" value="Save">
    </form>
@endsection
