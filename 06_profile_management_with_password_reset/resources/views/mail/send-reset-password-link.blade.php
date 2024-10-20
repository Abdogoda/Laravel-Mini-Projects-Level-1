<h3>Hello, {{ $user->name }}</h3>
<p>You are receiving this email because we received a password reset request for your account.</p>
<p>Click the link below to reset your password:</p>
<a href="{{ url('reset-password', ['token' => $token, 'email' => $user->email]) }}">Reset Now</a>
<br><br>
<p>Thank you</p>