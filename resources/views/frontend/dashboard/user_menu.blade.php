@php
					
		$id=Auth::user()->id;
		$profileData=App\Models\User::find($id);

@endphp

<div class="service-side-bar">
                            

                            <div class="services-bar-widget">
                                <h3 class="title">User Sidebar</h3>
                                <div class="side-bar-categories">
                                <center><img src="{{ (!empty($profileData->photo)) ? url('upload/user_images/'.$profileData->photo) : url('upload/no_image.jpg') }}" class="rounded mx-auto d-block" alt="Image" style="width: 100px; height: 100px;">
<b><p class="user-name mb-0">{{$profileData->name}}</p>
        <p class="user-name mb-0">{{$profileData->email}}</p>
         <br><br></b></center>


        <ul> 
              
            <li>
                <a href="{{'dashboard'}}">User Dashboard</a>
            </li>
            <li>
                <a href="{{route('user.profile')}}">User Profile </a>
            </li>
            <li>
                <a href="{{route('user.change.password')}}">Change Password</a>
            </li>
            <li>
                <a href="#">Booking Details </a>
            </li>
            <li>
                <a href="{{route('user.logout')}}">Logout</a>
            </li>
        </ul>
                                </div>
                            </div>

                           