@extends('layouts.app')
@section('content')

<!--End of Header Area-->
<!--Slider Area Start-->
<div class="slider-area">
    <div class="hero-slider owl-carousel">
        <!--Single Slider Start-->
        <div class="single-slider" style="background-image: url({{ asset('userSite/img/slider/1.jpg') }}">
            <div class="hero-slider-content">
                <h1>Education Needs <br> Complete Solution</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque unde, at molestias voluptatem praesentium quia magnam? Iste aliquam, voluptas sapiente animi, repudiandae officiis voluptatem tempore alias nihil. Aperiam voluptatum, velit.</p>
                <div class="slider-btn">
                    <a class="button-default" href="course.html">View Courses</a>
                </div>
            </div>
        </div>
        <!--Single Slider End-->
        <!--Single Slider Start-->
        <div class="single-slider" style="background-image: url({{ asset('userSite/img/slider/2.jpg') }}">
            <div class="hero-slider-content">
                <h1>Education Needs <br> Complete Solution</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque unde, at molestias voluptatem praesentium quia magnam? Iste aliquam, voluptas sapiente animi, repudiandae officiis voluptatem tempore alias nihil. Aperiam voluptatum, velit.</p>
                <div class="slider-btn">
                    <a class="button-default" href="course.html">View Courses</a>
                </div>
            </div>
        </div>
        <!--Single Slider End-->
    </div>
</div>
<!--Slider Area End-->
<!--About Area Start-->
<div class="about-area mt-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="about-container">
                    <h3>Provide best <span class="orange-color">education</span> <span class="orange-color">services</span> for you</h3>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                   <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam eligendi expedita, provident cupiditate in excepturi.</p>
                    <a class="button-default" href="course.html">Learn More</a>
                </div>
            </div>
            <div class="col-lg-5">
                <!--About Image Area Start-->
                <div class="about-image-area img-full">
                    <img src="{{ asset('userSite/img/about/about1.jpg') }}" alt="">
                </div>
                <!--About Image Area End-->
            </div>
        </div>
    </div>
</div>
<!--End of About Area-->
<!--Course Area Start-->
<div class="course-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper">
                    <div class="section-title">
                        <h3>POPULAR COURSES</h3>
                        <p>There are many variations of passages of Lorem Ipsum</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          @foreach($child_subjects as $child_subject)
            <div class="col-lg-4 col-md-6 col-12 mt-2">
                <div class="single-item">
                  <div class="title" style="background-color: #fce013; text-align:center">{{$child_subject->subjects->name}}</div>
                    <div class="single-item-image overlay-effect">
                        <a href="{{ url('course-details/'.$child_subject->id)}}">
                          <img src="{{ asset('userSite/img/course/1.jpg') }}" alt=""></a>
                        <div class="courses-hover-info">
                            <div class="courses-hover-action">
                                <div class="courses-hover-thumb">
                                    <img src="{{ asset('userSite/img/teacher/1.png') }}" alt="small images">
                                </div>
                                <h4><a href="#">Derek Spafford</a></h4>
                                <span class="crs-separator">/</span>
                                <p>Professor</p>
                            </div>
                        </div>
                    </div>
                    <div class="single-item-text">
                        <h4><a href="{{ url('course-details/'.$child_subject->id)}}">{{$child_subject->name}}</a></h4>
                        <p>{{$child_subject->description}}</p>
                        <div class="single-item-content">
                           <div class="single-item-comment-view">
                               <span><i class="zmdi zmdi-accounts"></i>59</span>
                               <span><i class="zmdi zmdi-favorite"></i>19</span>
                           </div>
                           <div class="single-item-rating">
                               <i class="zmdi zmdi-star"></i>
                               <i class="zmdi zmdi-star"></i>
                               <i class="zmdi zmdi-star"></i>
                               <i class="zmdi zmdi-star"></i>
                               <i class="zmdi zmdi-star-half"></i>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-md-12 col-sm-12 text-center">
                <a href="course.html" class="button-default button-large">Browse All Courses <i class="zmdi zmdi-chevron-right"></i></a>
            </div>
        </div>
    </div>
