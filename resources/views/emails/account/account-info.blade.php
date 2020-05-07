@component('mail::message')
Account Information

<p>Below are your credentials. </p>

<h5>Login Deatils</h5>
<p><b>Email :</b> {{ $data['email'] }}</p>
<p><b>Password : </b> {{ $data[0] }}</p>

<p>Welcome on board.</p>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
