@extends('layouts.app')

@section('content')
    {{-- Add New Users --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <br>
                {{-- <div class="card"> --}}
                    <div class="card-header">
                        <button type="button" class="btn btn-outline-primary " data-toggle="modal"
                            data-target="#exampleModalCenter">Add User
                        </button>&nbsp;
                        <form class="form-inline my-2 my-lg-0 float-end">
                            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search By: Name, Email, Mobile" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>

                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>

    <!-- Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    {{-- Modal For New User --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/') }}/addUser">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="form-outline">
                                    <label for="name" class="">{{ __('First Name') }}</label>
                                    <input id="First_Name" type="text"
                                        class="form-control @error('First_Name') is-invalid @enderror" name="First_Name"
                                        value="{{ old('First_Name') }}" autocomplete="First_Name" autofocus>

                                    @error('First_Name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label for="Last_Name" class="">{{ __('Last Name') }}</label>
                                    <input id="Last_Name" type="text"
                                        class="form-control @error('Last_Name') is-invalid @enderror" name="Last_Name"
                                        value="{{ old('Last_Name') }}" autocomplete="Last_Name" autofocus>

                                    @error('Last_Name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label for="email" class="">{{ __('Email') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label for="mobile" class=" col-form-label text-md-end">{{ __('Mobile') }}</label>
                                    <input id="mobile" type="text"
                                        class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                        value="{{ old('mobile') }}" autocomplete="mobile" autofocus>

                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-md-flex justify-content-start align-items-center ">

                            <label for="gender" class="mb-0 px-1 me-4">{{ __('Gender') }}</label>

                            <div class="form-check  p-4">
                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                    name="gender" id="male" value="male">
                                <label class="form-check-label" for="male">
                                    Male
                                </label>
                            </div>
                            <div class="form-check ">
                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio"
                                    name="gender" id="female" value="female">
                                <label class="form-check-label" for="female">
                                    Female
                                </label>
                            </div>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-outline">
                                    <label for="password"
                                        class=" col-form-label text-md-end">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-success">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal --}}

    {{-- Allusers --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <br>
                <div class="card">
                    <div class="card-header">{{ __('All Users') }}&nbsp;
                        <a class="float-end" href="{{ url('/') }}/home">Back</a>
                        <span class="msg" style="background-color:lightgreen; border-radius:5px;">
                            {{-- message span tag --}}
                        </span>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="padding-left: 15px;" scope="col">Sr.No</th>
                                    <th style="padding-left: 15px;" scope="col">First Name</th>
                                    <th style="padding-left: 15px;" scope="col">Last Name</th>
                                    <th style="padding-left: 15px;" scope="col">Email</th>
                                    <th style="padding-left: 25px;" scope="col">Mobile</th>
                                    <th style="padding-left: 15px;" scope="col">Gender</th>
                                    <th style="padding-left: 15px;" scope="col">Action/Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($adminUser as $allUser)
                                    <tr>
                                        <th style="padding: 20px;" scope="row">{{ $allUser['id'] }}</th>
                                        <td style="padding: 20px;">{{ $allUser['First_Name'] }}</td>
                                        <td style="padding: 20px;">{{ $allUser['Last_Name'] }}</td>
                                        <td style="padding: 20px;">{{ $allUser['email'] }}</td>
                                        <td style="padding: 20px;">{{ $allUser['mobile'] }}</td>
                                        <td style="padding: 20px;">{{ $allUser['gender'] }}</td>
                                        <td style="padding: 20px;">
                                            <a href="{{ url('/') }}/adminProfile/{{ $allUser['id'] }}"
                                                class="btn btn-outline-success">Edit</a>

                                            @if ($allUser['status'] == 'Active')
                                                <input data-id="{{ $allUser->id }}" class="toggle-class"
                                                    type="checkbox" data-onstyle="success" data-offstyle="danger"
                                                    data-toggle="toggle" data-on="Active" data-off="Deactive"
                                                    {{ $allUser->status ? 'checked' : '' }}>
                                            @elseif($allUser['status'] == 'Deactive')
                                                <input data-id="{{ $allUser->id }}" class="toggle-class"
                                                    type="checkbox" data-onstyle="success" data-offstyle="danger"
                                                    data-toggle="toggle" data-on="Active" data-off="Deactive"
                                                    {{ $allUser->status ? '' : 'checked' }}>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div style="display: flex; justify-content: center;">{!! $adminUser->appends(Request::all())->links() !!}</div>

    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 'Active' : 'Deactive';
                var user_id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeStatus',
                    data: {
                        'status': status,
                        'user_id': user_id
                    },
                    success: function(data) {

                        $('.msg').html(data.success);

                    }
                });
            })
        })
    </script>
@endsection