</div>

<!--Packages Area Start-->
<div class="latest-area section-padding bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper">
                    <div class="section-title">
                        <h3>Our Packages</h3>
                        <p>There are many variations of packages</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
          @foreach($packages as $package)
          <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <div class="card text-center">
              <div class="card-header text-center border-bottom-0 bg-transparent text-success pt-4">
                <h5>{{ $package->name}}</h5>
              </div>
              <div class="card-body">
                <h1>{{App\UserInterFace::CURRENCY_SYMBOL}}{{ $package->price}}</h1>
                <h5 class="text-muted"><small>{{$package->duration}} {{$package->duration_type}}s</small></h5>
                  <p>{{$package->description}}</p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><i class="fas fa-male text-success mx-2"></i>Real-time fee reporting</li>
                <li class="list-group-item"><i class="fas fa-venus text-success mx-2"></i>Pay only for what you use</li>
                <li class="list-group-item"><i class="fas fa-gavel text-success mx-2"></i> No setup, monthly, or hidden fees</li>
              </ul>
              <form method="post" action="{{ route('make.payment')}}" >
                @csrf
                <input type="hidden" name="package_id" value="{{ $package->id }}" >
                <div class="card-footer border-top-0">
                  <button type="submit" class="button-default text-uppercase">Buy Now <i class="zmdi zmdi-chevron-right"></i></button>
                </div>
              </form>
            </div>
          </div>
          @endforeach
        </div>
    </div>
</div>

<!--End Packages Area-->

<!--End of Course Area-->

<!--Fun Factor Area Start-->
<div class="fun-factor-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="single-fun-factor mb-30">
                    <h2><span class="counter">79</span>+</h2>
                    <h4>Teachers</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="single-fun-factor mb-30">
                    <h2><span class="counter">120</span>+</h2>
                    <h4>Members</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="single-fun-factor mb-30">
                    <h2><span class="counter">36</span>+</h2>
                    <h4>Courses</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12">
                <div class="single-fun-factor mb-30">
                    <h2><span class="counter">20</span>+</h2>
                    <h4>Countries</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Fun Factor Area-->

<div class="testimonial-area">
    <div class="container">
        <div class="row">
            <div class="testimonial-slider owl-carousel">
                <div class="col-12">
                    <!--Single Testimonial Area Start-->
                    <div class="single-testimonial-area">
                        <div class="testimonial-image">
                            <img src="{{ asset('userSite/img/testimonial/testimonial1.png') }}" alt="">
                        </div>
                        <div class="testimonial-content">
                            <p class="author-desc">  All Perfect !! I have three sites with magento , this theme is the best !! Excellent support , advice theme installation package , sorry for English, are Italian but I had no problem !! Thank you ! ..</p>
                            <p class="testimonial-author">Alva Ono</p>
                        </div>
                    </div>
                    <!--Single Testimonial Area End-->
                </div>
                <div class="col-12">
                    <!--Single Testimonial Area Start-->
                    <div class="single-testimonial-area">
                        <div class="testimonial-image">
                            <img src="{{ asset('userSite/img/testimonial/testimonial2.png') }}" alt="">
                        </div>
                        <div class="testimonial-content">
                            <p class="author-desc">Perfect Themes and the best of all that you have many options to choose! Best Support team ever!Very fast responding and experts on their fields! Thank you very much! ..</p>
                            <p class="testimonial-author">Amber Laha</p>
                        </div>
                    </div>
                    <!--Single Testimonial Area End-->
                </div>
                <div class="col-12">
                    <!--Single Testimonial Area Start-->
                    <div class="single-testimonial-area">
                        <div class="testimonial-image">
                            <img src="{{ asset('userSite/img/testimonial/testimonial3.png') }}" alt="">
                        </div>
                        <div class="testimonial-content">
                            <p class="author-desc"> Code, template and others are very good. The support has served me immediately and solved my problems when I need help. Are to be congratulated. Att Renan Andrade ..</p>
                            <p class="testimonial-author">Dewey Tetzlaff</p>
                        </div>
                    </div>
                    <!--Single Testimonial Area End-->
                </div>
                <div class="col-12">
                    <!--Single Testimonial Area Start-->
                    <div class="single-testimonial-area">
                        <div class="testimonial-image">
                            <img src="{{ asset('userSite/img/testimonial/testimonial4.png') }}" alt="">
                        </div>
                        <div class="testimonial-content">
                            <p class="author-desc">  All Perfect !! I have three sites with magento , this theme is the best !! Excellent support , advice theme installation package , sorry for English, are Italian but I had no problem !! Thank you ! ..</p>
                            <p class="testimonial-author">Lavina Wilderman</p>
                        </div>
                    </div>
                    <!--Single Testimonial Area End-->
                </div>
                <div class="col-12">
                    <!--Single Testimonial Area Start-->
                    <div class="single-testimonial-area">
                        <div class="testimonial-image">
                            <img src="{{ asset('userSite/img/testimonial/testimonial5.png') }}" alt="">
                        </div>
                        <div class="testimonial-content">
                            <p class="author-desc">  All Perfect !! I have three sites with magento , this theme is the best !! Excellent support , advice theme installation package , sorry for English, are Italian but I had no problem !! Thank you ! ..</p>
                            <p class="testimonial-author">Stefano</p>
                        </div>
                    </div>
                    <!--Single Testimonial Area End-->
                </div>
            </div>
        </div>
    </div>
