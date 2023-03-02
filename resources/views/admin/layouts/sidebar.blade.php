			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li> 
								<a href="{{ route('admin.dashboard.page') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a>
								{{-- @if (in_array('Slider',json_decode(Auth::guard('admin')->user()->role->permission)))
								<a href="{{ route('slider.index') }}"><i class="fa fa-slideshare"></i> <span>Slider</span></a>
								@endif
								@if (in_array('Testimonial',json_decode(Auth::guard('admin')->user()->role->permission)))
								<a href="{{ route('testimonial.index') }}"><i class="fa fa-quote-left"></i> <span>Testimonial</span></a>
								@endif
								@if (in_array('Expertise',json_decode(Auth::guard('admin')->user()->role->permission)))
								<a href="{{ route('expertise.index') }}"><i class="fa fa-star"></i> <span>Expertise</span></a>
								@endif
								@if (in_array('Vision',json_decode(Auth::guard('admin')->user()->role->permission)))
								<a href="{{ route('vision.index') }}"><i class="fa fa-eye"></i> <span>Vision</span></a>
								@endif
								@if (in_array('Our client',json_decode(Auth::guard('admin')->user()->role->permission)))
								<a href="{{ route('client.index') }}"><i class="fa fa-user"></i> <span>Our Client</span></a>
								@endif
								@if (in_array('Our team',json_decode(Auth::guard('admin')->user()->role->permission)))
								<a href="{{ route('team-member.index') }}"><i class="fa fa-users"></i> <span>Our Team</span></a>
								@endif
								@if (in_array('Skill',json_decode(Auth::guard('admin')->user()->role->permission)))
								<a href="{{ route('skill.index') }}"><i class="fa fa-lightbulb-o"></i> <span>Skills</span></a>
								@endif
								@if (in_array('Service',json_decode(Auth::guard('admin')->user()->role->permission)))
								<a href="{{ route('service.index') }}"><i class="fa fa-server"></i> <span>Services</span></a>
								@endif
								@if (in_array('Pricing',json_decode(Auth::guard('admin')->user()->role->permission)))
								<a href="{{ route('pricing-table.index') }}"><i class="fa fa-table"></i> <span>Pricing</span></a>
								@endif
								@if (in_array('Counter',json_decode(Auth::guard('admin')->user()->role->permission)))
								<a href="{{ route('counter.index') }}"><i class="fa fa-calculator"></i> <span>Counter</span></a>
								@endif --}}
								
							</li>
							{{-- @if (in_array('Portfolio',json_decode(Auth::guard('admin')->user()->role->permission)))
							<li class="submenu">
								<a href="#"><i class="fa fa-briefcase"></i> <span> Portfolio</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('portfolio.index') }}">Portfolio</a></li>
									<li><a href="{{ route('portfolio-category.index') }}">Category</a></li>
								</ul>
							</li>
							@endif --}}
							{{-- @if (in_array('Post',json_decode(Auth::guard('admin')->user()->role->permission)))
							<li class="submenu">
								<a href="#"><i class="fe fe-document"></i> <span> Posts</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('post.index') }}">All Posts</a></li>
									<li><a href="{{ route('post-category.index') }}">Category</a></li>
									<li><a href="{{ route('post-tag.index') }}">Tags</a></li>
								</ul>
							</li>
							@endif --}}

                            <li class="menu-title"> 
								<span>Admin Option</span>
							</li>
							@if (in_array('admin-user',json_decode(Auth::guard('admin')->user()->role->permission)) || in_array('role',json_decode(Auth::guard('admin')->user()->role->permission)) || in_array('permission',json_decode(Auth::guard('admin')->user()->role->permission)))	
							<li class="submenu">
								<a href="#"><i class="fa fa-user"></i> <span>Admin User</span> <span class="menu-arrow"></span></a>
								@endif
								<ul style="display: none;">
									@if (in_array('admin-user',json_decode(Auth::guard('admin')->user()->role->permission)))	
									<li><a href="{{ route('admin-user.index') }}">Users</a></li>
									@endif
									@if (in_array('role',json_decode(Auth::guard('admin')->user()->role->permission)))	
									<li><a href="{{route('role.index')}}">Role</a></li>
									@endif
									@if (in_array('permission',json_decode(Auth::guard('admin')->user()->role->permission)))	
									<li><a href="{{ route('permission.index') }}">Permission</a></li>
									@endif
								</ul>
							</li>
							@if (in_array('theme-option',json_decode(Auth::guard('admin')->user()->role->permission)))	
                            <li> 
								<a href="#"><i class="fa fa-tasks"></i> <span>Theme Option</span></a>
							</li>
							@endif
							@if (in_array('setting',json_decode(Auth::guard('admin')->user()->role->permission)))	
                            <li> 
								<a href="#"><i class="fa fa-cog"></i> <span>Setting</span></a>
							</li>
							@endif
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->