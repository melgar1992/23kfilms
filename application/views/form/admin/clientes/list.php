     <!-- page content -->
     <div class="right_col" role="main">
         <div class="">
             <div class="page-title">
                 <div class="title_left">
                     <h3>Formulario Clientes</h3>
                 </div>

                 <div class="title_right">
                 </div>
             </div>

             <div class="clearfix"></div>

             <div class="row">
                 <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="x_panel">
                         <div class="x_title">
                             <h2>Clientes</h2>
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


                             <form method="POST" action="<?php echo base_url(); ?>Mantenimiento/Clientes/guardarClientes" id="clientes" class="form-horizontal form-label-left">
                                 <div class="form-group <?php echo form_error("nombres") != false ? 'has-error' : ''; ?>">
                                     <label for="nombres" class="control-label col-md-3 col-sm-3 col-xs-12">Nombre <span class="required">*</span></label>
                                     <div class="col-md-4 col-sm-6 col-xs-12">
                                         <input type="text" value="<?php echo set_value('nombres'); ?>" name="nombres" id="nombres" required="required" class="form-control col-md-7 col-xs-12" placeholder="Escriba el nombre">
                                         <?php echo form_error('nombres', "<span class= 'help-block'>", '</span>'); ?>
                                     </div>
                                 </div>
                                 <div class="form-group <?php echo form_error("tipocliente") != false ? 'has-error' : ''; ?>">
                                     <label for="tipocliente" class="control-label col-md-3 col-sm-3 col-xs-12">Tipo Clientes <span class="required">*</span></label>
                                     <div class="col-md-4 col-sm-6 col-xs-12">
                                         <select name="tipocliente" id="tipocliente" required="required" class="form-control col-md-7 col-xs-12">
                                             <option value="">Seleccione...</option>
                                             <?php foreach ($tipoclientes as $tipocliente) : ?>
                                                 <option value="<?php echo $tipocliente->id_tipo_cliente; ?>" <?php echo set_select("tipocliente", $tipocliente->id_tipo_cliente); ?>><?php echo $tipocliente->nombre; ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                         <?php echo form_error('tipocliente', "<span class= 'help-block'>", '</span>'); ?>

                                     </div>
                                 </div>
                                 <div class="form-group <?php echo form_error("tipodocumento") != false ? 'has-error' : ''; ?>">
                                     <label for="tipodocumento" class="control-label col-md-3 col-sm-3 col-xs-12">Tipo documento <span class="required">*</span></label>
                                     <div class="col-md-4 col-sm-6 col-xs-12">
                                         <select name="tipodocumento" id="tipodocumento" required="required" class="form-control col-md-7 col-xs-12">
                                             <option value="">Seleccione...</option>
                                             <?php foreach ($tipodocumentos as $tipodocumento) : ?>
                                                 <option value="<?php echo $tipodocumento->id_tipo_documento; ?>" <?php echo set_select("tipodocumento", $tipodocumento->id_tipo_documento); ?>><?php echo $tipodocumento->nombre; ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                         <?php echo form_error('tipodocumento', "<span class= 'help-block'>", '</span>'); ?>

                                     </div>
                                 </div>
                                 <div class="form-group <?php echo form_error("numero_documento") != false ? 'has-error' : ''; ?>">
                                     <label for="numero_documento" class="control-label col-md-3 col-sm-3 col-xs-12">Numero del Documento <span class="required">*</span></label>
                                     <div class="col-md-4 col-sm-6 col-xs-12">
                                         <input type="text" value="<?php echo set_value('numero_documento'); ?>" name="numero_documento" id="numero_documento" required="required" class="form-control col-md-7 col-xs-12" placeholder="Escriba el numero del documento">
                                         <?php echo form_error('numero_documento', "<span class= 'help-block'>", '</span>'); ?>

                                     </div>
                                 </div>

                                 <div class="form-group">
                                     <label for="telefono" class="control-label col-md-3 col-sm-3 col-xs-12">Telefono <span class="required">*</span></label>
                                     <div class="col-md-4 col-sm-6 col-xs-12">
                                         <input type="text" name="telefono" id="telefono" required="required" class="form-control col-md-7 col-xs-12" placeholder="Escriba el telefono">

                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="direccion" class="control-label col-md-3 col-sm-3 col-xs-12">Direccion <span class="required">*</span></label>
                                     <div class="col-md-4 col-sm-6 col-xs-12">
                                         <input type="text" name="direccion" id="direccion" required="required" class="form-control col-md-7 col-xs-12" placeholder="Escriba la direccion">

                                     </div>
                                 </div>

                         <div class="form-group">

                             <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                 <button class="btn btn-primary btn-flat" type="reset">Borrar</button>
                                 <button type="submit" id="guardar" class="btn btn-success">Guardar</button>

                             </div>
                         </div>

                         </form>

                         <hr>
                         <!-- Box de la tabla -->
                         <div class="row">
                             <div class="col-md-12 col-sm-12 col-xs-12">
                                 <div class="x_panel">
                                     <div class="x_title">
                                         <h2>Tabla de clientes</h2>
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
                                                     <th>Tipo Clientes</th>
                                                     <th>Tipo documento</th>
                                                     <th>Numero documento</th>
                                                     <th>Telefono</th>
                                                     <th>Direccion</th>
                                                     <th>Opciones</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php if (!empty($clientes)) : ?>
                                                     <?php foreach ($clientes as $cliente) : ?>

                                                         <tr>
                                                             <td><?php echo $cliente->id_clientes; ?></td>
                                                             <td><?php echo $cliente->nombres; ?></td>
                                                             <td><?php echo $cliente->tipocliente; ?></td>
                                                             <td><?php echo $cliente->tipodocumento; ?></td>
                                                             <td><?php echo $cliente->num_documento; ?></td>
                                                             <td><?php echo $cliente->telefono; ?></td>
                                                             <td><?php echo $cliente->direccion; ?></td>
                                                             <td>
                                                                 <div class="btn-group">
                                                                     <button type="button" class="btn btn-info btn-vista-cliente" data-toggle="modal" data-target="#modal-default" value="<?php echo $cliente->id_clientes ?>"><span class="fa fa-search"></span></button>
                                                                     <a href="<?php echo base_url() ?>Mantenimiento/Clientes/editar/<?php echo $cliente->id_clientes; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                                                     <button type="button" value="<?php echo  $cliente->id_clientes; ?>" class="btn btn-danger btn-borrar"><span class="fa fa-remove"></span></button>
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

     <!-- /page content -->

     <div class="modal fade" id="modal-default">

         <div class="modal-dialog">

             <div class="modal-content">

                 <div class="modal-header">

                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                         <span aria-hidden="true">&times;</span></button>

                     <h4 class="modal-title">Informacion del cliente</h4>

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