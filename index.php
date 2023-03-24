<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-body" class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <form id="entry-form" style="width:50%;padding:20px;">

        <button id="getwinner" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Get Winner
        </button>
        <br /><br />
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control" type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="pwd">Email:</label>
            <input class="form-control" type="email" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</body>
<script>
    $('#entry-form').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: 'submit.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response);
            },
            error: function(xhr, status, error) {
                alert('failed to send the data');
            }
        });
    });
    $('#getwinner').click(function(e) {
        e.preventDefault();

        $.ajax({
            url: 'winner.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                var name = response.name;
                var email = response.email;
                document.getElementById("modal-body").innerHTML = name + "<br />";
                document.getElementById("modal-body").innerHTML += email;
            },
            error: function(xhr, status, error) {
                alert('Failed to get data');
            }
        });
    });
</script>

</html>