@extends("front.master")

@section('content')
<div class="login" style="">
    <div style="padding: 20%">
      <div>
           @if (count($errors) >0)
               <ul>
                   @foreach($errors->all() as $error)
                       <li class="text-danger"> {{ $error }}</li>
                   @endforeach
               </ul>
           @endif

           @if (session('status'))
               <ul>
                   <li class="text-danger"> {{ session('status') }}</li>
               </ul>
           @endif
           <form action="{{ asset('') }}login" method="post">
               {{ csrf_field() }}
               <div class="form-group has-feedback">
                   <input type="text" class="form-control" name="username" placeholder="User name">
               </div>
               <div class="form-group has-feedback">
                   <input type="password" class="form-control" placeholder="Password" name="password">
               </div>
               <div class="row">
                   <div class="col-xs-4">
                       <input value="Sign In" type="submit" class="form-control btn btn-primary"/>
                   </div>
                </div>
         </div>
     </form>
      </div>
      <div class="col-md-6 login-right">
          
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
@stop