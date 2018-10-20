  <!-- Modal -->
  <div class="modal fade" id="planificarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Planificación de turnos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form>
          <div class="modal-body">
            {{-- 
            <div class="alert alert-dismissible alert-danger">
              <button class="close" type="button" data-dismiss="alert">×</button>
              <strong>Oh snap!</strong>Change a few things up and try submitting again.
            </div>
            --}}
            <div class="form-group">
              <label class="control-label">Días</label>
                <div class="btn-group btn-group-toggle d-flex" role="group" data-toggle="buttons">
                  <label class="btn btn-outline-primary w-100">
                    <input type="checkbox" name="dias" autocomplete="off" value="lunes"> Lun
                  </label>
                  <label class="btn btn-outline-primary w-100">
                    <input type="checkbox" name="dias" autocomplete="off" value="martes"> Mar
                  </label>
                  <label class="btn btn-outline-primary w-100">
                    <input type="checkbox" name="dias" autocomplete="off" value="miercoles"> Mié
                  </label>
                  <label class="btn btn-outline-primary w-100">
                    <input type="checkbox" name="dias" autocomplete="off" value="jueves"> Jue
                  </label>
                  <label class="btn btn-outline-primary w-100">
                    <input type="checkbox" name="dias" autocomplete="off" value="viernes"> Vie
                  </label>
                </div> <!--btn-group-->
            </div> <!--form-group-->
            <div class="form-row">
              <div class="form-group col-md-4">
                <label class="control-label">Hora de comienzo</label>
                <input type="time" name="hora_desde" id="hora_desde" class="form-control" required autocomplete>
              </div><!--form-group-->
              <div class="form-group col-md-4">
                <label class="control-label">Hora de finalización</label>
                <input type="time" name="hora_hasta" id="hora_hasta" class="form-control" required autocomplete>
              </div><!--form-group-->
              <div class="form-group col-md-4">
                <label class="control-label">Duración (minutos)</label>
                <input type="number" name="duracion" id="duracion" class="form-control" value="30" required>
              </div><!--form-group-->
            </div><!--form-row-->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary" id="planificarBtn">Guardar</button>
            </div><!--modal-footer-->
          </div><!--modal-body-->
       </form>
    </div> <!-- modal-dialog -->
  </div><!-- modal -->
