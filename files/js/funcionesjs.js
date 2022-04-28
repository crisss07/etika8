/*
 $(document).ready(function(){
 //checkbox
 $("input[name=chk_all]").change(function(){
 $("input[type=checkbox]").each(function(){
 if($("input[name=chk_all]:checked").length==1)
 {
 this.checked=true;
 }
 else
 {
 this.checked=false;
 }
 
 });
 
 });
 
 
 });
 */

$(".main_image .desc").show();
//Show Banner
$(".main_image .block").animate({opacity: 0.85}, 1);
//Establecer opacidad


$(document).ready(function () {
    $('#chk_all').click(
            function ()
            {
                $("INPUT[type='checkbox']").attr('checked', $('#chk_all').is(':checked'));
            }
    )

});

/*  check si desea eliminar imagen*/
$(document).ready(function () {
    $('#check_img1').click(
            function ()
            {
                if ($('#check_img1').is(':checked'))
                {
                    $("#eliminar_imagen").html("<br/><div class='aviso2' align='center' >Usted ha decidio eliminar la imagen anterior<br/></div>");
                } else
                {
                    $("#eliminar_imagen").html("");
                }
            }
    )

});
/*  fin check si desea eliminar imagen*/


/*  check si desea eliminar archivo*/
$(document).ready(function () {
    $('#check_adj1').click(
            function ()
            {
                if ($('#check_adj1').is(':checked'))
                {
                    $("#eliminar_archivo").html("<br/><div class='aviso2' align='center' >Usted ha decidio eliminar el archivo anterior<br/></div>");
                } else
                {
                    $("#eliminar_archivo").html("");
                }
            }
    )

});
/*  fin check si desea eliminar archivo*/


/*  check si desea eliminar audio*/
$(document).ready(function () {
    $('#check_aud1').click(
            function ()
            {
                if ($('#check_aud1').is(':checked'))
                {
                    $("#eliminar_archivo").html("<br/><div class='aviso2' align='center' >Usted ha decidio eliminar el archivo anterior<br/></div>");
                } else
                {
                    $("#eliminar_archivo").html("");
                }
            }
    )

});
/*  fin check si desea eliminar audio*/


/*  check si desea eliminar video*/
$(document).ready(function () {
    $('#check_vid1').click(
            function ()
            {
                if ($('#check_vid1').is(':checked'))
                {
                    $("#eliminar_archivo").html("<br/><div class='aviso2' align='center' >Usted ha decidio eliminar el archivo anterior<br/></div>");
                } else
                {
                    $("#eliminar_archivo").html("");
                }
            }
    )

});
/*  fin check si desea eliminar archivo*/

function LimitAttach(tField, iType)
{
    file = tField.value;
    if (iType == 1)
    {
        extArray = new Array(".jpg", ".gif", ".png");
    }
    if (iType == 2)
    {
        extArray = new Array(".pdf", ".doc", ".xls", ".txt", ".rar", ".zip", ".ppt");
    }
    if (iType == 3)
    {
        extArray = new Array(".mp3");
    }
    if (iType == 4)
    {
        extArray = new Array(".flv", ".swf");
    }
    allowSubmit = false;
    if (!file)
        return;
    while (file.indexOf("\\") != - 1)
        file = file.slice(file.indexOf("\\") + 1);
    ext = file.slice(file.indexOf(".")).toLowerCase();
    for (var i = 0; i < extArray.length; i++) {
        if (extArray[i] == ext)
        {
            allowSubmit = true;
            break;
        }
    }
    if (!allowSubmit)
    {
        if (iType == 1)
        {
            $("#msj_alerta_imagen").html("<br/><div class='error'>Solo puede subir imï¿½genes con las siguientes extensiones <br/>" + (extArray.join(" ")) + "<br/>Por favor, seleccione otra imagen<br/></div>");
        }
        if (iType == 2)
        {
            $("#msj_alerta_archivo").html("<br/><div class='error'>Solo puede subir archivos con las siguientes extensiones <br/>" + (extArray.join(" ")) + "<br/>Por favor, seleccione otro archivo<br/></div>");
        }
        if (iType == 3)
        {
            $("#msj_alerta_audio").html("<br/><div class='error'>Solo puede subir audios con las siguientes extensiones <br/>" + (extArray.join(" ")) + "<br/>Por favor, seleccione otro archivo<br/></div>");
        }
        if (iType == 4)
        {
            $("#msj_alerta_video").html("<br/><div class='error'>Solo puede subir videos con las siguientes extensiones <br/>" + (extArray.join(" ")) + "<br/>Por favor, seleccione otro archivo<br/></div>");
        }
        return false;
    } else {
        if (iType == 1)
        {
            $("#msj_alerta_imagen").html("");
        }
        if (iType == 2)
        {
            $("#msj_alerta_archivo").html("");
        }
        if (iType == 3)
        {
            $("#msj_alerta_audio").html("");
        }
        if (iType == 4)
        {
            $("#msj_alerta_video").html("");
        }
        return true;
    }
}

