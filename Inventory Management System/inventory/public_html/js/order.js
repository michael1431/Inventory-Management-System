$(document).ready(function(){

	var DOMAIN = "http://localhost/inventory/public_html";

	addNewRow();

	$("#add").click(function(){

		addNewRow();
	})

	// add new row each time by fetching data from product tbl

	function addNewRow(){
		$.ajax({

			url : DOMAIN+"/includes/category_manage_process.php",
			method : "POST",
			data : {getNewOrderItem:1},
			success : function(data){

				$("#invoice_item").append(data);
				var n =0;
				$(".number").each(function(){

					$(this).html(++n);
				})

			}


		})
	}

    // reomve single row each time

	$("#remove").click(function(){

		$("#invoice_item").children("tr:last").remove();
		// call the calculate function to set all value 0 when remove an item
		calculate(0,0);

	})

	// kono value change korle puro row ta change hobe amount saho

	$("#invoice_item").delegate(".pid","change",function(){

		var pid = $(this).val();
		// this is input , parent is td and td parent is tr

		var tr = $(this).parent().parent();

		$.ajax({

			url : DOMAIN+"/includes/category_manage_process.php",
			method : "POST",
			dataType : "json",
			data : {getPriceAndQty:1,id:pid},
			success : function(data){

				tr.find(".tqty").val(data["product_stock"]);
				tr.find(".pro_name").val(data["product_name"]);
				tr.find(".qty").val(1);
				tr.find(".price").val(data["product_price"]);
				tr.find(".amt").html(tr.find(".qty").val() * tr.find(".price").val());
				calculate(0,0);
			}


		})


	})

	// code for quantity validation

	$("#invoice_item").delegate(".qty","keyup",function(){

		var qty = $(this);
		var tr = $(this).parent().parent();

		if(isNaN(qty.val())){
			alert("Please Enter A Valid Quantity");
			qty.val(1);
		}else{

			if((qty.val()-0) > (tr.find(".tqty").val()-0)){
				alert("Sorry ! This Much OF Quantity Is Not Available");
				qty.val(1);
			}else{
				tr.find(".amt").html(qty.val() * tr.find(".price").val());
				calculate(0,0);
			}
		}
	})

	//code for calculate

	function calculate(dis,paid){

		var sub_total = 0;
		var gst = 0;
		var net_total = 0;
		var discount = dis;
		var paid_amt = paid;
		var due = 0;

		$(".amt").each(function(){

			 sub_total = sub_total + ($(this).html() * 1);
		})

		gst = 0.18 * sub_total;
		net_total = gst + sub_total;
		net_total = net_total - discount;
		due = net_total - paid_amt;
		if(due<0){
			alert("You entered an invalid amount in paid field");
		}

		$("#gst").val(gst);
		$("#net_total").val(net_total);
		$("#sub_total").val(sub_total);
		$("#discount").val(discount);
		
		//$("#paid")
		$("#due").val(due);
	}

	$("#discount").keyup(function(){

		var discount = $(this).val();
		calculate(discount,0);
	})

	$("#paid").keyup(function(){

		var paid = $(this).val();
		var discount = $("#discount").val();
		calculate(discount,paid);
	})

	//code for order accepting


	$("#order_form").click(function(){

		var invoice = $("#get_order_data").serialize();

		if($("#cust_name").val()===""){
			alert("Please Enter Customer Name");
		}else if($("#paid").val()===""){
			alert("Please Enter Paid Amount");
		}else{


		$.ajax({


			url : DOMAIN+"/includes/category_manage_process.php",

			method : "POST",

			data : $("#get_order_data").serialize(),

			success : function(data){

					if(data<0){
						alert(data);
					}else{


			$("#get_order_data").trigger("reset");
                

          if(confirm("Do You Want To Print Invoice?")){

		  window.location.href = DOMAIN+"/includes/invoice_bill.php?invoice_no="+data+"&"+invoice;


					}else{
						alert("Order Completed Successfully!");
					}


				}

			}
		})

		
	}


	})


});