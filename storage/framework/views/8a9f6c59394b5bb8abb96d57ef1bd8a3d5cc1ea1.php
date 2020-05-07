

<?php $__env->startSection('content'); ?>
<div class="container">

    <form action="<?php echo e(url('/createorder')); ?>" method="POST">
        <?php echo method_field('POST'); ?>

        <?php echo csrf_field(); ?>
        <input  type="hidden" value="<?php echo e($product->id); ?>" name="product_id" id="product_id" readonly>
    
        <div class="row">
            <div class="col-sm">
                <h1>Por favor Confirme los Datos:</h1>
                <h1>Producto: <?php echo e($product->name); ?></h1>
                <h2>Valor: $ <?php echo e($product->value); ?> COP</h2>
                <h3>Nombre: <?php echo e($user->name); ?> <?php echo e($user->surname); ?></h3>
                <h3>Email: <?php echo e($user->email); ?></h3>
                <h3>Celular: <?php echo e($user->mobile); ?></h3>
            </div>
            <div class="col-sm text-center">
                <img class="img-product" src="<?php echo e($product->url_image); ?>" alt="<?php echo e($product->name); ?>">
                <br><br>
                <a class="btn btn-secondary btn-lg btn-block" href="/">Regresar</a>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Confirmar</button>
            </div>
        </div>

    </form>



  
    

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Evertec\Proyecto_Evertec\ProyectoPlaceToPay\resources\views/store/order.blade.php ENDPATH**/ ?>