

<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
 
<script>
   let user = <?php echo json_encode($user); ?>;
   //console.log(user);
</script> 

<?php $__env->startSection('main'); ?>

   <booking-component></booking-component>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/index.blade.php ENDPATH**/ ?>