@component('mail::message')
# Introduction

Welcome {{ $data['name'] }} <br/>
{{ trans('admin.reset_password') }}.

@component('mail::button', ['url' => url('admin/reset/password/' . $data['token'])])
{{ trans('admin.click_here_to_reset_your_password') }}
@endcomponent

{{ trans('admin.thanks') }},<br>
@endcomponent
