<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>PetSpotter</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />

	<meta property="og:locale" content="en_AU" />
	<meta property="og:type" content="website" />
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="og:image:alt" content="" />

	<meta name="twitter:title" content="" />
	<meta name="twitter:site" content="" />
	<meta name="twitter:description" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:image:alt" content="" />
	<meta name="twitter:card" content="summary_large_image" />

	<!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front-assets/images/petspotter-zoomed-removebg-preview.png') }}" />
	

	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick-theme.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/ion.rangeSlider.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/style.css') }}" />

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">

	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />

	<meta name="csrf-token" content="{{ csrf_token( )}}">

    <style>
        .logo{
            backgrond-color: transparent;
        }

		.dropdown-menu.subcategories {
			background-color: #212529; /* Change background color to #212529 */
			margin-left: 90%;
		}
		
		.category-item {
			color: white !important;
			
    	}

		.category-item:hover {
			color: #F7CA0D !important;
    	}

		.dropdown-menu-dark{
			background-color: #212529;
			
		}

		.second-dropdown-menu{
			margin-left: 50%;
		}

		.dropdown-menu .dropdown-item {
			margin-bottom: 5px; /* Adjust margin as needed */
		}
    </style>
</head>
<body data-instant-intensity="mousedown">

<div class="bg-light top-header">        
	<div class="container">
		<div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
			<div class="col-lg-4 logo">
				<a href="{{ route('frontend.home') }}" class="text-decoration-none">
					<!-- <span class="h1 text-uppercase text-primary bg-dark px-2">Online</span>
					<span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">SHOP</span> -->
                    <img class="logo" src="{{ asset('logo/petspotter-logo.png') }}">
				</a>
			</div>
			<div class="col-lg-6 col-6 text-left  d-flex justify-content-end align-items-center">
				<a href="account.php" class="nav-link text-dark">My Account</a>
				<form action="">					
					<div class="input-group">
						<input type="text" placeholder="Search For Products" class="form-control" aria-label="Amount (to the nearest dollar)">
						<span class="input-group-text">
							<i class="fa fa-search"></i>
					  	</span>
					</div>
				</form>
			</div>		
		</div>
	</div>
</div>

<header class="bg-dark">
	<div class="container">
		<nav class="navbar navbar-expand-xl" id="navbar">
			<a href="{{ route('frontend.home') }}" class="text-decoration-none mobile-logo">
				<!-- <span class="h2 text-uppercase text-primary bg-dark">Online</span>
				<span class="h2 text-uppercase text-white px-2">SHOP</span> -->
				<img class="logo" src="{{ asset('logo/petspotter-logo.png') }}" style="width: 50%; margin-top: -10px;">
			</a>
			<button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      			<!-- <span class="navbar-toggler-icon icon-menu"></span> -->
				  <i class="navbar-toggler-icon fas fa-bars"></i>
			</button>
			
						
					
    		<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<!-- <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
							Pet Products
						</button>
						<ul class="dropdown-menu dropdown-menu-dark">
							@if(getCategories()->isNotEmpty())
							@foreach (getCategories() as $category)
								<li><a class="dropdown-item" href="#">{{ $category->name }}</a></li>
									
								
							@endforeach
                    		@endif
						</ul> -->

						<!-- <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Pet Products</button>
						<ul class="dropdown-menu dropdown-menu-dark" id="categoryDropdown">
							@if(getCategories()->isNotEmpty())
								@foreach (getCategories() as $category)
									<li>
										<a class="dropdown-item category-item" href="#" data-category-id="{{ $category->id }}">{{ $category->name }}</a>
										<ul class="subcategories" id="subcategories_{{ $category->id }}">
										@foreach ($category->sub_category as $subCategory)

											<li><a class="dropdown-item nav-link" href="{{ route('frontend.shop',[$category->slug,$subCategory->slug]) }}">{{ $subCategory->name }}</a></li>
										@endforeach

										</ul>
									</li>
								@endforeach
							@endif
						</ul> -->

						


						<div class="dropdown" style="display: flex;">
							<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						
								<li class="nav-item dropdown">
									<button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
										Adopt a Pet
									</button>
									@if(getPetCategories()->isNotEmpty())
									<ul class="dropdown-menu dropdown-menu-dark">
										@foreach (getPetCategories() as $category)
										<li><a class="dropdown-item nav-link" href="{{ route('frontend.shop',[$category->slug]) }}">{{ $category->name }}</a></li>
										@endforeach
									</ul>
									@endif	
								</li>
							</ul>   


							<button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
								Pet Products
							</button>
							<ul class="dropdown-menu dropdown-menu-dark second-dropdown-menu" id="categoryDropdown">
								@if(getCategories()->isNotEmpty())
									@foreach (getCategories() as $category)
										<li class="dropdown-item">
											<a href="{{ route('frontend.shop',[$category->slug]) }}" class="category-item" data-category-id="{{ $category->id }}">{{ $category->name }}</a>
											<ul class="dropdown-menu subcategories" id="subcategories_{{ $category->id }}">
												@foreach ($category->sub_category as $subCategory)
													<li><a class="dropdown-item nav-link" href="{{ route('frontend.shop',[$category->slug,$subCategory->slug]) }}">{{ $subCategory->name }}</a></li>
												@endforeach
											</ul>
										</li>
									@endforeach
								@endif
							</ul>
						</div>

      			   			
      		</div>   
			<div class="right-nav py-0">
				<a href="{{ route('frontend.cart') }}" class="ml-3 d-flex pt-2">
					<i class="fas fa-shopping-cart text-primary"></i>					
				</a>
			</div> 		
      	</nav>
  	</div>
