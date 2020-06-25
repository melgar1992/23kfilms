    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Formulario Servicio</h3>
                </div>

                <div class="title_right">
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Editar Servicio</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
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


                            <form method="POST" action="<?php echo base_url(); ?>Mantenimiento/Servicios/actualizarServicio" id="categorias" class="form-horizontal form-label-left">
                                <input type="hidden" name="id_servicio" value="<?php echo $servicio['id_servicio']; ?>">
                                <div class="form-group">
                                    <label for="id_categoria_servicios" class="control-label col-md-3 col-sm-3 col-xs-12">Categoria <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <select name="id_categoria_servicios" id="id_categoria_servicios" required="required" class="form-control col-md-7 col-xs-12">
                                            <?php foreach ($categoria_servicios as $categoria) : ?>
                                                <?php if ($categoria->id_categoria_servicios == $servicio['id_categoria_servicios']) : ?>
                                                    <option value="<?php echo $categoria->id_categoria_servicios; ?>" selected><?php echo $categoria->nombre; ?></option>
                                                <?php else : ?>
                                                    <option value="<?php echo $categoria->id_categoria_servicios; ?>"><?php echo $categoria->nombre; ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group <?php echo !empty(form_error("nombre")) ? 'has-error' : ''; ?>">
                                    <label for="nombre" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre de servicio <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input type="text" maxlength="45" value="<?php echo !empty(form_error("nombre")) ? set_value('nombre') : $servicio['nombre'] ?>" name="nombre" id="nombre" required="required" class="form-control col-md-7 col-xs-12" placeholder="nombre del Servicio">
                                        <?php echo form_error("nombre", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo !empty(form_error("descripcion")) ? 'has-error' : ''; ?>">
                                    <label for="descripcion" class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input type="text" maxlength="100" value="<?php echo !empty(form_error("descripcion")) ? set_value('descripcion') : $servicio['descripcion'] ?>" name="descripcion" id="descripcion" required="required" class="form-control col-md-7 col-xs-12" placeholder="Descripcion del servicio">
                                        <?php echo form_error("descripcion", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                    </div>
                                </div>
                               

                                <br>
                                <br>

                                <div class="form-group">

                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a class="btn btn-primary btn-flat" href="<?php echo site_url("Mantenimiento/Servicios") ?>" type="button">Volver</a>
                                        <button type="submit" id="editar" class="btn btn-success">Editar</button>

                                    </div>
                                </div>

                            </form>

                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->