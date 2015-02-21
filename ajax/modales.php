<div class="modal fade" id="modalFotos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Fotos</h4>
        </div>
        <div class="modal-body">
            <div id="fotos"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
</div> 

<div class="modal fade" id="modalInsertarPlato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Insertar nuevo plato</h4>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data">
            <div class="form-group">
              <label for="recipient-name" class="control-label">Nombre:</label>
              <input type="text" style="width: 90%;" class="form-control" id="nombreInsertar">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">Descripcion:</label>
              <textarea class="form-control" style="width: 90%;" id="descripcionInsertar"></textarea>
            </div>
            <div class="form-group">
              <input type="file" id="archivo" multiple />
            </div>
          </form>
        <div class="modal-footer">
          <button type="button" id="cancelarInsertar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <button type="button" id="guardarPlato" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
</div>
    </div>  

<div class="modal fade" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Eliminar plato</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group" id="nombreABorrar">
                
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="cancelarBorrar" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="button" id="eliminarPlato" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel">Editar plato</h4>
        </div>
        <div class="modal-body">
          <form enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" style="width: 90%;" class="form-control" id="idEditar">
              <label for="recipient-name" class="control-label">Nombre:</label>
              <input type="text" style="width: 90%;" class="form-control" id="nombreEditar">
            </div>
            <div class="form-group">
              <label for="message-text" class="control-label">Descripcion:</label>
              <textarea class="form-control" style="width: 90%;" id="descripcionEditar"></textarea>
            </div>
            <div class="form-group">
              <input type="file" id="archivoEditar" multiple />
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="cancelarEditar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <button type="button" id="editarPlato" class="btn btn-warning">Editar</button>
        </div>
      </div>
    </div>
  </div>