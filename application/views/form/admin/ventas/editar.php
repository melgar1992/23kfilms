  <!-- page content -->
  <div class="right_col" role="main">
      <div class="">
          <div class="page-title">
              <div class="title_left">
                  <h3>Editar presupuesto</h3>
              </div>

              <div class="title_right">
              </div>
          </div>

          <div class="clearfix"></div>

          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                      <div class="x_title">
                          <h2>Formulario de Presupuesto</h2>
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

                                  <form action="" id='editar_presupuesto' name="editar_presupuesto" method="POST" class="form-horizontal">
                                      <div class="form-group">
                                      </div>
                                      <div class="form-group">
                                          <div class="col-md-3">
                                              <label for="">Cliente:</label>
                                              <div class="input-group">
                                                  <input type="hidden" name="id_ventas" id="id_ventas" value="<?php echo $venta->id_ventas ?>">
                                                  <input type="hidden" name="idcliente" id="idcliente" value="<?php echo $venta->id_clientes ?>">
                                                  <input type="text" class="form-control" readonly="readonly" required id="cliente" value="<?php echo $venta->nombre_cliente ?>">
                                                  <span class="input-group-btn">
                                                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default"><span class="fa fa-search"></span> Buscar</button>
                                                  </span>
                                              </div><!-- /input-group -->
                                          </div>

                                          <div class="col-md-3">
                                              <label for="">Fecha:</label>
                                              <input type="date" value="<?php echo $venta->fecha; ?>" class="form-control" id="fecha" name="fecha" required>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-md-3">
                                              <label for="proyecto">Nombre proyecto</label>
                                              <input type="text" value="<?php echo $venta->proyecto ?>" name="proyecto" id="proyecto" class="form-control" required>
                                          </div>
                                          <div class="col-md-3">
                                              <label for="fase_proyecto" class="">Fase de proyecto</label>
                                              <select name="fase_proyecto" id="fase_proyecto" requiered='requiered' class="form-control col-md-7 col-xs-12">
                                                  <option value=""></option>
                                                  <option <?php echo ($venta->fase_proyecto == 'Evaluacion del proyecto') ? 'selected' : ''; ?> value="Evaluacion del proyecto">Evaluacion del proyecto</option>
                                                  <option <?php echo ($venta->fase_proyecto == 'Aprobado') ? 'selected' : ''; ?> value="Aprobado">Aprobado</option>
                                                  <option <?php echo ($venta->fase_proyecto == 'En ejecucion') ? 'selected' : ''; ?> value="En ejecucion">En ejecucion</option>
                                                  <option <?php echo ($venta->fase_proyecto == 'Terminado') ? 'selected' : ''; ?> value="Terminado">Terminado</option>

                                              </select>
                                          </div>
                                          <div class="col-md-3">
                                              <label for="">Empleado a cargo:</label>
                                              <div class="input-group">
                                                  <input type="hidden" value="<?php echo $venta->id_empleados ?>" name="idempleado" id="idempleado">
                                                  <input type="text" value="<?php echo $venta->nombre_empleado . ' ' . $venta->apellidos_empleado; ?>" class="form-control" readonly="readonly" required id="empleado">
                                                  <span class="input-group-btn">
                                                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-empleados"><span class="fa fa-search"></span> Buscar</button>
                                                  </span>
                                              </div><!-- /input-group -->
                                          </div>

                                      </div>

                                      <label for="Productos" class="col-md-12">Buscar y agregar una categoria de servicio para comenzar el proyecto</label>
                                      <br></br>
                                      <div class="form-group">
                                          <div class="col-md-2">
                                              <label for="">&nbsp;</label>
                                              <button class="btn btn-primary btn-flat btn-block" type="button" data-toggle="modal" data-target="#modal-categorias"><span class="fa fa-search"></span> Buscar</button>
                                          </div>
                                      </div>
                                      <br></br>

                                      <div id="tablas-categorias">
                                          <?php
                                            for ($i = 0; $i < count($cant_categoria_detalle); $i++) { ?>
                                              <div class='tabla-categoria-<?php echo $cant_categoria_detalle[$i]['id_categoria_servicios'] ?>'>
                                                  <div class='form-group'>
                                                      <div class='col-md-2'>
                                                          <button class='btn btn-primary btn-flat btn-block' id='agregar_fila' value='<?php echo $cant_categoria_detalle[$i]['id_categoria_servicios'] ?>' type='button'><span class='fa fa-plus '></span><small></small><?php echo $cant_categoria_detalle[$i]['nombre'] ?></button>
                                                      </div>
                                                      <div class='col-md-1 col-md-offset-10'>
                                                          <button id='eliminar-tabla-categoria' value='tabla-categoria-<?php echo $cant_categoria_detalle[$i]['id_categoria_servicios'] ?>' class='btn btn-danger btn-flat eliminar-tabla-categoria' type='button' title='Eliminar Tabla!'><span class='fa fa-remove'></span></button>
                                                      </div>
                                                  </div>
                                                  <table id='tabla-categoria-<?php echo $cant_categoria_detalle[$i]['id_categoria_servicios'] ?>' class='table jambo_table table-hover'>
                                                      <thead>
                                                          <tr>
                                                              <th>Nombre</th>
                                                              <th>Cantidad</th>
                                                              <th>Dias</th>
                                                              <th>Costo $</th>
                                                              <th>Total $</th>
                                                              <th>Facturado $</th>
                                                              <th>Observaciones</th>
                                                              <th>Opciones</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                          <?php
                                                            $total = 0;
                                                            $facturado = 0;
                                                            ?>
                                                          <?php if (!empty($detalle_ventas)) : ?>
                                                              <?php foreach ($detalle_ventas as $detalle_venta) : ?>
                                                                  <?php if ($detalle_venta['id_categoria_servicios'] == $cant_categoria_detalle[$i]['id_categoria_servicios']) : ?>
                                                                      <tr>
                                                                          <td><input type='hidden' class='id_categoria' name='id_categoria[]' value='<?php echo $detalle_venta['id_categoria_servicios'] ?>'><input type='text' class='nombre form-control' name='nombre[]' value='<?php echo $detalle_venta['nombre'] ?>'></td>
                                                                          <td><input type='number' step='0.01' value='<?php echo $detalle_venta['cantidad'] ?>' class='cantidad form-control' min='0' name='cantidad[]'></td>
                                                                          <td><input type='number' step='0.01' value='<?php echo $detalle_venta['dias'] ?>' class='dias form-control' min='0' name='dias[]'></td>
                                                                          <td><input type='number' step='0.01' value='<?php echo $detalle_venta['costo'] ?>' class='costo form-control' min='0' name='costo[]'></td>
                                                                          <td><input type='number' step='0.01' value='<?php echo $detalle_venta['total'] ?>' readonly class='total form-control' min='0' name='total[]'></td>
                                                                          <td><input type='number' step='0.01' value='<?php echo $detalle_venta['facturado'] ?>' readonly class='facturado form-control' min='0' name='facturado[]'></td>
                                                                          <td><input type='text' maxlength='100' value="<?php echo $detalle_venta['observaciones'] ?>" class='observaciones form-control' min='0' name='observaciones[]'></td>
                                                                          <td><button type='button' class='btn btn-danger btn-remove-producto' title='Eliminar fila!'><span class='fa fa-remove'></span></button></td>
                                                                      </tr>
                                                                  <?php
                                                                        $total = $total + number_format($detalle_venta['total'], 2);
                                                                        $facturado = $facturado + number_format($detalle_venta['facturado'], 2);
                                                                    endif;
                                                                    ?>
                                                              <?php endforeach; ?>
                                                          <?php endif; ?>
                                                      </tbody>
                                                      <tfoot>
                                                          <tr>
                                                              <th colspan="4">Totales </th>
                                                              <th>
                                                                  <p><?php echo number_format($total, 2); ?></p>
                                                              </th>
                                                              <th>
                                                                  <p><?php echo number_format($facturado, 2); ?></p>
                                                              </th>
                                                              <th>
                                                                  <p></p>
                                                              </th>
                                                              <th>
                                                                  <p></p>
                                                              </th>
                                                          </tr>
                                                      </tfoot>
                                                  </table>
                                                  <hr>

                                              </div>

                                          <?php } ?>
                                      </div>

                                      <div class="form-group">
                                          <div class="col-md-3">
                                              <div class="input-group has-feedback">
                                                  <span class="input-group-addon">Total:</span>
                                                  <input type="text" class="form-control" value="<?php echo $venta->importeTotal ?>" placeholder="" id="importeTotal" value="0.00" name="importeTotal" readonly="readonly">
                                                  <span class="fa fa-dollar form-control-feedback right" aria-hidden="true"></span>
                                              </div>
                                          </div>
                                          <div class="col-md-3">
                                              <div class="input-group has-feedback">
                                                  <span class="input-group-addon">Iva:</span>
                                                  <input type="text" class="form-control" value="<?php echo $venta->iva ?>" placeholder="" id="iva" value="0.00" name="iva" readonly="readonly">
                                                  <span class="fa fa-dollar form-control-feedback right" aria-hidden="true"></span>
                                              </div>
                                          </div>
                                          <div class="col-md-3">
                                              <div class="input-group has-feedback">
                                                  <span class="input-group-addon">Total facturado:</span>
                                                  <input type="text" class="form-control" value="<?php echo $venta->facturaTotal ?>" placeholder="" id="facturaTotal" value="0.00" name="facturaTotal" readonly="readonly">
                                                  <span class="fa fa-dollar form-control-feedback right" aria-hidden="true"></span>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="col-md-12">
                                              <a class="btn btn-primary btn-flat" href="<?php echo site_url("Movimientos/Presupuesto") ?>" type="button">Volver</a>
                                              <button type="submit" class="btn btn-warning btn-flat">Editar</button>
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
  <div class="modal fade" id="modal-categorias">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Lista de Categorias de servicios</h4>
              </div>
              <div class="modal-body">
                  <table id="example1" class="table table-bordered table-striped table-hover">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Nombre</th>
                              <th>Descripcion</th>
                              <th>Opcion</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php if (!empty($categoria_servicios)) : ?>
                              <?php foreach ($categoria_servicios as $row) : ?>
                                  <tr>
                                      <td><?php echo $row->id_categoria_servicios; ?></td>
                                      <td><?php echo $row->nombre; ?></td>
                                      <td><?php echo $row->descripcion; ?></td>
                                      <?php $dataCategoriaServicio = $row->id_categoria_servicios . "*" . $row->nombre . "*" . $row->descripcion; ?>

                                      <td>
                                          <button type="button" class="btn btn-success btn-check-categoria" value="<?php echo $dataCategoriaServicio ?>"><span class="fa fa-check"></span></button>
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

  <div class="modal fade" id="modal-default">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Lista de Clientes</h4>
              </div>
              <div class="modal-body">
                  <table id="tabla-cliente" class="table table-bordered table-striped table-hover">
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
                                          <button type="button" class="btn btn-success btn-check-cliente" value="<?php echo $dataCliente ?>"><span class="fa fa-check"></span></button>
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
                  <table id="tabla-empleado" class="table table-bordered table-striped table-hover">
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