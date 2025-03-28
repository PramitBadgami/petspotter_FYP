@extends('frontend.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('frontend.home') }}">Home</a></li>
                <li class="breadcrumb-item">Contact Us</li>
            </ol>
        </div>
    </div>
</section>

<section class=" section-10">
    <div class="container">
        <div class="section-title mt-5 ">
            <h2>Love to Hear From You</h2>
        </div>   
    </div>
</section>

<section>
    <div class="container">          
        <div class="row">
            <div class="cold-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                {{ Session::get('success') }}
                    </div>
                @endif
            </div>
            <div class="col-md-6 mt-3 pe-lg-5">
                <p>We're here to help you with any questions or concerns you have about pet adoption and our services at PetSpotter. Feel free to reach out to us through any of the following channels:</p>
                <address>
                Pacific Building, Putalisadak <br>
                Ramshah Path, P.O. Box: 347<br> 
                Kathmandu 44600<br>
                <a href="tel:+xxxxxxxx">(+977) 9860567854</a><br>
                <a href="mailto:jim@rock.com">pramitbadgami2@gmail.com</a>
                </address>          
                <img src="https://www.helpguide.org/wp-content/uploads/2023/02/Benefits-of-Pets.jpeg" style= "width: 80%;">    
            </div>

            <div class="col-md-6">
                <form class="shake" role="form" method="post" id="contactForm" name="contactForm">
                    <div class="mb-3">
                        <label class="mb-2" for="name">Name</label>
                        <input class="form-control" id="name" type="text" name="name" data-error="Please enter your name">
                        <p class="help-block with-errors"></p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="mb-2" for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" data-error="Please enter your Email">
                        <p class="help-block with-errors"></p>
                    </div>
                    
                    <div class="mb-3">
                        <label class="mb-2">Subject</label>
                        <input class="form-control" id="subject" type="text" name="subject" data-error="Please enter your message subject">
                        <p class="help-block with-errors"></p>
                    </div>
                    
                    <div class="mb-3">
                        <label for="message" class="mb-2">Message</label>
                        <textarea class="form-control" rows="3" id="message" name="message" data-error="Write your message"></textarea>
                        <p class="help-block with-errors"></p>
                    </div>
                    
                    <div class="form-submit">
                        <button class="btn btn-dark" type="submit" id="form-submit"><i class="material-icons mdi mdi-message-outline"></i> Send Message</button>
                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('customJs')
<script>
    $("#contactForm").submit(function(event){
        event.preventDefault();
        $("#form-submit").prop('disabled', true);
        $.ajax({
            url:'{{ route("frontend.sendContactEmail") }}',
            type: 'post',
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response){
                $("#form-submit").prop('disabled', false);

                if(response.status == true) {
                    window.location.href = '{{ route("frontend.contact-us") }}'
                } else {
                    var errors = response.errors;
                    if(errors.name) {
                        $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
                    } else {
                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if(errors.email) {
                        $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email);
                    } else {
                        $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if(errors.subject) {
                        $("#subject").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.subject);
                    } else {
                        $("#subject").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }
                }
            }
        })
    });
</script>
@endsection