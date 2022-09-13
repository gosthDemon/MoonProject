$("#table-body").on("click", ".deleteUser", function(){
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
                    let new_element = this.parentNode;
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