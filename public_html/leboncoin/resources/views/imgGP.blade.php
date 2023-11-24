
@extends('layouts.app')


@section('content')
<h2>Glisser deposer</h2>
    <style>
        #drop-zone {
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
        }

        #image-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div id="drop-zone">
        <p>Faites glisser et déposez des images PNG ou JPG ici.</p>
    </div>

    <form id="formImgC" method="post">
        <div id="image-container"></div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var dropZone = document.getElementById('drop-zone');
            var imageContainer = document.getElementById('image-container');
                
            // Empêcher le comportement par défaut pour éviter le chargement du fichier dans le navigateur
            dropZone.addEventListener('dragover', function (e) {
                e.preventDefault();
            });
        
            // Gérer l'événement de glisser
            dropZone.addEventListener('drop', function (e) {
                e.preventDefault();
            
                var files = e.dataTransfer.files;
                
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    console.log(file.name);
                    // Vérifier si le fichier est une image PNG ou JPG
                    if (file.type === 'image/png' || file.type === 'image/jpeg') {
                        // Créer un élément image et l'ajouter à la page
                        var imgElement = document.createElement('img');
                        imgElement.src = URL.createObjectURL(file);
                        imgElement.alt = 'Image';
                        console.log(imgElement.src);
                        imageContainer.appendChild(imgElement);
                    }
                }

            });
        });
    </script>
    <?php
        // pg_connect("host=localhost dbname=s224 user=s224 password=1s9yiZ");
        // pg_query("set names 'UTF8'");
        // pg_query("SET search_path TO leboncoin");

        // $img = $_POST['image-container'];

        // $query = "INSERT INTO photo (photo) VALUES ('$img')";


    ?>
</body>
</html>







</form>


@endsection
