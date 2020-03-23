{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
    @lang('server.config.name.header')
@endsection

@section('content-header')
    <h1>Alterador de Versão<small>Mude a versão do Minecraft com um clique!</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
        <li><a href="{{ route('server.index', $server->uuidShort) }}">{{ $server->name }}</a></li>
        <li>@lang('navigation.server.configuration')</li>
        <li class="active">Alterador de Versão</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <form action="{{ route('server.settings.version.switch', $server->uuidShort) }}" method="POST">
                <div class="box">
                    <div class="box-body">
                        <div class="form-group no-margin-bottom">
                            <label class="control-label" for="version">Versão</label>
                            <div>
                                <select id="version" name="version" class="form-control">
                                    @foreach($versions as $version)
                                        @if (str_replace('.jar', '', $version) == $nowVersion)
                                            <option selected value="{{str_replace('.jar', '', $version)}}">{{str_replace('.jar', '', $version)}}</option>
                                        @else
                                            <option value="{{str_replace('.jar', '', $version)}}">{{str_replace('.jar', '', $version)}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-sm btn-primary pull-right" value="@lang('strings.submit')" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('js/frontend/server.socket.js') !!}
@endsection
