<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Formulario Empleado</h3>
      </div>

      <div class="title_right">
      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Empleado</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <h4>Los campos con * son obligatorios.</h4>
            <br> </br>
            <?php if ($this->session->flashdata("error")) : ?>
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dissmiss="alert" aria-hidden="true">$times;</button>
                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>

              </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo base_url(); ?>Mantenimiento/Empleado/guardarEmpleado" id="empleado" class="form-horizontal form-label-left">


              <div class="form-group <?php echo !empty(form_error("nombre")) ? 'has-error' : ''; ?>">
                <label for="nombre" class="control-label col-md-4 col-sm-3 col-xs-12">Nombres: <span class="required">*</span></label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <input type="text" name="nombre" value="<?php echo set_value('nombre') ?>" id=nombre required="required" class="form-control col-md-3 col-sm-3 col-xs-12" placeholder="">
                  <?php echo form_error("nombre", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                </div>
              </div>
              <div class="form-group <?php echo !empty(form_error("apellidos")) ? 'has-error' : ''; ?>">
                <label for="apellidos" class="control-label col-md-4 col-sm-3 col-xs-12">Apellidos: <span class="required">*</span></label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <input type="text" name="apellidos" value="<?php echo set_value('apellidos') ?>" id=apellidos required="required" class="form-control col-md-3 col-sm-3 col-xs-12" placeholder="">
                  <?php echo form_error("apellidos", "<span class='help-block col-md-4 col-xs-12 '>", "</span>"); ?>
                </div>
              </div>

              <div class="form-group <?php echo !empty(form_error("telefono1")) ? 'has-error' : ''; ?>">
                <label for="telefono1" class="control-label col-md-4 col-sm-3 col-xs-12">Telefono Opcion 1:<span class="required">*</span></label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <input type="number" name="telefono1" value="<?php echo set_value('telefono1') ?>" id=telefono1 required="required" class="form-control col-md-3 col-sm-3 col-xs-12" placeholder="">
                  <?php echo form_error("telefono1", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                </div>
              </div>
              <div class="form-group <?php echo !empty(form_error("telefono2")) ? 'has-error' : ''; ?>">
                <label for="telefono2" class="control-label col-md-4 col-sm-3 col-xs-12">Telefono Opcion 2:</label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <input type="number" name="telefono2" value="<?php echo set_value('telefono2') ?>" id=telefono2 class="form-control col-md-3 col-sm-3 col-xs-12" placeholder="">
                  <?php echo form_error("telefono2", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                </div>
              </div>
              <div class="form-group <?php echo !empty(form_error("direccion")) ? 'has-error' : ''; ?>">
                <label for="direccion" class="control-label col-md-4 col-sm-3 col-xs-12">Direccion:<span class="required">*</span></label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <input type="text" name="direccion" value="<?php echo set_value('direccion') ?>" id=direccion required="required" class="form-control col-md-3 col-sm-3 col-xs-12" placeholder="">
                  <?php echo form_error("direccion", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                </div>
              </div>
              <div class="form-group <?php echo !empty(form_error("tipodocumento")) ? 'has-error' : ''; ?>">
                <label for="tipodocumento" class="control-label col-md-4 col-sm-3 col-xs-12">Tipo de Documento: <span class="required">*</span></label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <select name="tipodocumento" id="tipodocumento" required class="form-control col-md-3 col-xs-12">
                    <option value=""></option>
                    <?php foreach ($tipodocumentos as $tipodocumento) : ?>
                      <option value="<?php echo $tipodocumento->id_tipo_documento; ?>" <?php echo set_select("tipodocumento", $tipodocumento->id_tipo_documento); ?>><?php echo $tipodocumento->nombre; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error("tipo_documento", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                </div>
              </div>
              <div class="form-group <?php echo !empty(form_error("num_documento")) ? 'has-error' : ''; ?>">
                <label for="num_documento" class="control-label col-md-4 col-sm-3 col-xs-12">Numero de Documento:<span class="required">*</span></label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                  <input type="number" name="num_documento" value="<?php echo set_value('num_documento') ?>" id=num_documento required="required" class="form-control col-md-3 col-sm-3 col-xs-12" placeholder="">
                  <?php echo form_error("num_documento", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                </div>
              </div>



              <div class="ln_solid"></div>

              <div class="form-group">

                <div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-5">
                  <button class="btn btn-primary btn-flat" type="reset">Borrar</button>
                  <button type="submit" id="guardar" class="btn btn-success">Guardar</button>

                </div>
              </div>


              <div class="ln_solid"></div>

            </form>
            <!-- Box de la tabla -->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tabla de Empleados</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="example1" class="table table-bordered btn-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombres</th>
                          <th>Apellidos</th>
                          <th>Telefono opc 1</th>
                          <th>Telefono opc 2</th>
                          <th>Direccion</th>
                          <th>Numero documento</th>

                          <th>Tipo documento</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($Empleados)) : ?>
                          <?php foreach ($Empleados as $Empleado) : ?>

                            <tr>
                              <td><?php echo $Empleado->id_empleados; ?></td>
                              <td><?php echo $Empleado->nombre; ?></td>
                              <td><?php echo $Empleado->apellidos; ?></td>
                              <td><?php echo $Empleado->telefono_01; ?></td>
                              <td><?php echo $Empleado->telefono_02; ?></td>
                              <td><?php echo $Empleado->direccion; ?></td>
                              <td><?php echo $Empleado->tipodocumento; ?></td>
                              <td><?php echo $Empleado->num_documento; ?></td>



                              <td>
                                <div class="btn-group">

                                  <a href="<?php echo base_url() ?>Mantenimiento/Empleado/editar/<?php echo  $Empleado->id_empleados; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                  <button type="button" value="<?php echo  $Empleado->id_empleados; ?>" class="btn btn-danger btn-borrar"><span class="fa fa-remove"></span></button>
                                </div>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        <?php endif; ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- /Bx de la tabla -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->