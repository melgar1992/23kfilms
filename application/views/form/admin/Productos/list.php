    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Formulario Productos</h3>
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


                            <form method="POST" action="<?php echo base_url(); ?>Mantenimiento/Productos/guardarProducto" id="categorias" class="form-horizontal form-label-left">
                                <div class="form-group <?php echo !empty(form_error("codigo")) ? 'has-error' : ''; ?>">
                                    <label for="codigo" class="control-label col-md-3 col-sm-3 col-xs-12">Codigo<span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input type="text" name="codigo" value="<?php echo set_value('codigo') ?>" id="codigo" required="required" class="form-control col-md-7 col-xs-12" placeholder="Codigo del Producto">
                                        <?php echo form_error("codigo", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                    </div>
                                </div>

                                <div class="form-group <?php echo !empty(form_error("nombre")) ? 'has-error' : ''; ?>">
                                    <label for="nombre" class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input type="text" name="nombre" value="<?php echo set_value('nombre') ?>" id=nombre required="required" class="form-control col-md-7 col-xs-12" placeholder="Nombre del producto">
                                        <?php echo form_error("nombre", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descripcion" class="control-label col-md-3 col-sm-3 col-xs-12">Estado <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <select name="descripcion" id="descripcion" requiered='requiered' class="form-control col-md-7 col-xs-12">
                                            <option value="">Seleccione</option>
                                            <option value="Nuevo">Nuevo</option>
                                            <option value="Usado">Usado</option>
                                            <option value="Desgastado">Desgastado</option>
                                            <option value="Falla">Falla</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group <?php echo !empty(form_error("precio_compra")) ? 'has-error' : ''; ?>">
                                    <label for="precio_compra" class="control-label col-md-3 col-sm-3 col-xs-12">Precio compra <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input type="number" step="0.01" name="precio_compra" value="<?php echo set_value('precio_compra') ?>" id="precio_compra" required="required" placeholder="precio compra del producto" class="form-control col-md-7 col-xs-12">
                                        <?php echo form_error("precio_compra", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo !empty(form_error("precio")) ? 'has-error' : ''; ?>">
                                    <label for="precio" class="control-label col-md-3 col-sm-3 col-xs-12">Precio <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input type="number" step="0.01" name="precio" value="<?php echo set_value('precio') ?>" id="precio" required="required" placeholder="Precio del producto" class="form-control col-md-7 col-xs-12">
                                        <?php echo form_error("precio", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo !empty(form_error("stock")) ? 'has-error' : ''; ?>">
                                    <label for="stock" class="control-label col-md-3 col-sm-3 col-xs-12">Stock <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input type="number" name="stock" value="<?php echo set_value('stock') ?>" id="stock" required="required" placeholder="Cantidad de stock del producto" class="form-control col-md-7 col-xs-12">
                                        <?php echo form_error("stock", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="categoria" class="control-label col-md-3 col-sm-3 col-xs-12">Categoria <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <select name="categoria" id="categoria" required="required" class="form-control col-md-7 col-xs-12">
                                            <?php foreach ($categorias as $categoria) : ?>
                                                <option value="<?php echo $categoria->id_categorias; ?>"><?php echo $categoria->nombre; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group <?php echo !empty(form_error("lugar_almacenado")) ? 'has-error' : ''; ?>">
                                    <label for="lugar_almacenado" class="control-label col-md-3 col-sm-3 col-xs-12">Lugar de almacen <span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input type="text" name="lugar_almacenado" value="<?php echo set_value('lugar_almacenado') ?>" id="lugar_almacenado" required="required" placeholder="Ubicacion del producto" class="form-control col-md-7 col-xs-12">
                                        <?php echo form_error("lugar_almacenado", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo !empty(form_error("color")) ? 'has-error' : ''; ?>">
                                    <label for="color" class="control-label col-md-3 col-sm-3 col-xs-12">Color<span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input type="text" name="color" value="<?php echo set_value('color') ?>" id="color" required="required" placeholder="Color del producto" class="form-control col-md-7 col-xs-12">
                                        <?php echo form_error("color", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo !empty(form_error("talla")) ? 'has-error' : ''; ?>">
                                    <label for="talla" class="control-label col-md-3 col-sm-3 col-xs-12">Talla<span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input type="text" name="talla" onkeyup="mayus(this);" value="<?php echo set_value('talla') ?>" id="talla" required="required" placeholder="Talla del producto" class="form-control col-md-7 col-xs-12">
                                        <?php echo form_error("talla", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo !empty(form_error("marca")) ? 'has-error' : ''; ?>">
                                    <label for="marca" class="control-label col-md-3 col-sm-3 col-xs-12">Marca<span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input type="text" name="marca" value="<?php echo set_value('marca') ?>" id="marca" required="required" placeholder="Marca del producto" class="form-control col-md-7 col-xs-12">
                                        <?php echo form_error("marca", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                    </div>
                                </div>
                                <div class="form-group <?php echo !empty(form_error("fecha_ini")) ? 'has-error' : ''; ?>">
                                    <label for="fecha_ini" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha ingreso del producto<span class="required">*</span></label>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <input type="date" name="fecha_ini" value="<?php echo !empty(set_value('fecha_ini')) ? set_value('fecha_ini') : date('y-m-d')  ?>" id="fecha_ini" required="required" placeholder="" class="form-control col-md-7 col-xs-12">
                                        <?php echo form_error("fecha_ini", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
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
                                            <h2>Tabla de productos</h2>
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
                                                        <th>Codigo</th>
                                                        <th>Descripcion</th>
                                                        <th>Estado Producto</th>
                                                        <th>Talla</th>
                                                        <th>Color</th>
                                                        <Th>Marca</Th>
                                                        <th>Precio</th>
                                                        <th>Stock</th>
                                                        <th>Categoria</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (!empty($productos)) : ?>
                                                        <?php foreach ($productos as $productos) : ?>

                                                            <tr>
                                                                <td><?php echo $productos->id_productos; ?></td>
                                                                <td><?php echo $productos->codigo; ?></td>
                                                                <td><?php echo $productos->nombre; ?></td>
                                                                <td><?php echo $productos->descripcion; ?></td>
                                                                <td><?php echo $productos->talla; ?></td>
                                                                <td><?php echo $productos->color; ?></td>
                                                                <td><?php echo $productos->marca; ?></td>
                                                                <td><?php echo $productos->precio; ?></td>
                                                                <td><?php echo $productos->stock; ?></td>
                                                                <td><?php echo $productos->categoria; ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <button type="button" class="btn btn-info btn-vista" data-toggle="modal" data-target="modal-default" value="<?php echo $productos->id_productos ?>"><span class="fa fa-search"></span></button>
                                                                        <a href="<?php echo base_url() ?>Mantenimiento/Productos/editar/<?php echo $productos->id_productos; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                                        <a href="<?php echo base_url(); ?>Mantenimiento/Productos/borrar/<?php echo $productos->id_productos; ?>" class="btn btn-danger btn-borrar"><span class="fa fa-remove"></span></a>
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

                    <h4 class="modal-title">Informacion del Producto</h4>

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