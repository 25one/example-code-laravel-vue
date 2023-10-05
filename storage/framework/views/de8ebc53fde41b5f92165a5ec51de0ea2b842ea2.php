<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name')); ?></title>
    <!-- Styles CSS -->
    <!-- bootstrap css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <!-- awesome css -->  
    <link rel="stylesheet" href="<?php echo e(asset('css/fontawesome.min.css')); ?>">  
    <!-- main.css (template) -->
    <link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>">

    <!-- app css (laravel) -->    
    <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>"> <!-- mix -->

    <!-- datepicker css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/vue2-datepicker/index.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/vue-toast/theme-sugar.css')); ?>">

    <?php echo $__env->yieldContent('css'); ?>

</head>
<body>
<div class="row">
    <div class="col-md-3">
        <div class="add_funct_top">
          <a class="btn btn-link btn-xs btn-block page_content" href="#" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"><div class="dropdown-menu-div">Logout <?php echo e($user['name']); ?></div></a>
          <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
            <?php echo e(csrf_field()); ?>

          </form>
        </div>
    </div>
</div>
    <div id="app">
       <?php echo $__env->yieldContent('main'); ?>
    </div>
<!-- Scripts JS -->   
<!-- app js (laravel) -->
<script src="<?php echo e(mix('js/app.js')); ?>"></script> <!-- mix -->

<?php echo $__env->yieldContent('js'); ?> 

</body>
</html>
<?php /**PATH /var/www/resources/views/layout.blade.php ENDPATH**/ ?>