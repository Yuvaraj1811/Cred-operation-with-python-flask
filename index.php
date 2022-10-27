<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="edit.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <title>Document</title>
    
</head>
<body>

    <form id="formsubmit" method="POST">
        <center>
            <div class="form1">
            
        <input type="number" name="empid" id="empid" required placeholder="Employee id">
        <input type="text" name="empname" id="empname" required placeholder="Employee name"><br>
        <input type="text" name="place" id="city" required placeholder="City">
        <input type="text" name="address" id="address" required placeholder="Address"><br>
        <button type="submit" class="btn btn-primary" id="submitform">Submit</button>
        <span class="message"></span>
    </div>
    </center>
    </form>
    <span class="alert alert-danger" role="alert">{{error}}</span>
    <span class="alert alert-success" role="alert">{{success}}</span>
    

    <table class="table table-striped" id="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Emp-Id</th>
            <th scope="col">Emp-Name</th>
            <th scope="col">Place</th>
            <th scope="col">Address</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
            {%for i in results%}
          
            <tr>
            <!-- <th scope="row"></th>  -->
            <td>{{i[0]}}</td>
            <td>{{i[1]}}</td>
            <td>{{i[2]}}</td>
            <td>{{i[3]}}</td>
            <td>{{i[4]}}</td>
            <td><button type="button" class="btn btn-warning" >Edit</button></td>
            <td><button type="button" class="btn btn-danger" id="delete">Delete</button></td>

        </tr>
            {%endfor%}
        </tbody>    
        
          
    <!-- {%for i in results%} -->
    <!-- <p>{{i[1]}}</p>
    <p>{{i[2]}}</p>
    {%endfor%} -->

    <a href="/pagination?pgno=0">dufasduasudgasuid</a>
    

</body>

</html>

<script>
    $(document).ready(function(){
        $("#submitform").on("click",function(){
            var empid=$("#empid").val();
            var name=$("#empname").val();
            var city=$("#city").val();
            var address=$("#address").val();
            // alert(empid+'  '+name+'  '+city+'  '+address)
            if ($("#empid").val()==="" && $("#empname").val()==="" && $("#city").val()==="" && $("#address").val()===""){
                alert("Please enter all the details")
            }
            else{
                    $.ajax({
                    url:'/ajaxtesting',
                    type:'POST',
                    data:JSON.stringify({"empid":empid,"name":name,"city":city,"address":address}),  
                    contentType:"application/json;charset=UTF-8",
                    beforeSend:function(){   
                            $(".message").html("<h6>Please Wait we are submitting..")
                    },
                    success: function() {
                        console.log("success")
                    },
                    complete:function(){
                        // console.log("successfully submiited")
                        $(".message").html("<h6>Submitted</h6>")
                    },
                    error:function(){
                        console.log("errror happend")
                    }
                    });
            }
            
        });
    });
</script>


<script>
    $(document).ready( function () {
    $('#table').DataTable();
} );
</script>
