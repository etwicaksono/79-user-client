@extends('layout.app',["title"=>"Home"])

@section('content')

<p class="h1">User List</p>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody id="table-body">
        @foreach ($data as $key=>$item)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $item["username"] }}</td>
            <td>{{ $item["name"] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<ul id="pagination" class="pagination-sm"></ul>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>
<script>
    $(function(){
        let baseurl = "{{ url('') }}/"
        let limit = {{ $limit }}
        let offset = {{ $offset }}
        let totalPages = {{ $total_pages }}

        $('#pagination').twbsPagination({
        totalPages: totalPages,
        visiblePages: 5,
        next: 'Next',
        prev: 'Prev',
        onPageClick: function (event, page) {
            //fetch content and render here
            $('#page-content').text('Page ' + page) + ' content here';
            console.log("event");
            console.log(event);
            console.log("page");
            console.log(page);

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
                    console.log(res);
                    
                    let output=""
                    let counter = parseInt(res.offset) + 1
                    $.each(res.data,function(key, value){
                        output += `
                        <tr>
                            <td>`+(counter++)+`</td>
                            <td>`+value.username+`</td>
                            <td>`+value.name+`</td>
                        </tr>
                        `
                    })
                    $("#table-body").html(output)
                }
            })
        }
    });
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