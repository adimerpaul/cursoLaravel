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
    <button id="viewImageBtn">Ver Imagen</button> <br>
    <button id="firstPageBtn">Primera Página</button>
    <button id="nextPageBtn">Siguiente Página</button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
        </tbody>
    </table>
    <div id="jsonUsersView"></div>
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
        let page = 1;
        const userTableBody = document.getElementById('userTableBody');
        const jsonUser =[]
        const getCliente = async () => {
            const response = await fetch(`/api/user?page=${page}`);
            const data = await response.json();
            const res = data.data;
            
            // console.log(data);
            // jsonUser.push(...data);
            // const jsonUsersView = document.getElementById('jsonUsersView');
            // jsonUsersView.innerText = JSON.stringify(jsonUser, null, 2);
            res.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.created_at}</td>
                    <td>${user.updated_at}</td>
                `;
                userTableBody.appendChild(row);
            });
        };

        getCliente();

        const firstPageBtn = document.getElementById('firstPageBtn');
        firstPageBtn.onclick = function() {
            page = (page - 1 < 1) ? 1 : (page - 1);
            userTableBody.innerHTML = '';
            getCliente();
        };

        const nextPageBtn = document.getElementById('nextPageBtn');
        nextPageBtn.onclick = function() {
            page++;
            userTableBody.innerHTML = '';
            getCliente();
        };
    };
</script>
</html>