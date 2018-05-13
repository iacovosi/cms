@extends('layouts.app')

@section('content')

      <div class="panel panel-default">
            <div class="panel-heading">
                  Sigma Live
            </div>
            <div class="panel-body">
                  <table class="table table-hover">
                        <thead>
                              <th>
                                Image
                              </th>
                              <th>
                                Title   
                              </th>
                        </thead>

                        <tbody>
                              @if(count($arrayofAll) > 0)
                                    @foreach($arrayofAll as $posts)
                                          <tr>
                                                <td>
                                                    <img  height="50" width="50" src="{{ $posts['realimage'] }}" alt="our case"/> 
                                                </td>
                                                <td>
                                                    <a href="{{$posts['link'] }}" target="_blank">{{ $posts['title'] }}</a>
                                                </td>

                                          </tr>
                                    @endforeach
                              @endif
                        </tbody>
                  </table>
            </div>
      </div>

@stop