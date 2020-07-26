{{-- layout: resources/views/layouts/master.blade.php --}}
@extends('layouts.master')


@section('title')
    @parent
        YouTube API
@endsection

@section('main')
    @parent
        <p>Enter a search term and retrieve the latest YouTube Videos</p> 
@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
    		<form>
			    @csrf
			    <label>Search Youtube</label>
		    	<div class="input-group">
		    		<input type="text" name="query" id="query" class="form-control" placeholder="Search for YouTube Videos" />
		    		<span class="input-group-btn">
					     <button type="submit" class="js-button-submit btn btn-default">
		                	<span class="glyphicon glyphicon-search"></span>
		            	</button>
		            </span>
				</div>
			</form>
		</div>
	</div>
	<div id="vidsResults" class="row">
		
	</div>
	
	<script type="text/javascript">
	   $(document).ready(function() { 
		    
		    $(".js-button-submit").click(function(e){
		 	    e.preventDefault();
		        
		 	    var _token = $("input[name='_token']").val();
		    	var query  = $("input[name='query']").val();

		        $.ajax({
		           type:'POST',
		           url: "{{ route('index.form') }}",
		           data:{_token:_token, query:query},

		           success:function(data){
		           	$("#vidsResults").empty();
		           	i = 0;
         		    $.each(data.vids,function(id){

         		    	vidhtml = '<div class="col-md-6"><iframe width="100%" height="315" src="https://www.youtube.com/embed/'+data.vids[id]+'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
                   		$("#vidsResults").append(vidhtml);

                    });
		           }

		        });
		  
			});
		}); 
	</script>

@endsection
