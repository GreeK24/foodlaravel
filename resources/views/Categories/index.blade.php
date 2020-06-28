@extends('layouts.app')
@section('content')
            <!-- Container fluid  -->

                   
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">categories Form </h4>
                                <h6 class="card-subtitle">Create newest categories by managing <code>.DB</code></h6>
                               
                                    
                                <div class="table-responsive">

                                
                                    <table class="table text-center" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>Category ID</th>
                                                <th>LOGO</th>
                                                <th>Category Name</th>
                                                <th>Category Description</th>
                                                <th>Manage</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                           @if($categories)
                                                @foreach($categories as $Category)

                                                <tr>

                                                    <td>{{$Category->id}}</td>

                                                    <td>
                                                        <img src="{{asset('images/Logo')}}/{{$Category->image}}" alt="" class="img-responsive" width="50">
                                                    </td>

                                                    <td><i class="fas fa-align-left" style="color: #8c8c8c"></i> {{$Category->name}}</td>
                                                    <td><i class="fas fa-quote-left" style="color: #00000073"></i> {{$Category->description}}</td>

                                                    <td>
                                                        <div>
                                                        <a href="{{ route('categories.edit', $Category->id) }}" class="badge badge-warning p-1 w-100">Edit</a>

                                                        <form action="{{ route('categories.destroy', $Category->id ) }}" method="post" onsubmit = " return confirmDelete()">
                                                          @csrf
                                                          @method('DELETE')
                                                            <button class="badge badge-danger p-1 w-100" type="submit" style="cursor: pointer;">Delete</button>
                                                        </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                  

                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
             
                <!-- ============================================================== -->
                
            </div>
<script>
    function confirmDelete() {
    return confirm('Are you sure you want to delete?');
}
</script>


        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
     @endsection   