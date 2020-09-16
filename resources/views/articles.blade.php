@extends('layouts.app')

@section('content')

<script type="text/javascript">
    function EnableDisableTextBox(chkPassport) {
        var txtPassportNumber = document.getElementById("txtPassportNumber");
        txtPassportNumber.disabled = chkPassport.checked ? false : true;
        if (!txtPassportNumber.disabled) {
            txtPassportNumber.focus();
        }
    }
</script>




<div class="container" style="height: 500px; width: 98%; margin-left: 30px;">
<form method="POST" action="{{ route('article.post') }}">
@csrf
<div class="container" style="margin-left: 0px; width: 98%; margin-bottom: 20px;">

<a href="{{ route('home') }}" class="btn btn-danger btn-sm" style="margin-left:0px;" >Discard</a>
<input type="submit" value="Save" name="submit" class="btn btn-sm btn-success" style="margin-left: 88%; ">
</div>
<select name="category" class="form-group" style="width: 300px; height: 50px; float:left;">
<option default disabled>Select Category</option>
<option value="Education">Education</option>
<option value="Technology">Technology</option>
<option value="Lifestyle">Lifestyle</option>
<option value="Health">Health</option>
<option value="Career">Career</option>
<option value="Current Affairs">Current_Affairs</option>
<option value="Society">Society</option>
</select>
<input type="text" name="topic" class="form-group" style="width: 300px; height: 50px; float:left; margin-left: 20px;" placeholder="Topic">
<input type="text" name="subtopic" class="form-group" style="width: 300px; height: 50px; margin-left: 20px;" placeholder="Subtopic">



<input type="text" name="exturl" class="form-group" style="width: 300px; height: 50px; margin-left: 0px;" placeholder="External URLS (Comma seperated)">
<input type="text" name="asso" class="form-group" style="width: 300px; height: 50px; margin-left: 20px;" placeholder="Associated Article ID (Comma Sepearated)">
<label for="home" style="color: white; margin-left:20px;">Show card on home?</label>
<input type="checkbox" name="home" class="form-group" style="width: 20px; height: 20px; margin-left: 5px;" id="chkPassport" onclick="EnableDisableTextBox(this)">
<input type="number" min=1 name= "priority" id="txtPassportNumber" disabled="disabled" class="form-group" style="width: 80px; height: 50px; margin-left: 20px;" placeholder="Priority">
<textarea cols="60" rows="10" id="content" name="content" > 
&lt;h1&gt;Article Title&lt;/h1&gt;
&lt;p&gt;Here's some sample text&lt;/p&gt;
</textarea>
<script type="text/javascript">
CKEDITOR.replace( 'content' );
</script>


<div class="container" id="dynamicInput" style="margin-top:8px; ">
<table>
<tr>
<td>
<label for="prop" style="margin-right: 5px; color: azure; text-align:center;">Property Yes / No</label>  

<input type="checkbox" name="prop[]" class="form-group" style="width:20px; height:20px; margin-right: 5px;" value="property">

<input type="checkbox" name="prop[]" class="form-group" style="width:20px; height:20px; margin-right: 5px;" value="name" checked>    
</td>
<td style ="padding-top: 10px;">
<select class="form-group" name="meta[]" style="width: 300px; height:50px;">
            <option disabled>Meta Property/Type</option>
            <option>Keyword</option>
            <option>Description</option>
            <option>Owner</option>
            <option>Title</option>
            <option>og:site_name</option>
            <option>og:type</option>
            <option>og:title</option>
            <option>og:url</option>

</select>
</td>
<td>
<textarea type="text" name="myInputs[]" style="width: 500px; height: 50px; margin-left: 20px; padding: 5px;" placeholder="Enter comma seperated content"></textarea>

</td>
<td>
<input type="button" class="btn btn-sm btn-info" onClick="addInput('dynamicInput');" style="margin-left: 20px;" value="Add Meta">
</td>
</tr>
</table>
</div>
 
</form>
</div>


<script>
var counter = 1;
var limit = 10;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "<table><tr><td><label for='prop' style='margin-right: 10px; color: azure; text-align:center;'>Property <br /> Yes / No</label> <br /> <input type='checkbox' name='prop[]' class='form-group' style='width:20px; height:20px; margin-right: 5px;' value='property'> <input type='checkbox' name='prop[]' class='form-group' style='width:20px; height:20px; margin-right: 5px;' value='name' checked></td><td style='padding-top: 10px;'><select class='form-group' name='meta[]' style='width: 300px; height:50px;'> <option default>Meta Property/Type</option> <option>Keyword</option> <option>Description</option> <option>Owner</option> <option>Title</option> <option>og:site_name</option> <option>og:type</option> <option>og:title</option> <option>og:url</option> </select></td><td> <textarea type='text' name='myInputs[]' style='width: 500px; height: 50px; margin-left: 20px; padding: 5px;'></textarea></td></tr></table> ";
          document.getElementById(divName).appendChild(newdiv);
          counter++;
     }
}
</script>

@endsection