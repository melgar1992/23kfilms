<div class="row">
	<div class="col-xs-12 text-center">
		<?php echo $Configuracion->nombres ?><br>
		<?php echo $Configuracion->direccion ?><br>
		<?php echo $Configuracion->numero_telefono ?> <br>
		<?php echo $Configuracion->email ?> <br>
	</div>
</div> <br>
<div class="row">
	<div class="col-xs-6">
		<b>CLIENTE</b><br>
		<b>Nombre: </b> <?php echo $venta->nombres ?> <br>
		<b>Nro Documento: </b> <?php echo $venta->documento ?> <br>
		<b>Telefono: </b> <?php echo $venta->telefono ?> <br>
		<b>Direccion </b> <?php echo $venta->direccion ?> <br>
	</div>

</div>
<br>
<div id="Titulo del proyecto">
	<h4 class="text-center col-xs-12">Cotizacion del proyecto: <?php echo $venta->proyecto; ?></h4>
	<p>A continuación detallamos la cotización.</p><br>
</div>
<div class="row">
	<div class="col-xs-12">
		<div>
			<?php
			for ($i = 0; $i < count($cant_categoria_detalle); $i++) { ?>
				<div class='tabla-categoria-<?php echo $cant_categoria_detalle[$i]['id_categoria_servicios'] ?>'>

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
											<td><?php echo $detalle_venta['nombre'] ?></td>
											<td><?php echo $detalle_venta['cantidad'] ?></td>
											<td><?php echo $detalle_venta['dias'] ?></td>
											<td><?php echo $detalle_venta['costo'] ?></td>
											<td><?php echo $detalle_venta['total'] ?></td>
											<td><?php echo $detalle_venta['facturado'] ?></td>
											<td><?php echo $detalle_venta['observaciones'] ?></td>
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
									<p><?php echo number_format($total, 2); ?> $</p>
								</th>
								<th>
									<p><?php echo number_format($facturado, 2); ?> $</p>
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
	</div>
</div>
<div>
	<h5>Costo total del proyecto sin facturado: <b class="text-right"><?php echo $venta->importeTotal ?> $</b></h5><br>
	<b><?php echo convertir(number_format($venta->importeTotal)) ?> dolares americanos</b>
</div>
<div>
	<h5>Costo total del proyecto facturado: <b class="text-right"><?php echo $venta->facturaTotal ?> $</b></h5><br>
	<b><?php echo convertir(number_format($venta->facturaTotal)) ?> dolares americanos</b> <br>
</div>
<div class="row">
	<div class="col-xs-6 ">
		<br></br>
		<p><br>----------------------------<br></p>
		<p><br>Firma<br></p>
		<p><br>Nombre: </p>
		<p><br>Carnet de Identidad: </p>
		<br> <br>
	</div>

</div>