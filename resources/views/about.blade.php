
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>About Page</h1>
    <!-- <a>Your name is: {{ $name }}</a> -->
    <!-- <h3>{{ rand() }}</h3> -->

    @if($name == 'aniket')
    <h3>Your name is aniket</h3>
    @elseif($name == 'john')
    <h3>Your name is john</h3>
    @else
    <h3>Your name is another</h3>
    @endif

    <!-- <div>
        @for($i=1;$i<=10;$i++)
            <h3>{{ $i }}</h3>
        @endfor
    </div>   -->

    <div>
        @foreach($users as $user)
        <h3>{{ $user }}</h3>
        @endforeach
    </div>
</body>
</html>