function confirmar(mensaje) {
    return confirm(mensaje);
}
//para paises y ciudades
function confirmarVerificar(mensaje, id, idp, fid) {
    var ruta = window.location.origin;
    ruta = ruta + $('.rutabase').html();
    var rutaEliminar = ruta + 'eliminar/id/' + id + '/idp/' + idp;
    if (fid != "") {
        rutaEliminar = ruta + 'eliminar/id/' + id + '/idp/' + idp + '/fid/' + fid;
    }
    $.ajax({
        type: "post",
        url: ruta + "verificar/id/" + id + "/idp/" + idp,
        data: {id: id, idp: idp},
        beforeSend: function () {
        },
        success: function (data) {
            if (data == 1)
            {
                alert("El registro no puede ser eliminado por que existen postulantes relacionados");
            } else
            {
                var valor = confirm(mensaje);
                if (valor == 1)
                {
                    window.location.href = rutaEliminar;
                }

            }
        }
    });
//    para evitar que vaya a eliminar directo sin esperar la respuesta del ajax
    return false;
//    console.info(confirm(mensaje));
}
function confirmarCombos(mensaje, id, idp) {
    var ruta = window.location.origin;
    ruta = ruta + $('.rutabase').html();
    var rutaEliminar = ruta + 'eliminar/id/' + id + '/idp/' + idp;
    $.ajax({
        type: "post",
        url: ruta + "verificar/id/" + id + "/idp/" + idp,
        data: {id: id, idp: idp},
        beforeSend: function () {
        },
        success: function (data) {
            console.log(data);
            if (data == 1)
            {
                alert("El registro no puede ser eliminado por que existen postulantes vinculados a este campo");
            } else
            {
                var valor = confirm(mensaje);
                if (valor == 1)
                {
                    window.location.href = rutaEliminar;
                }

            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
//            console.warn(ajaxOptions);
//            console.info(thrownError);
        }
    });
    //    para evitar que vaya a eliminar directo sin esperar la respuesta del ajax
    return false;
}

/*
 $(document).ready(function(){
 }
 /*
 $("#marcar_todos").click(function(){
 
 alert("marcar todos toditos");
 
 
 });
 */
/*
 $("#marcar_todos").click(function(){
 var chks=$("input:checkbox[name^='chk']");
 chks.attr("checked",$(this).is(":checked"))
 })
 $("#desmarcar_todos").click(function(){
 var chks=$("input:checkbox[name^='chk']");
 chks.attr("checked",$(this).is(":checked"))
 })
 /*
 $("input[name^='chk']").click(function(){
 var todos=$("input:checkbox[name^='chk']")
 var activos=$("input:checked[name^='chk']")
 $("#chk_all").attr("checked",todos.length==activos.length)
 })
 */

/*
 });
 */



//funciones

function validar_nombre(nombre)
{
    /*sw=0; j=0;
     i=nom.length;		
     while ((sw==0)&&(j<i))
     {
     e=num.charAt(j);
     a=parseInt(e);
     j++;
     if(!((a>=0)&&(a<=9)))
     {
     sw=1;//alert('si');
     }			
     }
     if(sw==0)
     { return true}
     else
     {return false}*/
}


function validar_vacios(nombres, apaterno, amaterno, presidencia, profocu, telefono, celular, email, ulcolegio, user, pass, form)
{
    cv = 0;
    if (nombres != '')
    {
        if ((validar_nom(nombres, 'Nombres', form)) == true)
        {
            op1 = 1;
        } else
        {
            return false
        }
    } else
    {
        alert("EL campo Nombres es obligatorio");
        form.nombres.focus();
        return false;
    }
    if ((apaterno != '') && (op1 == 1))
    {
        if ((validar_nom(apaterno, 'Apellido paterno', form)) == true)
        {
            op2 = 1;
        } else
        {
            return false
        }
    } else
    {
        alert("EL campo Apellido Paterno es obligatorio");
        form.apaterno.focus();
        return false;
    }

    if ((amaterno != '') && (op2 == 1))
    {
        if ((validar_nom(amaterno, 'Apellido materno', form)) == true)
        {
            op3 = 1;
        } else
        {
            return false
        }
    } else
    {
        alert("EL campo Apellido Materno es obligatorio");
        form.amaterno.focus();
        return false;
    }
    if ((presidencia != '') && (op3 == 1))
    {
        if ((validar_nom(presidencia, 'Pais de residencia', form)) == true)
        {
            op4 = 1;
        } else
        {
            return false
        }
    } else
    {
        alert("EL campo Paï¿½s de residencia es obligatorio");
        form.presidencia.focus();
        return false;
    }

    if ((profocu != '') && (op4 == 1))
    {
        if ((validar_nom(profocu, 'Profesiï¿½n u ocupaciï¿½n', form)) == true)
        {
            op5 = 1;
        } else
        {
            return false
        }
    } else
    {
        alert("EL campo Profesiï¿½n u ocupaciï¿½n es obligatorio");
        form.profocu.focus();
        return false;
    }
    //por lo menos unode los tres
    if ((ulcolegio != '') && (op5 == 1))
    {
        //alert(ulcolegio);
        ultimo = parseInt(ulcolegio);//ultimo=ultimo+1;alert(ultimo);
        if ((validar_numero(ulcolegio, 'ï¿½ltimo aï¿½o en el colegio', form)) == true)
        {
            if (((ultimo >= 1977) && (ultimo <= 1989)))
            {
                op6 = 1;
            } else
            {
                alert('El aï¿½o que introdujo en el campo : ï¿½ltimo aï¿½o en el colegio, se encuentra fuera de rango.');
                form.ulcolegio.focus();
                return false
            }
        } else
        {
            return false
        }
    } else
    {
        alert("EL campo ï¿½ltimo aï¿½o en el colegio es obligatorio");
        form.ulcolegio.focus();
        return false;
    }
    //cambios 

    if ((email != '') && (op6 == 1))
    {
        n = email.length;
        ca = 0;
        cp = 0;
        i = n;
        sw = 0; //alert(i);
        while ((i > 0) && (sw == 0))
        {
            e = email.charAt(i);	//alert(e);		
            if (e == "@")
            {
                sw = 1;
            }
            if (e == ".")
            {
                cp = cp + 1;
            }
            i = i - 1;
        }
        i = i + 1;
        if (((cp >= 1) && (cp <= 2)) && (i > 0))
        {
            while (i > 0)
            {
                e = email.charAt(i);
                if (e == "@")
                {
                    ca = ca + 1;
                }
                i = i - 1;
            }
            if ((ca == 1) && (op6 == 1))
            {
                //return true;	
                op7 = 1;
            }
        } else
        {
            alert("Debe escribir el correo electrï¿½nico de manera correcta. \nEjemplo:  sunombre@tutos89.com ");
            form.email.focus();
            return false;
        }
    } else
    {
        alert("EL campo Correo electrï¿½nico es obligatorio");
        form.email.focus();
        return false;
    }


    if ((telefono != ''))
    {

        if (((validar_numero(telefono, 'Telï¿½fono', form)) == true) && (op7 == 1))
        {
            op8 = 1;
        } else
        {
            return false
        }
    } else
    {
        if ((telefono == ''))
        {
            cv = cv + 1;
        }
        //alert("tewlefono")}	
        //alert("EL campo Telï¿½fono es obligatorio");
        //form.telefono.focus();
        //return false;
    }
    if ((celular != ''))
    {
        if (((validar_numero(celular, 'Celular', form)) == true) && (op7 == 1))
        {
            op8 = 1;
        } else
        {
            return false
        }
    } else
    {
        if (cv == 1)
        {//alert("EL campo E-mail es obligatorio");
            alert("Debe llenar al menos uno de los siguientes campos: \n Telï¿½fono - Celular ");
            form.telefono.focus();
            return false;
        } else
        {  //return true;	
            op8 = 1;
        }
    }

    /*
     if((email!=''))
     {   
     n=email.length; ca=0;cp=0; i=n;sw=0; //alert(i);
     while((i>0)&&(sw==0))
     {
     e=email.charAt(i);	//alert(e);		
     if(e=="@")
     { sw=1;}
     if(e==".")
     { cp=cp+1;}		
     i=i-1;	
     }
     i=i+1;
     if (((cp>=1)&&(cp<=2))&&(i>0))
     {   
     while(i>0)
     {
     e=email.charAt(i);
     if(e=="@")
     { ca=ca+1;}
     i=i-1;
     }
     if((ca==1)&&(op6==1))
     {
     //return true;	
     op7=1;
     }
     }			
     else
     {	alert("Debe escribir el correo electrï¿½nico de manera correcta. \nEjemplo:  sunombre@tutos89.com ");
     form.email.focus();return false;			
     }	
     }
     else
     { 
     //alert(cv)
     if(cv==2)   
     {//alert("EL campo E-mail es obligatorio");
     alert("Debe llenar por lo menos uno de los siguientes campos: \n Telï¿½fono - Celular - Correo Electrï¿½nico");
     form.telefono.focus();
     return false;
     }
     else
     {  //return true;	
     op7=1;
     }
     
     }
     */
    if ((user != '') && (op8 == 1))
    {
        /*
         if(((validar_numero(celular,'Celular',form))==true)&&(op6==1))
         { op7=1;}
         else
         {return false}
         */
        op9 = 1;
    } else
    {
        alert("Debe introducir un nombre de usuario");
        form.user.focus();
        return false;

    }
    if ((pass != '') && (op9 == 1))
    {
        return true;
    } else
    {
        alert("Debe introducir su contraseï¿½a");
        form.pass.focus();
        return false;

    }

    return false
}


function validar_nom(nom, mostrar, form)
{
    //var checkOK = ".,ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½1234567890-_.";
    /*
     var checkOK = ".,ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½1234567890-_.+*{}/!ï¿½$%&()=?ï¿½#;:@";
     */
    var checkOK = ".,ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½1234567890-_.+*{}/!ï¿½$%&()=?ï¿½#;:@";

    var checkStr = nom;//form1.asunto.value;
    //var todobien = true;
    //alert ("NO ENTRA");
    sw = 0;
    cb = 0;
    nnom = nom.length; //alert(nnom);
    sw1 = 0;
    i = 0;
    while ((i < nom.length) && (sw1 == 0))
    {
        ch = nom.charAt(i);
        a = parseInt(ch);
        //if((a>=0)&&(a<=9))
        //{todobien = false; }

        //alert (ch) 
        j = 0;
        sw = 0;
        while ((j < checkOK.length) && (sw == 0))
        { 	//alert(checkOK.charAt(j));
            car = checkOK.charAt(j); //alert(car);
            if (ch == checkOK.charAt(j))
            {
                sw = 1; //alert("son iguales")
            }
            j = j + 1;
            ;
        }
        if (sw == 0)
        {
            cb = cb + 1;
        } else {
            sw1 = 1;
        }
        i = i + 1;
    }
    if (!((i == nom.length) && (sw1 == 0)))
    {
        alert("Debe escribir solo caracteres aceptados en el campo " + mostrar + "");
        switch (mostrar)
        {
            case 'Nombres':
                form.nombres.focus();
                break;
            case 'Apellido paterno':
                form.apaterno.focus();
                break;
            case 'Apellido materno':
                form.amaterno.focus();
                break;
            case 'Pais de residencia':
                form.presidencia.focus();
                break;
            case 'Profesiï¿½n u ocupaciï¿½n':
                form.profocu.focus();
                break;
        }
        return false;
    } else
    {
        return true;
    }
    //return false;			
}

/*
 function validar_nom(nom,mostrar,form)
 {
 var checkOK = ".,ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½1234567890-_. ";
 //var checkStr = nom;//form1.asunto.value;
 var todobien = true;
 lonnom=nom.length; alert(lonnom);
 for (i = 0;  i < nom.length;  i++)
 {
 ch = nom.charAt(i); a=parseInt(ch);
 if((a>=0)&&(a<=9))
 {todobien = false; }
 
 for (j = 0;  j < checkOK.length;  j++)
 if (ch == checkOK.charAt(j))
 break;
 
 if (j == checkOK.length)
 {
 todobien = false;
 break;
 }
 }
 if (todobien==false)
 {
 alert("Debe escribir solo caracteres aceptados en el campo "+mostrar+"");
 switch (mostrar) 
 {
 case 'Nombres': form.nombres.focus(); 	break;
 case 'Apellido paterno': form.apaterno.focus(); 	break;
 case 'Apellido materno': form.amaterno.focus();	break;
 case 'Pais de residencia': form.presiencia.focus();	break;
 case 'Profesiï¿½n u Ocupaciï¿½n': form.profocu.focus();	break;					
 }		
 return (false);
 }
 else
 {		return true;  }
 //return false;			
 }
 
 */

function validar_numero(num, mostrar, form)
{
    sw = 0;
    j = 0;
    i = num.length;
    //alert('yyyyyyyyyyyyyyyyyyyy');	
    while ((sw == 0) && (j < i))
    {
        e = num.charAt(j);
        a = parseInt(e);
        j++;
        if (!((a >= 0) && (a <= 9)))
        {
            sw = 1;//alert('si');
        }
    }
    if (sw == 0)
    {
        return true
    } else
    {
        alert('Debe escribir solo nï¿½meros en el campo ' + mostrar + '');
        switch (mostrar)
        {
            case 'Telï¿½fono':
                form.telefono.focus();
                break;
            case 'Celular':
                form.celular.focus();
                break;
            case 'ï¿½ltimo aï¿½o en el colegio':
                form.ulcolegio.focus();
                break;
        }
        return false
    }
}

function validar_acole(a, mostrar, form)
{
    if (!((a >= 1977) && (a <= 1989)))
    {
        alert('El aï¿½o que introdujo en el campo: ' + mostrar + ', es incorrecto');
        form.ulcolegio.focus();
        return false
    } else
    {
        return true
    }
}


function validarpass(formulario)
{
    var passnu, passnu2;
    passnu = formulario.passnu.value;
    passnu2 = formulario.passnu2.value;

    if (passnu != passnu2)
    {
        alert('Las contraseï¿½as no coinciden');
        //formulario.passnu.focus();
        return false;
    } else
    {
        return true;
    }
    return false;
}
function dev_arreglo(archivo)
{
    alert(tabla[1]);
    alert(elem[1]);
    alert(idu[1]);

}
function validarf(formulario)
{
    var cliente, codigo, direccion, telefono;
    nombres = formulario.nombres.value;
    apaterno = formulario.apaterno.value;
    amaterno = formulario.amaterno.value;
    dia = formulario.dia.value;
    mes = formulario.mes.value;
    presidencia = formulario.presidencia.value;
    ciudad = formulario.ciudad.value;
    profocu = formulario.profocu.value;
    lutrabajo = formulario.lutrabajo.value;
    telefono = formulario.telefono.value;
    celular = formulario.celular.value;
    email = formulario.email.value;
    ulcolegio = formulario.ulcolegio.value;
    user = formulario.user.value;
    pass = formulario.pass.value;

    val1 = 0;
    bien = 1;

    /*
     alert(""+nombres+""+apaterno+""+amaterno+""+presidencia+""+profocu+""+telefono+""+celular+""+email+""+ulcolegio+""+user+""+pass+"");
     */


    vv = validar_vacios(nombres, apaterno, amaterno, presidencia, profocu, telefono, celular, email, ulcolegio, user, pass, formulario);

    vv2 = validar_nom(ciudad, 'Ciudad');

    if (ciudad != '')
    {
        if (vv2 == true)
        {
            bien = 1;
        } else
        {
            alert("Debe escribir solo caracteres aceptados en el campo " + ciudad + "");
            formulario.ciudad.focus();
            return false;
        }
    }

    if (vv == true)
    {
        return true
    } else
    {
        return false
    }

    return false;
}
/*
 function LimitAttach(tField,iType)
 {
 file=tField.value;
 if (iType==1) 
 {
 extArray = new Array(".jpg",".gif",".png");
 }
 if (iType==2) 
 {
 extArray = new Array(".doc",".xls",".rar",".zip",".ppt",".txt",".pdf");
 }
 allowSubmit = false;
 if (!file) return;
 while (file.indexOf("\\") != -1) file = file.slice(file.indexOf("\\") + 1);
 ext = file.slice(file.indexOf(".")).toLowerCase();
 for (var i = 0; i < extArray.length; i++) {
 if (extArray[i] == ext) 
 {
 allowSubmit = true;
 break;
 }
 }
 if (!allowSubmit)
 {
 if (iType==1) 
 {
 alert("Solo puede subir imï¿½genes con las siguientes extensiones \n" + (extArray.join(" ")) + "\nPor favor, seleccione otro archivo");
 }
 if (iType==2) 
 {
 alert("Solo puede subir archivos con las siguientes extensiones \n" + (extArray.join(" ")) + "\nPor favor, seleccione otro archivo");
 }
 
 
 
 }
 }*/



//codigo fernando
//Solo numeros
function Numeros(string) {
    var out = '';
    var filtro = '1234567890';//Caracteres validos

    //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
    for (var i = 0; i < string.length; i++)
        if (filtro.indexOf(string.charAt(i)) != -1)
            //Se aï¿½aden a la salida los caracteres validos
            out += string.charAt(i);

    //Retornar valor filtrado
    return out;
}

$(document).ready(function () {
    var ruta = window.location.origin;
    ruta = ruta + $('.rutabase').html();
    $('.radioExperiencia').change(function () {
        var valor = $(this).val();
        if (valor == 'no')
        {
            $('#experiencia_sup_no').css('display', 'block');
            $('#experiencia_sup').css('display', 'none');
        }
        if (valor == 'si')
        {
            $('#experiencia_sup').css('display', 'block');
            $('#experiencia_sup_no').css('display', 'none');
        }
    });

    $('.select_pais').change(function () {
        var id = $(this).val();
        if (id == 1)
        {
//            para remover la opcion seleccionada en ciudades
            $('.select_ciudad option:selected').removeAttr('selected');
//            para mostrar las ciudades
            $('.contenedor_ciudades').show();
//            para ocultar el campo de texto de ciudad cuando es distinto de 1=Bolivia
            $('.otro_pais_ciudad').hide();
//            $('.contenedor_ciudades').show('slow');
        } else {
//            para ocultar todo el contenedor de ciudades incluyendo el label y el select
//             cuando es distinto de 1=Bolivia
            $('.contenedor_ciudades').hide();
//            para mostrar el campo de texto de ciudad cuando es distinto de 1=Bolivia            
            $('.otro_pais_ciudad').show();
//            $('.contenedor_ciudades').hide('slow');
        }
    });
    $('.select_ciudad').change(function () {
        var id = $(this).val();
        if (id == 85 || id == 92 || id == 119 || id == 125 || id == 127 || id == 133 || id == 142 || id == 149 || id == 155)
        {
            $('.otra_ciudad').show();
        } else {
            $('.otra_ciudad').hide();
        }
    });
    $('.combo_disponibilidad').change(function () {
        var ruta = window.location.origin;
        ruta = ruta + $('.rutabase').html();
        var idestado = $(this).val();
        var id = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: ruta + "postulante/cambiarEstado/id/" + id,
            data: {idestado: idestado},
            beforeSend: function () {
            },
            success: function (data) {
                if (data == true)
                {
                    $('.alerta').addClass('alerta-correcta');
                    $('.alerta').text("La disponibilidad fue correctamente actualizado");
                    setTimeout(function () {
                        $('.alerta').removeClass('alerta-correcta');
                        $('.alerta').text("");
                        location.reload();
                    }, 1000);
                } else
                {
                    $('.alerta').addClass('alerta-incorrecta');
                    $('.alerta').text("La disponibilidad no fue actualizado");
                    setTimeout(function () {
                        $('.alerta').removeClass('alerta-incorrecta');
                        $('.alerta').text("");
                        location.reload();
                    }, 1000);
                }
            }
        });
//        cambiarEstado
    });
    $('.disponibilidad_privado').change(function () {
        var ruta = window.location.origin;
        ruta = ruta + $('.rutabase').html();
        var idestado = $(this).val();
        var id = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: ruta + "postulante/cambiarEstado/id/" + id,
            data: {idestado: idestado},
            beforeSend: function () {
            },
            success: function (data) {
                if (data == true)
                {
                    $('.alerta' + id).addClass('alerta-correcta');
                    $('.alerta' + id).text("La disponibilidad fue correctamente actualizado");
                    setTimeout(function () {
                        $('.alerta' + id).removeClass('alerta-correcta');
                        $('.alerta' + id).text("");
                    }, 5000);
                } else
                {
                    $('.alerta' + id).addClass('alerta-incorrecta');
                    $('.alerta' + id).text("La disponibilidad no fue actualizado");
                    setTimeout(function () {
                        $('.alerta' + id).removeClass('alerta-incorrecta');
                        $('.alerta' + id).text("");
                    }, 5000);
                }
            }
        });
//        cambiarEstado
    });
    $('.select_profesion').change(function () {
        var id = $(this).val();

        $('#edu_area_otro').val("");
        if (id == 65)
        {
            $('.otra_profesion').show();
        } else {
            $('.otra_profesion').hide();
        }
    });
    $('.select_idioma').change(function () {
        var id = $(this).val();
        if (id == 223)
        {
            $('#poi_idioma_otro').val("");
            $('.otro_idioma').show();
        } else {
            $('#poi_idioma_otro').val("");
            $('.otro_idioma').hide();
        }
    });
});

