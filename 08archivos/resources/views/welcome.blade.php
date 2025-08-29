<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    subir imagen
    <form id="form" method="POST" enctype="multipart/form-data" >
        <input type="file" name="file" required>
        <button type="submit">Subir</button>
    </form>
    ver imagen <br>
    <button id="viewImageBtn">Ver Imagen</button>
</body>
<script>
    window.onload = function() {
        srcImage =null;
        const form = document.getElementById('form');
        form.onsubmit = async function(event) {
            event.preventDefault();
            const formData = new FormData(form);
            const response = await fetch('/api/upload', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            alert(result.message);
            if (result.path) {
                srcImage = result.path;
            }
        };
        const viewImageBtn = document.getElementById('viewImageBtn');
        viewImageBtn.onclick = async function() {
            if (srcImage) {
                window.open('storage/'+srcImage, '_blank');
            } else {
                alert('No hay imagen para mostrar. Por favor, suba una imagen primero.');
            }
        };
    };
</script>
</html>