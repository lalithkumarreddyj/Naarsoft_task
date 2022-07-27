
<html>
    <form action="{{ url('/employee/').'/'.$employee[0]['id'] }}" method="post">
        @method('patch')
         {{csrf_field()}}
        firstname:<input type="text" name ="first_name" value="{{$employee[0]['firstname']}}">
        lastname:<input type="text" name ="last_name" value="{{$employee[0]['lastname']}}">
        department:<input type="text" name ="department_name" value="{{$employee[0]['department_name']}}"><br>
        <input type="submit" value="update">
    </form>
    </html>