//para poder exportar una tabla de html a excel
$(document).ready(function () {
    $(".botonExcel").click(function (event) {
//        console.info("ingresando");
        window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dvData').html()));
        e.preventDefault();
//        $("#datos_a_enviar").val($("<div>").append($("#resultadoTabla").eq(0).clone()).html());
//        $("#FormularioExportacion").submit();
//        console.info("exportando");
//        document.formuexcel.submit()
    });
    $("#busquedaExhaustiva").click(function () {
        var tipo = $('#tipo').val();
        var string = $('#stringBusqueda').val();
        if (tipo != "" && string != "" && string != " ")
        {
            document.fomularioBusqueda.submit()
        }
    });
    $("#tipo").change(function () {
        if ($(this).val() == "")
        {
            document.getElementById("stringBusqueda").disabled = true;
            document.getElementById("busquedaExhaustiva").disabled = true;
        } else {
            document.getElementById("stringBusqueda").disabled = false;
            document.getElementById("busquedaExhaustiva").disabled = false;
        }
    });
});
//function exportarExcel() {
var tableToExcel = (function () {
    var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="text/html; charset=utf-8" /><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
            , base64 = function (s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            }
    , format = function (s, c) {
        return s.replace(/{(\w+)}/g, function (m, p) {
            return c[p];
        })
    }
    return function (table, name) {
        if (!table.nodeType)
            table = document.getElementById(table)
        var ctx = {worksheet: "mitabla" || 'Worksheet', table: table.innerHTML}
        window.location.href = uri + base64(format(template, ctx))
    }
})();
var tableToExcel2 = (function () {
    var uri = 'data:application/vnd.ms-excel;base64,'
            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
//            , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="text/html; charset=utf-8" /><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
            , base64 = function (s) {
                return window.btoa(unescape(encodeURIComponent(s)))
            }
    , format = function (s, c) {
        return s.replace(/{(\w+)}/g, function (m, p) {
            return c[p];
        })
    }
    return function (table, name, fileName) {
        if (!table.nodeType)
            table = document.getElementById(table)
        var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}

        var link = document.createElement("A");
        link.href = uri + base64(format(template, ctx));
        link.download = fileName + obtenerFecha() + '.xls' || 'Workbook.xls';
        link.target = '_blank';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
})();

