<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<?php if ($message): ?>
    <div class="mb-2 text-danger" onclick="this.classList.add('d-none');"><?= $message ?></div>
<?php endif; ?>