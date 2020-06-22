    <!-- page content -->
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
                <h2>Dashboard inventario</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div class="row tile_count">
                  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-money"></i> Valor de inventario actual</span>
                    <div class="count green"><?php echo number_format($valor_inventario_proyectos['valorTotal'] + $valor_inventario['valor_total_inventario'] ,2,'.',',')  ?> Bs</div>
                    <span class="count_bottom"><i class=""></i><?php echo $valor_inventario['items_almacen'] + $valor_inventario_proyectos['cantidad'] ;?> </i> Cantidad items</span>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-money"></i> Valor de inventario en proyectos</span>
                    <div class="count red"><?php echo number_format($valor_inventario_proyectos['valorTotal'],2,'.',',')  ?> Bs</div>
                    <span class="count_bottom"><i class=""><i class=""></i><?php echo $valor_inventario_proyectos['cantidad'] ;?> </i> Cantidad items</span>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-money"></i> Valor de inventario en almacen</span>
                    <div class="count green"><?php echo number_format($valor_inventario['valor_total_inventario'],2,'.',',') ; ?> Bs</div>
                    <span class="count_bottom"><i class=""><i class=""></i><?php echo $valor_inventario['items_almacen'];?></i> Cantidad items</span>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-money"></i>Valor de productos descartados :</span>
                    <div class="count red"><?php echo number_format($valor_productos_descartados['valor_descarte'],2,'.',',') ;?> Bs</div>
                    <span class="count_bottom"><i class=""><i class=""></i><?php echo $valor_productos_descartados['cantidad'] ?></i> Cantidad items</span>
                  </div>

                </div>
              </div>
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
                    <li role="tablaProdcutos" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Tabla de productos</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Tabla proyectos</a>
                    </li>
                    <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Tabla de productos descartados </a>
                    </li>
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                      <table id="tablaProdcutos" class="table table-bordered btn-hover">
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
                                    <a href="<?php echo base_url() ?>Mantenimiento/Productos/editar/<?php echo $productos->id_productos; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                    <a href="<?php echo base_url(); ?>Mantenimiento/Productos/borrar/<?php echo $productos->id_productos; ?>" class="btn btn-danger btn-borrar"><span class="fa fa-remove"></span></a>
                                  </div>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Estado producto</th>
                            <th>Talla</th>
                            <th>Color</th>
                            <th>Marca</th>
                            <th style="text-align:right">Total de pagina:</th>
                            <th></th>
                            <th>Categoria</th>
                            <th>Opciones</th>
                          </tr>
                          <tr>
                            <th colspan="8" style="text-align:right">Total items general:</th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                      <table id="tabla_salida_productos" class="table table-bordered btn-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nombres Cliente</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Nombre proyecto</th>
                            <th>Estado proyecto</th>
                            <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (!empty($ventas)) : ?>
                            <?php foreach ($ventas as $venta) : ?>
                              <tr>
                                <td><?php echo $venta->id_ventas; ?></td>
                                <td><?php echo $venta->nombres; ?></td>
                                <td><?php echo $venta->fecha; ?></td>
                                <td><?php echo $venta->importeTotal; ?></td>
                                <td><?php echo $venta->proyecto; ?></td>
                                <td><?php echo $venta->fase_proyecto; ?></td>
                                <td>
                                  <button type="button" class="btn btn-info btn-view-venta" data-toggle="modal" data-target="#modal-default" value="<?php echo $venta->id_ventas ?>"><span class="fa fa-search"></span></button>
                                  <a href="<?php echo base_url() ?>Movimientos/Ventas/editar/<?php echo $venta->id_ventas; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                  <button type="button" value="<?php echo  $venta->id_ventas; ?>" class="btn btn-danger btn-borrar"><span class="fa fa-remove"></span></button>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          <?php endif; ?>

                        </tbody>
                      </table>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                      <table id="tabla_descarte" class="table table-bordered btn-hover">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Categoria</th>
                            <th>Tipo de falla</th>
                            <th>Fecha</th>
                            <th>precio</th>
                            <Th>Cantidad</Th>
                            <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (!empty($descarte_productos)) : ?>
                            <?php foreach ($descarte_productos as $descarte_producto) : ?>

                              <tr>
                                <td><?php echo $descarte_producto->id_descarte_producto; ?></td>
                                <td><?php echo $descarte_producto->codigo; ?></td>
                                <td><?php echo $descarte_producto->nombre_producto; ?></td>
                                <td><?php echo $descarte_producto->categorias_producto; ?></td>
                                <td><?php echo $descarte_producto->tipo_falla; ?></td>
                                <td><?php echo $descarte_producto->fecha; ?></td>
                                <td><?php echo $descarte_producto->precio; ?></td>
                                <td><?php echo $descarte_producto->cantidad; ?></td>
                                <td>
                                  <div class="btn-group">
                                    <a href="<?php echo base_url() ?>Movimientos/descarte/editar/<?php echo $descarte_producto->id_descarte_producto; ?>" class="btn btn-warning"><span class="fa fa-pencil"></span></a>
                                    <button type="button" value="<?php echo  $descarte_producto->id_descarte_producto; ?>" class="btn btn-danger btn-borrar"><span class="fa fa-remove"></span></button>
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

            <h4 class="modal-title">Informacion de la salida</h4>

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

      <!-- /.modal-dialog -->

    </div>

    <!-- /.modal -->