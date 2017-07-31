@extends('member::template')

{{-- @section('page.head.menu')
    <div class="ui secondary menu">
        <a class="item" href="{{ action('ContentTypes\Members\Controllers\AdminController@create') }}">
            <i class="user add icon"></i>{{ ___('Add Member') }}
        </a>
    </div>
@endsection --}}

@section('content')
<div class="ui text menu">
    <div class="header item">
        <i class="filter icon"></i> {{ ___('Filter By') }}
    </div>
    <a class="item @if($filter && $filter == 'active') active @endif" href="{{ route('members.index') }}">{{ ___('Active') }}</a>
    {{-- <a class="item @if($filter && $filter == 'pending') active @endif" href="{{ route('members.pending') }}">{{ ___('Pending') }}</a> --}}
    <a class="item @if($filter && $filter == 'deleted') active @endif" href="{{ route('members.deleted') }}">{{ ___('Deleted') }}</a>

    <div class="right menu">
        <div class="item">
            <form class="{{ count($errors) != 0 ? ' error' : '' }}" method="GET">
                <div class="ui left icon right action input">
                    <input type="text" placeholder="{{ ___('Enter search query') }}" name="search" value="{{ collect(Request::instance()->query)->get('search') }}">
                    <i class="search icon"></i>
                    <button type="submit" class="ui primary button">{{ ___('Search') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<table class="ui selectable table">
    <thead>
        <tr>
            <th>{{ ___('Name') }}</th>
            <th>{{ ___('Email') }}</th>
            <th class="center aligned collapsing">{{ ___('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($members as $member)
            <tr data-member-id="{{ $member->id }}">
                <td>{{ $member->name }}</td>
                <td>{{ $member->email }}</td>
                <td class="collapsing right aligned">
                    <div class="ui text compact menu">
                        @can('update', $member)
                        <a href="{{ route('members.edit', ['member' => $member]) }}" class="item">
                            <i class="pencil icon"></i> {{ ___('Edit') }}
                        </a>
                        @endcan

                        @if (Auth::user()->hasRole([\Baytek\Laravel\Users\Roles\Root::ROLE]))
                            <a class="item" href="{{ route('user.roles', ['user' => $member]) }}">
                                <i class="user icon"></i> {{ ___('Roles') }}
                            </a>
                        @endif

                        @can('update', $member)
                            @if ($filter != 'active')
                                @button(___('Approve'), [
                                    'method' => 'post',
                                    'location' => 'members.approve',
                                    'type' => 'route',
                                    'confirm' => '<h1 class=\'ui inverted header\'>'.___('Approve this member?').'<div class=\'sub header\'>'.$member->name.'</div></h1>',
                                    'class' => 'item action',
                                    'prepend' => '<i class="checkmark icon"></i>',
                                    'model' => $member,
                                ])
                            @endif

                            @if ($filter != 'deleted')
                                @button(___('Delete'), [
                                    'method' => 'post',
                                    'location' => 'members.decline',
                                    'type' => 'route',
                                    'confirm' => '<h1 class=\'ui inverted header\'>'.___('Delete this member?').'<div class=\'sub header\'>'.$member->name.'</div></h1>',
                                    'class' => 'item action',
                                    'prepend' => '<i class="delete icon"></i>',
                                    'model' => $member,
                                ])
                            @endif
                        @endcan
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">
                    <div class="ui centered">{{ ___('There are no results') }}</div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $members->appends(collect(Request::instance()->query)->toArray())->links('pagination.default') }}

@endsection