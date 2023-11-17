@extends('layouts.app')
<section>
    <form action="{{ url('/createaccountparticulier') }}" method="get"><div><input class="inputaccount" type="submit" value="" > Pour vous</div></form>
    <form action="{{ url('/createaccountentreprise') }}" method="get"><div><input class="inputaccount" type="submit" value="" > Pour votre entreprise</div></form>
</section>
