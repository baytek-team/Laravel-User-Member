@extends('member::template')

@section('content')
<div id="registration" class="et_pb_column ui container">
    <form class="ui form" action="{{ route('members.process') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="field{{ $errors->has('csv') ? ' error' : '' }}">
            <label for="csvFile">{{ ___('Member CSV File') }}</label>
            <input type="file" id="csvFile" name="csvFile" placeholder="{{ ___('CSV File') }}" value="">
        </div>
        <div class="ui hidden divider"></div>
        <div class="ui hidden divider"></div>

        <div class="ui error message"></div>
        <div class="field actions">
            <a class="ui button" href="{{ route('members.index') }}">{{ ___('Cancel') }}</a>
            <button type="submit" class="ui right floated primary button">
                {{ ___('Import Members') }}
            </button>
        </div>

    </form>

    @if(!empty($imported))
        <div class="ui hidden divider"></div>
        <div class="ui header">
            <i class="user group icon"></i>
            <div class="content">
                Imported Members
                <div class="sub header">The following members are added to the system. They can now login with their email address and password.</div>
            </div>
        </div>
        <table class="ui very basic striped table">
            <thead>
                <tr>
                    <th class="collapsing">Member ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Home Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach($imported as $member)
                    <tr>
                        <td class="collapsing"><strong>{{ $member['member_id'] }}</strong></td>
                        <td><span>{{ $member['title'] }} {{ $member['first_name'] }} {{ $member['last_name'] }}</span></td>
                        <td>{{ $member['email_address'] }}</td>
                        <td>{{ $member['phone'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif


    @if(!empty($toBeRemoved))
        <div class="ui hidden divider"></div>
        <div class="ui header">
            <i class="remove user icon"></i>
            <div class="content">
                Members Queued to be Removed
                <div class="sub header">These members have records in the system but do not exist in the import file. They should be removed.</div>
            </div>
        </div>
        <form class="ui form" action="{{ route('members.remove') }}" method="POST">
            {{ csrf_field() }}
            <table class="ui very basic striped table">
                <thead>
                    <tr>
                        <th class="collapsing">Member ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Home Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($toBeRemoved as $member)
                        <tr>
                            <td class="collapsing">
                                <label>
                                    <input type="checkbox" name="uid[{{$member->id}}]" value="{{$member->uid}}" />
                                    <strong>{{ $member->uid }}</strong>
                                </label>
                            </td>
                            <td><span>{{ $member->metadata('title') }} {{ $member->name }}</span></td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->metadata('home_phone') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="ui right floated primary button">
                {{ ___('Delete Members') }}
            </button>
        </form>
    @endif

    @if(!empty($missingEmail))
        <div class="ui hidden divider"></div>
        <div class="ui large negative icon message">
            <i class="warning circle icon"></i>
            <div class="content">
                <div class="header">Member Import Incomplete!</div>
                <p>Check the list of members below that were missing email addresses to create accounts with.</p>
            </div>
        </div>

        <div class="ui hidden divider"></div>
        <div class="ui header">
            <i class="warning circle icon"></i>
            <div class="content">
                Missing Email
                <div class="sub header">These entries were not imported because they didn't have an email address. Email addresses are required for login.</div>
            </div>
        </div>
        <table class="ui very basic striped table">
            <thead>
                <tr>
                    <th class="collapsing">Member ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Home Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach($missingEmail as $member)
                    <tr>
                        <td class="collapsing"><strong>{{ $member['member_id'] }}</strong></td>
                        <td><span>{{ $member['title'] }} {{ $member['first_name'] }} {{ $member['last_name'] }}</span></td>
                        <td>{{ $member['email_address'] }}</td>
                        <td>{{ $member['phone'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if(!empty($notImported))
        <div class="ui hidden divider"></div>
        <div class="ui header">
            <i class="info icon"></i>
            <div class="content">
                Members Skipped
                <div class="sub header">These entries were not imported because an entries already existed with their email address</div>
            </div>
        </div>
        <table class="ui very basic striped table">
            <thead>
                <tr>
                    <th class="collapsing">Member ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Home Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notImported as $member)
                    <tr>
                        <td class="collapsing"><strong>{{ $member['member_id'] }}</strong></td>
                        <td><span>{{ $member['title'] }} {{ $member['first_name'] }} {{ $member['last_name'] }}</span></td>
                        <td>{{ $member['email_address'] }}</td>
                        <td>{{ $member['phone'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>

@endsection