<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
      </div>

      <div class="title_right">

      </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Dashboard</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check"></i></div>
                  <div class="count green"><?php echo number_format($total_proyectos_aprobados['Total'], 2); ?> $</div>
                  <h3>Proyectos aprobados</h3>
                  <p><i class="green" style="font-size: 20px;"><?php echo $total_proyectos_aprobados['cantidad_aprobados']; ?> </i>Cantidad de los proyectos aprobados.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-retweet"></i></div>
                  <div class="count amarillo"><?php echo number_format($total_proyectos_evaluacion['Total'], 2); ?> $</div>
                  <h3>Proyectos en evaluacion</h3>
                  <p><i class="amarillo" style="font-size: 20px;"><?php echo $total_proyectos_evaluacion['cantidad_aprobados']; ?> </i>Cantidad de los proyectos en evaluacion .</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Tablas de reportes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display:none">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="tablaPresupuestos" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Presupuestos</a>
                        </li>
                        <li role="reporte_gancias" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Ganancia por proyecto</a>
                        </li>

                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                          <table id="tablaPresupuestos" class="table table-bordered btn-hover">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Nombres Cliente</th>
                                <th>Nombre proyecto</th>
                                <th>Estado proyecto</th>
                                <th>Total</th>
                                <th>Total Facturado</th>
                                <th>Opciones</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if (!empty($presupuestos)) : ?>
                                <?php foreach ($presupuestos as $row) : ?>
                                  <tr>
                                    <td><?php echo $row['id_ventas']; ?></td>
                                    <td><?php echo $row['fecha']; ?></td>
                                    <td><?php echo $row['nombres']; ?></td>
                                    <td><?php echo $row['proyecto']; ?></td>
                                    <td><?php echo $row['fase_proyecto']; ?></td>
                                    <td><?php echo $row['importeTotal']; ?></td>
                                    <td><?php echo $row['facturaTotal']; ?></td>
                                
                               
                                    <td>
                                      <button type="button" title="Vista sin tablas" class="btn btn-info btn-view-presupuestoLista" data-toggle="modal" data-target="#modal-default" value="<?php echo $row['id_ventas'] ?>"><span class="fa fa-file-text-o"></span></button>
                                      <button type="button" title="Vista con tablas" class="btn btn-info btn-view-presupuestoTablas" data-toggle="modal" data-target="#modal-default" value="<?php echo $row['id_ventas'] ?>"><span class="fa fa-file-text-o"></span></button>
                                      <a href="<?php echo base_url() ?>Movimientos/Presupuesto/editar/<?php echo $row['id_ventas']; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                      <button type="button" value="<?php echo  $row['id_ventas']; ?>" class="btn btn-danger btn-borrar"><span class="fa fa-remove"></span></button>
                                    </td>
                                  </tr>
                                <?php endforeach; ?>
                              <?php endif; ?>
                            </tbody>

                          </table>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <table id="reporte_gancias" class="table table-bordered btn-hover">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Proyecto</th>
                                <th>Cliente</th>
                                <th>Ingreso bruto</th>
                                <th>Comision agencia</th>
                                <th>Costo produccion</th>
                                <th>Ingreso antes de impuesto</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if (!empty($reporte_gancias)) : ?>
                                <?php foreach ($reporte_gancias as $row) : ?>
                                  <tr>
                                    <td><?php echo $row['id_ventas']; ?></td>
                                    <td><?php echo $row['fecha']; ?></td>
                                    <td><?php echo $row['proyecto']; ?></td>
                                    <td><?php echo $row['nombre_cliente']; ?></td>
                                    <td><?php echo number_format($row['ingreso_bruto'],2); ?> $</td>
                                    <td><?php echo number_format($row['honorarios_agencia'], 2) ; ?> $</td>
                                    <td><?php echo number_format($row['costo_produccion'],2) ; ?> $</td>
                                    <td><?php echo (number_format($row['ingreso_bruto'],2,'.','') - number_format($row['honorarios_agencia'],2,'.','') - number_format($row['costo_produccion'],2,'.','')); ?> $</td>

                                  </tr>
                                <?php endforeach; ?>
                              <?php endif; ?>

                            </tbody>
                          </table>
                        </div>

                      </div>
                    </div>

                  </div>
                </div>
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

        <h4 class="modal-title">Informacion del Presupuesto</h4>

      </div>

      <div class="modal-body">



      </div>

      <div class="modal-footer">


        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print">Imprimir</span></button>


      </div>

    </div>

    <!-- /.modal-content -->

  </div>
</div>
<!-- /.modal-dialog -->

</div>
<!-- /.modal -->
<!-- /.modal -->