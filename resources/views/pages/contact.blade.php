@extends('main')
@section('title','Contact')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Contact me</h1>
            <hr>
            <form>
                <div class="from-group">
                    <label name="email">Email:</label>
                    <input id="email" name="email" class="form-control">
                </div>
                <div class="from-group">
                    <label name="subject">Subject:</label>
                    <input id="subject" name="subject" class="form-control">
                </div>
                <div class="from-group">
                    <label name="message">Message:</label>
                    <textarea id="message" name="message" class="form-control">Type yor message here...</textarea>
                </div>
                <hr>
                <input type="submit" value="Send Message" class="btn-success">
            </form>

        </div>
    </div>

@endsection
