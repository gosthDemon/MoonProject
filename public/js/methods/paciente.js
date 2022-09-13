let showButton = document.querySelectorAll('.showUser');
showButton.forEach((element) => {
    element.addEventListener('click', function(){
        let new_element = element.parentNode;
        let father = new_element.parentNode;
        let grandparent = father.parentNode;
        let paciente_id = grandparent.children[0].innerHTML;
        document.getElementById('paciente_id').value = grandparent.children[0].innerHTML;
        document.getElementById('nombre').value = grandparent.children[1].innerHTML;
        document.getElementById('apellidos').value = grandparent.children[2].innerHTML;
        document.getElementById('carnet').value = grandparent.children[3].innerHTML;
        document.getElementById('fecha_nacimiento').value = grandparent.children[4].innerHTML;
        document.getElementById('telefono').value = grandparent.children[5].innerHTML;
        document.getElementById('direccion').value = grandparent.children[6].innerHTML;
        document.getElementById('barrio').value = grandparent.children[7].id;
    })
})

let searchButton = document.getElementById('searchButton');
searchButton.addEventListener('click',function(){
    let user = document.getElementById('searchInput').value;
    if(user != ""){
        const http = new XMLHttpRequest();
        const url = "/Paciente/search/"+user;
        http.onreadystatechange = function(){
            if (this.readyState==4 && this.status == 200) {
                let response = JSON.parse(this.responseText);
                document.getElementById('table-body').innerHTML = "";
                response.forEach(paciente => {
                    let addPaciente = `<tr id="tr-table">
                        <th scope="row">`+paciente.ID+`</th>
                            <td>`+paciente.nombre+`</td>
                            <td>`+paciente.apellidos+`</td>
                            <td>`+paciente.carnet+`</td>
                            <td>`+paciente.fecha_nacimiento+`</td>
                            <td>`+paciente.telefono+`</td>
                            <td>`+paciente.direccion+`</td>
                            <td id="`+paciente.Barrio_ID+`">`+paciente.barrio_nombre+`</td>
                            <td>`+paciente.strikes+`</td>
                            <td><div class="size-show"><a href="#" id="showUser" data-toggle="modal" data-target=".showUserModal" value="`+paciente.ID+`" class="showUser" ><i class="far fa-eye"></i> Ver</a></div> </td>
                            <td><div class="size-delete"><a href="#" id="deleteUser" class="deleteUser"><i class="far fa-trash"></i> Eliminar</a></td>
                        </tr>`;
                    document.getElementById('table-body').innerHTML += addPaciente;
                });
            }
        }
        http.open('GET', url);
        http.send();
    }
})

let deleteButton = document.querySelectorAll('.deleteUser');
deleteButton.forEach((element) => {
    element.addEventListener('click', function(){
        Swal.fire({
            title: '¿Estas seguro?',
            text: "¡Esto eliminara un paciente del registro!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#63B7AF',
            cancelButtonColor: '#EE8572',
            confirmButtonText: '¡Si, elimina esto!'
            }).then((result) => {

                if (result.isConfirmed) {
                    let new_element = element.parentNode;
                    let father = new_element.parentNode;
                    let grandparent = father.parentNode;
                    let paciente_id = grandparent.children[0].innerHTML;

                    let formData = new FormData();
                    formData.append("_method", "delete");
                    formData.append("_token", "{{ csrf_token() }}");// sólo en blade

                    const http = new XMLHttpRequest();
                    const url = "/Paciente/delete/"+paciente_id;
                    http.onreadystatechange = function(){
                        if (this.readyState==4 && this.status == 200) {
                            let response = this.responseText;
                            swal.fire({
                                icon: "success",
                                text: "Tu registro se ha eliminado.",
                                confirmButtonColor: '#63B7AF',
                                timer: 1000
                            });
                            window.location.reload();
                    }
                    http.open('POST', url);
                    http.send(formData);
                    }
                }else{
                    swal.fire({
                        icon: "success",
                        text: "Tu regitro esta a salvo.",
                        confirmButtonColor: '#63B7AF',
                    });
                }    
        })
    })
})