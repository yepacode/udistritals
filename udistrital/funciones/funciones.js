function mostrar(){
    document.getElementById("encabezado").style.display='block';
    document.getElementById("pie").style.display='block';
    document.getElementById("botones").style.display='block';
    //document.getElementById("corregir").style.display='block';
    //document.getElementById("imprimir").style.display='block';
}
////////////////////////////////////////////////////
function ocultar(){
    document.getElementById("encabezado").style.display='none';
    document.getElementById("pie").style.display='none';
    document.getElementById("botones").style.display='none';
    //document.getElementById("corregir").style.display='none';
    //document.getElementById("imprimir").style.display='none';
}
////////////////////////////////////////////////////
function page_print(){
    ocultar();
    window.print();
    setTimeout("mostrar()",200);
}
////////////////////////////////////////////////////
function abrir_pagina(direccion, pantallacompleta, herramientas, direcciones, estado, barramenu, barrascroll, cambiatamano, ancho, alto, izquierda, arriba, sustituir){
    var opciones = "fullscreen=" + pantallacompleta +
        ",toolbar=" + herramientas +
        ",location=" + direcciones +
        ",status=" + estado +
        ",menubar=" + barramenu +
        ",scrollbars=" + barrascroll +
        ",resizable=" + cambiatamano +
        ",width=" + ancho +
        ",height=" + alto +
        ",left=" + izquierda +
        ",top=" + arriba;
    if(direccion=='ica/detalle_actividad.php'){
        direccion=direccion+"?buscar="+document.form.buscar.value;
    }
    var ventana = window.open(direccion,"venta",opciones,sustituir);
}
////////////////////////////////////////////////////
function Extract(Obj){
    var str=Obj.replace(/,/g, "");
    if(str==""){
        return "0";
    }else{
        return(str);			
    }
}
////////////////////////////////////////////////////	
function Extracttarifa(Obj){
    var str=Obj;
    return(str.replace(/./, ""));
}
////////////////////////////////////////////////////
function formatCurrency(num){
    num = num.toString().replace(/ |,/g,'');
    if(isNaN(num)) 
        num = "0";
    cents = Math.floor((num*100+0.5)%100);
    num = Math.floor((num*100+0.5)/100).toString();
    if(cents < 10) 
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
        num = num.substring(0,num.length-(4*i+3))+','+num.substring(num.length-(4*i+3));
    return (num);
}
////////////////////////////////////////////////////
function numeros(e) {//Inicio De La Función
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla<= 13 ||  tecla >= 48 && tecla <= 57) return true;
    patron = /\d/;
    te = String.fromCharCode(tecla);
    return patron.test(te); 
}
////////////////////////////////////////////////////
function validar_clave_admin(f){
    if(f.actual.value==""){
        alert('Debe digitar la clave actual.');
        f.actual.focus();
        return false
    }
    if(f.nueva.value==""){
        alert('Debe digitar una nueva clave.');
        f.nueva.focus();
        return false
    }
    if(f.nueva.value!=f.confirmacion.value){
        alert('Las clave nueva y la confirmacion no considen.');
        f.nueva.focus();
        return false
    }
    f.cambiar.value=1;
    FAjax('pages/cambiar_clave.php','principal','','post');
}