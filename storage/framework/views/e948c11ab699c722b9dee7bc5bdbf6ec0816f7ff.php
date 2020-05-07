

<?php $__env->startSection('content'); ?>

<div class="container">


    <div class="row">
        <div class="col-sm">
            <h1>Orden # <?php echo e($orderSQL->id); ?></h1>
            <h1>Producto: <?php echo e($productSQL->name); ?></h1>
            <h2>Valor: $ <?php echo e($productSQL->value); ?> COP</h2>
            <h3>Nombre: <?php echo e($userSQL->name); ?> <?php echo e($userSQL->surname); ?></h3>
            <h3>Email: <?php echo e($userSQL->email); ?></h3>
            <h3>Celular: <?php echo e($userSQL->mobile); ?></h3>

            <?php if($orderSQL->status == 2): ?>
                <h3 class="text-white bg-success">Pago Exitoso</h3>
            <?php elseif($orderSQL->status == 3): ?>
                <h3 class="text-white bg-danger">Pago Rechazado</h3>
                <form action="<?php echo e(url('/retrypayment')); ?>" method="GET">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" value="<?php echo e($orderSQL->product_id); ?>" name="product_id" id="product_id" readonly>
                  <input type="hidden" value="<?php echo e($orderSQL->id); ?>" name="order_id" id="order_id" readonly>
                  <button type="submit" class="btn btn-danger tn-lg btn-block">Reintentar Compra</button>
                </form>
            <?php elseif($orderSQL->status == 4): ?>
                <h3 class="text-white bg-info">El Pago Se Encuentra Pendiente</h3>
                <a class="btn btn-primary tn-lg btn-block" href="<?php echo e($orderSQL->processUrl); ?>">Click Para Más Información</a>
            <?php else: ?> 
                <h3>Ocurrio Un Error</h3>
            <?php endif; ?>
            <a class="btn btn-secondary btn-lg btn-block" href="/">Ir a Tienda</a>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Evertec\Proyecto_Evertec\ProyectoPlaceToPay\resources\views/store/orderpayment.blade.php ENDPATH**/ ?>