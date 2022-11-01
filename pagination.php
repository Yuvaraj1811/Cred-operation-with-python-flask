<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <title>Document</title>
</head>
<style>
      
      /* .btn1 {
          background-color: light-green;
          padding: 12px 16px;
          font-size: 16px;
          border:none;
      }
      .btn1:hover {
          background-color: grey;
      } */
      .alert-danger{
        width:fit-content;
        margin-top:50px;
      }
    </style>
<body>
    <form action="/searchbyid" method='POST'>
        <input type="text" name="serachname" placeholder="search by id" id="search">
        <button type="Submit"class="btn btn-primary">Search</button>
    </form>
    <button type="button" class="btn btn-primary" id="downloadexcel">Download Excel</button>
    <!-- <button type="button" class="btn btn-primary" >Download Excel</button> -->
    <table class="table table-hover" id=table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Emp-Id</th>
                <th>Emp-Name</th>
                <th>Place</th>
                <th>Address</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            {%for i in result%}
          
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
    </table>
    <!-- THIS IS PAGINATION -->
    <center>
    <button class="btn btn-primary" id="previous"> 
        <i class="fa fa-arrow-left"> </i>
    </button>
    <button class="btn btn-primary" id="next"> 
        <i class="fa fa-arrow-right"> </i>
    </button>
    </center>
    {%if error %}
    <center>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>{{error}}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
    </center>
    {%endif%}
    
</body>
</html>

<script>
    $(document).ready(function(){    
        $("#next").on("click",function(){
        var pgno="{{pgno}}"
        var newpgno=parseInt(pgno)+10
        var error="{{error}}"
        if (error){
            $("#next").hide();
    
        }
        else{
            window.location.replace("/pagination?pgno="+newpgno)
        }
        
    });
    });
</script>
<script>
    $(document).ready(function(){
        $("#previous").on("click",function(){
            var pgno="{{pgno}}"
        if (pgno==0){
            $("#previous").hide();
        }
        else{
            newpgno=parseInt(pgno)-10
            window.location.replace("/pagination?pgno="+newpgno)

        };
        
    });
    });
</script>

<script>
    $(document).ready(function(){
        $("#downloadexcel").on("click",function(){
            var pgno='{{pgno}}'
            console.log(pgno)
            window.location.replace("/downloadexcel?pgno="+pgno)
        })
    })
</script>


