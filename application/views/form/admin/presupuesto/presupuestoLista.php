<div class="row">
	<div class="col-xs-12 text-right">
		Santa Cruz, <?php echo $presupuesto->fecha ?><br>

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
		<b>Nombre:</b> <?php echo $presupuesto->nombres ?> <br>
		<b>Nro Documento:</b> <?php echo $presupuesto->documento ?> <br>
		<b>Telefono:</b> <?php echo $presupuesto->telefono ?> <br>
		<b>Direccion</b> <?php echo $presupuesto->direccion ?> <br>
	</div>

</div>
<br>
<div id="Titulo del proyecto">
	<h4 class="text-center col-xs-12">Cotizacion del proyecto: <?php echo $presupuesto->proyecto; ?></h4>
	<p>A continuación detallamos la cotización.</p><br>
</div>
<div class="row">
	<div class="col-xs-12">
		<ul>
			<?php for ($i = 0; $i < count($cant_categoria_detalle); $i++) { ?>
				<?php $nombreCategoria = $cant_categoria_detalle[$i]['nombre']; ?>
				<li><b><?php echo $nombreCategoria ?></b>
					<ul>
						<?php if (!empty($detalle_ventas)) : ?>

							<?php foreach ($detalle_ventas as $row) : ?>
								<li><?php echo $row['nombre']; ?></li>
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</li>

			<?php } ?>
		</ul>
	</div>
</div>
<div>
	<h5><b>Costo del proyecto, incluye impuesto de ley:</b> <?php echo number_format($presupuesto->facturaTotal, 2, '.', ',') ?> $</h5>
	<?php $centavosf = ($presupuesto->facturaTotal - floor($presupuesto->facturaTotal)) * 100; ?>
	<?php echo convertir(number_format($presupuesto->facturaTotal, 0, '.', '')) ?> con <?php echo ($centavosf > 0) ? convertir($centavosf) : 'cero' ?> centavos. <br>
</div>
<div class="row">
	<div class="col-xs-12 ">
		<br> <b>Forma de pago: </b><?php echo $presupuesto->cuota_inicial ?>% a la orden del trabajo y <?php echo 100 - $presupuesto->cuota_inicial; ?>% restante a la entrega del trabajo. <br>
		El restante se debera cancelar dentro de los 30 dias siguientes de haber sido aprobado el proyecto, no pudiendo pasar este periodo.
	</div>
</div>

<div class="row">
	<div class="col-xs-6 ">
		<br> <b>Derecho de exhibicion:</b><?php echo $presupuesto->derecho_exhibicion ?> <br>
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
		<br>Nombre: <?php echo $presupuesto->nombre_empleado . ' ' . $presupuesto->apellidos_empleado ?> <br>
		<br>Carnet de Identidad: <?php echo $presupuesto->telefono ?> <br>
		<br> <br>
	</div>

</div>