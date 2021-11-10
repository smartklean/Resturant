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


        <form class="navbar-form pull-center" action="{{ route('user') }}" method="get">
            @csrf
            <div class="form-group pull-left">
                <input type="text" name="search" class="form-control" placeholder="Enter keyword" />
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </form>
        <form class="navbar-form pull-center" action="{{ route('user.new') }}" method="get">
            @csrf

            <button type="submit" class="btn btn-success pull-right" >New Staff <i class="fa fa-plus"></i></button>
        </form>
        <br><br>
        <div class="mytable">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>User Role</th>
                            <th>Date Registered</th>
                            <th>Action(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                         
                        @forelse($users as $index => $pass)
                            <tr>
                                <td>{{ ($users->currentpage()-1) * $users->perpage() + $index + 1 }} </td>
                                <td>{{$pass->first_name}} </td>
                                <td>{{$pass->last_name}}</td>
                                <td>{{$pass->username}}</td>
                                <td>{{$pass->email}}</td>
                                <td>{{$pass->userRole}}</td>
                                <td>{{$pass->created_at}}</td>
                                <td colspan="3">
                                    <a class="btn btn-primary fa fa-unlock" href="{{ route('user.edit', $pass->id) }}">&nbsp;Upgrade</a> 
                                    &nbsp;¦¦&nbsp;
                                    <a class="btn btn-default fa fa-cog" href="{{route('user.reset',$pass->id)}}">&nbsp;Reset</a>&nbsp;¦¦&nbsp;
                                    <a href="javascript:;" data-toggle="modal" onclick = "deleteData({{$pass->id}})" data-target="#DeleteModal" class="btn btn-danger fa fa-trash">&nbsp;Delete</a>
                                </td>
                                
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">None users available </td>
                            </tr>
                        @endforelse
                    
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
				    {!! $users->links() !!}
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
             var url = '{{ route("user.delete", "id") }}';
             url = url.replace('id', id);
             $("#deleteForm").attr('action', url);
         }
          function formSubmit()
         {
             $("#deleteForm").submit();
         }
    </script>

@endsection
