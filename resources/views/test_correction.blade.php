<!DOCTYPE html>
<html>
<head>
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
  <style>  
    @page { margin: 20px 20px; padding: 4px;}
    footer { position: fixed; bottom: -1px; text-align: right}
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    footer .pagenum:before {
      content: counter(page);
    }
    background {
      position: fixed;
      top: 30%;
      left: 50%;
    }
  </style>     

</head>
<body 
  style="
    color: black; font-size: 14px; 
    border: double 4px rgb(10, 101, 10);
  "
> 

<!-- setting the page numbers -->
  <footer class="pagenum">
    <div class="pagenum-container">Page <span class="pagenum"></span></div>
  </footer>
  
  <!-- setting the background blurred image -->
  <background>
    <div style="opacity: 0.3; transform: translate(-50%,0); z-index: 1 ">
      <img src="./images/logo.png" style="height: 250px">
    </div>
  </background>

<!-- header -->
  <div>
    <table style="width: 100%; text-align: center; ">                
      <tbody>
        <tr>
          <td><span style="font-weight: bold">Test's title: </span>H.T.T.T.C Bamenda-Bambili</td>
          <td rowspan = "6">
            <img src="./images/logo-enset.png"  style="height: 81px;">
          </td>
          <td><span style="font-weight: bold">Test's title: </span><span style="text-transform: capitalize">{{$testpaper->title}}</span></td>
        </tr>
        <tr>
          <td><span style="font-weight: bold">Department: </span>Computer Science</td>
          <td><span style="font-weight: bold">Course's code: </span><span style="text-transform: capitalize">{{$testpaper->course->code}}</span></td>
        </tr>
        <tr>
          <td><span style="font-weight: bold">Option: </span><span style="text-transform: capitalize">{{$testpaper->course->option}}</span></td>
          <td><span style="font-weight: bold">Course's title: </span><span style="text-transform: capitalize;">{{$testpaper->course->title}}</span></td>
        </tr>
        <tr>
          <td><span style="font-weight: bold">Year: </span><span style="text-transform: capitalize">{{$testpaper->course->year}}</span></td>
          <td><span style="font-weight: bold">Course's credit: </span><span style="text-transform: capitalize">{{$testpaper->course->credit}}</span></td>
        </tr>
        <tr>
          <td><span style="font-weight: bold">Lecturer's name: </span><span style="text-transform: capitalize">{{$testpaper->course->user->name}}</span></td>
          <td><span style="font-weight: bold">Lecturer's phone: </span><span style="text-transform: capitalize">{{$testpaper->phone}}</span></td>

        </tr>
      </tbody>
    </table>
    <legend></legend>
  </div>
  <!-- body -->

  <div>
  <h3 style="text-align: center; color: rgb(10, 101, 10); text-decoration: underline; margin: 40px 10px;">Correction</h3>
  @foreach ($testpaper->questions as $key=>$question)
    <div style=" margin-bottom: 20px; margin-top: 10px;">
      <p><i class="fa fa-ban"><span style="font-weight: bold">{{$key + 1}}&nbsp;-&nbsp;&nbsp;&nbsp;{{$question->text}}</span></p>
      foreach ($question->map->distractors as $dist)
      {{$dist}}
      <div style=" margin-left: 22px; margin-bottom: 30px; margin-top: 20px;">
          @if ($dist->isCorrect)
            <p><i class="fa fa-check"></i>{{$dist->text}}</p>
          @else
            <p><i class="fa fa-ban"></i>{{$dist->text}}</p>
          @endif
        </div>
        
      endforeach
    </div>
  @endforeach

     
</div>
</body>
</html>