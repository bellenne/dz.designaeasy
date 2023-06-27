@extends('admin.layouts.header')
@section('content')
    <table class="table">
            <tr>
                <td style="max-width: 10px">#</td>
                <td>Студент</td>
                <td>Предмет</td>
                <td>Урок</td>
                <td>Задание</td>
                <td>Ссылка на задание</td>
                <td>Решение</td>
            </tr>
        <tbody id="content">
            @foreach($tasks as $task)
                <tr>
                    <td style="max-width: 10px">{{$task->ft_id}}</td>
                    <td>{{$task->fio}}</td>
                    <td>{{$task->as_name}}</td>
                    <td>{{$task->l_title}}</td>
                    <td>{{$task->t_title}}</td>
                    <td>{{route("taskinfo.show",$task->t_id)}}?taskId={{$task->t_id}}</td>
                    <td>{{$task->ft_result}}</td>

                </tr>
            @endforeach
        </tbody>
    </table>


@endsection
