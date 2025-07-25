@extends('dashboard')
@section('title','contact us')
@section('content')
<div id="app-content">
    <!-- <div class="container"> -->
        <div class="card mb-4">
            <div class="card-header mb-4">
                <h1>We would like to have you leave us some message</h1>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <p>Our vision propels us to stand out as the finest and most reliable real estate partner within the dynamic landscape of Kenya. </p>
                <p>We aspire to redefine the real estate industry by offering unparalleled services that foster trust, ensuring that every step of your journey with us is met with satisfaction and confidence.</p>
            </div>
            <div class="card-body">
                <div style="border: 2px solid rgb(18, 19, 21); padding: 10px; margin-bottom: 10px;width:fit-content">
                 <h2>You can reach us through the following details</h2>
                      <a href="tel:+254734454368"><i data-feather="message-circle"></i>+254734454368</a><br>
                      <a href="mailto:peterlenzy01@gmail.com"><i data-feather="mail"></i>lenzyhomes@gmail.com</a><br>
                      <a href="tel:+254734454368"><i data-feather="phone"></i>+254734454368</a><br>
                      <a href="https://wa.me/+254113426205"><i data-feather="message-square"></i>+254113426205</a><br>
                      <a href="https://twitter.com/@chimneyvictim"><i data-feather="twitter"></i>@lenzyhomes</a><br>
                      <a href="https://instagram.com/lenzy3177"><i data-feather="instagram"></i>lenzyhomes</a><br>
                      <a href="https://t.me/info@lenzyhomes"><i data-feather="send"></i>info@lenzyhomes</a><br>
                </div>

                <div class="card-footer">
                <div class="row">
                <div class="col">
                    <h3>Our opening hours</h3>
                    <p>Monday to Friday</p>
                    <p>8.00am-4.00pm</p>
                    <p>Saturday</p>
                    <p>9.00am-2.00pm</p>
                </div>
                <div class="col">
                    <h4>Locate us at</h4>
                    <strong><p>Nairobi Kenya</p></strong><br>
                     <a href="https://www.google.com/maps/place/9+DeKalb+Ave,+Brooklyn,+NY+11201"><i data-feather="map-pin"></i>  3<sup>rd</sup> Floor, Brown house/Brooklyne towers</a><br>

                </div>
                <div class="col">
                    <h5>Quick reference</h5>
                    <a href="mailto:peterlenzy01@gmail.com"><i data-feather="mail"></i></a><br>
                     <a href="https://wa.me/+254113426205"><i data-feather="message-square"></i></a><br>
                     <a href="https://instagram.com/lenzy3177"><i data-feather="instagram"></i></a><br>
                     <a href="https://twitter.com/@chimneyvictim"><i data-feather="twitter"></i></a><br>
                     <a href="tel:+254734454368"><i data-feather="message-circle"></i></a>
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .card-footer {
    background-color: lightgrey;
    padding: 20px;
    text-align: start;
}
</style>
    <script src="../build/assets/libs/feather-icons/dist/feather.min.js"></script>
@endsection
