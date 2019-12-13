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
    } );
    </script>

    <h1>Create a new To-Do list</h1>
    <form method="POST" action="{{ route('list.save') }}">
        @csrf

        <label for="title">List title :</label><br>
        <input type="text" name="title"><br>

        <label for="taskTitle">Task title :</label><br>
        <input type="text" name="taskTitle"><br>

        <label for="deadline">Deadline</label><br>
        <input type="text" name="deadline" id="datepicker"> <br>

        <input type="submit" value="Create">
    </form>
@endsection
