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
                            <h2>Productos</h2>
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
                            <form method="POST" action="<?php echo base_url(); ?>Mantenimiento/Servicios/guardarServicio" id="servicio" class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label for="id_categoria_servicios" class="control-label col-md-3 col-sm-3 col-xs-12">Categoria de servicio <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <select name="id_categoria_servicios" id="id_categoria_servicios" required="required" class="form-control col-md-7 col-xs-12">
                                            <option value=""></option>
                                            <?php foreach ($categoria_servicios as $row) : ?>
                                                <option value="<?php echo $row->id_categoria_servicios; ?>"><?php echo $row->nombre; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group <?php echo !empty(form_error("nombre")) ? 'has-error' : ''; ?>">
                                    <label for="nombre" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre del servicio <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input type="text" maxlength="45" name="nombre" value="<?php echo set_value('nombre') ?>" id=nombre required="required" class="form-control col-md-7 col-xs-12" placeholder="Nombre del servicio">
                                        <?php echo form_error("nombre", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo !empty(form_error("descripcion")) ? 'has-error' : ''; ?>">
                                    <label for="descripcion" class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion del servicio <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input type="text" maxlength="100" name="descripcion" value="<?php echo set_value('descripcion') ?>" id=descripcion required="required" class="form-control col-md-7 col-xs-12" placeholder="descripcion del servicio">
                                        <?php echo form_error("descripcion", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                    </div>
                                </div>

                            

                                <br>
                                <br>

                                <div class="form-group">

                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button class="btn btn-primary btn-flat" type="reset">Borrar</button>
                                        <button type="submit" id="guardar" class="btn btn-success">Guardar</button>

                                    </div>
                                </div>

                            </form>

                            <hr>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Tabla de servicios</h2>
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
                                                        <th>Categoria servicio</th>
                                                        <th>Nombre servicio</th>
                                                        <th>Descripcion</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($servicios)) : ?>
                                                        <?php foreach ($servicios as $row) : ?>

                                                            <tr>
                                                                <td><?php echo $row['id_servicio']; ?></td>
                                                                <td><?php echo $row['categoria']; ?></td>
                                                                <td><?php echo $row['nombre']; ?></td>
                                                                <td><?php echo $row['descripcion']; ?></td>

                                                                <td>
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-info btn-vista" data-toggle="modal" data-target="modal-default" value="<?php echo $row['id_servicio'] ?>"><span class="fa fa-search" title="Reporte"></span></button>
                                                                        <a href="<?php echo base_url() ?>Mantenimiento/Servicios/editar/<?php echo $row['id_servicio']; ?>" class="btn btn-warning"><span class="fa fa-pencil" title="Editar"></span></a>
                                                                        <a href="<?php echo base_url(); ?>Mantenimiento/Servicios/borrar/<?php echo $row['id_servicio']; ?>" class="btn btn-danger btn-borrar"><span class="fa fa-remove" title="Borrar"></span></a>
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
                            <!-- /.box -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <div class="modal fade" id="modal-default">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">Informacion del Servicio</h4>

                </div>

                <div class="modal-body">

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                </div>

            </div>

            <!-- /.modal-content -->

        </div>

        <!-- /.modal-dialog -->

    </div>

    <!-- /.modal -->