</header>

<main>
    @yield('content')
</main>


<footer class="bg-dark mt-5">
	<div class="container pb-5 pt-3">
		<div class="row">
			<div class="col-md-4">
				<div class="footer-card">
					<h3>Get In Touch</h3>
					<p>No dolore ipsum accusam no lorem. <br>
					123 Street, Kathmandu, Nepal <br>
					pramit@example.com <br>
					000 000 0000</p>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>Important Links</h3>
					<ul>
						<li><a href="about-us.php" title="About">About</a></li>
						<li><a href="contact-us.php" title="Contact Us">Contact Us</a></li>						
						<li><a href="https://vijayrajkhadka.com.np/" title="Privacy">Privacy</a></li>
						<li><a href="#" title="Privacy">Terms & Conditions</a></li>
						<li><a href="#" title="Privacy">Refund Policy</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>My Account</h3>
					<ul>
						<li><a href="#" title="Sell">Login</a></li>
						<li><a href="#" title="Advertise">Register</a></li>
						<li><a href="#" title="Contact Us">My Orders</a></li>						
					</ul>
				</div>
			</div>			
		</div>
	</div>
	<div class="copyright-area">
		<div class="container">
			<div class="row">
				<div class="col-12 mt-3">
					<div class="copy-right text-center">
						<p>© Copyright 2022 PetSpotter. All Rights Reserved</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="{{ asset('front-assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/lazyload.17.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/slick.min.js') }}"></script>
<script src="{{ asset('front-assets/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('front-assets/js/custom.js') }}"></script>

<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});

function addToCart(id) {
	$.ajax({
		url: '{{ route("frontend.addToCart") }}',
		type: "POST",
		data: {id:id},
		dataType: 'json',
		success: function(response) {
			if(response.status == true) {
				window.location.href = "{{ route('frontend.cart') }}";
			} else {
				alert(response.message);
			}
		}
	});
}


$(document).ready(function() {
    $('.category-item').hover(function() {
        var categoryId = $(this).data('category-id');
        fetchSubcategories(categoryId);
    });
});

function fetchSubcategories(categoryId) {
    $.ajax({
        url: '/get-subcategories', // Replace this with your route to fetch subcategories
        method: 'GET',
        data: { category_id: categoryId },
        success: function(response) {
            var subcategories = response.subcategories;
            var subcategoryList = $('#subcategories_' + categoryId);
            subcategoryList.empty(); // Clear existing subcategories

            if (subcategories.length > 0) {
                $.each(subcategories, function(index, subcategory) {
                    subcategoryList.append('<li><a class="dropdown-item" href="#">' + subcategory.name + '</a></li>');
                });
            } else {
                subcategoryList.append('<li><span class="dropdown-item disabled">No subcategories found</span></li>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching subcategories:', error);
        }
    });
}
</script>

<script>
    $(document).ready(function() {
        // Hide all subcategories initially
        $('.subcategories').hide();

        // Show subcategories when hovering over each category
        $('.category-item').hover(function() {
            // Hide all subcategories
            $('.subcategories').hide();
            
            // Show subcategories for the hovered category
            $(this).siblings('.subcategories').show();

            // Fetch subcategories dynamically
            var categoryId = $(this).data('category-id');
            fetchSubcategories(categoryId);
        });

        // Function to fetch subcategories via AJAX
        function fetchSubcategories(categoryId) {
            $.ajax({
                url: '/get-subcategories', // Replace this with your route to fetch subcategories
                method: 'GET',
                data: { category_id: categoryId },
                success: function(response) {
                    var subcategories = response.subcategories;
                    var subcategoryList = $('#subcategories_' + categoryId);
                    subcategoryList.empty(); // Clear existing subcategories

                    if (subcategories.length > 0) {
                        $.each(subcategories, function(index, subcategory) {
                            subcategoryList.append('<li><a class="dropdown-item" href="#">' + subcategory.name + '</a></li>');
                        });
                    } else {
                        subcategoryList.append('<li><span class="dropdown-item disabled">No subcategories found</span></li>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching subcategories:', error);
                }
            });
        }
    });
</script>

@yield('customJs')
</body>
</html>