@extends('layout.app',["title"=>"Create User"])

@section('content')

<p class="h1">Create User</p>
<form>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username">
        <small class="error-text text-danger error-text-username d-none"></small>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name">
        <small class="error-text text-danger error-text-name d-none"></small>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password">
        <small class="error-text text-danger error-text-password d-none"></small>
    </div>
    <button type="submit" class="btn btn-primary" id="btn-submit">Submit</button>
</form>
@endsection

@push('js')
<script>
    $(function(){
        let baseurl = "{{ $baseurl }}/"
        
        $("#btn-submit").on("click",function(){
            event.preventDefault()
            $.ajax({
                url: baseurl+"user",
                method:"post",
                dataType:"json",
                data:{
                    username:$("#username").val(),
                    name:$("#name").val(),
                    password:$("#password").val(),
                },
                error:function(err){
                    console.log(err.responseJSON);

                    $(".error-text").removeClass("d-none").addClass("d-none")
                    $.each(err.responseJSON,function(key, value){
                        $(".error-text-"+key).html(value)
                        $(".error-text-"+key).removeClass("d-none")
                    })
                },success:function(res){
                    console.log(res);
                    Swal.fire({
                        title: 'Saved!',
                        text:  'New user created',
                        icon: 'success',
                        })
                        $("#username").val("")
                        $("#name").val("")
                        $("#password").val("")
                        $(".error-text").removeClass("d-none").addClass("d-none")
                }
            })
        })
    })
</script>
@endpush

@push('css')
@endpush