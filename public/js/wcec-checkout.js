$(document).on("change","#document_number", function(e) {
    let tipo = $("input[name='document_type']:checked").val();
    if (tipo == 0) {
        if (!validarcedula($(this).val())) {
            window.setTimeout(function() { $("#document_number").focus(); }, 500);
        }
    }
    if (tipo == 1) {
        if (!validaruc($(this).val())) {
            window.setTimeout(function() { $("#document_number").focus(); }, 500);
        }
    }
    return true;
});

(function( $ ) {
    'use strict';

    $(document).ready(function(){
        $("#document_number").attr({ type: "number", pattern: "[0-9]\d*", inputmode: "numeric" });
    });

    $(document).on("change", "input[name='document_type']", function(){
        let tipo = $("input[name='document_type']:checked").val();
        if (tipo == 'C' || tipo == 'R') {
            $("#document_number").attr({ type: "number", pattern: "[0-9]\d*", inputmode: "numeric" });
            if (tipo == 'C') {
                    $("label[for=document_number]").html("Cédula");
            } else {
                $("label[for=document_number]").html("RUC");
            }
        } else if (tipo == 'P') {
            $("#document_number").attr("type', 'text");
            $("#document_number").removeAttr("pattern");
            $("#document_number").removeAttr("inputmode");
            if (document.documentElement.lang === "es") {
                $("label[for=document_number]").html("Pasaporte");
            } else {
                $("label[for=document_number]").html("Passport");
            }
        }
        $("label[for=document_number]").append("<abbr class='required' title='obligatorio'>*</abbr>");
    });

    $(document).on("change","#document_number", function(e) {
        let tipo = $("input[name='document_type']:checked").val();
        if (tipo == 0) {
            if (!validarcedula($(this).val())) {
                window.setTimeout(function() { $("#document_number").focus(); }, 500);
            }
        }
        if (tipo == 1) {
            if (!validaruc($(this).val())) {
                window.setTimeout(function() { $("#document_number").focus(); }, 500);
            }
        }
        return true;
    });

})( jQuery );

function validarcedula(ced) {
    var i;
    var cedula = ced;
    nif_valido = 1;
    if (cedula.length != 10) {
        alert("Se esperan 10 números.");
        $("#document_number").val("");
        nif_valido = 0;
        return false;
    }
    var acumulado;
    var instancia;
    acumulado = 0;
    for (i = 1; i <= 9; i++) {
        if (i % 2 != 0) {
            instancia = cedula.substring(i - 1, i) * 2;
            if (instancia > 9) instancia -= 9;
        } else instancia = cedula.substring(i - 1, i);
        acumulado += parseInt(instancia);
    }
    while (acumulado > 0)
        acumulado -= 10;
    if (cedula.substring(9, 10) != (acumulado * -1)) {
        alert("La cédula ingresada no es correcta.");
        $("#document_number").val("");
        nif_valido = 0;
        return false;
    }

    return true;
}

function validaruc(ruc){
    var suma = 0;
    var residuo = 0;
    var pri = false;
    var pub = false;
    var nat = false;
    var cedulaProvincias = 24;
    var modulo = 11;
    var p1 = 0, p2 = 0, p3 = 0, p4 = 0, p5 = 0, p6 = 0, p7 = 0, p8 = 0, p9 = 0;

		
		// Verificar la longitud mínima, máxima y promedio para comparación
		if (ruc.length < 10) {
			alert ("La longitud del Ruc ingresado no es válido");
		} else if ((ruc.length > 10 && ruc.length < 13) || ruc.length > 13) {
			alert ("La longitud del Ruc ingresado no es válido"); 
		}
		/* Verificar que la provincia exista */
		if (ruc.substring(0, 2) > cedulaProvincias) {
			alert ("Los dos primeros digitos estan incorrectos.");
		}

		/* Aqui almacenamos los digitos de la cedula en variables. */
		var d1 = ruc.substring(0, 1);
		var d2 = ruc.substring(1, 2);
		var d3 = ruc.substring(2, 3);
		var d4 = ruc.substring(3, 4);
		var d5 = ruc.substring(4, 5);
		var d6 = ruc.substring(5, 6);
		var d7 = ruc.substring(6, 7);
		var d8 = ruc.substring(7, 8);
		var d9 = ruc.substring(8, 9);
		var d10 = ruc.substring(9, 10);

		/* El tercer digito es: */
		/* 9 para sociedades privadas y extranjeros */
		/* 6 para sociedades publicas */
		/* menor que 6 (0,1,2,3,4,5) para personas naturales */
		if (d3 == 7 || d3 == 8) {
			alert ("El tercer dígito ingresado es inválido.");
		}
		/* Solo para personas naturales (modulo 10) */
		if (d3 < 6) {
			nat = true;
			p1 = d1 * 2;
			if (p1 >= 10) p1 -= 9; p2 = d2 * 1;
			if (p2 >= 10) p2 -= 9; p3 = d3 * 2;
			if (p3 >= 10) p3 -= 9; p4 = d4 * 1;
			if (p4 >= 10) p4 -= 9; p5 = d5 * 2;
			if (p5 >= 10) p5 -= 9; p6 = d6 * 1;
			if (p6 >= 10) p6 -= 9; p7 = d7 * 2;
			if (p7 >= 10) p7 -= 9; p8 = d8 * 1;
			if (p8 >= 10) p8 -= 9; p9 = d9 * 2;
			if (p9 >= 10) p9 -= 9; modulo = 10;
		} /*
			 * Solo para sociedades publicas (modulo 11) Aqui el digito
			 * verficador esta en la posicion 9, en las otras 2 en la pos. 10
			 */
		else if (d3 == 6) {
			pub = true;
			p1 = d1 * 3;
			p2 = d2 * 2;
			p3 = d3 * 7;
			p4 = d4 * 6;
			p5 = d5 * 5;
			p6 = d6 * 4;
			p7 = d7 * 3;
			p8 = d8 * 2;
			p9 = 0;
		} /* Solo para entidades privadas (modulo 11) */
		else if (d3 == 9) {
			pri = true;
			p1 = d1 * 4;
			p2 = d2 * 3;
			p3 = d3 * 2;
			p4 = d4 * 7;
			p5 = d5 * 6;
			p6 = d6 * 5;
			p7 = d7 * 4;
			p8 = d8 * 3;
			p9 = d9 * 2;
		}
		suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;
		residuo = suma % modulo;
		/* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo */
		var digitoVerificador = residuo == 0 ? 0 : modulo - residuo;
		/* ahora comparamos el elemento de la posicion 10 con el dig. ver. */
		if (pub == true) {
			if (digitoVerificador != d9 || ruc.substring(9,ruc.length)!=0001) {
                alert ("El ruc ingresado es incorrecto.");
                $("#document_number").val("");
			}
			/* El ruc de las empresas del sector publico terminan con 0001 */
			
		} else if (pri == true) { 
			if (digitoVerificador != d10 || ruc.substring(10,ruc.length)!=001) {
                alert ("El ruc ingresado es incorrecto.");
                $("#document_number").val("");
			}
		} else if (nat == true) { 
			if (digitoVerificador != d10) {
                alert ("El ruc ingresado es incorrecto.");
                $("#document_number").val("");
			}
			if (ruc.length > 10) {
                while(ruc.substring(10,ruc.length)!=001){
                    alert('El RUC ingresado no es válido, debe terminar en 001');
                    $("#document_number").val("");
                    return;
                }
			}
                  
        }
}



