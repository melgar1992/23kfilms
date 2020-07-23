<div class="row">
	<div class="col-xs-12 text-right">
		Santa Cruz, <?php echo $venta->fecha ?><br>

	</div>
</div> <br>
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
		<b>Nombre:</b> <?php echo $venta->nombres ?> <br>
		<b>Nro Documento:</b> <?php echo $venta->documento ?> <br>
		<b>Telefono:</b> <?php echo $venta->telefono ?> <br>
		<b>Direccion</b> <?php echo $venta->direccion ?> <br>
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
										$total = $total + $detalle_venta['total'];
										$facturado = $facturado + $detalle_venta['facturado'];
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
	<div class="row">
		<div class="col-xs-6 ">
			<br> <b>Honorarios 23KFilms: </b><?php echo $venta->honorarios ?> $ <br>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6 ">
			<br> <b>Honorarios Agencia: </b><?php echo $venta->honorarios_agencia ?> $<br>
		</div>
	</div>
	<div>
		<h5><b>Costo del proyecto:</b> <?php echo number_format($venta->importeTotal, 2, '.', ',') ?> $</h5><br>
		<?php $centavos = ($venta->importeTotal - floor($venta->importeTotal)) * 100; ?>
		<?php echo convertir(number_format($venta->importeTotal, 0, '.', '')) ?> con <?php echo ($centavos > 0) ? convertir($centavos)  : 'cero' ?> centavos.
	</div>
	<div>
		<h5><b>Costo total del proyecto, incluye impuesto de ley:</b> <?php echo number_format($venta->facturaTotal, 2, '.', ',') ?> $</h5><br>
		<?php $centavosf = ($venta->facturaTotal - floor($venta->facturaTotal)) * 100; ?>
		<?php echo convertir(number_format($venta->facturaTotal, 0, '.', '')) ?> con <?php echo ($centavosf > 0) ? convertir($centavosf) : 'cero' ?> centavos. <br>
	</div>
	<div class="row">
		<div class="col-xs-12 ">
			<br> <b>Forma de pago: </b><?php echo $venta->cuota_inicial ?>% a la orden del trabajo y <?php echo 100 - $venta->cuota_inicial; ?>% restante a la entrega del trabajo. <br>
			El restante se debera cancelar dentro de los 30 dias siguientes de haber sido aprobado el proyecto, no pudiendo pasar este periodo.
		</div>
	</div>

	<div class="row">
		<div class="col-xs-6 ">
			<br> <b>Derecho de exhibicion:</b><?php echo $venta->derecho_exhibicion ?> <br>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6 ">
			<br> <b>Tiempo de entrega:</b> Segun cronograma <br>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 ">
			<br> <b>Nota:</b> Este presupuesto podria variar si ocurre cambio de guion, factores climaticos, factores politicos y factores belicos.
		</div>
		<br>
	</div>
	</br>


	<div class="row">
		<div class="col-xs-6 ">
			<br>Firma<br>
			<br>Nombre: <?php echo $venta->nombre_empleado . ' ' . $venta->apellidos_empleado ?> <br>
			<br>Telefono: <?php echo $venta->telefono ?> <br>

			<br> <br>
		</div>

	</div>