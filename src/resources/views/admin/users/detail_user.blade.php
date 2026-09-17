@extends('admin.layouts.app') 

@section('title', 'User Detail') 

@section('content') 
<div class="max-w-[1400px] space-y-6">     
    @include('admin.users.partials.user_header')     
    
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">         
        @include('admin.users.partials.personal_info')         
        @include('admin.users.partials.website_info')         
        @include('admin.users.partials.subscription_info')         
        @include('admin.users.partials.admin_notes')     
    </div>     
    
    @include('admin.users.partials.payment_history') 
</div> 
@endsection