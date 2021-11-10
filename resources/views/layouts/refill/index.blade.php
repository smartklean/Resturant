@extends('layouts.dashboard')

@section('content')


    

    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div id="DeleteModal" class="modal fade text-danger" role="dialog">
           <div class="modal-dialog ">
             <form action="" id="deleteForm" method="GET">
                 <div class="modal-content">
                     <div class="modal-header bg-danger">
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                         <h4 class="modal-title text-center">DELETE CONFIRMATION</h4>
                     </div>
                     <div class="modal-body">
                         {{ csrf_field() }}
                         <!-- {{ method_field('DELETE') }} -->
                         <h4 class="text-center"> You're about to delete Suppliers Details ?</h4>
                     </div>
                     <div class="modal-footer">
                         <center>
                             <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                             <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Yes, Delete</button>
                         </center>
                     </div>
                 </div>
             </form>
           </div>
        </div>


        <form class="navbar-form pull-right" action="{{ route('refill') }}" method="get">
            @csrf
            <div class="form-group pull-left">
                <input type="text" name="search" class="form-control" placeholder="Enter keyword" />
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </form>
        <br><br>
        <div class="mytable">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Product's Name</th>
                            <th>Product's Category</th>
                            <th>Product's Image</th>
                            <th>Quantity</th>
                            <th>Date Registered</th>
                            <th>Action(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                         
                        @forelse($products as $index => $pass)
                            <tr>
                                <td>{{ ($products->currentpage()-1) * $products->perpage() + $index + 1 }} </td>
                                <td>{{$pass->name}} </td>
                                <td>{{$pass->category->name}}</td>
                                <td><div class="sidebar-profile-image">
                                    <img src="product_images/{{$pass->logo}}" class=" img-responsive" alt="" lenght="50px" width="50px">
                                </div></td>
                                <td>{{$pass->quantity}}</td>
                                <td>{{$pass->created_at}}</td>
                                <td colspan="2">
                                    <a class="btn btn-primary fa fa-book" href="{{ route('refill.edit', $pass->id) }}"></a> 
                                   &nbsp;¦¦&nbsp;
                                    <a href="javascript:;" data-toggle="modal" onclick = "deleteData({{$pass->id}})" data-target="#DeleteModal" class="btn btn-danger fa fa-trash"></a>
                                </td>  
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Produc available </td>
                            </tr>
                        @endforelse
                    
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
   

@endsection