function obtenerFecha() {
    var f = new Date();
    var dia = f.getDate();
    if (dia.length = 1)
    {
        dia = '0' + dia;
    }
    return "_" + dia + "" + (f.getMonth() + 1) + "" + f.getFullYear();
}

$(document).ready(function () {
    $("#catCargo").change(function () {
        var idCargo = $(this).val();
        if (idCargo != "" && idCargo != 209)
        {
            var ruta = $('.rutabase').val();
            $.ajax({
                type: "post",
                url: ruta,
                data: {id: idCargo},
                beforeSend: function () {
                },
                success: function (data) {
                    $('.contenedor-cargos').html("<select name='sub_cargo_id' class='subCargos'></select>");
                    $('.subCargos').html(data);
                }
            });
        } else if (idCargo == 209) {

            $('.contenedor-cargos').html("<label>Cargo: </label> <input class='input1' name='con_otro_cargo' value='' onkeyup='mayuscula(this);' size='50'/><br/><b>Nota:</b> favor de escribir el cargo y unidad para futuros filtros.");
//            $('.notaCargoOtro').html('Nota: favor de escribir el cargo y unidad para futuros filtros')
        } else {
            $('.contenedor-cargos').html("");
        }
    });
});

//para abrir una ventana
var ventanaBusqueda;
function abrirVentana(url) {
// definimos la anchura y altura de la ventana
    var altura = 400;
    var anchura = 800;
// calculamos la posicion x e y para centrar la ventana
    var y = parseInt((window.screen.height / 2) - (altura / 2));
    var x = parseInt((window.screen.width / 2) - (anchura / 2));
    if (typeof (ventanaBusqueda) != 'undefined')
    {
        ventanaBusqueda.close();
    }
// mostramos la ventana centrada
    ventanaBusqueda = window.open(url, target = 'blank', 'width=' + anchura + ',height=' + altura + ',top=' + y + ',left=' + x + ',toolbar=no,location=no,status=no,menubar=no,directories=no,resizable=no', 'popup');
//    window.open(url, target = 'blank', 'width=' + anchura + ',height=' + altura + ',top=' + y + ',left=' + x + ',toolbar=no,location=no,status=no,menubar=no,scrollbars=no,directories=no,resizable=no');
}

