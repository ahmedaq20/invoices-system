@extends('layouts.master')
@section('css')

<link href="{{ URL::asset('assets\css\profile.css') }}" rel="stylesheet" />

@endsection

@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Profile</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
<div class="card-container">

	<aside class="profile-card">
        <header>
          <!-- here’s the avatar -->
          <a target="_blank" href="#">
            <img src="http://lorempixel.com/150/150/people/" class="hoverZoomLink">
          </a>

          <!-- the username -->
          <h1>
                  John Doe
                </h1>

          <!-- and role or location -->
          <h2>
                  Better Visuals
                </h2>

        </header>

        <!-- bit of a bio; who are you? -->
        <div class="profile-bio">

          <p>
            It takes monumental improvement for us to change how we live our lives. Design is the way we access that improvement.
          </p>

        </div>

        <!-- some social links to show off -->
        <ul class="profile-social-links">
          <li>
            <a target="_blank" href="https://www.facebook.com/creativedonut">
              <i class="fa fa-facebook"></i>
            </a>
          </li>
          <li>
            <a target="_blank" href="https://twitter.com/dropyourbass">
              <i class="fa fa-twitter"></i>
            </a>
          </li>
          <li>
            <a target="_blank" href="https://github.com/vipulsaxena">
              <i class="fa fa-github"></i>
            </a>
          </li>
          <li>
            <a target="_blank" href="https://www.behance.net/vipulsaxena">

              <i class="fa fa-behance"></i>
            </a>
          </li>
        </ul>
      </aside>				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
