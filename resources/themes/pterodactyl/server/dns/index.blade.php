@extends('layouts.master')

@section('title')
Subdomain Creator
@endsection

@section('content-header')
<h1>Subdomain Creator<small>Manage your own subdomains to make your server address easier to remember.</small></h1>
@endsection

@section('content')
<div class="row">
   <br>
   <div class="col-sm-8">
      <div class="box">
         <div class="box-header with-border">
            <h3 class="box-title">Subdomain Creator</h3>
         </div>
         <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
               <tbody>
                  <tr>
                     <th>Subdomain</th>
                     <th>Domain</th>
                     <th>Actions</th>
                     <th></th>
                  </tr>
                  <tr>
                     <td>
                        <form method="post"
                           action="{{ route('server.dns.create', ['server' => request()->route()->parameters['server']]) }}">
                           @csrf
                           <input class="form-control" type="text" name="domain" id="domain"
                              placeholder="Your Server Name">
                     </td>
                     <td class="middle">
                        <input class="form-control" type="text" disabled value=".{{ env("CLOUDFLARE_DOMAIN") }}">
                     </td>
                     <td class="col-xs-2 middle">
                        <button class="btn btn-md btn-default" type="submit">Create</button>
                        </form>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div id="toggleActivityOverlay" class="overlay hidden">
            <i class="fa fa-refresh fa-spin"></i>
         </div>
      </div>
   </div>
   <div class="col-sm-4">
      <div class="box">
         <div class="box-header with-border">
            <h3 class="box-title">Subdomain Creator Help</h3>
         </div>
         <div class="box-body">
            <p>You can get your desired subdomain. This will get rid of the need of a dedicated IP. You don't have to
               type a port after this.</p>
         </div>
      </div>
   </div>
   <div class="col-sm-8">
      <br>
      <div class="box">
         <div class="box-header with-border">
            <h3 class="box-title">Subdomain list</h3>
         </div>
         <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
               <tbody>
                  <tr>
                     <th>Subdomain</th>
                     <th>Server Allocation</th>
                     <th>Actions</th>
                     <th></th>
                  </tr>
                  <tr>
                     <td class="middle">
                        <code>{{ $sub }}</code>
                     </td>
                     <td class="middle">
                        <code>{{ $server->allocation->alias }}:{{ $server->allocation->port }}</code>
                     </td>
                     <td class="col-xs-2 middle">
                        <form method="post"
                           action="{{ route('server.dns.delete', ['server' => request()->route()->parameters['server']]) }}">
                           @csrf
                           <button class="btn btn-md btn-default" type="submit">Delete</button>
                        </form>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   @endsection

   @section('footer-scripts')
   @parent
   {!! Theme::js('js/frontend/server.socket.js') !!}
   <script>
      $(document).ready(function () {
         @can('edit-allocation', $server)
            (function triggerClickHandler() {
               $('a[data-action="set-default"]:not(.disabled)').click(function (e) {
                  $('#toggleActivityOverlay').removeClass('hidden');
                  e.preventDefault();
                  var self = $(this);
                  $.ajax({
                     type: 'PATCH',
                     url: Router.route('server.settings.allocation', {
                        server: Pterodactyl.server.uuidShort
                     }),
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                     },
                     data: {
                        'allocation': $(this).data('allocation')
                     }
                  }).done(function () {
                     self.parents().eq(2).find('a[role="button"]').removeClass(
                           'btn-success disabled')
                        .addClass('btn-default').html('{{ trans('
                           strings.make_primary ') }}');
                     self.removeClass('btn-default').addClass('btn-success disabled').html(
                        '{{ trans('
                        strings.primary ') }}');
                  }).fail(function (jqXHR) {
                     console.error(jqXHR);
                     var error = 'An error occurred while trying to process this request.';
                     if (typeof jqXHR.responseJSON !== 'undefined' && typeof jqXHR.responseJSON
                        .error !== 'undefined') {
                        error = jqXHR.responseJSON.error;
                     }
                     swal({
                        type: 'error',
                        title: 'Whoops!',
                        text: error
                     });
                  }).always(function () {
                     triggerClickHandler();
                     $('#toggleActivityOverlay').addClass('hidden');
                  })
               });
            })();
         @endcan
      });
   </script>
   @endsection