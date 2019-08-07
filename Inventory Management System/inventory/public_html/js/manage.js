$(document).ready(function(){

	var DOMAIN = "http://localhost/inventory/public_html";
	/*

	manageCategory();
	function manageCategory(){


			$.ajax({
				url: DOMAIN+"/includes/category_manage_process.php",
				method : "POST",
				data : {manageCategory:1},
				success : function(data){

					$("#get_category").html(data);
					 $("#datatable").DataTable();
					//alert(data);
				}

			})
	}
	*/

	// code for delete category
	/*
	$("body").delegate(".del_cat","click",function(){
		var  did = $(this).attr("did");
		if(confirm("Are You Sure To Delete?")){
				$.ajax({
				url: DOMAIN+"/includes/category_manage_process.php",
				method : "POST",
				data : {delCategory:1},
				success : function(data){

					if(data == "DEPENDENT_CATEGORY"){
						alert("Sorry!This Category Has Other Sub Category.");
					}else if(data == "CATEGORY_DELETED"){
						alert("Category Deleted Successfully.");
					}else if (data = "DELETED") {
						alert("DELETED Successfully");
					}else{
						alert(data);
					}
				}

			})

		}else{
			alert("NO");
		}
	})*/



	// fetch category
	fetch_category();

	function fetch_category(){

		$.ajax({
			url : DOMAIN+"/includes/category_process.php",
			method: "POST",
			data : {getCategory:1},
			success : function(data){
				var root = "<option value='0'>Root</option>";
				var choose = "<option value=''>Choose Category</option>";
				$("#parent_cat").html(root+data);
				$("#select_cat").html(choose+data);
              
			}

		})

	}



	// fetch brand


	fetch_brand();

	function fetch_brand(){

		$.ajax({
			url : DOMAIN+"/includes/category_process.php",
			method: "POST",
			data : {getBrand:1},
			success : function(data){
				var choose = "<option value=''>Choose Brand</option>";
                $("#select_brand").html(choose+data);
			}

		})

	}

	// code for update category

	$("body").delegate(".edit_cat","click",function(){

		var eid = $(this).attr("eid");

		$.ajax({

			url : DOMAIN+"/includes/category_process.php",
			method : "POST",
			dataType : "json",
			data : {updateCategory:1,id:eid},
			success : function(data){

				console.log(data);
				
				$("#cid").val(data["cid"]);
				$("#update_categoryname").val(data["category_name"]);
				$("#parent_cat").val(data["parent_cat"]);
				
			}
		})

	})

	//update category from modal

	$("#update_category_form").on("submit",function(){

			if($("#update_categoryname").val() == ""){

			$("#update_categoryname").addClass("border-danger");
			$("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span");

		}else{

			$.ajax({
				url: DOMAIN+"/includes/category_process.php",
				method : "POST",
				data : $("#update_category_form").serialize(),
				success : function(data){
				
					window.location.href = "";
				}

			})

		}
	})


	// code for update brand modal

	$("body").delegate(".edit_brand","click",function(){

		var bid = $(this).attr("bid");

		$.ajax({

			url : DOMAIN+"/includes/category_process.php",
			method : "POST",
			dataType : "json",
			data : {updateBrand:1,id:bid},
			success : function(data){

				console.log(data);
				
				$("#bid").val(data["bid"]);
				$("#update_brandname").val(data["brand_name"]);
				
			}
		})

	})


	//update brand after getting data

	$("#update_brand_form").on("submit",function(){

			if($("#update_brandname").val() == ""){

			$("#update_brandname").addClass("border-danger");
			$("#brand_error").html("<span class='text-danger'>Please Enter Category Name</span>");

		}else{

			$.ajax({
				url: DOMAIN+"/includes/category_process.php",
				method : "POST",
				data : $("#update_brand_form").serialize(),
				success : function(data){
				
					window.location.href = "";
				}

			})

		}
	})
	// code for update product

	$("body").delegate(".edit_product","click",function(){

		var eid = $(this).attr("eid");

		$.ajax({

			url : DOMAIN+"/includes/category_process.php",
			method : "POST",
			dataType : "json",
			data : {updateProduct:1,id:eid},
			success : function(data){

				console.log(data);
				
				$("#pid").val(data["pid"]);
				$("#update_productname").val(data["product_name"]);
				$("#select_cat").val(data["cid"]);
				$("#select_brand").val(data["bid"]);
				$("#product_price").val(data["product_price"]);
				$("#product_qty").val(data["product_stock"]);


				
			}
		})

	})

	//update Product after getting data

	$("#update_product_form").on("submit",function(){


				$.ajax({
				url: DOMAIN+"/includes/category_process.php",
				method : "POST",
				data : $("#update_product_form").serialize(),
				success : function(data){
					if(data == 1){
						alert("Product Updated Successfully..!");
						window.location.href = "";
					}else{
						alert(data);
					}
				}

			})


	})





})