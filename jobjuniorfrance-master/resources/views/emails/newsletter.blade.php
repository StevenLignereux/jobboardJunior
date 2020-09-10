@include('emails.header')
@include('emails.body', ['jobs' => $jobs, 'token' => $token])
@include('emails.footer')