

<?php $__env->startSection('content'); ?>
<div class="container">

    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <br>
        <div class="row">
            <div class="col-8 border border-dark rounded">
                <div class="row">
                    <div class="col-4">
                        <h4><?php echo e($item->name); ?></h4>
                        <h5>$ <?php echo e($item->value); ?> COP</h5>
                        <a class="btn btn-info" data-toggle="collapse" href="#collapse<?php echo e($item->id); ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Más Información
                        </a>
                        <br><br>
                        <form action="<?php echo e(url('/order')); ?>" method="GET">
                            <?php echo csrf_field(); ?>
                      
                            <input type="hidden" value="<?php echo e($item->id); ?>" name="product_id" id="product_id" readonly>
                      
                            <button type="submit" class="btn btn-primary">Continuar Con La Compra</button>
                        </form>
                        
                        
                    </div>
                    <div class="col">
                        <div class="collapse" id="collapse<?php echo e($item->id); ?>">
                            <div class="card card-body">
                                <h5>Descripción</h5>
                                <?php echo $item->description; ?>

                            </div>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
            <div class="col-sm border border-dark rounded d-flex justify-content-center">
                <img class="img-product" src="<?php echo e($item->url_image); ?>" alt="<?php echo e($item->name); ?>">
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Evertec\Proyecto_Evertec\ProyectoPlaceToPay\resources\views/store/products.blade.php ENDPATH**/ ?>