@extends("front.master")

@section('content')
<div class="card-group vgr-cards" >
	<div style="text-align: center;">
		<img src="assets/client/images/letter-b.png" style="width: 250px;  height: 250px">
	</div>
	<div class="container" style="margin-bottom: 5em">
		<blockquote class="blockquote-reverse">
		    <p>Xin chào đằng ấy, Tui là Biên - Nguyễn Quốc Biên. Anh em thì hay gọi là Bum hay Bium. Sao cũng được ^^. Đây là nơi mà bạn có thể đặt câu hỏi cho tui. À. Trong này có chỗ thú vị để chọn hình và tải lên, để tăng màu sắc cho câu hỏi thôi ^^, không thích thì không tải cũng được :(.<br> <span class="text-danger">Còn ngại gì mà không bấm vào dấu ? bên dưới!</span></p>
		    <footer>Bium Nguyễn</footer>
	  	</blockquote>
	  	<div style="text-align: center;" id="question">
			<img src="assets/client/images/question1.png" 
			style="width: 150px;  height: 150px;border-radius: 50%;box-shadow: 10px 2px;" 
			onmouseleave="revertImg(this)" onmouseover="changeImg(this)"
			onclick="addQuestion()">
		</div>
	</div>
<!-- ========================================== -->
	<div class="row">
		@foreach($questions as $q)
		<div  class="col-xs-12 col-md-4" style="padding-top: 1em;">
		<div class="card img-fluid">
			<div style="width: 80%; margin-left: auto; margin-right: auto;background: white;padding: 2em;">
				<p style="height: 350px">
					@if($q->img)
						<img class="card-img-top" src="{{$q->img}}" alt="Card image" style="width:100%; max-height: 350px;">
					@else
						@if($q->gender == 1)
						<img class="card-img-top" src="assets/client/images/male.png" alt="Card image" style="width:100%;max-height: 350px;">
						@endif
						@if($q->gender == 2)
						<img class="card-img-top" src="assets/client/images/female.png" alt="Card image" style="width:100%;max-height: 350px;">
						@endif
						@if($q->gender == 3)
						<img class="card-img-top" src="assets/client/images/unknow.png" alt="Card image" style="width:100%;max-height: 350px;">
						@endif
					@endif
				</p>
				<div class="card-img-overlay">
					<h4 class="card-title"><span class="label label-info">Ai đó:</span> <b>{{$q->question}}</b></h4>
					<h4 class="card-text"><span class="label label-warning">Bium:</span> {{$q->answer["answer"]}}</h4>
				</div>
			</div>
		</div>
		</div>
  @endForeach
	</div>
	{{ $questions->links() }}
</div>
<!-- ===================Modal to add question========== -->
<div id="addQuestion" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bạn muốn hỏi gì? ^^</h4>
      </div>
      <div class="modal-body">
      	<form id="questionForm" method="post" action="addQuestion" enctype="multipart/form-data">
  		{{csrf_field()}}
        <p class="form-group">
        	<label>Bạn là</label><br>
        	<span class="text-muted">Bỏ qua nếu bạn không muốn tiết lộ</span>
        	<select name="gender" class="form-control">
        		<option value="3">Chọn giới tính</option>
        		<option value="1">Nam</option>
        		<option value="2">Nữ</option>
        	</select>
        </p>
        <p class="form-group">
        	<label>Hình ảnh cho câu hỏi</label><br>
        	<span class="text-muted">Bỏ qua nếu bạn không muốn tải hình</span>
        	<input type="file" name="img" class="form-control">
        </p>
        <p class="form-group">
        	<label>Câu hỏi của bạn</label><br>
        	<span class="text-muted">Đây là phần không thể bỏ qua ^^</span>
        	<input type="text" name="question" placeholder="Hỏi đi nào" class="form-control" required="true">
        </p>
      </div>
      
      <div class="modal-footer">
      	<input type="submit" class="btn btn-success" value="Hỏi ngay">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      <form>
    </div>

  </div>
</div>
<!-- ================================ -->
<!-- Modal -->
<div id="messageModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-success"><b>Tin nhắn từ hệ thống</b></h4>
      </div>
      <div class="modal-body text-primary">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@if (session('message'))
	<input type="hidden" value="{{session('message')}}" id="message">
@endif
<!-- ================================ -->
<script type="text/javascript">
	$(document).ready(function() {
		var message = $('#message').val();
		if(message != null) {
			console.log(message);
			$('#messageModal').find('div.modal-body').html('<b>' + message + '</b>')
			$('#messageModal').modal('show');
		}
	});

	$.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
	function changeImg(elm) {
		$(elm).attr('src', "assets/client/images/question2.png");
		$(elm).css('cursor','pointer');
	}

	function revertImg(elm) {
		$(elm).attr('src', "assets/client/images/question1.png")
	}

	function addQuestion() {
		var modal = $('#addQuestion');
		modal.modal();
	}


	// function makeQuestion(elm) {
	// 	var messageModal = $('#messageModal');
	// 	var questionModal = $(elm).parents('#addQuestion');
	// 	var question = $(questionModal).find('.modal-body input[name="question"]').val();
	// 	var imgFile = $(questionModal).find('input[type="file"]');

	// 	console.log(imgFile);
	// 	if(question == '') {
	// 		messageModal.find('.modal-body').html('<b>Bạn chưa đặt câu hỏi kì</b>');
	// 		return;
	// 	}

	// 	var gender = questionModal.find('input[name="gender"]').val();
	// 	var formData = new FormData();
	// 	formData.append('question', question);

	// 	formData.append("gender", gender);

	// 	formData.append("img", imgFile);
	// 	$.ajax({
	// 	    type: "POST",
	// 	    url: "admin/addAnswer",
	// 	    data: formData,
	// 	    success: function (data) {
	// 	        console.log(data);
	// 	    },
	// 	    error: function () {
	// 	    	messageModal.find('.modal-body').html("<b>Có lỗi rồi. So sorry. Thử lại sau nhé ^^</b>");
	// 	    	messageModal.modal('show');
	// 	    }
	// 	});
	// }
</script>
@stop
