<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba envio de correo</title>
</head>
<body>

<form method="post" action="enviarcorreo.php">
    
<label for="">Nombre del enviador:</label><input class="form-control" type="text" name="enviador">
</br>
<label for="">Email a responder:</label>
<input class="form-control" type="email" name="respondera">
</br>
<label for="">Mensaje a enviar:</label>
<div class="form-group">
    <label for="my-textarea">Text</label>
    <textarea id="my-textarea" class="form-control" name="mensajeenviador" rows="3"></textarea>
</div>
</br>
<button type="submit">envio de correo</button>



</form>
    
</body>
</html>