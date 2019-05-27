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
    #users td{
      border: 1px solid black;
    }
  </style>     

</head>
<body 
  style="
    color: black; font-size: 14px; 
    border: double 2px rgb(10, 101, 10);
  "
> 
  <!-- setting the background blurred image -->
  <div style="position: absolute; opacity: 0.3; left: 50%;top: 40%; transform: translate(-50%,0); position: absolute; z-index: 1 ">
    <img src="./images/logo.png" style="height: 160px">
  </div>
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

      <table id="users" style="width: 100%; padding: 0 5px;">
        <tr>
          <td></td>
          <td style=" padding: 6px; font-weight: bold">Matricule</td>
          <td style=" padding: 6px; font-weight: bold">Name</td>
          <td style=" padding: 6px; font-weight: bold">Phone</td>
          <td style=" padding: 6px; font-weight: bold">Mark / {{$testpaper->over_mark}}</td>
        </tr>
        <tbody>
          @foreach ($users as $user)
            <tr> 
              <td>1</td>
              <td style="padding: 6px;"> <span style="text-transform: uppercase">{{$user->matricule}}</span></td>
              <td style="padding: 6px;"> <span style="text-transform: capitalize">{{$user->name}}</span></td>
              <td>{{$user->phone}}</td>
              <td>{{$user->user_written_papers[0]->pivot->mark_obtained}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <h3 style="text-align: center; color: rgb(10, 101, 10); text-decoration: underline; margin: 40px 10px;">Fundamental Computer Science's results</h3>
      <!-- fcs results -->
      <table id="users" style="width: 100%; padding: 0 5px;">
          <tr>
            <td></td>
            <td style=" padding: 6px; font-weight: bold">Matricule</td>
            <td style=" padding: 6px; font-weight: bold">Name</td>
            <td style=" padding: 6px; font-weight: bold">Phone</td>
            <td style=" padding: 6px; font-weight: bold">Mark / {{$testpaper->over_mark}}</td>
          </tr>
          <tbody>
            @foreach ($fcsUsers as $user)
              <tr> 
                <td>1</td>
                <td style="padding: 6px;"> <span style="text-transform: uppercase">{{$user->matricule}}</span></td>
                <td style="padding: 6px;"> <span style="text-transform: capitalize">{{$user->name}}</span></td>
                <td>{{$user->phone}}</td>
                <td>{{$user->user_written_papers[0]->pivot->mark_obtained}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <!-- ict results -->
        <h3 style="text-align: center; color: rgb(10, 101, 10); text-decoration: underline; margin: 40px 10px;">Information and Communication Technology's results</h3>

        <table id="users" style="width: 100%; padding: 0 5px;">
        <tr>
          <td></td>
          <td style=" padding: 6px; font-weight: bold">Matricule</td>
          <td style=" padding: 6px; font-weight: bold">Name</td>
          <td style=" padding: 6px; font-weight: bold">Phone</td>
          <td style=" padding: 6px; font-weight: bold">Mark / {{$testpaper->over_mark}}</td>
        </tr>
        <tbody>
          @foreach ($ictUsers as $user)
            <tr> 
              <td>1</td>
              <td style="padding: 6px;"> <span style="text-transform: uppercase">{{$user->matricule}}</span></td>
              <td style="padding: 6px;"> <span style="text-transform: capitalize">{{$user->name}}</span></td>
              <td>{{$user->phone}}</td>
              <td>{{$user->user_written_papers[0]->pivot->mark_obtained}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
</body>
</html>