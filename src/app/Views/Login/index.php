<?php if (! empty($test) && is_array($test)): ?>

    <?php foreach ($test as $item): ?>
        <p>
            <?php echo esc($item['text']); ?>
        </p>
    <?php endforeach ?>

<?php else: ?>

    <p>Unable to find any test data for you.</p>

<?php endif ?>
