  <!-- page content -->
  <div class="right_col" role="main">
      <div class="">
          <div class="page-title">
              <div class="title_left">
                  <h3>Registrar Salida</h3>
              </div>

              <div class="title_right">
              </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                      <div class="x_title">
                          <h2>Formulario de salida de inventario</h2>
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
                          <div class="row">
                              <div class="col-md-12">

                                  <form action="<?php echo base_url(); ?>movimientos/ventas/guardar" method="POST" class="form-horizontal">
                                      <div class="form-group">
                                          

                                      </div>
                                      <div class="form-group">
                                          <div class="col-md-3">
                                              <label for="">Cliente:</label>
                                              <div class="input-group">
                                                  <input type="hidden" name="idcliente" id="idcliente">
                                                  <input type="text" class="form-control" readonly="readonly" required id="cliente">
                                                  <span class="input-group-btn">
                                                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default"><span class="fa fa-search"></span> Buscar</button>
                                                  </span>
                                              </div><!-- /input-group -->
                                          </div>
                                          
                                          <div class="col-md-3">
                                              <label for="">Fecha:</label>
                                              <input type="date" value="<?php echo date("Y-m-d") ?>" class="form-control" name="fecha" required>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-md-3">
                                              <label for="proyecto">Nombre proyecto</label>
                                              <input type="text" name="proyecto" id="proyecto" class="form-control" required>
                                          </div>
                                          <div class="col-md-3">
                                              <label for="fase_proyecto" class="">Fase de proyecto</label>
                                              <select name="fase_proyecto" id="fase_proyecto" requiered='requiered' class="form-control col-md-7 col-xs-12">
                                                  <option value="">Seleccione</option>
                                                  <option value="En ejecucion">En ejecucion</option>
                                                  
                                              </select>
                                          </div>
                                          <div class="col-md-3">
                                              <label for="">Empleado a cargo:</label>
                                              <div class="input-group">
                                                  <input type="hidden" name="idempleado" id="idempleado">
                                                  <input type="text" class="form-control" readonly="readonly" required id="empleado">
                                                  <span class="input-group-btn">
                                                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-empleados"><span class="fa fa-search"></span> Buscar</button>
                                                  </span>
                                              </div><!-- /input-group -->
                                          </div>

                                      </div>

                                      <label for="Productos" class="col-md-12">Buscar y agregar productos o servicios</label>
                                      <br></br>
                                      <div class="form-group">
                                          <div class="col-md-4">
                                              <label for="">Descripcion:</label>
                                              <input type="text" class="form-control" id="producto">
                                          </div>
                                          <div class="col-md-4">
                                              <label for="">Codigo producto:</label>
                                              <input type="text" class="form-control" id="codigo_producto">
                                          </div>
                                          <div class="col-md-2">
                                              <label for="">&nbsp;</label>
                                              <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
                                          </div>
                                          <div class="col-md-2">
                                              <label for="">&nbsp;</label>
                                              <button class="btn btn-primary btn-flat btn-block" type="button" data-toggle="modal" data-target="#modal-productos"><span class="fa fa-search"></span> Buscar</button>
                                          </div>
                                      </div>
                                      <br></br>
                                      <table id="tbventas" class="table table-bordered table-striped table-hover">
                                          <thead>
                                              <tr>
                                                  <th>Codigo</th>
                                                  <th>Descripcion</th>
                                                  <th>Precio</th>
                                                  <th>Stock Max.</th>
                                                  <th>Cantidad</th>
                                                  <th>Importe</th>
                                                  <th>Opciones</th>
                                              </tr>
                                          </thead>
                                          <tbody>

                                          </tbody>
                                      </table>

                                      <div class="form-group">
                                          <div class="col-md-3">
                                              <div class="input-group">
                                                  <span class="input-group-addon">Total:</span>
                                                  <input type="text" class="form-control" placeholder="" value="0.00" name="subtotal" readonly="readonly">
                                              </div>
                                          </div>
                                         
                                         
                                      </div>

                                      <div class="form-group">
                                          <div class="col-md-12">
                                              <a class="btn btn-primary btn-flat" href="<?php echo site_url("Movimientos/Ventas") ?>" type="button">Volver</a>
                                              <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                          </div>

                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- /page content -->


  <div class="modal fade" id="modal-default">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Lista de Clientes</h4>
              </div>
              <div class="modal-body">
                  <table id="example1" class="table table-bordered table-striped table-hover">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nombre</th>
                              <th>Documento</th>
                              <th>Numero</th>
                              <th>Opcion</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (!empty($clientes)) : ?>
                              <?php foreach ($clientes as $cliente) : ?>
                                  <tr>
                                      <td><?php echo $cliente->id_clientes; ?></td>
                                      <td><?php echo $cliente->nombres; ?></td>
                                      <td><?php echo $cliente->tipodocumento; ?></td>
                                      <td><?php echo $cliente->num_documento; ?></td>
                                      <?php $dataCliente = $cliente->id_clientes . "*" . $cliente->nombres . "*" . $cliente->tipocliente . "*" . $cliente->tipodocumento . "*" . $cliente->num_documento . "*" . $cliente->telefono . "*" . $cliente->direccion; ?>

                                      <td>
                                          <button type="button" class="btn btn-success btn-check" value="<?php echo $dataCliente ?>"><span class="fa fa-check"></span></button>
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

                                      <?php $dataproducto = $producto->id_productos . "*" . $producto->codigo . "*" . $producto->nombre . "*" . $producto->precio . "*" . $producto->stock; ?>

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


  <div class="modal fade" id="modal-empleados">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Lista de Empleados</h4>
              </div>
              <div class="modal-body">
                  <table id="example1" class="table table-bordered table-striped table-hover">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nombre</th>
                              <th>Apellidos</th>
                              <th>Documento</th>
                              <th>Numero</th>
                              <th>Telefono</th>
                              <th>Opcion</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (!empty($empleados)) : ?>
                              <?php foreach ($empleados as $empleado) : ?>
                                  <tr>
                                      <td><?php echo $empleado->id_empleados; ?></td>
                                      <td><?php echo $empleado->nombre; ?></td>
                                      <td><?php echo $empleado->apellidos; ?></td>
                                      <td><?php echo $empleado->tipodocumento; ?></td>
                                      <td><?php echo $empleado->num_documento; ?></td>
                                      <td><?php echo $empleado->telefono_01; ?></td>
                                      <?php $dataempleado = $empleado->id_empleados . "*" . $empleado->nombre . "*" . $empleado->apellidos . "*" . $empleado->tipodocumento . "*" . $empleado->num_documento . "*" . $empleado->telefono_01 . "*" . $empleado->direccion; ?>

                                      <td>
                                          <button type="button" class="btn btn-success btn-check-empleado" value="<?php echo $dataempleado ?>"><span class="fa fa-check"></span></button>
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