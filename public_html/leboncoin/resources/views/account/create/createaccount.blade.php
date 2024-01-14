<link rel="stylesheet" type="text/css" href="{{asset('create.css')}}"/> 
<div class="flecheretour" onclick="history.back()">←</div>
<div class="titleconnect"><a href="{{ url("/annonce-filtres?ville=&type_hebergement=&datedebut=") }}"><b>LeBonCoin</b></a></div>
<section>
    <form id="formaccount" action="{{ url('/createaccountparticulier') }}" method="get"><div><input id="inputaccount" type="submit" value="" > Pour vous</div></form>
    <form id="formaccount" action="{{ url('/createaccountentreprise') }}" method="get"><div><input id="inputaccount" type="submit" value="" > Pour votre entreprise</div></form>
</section>
<script>
        var botmanWidget = {
            aboutText: '',
            introMessage: "Bienvenue dans notre site web",
            title: "Chatbot",
            mainColor: '#ff6e14',
            bubbleBackground: '#EC5A13',
            bubbleAvatarUrl: ''
        };
        
    </script>
