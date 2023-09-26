<?php if (session()->has('success')): ?>
<div class="alert alert-primary" role="alert" id="successAlert">
    <?= session('success') ?>
</div>
<script>
setTimeout(function() {
    $('#successAlert').fadeOut('slow');
}, 3000);
</script>
<?php endif; ?>

<?php if (session()->has('error')): ?>
<?php $errors = session('error'); ?>
<?php if (is_array($errors)): ?>
<?php foreach ($errors as $error): ?>
<div class="alert alert-danger" role="alert" id="gagalAlert">
    <?= $error ?>
</div>
<script>
setTimeout(function() {
    $('#gagalAlert').fadeOut('slow');
}, 3000);
</script>
<?php endforeach; ?>
<?php else: ?>
<div class="alert alert-danger" role="alert" id="gagalAlert">
    <?= $errors ?>
</div>
<script>
setTimeout(function() {
    $('#gagalAlert').fadeOut('slow');
}, 3000);
</script>
<?php endif; ?>
<?php endif; ?>

<?php if (session()->has('NoEdit')): ?>
<div class="alert alert-warning" role="alert" id="updateAlert">
    <?= session('NoEdit') ?>
</div>
<script>
setTimeout(function() {
    $('#updateAlert').fadeOut('slow');
}, 3000);
</script>
<?php endif; ?>