<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- DataTables orders -->
        <script src="<?php echo e(asset('js/table.js')); ?>" defer></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
        <link href="<?php echo e(asset('css/welcome.css')); ?>" rel="stylesheet">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <!-- JQuery and DataTables -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js" defer></script>
        
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <h1><a class="navbar-brand links" href="<?php echo e(url('/')); ?>"><?php echo e(config('app.name', 'Tienda')); ?></a></h1>
            <h1><a class="navbar-brand links" href="<?php echo e(url('/allorders')); ?>">Todas Las Ordenes</a></h1>
            
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    
                    <?php if(Route::has('login')): ?>
                    <div class="top-right links">
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(url('/home')); ?>">Home</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>">Login</a>

                            <?php if(Route::has('register')): ?>
                                <a href="<?php echo e(route('register')); ?>">Register</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </ul>
            </div>

        </nav>
        
        <div>
            <?php echo $__env->yieldContent('content'); ?>
        </div>

    </body>
</html>
<?php /**PATH I:\Evertec\Proyecto_Evertec\ProyectoPlaceToPay\resources\views/welcome.blade.php ENDPATH**/ ?>