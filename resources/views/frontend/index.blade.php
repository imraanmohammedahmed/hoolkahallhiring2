 @extends('frontend.main_master')
 @section('main')
 
 <div class="banner-area" style="height: 480px;">
            <div class="container">
                <div class="banner-content">
                    <h1>Discover a Hall now</h1>
                    
                     
                </div>
            </div>
        </div>
 <!-- Banner Form Area -->
 <div class="banner-form-area">
            <div class="container">
                <div class="banner-form">
                    <form>
                        <div class="row align-items-center">
                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>CHECK IN TIME</label>
                                    <div class="input-group">
                                    <input autocomplete="off"  type="text" required name="check_in" class="form-control dt_picker" placeholder="yyy-mm-dd">
                                <span class="input-group-addon"></span>
                                    </div>
                                    <i class='bx bxs-chevron-down'></i>	
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3">
                                <div class="form-group">
                                    <label>CHECK OUT TIME</label>
                                    <div class="input-group">
                                    <input autocomplete="off"  type="text" required name="check_out" class="form-control dt_picker" placeholder="yyy-mm-dd">
                                <span class="input-group-addon"></span>
                                    </div>
                                    <i class='bx bxs-chevron-down'></i>	
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2">
                                <div class="form-group">
                                    <label>GUESTS</label>
                                    <select class="form-control">
                                        <option>10</option>
                                        <option>20</option>
                                        <option>30</option>
                                        <option>40</option>
                                        <option>50</option>
                                        <option>60</option>
                                        <option>70</option>
                                        <option>80</option>
                                        <option>90</option>
                                        <option>100</option>
                                    </select>	
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <button type="submit" class="default-btn btn-bg-one border-radius-5">
                                    Check Availability
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Banner Form Area End -->

        <!-- Hall Area -->
@include('frontend.home.hall_area')
        <!-- Hall Area End -->

        <!-- Hall Area Two-->
@include('frontend.home.hall_area_two')
        <!-- Hall Area Two End -->

        <!-- Services Area Three -->
@include('frontend.home.services')
        <!-- Services Area Three End -->

        <!-- Team Area Three -->
@include('frontend.home.team')
        <!-- Team Area Three End -->

        <!-- Testimonials Area Three -->
@include('frontend.home.testimonials')
        <!-- Testimonials Area Three End -->

        <!-- FAQ Area -->
@include('frontend.home.faq')
        <!-- FAQ Area End -->

        <!-- Blog Area -->
@include('frontend.home.blog')
        <!-- Blog Area End -->

        @endsection