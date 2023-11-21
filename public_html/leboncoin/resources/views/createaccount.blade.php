<link rel="stylesheet" type="text/css" href="{{asset('style.css')}}"/> 
<section>
    <form action="{{ url('/createaccountparticulier') }}" method="get"><div><input class="inputaccount" type="submit" value="" > Pour vous</div></form>
    <form action="{{ url('/createaccountentreprise') }}" method="get"><div><input class="inputaccount" type="submit" value="" > Pour votre entreprise</div></form>
</section>
