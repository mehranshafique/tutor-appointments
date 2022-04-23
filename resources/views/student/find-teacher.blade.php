@extends('layouts.admin')
@section('content')

<style>
.padding {
    padding: 3rem !important
}

.user-card-full {
    overflow: hidden
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 30px
}

.m-r-0 {
    margin-right: 0px
}

.m-l-0 {
    margin-left: 0px
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px
}

.bg-c-lite-green {
    background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
    background: linear-gradient(to right, #ee5a6f, #f29263)
}

.user-profile {
    padding: 20px 0
}

.card-block {
    padding: 1.25rem
}

.m-b-25 {
    margin-bottom: 25px
}

.img-radius {
    border-radius: 5px
}

h6 {
    font-size: 14px
}

.card .card-block p {
    line-height: 25px
}

@media only screen and (min-width: 1400px) {
    p {
        font-size: 14px
    }
}

.card-block {
    padding: 1.25rem
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.m-b-20 {
    margin-bottom: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.card .card-block p {
    line-height: 25px
}

.m-b-10 {
    margin-bottom: 10px
}

.text-muted {
    color: #919aa3 !important
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0
}

.f-w-600 {
    font-weight: 600
}

.m-b-20 {
    margin-bottom: 20px
}

.m-t-40 {
    margin-top: 20px
}

.p-b-5 {
    padding-bottom: 5px !important
}

.m-b-10 {
    margin-bottom: 10px
}

.m-t-40 {
    margin-top: 20px
}

.user-card-full .social-link li {
    display: inline-block
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out
}
</style>
<div class="card">
    <div class="card-header">
        {{ trans('cruds.teacher.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
              <div class="row">
        @foreach($teachers as $teacher)
        <div class="col-lg-6 col-md-6">
          <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25"> <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image"> </div>
                                    <h6 class="f-w-600">
                                      <a href="{{ url('student/teacher-details/'.$teacher->id)}}">{{ $teacher->name }}</a></h6>
                                    <p>{{ $teacher->introduction }}</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400">{{ $teacher->email }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Phone</p>
                                            <h6 class="text-muted f-w-400">{{ $teacher->phone }}</h6>
                                        </div>
                                    </div>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Subjects</h6>
                                    <div class="row">
                                    <ol class="list-inline">
                                      @foreach(json_decode($teacher->services) as $key => $service)
                                          <div class="col-lg-2 col-sm-2 d-inline">
                                            <li class="list-inline-item">
                                              {{++$key}}. {{ $service->name }}
                                            </li>
                                          </div>
                                      @endforeach
                                    </ol>
                                    </div>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Languages</h6>
                                    <div class="row">
                                    <ol class="list-inline">
                                      @foreach(json_decode($teacher->services) as $key => $service)
                                          <div class="col-lg-2 col-sm-2 d-inline">
                                            <li class="list-inline-item">

                                            </li>
                                          </div>
                                      @endforeach
                                    </ol>
                                    </div>
                                    <ul class="social-link list-unstyled m-t-40 m-b-10">
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
        @endforeach
          </div>

      </div>
    </div>
</div>
<!-- <div class="col-lg-4">
  <div class="container mt-5 d-flex justify-content-center">
      <div class="card p-4 mt-3">
          <div class="first">
              <h6 class="heading">{{ $teacher->name }}</h6>
              <div class="time d-flex flex-row align-items-center justify-content-between mt-3">
                  <div class="d-flex align-items-center"> <i class="fa fa-clock-o clock"></i> <span class="hour ml-1">3 hrs</span> </div>
                  <div> <span class="font-weight-bold">$90</span> </div>
              </div>
          </div>
          <div class="second d-flex flex-row mt-2">
              <div class="image mr-3"> <img src="https://i.imgur.com/0LKZQYM.jpg" class="rounded-circle" width="60" /> </div>
              <div class="">
                  <div class="d-flex flex-row mb-1"> <span>{{ '@'.$teacher->name }}</span>
                      <div class="ratings ml-2"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
                  </div>
                  <div> <button class="btn btn-outline-dark btn-sm px-2">+ follow</button> <button class="btn btn-outline-dark btn-sm">See Profile</button> <button class="btn btn-outline-dark btn-sm"><i class="fa fa-comment-o"></i></button> </div>
              </div>
          </div>
          <hr class="line-color">
          <h6>{{ trans('cruds.child_subjects.fields.subject') }}</h6>
          <div class="third mt-4"> <button class="btn btn-success btn-block"><i class="fa fa-clock-o"></i> Book Now</button>
          </div>
      </div>
  </div>
  </div> -->
@endsection