function mayuscula(e) {
    e.value = e.value.toUpperCase();
}


$(document).ready(function () {
    $('.descargaCV').click(function () {
        location.href = $(this).attr('data-url');
    });
//    canbiar nombre del label
    $(".custom-file-input").change(function () {

        var fileName = this.files[0].name;
        var fileSize = this.files[0].size;
        if (fileSize > 2000000) {
            alert('El archivo no debe superar los 2MB');
            this.value = '';
//                    this.files[0].name = '';
        }
        // recuperamos la extensión del archivo
        var ext = fileName.split('.').pop();
        switch (ext) {
            case 'pdf':
            case 'doc':
            case 'docx':
                break;
            default:
                alert('El archivo no tiene la extensión adecuada');
                this.value = ''; // reset del valor
//                            this.files[0].name = '';
        }

        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

    });

//para mostrar el modal
    $(".cv-temporal-modal").click(function () {
        $("#modal-cv-temporal").modal();
    })

    $('.cv-temporal').click(function () {
//        alert($(this).attr('data-url'));
        var errorContador = 0;
        var errorSalario = 0;
        var salario = $('#pof_salario').val();
        var disponibilidad = $('#pof_disponibilidad').val();
        var contador = $('#contador').val();

        if (salario == ' ' || salario == 0)
        {
            errorSalario = '<p>Debe introducir el Pretensión salarial</p>';
        }
//        if (disponibilidad <= 0)
//        {
//            console.info('Debe introducir el Pretensión salarial');
//        } else {
//            console.info('Pretensión salarial: ' + salario);
//        }
        if (contador <= 0)
        {
            errorContador = '<p>Debe seleccionar un Cómo se enteró de está postulación</p>';
        }

        if (errorSalario != false || errorContador != false)
        {
            if (errorSalario != false) {
                $('.error').html('');
                $('.error-salario').addClass('errorcv');
                $('.error-salario').html(errorSalario);
            } else {
                $('.error-salario').html('');
            }
            if (errorContador != false) {
                $('.error').html('');
                $('.error-contador').addClass('errorcv');
                $('.error-contador').html(errorContador);
            } else {
                $('.error-contador').html('');
            }
        } else {
            var ruta = $(this).attr('data-url');
            $.ajax({
                type: "post",
                url: ruta,
                data: {salario: salario, disponibilidad: disponibilidad, contador: contador},
                beforeSend: function () {
                },
                success: function (data) {
                    if (data == 1)
                    {
                        location.href = ruta;
                    }

                }
            });
        }
    });
    $('.cv-temporale').click(function () {
        var errorContador = 0;
        var errorSalario = 0;
        var salario = $('#pof_salario').val();
        var disponibilidad = $('#pof_disponibilidad').val();
        var contador = $('#contador').val();
        if (salario == ' ' || salario == '')
        {
            errorSalario = '<p>Debe introducir el Pretensión salarial</p>';
        }
//        if (disponibilidad <= 0)
//        {
//            console.info('Debe introducir el Pretensión salarial');
//        } else {
//            console.info('Pretensión salarial: ' + salario);
//        }
        if (contador <= 0)
        {
            errorContador = '<p>Debe seleccionar un Cómo se enteró de está postulación</p>';
        }

        if (errorSalario != false || errorContador != false)
        {
            if (errorSalario != false) {
                $('.error').html('');
                $('.error-salario').addClass('errorcv');
                $('.error-salario').html(errorSalario);
            } else {
                $('.error-salario').html('');
            }
            if (errorContador != false) {
                $('.error').html('');
                $('.error-contador').addClass('errorcv');
                $('.error-contador').html(errorContador);
            } else {
                $('.error-contador').html('');
            }
        } else {

            var ruta = $(this).attr('data-url');
            $.ajax({
                type: "post",
                url: ruta,
                data: {salario: salario, disponibilidad: disponibilidad, contador: contador},
                beforeSend: function () {
                },
                success: function (data) {
                    if (data == 1)
                    {
                        location.href = ruta;
                    }
//                    else
//                    {
//                        var valor = confirm(mensaje);
//                        if (valor == 1)
//                        {
//                            window.location.href = rutaEliminar;
//                        }
//
//                    }
                }
            });
        }


//        location.href = $(this).attr('data-url');
    });
});
function Mayusculas(obj, id) {
    obj = obj.toUpperCase();
    document.getElementById(id).value = obj;
}

