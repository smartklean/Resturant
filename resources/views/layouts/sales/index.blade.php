@extends('layouts.dashboard')

@section('content')


    <div class="col-md-2"></div>
    <div class="col-md-5" style="background-color:">
       <div class="modal-dialog ">
	        <form class="navbar-form pull-right" action="" method="get">
	            @csrf

	            <button type="submit" class="btn btn-success pull-right" >Daily Sales <i class="fa fa-calendar"></i></button>
	        </form>

	         <form class="navbar-form pull-right" action="" method="get">
	            @csrf

	            <button type="submit" class="btn btn-warning pull-right" >Draft Sales <i class="fa fa-calendar"></i></button>
	        </form>
       </div>
       <br/><br/>
       <div>
	       	<form class="navbar-form pull-center" action="" method="POST" >
	       		{{ csrf_field() }}
	            <div class="form-group row">
                    <label for="name" class="col-md-5 col-form-label text-md-left">{{ __('Find or Scan Item') }}</label>
                    <div class="col-md-6">
                        <input type="text" name="search" id="search" class="form-control" autocomplete="off" />
	               		<div id="productList"> </div> 
                    </div>
                </div>
	        </form>
       </div>
       <br/><br/>
       <div class="mytable">
            <div class="table-responsive">
                <table class="table" id="saleTable">
                	 @csrf
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total N</th>
                            <th>Action(s)</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                         
                    </tbody>
                </table>
            </div>
        </div>

        <div class="form-group row" class="navbar-form pull-right">
            <label class="col-md-9, col-sm-9 col-form-label text-md-right"></label>
            <div class="col-md-3, col-sm-3 text-md-right" style="color: red;" id="subtotal" hidden="true">
                <strong>Total<input type="text" id="total" class="form-control" readonly="true" /></strong>
            </div>
        </div>

            

        <div class="navbar-form pull-right">

        	<div class="col-md-6">
            	<button type="submit" class="btn btn-warning pull-right" >Add Draft <i class="fa fa-envelope"></i></button>
        	</div>

        	<div class="col-md-6">
        		<button id ='btn' type="submit" class="btn btn-danger pull-right" onclick="store()">Make Sales <i class="fa fa-shopping-cart"></i></button>
        	</div>
        </div>

    </div>
    <div class="col-md-3" style="background-color:blue">
    	<form class="navbar-form pull-right" action="" method="get">
            @csrf
            <div class="form-group pull-right">
                <input type="text" name="search" class="form-control" placeholder="Enter keyword" />
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>

@endsection

@section('extra-script')
    <script type="text/javascript">
	 	$(document).ready(function () {
			$('input[name="search"]').bind('input', function(){ 
		        var query = $(this).val();
		        if(query != '')
		        {
		         var _token = $('input[name="_token"]').val();
		         $.ajax({
		          url:"{{ route('search') }}",
		          method:"POST",
		          data:{query:query, _token:_token},
		           success:function (data) {
		           	console.log(data);
	                   $('#productList').html(data);
	                }
		         });
		        }
		    });

		    $(document).on('click', 'li', function(){
		    	var total = document.getElementById('subtotal');
		    	total.style.display = 'block';  
		        var value = $(this).text();
		        console.log(value);
		        $.ajax({
		          url:'sales/'+value,
		          method:"get",
		           success:function (data) {
	                   console.log(data);

	                   var empTab = document.getElementById('saleTable');
				       var tr = empTab.insertRow(1); // table row.
			
					   var cell1 = tr.insertCell(0);
					   var cell2 = tr.insertCell(1);
					   var cell3 = tr.insertCell(2);
					   var cell4 = tr.insertCell(3);
					   var cell5 = tr.insertCell(4);
					   var cell6 = tr.insertCell(5);

						// Add some text to the new cells:
						cell1.innerHTML = data['id'];
						cell2.innerHTML = data['name'];
						cell3.innerHTML = data['selling_price'];

						cell4.innerHTML = '<input type ="number" class="qty" value="1" min="1"/>';
						
						cell5.innerHTML = data['selling_price'];

						$(".qty").on("change", function() {
							var qty = parseInt($(this).val());
							var amount = parseFloat(data['selling_price']);
							cell5.innerHTML = qty * amount;
						});
						
						cell6.innerHTML = '<button type ="button" class="btn btn-danger" id="btnDelete" onClick="Javacsript:removeRow(this)"> <i class="fa fa-trash-o"></i></button>';
		              

		                var oldTotal = $('#total').val() || 0 ;

		                var total = parseFloat(oldTotal) + parseFloat(data['selling_price']);

		                $('#total').val(total);

		                $("#btnDelete").click(function (evt) {
						  	var rowCells = $(this).closest("tr").children(); 
 							
							var cell5 = rowCells.eq( 4 ).text();
							
							var total = $('#total').val();

							var newTotal = (parseFloat(total) - parseFloat(cell5));

							$('#total').val(newTotal);
						});
		                
	                }

		        });

	            $('#search').val('');
	            $('#productList').html("");
		    }); 


		    $('#saleTable').on('change', function(){

		    	var empTab = document.getElementById('saleTable');

	        	var rowCnt = (empTab.rows.length); 

	        	var total = 0;
				$("#saleTable tr").each(function() {
				   var price = (+$(this).find('td').eq(4).text());
				      total = parseInt(total) + parseInt(price);
				});

				$('#total').val(total);

		    });

		});

	 	function store(){
	 		// $("#btn").click(function(event) {
    			event.preventDefault();
		 		var myTableArray = [];
	            $("#saleTable tr").each(function () {
	                var arrayOfThisRow = [];
	                var tableData = $(this).find('td');
	                if (tableData.length > 0) {
	                    tableData.each(function () {
	                        arrayOfThisRow.push($(this).text());
	                    });
	                   
	                }
	                if(arrayOfThisRow.length > 0){

	                	myTableArray.push(arrayOfThisRow);
	                }


                
	            });
	            var _token = $('input[name="_token"]').val();
	            $.ajax({ 
			        type: "POST", 
			        url: "sales/add", 
			        data: {data : myTableArray, _token:_token }, 
			        success:function (data) {
			           	console.log(data);
		            }
			    }); 
	       //      console.log(myTableArray);
	       //      $('#saleTable').find("tr:gt(0)").remove();
	       //      var total = document.getElementById('subtotal');
			    	// total.style.display = 'none';  
	       //       $('#total').val(0);
	        // });

	        var divToPrint = document.getElementById("saleTable");
			  // newWin = window.open("");
			  newWin.document.write(divToPrint.outerHTML);
			  newWin.print();
			  newWin.close();
	 	}
		

		function removeRow(oButton) {
	        var empTab = document.getElementById('saleTable');
	        empTab.deleteRow(oButton.parentNode.parentNode.rowIndex);
	    }

	</script>
@endsection
