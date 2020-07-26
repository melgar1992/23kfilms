  <!-- page content -->
  <div class="right_col" role="main">
      <div class="">
          <div class="page-title">
              <div class="title_left">
                  <h3>Registrar un nuevo presupuesto</h3>
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

                                  <form action="" id='guardar_presupuesto' name="guardar_presupuesto" method="POST" class="form-horizontal">
                                      <div class="form-group">


                                      </div>
                                      <div class="form-group">
                                          <div class="col-md-3 col-lg-3">
                                              <label for="">Cliente:</label>
                                              <div class="input-group">
                                                  <input type="hidden" name="idcliente" id="idcliente">
                                                  <input type="text" class="form-control" readonly="readonly" required id="cliente">
                                                  <span class="input-group-btn">
                                                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default"><span class="fa fa-search"></span> Buscar</button>
                                                  </span>
                                              </div><!-- /input-group -->
                                          </div>
                                          <div class="col-md-3 col-lg-3">
                                              <label for="">Empleado a cargo:</label>
                                              <div class="input-group">
                                                  <input type="hidden" name="idempleado" id="idempleado">
                                                  <input type="text" class="form-control" readonly="readonly" required id="empleado">
                                                  <span class="input-group-btn">
                                                      <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-empleados"><span class="fa fa-search"></span> Buscar</button>
                                                  </span>
                                              </div><!-- /input-group -->
                                          </div>
                                          <div class="col-md-3 col-lg-3">
                                              <label for="">Fecha:</label>
                                              <input type="date" value="<?php echo date("Y-m-d") ?>" class="form-control" id="fecha" name="fecha" required>
                                          </div>
                                          <div class="col-md-3 col-lg-3">
                                              <label for="cuota_inical">Cuota Inicial</label>
                                              <input type="number" min="0" max="100" step="0.1" placeholder="%" name="cuota_inicial" id="cuota_inicial" class="form-control" required>
                                          </div>

                                      </div>
                                      <div class="form-group">
                                          <div class="col-md-3 col-lg-3">
                                              <label for="proyecto">Nombre proyecto</label>
                                              <input type="text" name="proyecto" id="proyecto" class="form-control" required>
                                          </div>
                                          <div class="col-md-3 col-lg-3">
                                              <label for="fase_proyecto" class="">Fase de proyecto</label>
                                              <select name="fase_proyecto" id="fase_proyecto" requiered='requiered' class="form-control col-md-7 col-xs-12">
                                                  <option value=""></option>
                                                  <option value="Evaluacion del proyecto">Evaluacion del presupuesto</option>
                                                  <option value="Aprobado">Aprobado</option>
                                                  <option value="En ejecucion">Descartado</option>
                                                 
                                              </select>
                                          </div>
                                          <div class="col-md-3 col-lg-3">
                                              <label for="derecho_exhibicion">Derecho de Exhibicion</label>
                                              <input type="text" name="derecho_exhibicion" id="derecho_exhibicion" class="form-control" required>
                                          </div>


                                      </div>
                                      <div class="form-group">
                                          <div class="col-md-3 col-lg-3">
                                              <label for="honorarios">Honorarios 23K Films</label>
                                              <input type="number" min="0" max="60" step="0.1" placeholder="%" name="porcentaje_honorarios" id="porcentaje_honorarios" class="form-control" required>
                                          </div>
                                          <div class="col-md-3 col-lg-3">
                                              <label for="honoracios_agencia">Honorarios Agencia</label>
                                              <input type="number" min="0" max="60" step="0.1" placeholder="%" name="porcentaje_honorarios_agencia" id="porcentaje_honorarios_agencia" class="form-control" required>
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


                                      </div>

                                      <div class="form-group">
                                          <div class="col-md-4">
                                              <div class="input-group has-feedback">
                                                  <span class="input-group-addon">Costo produccion:</span>
                                                  <input type="text" class="form-control" placeholder="" id="costo_produccion" value="0.00" name="costo_produccion" readonly="readonly">
                                                  <span class="fa fa-dollar form-control-feedback right" aria-hidden="true"></span>
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="input-group has-feedback">
                                                  <span class="input-group-addon">Honorarios:</span>
                                                  <input type="text" class="form-control" placeholder="" id="honorarios" value="0.00" name="honorarios" readonly="readonly">
                                                  <span class="fa fa-dollar form-control-feedback right" aria-hidden="true"></span>
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="input-group has-feedback">
                                                  <span class="input-group-addon">Total:</span>
                                                  <input type="text" class="form-control" placeholder="" id="importeTotal" value="0.00" name="importeTotal" readonly="readonly">
                                                  <span class="fa fa-dollar form-control-feedback right" aria-hidden="true"></span>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="form-group">
                                                                                   
                                          <div class="col-md-4">
                                              <div class="input-group has-feedback">
                                                  <span class="input-group-addon">Iva:</span>
                                                  <input type="text" class="form-control" placeholder="" id="iva" value="0.00" name="iva" readonly="readonly">
                                                  <span class="fa fa-dollar form-control-feedback right" aria-hidden="true"></span>
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="input-group has-feedback">
                                                  <span class="input-group-addon">Total facturado:</span>
                                                  <input type="text" class="form-control" placeholder="" id="facturaTotal" value="0.00" name="facturaTotal" readonly="readonly">
                                                  <span class="fa fa-dollar form-control-feedback right" aria-hidden="true"></span>
                                              </div>
                                          </div>
                                          <div class="col-md-4">
                                              <div class="input-group has-feedback">
                                                  <span class="input-group-addon">Honorarios Agencia:</span>
                                                  <input type="text" class="form-control" placeholder="" id="honorarios_agencia" value="0.00" name="honorarios_agencia" readonly="readonly">
                                                  <span class="fa fa-dollar form-control-feedback right" aria-hidden="true"></span>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="col-md-12">
                                              <a class="btn btn-primary btn-flat" href="<?php echo site_url("Movimientos/Presupuesto") ?>" type="button">Volver</a>
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