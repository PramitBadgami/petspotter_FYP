<style>
	.sub-links {
		display: none;
		text-decoration: none;
		margin-bottom: 10px;
		padding-top: 10px;
		height: 10%;
		
	}

	.sub-links a{
		height: 90%;
	}

	.sub-links li:first-child {
		margin-bottom: 10px;
	}

	.sub-links li:hover {
        background-color: #494E53;
        cursor: pointer;
    }

</style>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<!-- Brand Logo -->
				<a href="#" class="brand-link">
					<img src="{{asset('logo/petspotter-zoomed-removebg.png')}}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8; filter: brightness(0) invert(1);">
					<span class="brand-text font-weight-light">Pet Spotter</span>
				</a>
				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Sidebar user (optional) -->
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<!-- Add icons to the links using the .nav-icon class
								with font-awesome or any other icon font library -->
							<li class="nav-item">
								<a href="{{ route('admin.dashboard') }}" class="nav-link">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>Dashboard</p>
								</a>																
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link" id="categoryDropdownToggle">
									<i class="nav-icon fas fa-file-alt"></i>
									<p>Category</p>
								</a>
								<ul class="sub-links" id="categorySubLinks">
									<li><a href="{{ route('productcategories.index') }}">Product Category</a></li>
									<li><a href="{{ route('petcategories.index') }}">Pet Category</a></li>
								</ul>
							</li>
							<li class="nav-item">
								<a href="{{ route('sub-categories.index') }}" class="nav-link">
									<i class="nav-icon fas fa-file-alt"></i>
									<p>Sub Category</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('brands.index') }}" class="nav-link">
									<svg class="h-6 nav-icon w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
									  </svg>
									<p>Brands</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('breeds.index') }}" class="nav-link">
									<!-- <svg class="h-6 nav-icon w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
									  </svg> -->
									  <i style="margin-left: 6px;" class="fas fa-cat"></i>
									<p style="margin-left: 6px;">Breeds</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('products.index')}}" class="nav-link">
									<i class="nav-icon fas fa-tag"></i>
									<p>Products</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{route('pets.index')}}" class="nav-link">
									<i style="margin-left: 6px;" class="fas fa-dog"></i>
									<p style="margin-left: 6px;">Pets</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('verifications.index') }}" class="nav-link">
									<!-- <i class="nav-icon fas fa-tag"></i> -->
									<i style="margin-left: 4px;" class="fa fa-check-circle"></i>
									<p  style="margin-left: 6px;">Verification</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('adoptions.index') }}" class="nav-link">
									<!-- <i class="nav-icon fas fa-tag"></i> -->
									<i style="margin-left: 4px;" class="fas fa-paw"></i>
									<p style="margin-left: 6px;">Adoptions</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('shipping.create') }}" class="nav-link">
									<!-- <i class="nav-icon fas fa-tag"></i> -->
									<i class="fas fa-truck nav-icon"></i>
									<p>Shipping</p>
								</a>
							</li>							
							<li class="nav-item">
								<a href="{{ route('orders.index') }}" class="nav-link">
									<i class="nav-icon fas fa-shopping-bag"></i>
									<p>Orders</p>
								</a>
							</li>
							<!-- <li class="nav-item">
								<a href="discount.html" class="nav-link">
									<i class="nav-icon  fa fa-percent" aria-hidden="true"></i>
									<p>Discount</p>
								</a>
							</li> -->
							<li class="nav-item">
								<a href="{{route('users.index')}}" class="nav-link">
									<i class="nav-icon  fas fa-users"></i>
									<p>Users</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('donations.list') }}" class="nav-link">
									<i style="margin-left: 4px;" class='fas fa-hand-holding-heart'></i>
									<p style="margin-left: 6px;">Donations</p>
								</a>
							</li>		
							<li class="nav-item">
								<a href="{{ route('products.productRatings') }}" class="nav-link">
									<i style="margin-left: 4px;" class='fas fa-star'></i>
									<p style="margin-left: 6px;">Product Ratings</p>
								</a>
							</li>					
						</ul>
					</nav>
					<!-- /.sidebar-menu -->
				</div>
				<!-- /.sidebar -->
         	</aside>



