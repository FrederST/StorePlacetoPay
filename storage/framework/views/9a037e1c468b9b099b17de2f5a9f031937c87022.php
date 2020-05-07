

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Tus Ordenes</h3></div>

                <a class="btn btn-primary" href="<?php echo e(url('/allorders')); ?>">Para Ver Todas Las Ordenes (De La Tienda) Click Aquí</a>

                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    

                    <table class="table" id="ordersHome" class="table table-hover table-condensed">
                        <thead>
                        
                        <tr>
                            <th>Id</th>
                            <th>Producto</th>
                            <th>Valor</th>
                            <th>Estado</th>
                            <th>&nbsp;</th>
                        </tr>
                
                        </thead>
                    </table>


                </div>
            </div>
        </div>
    </div>

</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH I:\Evertec\Proyecto_Evertec\ProyectoPlaceToPay\resources\views/home.blade.php ENDPATH**/ ?>