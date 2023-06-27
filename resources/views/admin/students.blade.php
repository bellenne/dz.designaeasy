@extends('admin.layouts.header')
@section('content')
    <table class="table">
            <tr>
                <td style="max-width: 10px">#</td>
                <td>ФИО</td>
                <td>Почта</td>
                <td></td>
            </tr>
        <tbody id="content">
            @foreach($students as $student)
                <tr>
                    <td style="max-width: 10px">{{$student->id}}</td>
                    <td><input class="form-control form-edit" type="text" id="name{{$student->id}}" name="name" @if(auth()->user()->role_id != 2) readonly
                               @endif  data-id="{{$student->id}}" value="{{$student->name}}"></input></td>
                    <td style="max-width: 150px"><input  class="form-control form-edit" type="text" @if(auth()->user()->role_id != 2) readonly
                               @endif  data-id="{{$student->id}}" id="url{{$student->id}}" name="email" value="{{$student->email}}"></input></td>
                    @if(auth()->user()->role_id == 2)
                        <td style="max-width: 10px"><a href="#" data-id="{{$student->id}}"
                                                       class="btn btn-danger btn-delete">Удалить</a></td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    @if(auth()->user()->role_id == 2)

        <script>
            $("body").delegate(".btn-delete", 'click', function(e){
                console.log(this.dataset.id);
                $.ajax({
                    url: "{{route("students.destroy")}}",
                    method: 'get',
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", id: this.dataset.id},
                    success: function (data) {
                        reloadContent(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });
            $("body").delegate(".form-edit", 'change', function(e){
                $.ajax({
                    url: "{{route("students.edit")}}",
                    method: 'get',
                    dataType: 'json',
                    data: {"_token": "{{ csrf_token() }}", id: this.dataset.id, column:$("#"+this.id).attr("name") ,value: $("#"+this.id).val()},
                    success: function (data) {
                        reloadContent(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            function reloadContent(data) {
                $("#content").html("");
                Object.values(data).forEach(function (value) {
                    $("#content").append('<tr><td style="max-width: 10px">'+value["id"]+'</td><td><input class="form-control form-edit" type="text" id="name'+value["id"]+'"'
                        +'name="name" data-id="'+value["id"]+'" value="'+ value["name"]+'"></input></td>' +
                        '<td style="max-width: 150px"><input  class="form-control form-edit" type="text" data-id="'+value["id"]+
                        '" id="url'+value["id"]+'" name="email" value="'+value["email"]+'"></input></td>'
                        +'<td style="max-width: 10px"><a href="#" data-id="'+value["id"]
                        +'"class="btn btn-danger btn-delete">Удалить</a></td><tr>'
                    );
                });

            }
        </script>
    @endif

@endsection
