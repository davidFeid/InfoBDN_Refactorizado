function validar(){
    var hoy             = new Date();
    var fecha_inicio = new Date(document.getElementById('fecha_inicio').value);
    var fecha_final = new Date(document.getElementById('fecha_final').value);

    // Compara solo las fechas => no las horas!!
    hoy.setHours(0,0,0,0);

    if (hoy <= fecha_inicio) {
        if(fecha_inicio < fecha_final){
            return true;
        }else{
            alert('La fecha inicio tiene que ser menor que la fecha final');
            return false;
        }
    }
    else {
        alert('Fecha incorrecta');
        return false;
    }

    /*var fecha_inicio = document.getElementById('fecha_inicio').value;
    var fecha_final = document.getElementById('fecha_final').value;
    const hoy = new Date();
    var hoy1 = `${month}/${day}/${year}`;
    alert(fecha_inicio + " " + fecha_final + " " + hoy);
    if(fecha_inicio < hoy){
        alert('Given data is incorrect');
        return false;
    }
    return true;*/
}