<!DOCTYPE html>
<html>
<head>
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">  
  <style>
    .users td{
      border: 1px solid #9c9c9c;
      padding: 7px;
    }
    .users{
      border-collapse: collapse;
      border-spacing: 0;
      width: 100%;
      margin: 0px 5px;
    }
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
          <td><span style="font-weight: bold">School: </span>H.T.T.T.C Bamenda-Bambili</td>
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
        <td><span style="font-weight: bold">Lecturer's name: </span><span style="text-transform: capitalize">{{$teacher->name}}</span></td>
          <td><span style="font-weight: bold">Writing date: </span><span style="text-transform: capitalize">{{$testpaper->date}}</span></td>
        </tr>
          <td><span style="font-weight: bold">Lecturer's phone: </span><span style="text-transform: capitalize">{{$teacher->phone}}</span></td>
          <td><span style="font-weight: bold">Printed at: </span><span style="text-transform: capitalize">{{$now}}</span></td>
        </tr>
      </tbody>
    </table>
    <legend></legend>
  </div>
  <!-- body -->
  <div>
    @if (!$testpaper->common && isset($users))
      <h3 style="text-align: center; color: rgb(10, 101, 10); text-decoration: underline; margin: 40px 10px;">Test's results</h3>

      <table class="users">
        <tr>
          <td style="border: none;"></td>
          <td style="  font-weight: bolder">Matricule</td>
          <td style="  font-weight: bolder">Name</td>
          <td style="  font-weight: bolder">Phone</td>
          <td style="  font-weight: bolder">Mark / {{$testpaper->over_mark}}</td>
        </tr>
        <tbody>
          @foreach ($users as $key=>$user)
            <tr> 
              <td>{{$key + 1}}</td>
              <td style=""> <span style="text-transform: uppercase">{{$user->matricule}}</span></td>
              <td style=""> <span style="text-transform: capitalize">{{$user->name}}</span></td>
              <td>{{$user->phone}}</td>
              @if ( $user->user_written_papers[0]->pivot->mark_obtained < $testpaper->over_mark / 2)
                <td style="color: #800000; font-weight: bold">{{$user->user_written_papers[0]->pivot->mark_obtained}}</td>
              @else
                <td>{{$user->user_written_papers[0]->pivot->mark_obtained}}</td>
              @endif

            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <h3 style="text-align: center; color: rgb(10, 101, 10); text-decoration: underline; margin: 40px 10px;">Fundamental Computer Science's results</h3>
      <!-- fcs results -->
      <table class="users">
          <tr>
            <td style="border: none;"></td>
            <td style="  font-weight: bold">Matricule</td>
            <td style="  font-weight: bold">Name</td>
            <td style="  font-weight: bold">Phone</td>
            <td style="  font-weight: bold">Mark / {{$testpaper->over_mark}}</td>
          </tr>
          <tbody>
            @foreach ($fcsUsers as $key => $user)
              <tr> 
                <td>{{$key + 1}}</td>
                <td style=""> <span style="text-transform: uppercase">{{$user->matricule}}</span></td>
                <td style=""> <span style="text-transform: capitalize">{{$user->name}}</span></td>
                <td>{{$user->phone}}</td>
                @if ( $user->user_written_papers[0]->pivot->mark_obtained < $testpaper->over_mark / 2)
                  <td style="color: #800000; font-weight: bold">{{$user->user_written_papers[0]->pivot->mark_obtained}}</td>
                @else
                  <td>{{$user->user_written_papers[0]->pivot->mark_obtained}}</td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>

        <!-- ict results -->
        <h3 style="text-align: center; color: rgb(10, 101, 10); text-decoration: underline; margin: 40px 10px;">Information and Communication Technology's results</h3>

        <table class="users">
        <tr>
          <td style="border: none;"></td>
          <td style="  font-weight: bold">Matricule</td>
          <td style="  font-weight: bold">Name</td>
          <td style="  font-weight: bold">Phone</td>
          <td style="  font-weight: bold">Mark / {{$testpaper->over_mark}}</td>
        </tr>
        <tbody>
          @foreach ($ictUsers as $key => $user)
            <tr> 
              <td>{{$key + 1}}</td>
              <td style=""> <span style="text-transform: uppercase">{{$user->matricule}}</span></td>
              <td style=""> <span style="text-transform: capitalize">{{$user->name}}</span></td>
              <td>{{$user->phone}}</td>
              @if ( $user->user_written_papers[0]->pivot->mark_obtained < $testpaper->over_mark / 2)
                <td style="color: #800000; font-weight: bold">{{$user->user_written_papers[0]->pivot->mark_obtained}}</td>
              @else
                <td>{{$user->user_written_papers[0]->pivot->mark_obtained}}</td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
    <h3 style="color: red; margin-top: 50px; text-align: center">If a student doesn't have marks, it means he/she didn't write this test!</h3>

  </div>
</body>
</html>