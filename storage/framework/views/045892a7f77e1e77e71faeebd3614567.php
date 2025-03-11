

<?php $__env->startSection('title', 'Edit House'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="mb-4 animate__animated animate__fadeInDown">Edit House</h1>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card animate__animated animate__zoomIn">
            <div class="card-body">
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form action="<?php echo e(route('houses.update', $house)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo e($house->name); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" required><?php echo e($house->description); ?></textarea>
                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" id="regenerate_description" name="regenerate_description">
                            <label class="form-check-label" for="regenerate_description">Regenerate with AI</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo e($house->price); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?php echo e($house->location); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="<?php echo e(route('houses.index')); ?>" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dell\housing-management\resources\views/houses/edit.blade.php ENDPATH**/ ?>