

<?php $__env->startSection('content'); ?>
  <div class="container">

    <?php if($errors->any()): ?>
    <div class="alert alert-danger">
      <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>
    <?php endif; ?>

    
    <br>
    <a class="btn btn-secondary" href="/">Regresar</a>
    <h1><?php echo e($product->name); ?></h1>
    <div class="row">
      <div class="col-sm border">
        <h4>Descripción</h4>
        <p><?php echo e($product->description); ?></p>
        <h5>$ <?php echo e($product->value); ?> COP</h5>
      </div>
      <div class="col-sm border">
        <img class="img-product" src="<?php echo e($product->url_image); ?>" alt="<?php echo e($product->name); ?>">
      </div>
    </div>

    <br>

    <form action="<?php echo e(url('/order')); ?>" method="GET">
      <?php echo csrf_field(); ?>

      <input type="hidden" value="<?php echo e($product->id); ?>" name="product_id" id="product_id" readonly>

        <button type="submit" class="btn btn-primary">Continuar Con La Compra</button>
    </form>

  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Evertec\Proyecto_Evertec\ProyectoPlaceToPay\resources\views/store/product.blade.php ENDPATH**/ ?>