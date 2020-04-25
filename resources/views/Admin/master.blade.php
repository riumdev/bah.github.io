<!DOCTYPE html>
<html>
<head>
	<title>Dashboard | Bium admin page</title>
	<base href="{{ asset('public') }}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style type="text/css">
		.modal {
		  text-align: center;
		  padding: 0!important;
		}

		.modal:before {
		  content: '';
		  display: inline-block;
		  height: 100%;
		  vertical-align: middle;
		  margin-right: -4px;
		}

		.modal-dialog {
		  display: inline-block;
		  text-align: left;
		  vertical-align: middle;
		}
	</style>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
<!-- navbar -->
@include("Admin.shareView.header")
<!-- ./ navbar -->
<!-- content -->
<section class="container">
@yield('content')
</section>
<!-- ./ content -->
<!-- footer -->
<!-- TODO: user new solution for footer -->
<!-- ./ footer -->
<!-- =================== script ==================== -->
@yield('script')
<!-- ======================== messgae from system ============ -->
@if (session('thongbao'))
  <input type="hidden" value="{{session('thongbao')}}" id="message">
@endif
<!--========================= message modal ============== -->
<!-- Modal -->
<div id="messageModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tin nhắn từ hệ thống</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- =============================================== -->
<script type="text/javascript">
	 $(document).ready(function() {
    var message = $('#message').val();
    if(message != null) {
      console.log(message);
      $('#messageModal').find('div.modal-body').html('<b>' + message + '</b>')
      $('#messageModal').modal('show');
    }
  });
</script>
</body>
</html>