</div>
<!--Testimonial Area End-->
<!--Event Area Start-->
<div class="event-area section-padding bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-wrapper">
                    <div class="section-title">
                        <h3>OUR EVENTS</h3>
                        <p>There are many variations of passages</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-event-item">
                    <div class="single-event-image">
                        <a href="event-details.html">
                            <img src="{{ asset('userSite/img/event/1.jpg') }}" alt="">
                            <span>15 Jun</span>
                        </a>
                    </div>
                    <div class="single-event-text">
                        <h3><a href="event-details.html">Learn English in ease</a></h3>
                        <div class="single-item-comment-view">
                           <span><i class="zmdi zmdi-time"></i>4.00 pm - 8.00 pm</span>
                           <span><i class="zmdi zmdi-pin"></i>Dhaka Bangladesh</span>
                       </div>
                       <p>There are many variaons of passa of Lorem Ipsuable, amrn in sofby injected humour, amr sarata din megla....</p>
                       <a class="button-default" href="event-details.html">LEARN Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-event-item">
                    <div class="single-event-image">
                        <a href="event-details.html">
                            <img src="{{ asset('userSite/img/event/2.jpg') }}" alt="">
                            <span>20 Apr</span>
                        </a>
                    </div>
                    <div class="single-event-text">
                        <h3><a href="event-details.html">Learn English in ease</a></h3>
                        <div class="single-item-comment-view">
                           <span><i class="zmdi zmdi-time"></i>4.00 pm - 8.00 pm</span>
                           <span><i class="zmdi zmdi-pin"></i>Jessore Bangladesh</span>
                       </div>
                       <p>There are many variaons of passa of Lorem Ipsuable, amrn in sofby injected humour, amr sarata din megla....</p>
                       <a class="button-default" href="event-details.html">LEARN Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-event-item">
                    <div class="single-event-image">
                        <a href="event-details.html">
                            <img src="{{ asset('userSite/img/event/3.jpg') }}" alt="">
                            <span>06 Dec</span>
                        </a>
                    </div>
                    <div class="single-event-text">
                        <h3><a href="event-details.html">Learn English in ease</a></h3>
                        <div class="single-item-comment-view">
                           <span><i class="zmdi zmdi-time"></i>4.00 pm - 8.00 pm</span>
                           <span><i class="zmdi zmdi-pin"></i>Dhaka. Bangladesh</span>
                       </div>
                       <p>There are many variaons of passa of Lorem Ipsuable, amrn in sofby injected humour, amr sarata din megla....</p>
                       <a class="button-default" href="event-details.html">LEARN Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End of Event Area-->
@endsection
