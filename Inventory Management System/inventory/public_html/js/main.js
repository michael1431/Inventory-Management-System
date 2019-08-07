$(document).ready(function(){

	var DOMAIN = "http://localhost/inventory/public_html";

	$("#register_form").on("submit",function(){
		var status = false;
		var name = $("#username");
		var email = $("#email");
		var pass1 = $("#password1");
		var pass2 = $("#password2");
		var type = $("#usertype");
		//var n_pattern = new RegExp(/^[A-Za-z ]+$/);
		// michael.sd@gmail.com
		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);

		if(name.val() == "" || name.val().length <6){
			name.addClass("border-danger");
			$("#u_error").html("<span class='text-danger'>Please Enter Your Name and Name Should Be More Than 6 Character</span>");
			status = false;
		}else{
			name.removeClass("border-danger");
			$("#u_error").html("");
			status = true;
		}

		if(!e_patt.test(email.val())){
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Please Enter Valid Email Address</span>");
			status = false;
		}else{
			email.removeClass("border-danger");
			$("#e_error").html("");
			status = true;
		}



		if(pass1.val() == "" || pass1.val().length <8){
			pass1.addClass("border-danger");
			$("#p1_error").html("<span class='text-danger'>Please Enter a Password Which Should Be More Than 8 Character</span>");
			status = false;
		}else{
			pass1.removeClass("border-danger");
			$("#p1_error").html("");
		}

		if(pass2.val() == "" || pass2.val().length <8){
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Enter a Password  Which Should Be More Than 8 Character</span>");
			status = false;
		}else{
			pass2.removeClass("border-danger");
			$("#p2_error").html("");
		}

		if(type.val() == ""){
			type.addClass("border-danger");
			$("#t_error").html("<span class='text-danger'>Please Choose Any Usertype</span>");
			status = false;
		}else{
			type.removeClass("border-danger");
			$("#t_error").html("");
			status = true;
		}

		if((pass1.val() == pass2.val()) && status == true){

			// overlay.show used for show the loading effect
			$(".overlay").show();

			$.ajax({
				url:DOMAIN+"/includes/process.php",
				method:"POST",
				data:$("#register_form").serialize(),
				success:function(data){
					if(data == "Email Already Exists"){
						$(".overlay").hide();
						alert("Your Email Already Exist");
					}else if (data == "SOME_ERROR") {
						$(".overlay").hide();
						alert("Something Wrong");
					}else{
						$(".overlay").hide();
						window.location.href = encodeURI(DOMAIN+"/index.php?msg=Your Registration Completed Successfully");
					}
				}


			})


		}else{

		    pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Password Not Matched</span>");
			status = true;

		}

			
	})


	// For login Form 

	/*$("#login_form").on("submit",function(){
		 var email = $("#login_email");
		 var pass = $("#login_password");
		 var status = false;
		 if(email.val() == ""){
		 	email.addClass("border-danger");
		 	$("#email_error").html("<span class='text-danger'>Email Field Must Not Be Empty</span>");
		 	status = false;
		 }else{
		 	email.removeClass("border-danger");
		 	$("#email_error").html("");
		 	status = true;
		 }

		 if(pass.val() == ""){
		 	pass.addClass("border-danger");
		 	$("#pass_error").html("<span class='text-danger'>Password Field Must Not Be Empty</span>");
		 	status = false;
		 }else{
		 	pass.removeClass("border-danger");
		 	$("#pass_error").html("");
		 	status = true;
		 }

		 if(status){
		 	// overlay.show used for show the loading effect
			$("overlay").show();
		 	$.ajax({
				url:DOMAIN+"/includes/process.php",
				method:"POST",
				data:$("#login_form").serialize(),
				success:function(data){
					if(data == "NOT_REGISTERED"){
						email.addClass("border-danger");
		 	            $("#email_error").html("<span class='text-danger'>It Seems You Are Not Registered!!</span>");

					}else if (data == "PASSWORD_NOT_MATCHED") {
							pass.addClass("border-danger");
		 	                $("#pass_error").html("<span class='text-danger'>Please Enter A Correct Password!!</span>");
		 	                status = false;
					}else{
						console.log(data);
						alert(data);
					}
				}

				})


			}


	})


*/

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


	// Add Category

	$("#category_form").on("submit",function(){

		if($("#category_name").val() == ""){

			$("#category_name").addClass("border-danger");
			$("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span");

		}else{

			$.ajax({
				url: DOMAIN+"/includes/category_process.php",
				method : "POST",
				data : $("#category_form").serialize(),
				success : function(data){
					if(data == "CATEGORY_ADDED"){
						$("#category_name").removeClass("border-danger");
			            $("#cat_error").html("<span class='text-success'>New Category Added Successfully..!</span");
			            $("#category_name").val("");
			            fetch_category();
					}else{
						alert(data);
					}
				}

			})

		}

	})


	//  Add Brand 

	$("#brand_form").on("submit",function(){

		if($("#brand_name").val() == ""){

			$("#brand_name").addClass("border-danger");
			$("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span");

		}else{

				$.ajax({
				url: DOMAIN+"/includes/category_process.php",
				method : "POST",
				data : $("#brand_form").serialize(),
				success : function(data){
					if(data == "BRAND_ADDED"){
						$("#brand_name").removeClass("border-danger");
			            $("#brand_error").html("<span class='text-success'>New Brand Added Successfully..!</span");
			            $("#brand_name").val("");
			            fetch_brand();
					}else{
						alert(data);
					}
				}

			})
		}

	})


	// Add Product
	$("#Product_form").on("submit",function(){


				$.ajax({
				url: DOMAIN+"/includes/category_process.php",
				method : "POST",
				data : $("#Product_form").serialize(),
				success : function(data){
					if(data == "NEW_PRODUCT_ADDED"){
						alert("New Product Added Successfully!!");
						$("#product_name").val("");
						$("#select_cat").val("");
						$("#select_brand").val("");
						$("#product_price").val("");
						$("#product_qty").val("");
					}else{
						console.log(data);
						alert(data);
					}
				}

			})


	})

	

	




	})