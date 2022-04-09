<!DOCTYPE html>
<html lang="en">
<head>
  <title>laravel student management system</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> 
  <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>




</head>
<body>

<div class="jumbotron text-center">
  <h1>Add new Student</h1>
  <div class="float-right mr-5">
    <a href="" class='btn btn-success'  data-toggle="modal" data-target="#myModal">Add Student</a>
  </div> 
</div>
  
<div class="container-fluid"> 

<div class="row">
@include('sidebar')
  
    <div class="col-10">
    
<table class="table" id='myTable'>
    <thead>
        <tr>
            <td>id</td>
            <td>Name</td>
            <td>Image</td>
            <td>Phone</td>
           
            
        </tr>
    </thead>
    <tbody>
        @foreach($students as $c )
        <tr>
            <td>{{$c->id}}</td>
            <td>{{$c->name}}</td>
           
            <td> <img src="{{asset('uploaded_img')}}/{{{$c->img}}}" alt="" height='150' width='150'></td> 
            <td>{{$c->phone}}</td>
            <td>{{$c->Course_Name}} </td> 
            <td>{{$c->Batch_Time}} </td> 
            <td>{{$c->Teaching_Day}} </td> 
           
            <td><a href="javascript:void(0)" data-id="{{$c->course_id}}" class='btn btn-warning showEditModal m+5' >Edit</a></td>

            <td>
            
            <form action="student/{{$c->id}}" method='POST'>
            @method('DELETE')
            @csrf
            <input type="submit"  value='Delete' class='btn btn-danger'>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
    </div>
</div>



</div>







<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" >Add Student</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <form action="student" method='POST' id='form' enctype='multipart/form-data'>
        @csrf
        <div class="form-group">
            <label for="">Nmae</label>
            <input type="text" class='form-control' name='name' id='name'>
        </div>
        <div class="form-group">
            <label for="">Phone</label>
            <input type="text" class='form-control' name='phone' id='phone'>
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input type="file" class='form-control' name='img' id='img'>
        </div>
 
        <div class="form-group">
            <label for="">course_id</label>
            <!-- <input type="text" class='form-control' name='course_id' id='course_id'> -->
            <select name="course_id" id="course_id" class='form-control'>
            <option  selected disabled> -</option>
                @foreach($course as $cse)
                
    <option value="{{$cse->id}}">{{$cse->Course_Name}}</option>
                @endforeach
                <option value=""></option>
            </select>
        </div>
          

        <div class="form-group">
            
            <input type="submit" class='form-control btn btn-success'  id='submit' value='Add Student'>
        </div> 
        </form>  
      </div> 
    </div>
  </div>
</div>


<script>

$(document).ready( function () {
    $('#myTable').DataTable();
} );


    $('.showEditModal').click(function(e){

      
        course_id = e.target.parentElement.previousElementSibling.innerText
        phone = e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText
        name = e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText
        id = e.target.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText

        course_id = e.target.getAttribute('data-id')
 

$('#course_id').val(course_id);
$('#phone').val(phone);
 
$('#name').val(name);

$('#submit').val("Edit Student");

$('.modal-title').text('Edit Student')

$('form').attr('action','student/'+id)
$('form').append('<input type="hidden" name="_method" value="PUT">')
        $('#myModal').modal('show');
    })
</script>

</body>
</html>
