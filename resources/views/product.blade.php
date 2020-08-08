<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>{{$name}}</h1>
    <h3> Product id: {{$id}} <br> Type: {{$r_type}} </h3>

    @if ($id == 1)
      1 numaralı ürün gözükmektedir
    @elseif ($id == 2)
      2 numaralı ürün gözükmektedir
    @else
      Diğer bir ürün gözükmektedir
    @endif

    @for ($i=0; $i < 10; $i++)
      <p>Döngü değeri: {{$i}}</p>
      @if ($i==9)
        Döngü Sonu <br>
        @for ($i=0; $i < 100; $i++)
          {{'-'}}
          @if ($i == 99)
            <br>
          @endif
        @endfor
      @endif
    @endfor


    @foreach ($categories as $category)
      {{$category}} <br>
    @endforeach


  </body>
</html>
