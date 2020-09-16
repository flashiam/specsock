@extends('layouts.app')

@section('content')
<div class="container" style="margin-left: 0px; owerflow-x: break-word;">
<h5 style="margin-left: 2%; background-color: grey; color: white; padding: 6px; padding-left: 20px;"><b>Location:</b>                  {{      $dir}}</h5>
@if($exist == 'true')
@if($files[0][0] != null)
<h5 style="margin-left: 30px; font-weight: bold; color: azure;">Files</h5>
<table>
@for($j=0; $j<=count($files)-1; $j++)
<tr>
@for($i=0; $i<=count($files[$j])-1; $i++)
<td style="padding-left:50px;">
<a href="/{{ $dir }}{{ $files[$j][$i] }}" target="_blank">
<div class="container" style=" border: 1px none black; margin-bottom: 50px; margin-left:40px; padding: 10px;">
<img src= "{{ asset('images/file.png') }}" style="width: 50px; height:50px;">
<p style="color: white; font-weight: bold;">{{ $files[$j][$i] }}</p>
</div>
</a>
</td>
@endfor
</tr>
@endfor
</table>
@endif

@if($asset[0][0] != null)
<h5 style="margin-left: 30px; font-weight: bold; color: azure;">Folder</h5>
<table>

@for($j=0; $j<=count($asset)-1; $j++)
<tr>
@for($i=0; $i<=count($asset[$j])-1; $i++)
<td style="padding-left:50px;">
<a href="/{{ $dir }}{{ $asset[$j][$i] }}">
<div class="container" style=" border: 1px none black; margin-bottom: 50px; margin-left:40px; padding: 10px;">
<img src= "{{ asset('images/folder.png') }}" style="width: 50px; height:50px;">
<p style="color: white; font-weight: bold;">{{ $asset[$j][$i] }}</p>
</div>
</a>
</td>
@endfor
</tr>
@endfor
</table>
@endif
@else
<h2 style="font-align:center; color: #b6ced4; font-weight: bold; margin-left: 30%;">This Folder is empty.</h2>
<img src="{{ asset('/images/empty.png') }}" style="width:100px; height: 100px; margin-left: 40%;">
@endif
</div>
@endsection