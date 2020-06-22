 <!-- page content -->
 <div class="right_col" role="main">
     <div class="">
         <div class="page-title">
             <div class="title_left">
                 <h3>Fallas de productos</h3>
             </div>

             <div class="title_right">
             </div>
         </div>

         <div class="clearfix"></div>

         <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="x_panel">
                     <div class="x_title">
                         <h2>Formulario de fallas</h2>
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
                                 <button type="button" class="close" data-dissmiss="alert" aria-hidden="true"></button>
                                 <p><i class="icon fa fa-ban"></i><?php echo $this->session->flashdata("error"); ?></p>

                             </div>
                         <?php endif; ?>


                         <form method="POST" action="<?php echo base_url(); ?>Movimientos/descarte/actualizar" id="productos_fallas" class="form-horizontal form-label-left">
                             <input type="number" hidden="hidden" name="id_descarte_producto" id="id_descarte_producto" value="<?php echo $descarte_producto->id_descarte_producto ?>">

                             <div class="form-group <?php echo !empty(form_error("producto")) ? 'has-error' : ''; ?>">
                                 <label for="producto" class="control-label col-md-3 col-sm-3 col-xs-12">Descripcion :<span class="required">*</span></label>
                                 <div class="input-group col-md-3 col-sm-6 col-xs-12">
                                     <input type="number" name="id_productos" value="<?php echo !empty(form_error("id_productos")) ? set_value('id_productos') : $descarte_producto->id_productos ?>" id="id_productos" hidden='hidden'>
                                     <input type="text" readonly='readonly' name="producto" value="<?php echo !empty(form_error("producto")) ? set_value('producto') : $descarte_producto->nombre_producto ?>" id="producto" required="required" class="form-control" placeholder="Descripcion del Producto">
                                     <span class="input-group-btn">
                                         <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-productos"><span class="fa fa-search"></span> Buscar</button>
                                     </span>
                                     <?php echo form_error("producto", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                 </div>
                             </div>
                             <div class="form-group <?php echo !empty(form_error("categoria_producto")) ? 'has-error' : ''; ?>">
                                 <label for="categoria_producto" class="control-label col-md-3 col-sm-3 col-xs-12">Categoria producto <span class="required">*</span></label>
                                 <div class="col-md-3 col-sm-6 col-xs-12">
                                     <input type="text" readonly='readonly' value="<?php echo !empty(form_error("categoria_producto")) ? set_value('categoria_producto') : $descarte_producto->categorias_producto ?>" id="categoria_producto" required="required" class="form-control" placeholder="Categoria producto">
                                     <?php echo form_error("categoria_producto", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                 </div>
                             </div>
                             <div class="form-group <?php echo !empty(form_error("cantidad")) ? 'has-error' : ''; ?>">
                                 <label for="cantidad" class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad <span class="required">*</span></label>
                                 <div class="col-md-3 col-sm-6 col-xs-12">
                                     <input type="number" min="0" max ='<?php echo  $descarte_producto->stock + $descarte_producto->cantidad ?>' name="cantidad" value="<?php echo !empty(form_error("cantidad")) ? set_value('cantidad') : $descarte_producto->cantidad ?>" id=cantidad required="required" class="form-control" placeholder="cantidad del producto">
                                     <?php echo form_error("cantidad", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label for="tipo_falla" class="control-label col-md-3 col-sm-3 col-xs-12">Describa el tipo de falla : <span class="required">*</span></label>
                                 <div class="col-md-3 col-sm-6 col-xs-12">
                                     <textarea name="tipo_falla" id="tipo_falla" class="form-control" rows="3"><?php echo !empty(form_error("tipo_falla")) ? set_value('tipo_falla') : $descarte_producto->tipo_falla ?></textarea>
                                 </div>
                             </div>
                             <div class="form-group <?php echo !empty(form_error("fecha")) ? 'has-error' : ''; ?>">
                                 <label for="fecha" class="control-label col-md-3 col-sm-3 col-xs-12">Fecha falla<span class="required">*</span></label>
                                 <div class="col-md-3 col-sm-6 col-xs-12">
                                     <input type="date" name="fecha" value="<?php echo !empty(form_error("fecha")) ? set_value('fecha') : $descarte_producto->fecha ?>" id="fecha" required="required" placeholder="" class="form-control">
                                     <?php echo form_error("fecha", "<span class='help-block col-md-4 cols-xs-12 '>", "</span>"); ?>
                                 </div>
                             </div>

                             <br>
                             <br>

                             <div class="form-group">

                                 <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                     <a class="btn btn-primary btn-flat" href="<?php echo site_url("Movimientos/Descarte") ?>" type="button">Volver</a>
                                     <button type="submit" id="editar" class="btn btn-warning">Editar</button>

                                 </div>
                             </div>

                         </form>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- /page content -->

 <div class="modal fade" id="modal-productos">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Lista de Productos</h4>
             </div>
             <div class="modal-body">
                 <table id="tablaProdcutos" class="table table-bordered table-striped table-hover">
                     <thead>
                         <tr>
                             <th>Codgio</th>
                             <th>Descripcion</th>
                             <th>Estado Producto</th>
                             <th>Categoria</th>
                             <th>Precio</th>
                             <th>Stock</th>
                             <th>Lugar Almacenamiento</th>
                             <th>Color</th>
                             <th>Talla</th>
                             <th>Opcion</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php if (!empty($productos)) : ?>
                             <?php foreach ($productos as $producto) : ?>
                                 <tr>
                                     <td><?php echo $producto->codigo; ?></td>
                                     <td><?php echo $producto->nombre; ?></td>
                                     <td><?php echo $producto->descripcion; ?></td>
                                     <td><?php echo $producto->categoria; ?></td>
                                     <td><?php echo $producto->precio; ?></td>
                                     <td><?php echo $producto->stock; ?></td>
                                     <td><?php echo $producto->lugar_almacenado; ?></td>
                                     <td><?php echo $producto->color; ?></td>
                                     <td><?php echo $producto->talla; ?></td>

                                     <?php $dataproducto = $producto->id_productos . "*" . $producto->codigo . "*" . $producto->nombre . "*" . $producto->precio . "*" . $producto->stock . "*" . $producto->categoria; ?>

                                     <td>
                                         <button type="button" class="btn btn-success btn-check-producto" value="<?php echo $dataproducto ?>"><span class="fa fa-check"></span></button>
                                     </td>
                                 </tr>
                             <?php endforeach; ?>
                         <?php endif; ?>

                     </tbody>
                 </table>

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