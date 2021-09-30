<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=”stylesheet” href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <title>Document</title>
</head>

<body>
@include('sweet::alert')
    <form action="" method="post">
        @csrf
        <input type="text" placeholder="phone" name="phone">
        <input type="text" placeholder="enter msg" name="msg"><br>
        Chcekc::<input type="checkbox" name="checkbox"><br>
        <input type="submit" value="submit">
    </form>
</body>

</html>