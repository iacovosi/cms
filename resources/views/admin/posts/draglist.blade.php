@extends('layouts.app')

@section('styles')
   <!-- Datatables Js-->
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
@stop


@section('content')

<!-- search box container starts  -->
<div class="row">
<div class="col-lg-12">  
<div class="search">
    <div class="row">
        <div class="col-lg-12">      
        <h3 class="text-center title-color">Drag and Drop/Sort/Delete/Edit Articles </h3>
          <p>&nbsp;</p>
        </div>
      </div>
      <div class="row">
          <div class="col-lg-12">
              <table id="table" class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>               
                    <th>Change Status</th>
                    <th>Category</th>                         
                    <th>Order</th>                    
                    <th>Created At</th>
                    <th>Edit</th>                    
                    <th>Delete</th>                    
                  </tr>
                </thead>
                <tbody id="tablecontents">
                  @foreach($posts as $post)
                  <tr class="row1" data-id="{{ $post->id }}">
                    <td>
                        {{ $post->id }}
                    </td>
                    <td>
                      {{ $post->title }}
                    </td>
                    <td >
                      <div id="statuspost{{ $post->id }}">
                      {{ ($post->status == 1)? "Show" : "Hidden" }}
                      </div>
                    </td>
                    <td>
                        <input name="status" type="checkbox" value="on" class="changestatus" id="{{ $post->id }}"
                        @if ($post->status==1) 
                             checked = "checked"
                        @endif 
                       >
                    </td>
                    <td>
                      @if (isset($categories[$post->category->id]) && !empty($categories[$post->category->id]))
                        {{$categories[$post->category->id]}}
                      @else
                        Deleted Category?
                      @endif
                    </td>
                    <td>
                        {{ $post->order }}  
                    </td>                    
                    <td>
                      {{ date('d-m-Y h:m:s',strtotime($post->created_at)) }}
                    </td>
                    <td>
                        <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-xs btn-info">Edit</a>
                    </td>
                    <td>
                        <a href="{{ route('post.delete', ['id' => $post->id]) }}" class="btn btn-xs btn-danger">Delete</a>
                  </td>                    
                  </tr>
                  @endforeach
                </tbody>                  
              </table>
          </div>
      </div>
      <div class="row">
      <div class="col-lg-12">
      <h5>Drag and Drop the table rows and <button class="btn btn-default" onclick="window.location.reload()"><b>REFRESH</b></button>
      </div>
      </div>
      </div>
      </div>
    </div>  
  </div>
</div>  
    @stop




@section('scripts')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>
 
  <!-- Datatables Js-->
  <script type="text/javascript" src="//cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

  <script type="text/javascript">

  $(function () {
    $("#table").DataTable();

    $( "#tablecontents" ).sortable({
      items: "tr",
      cursor: 'move',
      opacity: 0.6,
      update: function() {
          sendOrderToServer();
      }
    });

    $(".changestatus").change(function() {

        var val=[];
        var idkeep=$(this).attr("id");
        var checked=this.checked;
        if(this.checked) {
          val.push({
          id: $(this).attr("id"),
          status: 1
        }); 
        }
        else {
          val.push({
          id:  $(this).attr("id"),
          status: 0
        });          
        }

      $.ajax({
        type: "POST", 
        dataType: "json", 
        url: "{{ route('posts.updatestatus') }}",
        data: {
          val:val,
          _token: '{{csrf_token()}}'
        },
        success: function(response) {
            if (response.status == "success") {
              console.log(response);
              if(checked) {              
                $("#statuspost"+idkeep).html("Show");
              }
              else {
                $("#statuspost"+idkeep).html("Hidden");
              }
            } else {
              console.log(response);
              alert("Error on Requesting!");
              //revert changes
              if(checked) {              
                this.attr('checked', false);
              }
              else {
                this.attr('checked', true);             
            }
        }
        }
        ,
        error: function( jqXHR, textStatus, errorThrown ) {
            //alert();
            console.log(textStatus);
            console.log(errorThrown);
		  }        
      });
     
    });

    function sendOrderToServer() {

      var order = [];
      $('tr.row1').each(function(index,element) {
        order.push({
          id: $(this).attr('data-id'),
          position: index+1
        });
      });

      $.ajax({
        type: "POST", 
        dataType: "json", 
        url: "{{ route('posts.sortabledatatable') }}",
        data: {
          order:order,
          _token: '{{csrf_token()}}'
        },
        success: function(response) {
            if (response.status == "success") {
              console.log(response);
            } else {
              console.log(response);
            }
        }
        ,
        error: function( jqXHR, textStatus, errorThrown ) {
            //alert();
            console.log(textStatus);
            console.log(errorThrown);
		  }        
      });

    }
  });

</script>  


@stop