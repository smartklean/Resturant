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


        <form class="navbar-form pull-center" action="{{ route('supplier') }}" method="get">
            @csrf
            <div class="form-group pull-left">
                <input type="text" name="search" class="form-control" placeholder="Enter keyword" />
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </form>
        <form class="navbar-form pull-center" action="{{ route('supplier.new') }}" method="get">
            @csrf

            <button type="submit" class="btn btn-success pull-right" >New Supplier <i class="fa fa-plus"></i></button>
        </form>
        <br><br>
        <div class="mytable">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Supplier's Name</th>
                            <th>Supplier's Address</th>
                            <th>Supplier's Contact</th>
                            <th>Supplier's Code</th>
                            <th>Date Registered</th>
                            <th>Action(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                         
                        @forelse($suppliers as $index => $pass)
                            <tr>
                                <td>{{ ($suppliers->currentpage()-1) * $suppliers->perpage() + $index + 1 }} </td>
                                <td>{{$pass->name}} </td>
                                <td>{{$pass->address}}</td>
                                <td>{{$pass->phone}}</td>
                                <td>{{$pass->code}}</td>
                                <td>{{$pass->created_at}}</td>
                                <td colspan="2">
                                    <a class="btn btn-primary fa fa-pencil" href="{{ route('supplier.edit', $pass->id) }}">&nbsp;</a> 
                                    &nbsp;¦¦&nbsp;
                                    <a href="javascript:;" data-toggle="modal" onclick = "deleteData({{$pass->id}})" data-target="#DeleteModal" class="btn btn-danger fa fa-trash"></a>
                                </td>
                                
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">None suppliers available </td>
                            </tr>
                        @endforelse
                    
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
				    {!! $suppliers->links() !!}
				</div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
   

@endsection

@section('extra-script')
    <script type="text/javascript">
         function deleteData(id)
         {
             var id = id;
             var url = '{{ route("supplier.delete", "id") }}';
             url = url.replace('id', id);
             $("#deleteForm").attr('action', url);
         }
          function formSubmit()
         {
             $("#deleteForm").submit();
         }
    </script>

@endsection
