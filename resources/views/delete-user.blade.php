@extends('layout.app',["title"=>"Delete User"])

@section('content')

<p class="h1">User List</p>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="table-body">
    </tbody>
</table>
<ul id="pagination" class="pagination-sm"></ul>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>
<script>
    $(function(){
        let baseurl = "{{ url('') }}/"
        let apiurl = "{{ $apiurl }}/"
        let limit = {{ $limit }}
        let offset = {{ $offset }}
        let totalPages = {{ $total_pages }}

        $('#pagination').twbsPagination({
            totalPages: totalPages,
            visiblePages: 5,
            next: 'Next',
            prev: 'Prev',
            onPageClick: function (event, page) {
                $.ajax({
                    url:baseurl+"get-users",
                    method:"get",
                    dataType:"json",
                    data:{
                        limit:limit,
                        offset:(page == 0 ? 0: page-1)*limit
                    },
                    error:function(err){
                        console.log(err);
                    },success:function(res){                    
                        let output=""
                        let counter = parseInt(res.offset) + 1
                        $.each(res.data,function(key, value){
                            output += `
                            <tr>
                                <td>`+(counter++)+`</td>
                                <td>`+value.username+`</td>
                                <td>`+value.name+`</td>
                                <td><button class="btn btn-danger btn-delete" data-id="`+value.id+`"><i class="fa fa-trash"></i> Delete</button></td>
                            </tr>
                            `
                        })
                        $("#table-body").html(output)
                    }
                })
            }
        })

        $("#table-body").on("click",".btn-delete",function(){
            let id = $(this).data("id");
            Swal.fire({
                title:"Delete this user?",
                text: "User's ID is "+ id,
                icon:"warning",
                showCancelButton: true,
            }).then((result)=>{
                if(result.isConfirmed){
                    $.ajax({
                        url: apiurl+"user/"+id,
                        method:"delete",
                        error:function(err){
                            console.log(err);
                        },success:function(res){
                            console.log(res);
                        }
                    })
                }
            })
        })
    })
</script>
@endpush

@push('css')
<style>
    #pagination {
        display: inline-block;
        margin-bottom: 1.75em;
    }

    #pagination li {
        display: inline-block;
    }

    .page-content {
        background: #eee;
        display: inline-block;
        padding: 10px;
        width: 100%;
        max-width: 660px;
    }
</style>
@endpush