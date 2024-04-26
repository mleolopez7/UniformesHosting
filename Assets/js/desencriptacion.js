function desencriptarCorreo(correoEncriptado) {
    // Clave de desencriptación (debes manejar esto de manera segura)
    var claveDesencriptacion = "clave_secreta";

    // Realiza la desencriptación utilizando SHA-256
    var bytes = CryptoJS.SHA256(correoEncriptado);
    var correoDesencriptado = bytes.toString(CryptoJS.enc.Utf8);

    return correoDesencriptado;
}