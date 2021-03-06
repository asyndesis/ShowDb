@extends('layouts.master')

@section('title')
Stats ({{ $user->username }})
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-6">

      <h3>Stats ({{ $user->username }})
    <button id="usershare" data-toggle="tooltip"
        data-placement="right"
        title="Copy to clipboard"
        class="btn btn-primary btn-sm"
        data-clipboard-text="{{ url()->current() }}" ><i class="fa fa-share-alt"></i>
    </button>
      </h3>
      <div class="well">
    <dl class="dl-horizontal">
      <dt>Past Shows</dt>
      <dd><a href="{{ url()->current() }}/shows">{{ count($past_shows) }}</a></dd>
      <dt>Upcoming Shows</dt>
      <dd><a href="{{ url()->current() }}/shows">{{ count($upcoming_shows) }}</a></dd>
      <dt>Unique Songs</dt>
      <dd><a href="{{ url()->current() }}/songs">{{ count($songs) }}</a></dd>
      <dt>Song Performances</dt>
      <dd>{{ $total_songs }}</dd>
      @if($first_show)
      <dt>First Show</dt>
      <dd><a href="/shows/{{ $first_show->id }}">{{ $first_show->date }} {{ $first_show->venue }}</a></dd>
      <dt>Last Show</dt>
      <dd><a href="/shows/{{ $last_show->id }}">{{ $last_show->date }} {{ $last_show->venue }}</a></dd>
      @endif
      <dt>Next Show</dt>
      <dd>
        @if($next_show)
        <a href="/shows/{{ $next_show->id }}">{{ $next_show->date }} {{ $next_show->venue }}</a>
        @else
        ???
        @endif
      </dd>

      @if(count($incomplete_setlist_shows))
      <br>
      <dt>Incomplete Shows</dt>
      <dd><a href="{{ url()->current() }}/shows?i=1">{{ count($incomplete_setlist_shows) }} Show(s) with incomplete setlist data</a></dd>
      @endif

    </dl>
      </div>
    </div>
    <div class="col-md-6">
      <h3>Album Stats</h3>
      <div class="well">
    <dl class="dl-horizontal">
      @foreach($albums as $album)
      <dt>{{ $album->title }}</dt>
      <dd>
        <a href="{{ url()->current() }}/albums?id={{ $album->id }}">
        @php($found = false)
        @foreach($album_info as $al)
        @if($al->album_id == $album->id)
        {{ round(100*($al->album_songs / $al->total),1) }}%
        @php($found = true)
        @endif
        @endforeach
        @if(!$found)
        0%
        @endif
        </a>
      </dd>
      @endforeach
    </dl>
      </div>

    </div>
  </div>

  <h3>Yearly Breakdown</h3>
  @foreach($yearly_data as $str => $year)
  <h4>{{ $str }}</h4>
  <div class="well">
    <dl class="dl-horizontal">
      <dt>Shows</dt>
      <dd><a href="{{ url()->current() }}/shows?q={{ $str }}">{{ $year->shows }}</a></dd>
      <dt>Unique Songs</dt>
      <dd><a href="{{ url()->current() }}/songs/?q={{ $str }}">{{ $year->unique_songs }}</a></dd>
      <dt>Song Performances</dt>
      <dd>{{ $year->songs }}</dd>
    </dl>
  </div>
  @endforeach
</div>

@endsection
