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
	<h3 class="text-center col-xs-12">COTIZACIÓN DE <?php echo $venta->proyecto; ?></h3>
	<p>A continuación detallamos la cotización.</p><br>
</div>
<div class="row">
	<div class="col-xs-12">
		<ul>
			<?php for ($i = 0; $i < count($cant_categoria_detalle); $i++) { ?>
				<?php $nombreCategoria = $cant_categoria_detalle[$i]['nombre']; ?>
				<li><?php echo $nombreCategoria ?>
					<?php if (!empty($detalle_ventas)) : ?>
						<?php foreach ($detalle_ventas as $row) : ?>
				<li><?php echo $row['nombre']; ?></li>
			<?php endforeach; ?>
		<?php endif; ?>
		</li>

	<?php } ?>
		</ul>
	</div>
</div>
<div>
	<h4>Costo total del proyecto: <b class="text-right"><?php echo $venta->facturaTotal ?></b></h4><br>
	<b><?php echo convertir(number_format($venta->facturaTotal)) ?></b>
</div>
<div class="row">
	<div class="col-xs-6 ">
		<br>Firma<br>
		<br>Nombre: <?php echo $encargado->nombre ?> <br>
		<br>Carnet de Identidad: <?php echo $encargado->num_documento ?> <br>
		<br> <br>
	</div>

</div>