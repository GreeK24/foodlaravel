@extends('layouts.app')
@section('content')


<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<div class="card">
                <div class="card-body">
                    <h4 class="card-title">ADD Category </h4>
                    <h6 class="card-subtitle">Create newest categories by managing <code>.DB</code></h6>

                    <!-- FORM -->
                    <div class="spacer"></div>
                <p class="alert-succes">
                <?php
                    $message = Session::get('message');
                    if($message) {
                        echo $message ;      
                        Session::put('message', NULL);
                    }
                ?>
                </p>
                    <form method="POST" action="{{route('categories.store')}}" files="true" enctype="multipart/form-data">
                    	@csrf


                         <div class="form-group">
                            <label for="">Logo</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                              </div>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                  aria-describedby="inputGroupFileAddon01" name="image">
                                <label class="custom-file-label" for="inputGroupFile01" value="{{ old('image') }}"></label>
                              </div>
                            </div>
                        </div>
                        {!! $errors->first('image', '<p class="text-danger">:message</p>') !!}


                    	<div class="form-group">
                    		<label for="">Category Name</label>
                    		<input type="text" class="form-control" placeholder="Enter Username Unique" name="name" value="{{ old('name') }}">
                    	</div>
                    	{!! $errors->first('name', '<p class="text-danger">:message</p>') !!}

                    	<div class="form-group">
                    		<label for="">Category Description</label>
                    		<textarea class="form-control" name="description">  
                            </textarea>

                    	</div>
                    	{!! $errors->first('description', '<p class="text-danger">:message</p>') !!}

    						

						    <div class="col-md-12 text-center"> 
    							<button id="singlebutton" name="singlebutton" class="btn btn-primary">Create!</button> 
							</div>
						  
						  

                    	

                    </form>
                	
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="card">
				<div class="card-body">
					<a href="{{route('categories.index')}}">
						<h4 class="card-title text-right text-info">
                            View All categories 
                            <span class="badge badge-info text-white">{{$categories->count()}}</span> 
                        </h4>   	
					</a>
					<hr>
					
				</div>
			</div>
		</div>
	</div>
</div>


@endsection