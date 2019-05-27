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
    body{
      color: black;
      font-size: 14px;
    }
    .bold {
      font-weight: bold;
    }
    .test-header {
    }
  </style>
</head>
<body>
<div id="results">
        <div class="test-header">
            <table style="width: 100%">                
              <tbody>
                <tr>
                  <td><span class="bold">Department: </span>Computer Science</td>
                  <td rowspan = "4">
                    <img src="./images/logo-enset.png" alt="ENSET logo" style="height: 81px;">
                  </td>
                  <td><span class="bold">Test Title: </span>{{$testpaper->title}}</td>
                </tr>
                <tr>
                  <td><span class="bold">Option: </span>{{$testpaper->course->option}}</td>
                  <td><span class="bold">Course's code </span>{{$testpaper->course->code}}</td>
                </tr>
                <tr>
                <td><span class="bold">Lecturer's name: </span>{{$teacher->name}}</td>
                  <td><span class="bold">Course's title: </span>{{$testpaper->course->title}}</td>
                </tr>
                <tr>
                  <td><span class="bold">Lecturer's email </span>{{$teacher->email}}</td>
                  <td><span class="bold">Course's credit: </span>{{$testpaper->course->credit}}</td>
                </tr>
              </tbody>
            </table>
          </div>    
    </div>
</body>
</html>