@extends('Admin.master')

@section('content')
<div class="page-header">
  <h1>Đổi mật khẩu</h1>
</div>
<div class="content">
	<form class="w3-container" method="post" action="">
    {{csrf_field()}}    
    <label class="w3-text-brown"><b>Mật khẩu mới</b></label>
    <input class="w3-input w3-border w3-sand" name="newPassword" type="password" required="true"></p>
    <p>
    <p>      
    <label class="w3-text-brown"><b>Nhập lại</b></label>
    <input class="w3-input w3-border w3-sand" name="retype" type="password" required="true"></p>
    <p>
    <input class="w3-btn w3-brown" type="submit" value="Đổi mật khẩu" /></p>
  </form>
</div>
@stop
