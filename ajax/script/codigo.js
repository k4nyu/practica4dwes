$(document).ready( function () {
    cargarPagina(0);
    var paginaGlobal = 0;
    
    function  cargarPagina(pagina){
        paginaGlobal = pagina;
        $.ajax({
            url: "ajaxselect.php?pagina="+pagina,
            success: function (result){
                destruirTabla();
                mostrarTabla(result);
                asignarEventos();
            },
            error: function () {
                toastr.error(' ', 'Error');
            }
        });
    }
    
    function mostrarTabla(datos) {
        var tabla = document.createElement("table");
        var tr, td;
        for (var i = 0; i < datos.plato.length; i++) {
            if (i === 0) {
                tr = document.createElement("tr");
                for (var j in datos.plato[i]) {
                    td = document.createElement("th");
                    td.textContent = j;
                    tr.appendChild(td);
                }
                td = document.createElement("th");
                td.textContent = "Opciones";
                tr.appendChild(td);
                tabla.appendChild(tr);
            }
            tr = document.createElement("tr");
            for (var j in datos.plato[i]) {
                td = document.createElement("td");
                td.textContent = datos.plato[i][j];
                tr.appendChild(td); 
            }
            td = document.createElement("td");
            var enlaces = "<a  class='enlace_ver_fotos' data-ver='" + datos.plato[i].idplato + "'><input type='button'  value='Ver Fotos'></a>"+
            "<a  class='enlace_editar' data-editar='" + datos.plato[i].idplato + "'><input type='button'  value='Editar'></a>"
            +"<a  class='enlace_borrar' data-nombre='"+datos.plato[i].nombre+"' data-borrar='" + datos.plato[i].idplato + "'><input type='button' value='Eliminar'></a>";
            td.innerHTML = enlaces;
            tr.appendChild(td);
            tabla.appendChild(tr);
        }
        
        /*paginacion*/
        tr = document.createElement("tr");
        td = document.createElement("th");
        td.setAttribute("colspan", 10);
        var contenido ="";
        contenido += "<nav><ul class='pagination'><li><a class='enlace' data-href='" + datos.paginas.inicio + "'>&lt;&lt;</a></li> ";
        contenido += "<li><a class='enlace' data-href='" + datos.paginas.anterior + "'>&lt;</a> ";
        if (datos.paginas.primero !== -1)
            contenido += "<li><a  class='enlace' data-href='" + datos.paginas.primero + "'>" + (parseInt(datos.paginas.primero) + 1) + "</a></li> ";
        if (datos.paginas.segundo !== -1)
            contenido += "<li><a  class='enlace' data-href='" + datos.paginas.segundo + "'>" + (parseInt(datos.paginas.segundo) + 1) + "</a></li> ";
        if (datos.paginas.actual !== -1)
            contenido += "<li class='active'><a  class='enlace' data-href='" + datos.paginas.actual + "'>" + (parseInt(datos.paginas.actual) + 1) + "</a></li> ";
        if (datos.paginas.cuarto !== -1)
           contenido += "<li><a  class='enlace' data-href='" + datos.paginas.cuarto + "'>" + (parseInt(datos.paginas.cuarto) + 1) + "</a></li> ";
        if (datos.paginas.quinto !== -1)
            contenido += "<li><a  class='enlace' data-href='" + datos.paginas.quinto + "'>" + (parseInt(datos.paginas.quinto) + 1) + "</a></li> ";
        contenido += "<li><a  class='enlace' data-href='" + datos.paginas.siguiente + "'>&gt;</a></li> ";
        contenido += "<li><a  class='enlace' data-href='" + datos.paginas.ultimo + "'>&gt;&gt;</a></li></ul></nav> ";
        td.innerHTML = contenido;
        tr.appendChild(td);
        tabla.appendChild(tr);
        var div = document.getElementById("divajax");
        div.appendChild(tabla);
    }
    
    function destruirTabla() {
        var div = document.getElementById("divajax");
        div.innerHTML = "";
    }
    
    function asignarEventos(){
        $('#insertar').on("click", insertarPlato);
        var enlaces = document.getElementsByClassName("enlace");
        for (var i = 0; i < enlaces.length; i++)
            agregarEventoPaginar(enlaces[i]);
        enlaces = document.getElementsByClassName("enlace_ver_fotos");
        for (var i = 0; i < enlaces.length; i++)
            agregarEventoVerFotos(enlaces[i]);
        enlaces = document.getElementsByClassName("enlace_borrar");
        for (var i = 0; i < enlaces.length; i++)
            agregarEventoBorrar(enlaces[i]);
        enlaces = document.getElementsByClassName("enlace_editar");
        for (var i = 0; i < enlaces.length; i++)
            agregarEventoEditar(enlaces[i]);
    }
    
    function agregarEventoEditar(elemento){
        elemento.onclick = function(e){
            editarPlato(elemento);
        }
    }
    
    function agregarEventoVerFotos(elemento) {
        elemento.onclick = function (e) {
            verFotos(elemento);
        };
    }
    
    function agregarEventoBorrar(elemento) {
        var databorrar = elemento.getAttribute("data-borrar");
        var datanombre = elemento.getAttribute("data-nombre");
        elemento.onclick = function () {
            confirmarBorrar(datanombre, databorrar);
        };
    }
    
    function confirmarBorrar(datanombre, databorrar){
        $('#modalBorrar').modal('show');
        document.getElementById("nombreABorrar").textContent = "Vas a borrar: "+datanombre;
        var eliminar = document.getElementById("eliminarPlato");
        eliminar.onclick = function(){
            $.ajax({
               url: "ajaxdelete.php?id="+databorrar,
               success: function(result){
                   if(result.respuesta > 0)
                       toastr.success('Plato eliminado correctamente', 'Exito');
                   else
                       toastr.warning('Error al borrar el plato. ', 'Error');
               },
               error: function(){
                   toastr.error(' ', 'Error');
               }
            });
            $("#modalBorrar").modal('hide');
            cargarPagina(paginaGlobal);
        }
    }
    
    function agregarEventoPaginar(elemento) {
        var datahref = elemento.getAttribute("data-href");
        elemento.onclick = function (e) {
            paginaGlobal = datahref;
            cargarPagina(datahref)
        };
    }
    
    function verFotos(elemento){
        var dataid = elemento.getAttribute("data-ver");
        var modalfotos = $("#modalFotos");
        modalfotos.modal('show');
        document.getElementById("fotos").innerHTML = "";
        $.ajax({
            url: "ajaxverfotos.php?idplato="+dataid,
            success: function(result){
                var divfotos = $("#fotos");
                for(var i = 0; i< result.fotos.length; i++){
                    divfotos.append('<img src="../fotos/'+result.fotos[i].url+'" width="300px">');
                    var botonBorrar = document.createElement("button");
                    botonBorrar.setAttribute("data-idfoto", result.fotos[i].idfoto);
                    botonBorrar.textContent =  "Borrar";
                    botonBorrar.onclick = function(){
                        var idfoto = this.getAttribute("data-idfoto");
                        $.ajax({
                            url: "ajaxborrarfoto.php?idfoto="+idfoto,
                            success: function(result){
                                if(result.respuesta){
                                toastr.success('Se ha borrado correctamente', 'Exito');
                                modalfotos.modal('hide');
                            }
                            else
                                toastr.warning('Error al borrar la foto ', 'Error');
                            },
                            error: function(){

                            }
                        });
                    };
                    divfotos.append(botonBorrar);
                }
            },
            error: function(){
                toastr.warning('Error cargando las fotos ', 'Error');
            }
        });
    }
    
    function editarPlato(elemento){
        var id= elemento.getAttribute("data-editar");
        var editarPlato = document.getElementById("editarPlato");
        $.ajax({
            url: "ajaxobtenerplato.php?id="+id,
            success: function(result){
                   $("#nombreEditar").val(result.nombre);
                   $("#descripcionEditar").val(result.descripcion);
            },
            error: function(){
                toastr.error(' ', 'Error');
            }
        });
        $('#modalEditar').modal("show");
        
        editarPlato.onclick = function(){
            var nombre = $('#nombreEditar').val();
            var descripcion = $('#descripcionEditar').val();
            var archivo = document.getElementById("archivoEditar");
            var ajax, archivoactual, archivos, parametros, i, longitud;
            archivos = archivo.files;
            longitud = archivo.files.length;
            parametros = new FormData();
            parametros.append("numerodearchivos", longitud);
            for (i = 0; i < longitud; i++) {
                archivoactual = archivos[i];
                parametros.append('archivo[]', archivoactual, archivoactual.name);
            }
            $.ajax({
                url: "ajaxeditarplato.php?id="+id+"&nombre="+nombre+"&descripcion="+descripcion,
                success: function (result) {
                    if(result.respuesta >= 0){
                        toastr.success('Se ha editado el plato', 'Exito');
                        ajax = new XMLHttpRequest();
                        if(ajax.upload){
                            ajax.open("POST", "ajaxinsertimagenes.php?id="+id, true);
                            ajax.onreadystatechange=function(texto){
                                if(ajax.readyState==4){
                                    if(ajax.status==200){
                                        
                                    } else{
                                        toastr.warning('No se guardaron las imagenes. ', 'Error');
                                    }
                                }
                            };
                            ajax.send(parametros);
                        }
                        $('#nombreEditar').val("");
                        $('#descripcionEditar').val("");
                        $("#archivoEditar").replaceWith($("#archivoEditar").clone(true));
                    }else{
                        toastr.warning('Error al editar. ', 'Error');
                    }                    
                    cargarPagina(paginaGlobal);
                },
                error: function () {
                    toastr.error(' ', 'Error');
                }
            });
            
            $('#modalEditar').modal("hide");
        };
        document.getElementById("cancelarEditar").onclick = function(){
            $('#nombreEditar').val("");
            $('#descripcionEditar').val("");
            $("#archivoEditar").replaceWith($("#archivoEditar").clone(true));
        };
    }
    
    function insertarPlato(){
        $('#modalInsertarPlato').modal('show');
        var guardarPlato = document.getElementById("guardarPlato");
        guardarPlato.onclick = function(){
            var nombre = $('#nombreInsertar').val();
            var descripcion = $('#descripcionInsertar').val();           
            //Fotos
            var archivo = document.getElementById("archivo");
            var ajax, archivoactual, archivos, parametros, i, longitud;
            archivos = archivo.files;
            longitud = archivo.files.length;
            parametros = new FormData();
            parametros.append("numerodearchivos", longitud);
            for (i = 0; i < longitud; i++) {
                archivoactual = archivos[i];
                parametros.append('archivo[]', archivoactual, archivoactual.name);
            }
            $.ajax({
                url: "ajaxinsert.php?nombre="+nombre+"&descripcion="+descripcion,
                success: function (result) {
                    if(result.respuesta > 0){
                        toastr.success('Se ha guardado el plato', 'Exito');
                        ajax = new XMLHttpRequest();
                        if(ajax.upload){
                            ajax.open("POST", "ajaxinsertimagenes.php?id="+result.id, true);
                            ajax.onreadystatechange=function(texto){
                                if(ajax.readyState==4){
                                    if(ajax.status==200){
                                        
                                    } else{
                                        toastr.warning('No se guardaron las imagenes. ', 'Error');
                                    }
                                }
                            };
                            ajax.send(parametros);
                        }
                        $('#nombreInsertar').val("");
                        $('#descripcionInsertar').val("");
                        $("#archivo").replaceWith($("#archivo").clone(true));
                    }else{
                        toastr.warning('Error al insertar.', 'Error');
                    }                    
                    cargarPagina(paginaGlobal);
                },
                error: function () {
                    toastr.error(' ', 'Error');
                }
            }); 
            $('#modalInsertarPlato').modal('hide');
        }
    }
    
});
