@extends('DashboardModule::dashboard.index')

@section('content')
    <div class="content-wrapper PermissionsModule">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @include('DashboardModule::partials.alerts')
                        <h4 class="card-title">Dodawanie nowej paczki uprawnień</h4>
                        <form method="POST" action="{{route('PermissionsModule::permissions.store')}}">
                            @csrf
                            <div class="form-group @error('name') has-danger @enderror">
                                <label for="">Nazwa</label>
                                <input type="text" class="form-control" name="name" placeholder="Wpisz nazwe" value="{{old('name')}}">

                                @error('name')
                                    <small class="error mt-2 text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group @error('anchors') has-danger @enderror">
                                <label for="">Uprawnienia:</label>
                                <input type="hidden" name="anchors" id="anchors">
                                <div class="permissions">
                                    <ul>
                                        @foreach($presences as $presence)
                                            @if($presence->hasChildren())
                                                @include('PermissionsModule::partials.presence', ["presence" => $presence])
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                @error('anchors')
                                    <small class="error mt-2 text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="float-right mt-2 btn btn-primary mr-2">Zapisz</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @javascript('anchors', old('anchors'))
@endsection

@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{mix('vendor/css/PermissionsModule.css')}}">
@endsection

@section('javascripts')
    @parent
    <script src="{{mix('vendor/js/PermissionsModule.js')}}"></script>
@endsection
