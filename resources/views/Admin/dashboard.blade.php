@extends('Admin.master')

@section('content')
<div class="page-header">
  <h1>Danh sách câu hỏi</h1>
</div>
<div class="content">
	<ul class="list-group">
	@foreach($questions as $q)
    	<li class="list-group-item list-group-item-info">
    		<span class="label label-danger">Câu hỏi:</span> <span class="question">{{$q->question}}</span>
    		<span class="label label-success">Câu trả lời:</span> <span id="answer-section">@if($q->answer == null) <button class="btn-answer" id="{{$q->id}}" onclick="answerModal(this)">Trả lời ngay</button> <span class="answer">@else {{$q->answer->answer}}</span> @endif</span>
    	</li>
	@endforeach
  	</ul>
</div>
<!-- answer Modal -->
<div id="answerModal" class="modal" role="dialog" data-dropback="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <p class="input-group">
        	<label>Câu trả lời (có muối tí nha cu)</label>
        	<input type="text" name="answer" class="form-control"></input>
        </p>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-success" data-dismiss="modal" onclick="answer(this)">Trả lời</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
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
{{$questions->links()}}
@stop

@section('script')
<script type="text/javascript">
	$.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

	function answerModal(elm) {
		var parent = $(elm).parents('li');
		var question = parent.find('.question').text();
		var modal = $('#answerModal');
		modal.find('.modal-title').html('<b>' + question + '</b>');
    modal.find('input[name="answer"]').val('');
		modal.data('parent', parent);

		modal.modal();
	}

	function answer(elm) {
		// this elm is button `trả lời`
		var parent = $(elm).parents('.modal-content'); // modal-content element
		var answer = parent.find('input[name="answer"]').val();

		// get this question <li> from modal
		var parentLi = $('#answerModal').data('parent');
		var questionId = parentLi.find('button.btn-answer').attr('id');

		var messageModal = $('#messageModal');

		$.ajax({
		    type: "POST",
		    url: "admin/addAnswer",
		    data: {
		        questionId: questionId,
		        answer: answer
		    },
		    success: function (data) {
		        parentLi.find('#answer-section').html(data);
		    },
		    error: function () {
		    	messageModal.find('.modal-body').html("<b>Có lỗi rồi, nhắn cho rum đẹp trai đi đi! nói cho rum nghe m làm sao mà lỗi đi, rồi rum xử lí cho ^^</b>");
		    	messageModal.modal('show');
		    }
		});
	}
</script>
@stop