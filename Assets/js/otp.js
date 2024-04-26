const btnAccion = document.querySelector('#btnAccionotp');
const nueva_clave = document.querySelector('#nueva_claveotp');
const confirmar_clave = document.querySelector('#confirmar_claveotp');
const token = document.querySelector('#token');
let validarContraseñalarga = /^.{8,}$/
let validarContraseñasegura = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/

document.addEventListener('DOMContentLoaded', function () {
    btnAccion.addEventListener('click', function () {
        if (nueva_clave.value == '' || confirmar_clave.value == '') {
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'warning',
                title: 'Todos los campos con * son requeridos',
                showConfirmButton: false,
                timer: 2000
            })
        }else if(!validarContraseñalarga.test(nueva_clave.value)){
            Swal.fire({
                icon: "error",
                title: "Contraseña muy corta",
                text: "La contraseña que ingresó es corta, debe de contener mínimo 8 caracteres.",
                });
        }else if(!validarContraseñasegura.test(nueva_clave.value)){
            Swal.fire({
                icon: "error",
                title: "Contraseña insegura",
                text: "La contraseña que ingresó es insegura, debe de tener mayusculas, signos y números.",
                });
        }else{
            if (nueva_clave.value != confirmar_clave.value) {
                Swal.fire({
                    toast: true,
                    position: 'top-right',
                    icon: 'warning',
                    title: 'Las contraseñas no coinciden',
                    showConfirmButton: false,
                    timer: 2000
                })
            }else{
                const url = base_url + 'usuarios/cambiarClave/';
                //hacer una instancia del objeto XMLHttpRequest 
                const http = new XMLHttpRequest();
                //Abrir una Conexion - POST - GET
                http.open('POST', url, true);
                //Enviar Datos
                http.send(JSON.stringify({
                    nueva: nueva_clave.value,
                    confirmar: confirmar_clave.value,
                    token: token.value,
                }));
                //verificar estados
                http.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        const res = JSON.parse(this.responseText);
                        Swal.fire({
                            toast: true,
                            position: 'top-right',
                            icon: res.type,
                            title: res.msg,
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if(res.type == 'success'){
                            setTimeout(() => {
                                window.location =base_url;
                            }, 3000);

                        }
                    }
                }
            }
        }
    })

})