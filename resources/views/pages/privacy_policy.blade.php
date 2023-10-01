@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="container mb-4">
      <h4 class="text-center">
        Privacy Policy
      </h4>
      This Privacy Policy is prepared by {{ \App\CPU\Helpers::getConfig('web_name') }} and whose registered address is {{ \App\CPU\Helpers::getConfig('address') }}. <br> 
      We are committed to protecting and preserving the privacy of our visitors when visiting our site or communicating
      electronically with us. <br> <br>
      This policy sets out how we process any personal data we collect from you or that you provide to us through our
      website and social media sites. We confirm that we will keep your information secure and comply fully with all
      applicable {{ \App\CPU\Helpers::getConfig('country') }} Data Protection legislation and regulations. <br> Please read the following carefully to
      understand what happens to personal data that you choose to provide to us, or that we collect from you when you
      visit our sites. By submitting information you are accepting and consenting to the practices described in this
      policy. <br> <br>
      Types of information we may collect from you
      We may collect, store and use the following kinds of personal information about individuals who visit and use our
      website and social media sites:
      Information you supply to us. You may supply us with information about you by filling in forms on our website or
      social media. This includes information you provide when you submit a contact/inquiry form. The information you give
      us may include but is not limited to, your name, address, e-mail address, and phone number.
      How we may use the information we collect
      We use the information in the following ways:
      Information you supply to us. We will use this information:
      to provide you with information and/or services that you request from us;
      To contact you to provide the information requested.
      Disclosure of your information
      Any information you provide to us will either be emailed directly to us or may be stored on a secure server. <br> <br>
      We do not rent, sell or share personal information about you with other people or non-affiliated companies.
      We will use all reasonable efforts to ensure that your personal data is not disclosed to regional/national
      institutions and authorities unless required by law or other regulations. <br> <br>
      Unfortunately, the transmission of information via the internet is not completely secure. Although we will do our
      best to protect your personal data, we cannot guarantee the security of your data transmitted to our site; any
      transmission is at your own risk. Once we have received your information, we will use strict procedures and security
      features to try to prevent unauthorized access. <br> <br>
      Your rights - access to your personal data
      You have the right to ensure that your personal data is being processed lawfully (“Subject Access Right”). Your
      subject access right can be exercised in accordance with data protection laws and regulations. Any subject access
      request must be made in writing to {{ \App\CPU\Helpers::getConfig('email') }}. We will provide your personal data to you within the
      statutory time frames. To enable us to trace any of your personal data that we may be holding, we may need to
      request further information from you. If you complain about how we have used your information, you have the right to
      complain to the Information Commissioner's Office (ICO). <br> <br>
      Changes to our privacy policy
      Any changes we may make to our privacy policy in the future will be posted on this page and, where appropriate,
      notified to you by e-mail. Please check back frequently to see any updates or changes to our privacy policy.
      Contact
      Questions, comments, and requests regarding this privacy policy are welcomed and should be addressed to {{ \App\CPU\Helpers::getConfig('email') }}.
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
  $(document).ready(function(){
      $('body').on('click', '.store_page_id', function(e){
        var data = $('.facebook_page_id').val();

        $.ajax({
          url: '{{ route("facebook_page_id") }}',
          data: {
            facebook_page_id: data
          },
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          success: function(data){
            if(data.status == 200){
              Swal.fire({
                title: 'Success!',
                text: data.msg,
                icon: 'success',
                confirmButtonText: 'OK'
              })

            }else{
              Swal.fire({
                title: 'Error!',
                text: data.msg,
                icon: 'error',
                confirmButtonText: 'Cancel'
              })

            }
          }
        })
      })
    })
</script>
@endpush