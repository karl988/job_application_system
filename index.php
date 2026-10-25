<?php
require_once 'core/models.php';
$apps = getAllApplications($pdo);
$edit = isset($_GET['edit']) ? getApplicationByID($pdo, $_GET['edit']) : null;
$v = fn($k) => htmlspecialchars($edit[$k] ?? '');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Web Developer Job Application</title>
<style>
  body { font-family: Arial, sans-serif; max-width: 1000px; margin: 30px auto; padding: 0 15px; }
  form { display: grid; gap: 10px; max-width: 450px; }
  input, select { padding: 8px; }
  button { padding: 10px; cursor: pointer; }
  table { border-collapse: collapse; width: 100%; margin-top: 30px; }
  th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
  th { background: #f0f0f0; }
  .inline { display: inline; }
</style>
</head>
<body>
<h1>Web Developer Job Application</h1>

<h2><?= $edit ? 'Update Application' : 'New Application' ?></h2>
<form action="core/handleForms.php" method="POST">
  <?php if ($edit): ?>
    <input type="hidden" name="application_id" value="<?= $edit['application_id'] ?>">
  <?php endif; ?>
  <input type="text" name="first_name" placeholder="First name" value="<?= $v('first_name') ?>" required>
  <input type="text" name="last_name" placeholder="Last name" value="<?= $v('last_name') ?>" required>
  <input type="email" name="email" placeholder="Email" value="<?= $v('email') ?>" required>
  <input type="text" name="phone" placeholder="Phone" value="<?= $v('phone') ?>" required>
  <select name="position_applied" required>
    <?php foreach (['Front-End Web Developer','Back-End Web Developer','Full-Stack Web Developer'] as $p): ?>
      <option <?= ($edit['position_applied'] ?? '') === $p ? 'selected' : '' ?>><?= $p ?></option>
    <?php endforeach; ?>
  </select>
  <input type="number" name="years_experience" min="0" placeholder="Years of experience" value="<?= $v('years_experience') ?>" required>
  <input type="text" name="primary_stack" placeholder="Primary tech stack (e.g. PHP, MySQL, JavaScript)" value="<?= $v('primary_stack') ?>" required>
  <input type="url" name="portfolio_url" placeholder="Portfolio / GitHub URL" value="<?= $v('portfolio_url') ?>" required>
  <input type="number" step="0.01" name="expected_salary" placeholder="Expected salary" value="<?= $v('expected_salary') ?>" required>
  <?php if ($edit): ?>
    <button type="submit" name="updateBtn">Update</button>
    <a href="index.php">Cancel</a>
  <?php else: ?>
    <button type="submit" name="insertBtn">Submit Application</button>
  <?php endif; ?>
</form>

<h2>All Applications</h2>
<table>
  <tr>
    <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Position</th>
    <th>Years Exp.</th><th>Tech Stack</th><th>Portfolio</th><th>Expected Salary</th><th>Date Added</th><th>Actions</th>
  </tr>
  <?php foreach ($apps as $a): ?>
  <tr>
    <td><?= $a['application_id'] ?></td>
    <td><?= htmlspecialchars($a['first_name'] . ' ' . $a['last_name']) ?></td>
    <td><?= htmlspecialchars($a['email']) ?></td>
    <td><?= htmlspecialchars($a['phone']) ?></td>
    <td><?= htmlspecialchars($a['position_applied']) ?></td>
    <td><?= $a['years_experience'] ?></td>
    <td><?= htmlspecialchars($a['primary_stack']) ?></td>
    <td><a href="<?= htmlspecialchars($a['portfolio_url']) ?>" target="_blank">Link</a></td>
    <td><?= number_format($a['expected_salary'], 2) ?></td>
    <td><?= $a['date_added'] ?></td>
    <td>
      <a href="index.php?edit=<?= $a['application_id'] ?>">Edit</a>
      <form class="inline" action="core/handleForms.php" method="POST" onsubmit="return confirm('Delete this record?')">
        <input type="hidden" name="application_id" value="<?= $a['application_id'] ?>">
        <button type="submit" name="deleteBtn">Delete</button>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
</table>
</body>
</html>
