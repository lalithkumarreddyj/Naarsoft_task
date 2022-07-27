<html>
    <form action="{{ route('store') }}" method="POST">
        {{csrf_field()}}
        firstname:<input type="text" name ="first_name">
        lastname:<input type="text" name ="last_name">
        department:<input type="text" name ="department_name"><br>
        <input type="submit" value="submit">
    </form>
    <table border="1">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Department</th>
            <th>Action</th>
        </tr>
        </thead>
       <tbody>
           @foreach($emp_details as $emp_det_key => $emp_details_value)
            <tr>
                <td>{{$emp_details_value['firstname']}}</td>
                <td>{{$emp_details_value['lastname']}}</td>
                <td>{{$emp_details_value['department_name']}}</td>
                <td><a href="{{ url('employee/').'/'.$emp_details_value['id'].'/edit' }}">Edit</a></td>
                <td>
                <form action="{{ url('employee/').'/'.$emp_details_value['id'] }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
            </tr>
        @endforeach
       </tbody>
    </table>
</html>