@extends('user.layouts.master')
@section('title', 'Privacy Policy')
@section('meta_description', 'Read the privacy policy for Jobs in USA describing how we handle user data and cookies.')
@section('content')
<div class="container margin-top-50">
    <h1>Privacy Policy</h1>
    <p>We respect your privacy. This page explains how we collect, use, and protect your information when you use Jobs in USA.</p>
    <h2>Information We Collect</h2>
    <p>We collect information you provide in forms and technical data to improve our services.</p>
    <h2>Cookies</h2>
    <p>We use cookies to enhance your experience. You can disable cookies via your browser settings.</p>
    <h2>Contact</h2>
    <p>For privacy inquiries, please <a href="{{ url('/contact') }}">contact us</a>.</p>
</div>
@endsection
