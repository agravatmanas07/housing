

<?php $__env->startSection('title', 'Houses'); ?>

<?php $__env->startSection('content'); ?>
<h1 class="mb-4 animate__animated animate__fadeInDown">House Listings</h1>

<!-- Filter Form -->
<div class="card mb-4 animate__animated animate__fadeIn">
    <div class="card-body">
        <form method="GET" action="<?php echo e(route('houses.index')); ?>" class="row g-3">
            <div class="col-md-3">
                <label for="min_price" class="form-label">Min Price</label>
                <input type="number" step="0.01" class="form-control" id="min_price" name="min_price" value="<?php echo e(request('min_price')); ?>">
            </div>
            <div class="col-md-3">
                <label for="max_price" class="form-label">Max Price</label>
                <input type="number" step="0.01" class="form-control" id="max_price" name="max_price" value="<?php echo e(request('max_price')); ?>">
            </div>
            <div class="col-md-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo e(request('location')); ?>" placeholder="e.g., Malibu">
            </div>
            <div class="col-md-3">
                <label for="property_type" class="form-label">Property Type</label>
                <input type="text" class="form-control" id="property_type" name="property_type" value="<?php echo e(request('property_type')); ?>" placeholder="e.g., villa">
            </div>
            <div class="col-md-3">
                <label for="sort" class="form-label">Sort by Price</label>
                <select class="form-select" id="sort" name="sort">
                    <option value="">Default</option>
                    <option value="asc" <?php echo e(request('sort') === 'asc' ? 'selected' : ''); ?>>Low to High</option>
                    <option value="desc" <?php echo e(request('sort') === 'desc' ? 'selected' : ''); ?>>High to Low</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            </div>
        </form>
    </div>
</div>

<a href="<?php echo e(route('houses.create')); ?>" class="btn btn-primary mb-3 animate__animated animate__pulse">Add New House</a>
<table class="table table-bordered animate__animated animate__fadeInUp">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $houses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $house): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($house->name); ?></td>
            <td><?php echo e($house->description); ?></td>
            <td>$<?php echo e(number_format($house->price, 2)); ?></td>
            <td><?php echo e($house->location); ?></td>
            <td>
                <a href="<?php echo e(route('houses.edit', $house)); ?>" class="btn btn-warning btn-sm">Edit</a>
                <form action="<?php echo e(route('houses.destroy', $house)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\dell\housing-management\resources\views/houses/index.blade.php ENDPATH**/ ?>