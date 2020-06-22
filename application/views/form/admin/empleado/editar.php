<!-- Content Wrapper. Contains page content -->
<div class="right_col" role="main" style="min-height: 950px;">
    <div class="">
        <div class="page-title">
            <div class="title_left">

            </div>
        </div>

        <div class="clearfix"></div>
        <!-- Default box -->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Editar Empleado</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <?php if ($this->session->flashdata("error")) : ?>
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dissmiss="alert" aria-hidden="true">$times;</button>
                                <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>

                            </div>
                        <?php endif; ?>
                        <form method="POST" action="<?php echo base_url(); ?>Mantenimiento/Empleado/actualizarEmpleado" id="empleado" class="form-horizontal form-label-left">
                            <input type="hidden" value="<?php echo $Empleado->id_empleados; ?>" name="id_empleados">

                            <div class="form-group <?php echo !empty(form_error("nombre")) ? 'has-error' : ''; ?>">
                                <label for="nombre" class="control-label col-md-4 col-sm-3 col-xs-12">Nombres: <span class="required">*</span></label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" name="nombre" value="<?php echo !empty(form_error("nombre")) ? set_value("nombre") : $Empleado->nombre ?>" id=nombre required="required" class="form-control col-md-3 col-sm-3 col-xs-12" placeholder="">
                                    <?php echo form_error("nombre", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                </div>
                            </div>
                            <div class="form-group <?php echo !empty(form_error("apellidos")) ? 'has-error' : ''; ?>">
                                <label for="apellidos" class="control-label col-md-4 col-sm-3 col-xs-12">Apellidos: <span class="required">*</span></label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="text" name="apellidos" value="<?php echo !empty(form_error("apellidos")) ? set_value("apellidos") : $Empleado->apellidos ?>" id=apellidos required="required" class="form-control col-md-3 col-sm-3 col-xs-12" placeholder="">
                                    <?php echo form_error("apellidos", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                </div>
                            </div>
                            
                            <div class="form-group <?php echo !empty(form_error("telefono1")) ? 'has-error' : ''; ?>">
                                <label for="telefono1" class="control-label col-md-4 col-sm-3 col-xs-12">Telefono Opc 1: <span class="required">*</span></label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="number" name="telefono1" value="<?php echo !empty(form_error("telefono1")) ? set_value("telefono") : $Empleado->telefono_01 ?>" id=telefono1 required="required" class="form-control col-md-3 col-sm-3 col-xs-12" placeholder="">
                                    <?php echo form_error("telefono", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                </div>
                            </div>
                            <div class="form-group <?php echo !empty(form_error("telefono2")) ? 'has-error' : ''; ?>">
                                <label for="telefono2" class="control-label col-md-4 col-sm-3 col-xs-12">Telefono Opc 2: </label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="number" name="telefono2" value="<?php echo !empty(form_error("telefono2")) ? set_value("telefono") : $Empleado->telefono_02 ?>" id=telefono2  class="form-control col-md-3 col-sm-3 col-xs-12" placeholder="">
                                    <?php echo form_error("telefono", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                </div>
                            </div>
                            <div class="form-group <?php echo !empty(form_error("direccion")) ? 'has-error' : ''; ?>">
                                <label for="direccion" class="control-label col-md-4 col-sm-3 col-xs-12">Direccion:</label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="text"  name="direccion" value="<?php echo !empty(form_error("direccion")) ? set_value("direccion") : $Empleado->direccion ?>" id=direccion  class="form-control col-md-3 col-sm-3 col-xs-12" placeholder="">
                                    <?php echo form_error("direccion", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                </div>
                            </div>
                            <div class="form-group <?php echo form_error("tipodocumento") != false ? 'has-error' : ''; ?>">
                                  <label for="tipodocumento" class="control-label col-md-4 col-sm-3 col-xs-12">Tipo documento <span class="required">*</span></label>
                                  <div class="col-md-4 col-sm-6 col-xs-12">
                                      <select name="tipodocumento" id="tipodocumento" required="required" class="form-control col-md-3 col-xs-12">
                                          <?php if (form_error("tipodocumento") != false || set_value("tipodocumento" != false)) : ?>
                                              <?php foreach ($tipodocumentos as $tipodocumento) : ?>
                                                  <option value="<?php echo $tipodocumento->id_tipo_documento; ?>" <?php echo set_select("tipodocumento", $tipodocumento->id_tipo_documento); ?>><?php echo $tipodocumento->nombre; ?></option>
                                              <?php endforeach; ?>
                                          <?php else : ?>
                                              <?php foreach ($tipodocumentos as $tipodocumento) : ?>
                                                  <option value="<?php echo $tipodocumento->id_tipo_documento; ?>" <?php echo $tipodocumento->id_tipo_documento == $Empleado->id_tipo_documento ? 'selected' : ''; ?>><?php echo $tipodocumento->nombre; ?></option>
                                              <?php endforeach; ?>
                                          <?php endif; ?>
                                      </select>
                                      <?php echo form_error('tipodocumento', "<span class= 'help-block'>", '</span>'); ?>

                                  </div>
                              </div>
                            <div class="form-group <?php echo !empty(form_error("num_documento")) ? 'has-error' : ''; ?>">
                                <label for="num_documento" class="control-label col-md-4 col-sm-3 col-xs-12">Num_documento: <span class="required">*</span></label>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <input type="number" name="num_documento" value="<?php echo !empty(form_error("num_documento")) ? set_value("num_documento") : $Empleado->num_documento ?>" id=num_documento required="required" class="form-control col-md-3 col-sm-3 col-xs-12" placeholder="">
                                    <?php echo form_error("num_documento", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                </div>
                            </div>

                            
                            <div class="in_solid"></div>

                            <br>

                            <div class="form-group">

                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <a href="<?php echo site_url("Mantenimiento/Empleado") ?>" class="btn btn-primary btn-flat">Volver</a>
                                    <button type="submit" id="guardar" class="btn btn-success">Editar</button>

                                </div>
                            </div>



                        </form>


                        </section>
                        <!-- /.content -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->