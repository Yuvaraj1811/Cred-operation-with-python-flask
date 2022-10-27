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
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <title>Document</title>
</head>
<body>
    THIS IS PAGINATION

    <button class="btn btn-primary" id="previous"> previous</button>
    <button class="btn btn-primary" id="next"> next</button>

    
</body>
</html>

<script>
    $(document).ready(function(){    
        $("#next").on("click",function(){
        var pgno="{{pgno}}"
        var newpgno=parseInt(pgno)+10
        window.location.replace("/pagination?pgno="+newpgno)
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

