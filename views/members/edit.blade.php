@extends('members::template')

@section('content')
<div id="registration" class="et_pb_column ui container">
    <form class="ui form" action="{{route('members.update', $user)}}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        @include('members::form')
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>

        <div class="ui error message"></div>
        <div class="field actions">
            <a class="ui button" href="{{ route('members.index') }}">{{ ___('Cancel') }}</a>
            <button type="submit" class="ui right floated primary button">
                {{ ___('Update') }}
            </button>
        </div>

    </form>
</div>

@endsection